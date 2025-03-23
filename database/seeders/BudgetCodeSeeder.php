<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BudgetCode;

class BudgetCodeSeeder extends Seeder
{
    public function run(): void
    {
        $codes = [
            ['code' => 'BUD001', 'description' => 'Bajet Tahunan'],
            ['code' => 'BUD002', 'description' => 'Peruntukan Tambahan'],
            ['code' => 'BUD003', 'description' => 'Bajet Kecemasan'],
        ];

        foreach ($codes as $code) {
            BudgetCode::create($code);
        }
    }
}
