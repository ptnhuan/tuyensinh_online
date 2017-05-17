<?php

namespace Foostart\Pnd\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Pnd\Controllers\Admin\PndController;
use URL;
use Route,
    Redirect;
/**
 * Models
 */
use Foostart\Pnd\Models\Pnd;
use Foostart\Pnd\Models\CategoryUsers;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Helper\Parse;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminUserValidator;

class PndCategoryUserController extends PndController {

    private $obj_categoryusers = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_categoryusers = new CategoryUsers();
        $this->obj_pexcel_categories = new PexcelCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();
        $categoryusers = $this->obj_categoryusers->get_categoryusers($params);
        $this->data = array_merge($this->data, array(
            'categoryusers' => $categoryusers,
            'request' => $request,
            'params' => $params
        ));
        return view('pnd::admin.pnd_category_user_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $category_user = NULL;
        $user_categoy_id = (int) $request->get('id');


        if (!empty($user_categoy_id) && (is_int($user_categoy_id))) {

            $category_user = $this->obj_categoryusers->find($user_categoy_id);
        }

        $this->data = array_merge($this->data, array(
            'category_user' => $category_user,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_category_user_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PndAdminUserValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $user_categoy_id = (int) $request->get('id');

        $categoryusers = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($user_categoy_id) && is_int($user_categoy_id)) {
                $categoryusers = $this->obj_categoryusers->find($user_categoy_id);
            }
        } else {
            if (!empty($user_categoy_id) && is_int($user_categoy_id)) {

                $categoryusers = $this->obj_categoryusers->find($user_categoy_id);

                if (!empty($categoryusers)) {

                    $input['user_categoy_id'] = $user_categoy_id;

                    $categoryusers = $this->obj_categoryusers->update_categoryuser($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("admin_pnd_category_user.edit", ["id" => $categoryusers->user_categoy_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $categoryusers = $this->obj_categoryusers->add_categoryuser($input);

                if (!empty($categoryusers)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    //  return Redirect::route("admin_pnd.parse", ["id" => $specialists->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'categoryusers' => $categoryusers,
            'request' => $request,
                ), $data);

        return view('pnd::admin.pnd_category_user_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $categoryusers = NULL;
        $user_categoy_id = $request->get('id');

        if (!empty($user_categoy_id)) {
            $categoryusers = $this->obj_categoryusers->find($user_categoy_id);

            if (!empty($categoryusers)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $categoryusers->delete();
            }
        } else {
            
        }

        $this->data = array_merge($this->data, array(
            'categoryusers' => $categoryusers,
        ));

        return Redirect::route("admin_pnd_category_user");
    }

    public function parse(Request $request) {

        $obj_parse = new Parse();
        $obj_specialists = new Districts();

        $input = $request->all();

        $user_categoy_id = $request->get('id');
        $categoryusers = $this->obj_categoryusers->find($user_categoy_id);


        $categoryusers = $obj_parse->get_categoryuser($categoryusers);

        /**
         * Import data
         */
        $obj_specialists->delete_old_data($categoryusers->pexel_id);
        $obj_specialists->add_specialists($categoryusers, $categoryusers->pnd_id);

        $specialists = $obj_specialists->get_specialists();

        $this->data = array_merge($this->data, array(
            'categoryusers' => $categoryusers,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_parse', $this->data);
    }

}
