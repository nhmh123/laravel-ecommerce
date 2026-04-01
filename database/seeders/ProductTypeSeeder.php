<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Hàng lẻ'],
            ['name' => 'Combo'],
            ['name' => 'Dịch vụ'],
        ];

        foreach ($types as $typeData) {
            ProductType::create($typeData);
        }
    }
}
