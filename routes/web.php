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

Route::get('/', 'QuestionController@index');


Route::resource('question','QuestionController')->except('show');
Route::resource('question.answer','AnswerController')->only(['store','edit','update','destroy']);
Route::get('question/{slug}','QuestionController@show')->name('question.show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/answer/{answer}/accept','AcceptAnswerController')->name('answer.accept');

Route::post('/question/{question}/favorites','FavoritesController@store')->name('question.favorite');
Route::delete('/question/{question}/favorites','FavoritesController@destroy')->name('question.unfavorite');

Route::post('/question/{question}/vote','VoteQuestionController');
Route::post('/answer/{answer}/vote','VoteAnswerController');