<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Services\TypeAccessService;
use App\Services\TypeAccessCreateService;
use App\Services\TypeAccessUpdateService;
use App\Http\Requests\TypeAccessRequest;
use App\Models\TypeAccess;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Support\Facades\Gate;

class TypeAccessController extends Controller
{
    public function __construct(
        protected TypeAccessService $typeAccessService,
        protected TypeAccessCreateService $typeAccessCreateService,
        protected TypeAccessUpdateService $typeAccessUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

            $type_accesses = TypeAccess::with('ombudsmen')->latest()->get();
            return view('admin.ombudsman.access_index', ['pageConfigs' => $pageConfigs], compact('type_accesses', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Acessos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        TypeAccessRequest $request
    ){
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->typeAccessCreateService->create($request->toArray());

            flash('Tipo de Acesso criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($access_id)
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
            $type_accesses = TypeAccess::with('ombudsmen')->latest()->get();
            $access_selected = $this->typeAccessService->show($access_id);
            return view('admin.ombudsman.access_show', compact('access_selected', 'type_accesses', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        TypeAccessRequest $request, $access_id
    ){
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->typeAccessUpdateService->update($request->toArray(), $access_id);

            flash('Tipo de Acesso editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($access)
    {
        if (! Gate::allows('Deletar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $type_access = TypeAccess::find($access);
            $type_access->delete();
            $pageConfigs = ['pageHeader' => false];

            $type_accesses = TypeAccess::with('ombudsmen')->latest()->get();
            flash('Tipo de Acesso deletado com sucesso!')->success();
            return view('admin.organization.index', ['pageConfigs' => $pageConfigs], compact('organizations'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    //site

    public function select()
    {
        $type_accesses = TypeAccess::all();
        return view('web.ouvidoria_access', compact('type_accesses'));
    }



}
