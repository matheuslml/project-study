<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequestUpdate;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\WebFooter;
use App\Services\NewsService;
use App\Services\NewsCreateService;
use App\Services\NewsUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Throwable;

class NewsController extends Controller
{

    public function __construct(
        protected NewsService $newsService,
        protected NewsCreateService $newsCreateService,
        protected NewsUpdateService $newsUpdateService,
    ){}

    public function index(): View
    {

        if (! Gate::allows('Ver e Listar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $news = News::with('tags')
                                        ->latest()
                                        ->get();
            return view('admin.news.news_index', ['pageConfigs' => $pageConfigs], compact('news', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Notícias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $tags = Tag::with('news')->orderBy('tag', 'asc')->get();
        $categories = Category::with('news')->orderBy('title', 'asc')->get();

        return view('admin.news.news_create', ['pageConfigs' => $pageConfigs], compact('tags', 'categories', 'unit', 'copyright'));

    }

    public function store(
        NewsRequest $request
    )
    {
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();

            $currentuuid = Auth::user()->id;

            if(isset($request['image'])){

                $path = Storage::disk('news')->put('thumbs', $request->file( key:'image'));

                $newsData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid,
                        'path'  => $path
                    ]
                );
            }
            else{

                $newsData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid
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
                    Storage::disk('news')->put('content/'. $image_name, $data);

                    //todo ----- arrumar os .env dos servidores
                    $img->removeattribute('src');
                    //production
                    $src_path = env('APP_URL') . '/storage/images/news/'. $path_img;
                    //local test
                    //$src_path = env('APP_URL') . ':8080/storage/images/news/'. $path_img;
                    $img->setattribute('class', 'img-content');
                    $img->setattribute('src', $src_path);
                }

                $detail = $dom->savehtml();

                $newsData['content'] = $detail;
            }else{
                $newsData['content'] = '';
            }

            $this->newsCreateService->create($newsData);

            flash('Notícia criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($news_id)
    {

        if (! Gate::allows('Ver e Listar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $news = $this->newsService->show($news_id);

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $tags = Tag::with('news')->orderBy('tag', 'asc')->get();
            $categories = Category::with('news')->orderBy('title', 'asc')->get();

            return view('admin.news.news_show', compact('news', 'tags', 'categories', 'unit', 'copyright' ));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a Notícia!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        NewsRequestUpdate $request, $news_id
    ){

        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $news_old = News::find($news_id);
            //for server and local unlink
            $old_path = array("https://arraial.rj.gov.br/storage/images/news/");
            //$old_path = array("http://localhost:8000/storage/images/news/");
            $currentuuid = Auth::user()->id;

            if(isset($request['image'])){

                $path = Storage::disk('news')->put('thumbs', $request->file( key:'image'));

                $newsData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid,
                        'path'  => $path
                    ]
                );
            }
            else{

                $newsData = array_merge(
                    $request->toArray(),
                    [
                        'user_id'  => $currentuuid
                    ]
                );

            }

            if($request['content'] != null){
                //unlinking old images
                $detail_old = $news_old->body;
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
                        Storage::disk('news')->delete($path_for_unlink);
                    }
                }

                //todo fazer o apagar iagens antigas
                //tem que buscar a notíca antiga e apagar todas as imagens do storage e subir novas
                //todo fazer verificação de antigas apagas e deletar elas manter as antigas corretas
                foreach($images as $k => $img){
                    $data = $img->getattribute('src');
                    $path_for_update = str_replace($old_path, "", $data);
                    if (!(Storage::disk('news')->exists($path_for_update))) {
                        list($type, $data) = explode(';', $data);
                        list($type, $data)      = explode(',', $data);

                        $data = base64_decode($data);
                        $image_name= time().$k.'.png';
                        $path_img = 'content/'. $image_name;
                        Storage::disk('news')->put('content/'. $image_name, $data);
                        //todo ----- arrumar os .env dos servidores
                        $img->removeattribute('src');
                        //production
                        $src_path = env('APP_URL') . '/storage/images/news/'. $path_img;
                        //local test
                        //$src_path = env('APP_URL') . ':8000/storage/images/news/'. $path_img;
                        $img->setattribute('src', $src_path);
                    }
                    $img->setattribute('class', 'img-content');
                }

                $detail = $dom->savehtml();

                $newsData['content'] = $detail;
            }else{
                $newsData['content'] = '';
            }

            $this->newsUpdateService->update($newsData, $news_id);

            flash('Notícia editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($news_id)
    {

        if (! Gate::allows('Deletar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = News::find($news_id);
            $for_delete->delete();
            flash('Notícia deletado com sucesso!')->success();
            return redirect('/noticias');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Notícia!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function web_index()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(2);
        $categories = Category::orderBy('title')->get();
        $tags = Tag::orderBy('tag')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();

        return view('web.news.index', compact('service_pages', 'institucional_pages', 'banner', 'news', 'unit', 'copyright', 'categories', 'tags', 'web_footer'));
    }

    public function web_show($new_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $new = News::find($new_id);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();


        return view('web.news.show', compact('service_pages', 'institucional_pages','unit', 'copyright', 'new', 'news', 'web_footer'));
    }


}
