<?php 

use Project\Http\Route;

Route::get('/product/fetch',        'ProductController@fetch');
Route::post('/product/save',        'ProductController@store');
Route::delete('/product/deleteAll',        'ProductController@deleteAll');