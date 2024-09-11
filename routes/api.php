<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController;

Route::get('/autos', [AutoController::class, 'index']);

Route::get('/autos/{id}', [AutoController::class, 'show']);

Route::post('/autos', [AutoController::class, 'store']);

Route::put('/autos/{id}', [AutoController::class, 'update']);

Route::patch('/autos/{id}', [AutoController::class, 'updatePartial']);

Route::delete('/autos/{id}', [AutoController::class, 'destroy']);
