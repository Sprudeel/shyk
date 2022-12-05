<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'topic', 'status', 'category', 'content', 'author', 'verified', 'folder'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }


    public function topic() {
        return $this->hasOne(Topic::class, 'slug', 'topic');
    }

    public function category() {
        return $this->hasOne(Category::class, 'slug', 'category');
    }

    public function comments() {
        $unsorted = Comment::where('post_id', $this->id)->with('author.role')->get();
        $sorted = [];

        foreach ($unsorted as $comment) {
            if($comment->comment_parent == 0) {
                $sorted[] = $comment;
                foreach ($unsorted as $subcomment) {
                    if($subcomment->comment_parent == $comment->id) {
                        $comment->subcomments = $subcomment;
                    }
                }
            }
        }

        return $sorted;
    }

    public function author() {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function likes() {
        return $this->hasMany(Like::class, 'on_id', 'id');
    }
}
