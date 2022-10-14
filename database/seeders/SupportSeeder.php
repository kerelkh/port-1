<?php

namespace Database\Seeders;

use App\Models\Support;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Support::create([
            'name' => 'Trakteer',
            'url' => '/',
        ]);

        Support::create([
            'name' => 'Saweria',
            'url' => '/',
        ]);

        Support::create([
            'name' => 'Ko-Fi',
            'url' => '/'
        ]);
    }
}
