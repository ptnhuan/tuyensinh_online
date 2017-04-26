<?php namespace Foostart\Phpexcel\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Phpexcel\Controllers\Admin\ApiController;
use URL;
use Route,
    Redirect;
use Foostart\Phpexcel\Models\Phpexcels;

/**
 * Validators
 */
class PhpexcelAdminController extends PhpexcelController {

    public $obj_phpexcels = NULL;

    public function __construct() {
        $this->obj_phpexcels = new Phpexcels();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $phpexcels = $this->obj_phpexcels->get_phpexcels($params);


        $this->data = array_merge($this->data, array(
            'phpexcels' => $phpexcels,
            'request' => $request,
            'params' => $params
        ));

        return view('phpexcel::admin.phpexcel_list', $this->data);
    }

    /*
     * Edit
     */

    public function edit(Request $request) {
        $api = NULL;
        $api_id = (int) $request->get('id');

        if (!empty($api_id) && (is_int($api_id))) {
            $api = $this->obj_api->find($api_id);
        }


        $this->data_view = array_merge($this->data_view, array(
            'api' => $api,
            'request' => $request,
        ));

        return view('api::api.admin.api_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $input = $request->all();
        var_dump($input);
        die();
        $api_id = (int) $request->get('id');
        $api = NULL;

        $data = array();
        if (!empty($api_id) && is_int($api_id)) {

            $api = $this->obj_api->find($api_id);
            $input['api_id'] = $api_id;

            if (!isset($input['api_status'])) {
                $input['_token'] = csrf_token();
                $input['api_status'] = $api->api_status;
            }

            $api = $this->obj_api->update_api($input);

            return Redirect(route('admin_api'));
        } else {

            $api = $this->obj_api->add_api($input);

            return Redirect(route('admin_api'));
        }
    }

    /*
     * get json posts
     */
    public function get_posts(Request $request) {
        $input = $request->all();
        $obj_posts = new Posts();
        $obj_api = new API();

        if (isset($input['_token'])) {
            $check_api = $obj_api->check_api_key($input['_token']);

            if ($check_api) {
                $posts = $obj_posts->get_posts($input);
                return response()->json($posts);
            }
        }
    }

}
