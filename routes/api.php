<?php

use App\Http\Controllers\GaleryController;
use App\Http\Controllers\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/places', [PlaceController::class, 'index']);
Route::get('/place/{id}', [PlaceController::class, 'show']);
Route::post('/place/create', [PlaceController::class, 'store']);
Route::post('/place/update/{id}', [PlaceController::class, 'update']);
Route::get('/place/delete/{id}', [PlaceController::class, 'destroy']);

Route::get('/galeries', [GaleryController::class, 'index']);
Route::get('/galery/{id}', [GaleryController::class, 'show']);
Route::post('/galery/create', [GaleryController::class, 'store']);
Route::post('/galery/update/{id}', [GaleryController::class, 'update']);
Route::get('/galery/delete/{id}', [GaleryController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});