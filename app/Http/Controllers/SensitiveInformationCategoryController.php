<?php

namespace App\Http\Controllers;


use App\Models\SensitiveInformationCategory;
use App\Http\Requests\SensitiveInformationCategoryRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\SensitiveInformationCategoryService;
use App\Services\SensitiveInformationCategoryCreateService;
use App\Services\SensitiveInformationCategoryUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SensitiveInformationCategoryController extends Controller
{


    public function __construct(
        protected SensitiveInformationCategoryService $projectCategoryService,
        protected SensitiveInformationCategoryCreateService $projectCategoryCreateService,
        protected SensitiveInformationCategoryUpdateService $projectCategoryUpdateService,
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

            $categories = SensitiveInformationCategory::with('projects')->latest()->get();
            return view('admin.sensitive_information.category_index', ['pageConfigs' => $pageConfigs], compact('categories', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Categorias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        SensitiveInformationCategoryRequest $request
    ){
        if (! Gate::allows('Criar Projetos')) {
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
            $this->projectCategoryCreateService->create($fileData);

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
        if (! Gate::allows('Ver e Listar Projetos')) {
            return view('pages.not-authorized');
        }

        try{
            $categories = SensitiveInformationCategory::with('projects')->latest()->get();
            $category_selected = $this->projectCategoryService->show($category_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.sensitive_information.category_show', compact('category_selected', 'categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        SensitiveInformationCategoryRequest $request, $category_id
    ){
        if (! Gate::allows('Editar Projetos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->projectCategoryUpdateService->update($request->toArray(), $category_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($projectcategory)
    {
        if (! Gate::allows('Deletar Projetos')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = SensitiveInformationCategory::find($projectcategory);
            $for_delete->delete();
            flash('Categoria deletada com sucesso!')->success();
            return redirect('/info_sensiveis_categorias');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
