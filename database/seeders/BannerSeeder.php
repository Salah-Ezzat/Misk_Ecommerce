<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::insert([
            ['img' => 'No_Image.jpg'],
            ['img' => 'No_Image.jpg'],
            ['img' => 'No_Image.jpg'],

        ]);
    }
}
