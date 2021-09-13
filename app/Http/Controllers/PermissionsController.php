<?php

namespace App\Http\Controllers;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AppBaseController;

class PermissionsController extends AppBaseController
{
    protected $permissionModel;

    public function __construct()
    {
        $this->permissionModel = Config::get('laratrust.models.permission');
    }

    public function index()
    {
        return View::make('permissions.index', [
            'permissions' => $this->permissionModel::paginate(10),
        ]);
    }

    public function edit($id)
    {
        $permission = $this->permissionModel::findOrFail($id);

        return View::make('permissions.edit', [
            'model' => $permission,
            'type' => 'permission',
        ]);
    }

    public function update(Request $request, $id)
    {
        $permission = $this->permissionModel::findOrFail($id);

        $data = $request->validate([
            'display_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $permission->update($data);

        Flash::success('Permission updated successfully');
        create_activity('update', 'Permissions');
        return redirect(route('permissions.index'));
    }
}
