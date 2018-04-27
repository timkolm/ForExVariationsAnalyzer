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

Route::get('analyzer', function () {
    return view('analyzer.chart');
});

Route::post('analyze-it', 'AnalyzeController@show')->name('analyzator');
Route::get('analyze-it', function () {
    return view('analyzer.chart');
});
