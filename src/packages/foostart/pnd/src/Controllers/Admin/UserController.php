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
use Foostart\Pnd\Models\PndUser;


use Foostart\Pexcel\Models\Pexcel;

/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminValidator;

class UserController extends PndController
{

    private $obj_students = NULL;
    private $obj_schools = NULL;
    private $obj_categories = NULL;
    private $obj_validator = NULL;
    private $obj_districts = null;
    private $obj_specialists = null;

    private $obj_pexcel = NULL;

    public function __construct()
    {

        $this->obj_students = new Students();
        $this->obj_schools = new Schools();
        $this->obj_categories = new PexcelCategories();
        $this->obj_districts = new Districts();
        $this->obj_specialists = new Specialists();

        $this->obj_pexcel = new Pexcel();

    }

    /**
     *
     * @return type
     */
    public function index(Request $request)
    {
        $this->isAuthentication();

        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;

        //PEXCEL
        if (!empty($params['id'])) {
            $pexcel = $this->obj_pexcel->find($params['id']);
            $pexcel_status = config('pexcel.status');

            $students = (array)json_decode($pexcel->pexcel_value);

            if ($pexcel->pexcel_status == $pexcel_status['new']) {
                $pexcel->pexcel_status = $pexcel_status['confirmed'];
//                $pexcel->save();

                $this->obj_students->add_students($students, $pexcel->pexcel_id);

                $user = new PndUser();
                $students = $this->obj_students->get_students($params);
                $user->create_students($students);
            }
        }
        //END PEXCEL

        $school = $this->obj_schools->get_school_by_user($params);

        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        }

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

        $specialists = $this->obj_specialists->pluck_select();

        $specialists = (object)array_merge(['NULL' => ''], $specialists->toArray());


        $school_levels_3 = $this->obj_schools->pluck_select(['school_level_id' => 3]);
        //$school_levels_3 =  (object)array_merge(['NULL'=>''],$school_levels_3);

        //var_dump($school_levels_3);
        //die();
        //$school_levels_specialist =  $this->obj_schools->pluck_select(['school_level_id'=>3,'school_choose_specialist'=>1]);
        ///  $school_levels_specialist =  (object)array_merge(['NULL'=>''],$school_levels_specialist->toArray());

        $school_levels_specialist = (object)array_merge(['NULL' => ''], $this->obj_schools->pluck_select(['school_level_id' => 3])->toArray());


        $districts = $this->obj_districts->pluck_select();

        if (!empty($student_id) && (is_int($student_id))) {

            $student = $this->obj_students->find($student_id);


        }

        $this->data = array_merge($this->data, array(
            'student' => $student,
            'specialists' => $specialists,
            'school_levels_3' => $school_levels_3,
            'school_levels_specialist' => $school_levels_specialist,
            'districts' => $districts,
            'request' => $request,
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


    /*
     * Get school by district
     */
    public function getSchoolByDistrict(Request $request)
    {

        $input = $request->all();
        $input['school_level_id'] = 2;
        $schools = $this->obj_schools->pluck_select($input);

        $html = null;
        if (!empty($schools)) {
            foreach ($schools as $key => $school) {
                $selected = ($key == $request['school_current']) ? "selected" : "";
                $html .= '<option ' . $selected . ' value="' . $key . '">' . $school . '</option>';
            }
        }

        return $html;
    }

}
