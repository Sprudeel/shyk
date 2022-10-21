<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;

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


/**
 * All Routes for the Admin Section
 */
Route::prefix('/admin')->group(function () {

    /**
     * All Routes for the Permission/Role Management
     */
    Route::prefix('/roles-permissions')->group(function () {
        /**
         * Landingpage
         */
        Route::get('/', [RolePermissionController::class, 'index'])->name('admin.role.permissions');

        /**
         * Manage Users
         */
        Route::get('/users', [UsersController::class, 'datatable'])->name('admin.role.users');

        /**
         * Edit Users
         */
        Route::get('/users/edit/{id}', [UsersController::class, 'adminEdit'])->name('admin.role.user');
        Route::post('/users/edit', [UsersController::class, 'updateRole'])->name("admin.role.user.edit");

        /**
         * Manage Roles
         */
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'datatable'])->name('admin.role.roles');

        /**
         * Add Roles
         */
        Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.role.create.form');
        Route::post('/roles/create/new', [App\Http\Controllers\RoleController::class, 'insert'])->name('admin.role.create');
    });
});



require __DIR__.'/auth.php';
