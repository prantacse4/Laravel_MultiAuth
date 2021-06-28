<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Auth::routes();


Route::middleware('admin')->group(function(){
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
});

Route::middleware('user')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware('doctor')->group(function(){
    Route::get('/doctor', [DoctorController::class, 'doctor'])->name('doctor');
});



    
    