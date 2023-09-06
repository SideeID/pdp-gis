<?php

use App\Http\Controllers\AfdelingController;
use App\Http\Controllers\FarmController;
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
    return view('layouts.app');
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
