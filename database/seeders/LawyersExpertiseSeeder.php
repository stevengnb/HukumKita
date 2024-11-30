<?php

namespace Database\Seeders;

use App\Models\Expertise;
use App\Models\Lawyer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LawyersExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lawyers = Lawyer::all();
        $expertises = Expertise::all();

        foreach ($lawyers as $lawyer) {
            $randomExpertises = $expertises->random(rand(1, 3))->pluck('id')->toArray();
            $lawyer->expertises()->attach($randomExpertises);
        }
    }
}
