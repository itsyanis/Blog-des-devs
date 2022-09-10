<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContactController;

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


Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('about', [PagesController::class, 'about'])->name('about');
Route::get('contact', [PagesController::class, 'contact'])->name('contact');
Route::post('contact', [ContactController::class, 'contact'])->name('contact');
Route::post('download_CV', [PagesController::class, 'download_CV'])->name('download_CV');



Route::prefix('post')->group(function () {
    Route::get('/all-post', [PostController::class, 'index'])->name('post.index');
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/publish/{post}', [PostController::class, 'publish'])->name('post.publish');
    Route::post('/comment/{post_id}', [PostController::class, 'addComment'])->name('post.comment');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/update/{post}', [PostController::class, 'update'])->name('post.update');
    Route::post('/ckeditor/upload', [PostController::class, 'CKEditorUploadImage'])->name('ckeditor.upload');
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
});


Route::prefix('dropzone')->group(function () {
    Route::post('store', [PostController::class, 'storeTempFile'])->name('dropzone.store');
    Route::post('delete', [PostController::class, 'deleteTempFile'])->name('dropzone.delete');
});

require __DIR__.'/auth.php';
