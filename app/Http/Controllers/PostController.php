<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\RedirectResponse;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{


    public function create() {
        $this->authorize('create', Post::class);

        return Inertia::render('Post/Create', [
            'topics' => Topic::all(),
            'categories' => Category::all(),
        ]);
    }

    public function show(Request $request) {
        $author = Auth::user() ? Auth::user()->id : null;
        if(Post::where(['slug' => $request->slug])->firstOrFail()->author == $author) {
            $post = Post::where(['slug' => $request->slug])->with('author.role', 'category', 'topic', 'likes')->firstOrFail();
        } else {
            $post = Post::where(['slug' => $request->slug, 'status' => 'public'])->with('author.role', 'category', 'topic', 'likes')->firstOrFail();
        }

        $likes = Like::where(['on' => 'post', 'on_id' => $post->id])->get();
        $liked = Auth::user() ? Like::where(['on' => 'post', 'on_id' => $post->id, 'from' => Auth::user()->id])->exists() : false;

        $foldercontent = Storage::allFiles('posts/' . $post->folder);
        $files = [];


        foreach ($foldercontent as $file) {
            // push temp array to $files
            $files[] = [
                'name' => basename($file),
                'url' => Storage::temporaryURL(
                $file,
                now()->addMinutes(15)
            ),
                'size' => Storage::size($file),
                'type' => Storage::mimeType($file),

            ];

        }


        return Inertia::render('Post/Show', [
            'post' => $post,
            'likes' => $likes,
            'liked' => $liked,
            'attachements' => $files,
        ]);
    }

    public function deleteAttachement(Request $request) {
        $this->authorize('update', [Post::class, User::where('id', Post::where('folder', $request->folder)->firstOrFail()->author)->firstOrFail()]);

        Storage::delete('posts/' . $request->folder . '/' . $request->name);

        return redirect()->back()->with('success', 'Datei gelöscht');
    }

    public function edit(Request $request) {
        $this->authorize('update', [Post::class, User::where('id', Post::where('slug', $request->slug)->firstOrFail()->author)->firstOrFail()]);
        $post = Post::where(['slug' => $request->slug, 'status' => 'public'])->firstOrFail();

        $foldercontent = Storage::allFiles('posts/' . $post->folder);
        $files = [];

        foreach ($foldercontent as $file) {
            // push temp array to $files
            $files[] = [
                'name' => basename($file),
                'size' => Storage::size($file),
                'type' => Storage::mimeType($file),
                'folder' => $post->folder,
            ];
        }

        return Inertia::render('Post/Edit', [
            'post' => $post,
            'topics' => Topic::all(),
            'categories' => Category::all(),
            'attachements' => $files,
        ]);
    }

    public function destroy(Request $request) {
        $this->authorize('delete', [Post::class, User::where('id', Post::where('slug', $request->slug)->firstOrFail()->author)->firstOrFail()]);
        $post = Post::where(['slug' => $request->slug])->firstOrFail();

        $post->delete();

        return redirect(route('discover'))->with('success', 'Post wurde erfolgreich gelöscht!');
    }

    public function report(Request $request) {
        $this->authorize('report', Post::class);

        $request->validate([
            'reported_post' => 'required',
            'reported_post_title' => 'required',
            'reason' => 'required|max:255',
        ]);

        $reporting_user = Auth::user()->id;


        $report = Report::create([
            'report_on' => 'post',
            'reporting_user' => $reporting_user,
            'reported_id' => $request->reported_post,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Post wurde erfolgreich gemeldet!');
    }


    public function update(Request $request) {
        $this->authorize('update', [Post::class, User::where('id', Post::where('id', $request->id)->firstOrFail()->author)->firstOrFail()]);

        // FIND BETTER SOLUTION PLS
        $post = Post::where('id', $request->id)->update([
            'title' => '',
        ]);

        $request->validate([
            'id' => 'required',
            'title' => 'required|unique:App\Models\Post,title|max:30|min:5',
            'topic' => 'required|exists:topics,slug',
            'status' => 'required',
            'category' => 'required|exists:categories,slug',
            'content' => 'required',
        ]);

        $existingFiles = Storage::allFiles('posts/' . $request->folder);
        $maxNewFiles = 3 - count($existingFiles);

        $request->validate([
            'attachements' => 'max:' . $maxNewFiles,
        ]);


        if($request->attachements !== null) {
            foreach ($request->attachements as $file) {
                $var = $file['serverId'];
                $var = html_entity_decode($var);
                $var = json_decode($var);
                Storage::move('tmp/'.$var->folder.'/'.$var->filename, 'posts/'.$request->folder.'/'.$var->filename);
            };
        }

        $post = Post::where('id', $request->id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'topic' => $request->topic,
            'status' => $request->status,
            'category' => $request->category,
            'content' => $request->content,
            'verified' => false,
        ]);


        return redirect(route('post.show', ['slug' => Str::slug($request->title)]))->with('success', 'Post wurde erfolgreich bearbeitet!');
    }

    public function verify(Request $request) {
        $this->authorize('verify', Post::class);

        $post = Post::where(['slug' => $request->slug])->firstOrFail();

        if($post->verified) {
            Post::where(['slug' => $request->slug])->update([
                'verified' => false,
            ]);
        } else {
            Post::where(['slug' => $request->slug])->update([
                'verified' => true,
            ]);
        }

    }

    public function store(Request $request) {
        $this->authorize('create', Post::class);


        $request->validate([
            'title' => 'required|unique:App\Models\Post,title|max:30|min:5',
            'topic' => 'required|exists:topics,slug',
            'status' => 'required',
            'category' => 'required|exists:categories,slug',
            'content' => 'required',
            'attachements' => 'max:3',
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

        if($request->attachements !== null) {
            foreach ($request->attachements as $file) {
                $var = $file['serverId'];
                $var = html_entity_decode($var);
                $var = json_decode($var);
                Storage::move('tmp/'.$var->folder.'/'.$var->filename, 'posts/'.$author.'_'.$post->id.'/'.$var->filename);
            };
        }


        Post::where(['title' => $request->title])->update([
            'folder' => $author.'_'.$post->id,
        ]);

        return redirect(route('post.show', ['slug' => $post->slug]))->with('success', 'Post wurde erfolgreich erstellt!');
    }
}
