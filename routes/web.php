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
    return view('home');
});

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Auth::routes(['verify' => true, 'register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/products/add', 'ProductController@add')->name('add');
Route::any('/products/search_products', 'ProductController@search_products')->name('search_products');
Route::get('/events/eventlog', 'EventController@index')->name('events');
Route::get('/events/search_event', 'EventController@search_event')->name('search_events');
Route::get('/events/add_event', 'EventController@add_event')->name('add_events');
Route::post('/events/add_event', 'EventController@add_event')->name('add_events');
Route::post('/events/deactivate', 'EventController@deactivate')->name('deactivate');
Route::post('/products/update', 'ProductController@update')->name('update');
Route::post('/products/add', 'ProductController@create')->name('create');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/users', 'UsersController');
});

