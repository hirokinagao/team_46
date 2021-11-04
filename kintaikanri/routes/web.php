<?php

use Illuminate\Support\Facades\Route;

/*
| 全員共通ファイル
*/

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



Route::get('/edit', 'App\Http\Controllers\EditController@edit')->name('edit');
Route::get('/work_time', 'App\Http\Controllers\Work_timeController@work_time')->name('work_time');