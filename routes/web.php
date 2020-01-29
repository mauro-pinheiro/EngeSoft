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

Route::group(['middleware' => 'auth'], function () {
    Route::post('/users', 'UserController@store');
    Route::post('/authors', 'UserController@find')->name('author.add');
    Route::get('/authors/create', 'UserController@createAuthor');
    Route::post('/authors/store', 'UserController@storeAuthor');

    Route::post('/instituitions', 'InstitutionController@store');

    Route::get('/themes/create', 'ThemeController@create');
    Route::post('/themes', 'ThemeController@store');

    Route::get('/editions', 'EditionController@index');
    Route::get('/editions/create', 'EditionController@create')->name('editions.create');
    Route::post('/editions', 'EditionController@store');
    Route::get('/editions/{edition}/submit', 'SubmissionController@create');
    Route::get('/editions/{edition}', 'EditionController@show')->name('editions.show');

    Route::post('/articles', 'ArticleController@store')->name('articles.store');
    Route::post('/articles/{article}/authors', 'ArticleController@addAuthor')->name('authors.add');
    Route::get('/articles/{article}', 'ArticleController@show')->name('articles.show');

    Route::get('/submissions', 'SubmissionController@index')->name('submissions.index');
    Route::get('/submissions/{submission}', 'SubmissionController@show')->name('submissions.show');
    Route::post('/submissions/{submission}', 'SubmissionController@update')->name('submissions.update');
    Route::post('/submissions', 'SubmissionController@store')->name('submissions.store');

    Route::get('/evaluations', 'EvaluationController@index')->name('evaluations.index');
    Route::get('/evaluations/{evaluation}/edit', 'EvaluationController@edit')->name('evaluations.edit');
    Route::post('/evaluations/{evaluation}', 'EvaluationController@update')->name('evaluations.update');

    Route::get('/home', 'HomeController@index')->name('home');
});


Route::get('/', function () {
    return redirect('home');
});

Auth::routes();
