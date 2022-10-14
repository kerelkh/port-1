<?php

namespace Database\Seeders;

use App\Models\PortraitBanner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortraitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PortraitBanner::create([
            'name' => 'banner 1',
            'images' => ''
        ]);

        PortraitBanner::create([
            'name' => 'banner 2',
            'images' => ''
        ]);
    }
}
