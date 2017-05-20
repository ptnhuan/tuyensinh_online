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
use Foostart\Pnd\Models\Examines;
use Foostart\Pnd\Models\Examinepointpriors;
use Foostart\Pnd\Models\Specialists;
use Foostart\Pnd\Models\Examinepoints;
use Foostart\Pnd\Models\PndUser;
use Foostart\Pexcel\Models\Pexcel;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminValidator;

class PndExamWorkAdminController extends PndController {

    private $obj_students = NULL;
    private $obj_schools = NULL;
    private $obj_categories = NULL;
    private $obj_validator = NULL;
    private $obj_examines = null;
    private $obj_specialists = null;
    private $obj_examinepoints = null;
    private $obj_examinepointpriors = null;
    private $obj_pexcel = NULL;

    public function __construct() {

        $this->obj_students = new Students();
        $this->obj_schools = new Schools();
        $this->obj_categories = new PexcelCategories();
        $this->obj_examines = new Examines();
        $this->obj_specialists = new Specialists();
        $this->obj_examinepoints = new Examinepoints();
        $this->obj_examinepointpriors = new Examinepointpriors();
        $this->obj_pexcel = new Pexcel();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $this->isAuthentication();




        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;

        //PEXCEL
        if (!empty($params['id'])) {
            $pexcel = $this->obj_pexcel->find($params['id']);

            if ($pexcel && ($this->is_admin || ($pexcel->user_id == $this->current_user->id))) {

                $pexcel_status = config('pexcel.status');

                if ($pexcel->pexcel_status == $pexcel_status['new']) {

                    $students = (array) json_decode($pexcel->pexcel_value);

                    $pexcel->pexcel_status = $pexcel_status['confirmed'];
                    $pexcel->save();
                    $this->obj_students->add_students($students, $pexcel->pexcel_id);

                    $user = new PndUser();
                    $students = $this->obj_students->get_students($params);

                    $user->create_students($students);
                }
            }
        } else {
            $students = $this->obj_students->get_all_students($params);
        }
        //END PEXCEL

        $school = $this->obj_schools->get_school_by_user_id($params['user_id']);


        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        }

        $this->data = array_merge($this->data, array(
            'students' => !empty($students) ? $students : '',
            //'categories' => $categories,
            'request' => $request,
            'params' => $params
        ));
        return view('pnd::admin.pnd_examine_list', $this->data);
    }

    /**
     * tinh diem
     * @return type
     */
    public function point(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;

        $students_point = $this->obj_students->get_all_students($params);
        $students = $this->obj_students->get_all_students($params);

        $this->data = array_merge($this->data, array(
            'students' => !empty($students) ? $students : '',
            //'categories' => $categories,
            'request' => $request,
            'params' => $params
        ));
        //END PEXCEL


        $points = $request->all();
        $input = $request->all();

        foreach ($students_point as $value) {

            $input['student_id'] = $value['student_id'];
            $points['school_point_capacity'] = $value['student_capacity_6'];
            $points['school_point_conduct'] = $value['student_conduct_6'];
            $input['student_point_6'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;
            $points['school_point_capacity'] = $value['student_capacity_7'];
            $points['school_point_conduct'] = $value['student_conduct_7'];
            $input['student_point_7'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;
            $points['school_point_capacity'] = $value['student_capacity_8'];
            $points['school_point_conduct'] = $value['student_conduct_8'];
            $input['student_point_8'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;
            $points['school_point_capacity'] = $value['student_capacity_9'];
            $points['school_point_conduct'] = $value['student_conduct_9'];
            $input['student_point_9'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;

            if ($value['student_score_prior'] > $this->obj_examinepointpriors->get_examinepointpriors()->school_prior_point_1) {

                $input['student_point_sum'] = $input['student_point_6'] + $input['student_point_7'] + $input['student_point_8'] + $input['student_point_9'] + $this->obj_examinepointpriors->get_examinepointpriors()->school_prior_point_1;
            } else {
                $input['student_point_sum'] = $input['student_point_6'] + $input['student_point_7'] + $input['student_point_8'] + $input['student_point_9'] + $value['student_score_prior'];
            }



            $this->obj_examines->user_update_student($input);
        }


        return Redirect::route("admin_pnd_examine");
    }

    /**
     * tinh diem
     * @return type
     */
    public function identifi(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $school_users = $this->current_user->user_name;
        if ($school_users <> 'admin') {
            $school_id = $this->obj_schools->get_school_by_user_id($school_users)->school_id;
            $idoder = $this->obj_schools->get_school_by_user_id($school_users)->school_code_room;
        }

        $students_identifi = $this->obj_students->get_all_identifi_students($params);


        $students = $this->obj_students->get_all_students($params);

        $this->data = array_merge($this->data, array(
            'students' => !empty($students) ? $students : '',
            //'categories' => $categories,
            'request' => $request,
            'params' => $params
        ));
        //END PEXCEL


        $points = $request->all();
        $input = $request->all();

        if ($request->ajax()) {

            foreach ($students_identifi as $value) { 
                $input['student_id'] = $value['student_id'];
                $input['student_identifi'] = $idoder + $value['student_id'];

                $this->obj_examines->user_update_identifi_student($input);
            }
             
        }


        return view('pnd::admin.pnd_exam_identifi_list', $this->data);
    }

    /**
     * tinh diem
     * @return type
     */
    public function room(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;

        $students_point = $this->obj_students->get_all_identifi_students($params);
        $students = $this->obj_students->get_all_students($params);

        $this->data = array_merge($this->data, array(
            'students' => !empty($students) ? $students : '',
            //'categories' => $categories,
            'request' => $request,
            'params' => $params
        ));
        //END PEXCEL


        $points = $request->all();
        $input = $request->all();

        foreach ($students_point as $value) {

            $input['student_id'] = $value['student_id'];
            $points['school_point_capacity'] = $value['student_capacity_6'];
            $points['school_point_conduct'] = $value['student_conduct_6'];
            $input['student_point_6'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;
            $points['school_point_capacity'] = $value['student_capacity_7'];
            $points['school_point_conduct'] = $value['student_conduct_7'];
            $input['student_point_7'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;
            $points['school_point_capacity'] = $value['student_capacity_8'];
            $points['school_point_conduct'] = $value['student_conduct_8'];
            $input['student_point_8'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;
            $points['school_point_capacity'] = $value['student_capacity_9'];
            $points['school_point_conduct'] = $value['student_conduct_9'];
            $input['student_point_9'] = $this->obj_examinepoints->get_examinepoint($points)->school_point_point;

            if ($value['student_score_prior'] > $this->obj_examinepointpriors->get_examinepointpriors()->school_prior_point_1) {

                $input['student_point_sum'] = $input['student_point_6'] + $input['student_point_7'] + $input['student_point_8'] + $input['student_point_9'] + $this->obj_examinepointpriors->get_examinepointpriors()->school_prior_point_1;
            } else {
                $input['student_point_sum'] = $input['student_point_6'] + $input['student_point_7'] + $input['student_point_8'] + $input['student_point_9'] + $value['student_score_prior'];
            }



            $this->obj_examines->user_update_student($input);
        }


        return Redirect::route("admin_pnd_examine");
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $student = NULL;
        $student_id = (int) $request->get('id');

        $specialists = $this->obj_specialists->pluck_select();

        $specialists = (object) array_merge(['NULL' => '...'], $specialists->toArray());


        $school_levels_3 = $this->obj_schools->pluck_select(['school_level_id' => 3]);
        $school_levels_3 = array('NULL' => '...') + $school_levels_3->toArray();


        $school_levels_specialist = $this->obj_schools->pluck_select(['school_level_id' => 3, 'school_choose_specialist' => 1]);
        $school_levels_specialist = array('NULL' => '...') + $school_levels_specialist->toArray();




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
    public function post(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PndAdminValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $student_id = (int) $request->get('id');

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
    public function delete(Request $request) {

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

    public function getSchoolByDistrict(Request $request) {

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
