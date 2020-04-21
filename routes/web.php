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
Route::get('/', 'FrontendController@home')->name(HOME);
Route::get('frontend/category/{id}', 'FrontendController@category')->name(CATEGORY_DETAIL);

Route::group(['prefix' => 'admin'], function () {
    Route::get('/home', function () { return view('admin/home'); })->name(ADMIN_HOME);
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
    Route::group(['prefix' => 'slider'], function () {
        Route::get('/', 'SliderController@index')->name(SLIDER_INDEX);
        Route::get('/add', 'SliderController@add')->name(SLIDER_ADD);
        Route::post('/store', 'SliderController@store')->name(SLIDER_STORE);
        Route::get('/edit/{id}', 'SliderController@edit')->name(SLIDER_EDIT);
        Route::post('/update/{id}', 'SliderController@update')->name(SLIDER_UPDATE);
        Route::get('/delete/{id}', 'SliderController@delete')->name(SLIDER_DELETE);
    });
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/', 'SettingController@index')->name(SETTING_INDEX);
        Route::get('/add', 'SettingController@add')->name(SETTING_ADD);
        Route::post('/store', 'SettingController@store')->name(SETTING_STORE);
        Route::get('/edit/{id}', 'SettingController@edit')->name(SETTING_EDIT);
        Route::post('/update/{id}', 'SettingController@update')->name(SETTING_UPDATE);
        Route::get('/delete/{id}', 'SettingController@delete')->name(SETTING_DELETE);
    });
});
