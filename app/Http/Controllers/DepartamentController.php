<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentRequest;
use App\Models\City;
use App\Models\Departament;
use App\Models\Occupation;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;
use App\Services\DepartamentService;
use App\Services\DepartamentCreateService;
use App\Services\DepartamentUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DepartamentController extends Controller
{
    public function __construct(
        protected DepartamentService $departamentService,
        protected DepartamentCreateService $departamentCreateService,
        protected DepartamentUpdateService $departamentUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Departamentos')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $units = Unit::all();
            $departaments = $this->departamentService->get();
            return view('admin.departament.index', ['pageConfigs' => $pageConfigs], compact('departaments', 'units', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar os Departamentos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        DepartamentRequest $request
    ){
        if (! Gate::allows('Criar Departamentos')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->departamentCreateService->create($request->toArray());

            flash('Departamento criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao adicionar o departamento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($departament_id)
    {
        if (! Gate::allows('Editar Departamentos')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $departaments = $this->departamentService->get();
            $units = Unit::all();
            $departament_selected = $this->departamentService->show($departament_id);
            return view('admin.departament.show', compact('departament_selected', 'departaments', 'units', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o departamento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        DepartamentRequest $request, $departament_id
    ){
        if (! Gate::allows('Editar Departamentos')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->departamentUpdateService->update($request->toArray(), $departament_id);

            flash('Departamento editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar  o departamento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($departament)
    {
        if (! Gate::allows('Deletar Departamentos')) {
            return view('pages.not-authorized');
        }

        try{
            $departament = Departament::find($departament);
            $departament->delete();
            $pageConfigs = ['pageHeader' => false];
            flash('Departamento deletado com sucesso!')->success();
            $units = Unit::all();
            $departaments = $this->departamentService->get();
            return view('admin.departament.index', ['pageConfigs' => $pageConfigs], compact('departaments', 'units'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar  o departamento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function getDepartamentos(int $idUnit): JsonResponse
    {
        $departaments = Departament::where('unit_id', $idUnit)->orderBy('departament')->get();
        return Response::json($departaments);
    }

    public function getOccupations(int $idDepartament): JsonResponse
    {
        $occupations = Occupation::where('departament_id', $idDepartament)->orderBy('title')->get();
        return Response::json($occupations);
    }
}
