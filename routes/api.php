<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiGalleryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getgallery', [ApiGalleryController::class,'getgallery'])->name('ApiGetGallery');
Route::get('/gallery', [ApiGalleryController::class,'index'])->name('ApiGallery');
Route::get('/creategallery', [ApiGalleryController::class,'create'])->name('ApiCreateGallery');
Route::post('/postgallery', [ApiGalleryController::class,'storeGallery'])->name('ApiStoreGallery');