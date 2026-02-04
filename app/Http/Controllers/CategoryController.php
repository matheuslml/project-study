<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\CategoryService;
use App\Services\CategoryCreateService;
use App\Services\CategoryUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    public function __construct(
        protected CategoryService $categoryService,
        protected CategoryCreateService $categoryCreateService,
        protected CategoryUpdateService $categoryUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $categories = Category::with('news')->latest()->get();
            return view('admin.news.category_index', ['pageConfigs' => $pageConfigs], compact('categories', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Categorias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        CategoryRequest $request
    ){
        if (! Gate::allows('Editar Notícias')) {
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
            $this->categoryCreateService->create($fileData);

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
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $categories = Category::with('news')->latest()->get();
            $category_selected = $this->categoryService->show($category_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.news.category_show', compact('category_selected', 'categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        CategoryRequest $request, $category_id
    ){
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->categoryUpdateService->update($request->toArray(), $category_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($category)
    {
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Category::find($category);
            $for_delete->delete();
            flash('Categoria deletada com sucesso!')->success();
            return redirect('/noticia_categorias');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
