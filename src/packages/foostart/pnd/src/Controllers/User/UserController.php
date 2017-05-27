<?php

namespace Foostart\Pnd\Controllers\User;

use Foostart\Pexcel\Models\Pexcel;
use Foostart\Pnd\Controllers\Admin\PndController;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Models\Schools;
use Foostart\Pnd\Models\Specialists;
use Foostart\Pnd\Models\Students;
use Foostart\Pnd\Validators\PndUserValidator;
use Foostart\Pnd\Validators\PndUserkValidator;
use Illuminate\Http\Request;
use URL,
    Route,
    Redirect;

class UserController extends PndController {

    public $data = array();
    public $authentication = NULL;
    public $is_members = FALSE;
    public $current_user = NULL;
    public $is_admin = FALSE;
    private $obj_students = NULL;
    private $obj_schools = NULL;
    private $obj_categories = NULL;
    private $obj_validator = NULL;
    private $obj_districts = null;
    private $obj_specialists = null;
    private $obj_pexcel = NULL;

    public function __construct() {
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
    public function index(Request $request) {
        $this->isAuthentication();

        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;

        $student = $this->obj_students->get_student($params);
         $school_aed=$student->school_aed;
        $specialists = $this->obj_specialists->pluck_select();
        $specialists = (object) array_merge(['NULL' => '...'], $specialists->toArray());

       
        $school_levels_3 = $this->obj_schools->pluck_select(['school_level_id' => 3]);
        $school_levels_3 = array('NULL' => '...') + $school_levels_3->toArray();


        $school_levels_specialist = $this->obj_schools->pluck_select(['school_level_id' => 3, 'school_choose_specialist' => 1]);
        $school_levels_specialist = array('NULL' => '...') + $school_levels_specialist->toArray();

        $districts = $this->obj_districts->pluck_select();
      
        $schools = $this->obj_schools->pluck_select(['school_level_id' => 2]);

        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        }


        $this->data = array_merge($this->data, array(
            'student' => $student,
            'specialists' => $specialists,
            'school_levels_3' => $school_levels_3,
            'school_levels_specialist' => $school_levels_specialist,
            'districts' => $districts,
            'schools' =>$schools ,
             'school_aed' =>$school_aed,
            'params' => $params,
            'request' => $request,
        ));

        return view('pnd::user.pnd_detail', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

     

         $school_aed = (int) $request->get('school_aed');
         
       if ($school_aed==1 ){
              $this->obj_validator = new PndUserValidator();
        $input = $request->only('student_first_name', 'student_last_name', 'student_email', 'student_sex', 'student_phone', 'student_birth_day', 'student_birth_month', 'student_birth_year', 'student_birth_place',
                'school_code', 'school_district_code', 'student_class', 'student_capacity_6', 'student_conduct_6', 'student_capacity_7', 'student_conduct_7', 'student_capacity_8', 'student_conduct_8', 'student_capacity_9', 'student_conduct_9',
                'student_average', 'student_average_1', 'student_average_2', 'student_graduate', 'student_score_prior', 'student_score_prior_comment', 'school_code_option', 'school_class_code',
                'student_nominate', 'school_code_option_1', 'school_code_option_2',  'student_pass');
        }
        
        if ($school_aed==0){
                $this->obj_validator = new PndUserkValidator();
        $input = $request->only('student_email',  'student_phone', 'student_pass');
        }


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

                    $student = $this->obj_students->user_update_student_k($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("user.student.view", ["id" => $student->student_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'student' => $student,
            'request' => $request,
                ), $data);

        return view('pnd::user.pnd_detail', $this->data);
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

     public
            function getSchoolByDistrict(Request $request) {
      $html = null;
        $input = $request->all();
        $input['school_level_id'] = 2;
        $schools = $this->obj_schools->pluck_select($input);

       
        if (!empty($schools)) {
            foreach ($schools as $key => $school) {
                $selected = ($key == $request['school_current']) ? "selected" : "";
                $html .= '<option ' . $selected . ' value="' . $key . '">' . $school . '</option>';
            }
        }

        return $html;
    }
    
    /* Kiểm tra user là học sinh hiện tại hay là trường cấp 2/ cấp 3 / user có quyền
      xem thông tin học sinh
     */

    public
            function check_view_user($request) {
        $this->isAuthentication();
        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['permissions'] = $this->current_user->permissions;

        $check_student = $this->obj_students->get_student($params);

        if (!empty($check_student)) {
            return true;
        }

        $check_permission_user = 1;


        return false;
    }
}
