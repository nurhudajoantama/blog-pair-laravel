<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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
    return view('welcome');
});

Route::prefix('/blog')->group(function () {
    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');

    Route::get('/create', [BlogController::class, 'create']);
    Route::post('/', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/{blog:slug}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/{blog:slug}', [BlogController::class, 'update'])->name('blogs.update');
});
