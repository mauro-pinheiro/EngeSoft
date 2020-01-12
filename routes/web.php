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
Route::post('/authors', 'UserController@find');
Route::get('/authors/create', 'UserController@createAuthor');
Route::post('/authors/store', 'UserController@storeAuthor');

Route::post('/instituitions', 'InstitutionController@store');

Route::get('/themes/create', 'ThemeController@create');
Route::post('/themes', 'ThemeController@store');

Route::get('/editions', 'EditionController@index');
Route::get('/editions/create', 'EditionController@create');
Route::post('/editions', 'EditionController@store');
Route::get('/editions/{edition}/submit', 'SubmissionController@create');
Route::get('/editions/{edition}', 'EditionController@show');

Route::post('/articles', 'ArticleController@store');
Route::post('/articles/{article}/authors', 'ArticleController@addAuthor');
Route::get('/articles/{article}', 'ArticleController@show');

Route::get('/submissions/{submission}', 'SubmissionController@show');
// Route::get('/submissions/create', 'SubmissionController@create');
Route::post('/submissions', 'SubmissionController@store');

Route::post('/evaluations', 'EvaluationController@store');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
