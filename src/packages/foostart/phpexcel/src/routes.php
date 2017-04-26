<?php

use Illuminate\Session\TokenMismatchException;

/**
 * GUEST
 */
Route::group(['middleware' => ['web'], 'namespace' => 'Foostart\Phpexcel\Controllers\Guest'], function () {
    Route::get('phpexcel', [
        'as' => 'phpexcel',
        'uses' => 'PhpexcelFrontController@index'
    ]);
});


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web'], 'namespace' => 'Foostart\Phpexcel\Controllers\Admin'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PHPEXCEL////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/phpexcel', [
            'as' => 'admin_phpexcel',
            'uses' => 'PhpexcelAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/phpexcel/edit', [
            'as' => 'admin_phpexcel.edit',
            'uses' => 'PhpexcelAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/phpexcel/edit', [
            'as' => 'admin_phpexcel.post',
            'uses' => 'PhpexcelAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/phpexcel/delete', [
            'as' => 'admin_phpexcel.delete',
            'uses' => 'PhpexcelAdminController@delete'
        ]);


        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES//////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('admin/phpexcel_category', [
            'as' => 'admin_phpexcel_category',
            'uses' => 'PhpexcelCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/phpexcel_category/edit', [
            'as' => 'admin_phpexcel_category.edit',
            'uses' => 'PhpexcelCategoryAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/phpexcel_category/edit', [
            'as' => 'admin_phpexcel_category.post',
            'uses' => 'PhpexcelCategoryAdminController@post'
        ]);
        
        /**
         * delete
         */
        Route::get('admin/phpexcel_category/delete', [
            'as' => 'admin_phpexcel_category.delete',
            'uses' => 'PhpexcelCategoryAdminController@delete'
        ]);
    });
});
