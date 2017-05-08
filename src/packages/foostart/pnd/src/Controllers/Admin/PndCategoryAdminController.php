<?php

namespace Foostart\Pnd\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Pnd\Controllers\Admin\PndController;
use URL;
use Route,
    Redirect;
use Foostart\Pnd\Models\PexcelCategories;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndCategoryAdminValidator;

class PndCategoryAdminController extends PndController {

    private $obj_pnd_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_pnd_category = new PexcelCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $list_pnd_category = $this->obj_pnd_category->get_pnds_categories($params);

        $this->data = array_merge($this->data, array(
            'pnds_categories' => $list_pnd_category,
            'request' => $request,
            'params' => $params
        ));
        return view('pnd::admin.pnd_category_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $pnd_category = NULL;
        $pnd_category_id = (int) $request->get('id');


        if (!empty($pnd_category_id) && (is_int($pnd_category_id))) {
            $pnd_category = $this->obj_pnd_category->find($pnd_category_id);
        }

        $this->data = array_merge($this->data, array(
            'pnd_category' => $pnd_category,
            'request' => $request
        ));

        return view('pnd::admin.pnd_category_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PndCategoryAdminValidator();

        $input = $request->all();
        $input['user_id'] = $this->current_user->id;

        $pnd_category_id = (int) $request->get('id');

        $pnd_category = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($pnd_category_id) && is_int($pnd_category_id)) {

                $pnd_category = $this->obj_pnd_category->find($pnd_category_id);
            }
        } else {
            if (!empty($pnd_category_id) && is_int($pnd_category_id)) {

                $pnd_category = $this->obj_pnd_category->find($pnd_category_id);

                if (!empty($pnd_category)) {

                    $input['pnd_category_id'] = $pnd_category_id;
                    $pnd_category = $this->obj_pnd_category->update_pnd_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));
                    return Redirect::route("admin_pnd_category.edit", ["id" => $pnd_category->pnd_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $pnd_category = $this->obj_pnd_category->add_pnd_category($input);

                if (!empty($pnd_category)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));
                    return Redirect::route("admin_pnd_category.edit", ["id" => $pnd_category->pnd_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'pnd_category' => $pnd_category,
            'request' => $request,
                ), $data);

        return view('pnd::admin.pnd_category_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $pnd_category = NULL;
        $pnd_category_id = $request->get('id');

        if (!empty($pnd_category_id)) {
            $pnd_category = $this->obj_pnd_category->find($pnd_category_id);

            if (!empty($pnd_category)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $pnd_category->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'pnd_category' => $pnd_category,
        ));


        return Redirect::route("admin_pnd_category");
    }

}
