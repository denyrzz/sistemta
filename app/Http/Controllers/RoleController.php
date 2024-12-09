<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('superadmin.roles.role', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('superadmin.roles.createrole');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);
        return redirect('roles')->with('status', 'Role telah dibuat');
    }
    public function edit(Role $role)
    {
        return view('superadmin.roles.editrole', [
            'role' => $role
        ]);
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);
        return redirect('roles')->with('status', 'Role telah dibuat');
    }
    public function destroy($roleId){
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status', 'Role Deleted Succesfully');
    }
}
