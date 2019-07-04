<?php

Auth::routes();

Route::get('/', 'CatalogController@index')->name('catalog');
Route::get('/product/{all?}', 'CatalogController@index')
    ->name('product')
    ->where('all', '.*');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
