<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function showArticles(Request $request)
    {
        $query = Article::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->paginate(8);

        return view('article', compact('articles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
            'expertise_id' => 'required|string',
        ]);

        // Save the image to storage
        $imagePath = $request->file('image')->store('articles', 'public');

        // Create the article
        Article::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'imagePath' => $imagePath,
            'createDate' => now(),
            'lawyer_id' => Auth::guard('lawyer')->id(),
            'expertise_id' => $validated['expertise_id'],
        ]);

        return redirect()->back()->with('success', 'Article created successfully!');
    }

    public function showDetail($id)
    {
        $article = Article::with(['lawyer', 'comments.user', 'expertise'])->findOrFail($id);

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
