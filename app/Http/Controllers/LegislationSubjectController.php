<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegislationSubject;
use App\Http\Requests\LegislationSubjectRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\LegislationSubjectService;
use App\Services\LegislationSubjectCreateService;
use App\Services\LegislationSubjectUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LegislationSubjectController extends Controller
{

    public function __construct(
        protected LegislationSubjectService $legislationSubjectService,
        protected LegislationSubjectCreateService $legislationSubjectCreateService,
        protected LegislationSubjectUpdateService $legislationSubjectUpdateService,
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

            $legislation_subjects = LegislationSubject::with('legislations')->latest()->get();
            return view('admin.legislation.subject_index', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'legislation_subjects'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        LegislationSubjectRequest $request
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
            $this->legislationSubjectCreateService->create($fileData);

            flash('Assunto criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($subject_id)
    {

        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
            $legislation_subjects = LegislationSubject::with('legislations')->latest()->get();
            $subject_selected = $this->legislationSubjectService->show($subject_id);
            return view('admin.legislation.subject_show', compact('subject_selected', 'legislation_subjects', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        LegislationSubjectRequest $request, $subject_id
    ){

        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->legislationSubjectUpdateService->update($request->toArray(), $subject_id);


            flash('Assunto editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($legislation_subject)
    {

        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $subject = LegislationSubject::find($legislation_subject);
            $subject->delete();
            flash('Assunto deletado com sucesso!')->success();
            return redirect('/legislacao_assuntos');
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Assunto!')->error();
            return redirect()->back()->withInput();
        }
    }
}
