<?php

namespace App\Http\Controllers;

use App\Http\Requests\CopyrightRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\CopyrightService;
use App\Services\CopyrightCreateService;
use App\Services\CopyrightUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Throwable;

class CopyrightController extends Controller
{
    public function __construct(
        protected CopyrightService $copyrightService,
        protected CopyrightCreateService $copyrightCreateService,
        protected CopyrightUpdateService $copyrightUpdateService,
    ){}

    public function index(): View
    {

        if (! Gate::allows('Ver e Listar Copyright')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $copyrights = Copyright::all();
            return view('admin.copyright.index', ['pageConfigs' => $pageConfigs], compact('copyrights', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as CopyRights Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        CopyrightRequest $request
    ){

        if (! Gate::allows('Criar Copyright')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();

            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $path_logo = Storage::disk('copyrights')->put('logo', $request->file( key:'logo'));

            $copyrightData = array_merge(
                $request->toArray(),
                [
                    'logo_url'  => $path_logo
                ]
            );

            $this->copyrightCreateService->create($copyrightData);

            flash('copyright criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($copyright_id)
    {

        if (! Gate::allows('Ver e Listar Copyright')) {
            return view('pages.not-authorized');
        }

        try{
            $copyright_selected = $this->copyrightService->show($copyright_id);


            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.copyright.show', compact('copyright_selected', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a copyright!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        CopyrightRequest $request, $copyright_id
    ){

        if (! Gate::allows('Editar Copyright')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();

            if(isset($request['logo'])){

                $copyright_old = Copyright::find($copyright_id);

                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path_logo = Storage::disk('copyrights')->put('logo', $request->file( key:'logo'));

                $copyrightData = array_merge(
                    $request->toArray(),
                    [
                        'logo_url'  => $path_logo
                    ]
                );

                $this->copyrightUpdateService->update($copyrightData, $copyright_id);

                Storage::disk('copyrights')->delete($copyright_old->logo_url);
            }
            else{
                $this->copyrightUpdateService->update($request->toArray(), $copyright_id);
            }

            flash('copyright editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($copyright_id)
    {

        if (! Gate::allows('Deletar Copyright')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Copyright::find($copyright_id);
            $for_delete->delete();
            flash('copyright deletada com sucesso!')->success();
            return redirect('/Copyright_imagens');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Copyright!')->error();
            return redirect()->back()->withInput();
        }
    }
}
