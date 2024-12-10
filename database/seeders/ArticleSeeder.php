<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Expertise;
use App\Models\Lawyer;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

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
        $categoryId = Expertise::pluck('id')->toArray();

        for ($i = 0; $i < 100; ++$i) {
            Article::insert([
                'title' => $faker->sentence,
                'description' => $faker->text,
                'createDate' => $faker->dateTimeBetween('-1 years', 'now'),
                'imagePath' => 'articles/law-article.jpg',
                'lawyer_id' => $faker->randomElement($lawyersId),
                'expertise_id' => $faker->randomElement($categoryId),
            ]);
        }
    }
}
