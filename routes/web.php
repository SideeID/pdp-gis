<?php

use App\Http\Controllers\FarmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


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
    return view('layouts.app');
});

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.app');
    })->name('dashboard');

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::post('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/update', [UserController::class, 'update'])->name('user.update');
        Route::post('/delete-selection', [UserController::class, 'deleteSelection'])->name('user.delete.selection');
        Route::get('/delete/{kode}', [UserController::class, 'deleteData']);
        Route::get('/{search}', [UserController::class, 'search'])->where('search', '.*');
    });

    Route::prefix('farm')->group(function () {
        Route::get('/', [FarmController::class, 'index'])->name('farm');
        Route::post('/create', [FarmController::class, 'create'])->name('farm.create');
        Route::post('/update', [FarmController::class, 'update'])->name('farm.update');
        Route::post('/delete-selection', [FarmController::class, 'deleteSelection'])->name('farm.delete.selection');
        Route::get('/delete/{kode}', [FarmController::class, 'deleteData']);
        Route::get('/{search}', [FarmController::class, 'search'])->where('search', '.*');
    });
    
    Route::prefix('afdeling')->group(function () {
        Route::get('/', [AfdelingController::class, 'index'])->name('afdeling');
        Route::post('/create', [AfdelingController::class, 'create'])->name('afdeling.create');
        Route::post('/update', [AfdelingController::class, 'update'])->name('afdeling.update');
        Route::post('/delete-selection', [AfdelingController::class, 'deleteSelection'])->name('afdeling.delete.selection');
        Route::get('/delete/{kode}', [AfdelingController::class, 'deleteData']);
        Route::get('/{search}', [AfdelingController::class, 'search'])->where('search', '.*');
    });
    
});
