<?php

namespace App\Http\Controllers;

use App\Models\BlankPage;
use App\Http\Requests\BlankPageRequest;
use App\Models\Banner;
use App\Models\BlankPageType;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\ProjectCategory;
use App\Models\WebFooter;
use App\Services\BlankPageService;
use App\Services\BlankPageCreateService;
use App\Services\BlankPageUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Throwable;

class BlankPageController extends Controller
{

    public function __construct(
        protected BlankPageService $blankPageService,
        protected BlankPageCreateService $blankPageCreateService,
        protected BlankPageUpdateService $blankPageUpdateService,
    ){}

    public function index(): View
    {

        if (! Gate::allows('Ver e Listar Páginas em Branco')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $blank_pages = BlankPage::where('status', 'PUBLISHED')
                                        ->latest()
                                        ->get();
            return view('admin.blankpage.index', ['pageConfigs' => $pageConfigs], compact('blank_pages', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Páginas em Branco Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Editar Páginas em Branco')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $types = BlankPageType::with('blank_pages')->orderBy('title', 'asc')->get();

        return view('admin.blankpage.create', ['pageConfigs' => $pageConfigs], compact('types', 'unit', 'copyright'));

    }

    public function store(
        BlankPageRequest $request
    ){
        if (! Gate::allows('Editar Páginas em Branco')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $blankPageData = $request->toArray();

            if(isset($request['image'])){

                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path = Storage::disk('blankpages')->put('thumbs', $request->file( key:'image'));

                $blankPageData = array_merge(
                    $request->toArray(),
                    [
                        'path'  => $path
                    ]
                );
            }

            if($request['content'] != null){
                $detail = $request->content;

                $dom = new \domdocument();
                $searchPage = mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8");
                $dom->loadHtml($searchPage);
                $images = $dom->getelementsbytagname('img');

                foreach($images as $k => $img){
                    $data = $img->getattribute('src');

                    list($type, $data) = explode(';', $data);
                    list($type, $data)      = explode(',', $data);

                    $data = base64_decode($data);
                    $image_name= time().$k.'.png';
                    $path_img = 'content/'. $image_name;
                    Storage::disk('blankpages')->put('content/'. $image_name, $data);

                    //todo ----- arrumar os .env dos servidores
                    $img->removeattribute('src');
                    //production
                    $src_path = env('APP_URL') . '/storage/images/blankpages/'. $path_img;
                    //local test
                    //$src_path = env('APP_URL') . ':8080/storage/images/blankpages/'. $path_img;
                    $img->setattribute('class', 'img-content');
                    $img->setattribute('src', $src_path);
                }

                $detail = $dom->savehtml();

                $blankPageData['content'] = $detail;
            }else{
                $blankPageData['content'] = '';
            }

            $this->blankPageCreateService->create($blankPageData);

            flash('Página em Branco criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($blank_page_id)
    {
        if (! Gate::allows('Ver e Listar Páginas em Branco')) {
            return view('pages.not-authorized');
        }

        try{
            $blank_page = $this->blankPageService->show($blank_page_id);

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $types = BlankPageType::with('blank_pages')->orderBy('title', 'asc')->get();

            return view('admin.blankpage.show', compact('blank_page', 'types', 'unit', 'copyright' ));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a Página em Branco!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        BlankPageRequest $request, $blank_page_id
    ){

        if (! Gate::allows('Editar Páginas em Branco')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $blankPage_old = BlankPage::find($blank_page_id);
            //for server and local unlink
            $old_path = array("https://arraial.rj.gov.br/storage/images/blankpages/");
            //$old_path = array("http://localhost:8080/storage/images/blankpages/");
            $currentuuid = Auth::user()->id;

            if(isset($request['image'])){

                $request->validate([
                    'title' => 'required',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path = Storage::disk('blankpages')->put('thumbs', $request->file( key:'image'));

                $blankPageData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid,
                        'path'  => $path
                    ]
                );
            }
            else{

                $request->validate([
                    'title' => 'required'
                ]);

                $blankPageData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid
                    ]
                );

            }

            if($request['content'] != null){
                //unlinking old images
                $detail_old = $blankPage_old->body;
                $dom_old = new \domdocument();
                $searchPageOld = mb_convert_encoding($detail_old, 'HTML-ENTITIES', "UTF-8");
                $dom_old->loadHtml($searchPageOld);
                $images_old = $dom_old->getelementsbytagname('img');


                //saving new images
                $detail = $request->content;

                $dom = new \domdocument();
                $searchPage = mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8");
                $dom->loadHtml($searchPage);
                $images = $dom->getelementsbytagname('img');

                foreach($images_old as $k => $img_old){
                    $path_for_unlink = $img_old->getattribute('src');
                    $path_for_unlink = str_replace($old_path, "", $path_for_unlink);
                    $verification = true;
                    foreach($images as $k => $img){
                        $data = $img->getattribute('src');
                        $data = str_replace($old_path, "", $data);
                        if($path_for_unlink == $data){
                            $verification = false;
                            break;
                        }
                    }
                    if($verification){
                        Storage::disk('blankpages')->delete($path_for_unlink);
                    }
                }

                //todo fazer o apagar iagens antigas
                //tem que buscar a notíca antiga e apagar todas as imagens do storage e subir novas
                //todo fazer verificação de antigas apagas e deletar elas manter as antigas corretas
                foreach($images as $k => $img){
                    $data = $img->getattribute('src');
                    $path_for_update = str_replace($old_path, "", $data);
                    if (!(Storage::disk('blankpages')->exists($path_for_update))) {
                        list($type, $data) = explode(';', $data);
                        list($type, $data)      = explode(',', $data);

                        $data = base64_decode($data);
                        $image_name= time().$k.'.png';
                        $path_img = 'content/'. $image_name;
                        Storage::disk('blankpages')->put('content/'. $image_name, $data);
                        //todo ----- arrumar os .env dos servidores
                        $img->removeattribute('src');
                        //production
                        $src_path = env('APP_URL') . '/storage/images/blankpage/'. $path_img;
                        //local test
                        //$src_path = env('APP_URL') . ':8080/storage/images/blankpage/'. $path_img;
                        $img->setattribute('src', $src_path);
                    }
                    $img->setattribute('class', 'img-content');
                }

                $detail = $dom->savehtml();

                $blankPageData['content'] = $detail;
            }else{
                $blankPageData['content'] = '';
            }

            $this->blankPageUpdateService->update($blankPageData, $blank_page_id);

            flash('Página em Branco editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($blankPage_id)
    {

        if (! Gate::allows('Deletar Páginas em Branco')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = BlankPage::find($blankPage_id);
            $for_delete->delete();
            flash('Página em Branco deletado com sucesso!')->success();
            return redirect('/paginas');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Página em Branco!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function pagina_web($blank_page)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $page = BlankPage::where('meta_keywords', $blank_page)->first();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $categories = ProjectCategory::orderBy('title', 'asc')->get();

        return view('web.blankpage.show', compact('categories', 'page', 'banner', 'institucional_pages', 'unit', 'copyright', 'service_pages', 'web_footer'));
    }
}

