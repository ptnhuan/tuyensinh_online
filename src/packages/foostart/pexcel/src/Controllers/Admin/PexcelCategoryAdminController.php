<?php

namespace Foostart\Pexcel\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Pexcel\Controllers\Admin\PexcelController;
use URL;
use Route,
    Redirect;
use Foostart\Pexcel\Models\PexcelCategories;
/**
 * Validators
 */
use Foostart\Pexcel\Validators\PexcelCategoryAdminValidator;

class PexcelCategoryAdminController extends PexcelController {

    private $obj_pexcel_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_pexcel_category = new PexcelCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $list_pexcel_category = $this->obj_pexcel_category->get_pexcels_categories($params);

        $this->data = array_merge($this->data, array(
            'pexcels_categories' => $list_pexcel_category,
            'request' => $request,
            'params' => $params
        ));
        return view('pexcel::admin.pexcel_category_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $pexcel_category = NULL;
        $pexcel_category_id = (int) $request->get('id');


        if (!empty($pexcel_category_id) && (is_int($pexcel_category_id))) {
            $pexcel_category = $this->obj_pexcel_category->find($pexcel_category_id);
        }

        $this->data = array_merge($this->data, array(
            'pexcel_category' => $pexcel_category,
            'request' => $request
        ));

        return view('pexcel::admin.pexcel_category_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PexcelCategoryAdminValidator();

        $input = $request->all();
        $input['user_id'] = $this->current_user->id;

        $pexcel_category_id = (int) $request->get('id');

        $pexcel_category = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($pexcel_category_id) && is_int($pexcel_category_id)) {

                $pexcel_category = $this->obj_pexcel_category->find($pexcel_category_id);
            }
        } else {
            if (!empty($pexcel_category_id) && is_int($pexcel_category_id)) {

                $pexcel_category = $this->obj_pexcel_category->find($pexcel_category_id);

                if (!empty($pexcel_category)) {

                    $input['pexcel_category_id'] = $pexcel_category_id;
                    $pexcel_category = $this->obj_pexcel_category->update_pexcel_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel.message_update_successfully'));
                    return Redirect::route("admin_pexcel_category.edit", ["id" => $pexcel_category->pexcel_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel.message_update_unsuccessfully'));
                }
            } else {

                $pexcel_category = $this->obj_pexcel_category->add_pexcel_category($input);

                if (!empty($pexcel_category)) {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel.message_add_successfully'));
                    return Redirect::route("admin_pexcel_category.edit", ["id" => $pexcel_category->pexcel_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'pexcel_category' => $pexcel_category,
            'request' => $request,
                ), $data);

        return view('pexcel::admin.pexcel_category_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $pexcel_category = NULL;
        $pexcel_category_id = $request->get('id');

        if (!empty($pexcel_category_id)) {
            $pexcel_category = $this->obj_pexcel_category->find($pexcel_category_id);

            if (!empty($pexcel_category)) {
                //Message
                $this->addFlashMessage('message', trans('pexcel::pexcel.message_delete_successfully'));

                $pexcel_category->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'pexcel_category' => $pexcel_category,
        ));


        return Redirect::route("admin_pexcel_category");
    }

}
