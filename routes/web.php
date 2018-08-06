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

/**
 * rest风格
 *
 * Route::get();    //获取资源
 * Route::post();   //创建资源
 * Route::put();    //更新资源
 * Route::patch();  //增量更新资源
 * Route::delete(); //删除资源
 * Route::option(); //查询资源支持的方法
 */

Route::get('/', function ()
{
    return redirect('login');
});

/**
 * 用户模块
 */
//注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
Route::post('/register', '\App\Http\Controllers\RegisterController@register');
//登陆页面
Route::get('/login', '\App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login', '\App\Http\Controllers\LoginController@login');


//权限控制，只有登陆过的用户可以查看
Route::group(['middleware' => 'auth:web'], function ()
{
    //登出行为
    Route::get('/logout', '\App\Http\Controllers\LoginController@Logout');
    //个人页面
    Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
    Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');
    /**
     * 文章模块
     */
    //文章列表页
    Route::get('/posts', '\App\Http\Controllers\PostController@index');
    //创建文章
    Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
    Route::post('/posts', '\App\Http\Controllers\PostController@store');
    //文章详情页
    Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
    //编辑文章
    Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
    Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
    //删除文章
    Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
    //图片上传
    Route::post('/posts/image/upload', '\App\Http\Controllers\PostController@imageUpload');
    //提交评论
    Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
    //赞和取消赞
    Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
    Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');

    //个人中心，粉，取消粉
    Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
    Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
    Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');

    //专题详情页,投稿
    Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
    Route::post('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');

});

include_once ('admin.php');
