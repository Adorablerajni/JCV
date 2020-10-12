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

// Route::domain('{username}.'.env('SESSION_DOMAIN'))->group(function(){
// 	Route::get('/', 'ProfileController@show')->name('profile');

// });
Route::get('/cache', function () {
    $exitCode = Artisan::call('cache:clear');
    echo "Application cleared cache";
});
Route::get('/config', function () {
    $exitCode = Artisan::call('config:clear');
    echo "Application cleared config";
});
Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    echo "database Migrated!";
});
// Route::get('/seed', function () {
//     $exitCode = Artisan::call('db:seed');
//     echo "Application cleared config";
// });
// Route::get('/link', function () {
//     $exitCode = Artisan::call('storage:link');
//     echo "Application cleared cache";
// });
// Route::get('/config', function () {
//     $exitCode = Artisan::call('config:clear');
//     echo "Application cleared config";
// });

// Route::get('/',function(){
// 	$users= \App\User::all();
// 	return view('profiles.index')->with('users',$users);
// })->name('root');

Route::get('/',function(){
	return view('welcome');
});

Auth::routes();

Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');				

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
		
Route::get('home', 'HomeController@index')->name('home');


 Route::prefix('admin')->group(function() {
     
    Route::get('register','Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
			
	Route::get('login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
			
	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
			
	Route::get('/', 'Auth\AdminController@index')->name('admin.dashboard');
			
}) ;