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
        Route::get('user/pnd', [
            'as' => 'user_pnd',
            'uses' => 'PexcelUserController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('user/pnd/edit', [
            'as' => 'user_pnd.edit',
            'uses' => 'PexcelUserController@edit'
        ]);

        /**
         * post
         */
        Route::post('user/pnd/post', [
            'as' => 'user_pnd.post',
            'uses' => 'PexcelUserController@post'
        ]);

        /**
         * delete
         */
        Route::get('user/pnd/delete', [
            'as' => 'user_pnd.delete',
            'uses' => 'PexcelUserController@delete'
        ]);

        /**
         * like
         */
        Route::post('user/pnd/like',[
            'as' => 'user_pnd.like',
            'uses' => 'PexcelUserController@like'
        ]);

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////POST ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('user/pnd_category', [
            'as' => 'user_pnd_category',
            'uses' => 'PexcelCategoryUserController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('user/pnd_category/edit', [
            'as' => 'user_pnd_category.edit',
            'uses' => 'PexcelCategoryUserController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('user/pnd_category/edit', [
            'as' => 'user_pnd_category.post',
            'uses' => 'PexcelCategoryUserController@post'
        ]);
        /**
         * delete
         */
        Route::get('user/pnd_category/delete', [
            'as' => 'user_pnd_category.delete',
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
        Route::get('admin/pnd', [
            'as' => 'admin_pnd',
            'uses' => 'PexcelAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pnd/edit', [
            'as' => 'admin_pnd.edit',
            'uses' => 'PexcelAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('admin/pnd/edit', [
            'as' => 'admin_pnd.post',
            'uses' => 'PexcelAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/pnd/delete', [
            'as' => 'admin_pnd.delete',
            'uses' => 'PexcelAdminController@delete'
        ]);

        /**
         * parse
         */
        Route::get('admin/pnd/parse', [
            'as' => 'admin_pnd.parse',
            'uses' => 'PexcelAdminController@parse'
        ]);

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('admin/pnd_category', [
            'as' => 'admin_pnd_category',
            'uses' => 'PexcelCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pnd_category/edit', [
            'as' => 'admin_pnd_category.edit',
            'uses' => 'PexcelCategoryAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('admin/pnd_category/edit', [
            'as' => 'admin_pnd_category.post',
            'uses' => 'PexcelCategoryAdminController@post'
        ]);
        /**
         * delete
         */
        Route::get('admin/pnd_category/delete', [
            'as' => 'admin_pnd_category.delete',
            'uses' => 'PexcelCategoryAdminController@delete'
        ]);
    });
});
