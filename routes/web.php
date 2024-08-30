<?php

use Illuminate\Support\Facades\Route;

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
})->middleware('auth');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register');

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login.post');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/api/dashboard', [\App\Http\Controllers\APIDashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/posts', \App\Http\Controllers\Post\IndexController::class)->name('post.index');
    Route::get('/posts/create', \App\Http\Controllers\Post\CreateController::class)->name('post.create');
    Route::post('/posts', \App\Http\Controllers\Post\StoreController::class)->name('post.store');
    Route::get('/posts/{post}', \App\Http\Controllers\Post\ViewController::class)->name('post.show');
    Route::get('/posts/{post}/edit', \App\Http\Controllers\Post\EditController::class)->name('post.edit');
    Route::put('/posts/{post}', \App\Http\Controllers\Post\UpdateController::class, 'update')->name('post.update');
    Route::delete('/posts/{post}', \App\Http\Controllers\Post\DestroyController::class, 'destroy')->name('post.destroy');
    Route::post('/posts/{post}/comments', \App\Http\Controllers\Comment\StoreController::class)->name('comments.store');
    Route::get('/comments/{comment}/edit', \App\Http\Controllers\Comment\EditController::class)->name('comments.edit');
    Route::put('/comments/{comment}', \App\Http\Controllers\Comment\UpdateController::class)->name('comments.update');
    Route::delete('/comments/{comment}', \App\Http\Controllers\Comment\DestroyController::class)->name('comments.destroy');
});
