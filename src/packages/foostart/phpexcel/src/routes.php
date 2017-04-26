<?php

use Illuminate\Session\TokenMismatchException;

/**
 * REQEUST
 */
Route::group(['middleware' => ['web'], 'namespace' => 'Foostart\Phpexcel\Controllers'], function () {


    ////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////POST///////////////////////////////////////
    /**
     * Get list of posts with conditions
     * -per_page
     * -page
     * -aid
     * -uid
     */
    Route::get('phpexcel/posts', [
        'as' => 'phpexcel_get_posts',
        'uses' => 'PhpexcelAdminController@get_posts'
    ]);

    /**
     * Add new post
     */
    Route::post('phpexcel/add_post', [
        'as' => 'phpexcel_add_post',
        'uses' => 'PostController@add_post'
    ]);

    /**
     * Update existing post
     */
    Route::put('phpexcel/put_post', [
        'as' => 'phpexcel_put_post',
        'uses' => 'PostController@put_post'
    ]);

    /**
     * Delete existing post
     */
    Route::delete('phpexcel/delete_post', [
        'as' => 'phpexcel_delete_post',
        'uses' => 'PostController@delete_post'
    ]);


});

/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web'], 'namespace' => 'Foostart\Phpexcel\Controllers\Admin'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * phpexcel
         */
        Route::get('admin/phpexcel', [
            'as' => 'admin_phpexcel',
            'uses' => 'PhpexcelAdminController@index'
        ]);
        /**
         * phpexcel edit
         */
        Route::get('admin/phpexcel/edit', [
            'as' => 'admin_phpexcel.edit',
            'uses' => 'PhpexcelAdminController@edit'
        ]);
        Route::post('admin/phpexcel/post', [
            'as' => 'admin_phpexcel.post',
            'uses' => 'PhpexcelAdminController@post'
        ]);
         Route::post('admin/phpexcel/delete', [
            'as' => 'admin_phpexcel.delete',
            'uses' => 'PhpexcelAdminController@delete'
        ]);
        /**
         * phpexcel post
         */
        Route::get('admin/phpexcel/generate', [
            'as' => 'admin_phpexcel.generate',
            'uses' => 'PhpexcelAdminController@post'
        ]);
    });
});

