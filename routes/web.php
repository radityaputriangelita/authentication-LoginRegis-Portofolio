<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\GalleryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });
Route::get('/createporto', [GalleryController::class, 'create'])->name('createPorto');
Route::get('/pageporto', [GalleryController::class, 'index'])->name('Porto');
Route::post('/storeporto', [GalleryController::class, 'store'])->name('storePorto');
Route::get('/editporto/{id}', [GalleryController::class, 'edit'])->name('editPorto');
Route::patch('/updateporto/{id}', [GalleryController::class, 'update'])->name('updatePorto');
Route::delete('/deleteporto/{id}', [GalleryController::class, 'destroy'])->name('deletePorto');


