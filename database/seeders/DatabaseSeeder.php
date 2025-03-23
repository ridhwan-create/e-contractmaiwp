<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ExpenseCodeSeeder::class,
            BudgetCodeSeeder::class,
            CompanySeeder::class,
            ContractTypeSeeder::class,
        ]);
    }
}
