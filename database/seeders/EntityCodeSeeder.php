<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntityCode;

class EntityCodeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['code' => 'E001', 'description' => 'Jabatan Kewangan', 'created_by' => 1],
            ['code' => 'E002', 'description' => 'Bahagian Akaun', 'created_by' => 1],
            ['code' => 'E003', 'description' => 'Unit Audit', 'created_by' => 1],
        ];

        foreach ($data as $item) {
            EntityCode::create($item);
        }
    }
}
