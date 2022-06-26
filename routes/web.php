<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndexController;

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

Route::prefix('/blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');

    Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/', [BlogController::class, 'store'])->name('blogs.store');

    Route::get('/edit/{blog:slug}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/{blog:slug}', [BlogController::class, 'update'])->name('blogs.update');

    Route::delete('/{blog:slug}', [BlogController::class, 'delete'])->name('blogs.delete');

    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('blogs.show');
});
