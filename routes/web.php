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

Route::post('/users', 'UserController@store');

Route::post('/instituitions', 'InstitutionController@store');

Route::post('/themes', 'ThemeController@store');

Route::post('/editions', 'EditionController@store');

Route::post('/articles', 'ArticleController@store');

Route::get('/', function () {
    return view('welcome');
});
