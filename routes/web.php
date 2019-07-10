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

// Route::get('/', function () {
//     // return view('welcome');

// });

Route::get('/', ['as' => 'task.index', 'uses' => 'TaskController@index']);
Route::post('/sortabledatatable', ['as' => 'task.updateOrder', 'uses' => 'TaskController@updateOrder']);
Route::post('/upload/image', ['as' => 'task.save', 'uses' => 'TaskController@store']);
Route::delete('/task/delete/{task}', ['as' => 'task.destroy', 'uses' => 'TaskController@destroy']);

