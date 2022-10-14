<?php

namespace Database\Seeders;

use App\Models\Referral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Referral::create([
            'name' => 'Go Trade',
            'url' => '/'
        ]);
        Referral::create([
            'name' => 'Bibit',
            'url' => '/'
        ]);
        Referral::create([
            'name' => 'Koinwork',
            'url' => '/'
        ]);
        Referral::create([
            'name' => 'Crypto',
            'url' => '/'
        ]);
    }
}
