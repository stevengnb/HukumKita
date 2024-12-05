<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Expertise;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function home() {
        $categories = Expertise::all();
        // $articles = [
        //     ["image" => "art.jpg", "title" => "5 Things to Know Before Filing for Divorce", "categories" => $categories[0]->name],
        //     ["image" => "art.jpg", "title" => "When to File a Civil Lawsuit: A Beginner’s Guide", "categories" => $categories[1]->name],
        //     ["image" => "art.jpg", "title" => "How to Handle Workplace Harassment Legally", "categories" => $categories[2]->name],
        // ];
        $testimonials = [
            ["name" => "James", "body" => "This web provided me with clear guidance during a stressful time. The lawyers are professional and approachable, making it easier to understand my rights."],
            ["name" => "Sarah", "body" => "The consultation was straightforward and insightful. The lawyer explained everything in detail and gave me actionable advice without any legal jargon."],
            ["name" => "Michael", "body" => "I never thought legal advice could be this accessible. The team was incredibly patient, even though my questions were basic. Highly recommend!"],
        ];
        $articles = Article::paginate(3);

        return view('home', compact('categories', 'articles', 'testimonials'));
    }
}
