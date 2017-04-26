<?php namespace Foostart\Phpexcel;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class PhpexcelServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        var_dump(33);
        die();
//        /**
//         * Publish
//         */
//         $this->publishes([
//            __DIR__.'/config/phpexcel_admin.php' => config_path('phpexcel_admin.php'),
//        ],'config');
//
//        $this->loadViewsFrom(__DIR__ . '/views', 'phpexcel');
//
//
//        /**
//         * Translations
//         */
//         $this->loadTranslationsFrom(__DIR__.'/lang', 'phpexcel');
//
//
//        /**
//         * Load view composer
//         */
//        $this->phpexcelViewComposer($request);
//
//         $this->publishes([
//                __DIR__.'/../database/migrations/' => database_path('migrations')
//            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
//        include __DIR__ . '/routes.php';
//
//        /**
//         * Load controllers
//         */
//        $this->app->make('Foostart\Phpexcel\Controllers\Admin\PhpexcelAdminController');
//
//         /**
//         * Load Views
//         */
//        $this->loadViewsFrom(__DIR__ . '/views', 'phpexcel');
    }

    /**
     *
     */
    public function phpexcelViewComposer(Request $request) {

//        view()->composer('phpexcel::phpexcel*', function ($view) {
//            global $request;
//            $phpexcel_id = $request->get('id');
//            $is_action = empty($phpexcel_id)?'page_add':'page_edit';
//
//            $view->with('sidebar_items', [
//
//                /**
//                 * phpexcels
//                 */
//                //list
//                trans('phpexcel::phpexcel_admin.page_list') => [
//                    'url' => URL::route('admin_phpexcel'),
//                    "icon" => '<i class="fa fa-users"></i>'
//                ],
//                //add
//                trans('phpexcel::phpexcel_admin.'.$is_action) => [
//                    'url' => URL::route('admin_phpexcel.edit'),
//                    "icon" => '<i class="fa fa-users"></i>'
//                ],
//
//                /**
//                 * Categories
//                 */
//                //list
//                trans('phpexcel::phpexcel_admin.page_category_list') => [
//                    'url' => URL::route('admin_phpexcel_category'),
//                    "icon" => '<i class="fa fa-users"></i>'
//                ],
//            ]);
//            //
//        });
    }

}
