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
Route::get('code/captcha/{tmp}','Admin\LoginController@captcha');

//不需要登录的组
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function () {
    //后台登录
    Route::get('login','LoginController@login');
    //验证码路由
    Route::get('code','LoginController@code');
    //后台路由
    Route::post('doLogin','LoginController@dologin');
});

//登录权限组
Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'isLogin'],function (){
    //首页路由
    Route::get('index','LoginController@index');
    //后台欢迎页面
    Route::get('welcome','LoginController@welcome');
    Route::get('logout','LoginController@logout');
    //后台管理员相关路由|建立资源路由
    Route::resource('user','UserController');
});

