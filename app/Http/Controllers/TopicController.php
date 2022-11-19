<?php

namespace App\Http\Controllers;

use App\Models\Topic;
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
        return Inertia::render('Discover', ['topic' => $request->topic ? Topic::where('slug', $request->topic)->firstOrFail() : null ]);
    }
}
