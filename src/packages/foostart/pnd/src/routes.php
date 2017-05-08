<?php

use Illuminate\Session\TokenMismatchException;

Route::group(['middleware' => ['web'], 'Foostart\Pnd\Controllers\Admin'], function () {
//    Route::post('/user/login', [
//        "uses" => 'VendorController@postAdminLogin',
//        "as" => "user.login.process"
//    ]);
});



/**
 * USER
 */
Route::group(['middleware' => ['web'], 'Foostart\Pnd\Controllers\Admin'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////POST ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('user/pnd', [
            'as' => 'user_pnd',
            'uses' => 'PndUserController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('user/pnd/edit', [
            'as' => 'user_pnd.edit',
            'uses' => 'PndUserController@edit'
        ]);

        /**
         * post
         */
        Route::post('user/pnd/post', [
            'as' => 'user_pnd.post',
            'uses' => 'PndUserController@post'
        ]);

        /**
         * delete
         */
        Route::get('user/pnd/delete', [
            'as' => 'user_pnd.delete',
            'uses' => 'PndUserController@delete'
        ]);

        /**
         * like
         */
        Route::post('user/pnd/like', [
            'as' => 'user_pnd.like',
            'uses' => 'PndUserController@like'
        ]);

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////POST ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('user/pnd_category', [
            'as' => 'user_pnd_category',
            'uses' => 'PndCategoryUserController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('user/pnd_category/edit', [
            'as' => 'user_pnd_category.edit',
            'uses' => 'PndCategoryUserController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('user/pnd_category/edit', [
            'as' => 'user_pnd_category.post',
            'uses' => 'PndCategoryUserController@post'
        ]);
        /**
         * delete
         */
        Route::get('user/pnd_category/delete', [
            'as' => 'user_pnd_category.delete',
            'uses' => 'PndCategoryUserController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web'], 'namespace' => 'Foostart\Pnd\Controllers\Admin'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PEXCEL ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/pnd', [
            'as' => 'admin_pnd',
            'uses' => 'PndAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pnd/edit', [
            'as' => 'admin_pnd.edit',
            'uses' => 'PndAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('admin/pnd/edit', [
            'as' => 'admin_pnd.post',
            'uses' => 'PndAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/pnd/delete', [
            'as' => 'admin_pnd.delete',
            'uses' => 'PndAdminController@delete'
        ]);

        /**
         * parse
         */
        Route::get('admin/pnd/parse', [
            'as' => 'admin_pnd.parse',
            'uses' => 'PndAdminController@parse'
        ]);


        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND SCHOOL ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/pnd_school', [
            'as' => 'admin_pnd_school',
            'uses' => 'PndSchoolAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pnd_school/edit', [
            'as' => 'admin_pnd_school.edit',
            'uses' => 'PndSchoolAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('admin/pnd_school/edit', [
            'as' => 'admin_pnd_school.post',
            'uses' => 'PndSchoolAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/pnd_school/delete', [
            'as' => 'admin_pnd_school.delete',
            'uses' => 'PndSchoolAdminController@delete'
        ]);



        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('admin/pnd_category', [
            'as' => 'admin_pnd_category',
            'uses' => 'PndCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/pnd_category/edit', [
            'as' => 'admin_pnd_category.edit',
            'uses' => 'PndCategoryAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('admin/pnd_category/edit', [
            'as' => 'admin_pnd_category.post',
            'uses' => 'PndCategoryAdminController@post'
        ]);
        /**
         * delete
         */
        Route::get('admin/pnd_category/delete', [
            'as' => 'admin_pnd_category.delete',
            'uses' => 'PndCategoryAdminController@delete'
        ]);
    });
});
