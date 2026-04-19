<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\Wisata;

class InteractiveStatsSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Berita Stats
        Berita::all()->each(function ($b) {
            $b->update([
                'views' => rand(50, 500),
                'likes' => rand(10, 100),
                'dislikes' => rand(0, 5),
                'shares' => rand(5, 50),
            ]);
        });

        // Seed Wisata Stats
        Wisata::all()->each(function ($w) {
            $w->update([
                'views' => rand(100, 1000),
                'likes' => rand(20, 200),
                'dislikes' => rand(0, 10),
                'shares' => rand(10, 100),
            ]);
        });
    }
}
