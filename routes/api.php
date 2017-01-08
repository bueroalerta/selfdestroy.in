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

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

Route::post('/message/create', 'MessageController@create');
Route::get('/message/view/{code}', 'MessageController@view');
Route::get('/message/fetch/{code}', 'MessageController@fetch');
Route::post('/message/authenticate/{code}', 'MessageController@authenticate');