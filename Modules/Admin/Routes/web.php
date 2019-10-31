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
//dang nhap
Route::prefix('/auth')->group(function (){
    Route::get('/login','AdminAuthController@getLogin')->name('admin.login');
    Route::post('/login','AdminAuthController@postLogin');
    Route::get('/logout','AdminAuthController@getLogout')->name('admin.logout');

    Route::get('/403','AdminAuthController@getErros')->name('admin.errors');
});

Route::prefix('admin')->middleware('CheckLoginAdmin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.home');

    //quan ly danh muc
    Route::group(['prefix'=>'category'],function(){
    	Route::get('/','AdminCategoryController@index')->name('admin.get.list.category');
    	Route::get('/create','AdminCategoryController@create')->name('admin.get.create.category')->middleware('role:admin');
    	Route::post('/create','AdminCategoryController@store');
        Route::get('/update/{id}','AdminCategoryController@edit')->name('admin.get.edit.category')->middleware('role:admin');
        Route::post('/update/{id}','AdminCategoryController@update');
        Route::get('/{action}/{id}','AdminCategoryController@action')->name('admin.get.action.category')->middleware('role:admin');
    });

    //quan ly san pham
    Route::group(['prefix'=>'product'],function(){
        Route::get('/','AdminProductController@index')->name('admin.get.list.product');
        Route::get('/create','AdminProductController@create')->name('admin.get.create.product')->middleware('role:admin');
        Route::post('/create','AdminProductController@store');
        Route::get('/update/{id}','AdminProductController@edit')->name('admin.get.edit.product')->middleware('role:admin');
        Route::post('/update/{id}','AdminProductController@update');
        Route::get('/{action}/{id}','AdminProductController@action')->name('admin.get.action.product')->middleware('role:admin');
    });

    //quan ly kho san pham
    Route::group(['prefix'=>'warehouse','middleware'=>'role:admin'],function(){
        Route::get('/','AdminWarehouseController@getWarehouseProduct')->name('admin.get.list.warehouse');
    });

    //quan ly bai viet
    Route::group(['prefix'=>'article'],function(){
        Route::get('/','AdminArticleController@index')->name('admin.get.list.article');
        Route::get('/create','AdminArticleController@create')->name('admin.get.create.article')->middleware('role:admin');
        Route::post('/create','AdminArticleController@store');
        Route::get('/update/{id}','AdminArticleController@edit')->name('admin.get.edit.article')->middleware('role:admin');
        Route::post('/update/{id}','AdminArticleController@update');
        Route::get('/{action}/{id}','AdminArticleController@action')->name('admin.get.action.article')->middleware('role:admin');
    });

    //quản lý đơn hàng
    Route::group(['prefix'=>'transaction','middleware'=>'role:admin'],function(){
        Route::get('/','AdminTransactionController@index')->name('admin.get.list.transaction');
        //chi tiet don hang
        Route::get('/view/{id}','AdminTransactionController@viewOrder')->name('admin.get.view.order');
        Route::get('/active/{id}','AdminTransactionController@activeTransaction')->name('admin.get.active.transaction');
        Route::get('/delete/{id}','AdminTransactionController@delete')->name('admin.get.delete.transaction');

        //export file dat phong
        Route::get('/export', 'AdminTransactionController@csv_export')->name('admin.transaction.export');
    });

    //quản lý thành viên
    Route::group(['prefix'=>'user'],function(){
        Route::get('/','AdminUserController@index')->name('admin.get.list.user');
        Route::get('/delete/{id}','AdminUserController@delete')->name('admin.get.delete.user')->middleware('role:admin');
    });

    //ma giam gia
    Route::group(['prefix'=>'discount'],function(){
        Route::get('/','AdminDiscountController@index')->name('admin.get.list.discount')->middleware('role:admin');
        Route::get('/create','AdminDiscountController@create')->name('admin.get.create.discount')->middleware('role:admin');
        Route::post('/create','AdminDiscountController@store')->name('admin.post.create.discount');
        Route::get('/update/{id}','AdminDiscountController@show')->name('admin.get.update.discount');
        Route::post('/update/{id}','AdminDiscountController@update')->name('admin.post.update.discount');
        Route::get('/delete/{id}','AdminDiscountController@delete')->name('admin.get.delete.discount')->middleware('role:admin');
    });

    //quản lý ban quản trị
    Route::group(['prefix'=>'administration'],function(){
        Route::get('/','AdminAdministrationController@index')->name('admin.get.list.admin');
        Route::get('/create','AdminAdministrationController@create')->name('admin.get.create.admin')->middleware('role:admin');
        Route::post('/create','AdminAdministrationController@store');
        Route::get('/update/{id}','AdminAdministrationController@edit')->name('admin.get.edit.admin')->middleware('role:admin');
        Route::post('/update/{id}','AdminAdministrationController@update');
        Route::get('/delete/{id}','AdminAdministrationController@delete')->name('admin.get.delete.admin')->middleware('role:admin');
    });

    //quan ly danh gia
    Route::group(['prefix'=>'rating'],function(){
        Route::get('/','AdminRatingController@index')->name('admin.get.list.rating');
        Route::get('/{action}/{id}','AdminRatingController@action')->name('admin.get.action.rating')->middleware('role:admin');
    });

    //quan ly lien he
    Route::group(['prefix' =>'contact'],function (){
        Route::get('/','AdminContactController@index')->name('admin.get.list.contact');
        Route::get('/action/{name}/{id}','AdminContactController@action')->name('admin.action.contact')->middleware('role:admin');
    });
    //quan ly page tinh
    Route::group(['prefix' =>'page-static'],function (){
        Route::get('/','AdminPageStaticController@index')->name('admin.get.list.page_static');
        Route::get('/create','AdminPageStaticController@create')->name('admin.get.create.page_static')->middleware('role:admin');
        Route::post('/create','AdminPageStaticController@store');
        Route::get('/update/{id}','AdminPageStaticController@edit')->name('admin.get.edit.page_static')->middleware('role:admin');
        Route::post('/update/{id}','AdminPageStaticController@update');
    });
});


