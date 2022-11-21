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
}
