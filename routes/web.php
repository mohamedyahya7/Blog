<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin','middleware' => ['auth','admin']],
    function () {
        Route::get('/', [PostController::class,'index']);
        Route::resource('/post', PostController::class);
        Route::delete('/post/forceDelete/{post}', [PostController::class, 'forceDelete'])->name('post.forceDelete');
        Route::post('/tag/store', [TagController::class, 'store'])->name('admin.tag.store');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    }
);

Route::get('/', [frontendController::class,'home'])->name('ui.home');
Route::get('/categories', [frontendController::class,'categories'])->name('ui.categories');
Route::get('/categories/category/{category}', [frontendController::class,'category'])->name('ui.category');



Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
