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

Route::any('tasks','TasksController@index')->name('tasks.index');

Route::get('tasks/create','TasksController@create')->name('tasks.create');

Route::post('tasks/store','TasksController@store')->name('tasks.store');

Route::get('tasks/{id}/edit','TasksController@edit')->name('tasks.edit');

Route::post('tasks/{id}/update','TasksController@update')->name('tasks.update');

Route::get('tasks/{id}/show','TasksController@show')->name('tasks.show');

Route::get('tasks/{id}/destroy','TasksController@destroy')->name('tasks.destroy');