<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Services\TypeRequestService;
use App\Services\TypeRequestCreateService;
use App\Services\TypeRequestUpdateService;
use App\Http\Requests\TypeRequestRequest;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Support\Facades\Gate;

class TypeRequestController extends Controller
{
    public function __construct(
        protected TypeRequestService $typeRequestService,
        protected TypeRequestCreateService $typeRequestCreateService,
        protected TypeRequestUpdateService $typeRequestUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

            $type_requests = TypeRequest::with('ombudsmen')->latest()->get();
            return view('admin.ombudsman.request_index', ['pageConfigs' => $pageConfigs], compact('type_requests', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar os Requerimentos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        TypeRequestRequest $request
    ){
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->typeRequestCreateService->create($request->toArray());

            flash('Tipo de Requerimento criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar novo Tipo de Requerimento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($request_id)
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
            $type_requests = TypeRequest::with('ombudsmen')->latest()->get();
            $request_selected = $this->typeRequestService->show($request_id);
            return view('admin.ombudsman.request_show', compact('request_selected', 'type_requests', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Requerimento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        TypeRequestRequest $request, $request_id
    ){
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->typeRequestUpdateService->update($request->toArray(), $request_id);

            flash('Tipo de Requerimento editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o Tipo de Requerimento!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($request)
    {
        if (! Gate::allows('Editar Manifestações')) {
            return view('pages.not-authorized');
        }

        try{
            $type_request = TypeRequest::find($request);
            $type_request->delete();
            $pageConfigs = ['pageHeader' => false];

            $type_requests = TypeRequest::with('ombudsmen')->latest()->get();
            flash('Tipo de Requerimento deletado com sucesso!')->success();
            return view('admin.organization.index', ['pageConfigs' => $pageConfigs], compact('organizations'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Tipo de Requerimento!')->error();
            return redirect()->back()->withInput();
        }
    }



}
