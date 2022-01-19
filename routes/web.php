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

Route::get('/index', [Controller::class, 'index'])->name('index');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {
    Route::get('/animation', [AnimationController::class, 'index'])->middleware(['admin'])->name('animation');
    Route::get('/animation/form/{animation?}', [AnimationController::class, 'form'])->middleware(['admin'])->name('animation.form');
    Route::post('/animation/store', [AnimationController::class, 'store'])->middleware(['admin'])->name('animation.store');
    Route::post('/animation/update/{animation}', [AnimationController::class, 'update'])->middleware(['admin'])->name('animation.update');
    Route::delete('/animation/{animation}', [AnimationController::class, 'destroy'])->middleware(['admin'])->name('animation.delete');
});
Route::get('/animation/{animation}', [FOAnimationController::class, 'more'])->name('animation.more');
Route::get('/animation-list/{user?}', [FOAnimationController::class, 'index'])->name('animation.online')->middleware('auth');
Route::get('/', [FOAnimationController::class, 'index'])->name('animation');

require __DIR__.'/auth.php';
