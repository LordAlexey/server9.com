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


Route::prefix('BY_JS-PHP_A')->middleware('adminAuth')->group(function (){
    Route::get('/', 'EventController@index');
    Route::get('/create', 'EventController@create')->name('create');
    Route::post('/create', 'EventController@store');
    Route::get('/detail/{event}', 'EventController@detail')->name('detail');
    Route::get('/edit/{event}', 'EventController@edit')->name('edit');
    Route::post('/edit/{event}', 'EventController@update');
    Route::get('/list/{event}', 'EventController@attList')->name('list');
    Route::get('export/{event}','EventController@export')->name('export');

    Route::get('import/{event}','EventController@import')->name('import');
    Route::post('import/{event}','EventController@importSave');
    Route::get('reports/{event}','EventController@reports')->name('reports');

});

Route::prefix('BY_JS-PHP_A')->group(function (){
    Auth::routes();
});

