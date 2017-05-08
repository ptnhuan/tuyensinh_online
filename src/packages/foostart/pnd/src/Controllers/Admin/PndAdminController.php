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
use Foostart\Pnd\Models\Students;
use Foostart\Pnd\Models\PndCategories;
use Foostart\Pnd\Helper\Parse;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminValidator;

class PndAdminController extends PndController {

    private $obj_pnd = NULL;
    private $obj_pnd_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {

        $this->obj_pnd = new Pnd();
        $this->obj_pnd_categories = new PndCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $pnds = $this->obj_pnd->get_pnds($params);

        $this->data = array_merge($this->data, array(
            'pnds' => $pnds,
            'request' => $request,
            'params' => $params
        ));
        return view('pnd::admin.pnd_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $pnd = NULL;
        $pnd_id = (int) $request->get('id');


        if (!empty($pnd_id) && (is_int($pnd_id))) {
            $pnd = $this->obj_pnd->find($pnd_id);
        }


        $this->data = array_merge($this->data, array(
            'pnd' => $pnd,
            'request' => $request,
            'categories' => array(0 => '...') + $this->obj_pnd_categories->pluckSelect()->toArray(),
        ));
        return view('pnd::admin.pnd_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PndAdminValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $pnd_id = (int) $request->get('id');

        $pnd = NULL;

        $data = array();

        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($pnd_id) && is_int($pnd_id)) {
                $pnd = $this->obj_pnd->find($pnd_id);
            }
        } else {

            if (!empty($pnd_id) && is_int($pnd_id)) {

                $pnd = $this->obj_pnd->find($pnd_id);

                if (!empty($pnd)) {

                    $input['pnd_id'] = $pnd_id;
                    $pnd = $this->obj_pnd->update_pnd($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("admin_pnd.parse", ["id" => $pnd->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $pnd->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array(
                ));

                $pnd = $this->obj_pnd->add_pnd($input);

                if (!empty($pnd)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    return Redirect::route("admin_pnd.parse", ["id" => $pnd->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $pnd->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'pnd' => $pnd,
            'request' => $request,
                ), $data);

        return view('pnd::admin.pnd_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $pnd = NULL;
        $pnd_id = $request->get('id');

        if (!empty($pnd_id)) {
            $pnd = $this->obj_pnd->find($pnd_id);

            if (!empty($pnd)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $pnd->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'pnd' => $pnd,
        ));

        return Redirect::route("admin_pnd");
    }

    public function parse(Request $request) {

        $obj_parse = new Parse();
        $obj_students = new Students();

        $input = $request->all();

        $pnd_id = $request->get('id');
        $pnd = $this->obj_pnd->find($pnd_id);


        $students = $obj_parse->get_students($pnd);

        /**
         * Import data
         */
        $obj_students->delete_old_data($pnd->pexel_id);
        $obj_students->add_students($students, $pnd->pnd_id);

        $students = $obj_students->get_students();

        $this->data = array_merge($this->data, array(
            'students' => $students,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_parse', $this->data);
    }

}
