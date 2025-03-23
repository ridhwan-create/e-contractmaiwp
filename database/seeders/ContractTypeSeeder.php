<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContractType;

class ContractTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Kontrak Perkhidmatan', 'description' => 'Kontrak untuk penyediaan perkhidmatan'],
            ['name' => 'Kontrak Pembekalan', 'description' => 'Kontrak untuk pembekalan barang'],
        ];

        foreach ($types as $type) {
            ContractType::create($type);
        }
    }
}
