<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('superadmin.permissions.permission', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {

        return view('superadmin.permissions.createpermission');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);
        return redirect('permissions')->with('status', 'Permission telah dibuat');
    }
    public function edit(Permission $permission)
    {
        return view('superadmin.permissions.editpermission', [
            'permission' => $permission
        ]);
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);
        return redirect('permissions')->with('status', 'Permission telah dibuat');
    }
    public function destroy($permissionId){
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status', 'Permission Deleted Succesfully');
    }
}
