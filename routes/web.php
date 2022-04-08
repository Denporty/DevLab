<?php

use App\Http\Controllers\AnimationController;
use App\Http\Controllers\FOAnimationController;
use App\Http\Controllers\ManageUserController;
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
    'middleware' => ['auth', 'admin'],
], function () {
    Route::group([
        'prefix' => 'animation',
        'as' => 'animation',
    ], function () {
        Route::get('', [AnimationController::class, 'index'])->name('');
        Route::get('/form/{animation?}', [AnimationController::class, 'form'])->name('.form');
        Route::post('/store', [AnimationController::class, 'store'])->name('.store');
        Route::post('/update/{animation}', [AnimationController::class, 'update'])->name('.update');
        Route::delete('/{animation}', [AnimationController::class, 'destroy'])->name('.delete');
    });
    Route::group([
        'prefix' => 'users',
        'as' => 'users',
        'middleware' => 'super_admin',
    ], function () {
        Route::get('', [ManageUserController::class, 'index'])->middleware(['admin'])->name('');
        Route::get('/form/{user?}', [ManageUserController::class, 'form'])->middleware(['admin'])->name('.form');
        Route::post('/update/{user}', [ManageUserController::class, 'update'])->middleware(['admin'])->name('.update');
        Route::delete('/{user}', [ManageUserController::class, 'destroy'])->middleware(['admin'])->name('.delete');
    });
});
Route::get('/animation/{animation}', [FOAnimationController::class, 'more'])->name('animation.more');
Route::get('/animation-list/{user?}', [FOAnimationController::class, 'index'])->name('animation.online')->middleware('auth');
Route::get('/', [FOAnimationController::class, 'index'])->name('animation');

require __DIR__.'/auth.php';
