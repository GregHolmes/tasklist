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
    return view('task');
});

Route::get('/api', 'TasksController@getTasks');
Route::get('/closeTask/{id}', 'TasksController@closeTask');
Route::get('/getTasks', 'TasksController@getTasks');
Route::post('/addTask', 'TasksController@addTask');



