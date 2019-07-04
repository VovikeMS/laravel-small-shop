<?php

Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');
