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

Route::get('/admin', 'AdminController@loginAdmin')->name(ADMIN_LOGIN);
Route::post('/admin', 'AdminController@postLoginAdmin')->name(ADMIN_LOGIN);

Route::get('/home', function () {
    return view('/home');
});
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@index')->name(CATEGORY_INDEX);
        Route::get('/add', 'CategoryController@add')->name(CATEGORY_ADD);
        Route::post('/store', 'CategoryController@store')->name(CATEGORY_STORE);
        Route::get('/edit/{id}', 'CategoryController@edit')->name(CATEGORY_EDIT);
        Route::post('/update/{id}', 'CategoryController@update')->name(CATEGORY_UPDATE);
        Route::get('/delete/{id}', 'CategoryController@delete')->name(CATEGORY_DELETE);
    });
    Route::group(['prefix' => 'menus'], function () {
        Route::get('/', 'MenuController@index')->name(MENU_INDEX);
        Route::get('/add', 'MenuController@add')->name(MENU_ADD);
        Route::post('/store', 'MenuController@store')->name(MENU_STORE);
        Route::get('/edit/{id}', 'MenuController@edit')->name(MENU_EDIT);
        Route::post('/update/{id}', 'MenuController@update')->name(MENU_UPDATE);
        Route::get('/delete/{id}', 'MenuController@delete')->name(MENU_DELETE);
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'AdminProductController@index')->name(PRODUCT_INDEX);
        Route::get('/add', 'AdminProductController@add')->name(PRODUCT_ADD);
        Route::post('/store', 'AdminProductController@store')->name(PRODUCT_STORE);
        Route::get('/edit/{id}', 'AdminProductController@edit')->name(PRODUCT_EDIT);
        Route::post('/update/{id}', 'AdminProductController@update')->name(PRODUCT_UPDATE);
        Route::get('/delete/{id}', 'AdminProductController@delete')->name(PRODUCT_DELETE);
    });
});
