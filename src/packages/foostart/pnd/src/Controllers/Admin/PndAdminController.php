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

    private $obj_students= NULL;
    private $obj_pnd_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {

        $this->obj_students= new Students();
        $this->obj_pnd_categories = new PndCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();
        
        $students = $this->obj_students->get_students($params);

        $this->data = array_merge($this->data, array(
            'students' => $students,
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

        $students = NULL;
        $school_id = (int) $request->get('id');


        if (!empty($school_id) && (is_int($school_id))) {
            $students = $this->obj_students->find($school_id);
        }

        $this->data = array_merge($this->data, array(
            'pnd' => $students,
            'request' => $request, 
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

        $school_id = (int) $request->get('id');

        $students = NULL;

        $data = array();

        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_id) && is_int($school_id)) {
                $students = $this->obj_students->find($school_id);
            }
        } else {

            if (!empty($school_id) && is_int($school_id)) {

                $students = $this->obj_students->find($school_id);

                if (!empty($students)) {

                    $input['pnd_id'] = $school_id;
                    $students = $this->obj_students->update_pnd($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("admin_pnd.parse", ["id" => $students->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array(
                ));

                $students = $this->obj_students->add_pnd($input);

                if (!empty($students)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    return Redirect::route("admin_pnd.parse", ["id" => $students->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'students' => $students,
            'request' => $request,
                ), $data);

        return view('pnd::admin.pnd_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $students = NULL;
        $school_id = $request->get('id');

        if (!empty($school_id)) {
            $students = $this->obj_students->find($school_id);

            if (!empty($students)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $students->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'students' => $students,
        ));

        return Redirect::route("admin_pnd");
    }

    public function parse(Request $request) {

        $obj_parse = new Parse();
        $obj_students = new Students();

        $input = $request->all();

        $school_id = $request->get('id');
        $students = $this->obj_students->find($school_id);


        $students = $obj_parse->get_students($students);

        /**
         * Import data
         */
        $obj_students->delete_old_data($students->pexel_id);
        $obj_students->add_students($students, $students->pnd_id);

        $students = $obj_students->get_students();

        $this->data = array_merge($this->data, array(
            'students' => $students,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_parse', $this->data);
    }

}
