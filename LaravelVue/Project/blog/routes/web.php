<?php

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
 Route::post('/app/create_tag','AdminController@addTag');
 Route::post('/app/update_tag','AdminController@updateTag');
 Route::post('/app/delete_tag','AdminController@deleteTag');
 Route::get('/app/get_tags','AdminController@getTag');
 Route::get('/tags', function () {
    return view('welcome');
});