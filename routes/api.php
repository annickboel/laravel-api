<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'UserController@store');
Route::post('/auth', 'UserController@login');
Route::get('/users', 'UserController@index');

Route::get('/restaurants', 'RestaurantController@index');
Route::post('/restaurant', 'RestaurantController@store');
Route::put('/restaurant/{id}', 'RestaurantController@update');
Route::delete('/restaurant/{id}', 'RestaurantController@destroy');

Route::get('/restaurant/{id}/menus', 'MenuController@index');
Route::post('/restaurant/{id}/menu', 'MenuController@store');
Route::put('/restaurant/{restaurant_id}/menu/{id}', 'MenuController@update');
Route::delete('/restaurant/{restaurant_id}/menu/{id}', 'MenuController@destroy');



