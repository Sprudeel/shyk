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
            'parent_id' => 'required|exists:posts,id',
        ]);

        $author = Auth::user()->id;

        $comment = Comment::create([
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'commenter' => $author,
        ]);

        return back()->with('success', 'Kommentar wurde erfolgreich erstellt!');
    }
}
