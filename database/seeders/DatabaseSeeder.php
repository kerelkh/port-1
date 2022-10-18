<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(UtilitySeeder::class);
        $this->call(SupportSeeder::class);
        $this->call(ReferralSeeder::class);
        $this->call(PortraitSeeder::class);
        $this->call(SquareSeeder::class);
        // $this->call(QuoteSeeder::class);
        // $this->call(ProductSeeder::class);

    }
}
