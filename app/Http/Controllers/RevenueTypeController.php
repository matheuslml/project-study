<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Services\RevenueTypeService;
use App\Services\RevenueTypeCreateService;
use App\Services\RevenueTypeUpdateService;
use App\Http\Requests\RevenueTypeRequest;
use App\Models\RevenueType;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Support\Facades\Gate;

class RevenueTypeController extends Controller
{
    public function __construct(
        protected RevenueTypeService $revenueTypeService,
        protected RevenueTypeCreateService $revenueTypeCreateService,
        protected RevenueTypeUpdateService $revenueTypeUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $revenue_types = RevenueType::with('revenues')->latest()->get();
            return view('admin.revenue.type_index', ['pageConfigs' => $pageConfigs], compact('revenue_types', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Acessos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        RevenueTypeRequest $request
    ){
        if (! Gate::allows('Editar Receitas')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->revenueTypeCreateService->create($request->toArray());

            flash('Tipo de Acesso criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($type_id)
    {
        if (! Gate::allows('Editar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $revenue_types = RevenueType::with('revenues')->latest()->get();
            $type_selected = $this->revenueTypeService->show($type_id);
            return view('admin.revenue.type_show', compact('type_selected', 'revenue_types', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        RevenueTypeRequest $request, $type_id
    ){
        if (! Gate::allows('Editar Receitas')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->revenueTypeUpdateService->update($request->toArray(), $type_id);

            flash('Tipo de Acesso editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($type)
    {
        if (! Gate::allows('Editar Receitas')) {
            return view('pages.not-authorized');
        }

        try{
            $type_type = RevenueType::find($type);
            $type_type->delete();
            $pageConfigs = ['pageHeader' => false];

            $revenue_types = RevenueType::with('revenues')->latest()->get();
            return view('admin.revenue.type_index', ['pageConfigs' => $pageConfigs], compact('revenue_types'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }



}
