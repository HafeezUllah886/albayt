<?php

namespace Database\Seeders;

use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Ghee 1kg", "pprice" => 540, "price" => 0, 'discount' => 0, 'catID' => 1],
            ['name' => "Salt Pkt", "pprice" => 10, "price" => 0, 'discount' => 0, 'catID' => 1],
            ['name' => "Chicken Kg", "pprice" => 640, "price" => 0, 'discount' => 0, 'catID' => 2],
        ];
        products::insert($data);
    }
}
