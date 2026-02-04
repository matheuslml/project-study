<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Services\OrganizationService;
use App\Services\OrganizationCreateService;
use App\Services\OrganizationUpdateService;
use App\Http\Requests\OrganizationRequest;
use App\Models\Unit;
use App\Models\Copyright;

class OrganizationController extends Controller
{
    public function __construct(
        protected OrganizationService $organizationService,
        protected OrganizationCreateService $organizationCreateService,
        protected OrganizationUpdateService $organizationUpdateService,
    ){}

    public function index(): View
    {
        /*if (! Gate::allows('Ver e Listar Organizações')) {
            return view('pages.not-authorized');
        }*/

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

            $organizations = $this->organizationService->get();
            return view('admin.organization.index', ['pageConfigs' => $pageConfigs], compact('organizations', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Organizações Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        OrganizationRequest $request
    ){
        /*if (! Gate::allows('Criar Organizações')) {
            return view('pages.not-authorized');
        }*/

        try {
            DB::beginTransaction();
            $this->organizationCreateService->create($request->toArray());

            flash('Organização criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova organização!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        OrganizationRequest $request, $organization_id
    ){
        /*if (! Gate::allows('Editar Organizações')) {
            return view('pages.not-authorized');
        }*/

        try {
            DB::beginTransaction();
            $this->organizationUpdateService->update($request->toArray(), $organization_id);

            flash('Organização editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a Organização!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($organization_id)
    {
        /*if (! Gate::allows('Editar Organizações')) {
            return view('pages.not-authorized');
        }*/

        try{
            $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
            $organizations = $this->organizationService->get();
            $organization_selected = $this->organizationService->show($organization_id);
            return view('admin.organization.show', compact('organization_selected', 'organizations', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a Organização!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($organization)
    {
        /*if (! Gate::allows('Deletar Organizaçãos')) {
            return view('pages.not-authorized');
        }*/

        try{
            $organization = Organization::find($organization);
            $organization->delete();
            $pageConfigs = ['pageHeader' => false];

            $organizations = $this->organizationService->get();
            flash('Organização deletada com sucesso!')->success();
            return view('admin.organization.index', ['pageConfigs' => $pageConfigs], compact('organizations'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Organização!')->error();
            return redirect()->back()->withInput();
        }
    }
}
