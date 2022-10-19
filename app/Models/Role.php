<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'users', 'id', 'role_id');
    }


    public function RolePermissions()
    {
        return $this->hasMany(RolePermission::class);
    }
}
