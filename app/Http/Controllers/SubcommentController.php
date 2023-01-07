<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subcomment;
use App\Models\Comment;
use App\Models\User;

class SubcommentController extends Controller
{
    public function store(Request $request) {
        $this->authorize('create', Comment::class);

        $request->validate([
            'parent_id' => 'required|exists:comments,id',
            'content' => 'required|max:256|min:5',
            'post_id' => 'required|exists:posts,id',
        ]);

        $author = Auth::user()->id;

        $comment = Subcomment::create([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'commenter' => $author,
        ]);

        return back()->with('success', 'Kommentar wurde erfolgreich erstellt!');
    }

    public function destroy(Request $request) {
        $this->authorize('delete', [Comment::class, User::where('id', Subcomment::where('id', $request->id)->firstOrFail()->commenter)->firstOrFail()]);

        $comment = Subcomment::find($request->id);

        $comment->delete();

        return back()->with('success', 'Kommentar wurde erfolgreich gelöscht!');
    }

    public function update(Request $request) {
        $this->authorize('update', [Comment::class, User::where('id', Subcomment::where('id', $request->id)->firstOrFail()->commenter)->firstOrFail()]);

        $request->validate([
            'id' => 'required',
            'content' => 'required|max:256|min:5',
        ]);

        $comment = Subcomment::where('id', $request->id)->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'Kommentar wurde erfolgreich bearbeitet!');
    }
}
