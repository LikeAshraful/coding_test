<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/companies', 'middleware' => 'auth'], function () {
    Route::get('/', 'CompanyController@index')->name('company.all');
    Route::get('/create', 'CompanyController@create')->name('company.create');
    Route::post('/create', 'CompanyController@store')->name('company.store');
    Route::get('/edit/{id}', 'CompanyController@edit')->name('company.edit');
    Route::post('/edit/{id}', 'CompanyController@update')->name('company.update');
    Route::get('/delete/{id}', 'CompanyController@destroy')->name('company.delete');
});
Route::group(['prefix' => '/employees', 'middleware' => 'auth'], function () {
    Route::get('/', 'EmployeeController@index')->name('employee.all');
    Route::get('/create', 'EmployeeController@create')->name('employee.create');
    Route::post('/create', 'EmployeeController@store')->name('employee.store');
    Route::get('/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    Route::post('/edit/{id}', 'EmployeeController@update')->name('employee.update');
    Route::get('/delete/{id}', 'EmployeeController@destroy')->name('employee.delete');
});

Route::group(['prefix' => '/employee'], function () {
    Route::get('/', 'EmployeeAuthController@index') ->name('employee.home')
    ->middleware('auth:webemployee');
    Route::get('/login', 'EmployeeAuthController@login')->name('employee.login');
    Route::post('/login', 'EmployeeAuthController@handleLogin')->name('employee.handleLogin');
    Route::get('/logout', 'EmployeeAuthController@index')->name('employee.logout');
});


