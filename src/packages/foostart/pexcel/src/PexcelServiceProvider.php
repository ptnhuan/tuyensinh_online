<?php

namespace Foostart\Pexcel;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL,
    Route;
use Illuminate\Http\Request;

class PexcelServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {

        /**
         * views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'pexcel');

        /**
         * translation
         */
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'pexcel');


        /**
         * Load view composer
         */
        $this->postViewComposer($request);


        /**
         * Publishes
         */
        $this->publishes([
            __DIR__ . '/config/pexcel.php' => config_path('pexcel.php'),
                ], 'pexcel_config');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/pexcel'),
                ], 'pexcel_views');
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
                ], 'pexcel_migrations');
        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/pexcel'),
                ], 'pexcel_public');
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

  view()->composer(['pexcel::admin.update_pexcel_list','pexcel::admin.update_pexcel_edit'], function ($view) {
      
            global $request;
            $pexcel_id = $request->get('id');
            
            $is_action = empty($pexcel_id) ? 'page_add' : 'page_edit';

            $auth_helper = \App::make('authentication_helper');
            $is_admin = FALSE;
            $is_all = FALSE;

            if ($auth_helper->hasPermission(array('_superadmin'))) {
                $is_admin = TRUE;
            }

            if ($auth_helper->hasPermission(array('_all-pexcel'))) {
                $is_all = TRUE;
            }

            $manage_category = [];
            if ($is_admin || $is_all) {
                $manage_category = [
                    trans('pexcel::pexcel.page_category_list') => [
                        'url' => URL::route('admin_pexcel_category'),
                        "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                    ]
                ];
            }

            $view->with('sidebar_items', array_merge([
                /**
                 * Pexcels
                 */
                //list
              
               
                 trans('pexcel::pexcel.page_listu') => [
                    'url' => URL::route('admin_update_pexcel'),
                    "icon" => '<i class="fa fa-list" aria-hidden="true"></i>'
                ],
                //add
         
                trans('pexcel::pexcel.' . $is_action) => [
                    'url' => URL::route('admin_update_pexcel.edit'),
                    "icon" => '<i class="fa fa-plus" aria-hidden="true"></i>'
                ],
                
            ], $manage_category));
            //
        });
        
        
        /**
         * ADMIN sidebar menu
         */
        view()->composer(['pexcel::admin.pexcel*', 'pexcel::pexcel_category.admin.*'], function ($view) {
       
            global $request;
            $pexcel_id = $request->get('id');
            $is_action = empty($pexcel_id) ? 'page_add' : 'page_edit';

            $auth_helper = \App::make('authentication_helper');
            $is_admin = FALSE;
            $is_all = FALSE;

            if ($auth_helper->hasPermission(array('_superadmin'))) {
                $is_admin = TRUE;
            }

            if ($auth_helper->hasPermission(array('_all-pexcel'))) {
                $is_all = TRUE;
            }

            $manage_category = [];
            if ($is_admin || $is_all) {
                $manage_category = [
                    trans('pexcel::pexcel.page_category_list') => [
                        'url' => URL::route('admin_pexcel_category'),
                        "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                    ]
                ];
            }

            $view->with('sidebar_items', array_merge([
                /**
                 * Pexcels
                 */
                //list
                trans('pexcel::pexcel.page_list') => [
                    'url' => URL::route('admin_pexcel'),
                    "icon" => '<i class="fa fa-list" aria-hidden="true"></i>'
                ],
               
                //add
                trans('pexcel::pexcel.' . $is_action) => [
                    'url' => URL::route('admin_pexcel.edit'),
                    "icon" => '<i class="fa fa-plus" aria-hidden="true"></i>'
                ],
                
                

            ], $manage_category));
            //
        });
    }

}
