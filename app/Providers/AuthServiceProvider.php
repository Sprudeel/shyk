<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Role;
use App\Policies\Rolepolicy;

use App\Models\User;
use App\Policies\Userpolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        App\Models\Role::class => App\Policies\Rolepolicy::class,
        App\Models\Permission::class => App\Policies\Permissionpolicy::class,
        App\Models\User::class => App\Policies\Userpolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
