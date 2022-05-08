<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostsController::class,'show'])->name('posts.show');
Route::post('/posts/{post:slug}', [PostsController::class,'addComment'])->name('posts.add_comment');


Route::get('/about',AboutController::class)->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


require __DIR__ . '/auth.php';
