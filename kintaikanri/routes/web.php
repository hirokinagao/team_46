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


// Route::get('/', function () {
//     return view('welcome');
// });

/*******************
 * ログイン画面表示
 *******************/
Route::get('/', 'App\Http\Controllers\LoginController@login')->name('login');

/*******************
 * ログイン機能
 *******************/
Route::post('/login_session', 'App\Http\Controllers\LoginController@session')->name('session');

/*******************
 * 管理者画面表示
 *******************/
Route::any('/admin', 'App\Http\Controllers\AdminController@admin')->name('admin');

/*******************
 * 検索結果表示機能
 *******************/
Route::post('/search', 'App\Http\Controllers\AdminController@search')->name('search');




/*******************
 * 月別一覧画面表示
 *******************/
Route::get('/monthly_list', 'App\Http\Controllers\Monthly_listController@monthly_list')->name('monthly_list');



Route::get('/edit', 'App\Http\Controllers\EditController@edit')->name('edit');
Route::get('/work_time', 'App\Http\Controllers\Work_timeController@work_time')->name('work_time');
