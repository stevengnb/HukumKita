<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function showArticles() {
        $articles = Article::paginate(8);

        return view('article', compact('articles'));
    }

    public function showDetail($id) {
        $article = Article::with(['lawyer', 'comments.user'])->findOrFail($id);

        $userComments = collect();
        $otherComments = $article->comments;

        if (Auth::check() && Auth::user()->role !== 'lawyer') {
            $userComments = $article->comments->where('user_id', Auth::id());
            $otherComments = $article->comments->where('user_id', '!=', Auth::id());
        }

        $comments = $userComments->merge($otherComments);

        return view('articleDetail', compact('article', 'comments'));
    }
}
