<?php

use Carbon\Carbon;
use App\Models\JadwalOK;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Route::get('/display', [DisplayController::class, 'display'])->name('display');
