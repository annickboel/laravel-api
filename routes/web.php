<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

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
Route::post('register', 'UserController@store');
//Route::get('users', 'UserController@index');

Route::get('restaurants', 'RestaurantController@index');
/*Route::post('restaurant', 'RestaurantController@store');
Route::get('restaurant/{id}', 'RestaurantController@show');
Route::update('restaurant/{id}', 'RestaurantController@update');
Route::delete('restaurant/{id}', 'RestaurantController@destroy');*/

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
