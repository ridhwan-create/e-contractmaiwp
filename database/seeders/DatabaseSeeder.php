<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     public function run(): void
//     {
//         $this->call([
//             ExpenseCodeSeeder::class,
//             BudgetCodeSeeder::class,
//             CompanySeeder::class,
//             ContractTypeSeeder::class,
//         ]);
//     }
// }

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Menggunakan Hash untuk keselamatan
            'role' => 'Admin',
        ]);
    }
}
