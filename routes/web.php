<?php

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
});