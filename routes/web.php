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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin'], function (){
    // Theloai
    Route::group(['prefix'=>'theloai'], function (){
        // admin/theloai/add
        Route::get('list', 'TheLoaiController@getList');

        Route::get('add', 'TheLoaiController@getAdd');
        Route::post('add', 'TheLoaiController@postAdd');

        Route::get('edit/{id}', 'TheLoaiController@getEdit');
        Route::post('edit/{id}', 'TheLoaiController@postEdit');

        Route::get('delete/{id}', 'TheLoaiController@getDelete');
    });

    // Loaitin
     Route::group(['prefix'=>'loaitin'], function (){
        // admin/loaitin/add
        Route::get('list', 'LoaiTinController@getList');

         Route::get('add', 'LoaiTinController@getAdd');
         Route::post('add', 'LoaiTinController@postAdd');

         Route::get('edit/{id}', 'LoaiTinController@getEdit');
         Route::post('edit/{id}', 'LoaiTinController@postEdit');

         Route::get('delete/{id}', 'LoaiTinController@getDelete');
    });

     // Tintuc
     Route::group(['prefix'=>'tintuc'], function (){
        // admin/tintuc/add
        Route::get('list', 'TinTucController@getList');

        Route::get('add', 'TinTucController@getAdd');

        Route::get('edit', 'TinTucController@getEdit');
    });

    // User
     Route::group(['prefix'=>'user'], function (){
        // admin/user/add
        Route::get('list', 'UserController@getList');

        Route::get('add', 'UserController@getAdd');

        Route::get('edit', 'UserController@getEdit');
    });

    // Slide
     Route::group(['prefix'=>'slide'], function (){
        // admin/slide/add
        Route::get('list', 'SlideController@getList');

        Route::get('add', 'SlideController@getAdd');

        Route::get('edit', 'SlideController@getEdit');
    });

});