<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\RedirectResponse;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $fillable = ['title', 'author', 'subject', 'status', 'content'];


    public function create() {
        $this->authorize('create', Post::class);

        return Inertia::render('Post/Create', [
            'topics' => Topic::all(),
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request) {
        $this->authorize('create', Post::class);


        $request->validate([
            'title' => 'required|unique:App\Models\Post,title|max:30',
            'topic' => 'required|exists:topics,slug',
            'status' => 'required',
            'category' => 'required|exists:categories,slug',
            'content' => 'required',
            'file' => 'max:2048',
        ]);

        $author = Auth::user()->id;

        $post = Post::create([
            'title' => $request->title,
            'topic' => $request->topic,
            'status' => $request->status,
            'category' => $request->category,
            'content' => $request->content,
            'author' => $author,
        ]);

        if($request->hasFile('file') && $request->validate(['file' => 'mimes:png,jpg,jpeg,pdf'])) {
            $file = $request->file->storeAs($post->id, $request->file->getClientOriginalName());
        }

        return redirect(route('discover'))->with('success', 'Post wurde erstellt!');
    }
}
