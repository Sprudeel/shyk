<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Permissions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = true;

    /**
     * Get the Role associated with the User
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }


    /**
     * Get the Permissions that the User has through his Role
     */
    public function permissions() {
        $permissions = $this->role->permission ?? [];
        $allpermissions = Permission::all();
        $truepermissions = [];

        $permissions_id = [];
        foreach ($permissions as $permission ) {
            array_push($permissions_id, $permission->id);
        }

        foreach ($allpermissions as $permission) {
            foreach ($allpermissions as $permission) {
                if(in_array($permission->id, $permissions_id)) {
                    $truepermissions += [$permission->name => true];
                } else {
                    $truepermissions += [$permission->name => false];

                }
            };
        }
        return (array) $truepermissions;
    }
}
