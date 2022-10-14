<?php

namespace Database\Seeders;

use App\Models\Utility;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Utility::create([
            'name' => 'landing-banner',
            'value' => ''
        ]);

        Utility::create([
            'name' => 'landing-title',
            'value' => 'Hi, Welcome to My Website'
        ]);

        Utility::create([
            'name' => 'landing-desc',
            'value' => 'Follow my journey in this wholesome website.'
        ]);
    }
}
