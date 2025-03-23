<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'ABC Sdn Bhd', 'registration_number' => '123456-A', 'address' => 'Kuala Lumpur', 'phone' => '0123456789', 'email' => 'info@abc.com'],
            ['name' => 'XYZ Enterprise', 'registration_number' => '789012-B', 'address' => 'Selangor', 'phone' => '0987654321', 'email' => 'contact@xyz.com'],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
