<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $fillable = ['post_id', 'comment_on', 'comment_parent', 'commenter', 'content'];

    public function post() {
        return $this->belongsTo(Post::class, 'id', 'post_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'commenter', 'id');
    }
}
