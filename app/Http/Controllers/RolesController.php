<?php

namespace App\Http\Controllers;

use Laratrust\Helper;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;

class RolesController extends AppBaseController
{
    protected $rolesModel;
    protected $permissionModel;

    public function __construct()
    {
        $this->rolesModel = Config::get('laratrust.models.role');
        $this->permissionModel = Config::get('laratrust.models.permission');
    }

    public function index()
    {
        return View::make('roles.index', [
            'roles' => $this->rolesModel::withCount('permissions')
                ->paginate(10),
        ]);
    }

    public function create()
    {
        return View::make('roles.create', [
            'model' => null,
            'permissions' => $this->permissionModel::all(['id', 'name']),
            'type' => 'role',
        ]);
    }

    public function show(Request $request, $id)
    {
        $role = $this->rolesModel::query()
            ->with('permissions:id,name,display_name')
            ->findOrFail($id);

        return View::make('roles.show', ['role' => $role]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'display_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $role = $this->rolesModel::create($data);
        $role->syncPermissions($request->get('permissions') ?? []);

        Flash::success('Role created successfully');
        create_activity('create', 'Roles');
        return redirect(route('roles.index'));
    }

    public function edit($id)
    {
        $role = $this->rolesModel::query()
            ->with('permissions:id')
            ->findOrFail($id);

        if (!Helper::roleIsEditable($role)) {
            Flash::error('The role is not editable');
            return redirect()->back();
        }

        $permissions = $this->permissionModel::all(['id', 'name', 'display_name'])
            ->map(function ($permission) use ($role) {
                $permission->assigned = $role->permissions
                    ->pluck('id')
                    ->contains($permission->id);

                return $permission;
            });

        return View::make('roles.edit', [
            'model' => $role,
            'permissions' => $permissions,
            'type' => 'role',
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = $this->rolesModel::findOrFail($id);

        if (!Helper::roleIsEditable($role)) {
            Flash::error('The role is not editable');
            return redirect()->back();
        }

        $data = $request->validate([
            'display_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $role->update($data);
        $role->syncPermissions($request->get('permissions') ?? []);

        Flash::success('Role updated successfully');
        create_activity('update', 'Roles');
        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        $usersAssignedToRole = DB::table(Config::get('laratrust.tables.role_user'))
            ->where(Config::get('laratrust.foreign_keys.role'), $id)
            ->count();
        $role = $this->rolesModel::findOrFail($id);

        if (!Helper::roleIsDeletable($role)) {
            Flash::error('The role is not deletable');
            return redirect()->back();
        }

        if ($usersAssignedToRole > 0) {
            Flash::error('Role is attached to one or more users. It can not be deleted');
        } else {
            Flash::success('Role deleted successfully');
            create_activity('delete', 'Roles');
            $this->rolesModel::destroy($id);
        }

        return redirect(route('roles.index'));
    }
}
