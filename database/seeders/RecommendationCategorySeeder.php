<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecommendationCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recommendation_categories')->insert([
            ['name' => 'food', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'drink', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'museum', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'beaches', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'venues', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
