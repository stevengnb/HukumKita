<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Article;
use App\Models\Lawyer;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // All id from Lawyer
        $lawyersId = Lawyer::pluck('id')->toArray();

        for($i=0;$i < 100; $i++){
            Article::insert([
                'title' => $faker->sentence,
                'description' => $faker->text,
                'createDate' => $faker->dateTimeBetween('-1 years', 'now'),
                'imagePath' => $faker->imageUrl(800, 600, 'business', true, 'law-article'),
                'lawyerId' => $faker->randomElement($lawyersId)
            ]);
        }
    }
}
