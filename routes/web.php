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
        Route::post('add', 'TinTucController@postAdd');

        Route::get('edit/{id}', 'TinTucController@getEdit');
        Route::post('edit/{id}', 'TinTucController@postEdit');

         Route::get('delete/{id}', 'TinTucController@getDelete');
    });

    // BinhLuan
    Route::group(['prefix'=>'comment'], function (){
        Route::get('delete/{id}/{idTinTuc}', 'CommentController@getDelete');
    });

    // Slide
    Route::group(['prefix'=>'slide'], function (){
        // admin/tintuc/add
        Route::get('list', 'SlideController@getList');

        Route::get('add', 'SlideController@getAdd');
        Route::post('add', 'SlideController@postAdd');

        Route::get('edit/{id}', 'SlideController@getEdit');
        Route::post('edit/{id}', 'SlideController@postEdit');

        Route::get('delete/{id}', 'SlideController@getDelete');
    });

    // User
     Route::resource('user', 'UserController');

    // Slide
     Route::group(['prefix'=>'slide'], function (){
        // admin/slide/add
        Route::get('list', 'SlideController@getList');

        Route::get('add', 'SlideController@getAdd');

        Route::get('edit', 'SlideController@getEdit');
    });

     Route::group(['prefix'=>'ajax'], function (){
        Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
     });

});