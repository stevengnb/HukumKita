<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function showArticles()
    {
        $articles = Article::paginate(8);

        return view('article', compact('articles'));
    }
}
