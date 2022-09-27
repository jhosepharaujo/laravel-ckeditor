<?php

use App\Http\Controllers\EditorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UploadImageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::post('/upload-image', UploadImageController::class)->name('upload-image.store');

    Route::get('{slug}', [PostController::class, 'index'])->name('post.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('posts/store', [PostController::class, 'store'])->name('post.store');
});
