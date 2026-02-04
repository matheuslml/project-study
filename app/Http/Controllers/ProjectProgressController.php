<?php

namespace App\Http\Controllers;


use App\Models\ProjectProgress;
use App\Http\Requests\ProjectProgressRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Project;
use App\Services\ProjectProgressService;
use App\Services\ProjectProgressCreateService;
use App\Services\ProjectProgressUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ProjectProgressController extends Controller
    {

        public function __construct(
            protected ProjectProgressService $projectProgressService,
            protected ProjectProgressCreateService $projectProgressCreateService,
            protected ProjectProgressUpdateService $projectProgressUpdateService,
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

                $projects = Project::orderBy('title', 'asc')->get();
                $progresses = ProjectProgress::with('project')
                                            ->latest()
                                            ->get();
                return view('admin.project.progress_index', ['pageConfigs' => $pageConfigs], compact('projects', 'progresses', 'unit', 'copyright'));
            } catch (\Throwable $throwable) {
                flash('Erro ao procurar as Progressos Cadastrados!')->error();
                return redirect()->back()->withInput();
            }
        }

        public function store(
            ProjectProgressRequest $request
        ){

            if (! Gate::allows('Criar Projetos')) {
                return view('pages.not-authorized');
            }
            try {
                DB::beginTransaction();

                $projectData = $request->toArray();

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
                    Storage::disk('project_progresses')->put('content/'. $image_name, $data);

                    //todo ----- arrumar os .env dos servidores
                    $img->removeattribute('src');
                    //production
                    $src_path = env('APP_URL') . '/storage/images/projects/progresses/'. $path_img;
                    //local test
                    //$src_path = env('APP_URL') . ':8000/storage/images/projects/progresses/'. $path_img;
                    $img->setattribute('class', 'img-content');
                    $img->setattribute('src', $src_path);
                }

                $detail = $dom->savehtml();

                $projectData['content'] = $detail;

                $this->projectProgressCreateService->create($projectData);

                flash('Progresso criado com sucesso!')->success();
                DB::commit();
                return redirect()->back();
            }catch (\Throwable $throwable){
                DB::rollBack();
                flash('Erro Cadastrar!')->error();
                return redirect()->back()->withInput();
            }
        }

        public function show($projectProgress_id)
        {

            if (! Gate::allows('Ver e Listar Projetos')) {
                return view('pages.not-authorized');
            }

            try{

                $progresses = ProjectProgress::with('project')
                                            ->latest()
                                            ->get();
                $progress_selected = ProjectProgress::find($projectProgress_id);

                $unit = Unit::where('web', true)->first();
                $copyright = Copyright::where('status', 'PUBLISHED')->first();

                $projects = Project::orderBy('title', 'asc')->get();

                return view('admin.project.progress_show', compact('progress_selected', 'projects', 'unit', 'copyright', 'progresses' ));
            } catch (\Exception $exception) {
                flash('Erro ao buscar a Progresso!')->error();
                return redirect()->back()->withInput();
            }
        }

        public function update(
            ProjectProgressRequest $request, $project_progress_id
        ){
            if (! Gate::allows('Editar Projetos')) {
                return view('pages.not-authorized');
            }
            try {
                DB::beginTransaction();

                $projectProgress_old = ProjectProgress::find($project_progress_id);
                //for server and local unlink
                $old_path = array("https://arraial.rj.gov.br/storage/images/projects/progresses/");
                //$old_path = array("http://localhost:8000/storage/images/projects/progresses/");


                $projectProgressData = $request->toArray();

                //unlinking old images
                $detail_old = $projectProgress_old->body;
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
                        Storage::disk('project_Progresss')->delete($path_for_unlink);
                    }
                }

                //todo fazer o apagar iagens antigas
                //tem que buscar a notíca antiga e apagar todas as imagens do storage e subir novas
                //todo fazer verificação de antigas apagas e deletar elas manter as antigas corretas
                foreach($images as $k => $img){
                    $data = $img->getattribute('src');
                    $path_for_update = str_replace($old_path, "", $data);
                    if (!(Storage::disk('project_progresses')->exists($path_for_update))) {
                        list($type, $data) = explode(';', $data);
                        list($type, $data)      = explode(',', $data);

                        $data = base64_decode($data);
                        $image_name= time().$k.'.png';
                        $path_img = 'content/'. $image_name;
                        Storage::disk('project_progresses')->put('content/'. $image_name, $data);
                        //todo ----- arrumar os .env dos servidores
                        $img->removeattribute('src');
                        //production
                        $src_path = env('APP_URL') . '/storage/images/projects/progresses/'. $path_img;
                        //local test
                        //$src_path = env('APP_URL') . ':8080/storage/images/projects/progresses/'. $path_img;
                        $img->setattribute('src', $src_path);
                    }
                    $img->setattribute('class', 'img-content');
                }

                $detail = $dom->savehtml();

                $projectProgressData['content'] = $detail;

                $this->projectProgressUpdateService->update($projectProgressData, $project_progress_id);

                flash('Projeto editado com sucesso!')->success();
                DB::commit();
                return redirect()->back();
            }catch (\Throwable $throwable){
                DB::rollBack();
                flash('Erro ao editar!')->error();
                return redirect()->back()->withInput();
            }
        }

        public function destroy($project_progress_id)
        {

            if (! Gate::allows('Deletar Projetos')) {
                return view('pages.not-authorized');
            }

            try{
                $for_delete = ProjectProgress::find($project_progress_id);
                $for_delete->delete();
                flash('Progresso deletado com sucesso!')->success();
                return redirect('/projeto_progressos');
            } catch (\Exception $exception) {
                flash('Erro ao deletar o Progresso!')->error();
                return redirect()->back()->withInput();
            }
        }



}
