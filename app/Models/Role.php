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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'laravel_through_key'
    ];


    public function getRolewithPermissions(Role $role) {
        return [
            'role' => $role,
            'permissions' => $role->RolePermissions->map(fn ($permissions) => $permissions->Permission->name ),
        ];
    }

    public function users() {
        return $this->belongsToMany(User::class, 'roles', 'id', 'id');
    }


    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function permission() {
        return $this->hasManyThrough(Permission::class, RolePermission::class, 'role_id', 'id', 'id', 'id');
    }
}
