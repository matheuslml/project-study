<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;
use App\Models\Permission as ModelsPermission;
use App\Models\PermissionInformation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class PermissionsController extends Controller
{
    /**
     * Display a listing of ModelsPermission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('Ver e listar Permissões')) {
            return view('pages.not-authorized');
        }


        $pageConfigs = ['pageHeader' => false,];

        $permissions = ModelsPermission::all();

        return view('/admin/rolesPermission/access-permissions', ['pageConfigs' => $pageConfigs], compact('permissions'));
    }

    /**
     * Show the form for creating new ModelsPermission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('Criar Permissões')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false,];

        $permissions = ModelsPermission::with('users')->get();

        return view('/admin/rolesPermission/access-permissions-create', ['pageConfigs' => $pageConfigs], compact('permissions'));
    }

    /**
     * Store a newly created ModelsPermission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsRequest $request)
    {
        if (! Gate::allows('Criar Permissões')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $permission = ModelsPermission::create($request->all());

            PermissionInformation::create(
                [
                'permission_id' => $permission->id,
                'description' => $request['description'],
                ]
            );

            flash('Criado com Sucesso!')->success();
            DB::commit();
            return redirect()->route('permissions.index');
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao criar a Permissão!')->error();
            return redirect()->back()->withInput();
        }
    }


    /**
     * Show the form for editing ModelsPermission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsPermission $permission)
    {
        if (! Gate::allows('Editar Permissões')) {
            return view('pages.not-authorized');
        }
        
        $pageConfigs = ['pageHeader' => false,];

        return view('/admin/rolesPermission/access-permissions-edit', ['pageConfigs' => $pageConfigs], compact('permission'));
    }

    /**
     * Update ModelsPermission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, ModelsPermission $permission)
    {
        if (! Gate::allows('Editar Permissões')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $permission->update($request->all());

            $information = PermissionInformation::firstWhere('permission_id', $permission->id);
            $information->description = $request['description'];
            $information->save();

            flash('Editado com Sucesso!')->success();
            DB::commit();
            return redirect()->route('permissions.index');
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a Permissão!')->error();
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove ModelsPermission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsPermission $permission)
    {
        if (! Gate::allows('Deletar Permissões')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

        $permission->information->delete();

        $permission->delete();

        flash('Deletado com Sucesso!')->success();
        DB::commit();
        return redirect()->route('permissions.index');
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao deletar a Permissão!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show(ModelsPermission $permission)
    {
        if (! Gate::allows('Ver e listar Permissões')) {
            return view('pages.not-authorized');
        }

        return view('odin.permissoes.show', compact('permission'));
    }

    /**
     * Delete all selected ModelsPermission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        ModelsPermission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}