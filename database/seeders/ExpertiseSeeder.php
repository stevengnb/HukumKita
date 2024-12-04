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
            ["name" => "Marriage & Divorce", "description" => "Legal matters related to marital agreements, divorce, child custody, and spousal rights."],
            ["name" => "Civil Law", "description" => "Disputes between individuals or organizations, including contracts, property, inheritance, and personal conflicts."],
            ["name" => "Employment Law", "description" => "Workplace issues such as labor rights, termination disputes, employee contracts, and employer responsibilities."],
            ["name" => "Land and Property Law", "description" => "Property ownership disputes, land rights, boundary conflicts, and property acquisition or inheritance."],
            ["name" => "Tax Law", "description" => "Taxation issues, compliance, audits, and resolving disputes related to individual or corporate taxes."],
            ["name" => "Criminal Law", "description" => "Crimes such as theft, assault, fraud, or violations against the state or individual rights."]
        ];

        foreach ($categories as $category) {
            DB::table('expertises')->insert([
                'name' => $category['name'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
