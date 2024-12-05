<?php

namespace Database\Seeders;

use App\Models\Expertise;
use App\Models\Lawyer;
use App\Models\LawyersExpertise;
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
            $lawyer->expertises()->attach($expertises->random(rand(1, 3))->pluck('id')->toArray());
        }
        // LawyersExpertise::factory(15)->create();
    }
}
