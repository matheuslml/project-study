<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\TagService;
use App\Services\TagCreateService;
use App\Services\TagUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{

    public function __construct(
        protected TagService $tagService,
        protected TagCreateService $tagCreateService,
        protected TagUpdateService $tagUpdateService,
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

            $tags = Tag::with('news')->latest()->get();
            return view('admin.news.tag_index', ['pageConfigs' => $pageConfigs], compact('tags', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as TAGS Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        TagRequest $request
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
            $this->tagCreateService->create($fileData);

            flash('TAG criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($tag_id)
    {
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $tags = Tag::with('news')->latest()->get();
            $tag_selected = $this->tagService->show($tag_id);
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.news.tag_show', compact('tag_selected', 'tags', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        TagRequest $request, $tag_id
    ){
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->tagUpdateService->update($request->toArray(), $tag_id);

            flash('TAG editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($tag)
    {
        if (! Gate::allows('Editar Notícias')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Tag::find($tag);
            $for_delete->delete();
            flash('TAG deletada com sucesso!')->success();
            return redirect('/noticia_tags');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a TAG!')->error();
            return redirect()->back()->withInput();
        }
    }
}
