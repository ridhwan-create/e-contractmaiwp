<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Senarai kebenaran
        $permissions = [
            // Contracts
            'create contracts',
            'edit contracts',
            'delete contracts',
            'view contracts',

            // Projections
            'create projections',
            'edit projections',
            'delete projections',
            'view projections',

            // Payments
            'create payments',
            'edit payments',
            'delete payments',
            'view payments',
        ];

        // Tambah kebenaran ke dalam database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Tambah peranan
        $admin = Role::firstOrCreate(['name' => 'Super Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $user = Role::firstOrCreate(['name' => 'User']);

        // Beri kebenaran kepada peranan
        $admin->givePermissionTo(Permission::all());

        $manager->givePermissionTo([
            'view contracts', 'create contracts',
            'view projections', 'create projections',
            'view payments', 'create payments'
        ]);

        $user->givePermissionTo([
            'view contracts',
            'view projections',
            'view payments'
        ]);
    }
}
