<?php

use App\Http\Controllers\Admin\CategoryController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Auth::routes();

// Route::get('/admin', 'Admin\HomeController@index')->name('admin.home');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', 'PostController');
        Route::get('/categories', 'CategoryController@index')->name('categories');
        Route::get('/categorie/{slug}', 'CategoryController@show')->name('category_list');
    });

Route::get('{any?}', function() {
    return view('guests.home');
})->where('any', '.*');