<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('exercises', 'ExerciseController@index');
Route::get('exercises/{exercise}', 'ExerciseController@show');
Route::post('exercises', 'ExerciseController@store');
Route::put('exercises', 'ExerciseController@update');
Route::delete('exercises/{exercise}', 'ExerciseController@delete');
