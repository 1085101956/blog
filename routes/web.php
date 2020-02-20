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

//Route::get('/', function () {
//    return view('welcome');
//});
//用户添加路由

//提交
//Route::get('user/add','UserController@add');
//Route::post('user/store','UserController@store');
//Route::get('user/index','UserController@index');
//Route::get('user/edit/{id}','UserController@edit');
//Route::post('user/update','UserController@update');
//Route::get('user/del/{id}','UserController@destroy');
//后台登录
Route::get('admin/login','Admin\LoginController@login');
//验证码路由
Route::get('admin/code','Admin\LoginController@code');

