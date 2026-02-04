<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegislationCategory;
use App\Http\Requests\LegislationCategoryRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\LegislationCategoryService;
use App\Services\LegislationCategoryCreateService;
use App\Services\LegislationCategoryUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LegislationCategoryController extends Controller
{

    public function __construct(
        protected LegislationCategoryService $legislationCategoryService,
        protected LegislationCategoryCreateService $legislationCategoryCreateService,
        protected LegislationCategoryUpdateService $legislationCategoryUpdateService,
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

            $legislation_categories = LegislationCategory::with('legislations')->latest()->get();
            return view('admin.legislation.category_index', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'legislation_categories'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Assuntos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        LegislationCategoryRequest $request
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
            $this->legislationCategoryCreateService->create($fileData);

            flash('Categoria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($category_id)
    {
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $legislation_categories = LegislationCategory::with('legislations')->latest()->get();
            $category_selected = $this->legislationCategoryService->show($category_id);
            return view('admin.legislation.category_show', compact('category_selected', 'legislation_categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        LegislationCategoryRequest $request, $category_id
    ){
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->legislationCategoryUpdateService->update($request->toArray(), $category_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($legislation_category)
    {
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $category = LegislationCategory::find($legislation_category);
            $category->delete();
            flash('Categoria deletada com sucesso!')->success();
            return redirect('/legislacao_categorias');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
