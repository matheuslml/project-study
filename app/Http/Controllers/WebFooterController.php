<?php

namespace App\Http\Controllers;

use App\Models\WebFooter;
use App\Http\Requests\WebFooterRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\WebFooterService;
use App\Services\WebFooterCreateService;
use App\Services\WebFooterUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Throwable;

class WebFooterController extends Controller
{

    public function __construct(
        protected WebFooterService $webFooterService,
        protected WebFooterCreateService $webFooterCreateService,
        protected WebFooterUpdateService $webFooterUpdateService,
    ){}

    public function index(): View
    {

        if (! Gate::allows('Ver e Listar WebFooter')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $web_footers = WebFooter::all();

            return view('admin.webfooter.index', ['pageConfigs' => $pageConfigs], compact('web_footers', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as WebFooter Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        WebFooterRequest $request
    ){
        //todo: fazer o cadastro de teste
        if (! Gate::allows('Editar WebFooter')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();


            if(isset($request['float_icon_url'])){

                $request->validate([
                    'float_icon_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path = Storage::disk('webfooters')->put('icons', $request->file( key:'float_icon_url'));

                $webFooterData = array_merge(
                    $request->toArray(),
                    [
                        'float_icon_url'  => $path
                    ]
                );
            }else{
                $webFooterData = array_merge(
                    $request->toArray()
                );
            }

            $detail_left = $request->content_left;
            $detail_right = $request->content_right;

            $dom_left = new \domdocument();
            $searchPageLeft = mb_convert_encoding($detail_left, 'HTML-ENTITIES', "UTF-8");
            $dom_left->loadHtml($searchPageLeft);
            $images_left = $dom_left->getelementsbytagname('img');

            $dom_right = new \domdocument();
            $searchPageRight = mb_convert_encoding($detail_right, 'HTML-ENTITIES', "UTF-8");
            $dom_right->loadHtml($searchPageRight);
            $images_right = $dom_right->getelementsbytagname('img');

            foreach($images_left as $k => $img){
                $data = $img->getattribute('src');

                list($type, $data) = explode(';', $data);
                list($type, $data)      = explode(',', $data);

                $data = base64_decode($data);
                $image_name= time().$k.'.png';
                $path_img = 'content/'. $image_name;
                Storage::disk('webfooters')->put('content/'. $image_name, $data);

                //todo ----- arrumar os .env dos servidores
                $img->removeattribute('src');
                //production
                $src_path = env('APP_URL') . '/storage/images/webfooters/'. $path_img;
                //local test
                //$src_path = env('APP_URL') . ':8080/storage/images/webfooters/'. $path_img;
                $img->setattribute('class', 'img-content');
                $img->setattribute('src', $src_path);
            }


            foreach($images_right as $k => $img){
                $data = $img->getattribute('src');

                list($type, $data) = explode(';', $data);
                list($type, $data)      = explode(',', $data);

                $data = base64_decode($data);
                $image_name= time().$k.'.png';
                $path_img = 'content/'. $image_name;
                Storage::disk('webfooters')->put('content/'. $image_name, $data);

                //todo ----- arrumar os .env dos servidores
                $img->removeattribute('src');
                //production
                $src_path = env('APP_URL') . '/storage/images/webfooters/'. $path_img;
                //local test
                //$src_path = env('APP_URL') . ':8000/storage/images/webfooters/'. $path_img;
                $img->setattribute('class', 'img-content');
                $img->setattribute('src', $src_path);
            }

            $detail_left = $dom_left->savehtml();
            $detail_right = $dom_right->savehtml();

            $webFooterData['content_left'] = $detail_left;
            $webFooterData['content_right'] = $detail_right;

            $this->webFooterCreateService->create($webFooterData);

            flash('Notícia criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($web_footer_id)
    {

        if (! Gate::allows('Ver e Listar WebFooter')) {
            return view('pages.not-authorized');
        }

        try{
            $web_footer = $this->webFooterService->show($web_footer_id);

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $web_footers = WebFooter::all();

            return view('admin.webfooter.show', compact('web_footer', 'web_footers', 'unit', 'copyright' ));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a WebFooter!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        Request $request, $web_footer_id
    ){
        if (! Gate::allows('Editar WebFooter')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $web_footer_old = WebFooter::find($web_footer_id);
            //for server and local unlink
            $old_path = array("https://arraial.rj.gov.br/storage/images/webfooters/");
            //$old_path = array("http://localhost:8000/storage/images/webfooters/");


            if(isset($request['float_icon_url'])){

                $request->validate([
                    'float_icon_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path = Storage::disk('webfooters')->put('icons', $request->file( key:'float_icon_url'));

                $webFooterData = array_merge(
                    $request->toArray(),
                    [
                        'float_icon_url'  => $path
                    ]
                );
            }else{
                $webFooterData = array_merge(
                    $request->toArray()
                );
            }

            //unlinking old images
            $detail_left_old = $web_footer_old->content_left;
            $detail_right_old = $web_footer_old->content_right;

            $dom_content_left_old = new \domdocument();
            $searchPageLeftOld = mb_convert_encoding($detail_left_old, 'HTML-ENTITIES', "UTF-8");
            $dom_content_left_old->loadHtml($searchPageLeftOld);
            $images_content_left_old = $dom_content_left_old->getelementsbytagname('img');

            $dom_content_right_old = new \domdocument();
            $searchPageRightOld = mb_convert_encoding($detail_right_old, 'HTML-ENTITIES', "UTF-8");
            $dom_content_right_old->loadHtml($searchPageRightOld);
            $images_content_right_old = $dom_content_right_old->getelementsbytagname('img');

            //saving new images
            $detail_left = $request->content_left;
            $detail_right = $request->content_right;

            $dom_left = new \domdocument();
            $searchPageLeft = mb_convert_encoding($detail_left, 'HTML-ENTITIES', "UTF-8");
            $dom_left->loadHtml($searchPageLeft);
            $images_left = $dom_left->getelementsbytagname('img');

            $dom_right = new \domdocument();
            $searchPageRight = mb_convert_encoding($detail_right, 'HTML-ENTITIES', "UTF-8");
            $dom_right->loadHtml($searchPageRight);
            $images_right = $dom_right->getelementsbytagname('img');

            //deleting images old
            foreach($images_content_left_old as $k => $img_old){
                $path_for_unlink = $img_old->getattribute('src');
                $path_for_unlink = str_replace($old_path, "", $path_for_unlink);
                $verification = true;
                foreach($images_left as $k => $img){
                    $data = $img->getattribute('src');
                    $data = str_replace($old_path, "", $data);
                    if($path_for_unlink == $data){
                        $verification = false;
                        break;
                    }
                }
                if($verification){
                    Storage::disk('webfooters')->delete($path_for_unlink);
                }
            }

            foreach($images_content_right_old as $k => $img_old){
                $path_for_unlink = $img_old->getattribute('src');
                $path_for_unlink = str_replace($old_path, "", $path_for_unlink);
                $verification = true;
                foreach($images_right as $k => $img){
                    $data = $img->getattribute('src');
                    $data = str_replace($old_path, "", $data);
                    if($path_for_unlink == $data){
                        $verification = false;
                        break;
                    }
                }
                if($verification){
                    Storage::disk('webfooters')->delete($path_for_unlink);
                }
            }

            //saving images
            foreach($images_left as $k => $img){
                $data = $img->getattribute('src');

                list($type, $data) = explode(';', $data);
                list($type, $data)      = explode(',', $data);

                $data = base64_decode($data);
                $image_name= time().$k.'.png';
                $path_img = 'content/'. $image_name;
                Storage::disk('webfooters')->put('content/'. $image_name, $data);

                //todo ----- arrumar os .env dos servidores
                $img->removeattribute('src');
                //production
                $src_path = env('APP_URL') . '/storage/images/webfooters/'. $path_img;
                //local test
                //$src_path = env('APP_URL') . ':8000/storage/images/webfooters/'. $path_img;
                $img->setattribute('class', 'img-content');
                $img->setattribute('src', $src_path);
            }


            foreach($images_right as $k => $img){
                $data = $img->getattribute('src');

                list($type, $data) = explode(';', $data);
                list($type, $data)      = explode(',', $data);

                $data = base64_decode($data);
                $image_name= time().$k.'.png';
                $path_img = 'content/'. $image_name;
                Storage::disk('webfooters')->put('content/'. $image_name, $data);

                //todo ----- arrumar os .env dos servidores
                $img->removeattribute('src');
                //production
                $src_path = env('APP_URL') . '/storage/images/webfooters/'. $path_img;
                //local test
                //$src_path = env('APP_URL') . ':8000/storage/images/webfooters/'. $path_img;
                $img->setattribute('class', 'img-content');
                $img->setattribute('src', $src_path);
            }

            $detail_left = $dom_left->savehtml();
            $detail_right = $dom_right->savehtml();

            $webFooterData['content_left'] = $detail_left;
            $webFooterData['content_right'] = $detail_right;

            $this->webFooterUpdateService->update($webFooterData, $web_footer_id);

            flash('Web Footer editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($web_footer_id)
    {

        if (! Gate::allows('Deletar WebFooter')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = WebFooter::find($web_footer_id);
            $for_delete->delete();
            flash('Web Footer deletado com sucesso!')->success();
            return redirect('/webfooters');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Web Footer!')->error();
            return redirect()->back()->withInput();
        }
    }
}
