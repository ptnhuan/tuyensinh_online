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
use Foostart\Pnd\Models\Students;
use Foostart\Pnd\Models\Schools;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\Specialists;
use Foostart\Pexcel\Models\Pexcel;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminValidator;

class PndAdminController extends PndController
{

    private $obj_students = NULL;
    private $obj_schools = NULL;
    private $obj_categories = NULL;
    private $obj_validator = NULL;
    private $obj_pexcel = NULL;
    private $obj_districts = NULL;
    private $obj_specialists = NULL;
    public function __construct() {

        $this->obj_students = new Students();
        $this->obj_schools = new Schools();
        $this->obj_categories = new PexcelCategories();
        $this->obj_pexcel = new Pexcel();
        $this->obj_districts = new Districts();
         $this->obj_specialists = new Specialists();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request)
    {
        $params = $request->all();

        /**
         * READ DATA FROM PEXCEL
         * SAVE TO STUDENT
         */
        $pexcel_id = (int)@$params['id'];
        if (!empty($pexcel_id)) {
            $pexcel = $this->obj_pexcel->find($pexcel_id);

            if (!empty($pexcel)) {
                $this->obj_students->deleteByPexcel($pexcel_id);
                $this->obj_students->add_students(json_decode($pexcel->pexcel_value), $pexcel_id);
            }
        }
        ////////////////////////////////////////////////////////////////////////

        $this->isAuthentication();

        $params['user_id'] = $this->current_user->id;

        $students = $this->obj_students->get_students($params);

        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);

        $this->data = array_merge($this->data, array(
            'students' => $students,
            'categories' => $categories,
            'request' => $request,
            'params' => $params
        ));
        return view('pnd::admin.pnd_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request)
    {

        $student = NULL;
        $student_id = (int)$request->get('id');
        $districts = $this->obj_districts->pluck_select();
        $schools = $this->obj_schools->pluck_select();
            $specialists = $this->obj_specialists->pluck_select();
        if (!empty($student_id) && (is_int($student_id))) {

            $student = $this->obj_students->find($student_id);

        }

        $this->data = array_merge($this->data, array(
            'student' => $student,
            'request' => $request,
             'districts' => $districts,
                  'schools' => $schools,
              'specialists' => $specialists,
        ));

        return view('pnd::admin.pnd_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request)
    {

        $this->isAuthentication();

        $this->obj_validator = new PndAdminValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $student_id = (int)$request->get('id');
        $districts = $this->obj_districts->pluck_select();
         $schools = $this->obj_schools->pluck_select();
          $specialists = $this->obj_specialists->pluck_select();
        $student = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($student_id) && is_int($student_id)) {
                $student = $this->obj_students->find($student_id);
            }
        } else {
            if (!empty($student_id) && is_int($student_id)) {

                $student = $this->obj_students->find($student_id);

                if (!empty($student)) {

                    $input['student_id'] = $student_id;

                    $student = $this->obj_students->update_student($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("admin_pnd.edit", ["id" => $student->student_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $student = $this->obj_students->add_student($input);

                if (!empty($student)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    return Redirect::route("admin_pnd.edit", ["id" => $student->student_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'student' => $student,
            'request' => $request,
              'districts' => $districts,
                'schools' => $schools,
             'specialists' => $specialists,
        ), $data);

        return view('pnd::admin.pnd_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request)
    {

        $student = NULL;
        $student_id = $request->get('id');

        if (!empty($student_id)) {
            $student = $this->obj_students->find($student_id);

            if (!empty($student)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $student->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'student' => $student,
        ));

        return Redirect::route("admin_pnd");
    }


    public function search(Request $request)
    {
        $params = $request->all();
        $students = null;
        $this->isAuthentication();

        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;

        $school = $this->obj_schools->get_school_by_user_name($this->current_user->user_name);

        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);

        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
            $students = $this->obj_students->get_students($params);
        }

        $this->data = array_merge($this->data, array(
            'students' => $students,
            'categories' => $categories,
            'request' => $request,
            'params' => $params,
        ));

        return view('pnd::admin.pnd_list', $this->data);
    }

}
