<?php

namespace Foostart\Pnd;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL,
    Route;
use Illuminate\Http\Request;

class PndServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {

        /**
         * views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'pnd');

        /**
         * translation
         */
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'pnd');


        /**
         * Load view composer
         */
        $this->postViewComposer($request);


        /**
         * Publishes
         */
        $this->publishes([
            __DIR__ . '/config/pnd.php' => config_path('pnd.php'),
                ], 'pnd_config');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/pnd'),
                ], 'pnd_views');
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
                ], 'pnd_migrations');
        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/pnd'),
                ], 'pnd_public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';
    }

    /**
     *
     */
    public function postViewComposer(Request $request) {

        /**
         * USER sidebar menu
         */
        view()->composer(['pnd::pnd.user.*', 'pnd::pnd_category.user.*'], function ($view) {

            global $request;
            $pnd_id = $request->get('id');
            $is_action = empty($pnd_id) ? 'page_add' : 'page_edit';

            $authentication = \App::make('authenticator');
            $current_user = $authentication->getLoggedUser();

            $admin_pnds = [];

            if (config('buoumau.admin_id') == $current_user->id) {
                $admin_pnds = [
                    trans('pnd::pnd.pnd') => [
                        'url' => URL::route('admin_pnd'),
                        "icon" => '<i class="fa fa-users"></i>'
                    ]
                ];
            }

            $view->with('sidebar_items', array_merge([
                /**
                 * Pnds
                 */
                //list
                trans('pnd::pnd.page_list') => [
                    'url' => URL::route('user_pnd'),
                    "icon" => '<i class="fa fa-list" aria-hidden="true"></i>'
                ],
                //add
                trans('pnd::pnd.' . $is_action) => [
                    'url' => URL::route('user_pnd.edit'),
                    "icon" => '<i class="fa fa-plus" aria-hidden="true"></i>'
                ],
                /**
                 * Categories
                 */
                //list
                trans('pnd::pnd.page_category_list') => [
                    'url' => URL::route('user_pnd_category'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                            ], $admin_pnds));
            //
        });

        /**
         * ADMIN sidebar menu
         */
        view()->composer(['pnd::admin.*', 'pnd::pnd_category.admin.*'], function ($view) {
            global $request;
            $pnd_id = $request->get('id');
            $is_action = empty($pnd_id) ? 'page_add' : 'page_edit';

            $view->with('sidebar_items', [
                /**
                 * Pnds
                 */
                //list
                trans('pnd::pnd.page_list') => [
                    'url' => URL::route('admin_pnd'),
                    "icon" => '<i class="fa fa-list" aria-hidden="true"></i>'
                ],
                //add
                trans('pnd::pnd.' . $is_action) => [
                    'url' => URL::route('admin_pnd.edit'),
                    "icon" => '<i class="fa fa-plus" aria-hidden="true"></i>'
                ],
                /**
                 * About School
                 */
                //list
                trans('pnd::pnd.page_school_about_list') => [
                    'url' => URL::route('admin_pnd_school_about'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
            ]);
            //
        });

        /*
         * HỒ SƠ NGUYỆN VỌNG 1
         */

        view()->composer(['pnd::admin.management.pnd_school_about', 'pnd::admin.management.pnd_exam*',
               'pnd::admin.management.pnd_option_1_school_about*',
               'pnd::admin.management.pnd_option_1_item*',
               'pnd::admin.management.pnd_option_1_list*',
             'pnd::admin.management.pnd_option_1_search*',
            'pnd::admin.management.pnd_option_1_statistics*',
               'pnd::admin.management.pnd_option_2_item*',                     
               'pnd::admin.management.pnd_option_2_list*',     
             'pnd::admin.management.pnd_option_2_search*',
            'pnd::admin.management.pnd_option_2_statistics*',
            'pnd::admin.management.pnd_option_search*',
            'pnd::admin.management.pnd_option_statistics*',
              'pnd::admin.management.pnd_option_list*',
            'pnd::admin.management.pnd_option_item*',
            'pnd::admin.management.pnd_option_edit*',              
              'pnd::admin.management.pnd_option_point*',
                      
            
            ], function ($view) {
            global $request;
            $pnd_id = $request->get('id');
            $is_action = empty($pnd_id) ? 'page_add' : 'page_edit';

            $view->with('sidebar_items', [
                /**
                 * About School
                 */
                //list
                trans('pnd::pnd.page_school_about_list') => [
                    'url' => URL::route('admin_pnd_option_1_school_about'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
               
                
                  trans('pnd::pnd.page_option_point_list') => [
                    'url' => URL::route('admin_pnd_option_point_view'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                 /**
                 * option 1
                 */
                //list
                trans('pnd::pnd.page_option_1_list') => [
                    'url' => URL::route('admin_pnd_option_1'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * option 2
                 */
                //list
                trans('pnd::pnd.page_option_2_list') => [
                    'url' => URL::route('admin_pnd_option_2'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * option ky nay
                 */
                //list
                trans('pnd::pnd.page_option_list') => [
                    'url' => URL::route('admin_pnd_option'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * Examine
                 */
                //list
                trans('pnd::pnd.page_examine_list') => [
                    'url' => URL::route('admin_pnd_examine'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * Set exam identifi
                 */
                //list
                trans('pnd::pnd.page_exam_identification') => [
                    'url' => URL::route('admin_pnd_exam_identifi'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * Set exam room
                 */
                //list
                trans('pnd::pnd.page_exam_room_list') => [
                    'url' => URL::route('admin_pnd_exam_room'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                //list
                trans('pnd::pnd.page_school_test_list') => [
                    'url' => URL::route('admin_pnd_exame_school_test'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                
                //danh sách niem yết
                trans('pnd::pnd.page_school_room_list') => [
                    'url' => URL::route('admin_pnd_exame_school_room_list'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                //thong tin vang thi
                trans('pnd::pnd.page_school_room_vangthi_list') => [
                    'url' => URL::route('admin_pnd_exame_school_room_absent_list'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                
                 //xet tuyen theo chi tieu
                trans('pnd::pnd.page_school_examination') => [
                  'url' => URL::route('admin_pnd_examine_order'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                
                 //xet tuyen theo chi tieu
                trans('pnd::pnd.page_school_examination2') => [
                  'url' => URL::route('admin_pnd_examine_order2'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
            ]);
        });




        view()->composer(['pnd::admin.management.pnd_examine_point*', 'pnd::admin.management.pnd_district*',
            'pnd::admin.management.pnd_school_list*',
            'pnd::admin.management.pnd_school_item*',
            'pnd::admin.management.pnd_school_edit*',
            'pnd::admin.management.pnd_school_search*',
            'pnd::admin.management.pnd_school_statistics*',
            'pnd::admin.management.pnd_statistic*', 'pnd::admin.management.pnd_specialist*'], function ($view) {


            global $request;
            $pnd_id = $request->get('id');
            $is_action = empty($pnd_id) ? 'page_add' : 'page_edit';

            $view->with('sidebar_items', [
                /**
                 * config
                 */
                //list
                trans('pnd::pnd.page_config_category') => [
                    'url' => URL::route('admin_pexcel_category'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * Schools
                 */
                //list
                trans('pnd::pnd.page_school_list') => [
                    'url' => URL::route('admin_pnd_school'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * Districts
                 */
                //list
                trans('pnd::pnd.page_district_list') => [
                    'url' => URL::route('admin_pnd_district'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * Class=specialist
                 */
                //list
                trans('pnd::pnd.page_specialist_list') => [
                    'url' => URL::route('admin_pnd_specialist'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                /**
                 * Class=specialist
                 */
                //list
                trans('pnd::pnd.page_specialist_list') => [
                    'url' => URL::route('admin_pnd_specialist'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                //list
                trans('pnd::pnd.page_examine_point_list') => [
                    'url' => URL::route('admin_pnd_examine_point'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
            ]);
        });



        view()->composer(['laravel-authentication-acl::admin.user.edit',
            'laravel-authentication-acl::admin.user.groups',
            'laravel-authentication-acl::admin.user.list',
            'laravel-authentication-acl::admin.user.profile',
            'pnd::admin.users*'
                ], function ($view) {
            global $request;
            $pnd_id = $request->get('id');
            $is_action = empty($pnd_id) ? 'page_add' : 'page_edit';

            $view->with('sidebar_items', [
                /*
                 * default acl
                 */
                "Users list" => [
                    "url" => URL::route('users.list'),
                    "icon" => '<i class="fa fa-user"></i>'
                ],
                "Add user" => [
                    'url' => URL::route('users.edit'),
                    "icon" => '<i class="fa fa-plus-circle"></i>'
                ],
                /**
                 * Categories users
                 */
                //list
                trans('pnd::pnd.page_user_categories_list') => [
                    'url' => URL::route('admin_pnd_category_user'),
                    "icon" => '<i class="fa fa-users" aria-hidden="true"></i>'
                ],
            ]);
        });

        /*
         * XEM THÔNG TIN HỒ SƠ TUYỂN SINH
         */
        view()->composer([
            'pnd::admin.management.pnd_school_student_level*',
            'pnd::admin.management.pnd_statistics_level*',
                ], function ($view) {
            global $request;
            $pnd_id = $request->get('id');
            $is_action = empty($pnd_id) ? 'page_add' : 'page_edit';

            $view->with('sidebar_items', [
                trans('pnd::pnd.page_school_student_level_2_list') => [
                    'url' => URL::route('admin_pnd_school_student_level_2'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                 trans('pnd::pnd.page_school_student_level_3') => [
                    'url' => URL::route('admin_pnd_school_student_level_3'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                trans('pnd::pnd.page_school_statistics_level_2_list') => [
                    'url' => URL::route('admin_pnd_statistics_level_2'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                trans('pnd::pnd.page_school_statistics_level_3_list') => [
                    'url' => URL::route('admin_pnd_statistics_level_3'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                trans('pnd::pnd.page_school_statistics_test') => [
                    'url' => URL::route('admin_pnd_statistics_level_test'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                
            ]);
        });
    }

}
