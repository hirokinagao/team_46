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

Route::get('/admin', 'App\Http\Controllers\AdminController@admin');



/*******************
 * 月別一覧画面表示
 *******************/
Route::get('/monthly_list', 'App\Http\Controllers\Monthly_listController@monthly_list')->name('monthly_list');

