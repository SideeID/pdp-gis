<?php

use App\Http\Controllers\AfdelingController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\PlantController;
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
    return redirect()->route('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');


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

Route::prefix('block')->group(function () {
    Route::get('/', [BlockController::class, 'index'])->name('block');
    Route::post('/create', [BlockController::class, 'create'])->name('block.create');
    Route::post('/update', [BlockController::class, 'update'])->name('block.update');
    Route::post('/delete-selection', [BlockController::class, 'deleteSelection'])->name('block.delete.selection');
    Route::get('/delete/{kode}', [BlockController::class, 'deleteData']);
    Route::get('/{search}', [BlockController::class, 'search'])->where('search', '.*');
});

Route::prefix('parameter')->group(function () {
    Route::get('/', [ParameterController::class, 'index'])->name('parameter');
    Route::post('/create', [ParameterController::class, 'create'])->name('parameter.create');
    Route::post('/update', [ParameterController::class, 'update'])->name('parameter.update');
    Route::post('/delete-selection', [ParameterController::class, 'deleteSelection'])->name('parameter.delete.selection');
    Route::get('/delete/{kode}', [ParameterController::class, 'deleteData']);
    Route::get('/{search}', [ParameterController::class, 'search'])->where('search', '.*');
});
Route::prefix('perhitungan')->group(function () {
    Route::get('/', [PerhitunganController::class, 'index'])->name('perhitungan');
    Route::post('/create', [PerhitunganController::class, 'create'])->name('perhitungan.create');
    Route::post('/update', [PerhitunganController::class, 'update'])->name('perhitungan.update');
    Route::post('/delete-selection', [PerhitunganController::class, 'deleteSelection'])->name('perhitungan.delete.selection');
    Route::get('/delete/{kode}', [PerhitunganController::class, 'deleteData']);
    Route::get('/{search}', [PerhitunganController::class, 'search'])->where('search', '.*');
});

Route::prefix('plant')->group(function () {
    Route::get('/', [PlantController::class, 'index'])->name('plant');
    Route::post('/create', [PlantController::class, 'create'])->name('plant.create');
    Route::post('/update', [PlantController::class, 'update'])->name('plant.update');
    Route::post('/delete-selection', [PlantController::class, 'deleteSelection'])->name('plant.delete.selection');
    Route::get('/delete/{kode}', [PlantController::class, 'deleteData']);
    Route::get('/{search}', [PlantController::class, 'search'])->where('search', '.*');
});
