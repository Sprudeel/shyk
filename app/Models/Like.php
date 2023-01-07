<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['on', 'on_id', 'from'];


    public function post() {
        return $this->belongsTo(Post::class, 'id', 'on_id');
    }
}
