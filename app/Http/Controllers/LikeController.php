<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\RedirectResponse;
use App\Models\Like;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function post(Request $request) {
        $post = Post::where(['slug' => $request->slug, 'status' => 'public'])->firstOrFail();
        $like = Like::where(['on' => 'post', 'on_id' => $post->id, 'from' => Auth::user()->id])->first();

        if($like == null) {
            Like::create([
                'on' => 'post',
                'on_id' => $post->id,
                'from' => Auth::user()->id,
            ]);
        } else {
            Like::where(['on' => 'post', 'on_id' => $post->id, 'from' => Auth::user()->id])->delete();
        }
    }
}


