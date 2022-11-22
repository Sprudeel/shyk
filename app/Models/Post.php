<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'topic', 'status', 'category', 'content', 'author'];


    public function topic() {
        return $this->hasOne(Topic::class, 'slug', 'topic');
    }

    public function category() {
        return $this->hasOne(Category::class, 'slug', 'category');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
