<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController;

// returns the home page with all autos
Route::get('/', AutoController::class .'@index')->name('autos.index');
// returns the form for adding a auto
Route::get('/autos/create', AutoController::class . '@create')->name('autos.create');
// adds a auto to the database
Route::post('/autos', AutoController::class .'@store')->name('autos.store');
// returns a page that shows a full auto
Route::get('/autos/{auto}', AutoController::class .'@show')->name('autos.show');
// returns the form for editing a auto
Route::get('/autos/{auto}/edit', AutoController::class .'@edit')->name('autos.edit');
// updates a auto
Route::put('/autos/{auto}', AutoController::class .'@update')->name('autos.update');
// deletes a auto
Route::delete('/autos/{auto}', AutoController::class .'@destroy')->name('autos.destroy');
