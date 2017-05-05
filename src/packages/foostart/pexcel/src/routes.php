<?php

use Illuminate\Session\TokenMismatchException;

/**
 * USER
 */
Route::group(['middleware' => ['web'],  'Foostart\Pexcel\Controllers\Admin'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////POST ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('user/pexcel', [
            'as' => 'user_pexcel',
            'uses' => 'PexcelUserController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('user/pexcel/edit', [
            'as' => 'user_pexcel.edit',
            'uses' => 'PexcelUserController@edit'
        ]);

        /**
         * pexcel
         */
        Route::post('user/pexcel/edit', [
            'as' => 'user_pexcel.post',
            'uses' => 'PexcelUserController@post'
        ]);

        /**
         * delete
         */
        Route::get('user/pexcel/delete', [
            'as' => 'user_pexcel.delete',
            'uses' => 'PexcelUserController@delete'
        ]);

        /**
         * like
         */
        Route::post('user/pexcel/like',[
            'as' => 'user_pexcel.like',
            'uses' => 'PexcelUserController@like'
        ]);

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////POST ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('user/pexcel_category', [
            'as' => 'user_pexcel_category',
            'uses' => 'PexcelCategoryUserController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('user/pexcel_category/edit', [
            'as' => 'user_pexcel_category.edit',
            'uses' => 'PexcelCategoryUserController@edit'
        ]);

        /**
         * pexcel
         */
        Route::post('user/pexcel_category/edit', [
            'as' => 'user_pexcel_category.post',
            'uses' => 'PexcelCategoryUserController@post'
        ]);
        /**
         * delete
         */
        Route::get('user/pexcel_category/delete', [
            'as' => 'user_pexcel_category.delete',
            'uses' => 'PexcelCategoryUserController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web'],  'namespace' => 'Foostart\Pexcel\Controllers\Admin'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PEXCEL ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/pexcel', [
            'as' => 'admin_pexcel',
            'uses' => 'PexcelAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pexcel/edit', [
            'as' => 'admin_pexcel.edit',
            'uses' => 'PexcelAdminController@edit'
        ]);

        /**
         * pexcel
         */
        Route::post('admin/pexcel/edit', [
            'as' => 'admin_pexcel.post',
            'uses' => 'PexcelAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/pexcel/delete', [
            'as' => 'admin_pexcel.delete',
            'uses' => 'PexcelAdminController@delete'
        ]);

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('admin/pexcel_category', [
            'as' => 'admin_pexcel_category',
            'uses' => 'PexcelCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pexcel_category/edit', [
            'as' => 'admin_pexcel_category.edit',
            'uses' => 'PexcelCategoryAdminController@edit'
        ]);

        /**
         * pexcel
         */
        Route::post('admin/pexcel_category/edit', [
            'as' => 'admin_pexcel_category.post',
            'uses' => 'PexcelCategoryAdminController@post'
        ]);
        /**
         * delete
         */
        Route::get('admin/pexcel_category/delete', [
            'as' => 'admin_pexcel_category.delete',
            'uses' => 'PexcelCategoryAdminController@delete'
        ]);
    });
});
