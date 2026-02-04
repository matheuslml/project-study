<?php

namespace App\Http\Controllers;

use App\Models\BiddingModality;
use App\Http\Requests\BiddingModalityCreateRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\BiddingModalityService;
use App\Services\BiddingModalityCreateService;
use App\Services\BiddingModalityUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BiddingModalityController extends Controller
{

    public function __construct(
        protected BiddingModalityService $biddingModalityService,
        protected BiddingModalityCreateService $biddingModalityCreateService,
        protected BiddingModalityUpdateService $biddingModalityUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $bidding_modalities = BiddingModality::with('biddings')->latest()->get();
            return view('admin.bidding.modality_index', ['pageConfigs' => $pageConfigs], compact('bidding_modalities', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Modalidades Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        BiddingModalityCreateRequest $request
    ){
        if (! Gate::allows('Editar Licitações')) {
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
            $this->biddingModalityCreateService->create($fileData);

            flash('Modalidade criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($modality_id)
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $bidding_modalities = BiddingModality::with('biddings')->latest()->get();
            $modality_selected = $this->biddingModalityService->show($modality_id);
            return view('admin.bidding.modality_show', compact('modality_selected', 'bidding_modalities', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        BiddingModalityCreateRequest $request, $modality_id
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->biddingModalityUpdateService->update($request->toArray(), $modality_id);

            flash('Modalidade editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($modality)
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = BiddingModality::find($modality);
            $for_delete->delete();
            flash('Modalidade deletada com sucesso!')->success();
            return redirect('/licitacao_modalidades');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Modalidade!')->error();
            return redirect()->back()->withInput();
        }
    }
}
