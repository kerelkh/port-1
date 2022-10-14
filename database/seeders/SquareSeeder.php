<?php

namespace Database\Seeders;

use App\Models\SquareBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SquareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SquareBanner::create([
            'name' => 'Banner 1',
            'images' => '',
        ]);
        SquareBanner::create([
            'name' => 'Banner 2',
            'images' => '',
        ]);
        SquareBanner::create([
            'name' => 'Banner 3',
            'images' => '',
        ]);
        SquareBanner::create([
            'name' => 'Banner 4',
            'images' => '',
        ]);
        SquareBanner::create([
            'name' => 'Banner 5',
            'images' => '',
        ]);
        SquareBanner::create([
            'name' => 'Banner 6',
            'images' => '',
        ]);
    }
}
