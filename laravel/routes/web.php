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
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::any('/home/repair','HomeController@repair');
Route::any('/home/question','HomeController@question');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {  
    Route::get('/', 'HomeController@index');
});
Route::get('article/{id?}','TestController@article')->where(['id'=>'[0-9]+']);
Route::get('add','TestController@add');
Route::get('delete/{id}','TestController@delete')->where(['id'=>'[0-9]+']);


