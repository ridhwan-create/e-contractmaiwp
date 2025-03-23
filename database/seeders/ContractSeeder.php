<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;

class ContractSeeder extends Seeder
{
    public function run()
    {
        Contract::create([
            'contract_number' => 'CTR-002',
            'title' => 'Perkhidmatan IT TERBOEK',
            'company_id' => 2,
            'contract_type_id' => 2,
            'budget_code_id' => 2,
            'contract_value' => 100000,
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'created_by' => 1
        ]);
    }
}
