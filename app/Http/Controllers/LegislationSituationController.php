<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegislationSituation;
use App\Http\Requests\LegislationSituationRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\LegislationSituationService;
use App\Services\LegislationSituationCreateService;
use App\Services\LegislationSituationUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LegislationSituationController extends Controller
{

    public function __construct(
        protected LegislationSituationService $legislationSituationService,
        protected LegislationSituationCreateService $legislationSituationCreateService,
        protected LegislationSituationUpdateService $legislationSituationUpdateService,
    ){}

    public function index(): View
    {


        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

            $legislation_situations = LegislationSituation::with('legislations')->latest()->get();
            return view('admin.legislation.situation_index', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'legislation_situations'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        LegislationSituationRequest $request
    ){

        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $fileData = array_merge(
                $request->toArray(),
                [
                    'active'  => 1
                ]
            );
            $this->legislationSituationCreateService->create($fileData);

            flash('Assunto criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($situation_id)
    {

        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
            $legislation_situations = LegislationSituation::with('legislations')->latest()->get();
            $situation_selected = $this->legislationSituationService->show($situation_id);
            return view('admin.legislation.situation_show', compact('situation_selected', 'legislation_situations', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        LegislationSituationRequest $request, $situation_id
    ){

        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->legislationSituationUpdateService->update($request->toArray(), $situation_id);


            flash('Assunto editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Assunto editado com sucesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($legislation_situation)
    {

        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $situation = LegislationSituation::find($legislation_situation);
            $situation->delete();
            flash('Situação deletada com sucesso!')->success();
            return redirect('/legislacao_situacoes');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a situação!')->error();
            return redirect()->back()->withInput();
        }
    }
}
