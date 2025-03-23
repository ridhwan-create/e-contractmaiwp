<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpenseCode;

class ExpenseCodeSeeder extends Seeder
{
    public function run(): void
    {
        $codes = [
            ['code' => 'EXP001', 'description' => 'Pembayaran Vendor'],
            ['code' => 'EXP002', 'description' => 'Kos Pengurusan'],
            ['code' => 'EXP003', 'description' => 'Perkhidmatan Sokongan'],
        ];

        foreach ($codes as $code) {
            ExpenseCode::create($code);
        }
    }
}
