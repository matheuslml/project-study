<?php

namespace App\Http\Controllers;

use App\Models\BiddingItem;
use App\Http\Requests\BiddingItemRequest;
use App\Models\Bidding;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\BiddingItemService;
use App\Services\BiddingItemCreateService;
use App\Services\BiddingItemUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BiddingItemController extends Controller
{

    public function __construct(
        protected BiddingItemService $biddingItemService,
        protected BiddingItemCreateService $biddingItemCreateService,
        protected BiddingItemUpdateService $biddingItemUpdateService,
    ){}

    public function store(
        BiddingItemRequest $request
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->biddingItemCreateService->create($request->toArray());

            flash('Item criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($item_id)
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $item_selected = $this->biddingItemService->show($item_id);
            $bidding_id = $item_selected->bidding_id;
            $bidding = Bidding::find($bidding_id);
            return view('admin.bidding.Item_show', compact('item_selected', 'bidding', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        BiddingItemRequest $request, $item_id
    ){
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->biddingItemUpdateService->update($request->toArray(), $item_id);

            flash('Item editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($item)
    {
        if (! Gate::allows('Editar Licitações')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = BiddingItem::find($item);
            $bidding_id = $for_delete->bidding_id;
            $bidding = Bidding::find($bidding_id);
            $for_delete->delete();
            flash('Item deletado com sucesso!')->success();
            return redirect('/licitacoes/' . $bidding->id);
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Item!')->error();
            return redirect()->back()->withInput();
        }
    }
}
