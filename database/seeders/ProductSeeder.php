<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'slug' => 'kursi-warna-wani',
            'name' => 'Kursi warna warni',
            'price' => '100000',
            'unit' => 'Buah',
            'images' => 'product/product103921.jpg',
            'stock' => 400,
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus sint provident numquam praesentium ab voluptatibus in commodi corporis laborum. Laudantium.",
        ]);
    }
}
