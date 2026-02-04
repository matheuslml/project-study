<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\ProjectCategory;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\ProjectProgress;
use App\Models\ProjectResponsible;
use App\Models\WebFooter;
use App\Services\ProjectService;
use App\Services\ProjectCreateService;
use App\Services\ProjectUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Throwable;

class ProjectController extends Controller
{

    public function __construct(
        protected ProjectService $projectService,
        protected ProjectCreateService $projectCreateService,
        protected ProjectUpdateService $projectUpdateService,
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

            $projects = Project::with('category')
                                        ->latest()
                                        ->get();
            return view('admin.project.index', ['pageConfigs' => $pageConfigs], compact('projects', 'unit', 'copyright'));
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

        $categories = ProjectCategory::with('projects')->orderBy('title', 'asc')->get();
        $responsibles = ProjectResponsible::with('projects')->orderBy('title', 'asc')->get();

        return view('admin.project.create', ['pageConfigs' => $pageConfigs], compact('categories', 'unit', 'copyright', 'responsibles'));

    }

    public function store(
        ProjectRequest $request
    ){

        if (! Gate::allows('Criar Projetos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $currentuuid = Auth::user()->id;

            if(isset($request['thumb'])){

                $request->validate([
                    'title' => 'required',
                    'thumb' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path = Storage::disk('projects')->put('thumbs', $request->file( key:'thumb'));

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
                Storage::disk('projects')->put('content/'. $image_name, $data);

                //todo ----- arrumar os .env dos servidores
                $img->removeattribute('src');
                //production
                $src_path = env('APP_URL') . '/storage/images/projects/'. $path_img;
                //local test
                //$src_path = env('APP_URL') . ':8000/storage/images/projects/'. $path_img;
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

            $project = Project::find($project_id);

            $project_files = $project->files;


            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $categories = ProjectCategory::with('projects')->orderBy('title', 'asc')->get();

            $responsibles = ProjectResponsible::with('projects')->orderBy('title', 'asc')->get();
            $progresses = ProjectProgress::where('project_id', $project_id)->get();

            return view('admin.project.show', compact('progresses', 'project', 'project_files', 'categories', 'unit', 'copyright', 'responsibles'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a Projeto!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        ProjectRequest $request, $project_id
    ){
        if (! Gate::allows('Editar Projetos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $project_old = Project::find($project_id);
            //for server and local unlink
            $old_path = array("https://arraial.rj.gov.br/storage/images/projects/");
            //$old_path = array("http://localhost:8080/storage/images/projects/");
            $currentuuid = Auth::user()->id;

            if(isset($request['thumb'])){

                $request->validate([
                    'title' => 'required',
                    'thumb' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                //$path = $request->file( key:'image')->store( path: 'images/Project');
                $path = Storage::disk('projects')->put('thumbs', $request->file( key:'thumb'));

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
                    Storage::disk('projects')->delete($path_for_unlink);
                }
            }

            //todo fazer o apagar iagens antigas
            //tem que buscar a notíca antiga e apagar todas as imagens do storage e subir novas
            //todo fazer verificação de antigas apagas e deletar elas manter as antigas corretas
            foreach($images as $k => $img){
                $data = $img->getattribute('src');
                $path_for_update = str_replace($old_path, "", $data);
                if (!(Storage::disk('projects')->exists($path_for_update))) {
                    list($type, $data) = explode(';', $data);
                    list($type, $data)      = explode(',', $data);

                    $data = base64_decode($data);
                    $image_name= time().$k.'.png';
                    $path_img = 'content/'. $image_name;
                    Storage::disk('projects')->put('content/'. $image_name, $data);
                    //todo ----- arrumar os .env dos servidores
                    $img->removeattribute('src');
                    //production
                    $src_path = env('APP_URL') . '/storage/images/projects/'. $path_img;
                    //local test
                    //$src_path = env('APP_URL') . ':8080/storage/images/projects/'. $path_img;
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
            $for_delete = Project::find($project_id);
            $for_delete->delete();
            flash('Projeto deletado com sucesso!')->success();
            return redirect('/projetos');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Projeto!')->error();
            return redirect()->back()->withInput();
        }
    }
    //web


    public function web_category_show($category_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = Project::where('status', 'PUBLISHED')->where('category_id', $category_id)->orderBy('id', 'desc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        $category_selected = ProjectCategory::find($category_id);
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.project.index', compact('banner', 'projects', 'categories', 'category_selected', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_index()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = ProjectCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.project.index', compact('banner', 'projects', 'categories', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_index_filter_title(Request $request)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = Project::filter($request->all())->where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = ProjectCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.project.index', compact('banner', 'projects', 'categories', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_index_filter_category($category_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = Project::where('status', 'PUBLISHED')->where('category_id', $category_id)->orderBy('id', 'desc')->paginate(3);
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = ProjectCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.project.index', compact('banner', 'projects', 'categories', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_index_filter_tag($tag_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $projects = Project::with('tags')->where('status', 'PUBLISHED')->where('tags->id', $tag_id)->orderBy('id', 'desc')->paginate(3);
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 3)->first();
        $categories = ProjectCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.project.index', compact('banner', 'projects', 'categories', 'unit', 'copyright', 'web_footer', 'institucional_pages', 'service_pages'));
    }

    public function web_show($project_id)
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $project = Project::find($project_id);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $categories = ProjectCategory::all();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        return view('web.project.show', compact('projects', 'project', 'unit', 'copyright', 'web_footer', 'categories', 'institucional_pages', 'service_pages'));
    }
}
