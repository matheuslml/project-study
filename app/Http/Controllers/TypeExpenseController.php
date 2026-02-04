<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Services\TypeExpenseService;
use App\Services\TypeExpenseCreateService;
use App\Services\TypeExpenseUpdateService;
use App\Http\Requests\TypeExpenseRequest;
use App\Models\TypeExpense;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Support\Facades\Gate;

class TypeExpenseController extends Controller
{
    public function __construct(
        protected TypeExpenseService $typeExpenseService,
        protected TypeExpenseCreateService $typeExpenseCreateService,
        protected TypeExpenseUpdateService $typeExpenseUpdateService,
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

            $type_expenses = TypeExpense::with('expenses')->latest()->get();
            return view('admin.expense.type_index', ['pageConfigs' => $pageConfigs], compact('type_expenses', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Receitas Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        TypeExpenseRequest $request
    ){
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->typeExpenseCreateService->create($request->toArray());

            flash('Tipo de Receita criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo Tipo de Receita!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($type_id)
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
            $type_expenses = TypeExpense::with('expenses')->latest()->get();
            $type_selected = $this->typeExpenseService->show($type_id);
            return view('admin.expense.type_show', compact('type_selected', 'type_expenses', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Receita!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        TypeExpenseRequest $request, $type_id
    ){
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->typeExpenseUpdateService->update($request->toArray(), $type_id);

            flash('Tipo de Receita editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o Tipo de Receita!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($type)
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $type = TypeExpense::find($type);
            $type->delete();
            $pageConfigs = ['pageHeader' => false];

            $type_expenses = TypeExpense::with('expenses')->latest()->get();
            return view('admin.expense.type_index', ['pageConfigs' => $pageConfigs], compact('type_expenses'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Tipo de Receita!')->error();
            return redirect()->back()->withInput();
        }
    }



}
