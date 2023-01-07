<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\Subcomment;

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
        $comments = Comment::where('parent_id', $this->id)->with(['author.role', 'subcomments.author.role'])->orderBy('created_at')->paginate(6);


        return $comments;
    }

    public function author() {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function likes() {
        return $this->hasMany(Like::class, 'on_id', 'id');
    }
}
