<?php

namespace App\Http\Controllers;


use App\Models\ProjectMedia;
use App\Http\Requests\ProjectMediaRequest;
use App\Services\ProjectMediaService;
use App\Services\ProjectMediaCreateService;
use App\Services\ProjectMediaUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProjectMediaController extends Controller
{public function __construct(
    protected ProjectMediaService $projectMediaService,
    protected ProjectMediaCreateService $projectMediaCreateService,
    protected ProjectMediaUpdateService $projectMediaUpdateService,
){}

public function store(
    ProjectMediaRequest $request
){
    if (! Gate::allows('Editar Projetos')) {
        return view('pages.not-authorized');
    }
    try {
        DB::beginTransaction();
        $request->validate([
            'media_project' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $url = Storage::disk('projects')->put('media', $request->file( key:'media_project'));

        $fileData = array_merge(
            $request->toArray(),
            [
                'url'  => $url
            ]
        );

        $this->projectMediaCreateService->create($fileData);
        
        flash('Media criada com sucesso!')->success();
        DB::commit();
        return redirect()->back();
    }catch (\Throwable $throwable){
        DB::rollBack();
        flash('Erro Cadastrar!')->error();
        return redirect()->back()->withInput();
    }
}

public function destroy($projectMedia)
{
    if (! Gate::allows('Editar Projetos')) {
        return view('pages.not-authorized');
    }

    try{
        $for_delete = ProjectMedia::find($projectMedia);
        Storage::disk('projects')->delete($for_delete->url);
        $for_delete->delete();
        flash('Media deletada com sucesso!')->success();
        return redirect()->back();
    } catch (\Exception $exception) {
        flash('Erro ao deletar a Media!')->error();
        return redirect()->back()->withInput();
    }
}
}
