<?php

namespace App\Http\Controllers;

use App\Models\ShortcutWeb;
use App\Services\ShortcutWebService;
use App\Services\ShortcutWebCreateService;
use App\Services\ShortcutWebUpdateService;
use App\Http\Requests\ShortcutWebRequest;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Throwable;

class ShortcutWebController extends Controller
{

    public function __construct(
        protected ShortcutWebService $shortcutWebService,
        protected ShortcutWebCreateService $shortcutWebCreateService,
        protected ShortcutWebUpdateService $shortcutWebUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Shortcut')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $shortcut_webs = ShortcutWeb::all();
            return view('admin.shortcutweb.index', ['pageConfigs' => $pageConfigs], compact('shortcut_webs', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar os Atalhos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        ShortcutWebRequest $request
    ){
        if (! Gate::allows('Editar Shortcut')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $request->validate([
                'image_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $path_image_icon = Storage::disk('shortcutweb')->put('large', $request->file( key:'image_icon'));

            $shortcutData = array_merge(
                $request->toArray(),
                [
                    'img_url'  => $path_image_icon
                ]
            );

            $this->shortcutWebCreateService->create($shortcutData);

            flash('Atalho criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($shortcutWeb_id)
    {
        if (! Gate::allows('Editar Shortcut')) {
            return view('pages.not-authorized');
        }

        try{
            $shortcut_webs = ShortcutWeb::all();
            $shortcut_web_selected = $this->shortcutWebService->show($shortcutWeb_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.shortcutweb.show', compact('shortcut_web_selected', 'shortcut_webs', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Atalho!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        ShortcutWebRequest $request, $shortcutWeb_id
    ){
        if (! Gate::allows('Editar Shortcut')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            if(isset($request['image_icon'])){
                $request->validate([
                    'image_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path_image_icon = Storage::disk('shortcutweb')->put('large', $request->file( key:'image_icon'));

                $shortcutData = array_merge(
                    $request->toArray(),
                    [
                        'img_url'  => $path_image_icon
                    ]
                );

                $this->shortcutWebUpdateService->update($shortcutData, $shortcutWeb_id);
            }else{
                $this->shortcutWebUpdateService->update($request->toArray(), $shortcutWeb_id);
            }

            flash('Atalho editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($shortcutWeb)
    {
        if (! Gate::allows('Editar Shortcut')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = ShortcutWeb::find($shortcutWeb);
            $for_delete->delete();
            flash('Atalho deletada com sucesso!')->success();
            return redirect('/web_atalhos');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar o Atalho!')->error();
            return redirect()->back()->withInput();
        }
    }
}
