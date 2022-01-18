<?php

use App\Http\Controllers\AnimationController;
use App\Http\Controllers\FOAnimationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

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
Route::get('/index', [Controller::class, 'index'])->name('index');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {
    Route::get('/animation', [AnimationController::class, 'index'])->name('animation');
    Route::get('/animation/form/{animation?}', [AnimationController::class, 'form'])->name('animation.form');
    Route::post('/animation/store', [AnimationController::class, 'store'])->name('animation.store');
    Route::post('/animation/update/{animation}', [AnimationController::class, 'update'])->name('animation.update');
    Route::delete('/animation/{animation}', [AnimationController::class, 'destroy'])->name('animation.delete');
});

Route::get('/animation', [FOAnimationController::class, 'index'])->name('animation');
Route::get('/animation/{animation}', [FOAnimationController::class, 'more'])->name('animation.more');


require __DIR__.'/auth.php';
