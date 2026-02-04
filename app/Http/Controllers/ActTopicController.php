<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActTopic;
use App\Http\Requests\ActTopicRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\ActTopicService;
use App\Services\ActTopicCreateService;
use App\Services\ActTopicUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ActTopicController extends Controller
{

    public function __construct(
        protected ActTopicService $actTopicService,
        protected ActTopicCreateService $actTopicCreateService,
        protected ActTopicUpdateService $actTopicUpdateService,
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

            return view('admin.official_diary.act_topic_index', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'act_topics'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        ActTopicRequest $request
    ){
        if (! Gate::allows('Criar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->actTopicCreateService->create($request->toArray());

            flash('Categoria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($act_topic_id)
    {
        if (! Gate::allows('Ver e Listar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $act_topic_selected = ActTopic::find($act_topic_id);

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

            return view('admin.official_diary.act_topic_show', compact('act_topic_selected', 'act_topics', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        ActTopicRequest $request, $act_topic_id
    ){
        if (! Gate::allows('Editar Diário Oficial')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->actTopicUpdateService->update($request->toArray(), $act_topic_id);

            flash('Tópido do Ato editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($act_topic)
    {
        if (! Gate::allows('Deletar Diário Oficial')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = ActTopic::find($act_topic);
            $for_delete->delete();
            flash('Tópico do Ato deletado com sucesso!')->success();
            return redirect('/ato_topicos');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Modalidade!')->error();
            return redirect()->back()->withInput();
        }
    }

}
