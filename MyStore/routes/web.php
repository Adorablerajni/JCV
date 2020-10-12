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

Route::get('/', function(){
    return view('welcome');
});
Route::get('/contact', function(){
    return view('contact');
});
Route::get('/about', function(){
	// $article = App\Articles::take(2)->get();

	// $article = App\Articles::paginate(2);
	
    return view('about',['articles' =>App\Articles::latest()->get()]);
});
Route::get('articles','ArticlesController@index')->name('articles.index');
Route::get('articles/create','ArticlesController@create');
Route::get('articles/{article}','ArticlesController@show')->name('articles.show');
Route::post('articles','ArticlesController@store');
Route::get('articles/{article}/edit','ArticlesController@edit');
Route::put('articles/{article}','ArticlesController@update');