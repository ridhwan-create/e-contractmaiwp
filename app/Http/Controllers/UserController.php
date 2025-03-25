<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::find($request->role);
        $user->assignRole($role->name);

        return redirect()->route('users.index')->with('success', 'Pengguna berjaya didaftarkan!');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'password' => 'nullable|min:6|confirmed',
    //         'role' => 'required|exists:roles,id',
    //     ]);

    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password ? Hash::make($request->password) : $user->password,
    //     ]);

    //     $role = Role::find($request->role);
    //     $user->syncRoles([$role->name]);

    //     return redirect()->route('users.index')->with('success', 'Maklumat pengguna berjaya dikemaskini!');
    // }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'required|array', // Pastikan roles dalam bentuk array
            'roles.*' => 'exists:roles,id' // Pastikan setiap role wujud dalam DB
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Ambil nama role berdasarkan ID yang dipilih
        $roles = Role::whereIn('id', $request->roles)->pluck('name');

        // Sync roles (hapus role lama & tambah role baru)
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Maklumat pengguna berjaya dikemaskini!');
    }

}
