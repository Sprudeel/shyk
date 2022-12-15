<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubcommentController;

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

/**
 * Test Route
 */
Route::get('/test', function () {
        $permissions = User::find(1)->permissions();
        return $permissions['view_admin_section'];
});

/**
 * Landing Page
 */
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

/**
 * Current Dashboard
 */
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/**
 * User Profile
 */
Route::get('/user/{username}', [UsersController::class, 'index'])->name('userprofile.view');
Route::get('/user/edit/{username}', [UsersController::class, 'edit'])->middleware(['auth', 'verified'])->name('useprofile.edit');
Route::post('/user/edit', [UsersController::class, 'update'])->middleware(['auth', 'verified'])->name('userprofile.update');
Route::post('/user/report', [UsersController::class, 'report'])->middleware(['auth', 'verified'])->name('user.report');

/**
 * Comments
 */
Route::post('/comment/store', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comment.store');
Route::post('/comment/delete/{id}', [CommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('comment.delete');
Route::post('/comment/edit', [CommentController::class, 'update'])->middleware(['auth', 'verified'])->name('comment.update');

/**
 * Subcomments
 */
Route::post('/subcomment/store', [SubcommentController::class, 'store'])->middleware(['auth', 'verified'])->name('subcomment.store');
Route::post('/subcomment/delete/{id}', [SubcommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('subcomment.delete');
Route::post('/subcomment/edit', [SubcommentController::class, 'update'])->middleware(['auth', 'verified'])->name('subcomment.update');

/**
 * Forum
 */
Route::get('/discover/{topic?}', [TopicController::class, 'index'])->name('discover');

Route::post('/tmpupload', [UploadController::class, 'store'])->middleware(['auth', 'verified'])->name('tmpupload');
Route::delete('/tmpdelete', [UploadController::class, 'destroy'])->middleware(['auth', 'verified'])->name('tmpdelete');
Route::get('/search', [TopicController::class, 'search'])->middleware(['auth', 'verified'])->name('topic.search');

Route::pattern('path', '.*');
Route::get('local/temp/{path}', function (string $path){
    return Storage::download($path);
})->middleware(['auth', 'verified'])->name('local.temp');

/**
 * Posts
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post/store', [PostController::class, 'store'])->name('post.store');
    Route::post('post/like/{slug}', [LikeController::class, 'post'])->name('post.like');
    Route::get('post/edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('post/edit', [PostController::class, 'update'])->name('post.update');
    Route::post('post/report', [PostController::class, 'report'])->name('post.report');
    Route::post('post/verify/{slug}', [PostController::class, 'verify'])->name('post.verify');
    Route::post('post/delete/{slug}', [PostController::class, 'destroy'])->name('post.delete');
    Route::delete('post/attachements/delete', [PostController::class, 'deleteAttachement'])->name('post.attachement.delete');
});
Route::get('post/{slug}', [PostController::class, 'show'])->name('post.show');


/**
 * AUTH MIDDLEWARE
 */

Route::middleware(['auth', 'verified'])->group(function () {


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
            Route::get('/', [PermissionController::class, 'index'])->name('admin.role.permissions');

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
            Route::get('/roles', [RoleController::class, 'datatable'])->name('admin.role.roles');

            /**
             * Add Roles
             */
            Route::get('/role/create', [RoleController::class, 'create'])->name('admin.role.create.form');
            Route::post('/role/create/new', [RoleController::class, 'store'])->name('admin.role.create');

            /**
             * Delete Role
            */
            Route::post('/role/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.destory');

            /**
             * Edit Role
             */
            Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit.form');
            Route::post('role/edit', [RoleController::class, 'update'])->name('admin.role.edit');
        });
    });
});




require __DIR__.'/auth.php';
