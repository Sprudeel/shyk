<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Controllers\RolePermissionController;

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
        Route::get('/', [RolePermissionController::class, 'index'])->name('admin/roles-permissions');

        /**
         * Manage Users
         */
        Route::get('/users', [App\Http\Controllers\UsersController::class, 'datatable'])->name('admin/roles-permissions/users');

        /**
         * Manage Roles
         */
        Route::get('/roles', [App\Http\Controllers\RoleController::class, 'datatable'])->name('admin/roles-permissions/roles');

    });
});


require __DIR__.'/auth.php';
