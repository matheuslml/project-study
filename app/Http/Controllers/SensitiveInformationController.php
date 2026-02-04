<?php

namespace App\Http\Controllers;

use App\Models\SensitiveInformation;
use App\Http\Requests\SensitiveInformationRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\SensitiveInformationCategory;
use App\Models\SensitiveInformationResponsible;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\WebFooter;
use App\Services\SensitiveInformationService;
use App\Services\SensitiveInformationCreateService;
use App\Services\SensitiveInformationUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Throwable;

class SensitiveInformationController extends Controller
{

    public function __construct(
        protected SensitiveInformationService $projectService,
        protected SensitiveInformationCreateService $projectCreateService,
        protected SensitiveInformationUpdateService $projectUpdateService,
    ){}

    public function index(): View
    {

        if (! Gate::allows('Ver e Listar Projetos')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $projects = SensitiveInformation::with('category')
                                        ->latest()
                                        ->get();

            return view('admin.sensitive_information.index', ['pageConfigs' => $pageConfigs], compact('projects', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Projetos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Criar Projetos')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $categories = SensitiveInformationCategory::with('projects')->orderBy('degree', 'asc')->get();
        $responsibles = SensitiveInformationResponsible::with('projects')->orderBy('name', 'asc')->get();
        return view('admin.sensitive_information.create', ['pageConfigs' => $pageConfigs], compact('categories', 'unit', 'copyright', 'responsibles'));

    }

    public function store(
        SensitiveInformationRequest $request
    ){

        if (! Gate::allows('Criar Projetos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $currentuuid = Auth::user()->id;

            if(isset($request['file'])){

                $request->validate([
                    'title' => 'required',
                    'file' => 'required|mimes:pdf,zip,docx|max:10000'
                ]);

                $path = Storage::disk('sensitive_information')->put('files', $request->file( key:'file'));

                $projectData = array_merge(
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

                $projectData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid
                    ]
                );

            }

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
                Storage::disk('sensitive_information')->put('content/'. $image_name, $data);

                //todo ----- arrumar os .env dos servidores
                $img->removeattribute('src');
                //production
                $src_path = env('APP_URL') . '/storage/images/sensitive_information/'. $path_img;
                //local test
                //$src_path = env('APP_URL') . ':8080/storage/images/sensitive-informations/'. $path_img;
                $img->setattribute('class', 'img-content');
                $img->setattribute('src', $src_path);
            }

            $detail = $dom->savehtml();

            $projectData['content'] = $detail;

            $this->projectCreateService->create($projectData);

            flash('Projeto criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){

            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($project_id)
    {

        if (! Gate::allows('Ver e Listar Projetos')) {
            return view('pages.not-authorized');
        }

        try{
            // $project = $this->projectService->show($project_id);

            $project = SensitiveInformation::find($project_id);

            $project_files = [];


            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $categories = SensitiveInformationCategory::with('projects')->orderBy('degree', 'asc')->get();
            $responsibles = SensitiveInformationResponsible::with('projects')->orderBy('name', 'asc')->get();

            return view('admin.sensitive_information.show', compact('project', 'project_files', 'categories', 'unit', 'copyright', 'responsibles' ));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a Projeto!')->error();
            dd($exception);
            return redirect()->back()->withInput();
        }
    }

    public function update(
        SensitiveInformationRequest $request, $project_id
    ){
        if (! Gate::allows('Editar Projetos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $project_old = SensitiveInformation::find($project_id);
            //for server and local unlink
            //$old_path = array("https://arraial.rj.gov.br/storage/images/sensitive-informations/");
            $old_path = array("http://localhost:8080/storage/images/sensitive-informations/");
            $currentuuid = Auth::user()->id;

            if(isset($request['file'])){

                $request->validate([
                    'title' => 'required',
                    'file' => 'required|mimes:pdf,zip,docx|max:10000'
                ]);

                //$path = $request->file( key:'image')->store( path: 'images/Project');
                $path = Storage::disk('sensitive_information')->put('files', $request->file( key:'file'));

                $projectData = array_merge(
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

                $projectData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid
                    ]
                );

            }

            //unlinking old images
            $detail_old = $project_old->body;
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
                    Storage::disk('sensitive_information')->delete($path_for_unlink);
                }
            }

            //todo fazer o apagar iagens antigas
            //tem que buscar a notíca antiga e apagar todas as imagens do storage e subir novas
            //todo fazer verificação de antigas apagas e deletar elas manter as antigas corretas
            foreach($images as $k => $img){
                $data = $img->getattribute('src');
                $path_for_update = str_replace($old_path, "", $data);
                if (!(Storage::disk('sensitive_informations')->exists($path_for_update))) {
                    list($type, $data) = explode(';', $data);
                    list($type, $data)      = explode(',', $data);

                    $data = base64_decode($data);
                    $image_name= time().$k.'.png';
                    $path_img = 'content/'. $image_name;
                    Storage::disk('sensitive_informations')->put('content/'. $image_name, $data);
                    //todo ----- arrumar os .env dos servidores
                    $img->removeattribute('src');
                    //production
                    $src_path = env('APP_URL') . '/storage/images/sensitive_informations/'. $path_img;
                    //local test
                    //$src_path = env('APP_URL') . ':8080/storage/images/sensitive-informations/'. $path_img;
                    $img->setattribute('src', $src_path);
                }
                $img->setattribute('class', 'img-content');
            }

            $detail = $dom->savehtml();

            $projectData['content'] = $detail;

            $this->projectUpdateService->update($projectData, $project_id);

            flash('Projeto editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){

            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($project_id)
    {

        if (! Gate::allows('Deletar Projetos')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = SensitiveInformation::find($project_id);
            $for_delete->delete();
            flash('Projeto deletado com sucesso!')->success();
            return redirect('/sensitive-information');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Projeto!')->error();
            return redirect()->back()->withInput();
        }
    }
    //////////////// WEB ////////////////


    public function web_index()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = SensitiveInformation::orderBy('id', 'desc')->get();
        $categories = SensitiveInformationCategory::all();
        return view('web.sensitive_information.index', compact('projects', 'categories',  'institucional_pages', 'service_pages'));
    }

    public function web_index_filter_title(Request $request)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = SensitiveInformation::filter($request->all())->where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = SensitiveInformationCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.sensitive_information.index', compact('banner', 'projects', 'categories', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_index_filter_category($category_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = SensitiveInformation::where('status', 'PUBLISHED')->where('category_id', $category_id)->orderBy('id', 'desc')->paginate(3);
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = SensitiveInformationCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.sensitive-information.index', compact('banner', 'projects', 'categories', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_index_filter_tag($tag_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = SensitiveInformation::with('tags')->where('status', 'PUBLISHED')->where('tags->id', $tag_id)->orderBy('id', 'desc')->paginate(3);
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = SensitiveInformationCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.sensitive-information.index', compact('banner', 'projects', 'categories', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_show($project_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $project = SensitiveInformation::find($project_id);
        $projects = SensitiveInformation::where('status', 'PUBLISHED')->orderBy('id', 'desc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $categories = SensitiveInformationCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.sensitive-information.show', compact('projects', 'project', 'unit', 'copyright', 'web_footer', 'categories', 'institucional_pages', 'service_pages'));
    }
}
