<?php

namespace App\Http\Controllers;

use App\Models\Legislation;
use App\Http\Requests\LegislationBondRequest;
use App\Models\LegislationBond;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\LegislationBondCreateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LegislationBondController extends Controller
{

    public function __construct(
        protected LegislationBondCreateService $legislationBondCreateService,
    ){}

    public function store(LegislationBondRequest $request)
    {
        if (! Gate::allows('Editar Legislações')) {
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
            $this->legislationBondCreateService->create($fileData);

            flash('Vínculo criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }


    public function show($bond_id)
    {
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $bond = LegislationBond::find($bond_id);
            $legislations = Legislation::with('category', 'situation', 'subjects')
                                        ->latest()
                                        ->get();
            return view('admin.legislation.bond_show', compact('bond', 'legislations', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Vínculo!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        LegislationBondRequest $request, $bond_id
    ){
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->legislationUpdateService->update($request->toArray(), $bond_id);

            flash('Vínculo editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($bond_id)
    {
        if (! Gate::allows('Editar Legislações')) {
            return view('pages.not-authorized');
        }

        try{
            $bond = LegislationBond::find($bond_id);
            $bond->delete();
            flash('Vínculo deletado com sucesso!')->success();
            return redirect('/legislacoes');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar o Vínculo!')->error();
            return redirect()->back()->withInput();
        }
    }
}
