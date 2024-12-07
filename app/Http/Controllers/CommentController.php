<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Request $req) {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in as a user to comment.');
        }

        $req->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'article_id' => $req->article_id,
            'comment' => $req->comment
        ]);

        return redirect()->back()->with('success', 'Comment addeed successfully');
    }
}
