<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;

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

    public function destroy(Request $request) {
        $this->authorize('delete', [Comment::class, User::where('id', Comment::where('id', $request->id)->firstOrFail()->commenter)->firstOrFail()]);

        $comment = Comment::find($request->id);

        $comment->delete();

        return back()->with('success', 'Kommentar wurde erfolgreich gelöscht!');
    }

    public function update(Request $request) {
        $this->authorize('update', [Comment::class, User::where('id', Comment::where('id', $request->id)->firstOrFail()->commenter)->firstOrFail()]);

        $request->validate([
            'id' => 'required',
            'content' => 'required|max:256|min:5',
        ]);

        $comment = Comment::where('id', $request->id)->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'Kommentar wurde erfolgreich bearbeitet!');
    }
}
