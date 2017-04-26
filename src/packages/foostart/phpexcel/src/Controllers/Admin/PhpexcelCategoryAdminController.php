<?php

namespace Foostart\Phpexcel\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Phpexcel\Controllers\Admin\MyController;
use URL;
use Route,
    Redirect;
use Foostart\Phpexcel\Models\phpexcelsCategories;
/**
 * Validators
 */
use Foostart\Phpexcel\Validators\PhpexcelCategoryAdminValidator;

class PhpexcelCategoryAdminController extends MyController {

    private $obj_phpexcel_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_phpexcel_category = new PhpexcelsCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $list_phpexcel_category = $this->obj_phpexcel_category->get_phpexcels_categories($params);

        $this->data = array_merge($this->data, array(
            'phpexcels_categories' => $list_phpexcel_category,
            'request' => $request,
            'params' => $params
        ));
        return view('phpexcel::phpexcel_category.admin.phpexcel_category_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $phpexcel_category = NULL;
        $phpexcel_category_id = (int) $request->get('id');


        if (!empty($phpexcel_category_id) && (is_int($phpexcel_category_id))) {
            $phpexcel_category = $this->obj_phpexcel_category->find($phpexcel_category_id);
        }

        $this->data = array_merge($this->data, array(
            'phpexcel_category' => $phpexcel_category,
            'request' => $request
        ));
        return view('phpexcel::phpexcel_category.admin.phpexcel_category_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new phpexcelCategoryAdminValidator();

        $input = $request->all();

        $phpexcel_category_id = (int) $request->get('id');

        $phpexcel_category = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($phpexcel_category_id) && is_int($phpexcel_category_id)) {

                $phpexcel_category = $this->obj_phpexcel_category->find($phpexcel_category_id);
            }
        } else {
            if (!empty($phpexcel_category_id) && is_int($phpexcel_category_id)) {

                $phpexcel_category = $this->obj_phpexcel_category->find($phpexcel_category_id);

                if (!empty($phpexcel_category)) {

                    $input['phpexcel_category_id'] = $phpexcel_category_id;
                    $phpexcel_category = $this->obj_phpexcel_category->update_phpexcel_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_update_successfully'));
                    return Redirect::route("admin_phpexcel_category.edit", ["id" => $phpexcel_category->phpexcel_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_update_unsuccessfully'));
                }
            } else {

                $phpexcel_category = $this->obj_phpexcel_category->add_phpexcel_category($input);

                if (!empty($phpexcel_category)) {

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_add_successfully'));
                    return Redirect::route("admin_phpexcel_category.edit", ["id" => $phpexcel_category->phpexcel_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'phpexcel_category' => $phpexcel_category,
            'request' => $request,
                ), $data);

        return view('phpexcel::phpexcel_category.admin.phpexcel_category_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $phpexcel_category = NULL;
        $phpexcel_category_id = $request->get('id');

        if (!empty($phpexcel_category_id)) {
            $phpexcel_category = $this->obj_phpexcel_category->find($phpexcel_category_id);

            if (!empty($phpexcel_category)) {
                //Message
                $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_delete_successfully'));

                $phpexcel_category->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'phpexcel_category' => $phpexcel_category,
        ));


        return Redirect::route("admin_phpexcel_category");
    }

}
