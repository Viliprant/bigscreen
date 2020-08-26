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

Route::get('/', 'FrontController@index')->name('front_poll');
Route::get('poll/{url}', 'FrontController@getPoll')->name('get_poll');

Route::post('poll', 'FrontController@addPoll')->name('add_poll');
Route::get('poll', function(){
    return redirect()->route('front_poll');
});

Auth::routes();

Route::get('/administration', 'HomeController@index')->name('admin');
