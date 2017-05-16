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
Route::group(['middleware' => ['web'],'prefix'=>'admin', 'namespace' => 'Foostart\Pnd\Controllers\Admin'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PEXCEL ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/pnd', [
            'as' => 'admin_pnd',
            'uses' => 'PndAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('/pnd/edit', [
            'as' => 'admin_pnd.edit',
            'uses' => 'PndAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('/pnd/edit', [
            'as' => 'admin_pnd.post',
            'uses' => 'PndAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('/pnd/delete', [
            'as' => 'admin_pnd.delete',
            'uses' => 'PndAdminController@delete'
        ]);

        /**
         * search
         */
        Route::get('/pnd/search', [
            'as' => 'admin_pnd.search',
            'uses' => 'PndAdminController@search'
        ]);

        /**
         * get school by district
         */
        Route::post('/pnd/school-by-district', [
            'as' => 'admin_pnd.school.district',
            'uses' => 'PndAdminController@getSchoolByDistrict'
        ]);


        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND SCHOOL ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/pnd_school', [
            'as' => 'admin_pnd_school',
            'uses' => 'PndSchoolAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('/pnd_school/edit', [
            'as' => 'admin_pnd_school.edit',
            'uses' => 'PndSchoolAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('/pnd_school/edit', [
            'as' => 'admin_pnd_school.post',
            'uses' => 'PndSchoolAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('/pnd_school/delete', [
            'as' => 'admin_pnd_school.delete',
            'uses' => 'PndSchoolAdminController@delete'
        ]);

          ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND DISTRICT ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/pnd_district', [
            'as' => 'admin_pnd_district',
            'uses' => 'PndDistrictAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('/pnd_district/edit', [
            'as' => 'admin_pnd_district.edit',
            'uses' => 'PndDistrictAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('/pnd_district/edit', [
            'as' => 'admin_pnd_district.post',
            'uses' => 'PndDistrictAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('/pnd_district/delete', [
            'as' => 'admin_pnd_district.delete',
            'uses' => 'PndDistrictAdminController@delete'
        ]);

          ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND DISTRICT ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/pnd_specialist', [
            'as' => 'admin_pnd_specialist',
            'uses' => 'PndSpecialistAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('/pnd_specialist/edit', [
            'as' => 'admin_pnd_specialist.edit',
            'uses' => 'PndSpecialistAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('/pnd_specialist/edit', [
            'as' => 'admin_pnd_specialist.post',
            'uses' => 'PndSpecialistAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('/pnd_specialist/delete', [
            'as' => 'admin_pnd_specialist.delete',
            'uses' => 'PndSpecialistAdminController@delete'
        ]);

    });
});
