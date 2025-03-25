<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id'); 
        return view('users.assign-role', compact('user', 'roles'));
    }

    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'role' => 'required|exists:roles,id'
    //     ]);

    //     $role = Role::findOrFail($request->role);
    //     // $user->syncRoles([$role->name]); 
    //     $user->assignRole($role->name);

    //     return redirect()->route('users.index')->with('success', "Role pengguna $user->name telah dikemaskini!");
    // }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array', // Pastikan roles dalam bentuk array
            'roles.*' => 'exists:roles,id' // Pastikan setiap role wujud dalam DB
        ]);

        // Ambil nama role berdasarkan ID yang dipilih
        $roles = Role::whereIn('id', $request->roles)->pluck('name');

        // Sync roles (hapus role lama & tambah role baru)
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', "Peranan pengguna $user->name telah dikemaskini!");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $roles = Role::whereIn('id', $request->roles)->pluck('name');
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Pengguna berjaya didaftarkan!');
    }

}
