<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\AdminControllers\TinyMCEController;
use App\Http\Controllers\AdminControllers\AdminPostController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\AdminCategoriesController;

// Front User Route

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('posts.show');
Route::post('/posts/{post:slug}', [PostsController::class, 'addComment'])->name('posts.add_comment');


Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


Route::get('/tag/{tag:name}', [TagController::class, 'show'])->name('tags.show');

require __DIR__ . '/auth.php';

// Admin Dashboard Routes

Route::prefix('admin')->name('admin.')->middleware('auth','isadmin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::post('upload_tinymce_image',[TinyMCEController::class,'upload_tinymce_image'])->name('upload_tinymce_image');

    Route::resource('posts',AdminPostController::class);
    Route::resource('categories',AdminCategoriesController::class);

});
