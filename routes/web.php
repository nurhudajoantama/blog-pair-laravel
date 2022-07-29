<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardBlogController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
    route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::prefix('/blogs')->name('blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('show');

    Route::prefix('/{blog:slug}')->middleware('auth')->name('comment.')->group(function () {
        Route::post('/comments', [CommentController::class, 'store'])->name('store');
        Route::post('/comments/reply', [CommentController::class, 'storeReply'])->name('reply.store');

        Route::put('/{comment:id}', [CommentController::class, 'update'])->name('update');
        Route::delete('/{comment:id}', [CommentController::class, 'destroy'])->name('destroy');
    });
});

// Route::get('/categories/api', [CategoryController::class, 'API_getAllCategories'])->name('categories.api');

Route::prefix('/dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    // All routes dashboard/blogs
    Route::resource('/blogs', DashboardBlogController::class)->except(['show']);

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::post('/', [CategoryController::class, 'store'])->name('store');
    });
});
