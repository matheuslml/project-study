<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Organization;
use App\Models\SocialMedia;
use App\Models\SocialMediaUnit;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;
use App\Services\UnitService;
use App\Services\UnitCreateService;
use App\Services\UnitUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    public function __construct(
        protected UnitService $unitService,
        protected UnitCreateService $unitCreateService,
        protected UnitUpdateService $unitUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Unidades')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

            $organizations = Organization::all();
            $units = $this->unitService->get();
            return view('admin.unit.index', ['pageConfigs' => $pageConfigs], compact('organizations', 'units', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Unidades Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        UnitRequest $request
    ){
        if (! Gate::allows('Criar Unidades')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            if(isset($request['logo']) && isset($request['icon'])){

                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                //$path = $request->file( key:'image')->store( path: 'images/Project');
                $path_logo = Storage::disk('units')->put('logos', $request->file( key:'logo'));
                $path_icon = Storage::disk('units')->put('icons', $request->file( key:'icon'));

                $projectData = array_merge(
                    $request->toArray(),
                    [
                        'logo'  => $path_logo,
                        'icon'  => $path_icon
                    ]
                );

                $this->unitCreateService->create($projectData);
            }
            else{
                if(isset($request['icon'])){

                    $request->validate([
                        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);

                    //$path = $request->file( key:'image')->store( path: 'images/Project');
                    $path_icon = Storage::disk('units')->put('icons', $request->file( key:'icon'));

                    $projectData = array_merge(
                        $request->toArray(),
                        [
                            'icon'  => $path_icon
                        ]
                    );
                    $this->unitCreateService->create($projectData);
                }else{
                    if(isset($request['logo'])){

                        $request->validate([
                            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);

                        //$path = $request->file( key:'image')->store( path: 'images/Project');
                        $path_logo = Storage::disk('units')->put('logos', $request->file( key:'logo'));

                        $projectData = array_merge(
                            $request->toArray(),
                            [
                                'logo'  => $path_logo
                            ]
                        );
                        $this->unitCreateService->create($projectData);
                    }else{
                        $this->unitCreateService->create($request->toArray());
                    }
                }
            }


            flash('Unidade criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova unidade!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        UnitRequest $request, $unit_id
    ){
        if (! Gate::allows('Editar Unidades')) {
            return view('pages.not-authorized');
        }
        //dd($request->all());
        try {
            DB::beginTransaction();
            if(isset($request['logo']) && isset($request['icon'])){

                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                //$path = $request->file( key:'image')->store( path: 'images/Project');
                $path_logo = Storage::disk('units')->put('logos', $request->file( key:'logo'));
                $path_icon = Storage::disk('units')->put('icons', $request->file( key:'icon'));

                $projectData = array_merge(
                    $request->toArray(),
                    [
                        'logo'  => $path_logo,
                        'icon'  => $path_icon
                    ]
                );
                $this->unitUpdateService->update($projectData, $unit_id);
            }
            else{
                if(isset($request['icon'])){

                    $request->validate([
                        'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);

                    //$path = $request->file( key:'image')->store( path: 'images/Project');
                    $path_icon = Storage::disk('units')->put('icons', $request->file( key:'icon'));

                    $projectData = array_merge(
                        $request->toArray(),
                        [
                            'icon'  => $path_icon
                        ]
                    );
                    $this->unitUpdateService->update($projectData, $unit_id);
                }else{
                    if(isset($request['logo'])){

                        $request->validate([
                            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);

                        //$path = $request->file( key:'image')->store( path: 'images/Project');
                        $path_logo = Storage::disk('units')->put('logos', $request->file( key:'logo'));

                        $projectData = array_merge(
                            $request->toArray(),
                            [
                                'logo'  => $path_logo
                            ]
                        );
                        $this->unitUpdateService->update($projectData, $unit_id);
                    }else{
                        $this->unitUpdateService->update($request->toArray(), $unit_id);
                    }
                }
            }

            flash('Unidade editada com sucesso!')->success();
            DB::commit();
            return redirect()->route('unidades');
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a unidade!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($unit_id)
    {
        if (! Gate::allows('Editar Departamentos')) {
            return view('pages.not-authorized');
        }
        try{
            $unit = Unit::find($unit_id);
            $organizations = Organization::all();
            $unit_selected = $this->unitService->show($unit_id);
            $social_media = SocialMedia::all();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.unit.show', compact('social_media', 'unit', 'copyright', 'organizations', 'unit_selected'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a unidade!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($unit)
    {
        if (! Gate::allows('Deletar Unidades')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::find($unit);
            $unit->delete();
            $pageConfigs = ['pageHeader' => false];

            flash('Unidade deletado com sucesso!')->success();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $organizations = Organization::all();
            $units = $this->unitService->get();
            return view('admin.unit.index', ['pageConfigs' => $pageConfigs], compact('organizations', 'units', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar a unidade!')->error();
            dd($exception);
            return redirect()->back()->withInput();
        }
    }

    public function unidade_social_media_add(
        Request $request
    ){
        if (! Gate::allows('Editar Unidades')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();

            SocialMediaUnit::create([
                'social_media_id' => $request->social_media_id,
                'unit_id' => $request->unit_id,
                'url' => $request->url,
            ]);

            flash('Unidade editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a unidade!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function unidade_social_media_delete(
        $social_media
    ){
        if (! Gate::allows('Editar Unidades')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $media = SocialMediaUnit::find($social_media);
            $media->forceDelete();
            flash('Mídia deletada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a unidade!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function unidade_social_media_update(
        Request $request
    ){
        if (! Gate::allows('Editar Unidades')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            dd($request);
            SocialMediaUnit::where($request->id)
            ->update(['url' => $request->url]);

            flash('Unidade editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar a unidade!')->error();
            return redirect()->back()->withInput();
        }
    }
}
