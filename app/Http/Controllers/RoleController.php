<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:roles,name',
    //         'permissions' => 'required|array',
    //     ]);

    //     $role = Role::create(['name' => $request->name]);
    //     $role->syncPermissions($request->permissions);

    //     return redirect()->route('roles.index')->with('success', 'Peranan berjaya ditambah!');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);

        // Dapatkan nama permissions berdasarkan ID
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Peranan berjaya ditambah!');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    // public function update(Request $request, Role $role)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:roles,name,' . $role->id,
    //         'permissions' => 'required|array',
    //     ]);

    //     $role->update(['name' => $request->name]);
    //     $role->syncPermissions($request->permissions);

    //     return redirect()->route('roles.index')->with('success', 'Peranan berjaya dikemaskini!');
    // }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);

        // Dapatkan nama permissions berdasarkan ID
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Peranan berjaya dikemaskini!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Peranan berjaya dipadam!');
    }
}
