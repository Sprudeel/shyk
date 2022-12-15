<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Subcomment extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'post_id', 'commenter', 'content'];


    public function parent() {
        return $this->belongsTo(Comment::class);
    }

    public function author() {
        return $this->belongsTo(User::class, 'commenter', 'id');
    }
}
