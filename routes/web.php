<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\EnglishVocabController;
use App\Http\Controllers\Admin\ChineseVocabController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Mail;


Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/about-me', [BlogController::class,'about'])->name('about-me');
Route::get('/blog-post', [BlogController::class, 'blogs'])->name('blogs');
Route::get('/blog-post/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/education/eng-ind', [BlogController::class,'education'])->name('blog.education');

// Download PDF
Route::get('/posts/export/pdf', [BlogController::class, 'exportPdf'])->name('posts.export.pdf');
// Komentar
// Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store'); // Belum Jalan
// Email - Subscriber
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

Route::middleware('auth')->group(function () {
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Posts Controller
    Route::resource('posts', PostController::class);
    Route::post('/posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');
    // Category Controller
    Route::resource('categories', CategoryController::class);
    Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');
    // Educational Word English Controller
    Route::resource('vocabs', EnglishVocabController::class);
    Route::post('/vocab/bulk-delete', [EnglishVocabController::class, 'bulkDelete'])->name('vocabs-eng.bulk-delete');
    // Educational Word Chinese Controller
    Route::resource('vocabs-chn', ChineseVocabController::class);
    Route::post('/vocabs-chn/bulk-delete', [ChineseVocabController::class, 'bulkDelete'])->name('vocabs-chn.bulk-delete');
    // Tag Controller
    Route::resource('tags', TagController::class);
    Route::post('/educational/bulk-delete', [TagController::class, 'bulkDelete'])->name('tags.bulk-delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


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




// Test Email
// Route::get('/test-email', function() {
//     Mail::raw('Ini adalah email test dari Laravel & Hostinger SMTP', function($message) {
//         $message->to('manyangolia@gmail.com')
//                 ->subject('Test Email Hostinger SMTP');
//     });
//     return 'Test email dikirim!';
// });

