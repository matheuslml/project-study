<?php

namespace App\Http\Controllers;

use App\Models\AgreementType;
use App\Http\Requests\AgreementTypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\AgreementTypeService;
use App\Services\AgreementTypeCreateService;
use App\Services\AgreementTypeUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AgreementTypeController extends Controller
{

    public function __construct(
        protected AgreementTypeService $agreementTypeService,
        protected AgreementTypeCreateService $agreementTypeCreateService,
        protected AgreementTypeUpdateService $agreementTypeUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Contratos')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $types = AgreementType::with('agreements')->latest()->get();
            return view('admin.bidding.agreement_type_index', ['pageConfigs' => $pageConfigs], compact('types', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Tipos Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        AgreementTypeRequest $request
    ){
        if (! Gate::allows('Editar Contratos')) {
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
            $this->agreementTypeCreateService->create($fileData);

            flash('Tipo criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($type_id)
    {
        if (! Gate::allows('Editar Contratos')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $types = AgreementType::with('agreements')->latest()->get();
            $type_selected = $this->agreementTypeService->show($type_id);
            return view('admin.bidding.agreement_type_show', compact('type_selected', 'types', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Contrato!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        AgreementTypeRequest $request, $type_id
    ){
        if (! Gate::allows('Editar Contratos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->agreementTypeUpdateService->update($request->toArray(), $type_id);

            flash('Modalidade editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($type)
    {
        if (! Gate::allows('Editar Contratos')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = AgreementType::find($type);
            $for_delete->delete();
            flash('Tipo deletado com sucesso!')->success();
            return redirect('/licitacao_contrato_tipos');
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Tipo!')->error();
            return redirect()->back()->withInput();
        }
    }
}
