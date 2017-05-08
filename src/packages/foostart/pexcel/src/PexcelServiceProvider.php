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
            __DIR__.'/views'  => base_path('resources/views/vendor/pexcel'),
        ], 'pexcel_views');
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
                ], 'pexcel_migrations');
        $this->publishes([
            __DIR__.'/public' => public_path('vendor/pexcel'),
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
        view()->composer(['pexcel::pexcel.user.*', 'pexcel::pexcel_category.user.*'], function ($view) {

            global $request;
            $pexcel_id = $request->get('id');
            $is_action = empty($pexcel_id) ? 'page_add' : 'page_edit';

            $authentication = \App::make('authenticator');
            $current_user = $authentication->getLoggedUser();

            $admin_pexcels = [];

            if (config('buoumau.admin_id') == $current_user->id) {
                $admin_pexcels = [
                    trans('pexcel::pexcel.pexcel') => [
                        'url' => URL::route('admin_pexcel'),
                        "icon" => '<i class="fa fa-users"></i>'
                    ]
                ];
            }

            $view->with('sidebar_items', array_merge([
                /**
                 * Pexcels
                 */
                //list
                trans('pexcel::pexcel.page_list') => [
                    'url' => URL::route('user_pexcel'),
                    "icon" => '<i class="fa fa-list" aria-hidden="true"></i>'
                ],
                //add
                trans('pexcel::pexcel.' . $is_action) => [
                    'url' => URL::route('user_pexcel.edit'),
                    "icon" => '<i class="fa fa-plus" aria-hidden="true"></i>'
                ],
                /**
                 * Categories
                 */
                //list
                trans('pexcel::pexcel.page_category_list') => [
                    'url' => URL::route('user_pexcel_category'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
                            ], $admin_pexcels));
            //
        });

        /**
         * ADMIN sidebar menu
         */
        view()->composer(['pexcel::admin.*', 'pexcel::pexcel_category.admin.*'], function ($view) {
            global $request;
            $pexcel_id = $request->get('id');
            $is_action = empty($pexcel_id) ? 'page_add' : 'page_edit';

            $view->with('sidebar_items', [
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
                /**
                 * Categories
                 */
                //list
                trans('pexcel::pexcel.page_category_list') => [
                    'url' => URL::route('admin_pexcel_category'),
                    "icon" => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ],
            ]);
            //
        });
    }

}
