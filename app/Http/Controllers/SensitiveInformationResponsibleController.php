<?php

namespace App\Http\Controllers;

use App\Models\SensitiveInformationResponsible;
use App\Http\Requests\SensitiveInformationResponsibleRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\SensitiveInformationResponsibleService;
use App\Services\SensitiveInformationResponsibleCreateService;
use App\Services\SensitiveInformationResponsibleUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SensitiveInformationResponsibleController extends Controller{

    public function __construct(
        protected SensitiveInformationResponsibleService $projectResponsibleService,
        protected SensitiveInformationResponsibleCreateService $projectResponsibleCreateService,
        protected SensitiveInformationResponsibleUpdateService $projectResponsibleUpdateService,
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

        $responsibles = SensitiveInformationResponsible::with('projects')->latest()->get();
        return view('admin.sensitive_information.responsible_index', ['pageConfigs' => $pageConfigs], compact('responsibles', 'unit', 'copyright'));
    } catch (\Throwable $throwable) {
        flash('Erro ao procurar os Responsáveis Cadastrados!')->error();
        return redirect()->back()->withInput();
    }
}

public function store(
    SensitiveInformationResponsibleRequest $request
){
    if (! Gate::allows('Criar Projetos')) {
        return view('pages.not-authorized');
    }
    
    try {
        DB::beginTransaction();
        $this->projectResponsibleCreateService->create($request->toArray());

        flash('Responsável criado com sucesso!')->success();
        DB::commit();
        return redirect()->back();
    }catch (\Throwable $throwable){
        DB::rollBack();
        flash('Erro Cadastrar!')->error();
        return redirect()->back()->withInput();
    }
}

public function show($responsible_id)
{
    if (! Gate::allows('Ver e Listar Projetos')) {
        return view('pages.not-authorized');
    }

    try{
        $responsibles = SensitiveInformationResponsible::with('projects')->latest()->get();
        $responsible_selected = $this->projectResponsibleService->show($responsible_id);
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('admin.sensitive_information.responsible_show', compact('responsible_selected', 'responsibles', 'unit', 'copyright'));
    } catch (\Exception $exception) {
        flash('Erro ao buscar o Responsável!')->error();
        return redirect()->back()->withInput();
    }
}

public function update(
    SensitiveInformationResponsibleRequest $request, $responsible_id
){
    if (! Gate::allows('Editar Projetos')) {
        return view('pages.not-authorized');
    }
    try {
        DB::beginTransaction();
        $this->projectResponsibleUpdateService->update($request->toArray(), $responsible_id);

        flash('Responsibleo editado com sucesso!')->success();
        DB::commit();
        return redirect()->back();
    }catch (\Throwable $throwable){
        DB::rollBack();
        flash('Erro ao editar!')->error();
        return redirect()->back()->withInput();
    }
}

public function destroy($project_responsible)
{
    if (! Gate::allows('Deletar Projetos')) {
        return view('pages.not-authorized');
    }

    try{
        $for_delete = SensitiveInformationResponsible::find($project_responsible);
        $for_delete->delete();
        flash('Responsável deletado com sucesso!')->success();
        return redirect('/info_sensiveis_responsaveis');
    } catch (\Exception $exception) {
        flash('Erro ao deletar o Responsável!')->error();
        return redirect()->back()->withInput();
    }
}
}
