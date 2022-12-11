<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request) {
        $this->authorize('create', Comment::class);

        $request->validate([
            'content' => 'required|max:256|min:5',
            'comment_on' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $author = Auth::user()->id;

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'comment_on' => $request->comment_on,
            'commenter' => $author,
            'content' => $request->content,
            'comment_parent' => $request->comment_parent,
        ]);

        return back()->with('success', 'Kommentar wurde erfolgreich erstellt!');
    }
}
