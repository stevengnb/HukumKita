<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            "Perkawinan & Perceraian",
            "Perdata",
            "Ketenagakerjaan",
            "Pertanahan",
            "Perpajakan",
            "Pidana"
        ];

        foreach ($categories as $category) {
            DB::table('expertises')->insert([
                'name' => $category
            ]);
        }
    }
}
