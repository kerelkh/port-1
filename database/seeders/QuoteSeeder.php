<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quote::create([
            'quote' => "Theres no tommorrow when you die now.",
            'name' => 'Toronto',
        ]);
        Quote::create([
            'quote' => "The greatest glory in living lies not in never falling, but in rising every time we fall",
            'name' => 'Nelson Mandela'
        ]);
        Quote::create([
            'quote' => "If life were predictable it would cease to be life, and be without flavor.",
            'name' => "Eleanor Roosevelt"
        ]);
        Quote::create([
            'quote' => "If you set your goals ridiculously high and it's a failure, you will fail above everyone else's success.",
            'name' => 'James Cameron'
        ]);
    }
}
