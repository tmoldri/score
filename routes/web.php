<?php

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

//Authentication routes
Auth::routes();

//Main application routes
Route::get('/', function () {
    return view('welcome');
});

//Card routes
Route::get('/cards', 'CardController@index')->name('cards');
Route::get('/card/create', 'CardController@create')->name('card.create');
Route::post('/card/store', 'CardController@store')->name('card.store');
Route::get('/card/{id}/create-element', 'CardController@createElement')->name('card.create.element');
Route::post('/card/{id}/store-element', 'CardController@storeElement')->name('card.store.element');
Route::get('/card/{id}', 'CardController@show')->name('card.show');
Route::post('/card/{id}/score', 'CardController@score')->name('card.score');
