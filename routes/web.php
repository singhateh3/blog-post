<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/post/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('can:isAdmin')->group(function () {
    // users
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/{id}', [ProfileController::class, 'destroy'])->name('users.destroy');

    // category
    Route::resource('categories', CategoryController::class);
});


require __DIR__ . '/auth.php';
