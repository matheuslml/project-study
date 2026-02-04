<?php

namespace App\Http\Controllers;

use App\Models\DirectHireItem;
use App\Http\Requests\DirectHireItemRequest;
use App\Models\DirectHire;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\DirectHireItemService;
use App\Services\DirectHireItemCreateService;
use App\Services\DirectHireItemUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DirectHireItemController extends Controller
{

    public function __construct(
        protected DirectHireItemService $directHireItemService,
        protected DirectHireItemCreateService $directHireItemCreateService,
        protected DirectHireItemUpdateService $directHireItemUpdateService,
    ){}

    public function store(
        DirectHireItemRequest $request
    ){
        if (! Gate::allows('Editar Contratações Diretas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->directHireItemCreateService->create($request->toArray());

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
        if (! Gate::allows('Editar Contratações Diretas')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $item_selected = $this->directHireItemService->show($item_id);
            $directHire_id = $item_selected->directHire_id;
            $directHire = DirectHire::find($directHire_id);
            return view('admin.DirectHire.Item_show', compact('item_selected', 'DirectHire', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        DirectHireItemRequest $request, $item_id
    ){
        if (! Gate::allows('Editar Contratações Diretas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->directHireItemUpdateService->update($request->toArray(), $item_id);

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
        if (! Gate::allows('Editar Contratações Diretas')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = DirectHireItem::find($item);
            $directHire_id = $for_delete->directHire_id;
            $directHire = DirectHire::find($directHire_id);
            $for_delete->delete();
            flash('Item deletado com sucesso!')->success();
            return redirect('/contratacoes_diretas/' . $directHire->id);
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Item!')->error();
            return redirect()->back()->withInput();
        }
    }
}
