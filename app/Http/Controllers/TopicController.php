<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function index(Request $request) {
        return Inertia::render('Discover', [
            'topic' => $request->topic ? Topic::where('slug', $request->topic)->firstOrFail() : null ,
            'topics' => Topic::all(),
            'categories' => Category::all(),
            'posts' => $request->topic && $request->category ? Post::where(['status' => 'public', 'topic' => $request->topic, 'category' => $request->category])->with('author')->get() : ( $request->topic ? Post::where(['status' => 'public', 'topic' => $request->topic])->with('author')->get() : ( $request->category ? Post::where(['status' => 'public', 'category' => $request->category])->with('author')->get() : Post::where('status', 'public')->with('author')->get() ) ),
        ]);
    }
}
