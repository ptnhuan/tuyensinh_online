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
            __DIR__.'/views'  => base_path('resources/views/vendor/pnd'),
        ], 'pnd_views');
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
                ], 'pnd_migrations');
        $this->publishes([
            __DIR__.'/public' => public_path('vendor/pnd'),
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

                /**
                 * Search
                 */
                //list
                trans('pnd::pnd.page_search') => [
                    'url' => URL::route('admin_pnd.search'),
                    "icon" => '<i class="fa fa-search" aria-hidden="true"></i>'
                ],
                
                
            ]);
            //
            
        });
        
        view()->composer([ 'laravel-authentication-acl::admin.user.edit',
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
                    "url"  => URL::route('users.list'),
                    "icon" => '<i class="fa fa-user"></i>'
                ],
                "Add user"   => [
                        'url'  => URL::route('users.edit'),
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
    }

}
