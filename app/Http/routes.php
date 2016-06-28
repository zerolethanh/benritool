<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('addr', 'AddrController');
Route::resource('/gpw', 'gpwController');
Route::resource('/uuid', 'UuidController');

Route::controller('/imgs', 'ImgController');
Route::resource('/checkemail', 'CheckEmailController');
Route::resource('/cal', 'CalendarController');
Route::resource('/timesheet', 'TimesheetController');
Route::resource('/wallet', 'WalletController');
Route::resource('/money', 'MoneyController');