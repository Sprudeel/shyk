<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('admin/roles-permissions', function () {
    return Inertia::render('Admin/RolesPermissions');
})->name('admin/roles-permissions');

Route::get('/sandbox', function () {
    $user = App\Models\User::first();
    $roles = App\Models\Role::first();
    $permissions = $user->role->RolePermissions;
    return $permissions->map(fn ($permissions) => $permissions->Permission->name );
});

require __DIR__.'/auth.php';
