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


Route::post('/profile','Api\UserController@create');
Route::post('/login','Api\UserController@login');

Route::middleware('ApiAuth')->group(function (){
    Route::get('/logout','Api\UserController@logout');
    Route::get('/events','Api\EventController@all');

    Route::post('/registrations','Api\EventController@register');
    Route::get('/registrations','Api\UserController@events');
    Route::put('/registrations/{id}','Api\UserController@rate');

    Route::post('fetch/upload','FetchController@upload');
    Route::get('fetch/download','FetchController@download');
});


Route::get('diagrams/{event}','EventController@diagrams');