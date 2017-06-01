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
Route::group(['middleware' => ['web'], 'namespace' => 'Foostart\Pnd\Controllers\User'], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////POST ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('user/profile', [
            'as' => 'user_profile',
            'uses' => 'UserController@index'
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
            'uses' => 'UserController@post'
        ]);


        /**
         * view info
         */
        Route::get('user/student/view', [
            'as' => 'user.student.view',
            'uses' => 'UserController@index'
        ]); 
    });
});

/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web'], 'prefix' => '', 'namespace' => 'Foostart\Pnd\Controllers\Front'], function () {

    Route::get('/front_statistics/level_2', [
        'as' => 'front_pnd_statistics_level_2',
        'uses' => 'PndStatisticsAdminController@index'
    ]);
    
     Route::get('/front_statistics/level_3', [
            'as' => 'front_pnd_statistics_level_3',
            'uses' => 'PndStatisticsAdminController@index_3'
        ]);
});

/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web'], 'prefix' => 'admin', 'namespace' => 'Foostart\Pnd\Controllers\Admin'], function () {

     
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
        ////////////////////////////PND VIEWER ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////

        Route::get('/viewer', [
            'as' => 'admin_viewer',
            'uses' => 'PndAdminController@school_student_index'
        ]);
               
         Route::get('/pnd_school_student/level_2', [
            'as' => 'admin_pnd_school_student_level_2',
            'uses' => 'PndAdminController@school_student_index'
        ]);
         
        Route::get('/pnd_statistics/level_2', [
            'as' => 'admin_pnd_statistics_level_2',
            'uses' => 'PndStatisticsAdminController@index'
        ]);
        
          Route::get('/pnd_statistics/level_3', [
            'as' => 'admin_pnd_statistics_level_3',
            'uses' => 'PndStatisticsAdminController@index_3'
        ]);     
        
        
        
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND SCHOOL ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////

        Route::get('/manager', [
            'as' => 'admin_manager',
            'uses' => 'PndSchoolAdminController@index'
        ]);
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

        Route::get('/pnd_school_about', [
            'as' => 'admin_pnd_school_about',
            'uses' => 'PndSchoolAdminController@about'
        ]);
        Route::post('/pnd_school_about', [
            'as' => 'admin_pnd_school_about.post',
            'uses' => 'PndSchoolAdminController@post_about'
        ]);

        
          ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND SCHOOL TEST ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/pnd_school_test', [
            'as' => 'admin_pnd_exame_school_test',
            'uses' => 'PndSchoolTestAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('/pnd_school_test/edit', [
            'as' => 'admin_pnd_exame_school_test.edit',
            'uses' => 'PndSchoolTestAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('/pnd_school_test/edit', [
            'as' => 'admin_pnd_exame_school_test.post',
            'uses' => 'PndSchoolTestAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('/pnd_school_test/delete', [
            'as' => 'admin_pnd_exame_school_test.delete',
            'uses' => 'PndSchoolTestAdminController@delete'
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

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND OPTION  ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        
          Route::get('/pnd_option_1_school_about', [
            'as' => 'admin_pnd_option_1_school_about',
            'uses' => 'PndSchoolAdminController@index_about_level_3'
        ]);
        Route::post('/pnd_option_1_school_about', [
            'as' => 'admin_pnd_option_1_school_about.post',
            'uses' => 'PndSchoolAdminController@post_about_level_3'
        ]);
         /**
         * option 1
         */
        Route::get('/pnd_option_1', [
            'as' => 'admin_pnd_option_1',
            'uses' => 'PndAdminOptionController@index'
        ]);
        
        
             
             
              /**
         * option 1
         */
        Route::get('/pnd_option_2', [
            'as' => 'admin_pnd_option_2',
            'uses' => 'PndAdminOptionController@index2'
        ]);
                                /**
         * option 1
         */
        Route::get('/pnd_option', [
            'as' => 'admin_pnd_option',
            'uses' => 'PndAdminOptionController@index3'
        ]);
        
           
           
            Route::get('/pnd_option_student/edit', [
            'as' => 'admin_pnd_option.edit',
            'uses' => 'PndAdminOptionController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('/pnd_option_student/edit', [
             'as' => 'admin_pnd_option.post',
            'uses' => 'PndAdminOptionController@post'
        ]);

           
           
           
           
           
           
           
             Route::get('/pnd_option/delete', [
            'as' => 'admin_pnd_option.delete',
            'uses' => 'PndAdminOptionController@delete'
        ]);
        /**
         * list
         */
        Route::get('/pnd_examine_point', [
            'as' => 'admin_pnd_examine_point',
            'uses' => 'PndExaminepointAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('/pnd_examine_point/edit', [
            'as' => 'admin_pnd_examine_point.edit',
            'uses' => 'PndExaminepointAdminController@edit'
        ]);

        /**
         * pnd
         */
        Route::post('/pnd_examine_point/edit', [
            'as' => 'admin_pnd_examine_point.post',
            'uses' => 'PndExaminepointAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('/pnd_examine_point/delete', [
            'as' => 'admin_pnd_examine_point.delete',
            'uses' => 'PndExaminepointAdminController@delete'
        ]);
        /**
         * edit-point
         */ 
        Route::post('/pnd_examine_point', [
            'as' => 'admin_pnd_examine_point',
            'uses' => 'PndExaminepointAdminController@prior'
        ]);


        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////PND EXAMINE ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/pnd_examine', [
            'as' => 'admin_pnd_examine',
            'uses' => 'PndExamWorkAdminController@index'
        ]);


        /**
         * set point
         */
        Route::get('/pnd_examine/point', [
            'as' => 'admin_pnd_examine.point',
            'uses' => 'PndExamWorkAdminController@point'
        ]);
        
          /**
         * set indentifi
         */
        Route::get('/pnd_examine/identifi', [
            'as' => 'admin_pnd_exam_identifi',
            'uses' => 'PndExamWorkAdminController@identifi'
        ]); 
        /**
         * set point
         */
        Route::get('/pnd_examine/room', [
            'as' => 'admin_pnd_exam_room',
            'uses' => 'PndExamWorkAdminController@room'
        ]);
        
         /**
         * set tatistics_level_2
         */

        
        
        
        /*         * ********************************************************************
         * USER CATEGORY
         */
        /**
         *
         */
        Route::get('/users/category/list', [
            'as' => 'admin_pnd_category_user',
            'uses' => 'PndCategoryUserController@index'
        ]);
        Route::get('/users/category/edit', [
            'as' => 'admin_pnd_category_user.edit',
            'uses' => 'PndCategoryUserController@edit'
        ]);
        Route::post('/users/category/edit', [
            'as' => 'admin_pnd_category_user.post',
            'uses' => 'PndCategoryUserController@post'
        ]);
        Route::get('/users/category/delete', [
            'as' => 'admin_pnd_category_user.delete',
            'uses' => 'PndCategoryUserController@delete'
        ]); 
    });
});
