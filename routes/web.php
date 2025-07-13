<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\EducationController;

Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/about-me', [BlogController::class,'about'])->name('about-me');
Route::get('/blog-post', [BlogController::class, 'blogs'])->name('blogs');
Route::get('/blog-post/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/education/eng-ind', [BlogController::class,'education'])->name('blog.education');


Route::middleware('auth')->group(function () {
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::post('/posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');
    Route::resource('categories', CategoryController::class);
    Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('educational-words', EducationController::class);

    Route::group(['prefix' => 'laravel-filemanager'], function () {
         \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

Route::get('/vendor/laravel-filemanager/{path}', function ($path) {
    $fullPath = public_path('assets/laravel-filemanager/' . $path);
    
    if (!File::exists($fullPath)) {
        abort(404);
    }

    return Response::file($fullPath);
})->where('path', '.*');


require __DIR__.'/auth.php';

require __DIR__.'/auth.php';
