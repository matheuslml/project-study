<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use App\Models\Role as ModelsRole;
use App\Models\Permission as ModelsPermission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of ModelsRole.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('Ver e Listar Regras')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false,];

        $roles = ModelsRole::with('users')->get();
        $users = User::with('roles')->get();

        return view('/admin/rolesPermission/access-roles', ['pageConfigs' => $pageConfigs], compact('roles', 'users'));
    }

    /**
     * Show the form for creating new ModelsRole.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('Criar Regras')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false,];

        $roles = ModelsRole::with('users')->get();

        $permissions = ModelsPermission::all();

        return view('/admin/rolesPermission/access-roles-create', ['pageConfigs' => $pageConfigs], compact('roles', 'permissions'));
    }

    /**
     * Store a newly created ModelsRole in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolesRequest $request)
    {
        if (! Gate::allows('Criar Regras')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $pageConfigs = ['pageHeader' => false,];

            $role = ModelsRole::create($request->except('permissions'));

            foreach($request['permissions'] as $permission){
                $role->givePermissionTo($permission);
            }

            $roles = ModelsRole::with('users')->get();

            $permissions = ModelsPermission::all();


            flash('Regra Criada Com Sucessso!')->success();
            DB::commit();
            return view('/admin/rolesPermission/access-roles-create', ['pageConfigs' => $pageConfigs], compact('roles', 'permissions'));
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao criar a Regra!')->error();
            return redirect()->back()->withInput();
        }
    }


    /**
     * Show the form for editing ModelsRole.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsRole $role)
    {
        if (! Gate::allows('Editar Regras')) {
            return view('pages.not-authorized');
        }

        try {
            $pageConfigs = ['pageHeader' => false,];

            $permissions = ModelsPermission::get()->pluck('name', 'id');

            return view('/admin/rolesPermission/access-roles-edit', ['pageConfigs' => $pageConfigs], compact('role', 'permissions'));
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar a Regra!')->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update ModelsRole in storage.
     *
     * @param  \App\Http\Requests\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, ModelsRole $role)
    {
        if (! Gate::allows('Editar Regras')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $role->update($request->except('permissions'));

            foreach($role->permissions as $permission){
                $role->revokePermissionTo($permission);
            }

            foreach($request['permissions'] as $permission){
                $role->givePermissionTo($permission);
            }

            flash('Edição confirmada!')->success();
            DB::commit();
            return redirect()->back()->withInput();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a Regra!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show(ModelsRole $role)
    {
        if (! Gate::allows('Ver e Listar Regras')) {
            return view('pages.not-authorized');
        }

        $role->load('permissions');

        return view('admin.regras.show', compact('role'));
    }


    /**
     * Remove ModelsRole from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsRole $role)
    {
        if (! Gate::allows('Deletar Regras')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $role->delete();

            $pageConfigs = ['pageHeader' => false,];

            $roles = ModelsRole::with('users')->get();
            $users = User::with('roles')->get();

            flash('Deletada com Sucesso!')->success();
            DB::commit();
            return view('/admin/rolesPermission/access-roles', ['pageConfigs' => $pageConfigs], compact('roles', 'users'));
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao deletar a Regra!')->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete all selected ModelsRole at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        ModelsRole::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function user_rule_create($idUser)
    {
        if (! Gate::allows('Ver e Listar Regras')) {
            return view('pages.not-authorized');
        }

        $pageConfigs = ['pageHeader' => false,];

        $roles_list = ModelsRole::get()->pluck('name', 'id');
        $roles = ModelsRole::with('users')->get();
        $user_finded = User::find($idUser)->load('roles');

        return view('/admin/rolesPermission/access-roles-users', ['pageConfigs' => $pageConfigs], compact('roles', 'user_finded', 'roles_list'));
    }

    public function user_rule_store(Request $request)
    {
        if (! Gate::allows('Editar Regras')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $pageConfigs = ['pageHeader' => false,];

            $roles = ModelsRole::with('users')->get();
            $users = User::with('roles')->get();

            $user = User::find($request->user_id);

            foreach($user->roles as $role){
                $user->removeRole($role);
            }

            $assignRoles = $request->input('roles_list') ? $request->input('roles_list') : [];
            $user->assignRole($assignRoles);

            flash('Editado com Sucesso!')->success();
            DB::commit();
            return redirect()->route('roles.index');
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a Regra!')->error();
            return redirect()->back()->withInput();
        }
    }

}
