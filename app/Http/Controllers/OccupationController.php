<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupationRequest;
use App\Models\City;
use App\Models\Departament;
use App\Models\Occupation;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;
use App\Services\OccupationService;
use App\Services\OccupationCreateService;
use App\Services\OccupationUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OccupationController extends Controller
{
    public function __construct(
        protected OccupationService $occupationService,
        protected OccupationCreateService $occupationCreateService,
        protected OccupationUpdateService $occupationUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Ocupações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $departaments = Departament::all();
            $occupations = $this->occupationService->get();
            return view('admin.occupation.index', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'occupations', 'departaments'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Ocupações Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        OccupationRequest $request
    ){
        if (! Gate::allows('Criar Ocupações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->occupationCreateService->create($request->toArray());

            flash('Ocupação criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova ocupação!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($occupation_id)
    {
        if (! Gate::allows('Ver e Listar Ocupações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $occupations = $this->occupationService->get();
            $departaments = Departament::all();
            $occupation_selected = $this->occupationService->show($occupation_id);
            return view('admin.occupation.show', compact('occupation_selected', 'occupations', 'departaments', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a ocupação!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        OccupationRequest $request, $occupation_id
    ){
        if (! Gate::allows('Editar Ocupações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->occupationUpdateService->update($request->toArray(), $occupation_id);

            flash('Ocupação editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a ocupação!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($occupation)
    {
        if (! Gate::allows('Deletar Ocupações')) {
            return view('pages.not-authorized');
        }

        try{
            $occupation = Occupation::find($occupation);
            $occupation->delete();
            $pageConfigs = ['pageHeader' => false];
            flash('Ocupação deletada com sucesso!')->success();
            $departaments = Departament::all();
            $occupations = $this->occupationService->get();
            return view('admin.occupation.index', ['pageConfigs' => $pageConfigs], compact('occupations', 'Departaments'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar a ocupação!')->error();
            return redirect()->back()->withInput();
        }
    }
}
