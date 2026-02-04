<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Act;
use App\Http\Requests\ActRequest;
use App\Models\ActTopic;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\ActService;
use App\Services\ActCreateService;
use App\Services\ActUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ActController extends Controller
{

    public function __construct(
        protected ActService $actService,
        protected ActCreateService $actCreateService,
        protected ActUpdateService $actUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $acts = Act::orderBy('created_at', 'desc')->get();
            $pendents = count(Act::where('status', 'PENDING')->orWhere('status', 'DRAFT')->get());

            return view('admin.official_diary.act_index', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'acts', 'pendents'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function create(): View
    {
        if (! Gate::allows('Criar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false];
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $act_topics = [];
        $array_temp = [];
        $array_temp2 = [];

        $base_act_topics = ActTopic::whereNull('act_topic_id')->orderBy('title', 'asc')->get();

        foreach($base_act_topics as $topic){
            $array_temp = array("id" => $topic->id, "act_topic_id" => $topic->act_topic_id, "title" => $topic->title, "status" => $topic->status, "created_at" => $topic->created_at);
            $topic_act_topics = ActTopic::where('act_topic_id', $topic->id)->orderBy('title', 'asc')->get();
            array_push($act_topics, $array_temp);
            foreach($topic_act_topics as $topic_2){
                $array_temp2 = array("id" => $topic_2->id, "act_topic_id" => $topic_2->act_topic_id, "title" => $topic->title . ' / ' . $topic_2->title, "status" => $topic_2->status, "created_at" => $topic_2->created_at);
                array_push($act_topics, $array_temp2);
            }
        }

        return view('admin.official_diary.act_create', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'act_topics'));

    }

    public function store(
        ActRequest $request
    ){
        if (! Gate::allows('Editar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();

            $actData = $request->toArray();

            if($request['content'] != null){
                $detail = $request->content;

                $dom = new \domdocument();
                $searchPage = mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8");
                $dom->loadHtml($searchPage);
                $images = $dom->getelementsbytagname('img');

                foreach($images as $k => $img){
                    $data = $img->getattribute('src');

                    list($type, $data) = explode(';', $data);
                    list($type, $data) = explode(',', $data);

                    $data = base64_decode($data);
                    $image_name= time().$k.'.png';
                    $path_img = 'acts/contents/'. $image_name;
                    //dd($image_name);
                    Storage::disk('official_diaries')->put('acts/contents/'. $image_name, $data);

                    //todo ----- arrumar os .env dos servidores
                    $img->removeattribute('src');
                    //production
                    $src_path = env('APP_URL') . '/storage/images/official_diaries/'. $path_img;
                    //local test
                    //$src_path = env('APP_URL') . ':8080//storage/images/official_diaries/'. $path_img;
                    $img->setattribute('class', 'img-content');
                    $img->setattribute('src', $src_path);
                }

                $detail = $dom->savehtml();

                $actData['content'] = $detail;
            }else{
                $actData['content'] = '';
            }

            $this->actCreateService->create($request->toArray());

            flash('O Ato foi criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($act_id)
    {
        if (! Gate::allows('Editar Diário Oficial')) {
            return view('pages.not-authorized');
        }
        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $act = Act::find($act_id);

            $act_topics = [];
            $array_temp = [];
            $array_temp2 = [];

            $base_act_topics = ActTopic::whereNull('act_topic_id')->orderBy('title', 'asc')->get();

            foreach($base_act_topics as $topic){
                $array_temp = array("id" => $topic->id, "act_topic_id" => $topic->act_topic_id, "title" => $topic->title, "status" => $topic->status, "created_at" => $topic->created_at);
                $topic_act_topics = ActTopic::where('act_topic_id', $topic->id)->orderBy('title', 'asc')->get();
                array_push($act_topics, $array_temp);
                foreach($topic_act_topics as $topic_2){
                    $array_temp2 = array("id" => $topic_2->id, "act_topic_id" => $topic_2->act_topic_id, "title" => $topic->title . ' / ' . $topic_2->title, "status" => $topic_2->status, "created_at" => $topic_2->created_at);
                    array_push($act_topics, $array_temp2);
                }
            }

            return view('admin.official_diary.act_show', compact('act', 'act_topics', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        ActRequest $request, $act_id
    ){
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            //dd($request);
            DB::beginTransaction();

                $actData = $request->toArray();
                $act_old = Act::find($act_id);
                //for server and local unlink
                //falta o deletar imagens
                $old_path = array("https://arraial.rj.gov.br/storage/images/news/");
                //$old_path = array("http://localhost:8000/storage/images/official_diaries/");

                if($request['content'] != null){
                    //unlinking old images
                    $detail_old = $act_old->body;
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
                            Storage::disk('official_diaries')->delete($path_for_unlink);
                        }
                    }

                    foreach($images as $k => $img){
                        $data = $img->getattribute('src');
                        $path_for_update = str_replace($old_path, "", $data);
                        if (!(Storage::disk('official_diaries')->exists($path_for_update))) {
                            list($type, $data) = explode(';', $data);
                            list($type, $data) = explode(',', $data);

                            $data = base64_decode($data);
                            $image_name= time().$k.'.png';
                            $path_img = 'acts/contents/'. $image_name;
                            Storage::disk('official_diaries')->put('acts/contents/'. $image_name, $data);
                            //todo ----- arrumar os .env dos servidores
                            $img->removeattribute('src');
                            //production
                            $src_path = env('APP_URL') . ':storage/images/official_diaries/'. $path_img;
                            //local test
                            //$src_path = env('APP_URL') . ':8080/storage/images/news/'. $path_img;
                            $img->setattribute('class', 'img-content');
                            $img->setattribute('src', $src_path);
                        }
                    }

                    $detail = $dom->savehtml();

                    $actData['content'] = $detail;
                }else{
                    $actData['content'] = '';
                }

                $this->actUpdateService->update($actData, $act_id);

            flash('O Ato foi editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($act)
    {
        if (! Gate::allows('Deletar Diário Oficial')) {
            return view('pages.not-authorized');
        }
        try{
            $for_delete = Act::find($act);
            $for_delete->delete();
            flash('Ato deletado com sucesso!')->success();
            return redirect('/atos');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Modalidade!')->error();
            return redirect()->back()->withInput();
        }
    }
}
