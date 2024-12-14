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
        $testimonials = [
            ["name" => "James", "body" => "This web provided me with clear guidance during a stressful time. The lawyers are professional and approachable, making it easier to understand my rights."],
            ["name" => "Sarah", "body" => "The consultation was straightforward and insightful. The lawyer explained everything in detail and gave me actionable advice without any legal jargon."],
            ["name" => "Michael", "body" => "I never thought legal advice could be this accessible. The team was incredibly patient, even though my questions were basic. Highly recommend!"],
        ];
        $articles = Article::paginate(3);

        return view('home', compact('categories', 'articles', 'testimonials'));
    }
}
