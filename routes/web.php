<?php

use App\Http\Controllers\DokterController;
use Carbon\Carbon;
use App\Models\JadwalOK;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DokterAnestesiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DisplayController;

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

Route::get('/', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [UserController::class, 'auth'])->name('auth')->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('schedule', JadwalController::class)->middleware('auth');
Route::resource('dokter-anestesi', DokterAnestesiController::class)->middleware('auth');
Route::resource('dokter', DokterController::class)->middleware('auth');

Route::get('/display', [DisplayController::class, 'display'])->name('display');

// Route::get('/dokter-anestesi', [DokterAnestesiController::class, 'index'])->name('dokter.index')->middleware('auth');
// Route::post('/dokter-anestesi/store', [DokterAnestesiController::class, 'store'])->name('dokter.store')->middleware('auth');
// Route::get('/dokter-anestesi/{id}/edit', [DokterAnestesiController::class, 'edit'])->name('dokter.edit')->middleware('auth');
// Route::put('/dokter-anestesi/{id}', [DokterAnestesiController::class, 'update'])->name('dokter.update')->middleware('auth');
// Route::post('/dokter-anestesi/{id}', [DokterAnestesiController::class, 'destroy'])->name('dokter.destroy')->middleware('auth');
