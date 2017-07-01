<?php

namespace Foostart\Pnd\Controllers\Admin;

use Foostart\Pexcel\Helper\Parse;
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
use Foostart\Pnd\Models\SchoolTests;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\Specialists;
use Foostart\Pnd\Models\PndUser;
use Foostart\Pexcel\Models\Pexcel;
use Foostart\Pnd\Models\Examines;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminValidator;

class PndAdminOptionController extends PndController {

    private $obj_students = NULL;
    private $obj_schoolTests = NULL;
    private $obj_schools = NULL;
    private $obj_categories = NULL;
    private $obj_validator = NULL;
    private $obj_districts = null;
    private $obj_specialists = null;
    private $obj_pexcel = NULL;
    private $obj_examines = NULL;

    public function __construct() {

        $this->obj_students = new Students();
        $this->obj_schoolTests = new SchoolTests();
        $this->obj_schools = new Schools();
        $this->obj_categories = new PexcelCategories();
        $this->obj_districts = new Districts();
        $this->obj_specialists = new Specialists();
        $this->obj_examines = new Examines();
        $this->obj_pexcel = new Pexcel();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;


        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        }

        $addeditde = 0;

        if (!empty($this->current_user->permissions)) {
            $addeditde = $this->obj_schools->get_school_by_user($params)->school_aed;
        }//
        if ($this->obj_categories->get_pexcels_categories_action()->add_level3 == 1) {
            $addeditde = 1;
        }


        $school_option12 = "";
        $statistics = "";

        /**
         * EXPORT TO FILE EXCEL
         */
        // kiem tra them xoa sua 


        if (isset($params['school_code_option'])) {
            
        } else {
            $params['school_code_option'] = "NULL";
        }

        if (isset($params['school_option1234'])) {
            
        } else {
            $params['school_option1234'] = "NULL";
        }

        if (isset($params['school_code_level'])) {
            
        } else {
            $params['school_code_level'] = "NULL";
        }


        if (isset($params['export'])) {

            $students = $this->obj_students->get_all_option_1_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_students($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['export']);
        }

        if (isset($params['exportpass'])) {

            $students = $this->obj_students->get_all_option_1_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_student_user_pass($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['exportpass']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
        if (!empty($params['id'])) {

            if ($this->obj_categories->get_pexcels_categories_action()->add_level2 == 0) {


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
            }
        }


        $students = $this->obj_students->get_all_option_1_students($params);
        
        if (!empty($students)) {
            $statistics['sum'] = $this->obj_students->statistics_all_option1_students($params, 0);
            $statistics['lvc'] = $this->obj_students->statistics_all_option1_students($params, 1);
            $statistics['dtnt'] = $this->obj_students->statistics_all_option1_students($params, 2);
        } else {
            $statistics['sum'] = 0;
            $statistics['lvc'] = 0;
            $statistics['dtnt'] = 0;
        }

        if ($params['this']->is_level_3) {

            $params_option = $this->obj_students->get_option1_student_level_2($params);
            $params_option2 = $this->obj_students->get_option1_student_option_2($params);
            $school_code_level = array('NULL' => '') + $this->obj_schools->pluck_select_option2($params_option)->toArray();
            $school_option123 = array('NULL' => '') + $this->obj_schools->pluck_select_school_specialist()->toArray();
            $school_option1234 = array('NULL' => '') + $this->obj_schools->pluck_select_option2($params_option2)->toArray();
        } else {
            $school_option123 = array('NULL' => '') + $this->obj_schools->pluck_select_school_specialist()->toArray();
            $school_option1234 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();
            $school_code_level = array('NULL' => '') + $this->obj_students->school_option1_student_level_2($params)->toArray();
        }

        //END PEXCEL
        $school_student_school_option_1 = $this->obj_students->statistics_all_student_school_option_1($params);
        $pexcels = $this->obj_students->sendPexcels();
        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);
        $this->data = array_merge($this->data, array(
            'school_code_level' => !empty($school_code_level) ? $school_code_level : '',
            'students' => !empty($students) ? $students : '',
            'categories' => $categories,
            'school_option123' => $school_option123,
            'school_option1234' => $school_option1234,
            'school_option123_choose' => $params['school_code_option'],
            'school_option1234_choose' => $params['school_option1234'],
            'school_level_choose' => $params['school_code_level'],
            'addeditde' => $addeditde,
            'statistics' => $statistics,
            'request' => $request,
            'params' => $params,
            'pexcels' => array('0' => '...') + $pexcels->toArray(),
        ));

        return view('pnd::admin.management.pnd_option_1_list', $this->data);
    }

    public function index2(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;


        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        }

        $addeditde = 0;

        if (!empty($this->current_user->permissions)) {
            $addeditde = $this->obj_schools->get_school_by_user($params)->school_aed;
        }//
        if ($this->obj_categories->get_pexcels_categories_action()->add_level3 == 1) {
            $addeditde = 1;
        }


        $school_option12 = "";
        $statistics = "";

        /**
         * EXPORT TO FILE EXCEL
         */
        // kiem tra them xoa sua 


        if (isset($params['school_option123'])) {
            
        } else {
            $params['school_option123'] = "NULL";
        }

        if (isset($params['school_code_level'])) {
            
        } else {
            $params['school_code_level'] = "NULL";
        }


        if (isset($params['export'])) {

            $students = $this->obj_students->get_all_option_2_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_students($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['export']);
        }

        if (isset($params['exportpass'])) {

            $students = $this->obj_students->get_all_option_2_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_student_user_pass($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['exportpass']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
        if (!empty($params['id'])) {

            if ($this->obj_categories->get_pexcels_categories_action()->add_level2 == 0) {


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
            }
        }


        $students = $this->obj_students->get_all_option_2_students($params);

        if (!empty($students)) {
            $statistics['sum'] = $this->obj_students->statistics_all_option2_students($params, 0);
        } else {
            $statistics['sum'] = 0;
        }

        if ($params['this']->is_level_3) {

            $params_option = $this->obj_students->get_option2_student_level_2($params);
            $params_option2 = $this->obj_students->get_option2_student_option_2($params);
            $school_code_level = array('NULL' => '') + $this->obj_schools->pluck_select_option2($params_option)->toArray();

            $school_option123 = array('NULL' => '') + $this->obj_schools->pluck_select_option2($params_option2)->toArray();
        } else {

            $school_option123 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();
            $school_code_level = array('NULL' => '') + $this->obj_students->school_option1_student_level_2($params)->toArray();
        }

        //END PEXCEL
        $school_student_school_option_1 = $this->obj_students->statistics_all_student_school_option_1($params);
        $pexcels = $this->obj_students->sendPexcels();
        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);
        $this->data = array_merge($this->data, array(
            'school_code_level' => !empty($school_code_level) ? $school_code_level : '',
            'students' => !empty($students) ? $students : '',
            'categories' => $categories,
            'school_option123' => $school_option123,
            'school_option123_choose' => $params['school_option123'],
            'school_level_choose' => $params['school_code_level'],
            'addeditde' => $addeditde,
            'statistics' => $statistics,
            'request' => $request,
            'params' => $params,
            'pexcels' => array('0' => '...') + $pexcels->toArray(),
        ));

        return view('pnd::admin.management.pnd_option_2_list', $this->data);
    }

    public function index3(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;


        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        } else {
            $params['school_code'] = "";
        }



        $addeditde = 0;

        if (!empty($this->current_user->permissions)) {
            $addeditde = $this->obj_schools->get_school_by_user($params)->school_aed;
        }//
        if ($this->obj_categories->get_pexcels_categories_action()->add_level3 == 1) {
            $addeditde = 1;
        }


        $school_option12 = "";
        $statistics = "";

        /**
         * EXPORT TO FILE EXCEL
         */
        // kiem tra them xoa sua 


        if (isset($params['school_code_level'])) {
            
        } else {
            $params['school_code_level'] = "NULL";
        }
        if (isset($params['school_option_specialist'])) {
            
        } else {
            $params['school_option_specialist'] = "NULL";
        }

        if (isset($params['export'])) {

            $students = $this->obj_students->get_all_option_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_students($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['export']);
        }

        if (isset($params['exportpass'])) {

            $students = $this->obj_students->get_all_option_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_student_user_pass($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['exportpass']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
        if (!empty($params['idupdate'])) {
             
            if ($this->obj_categories->get_pexcels_categories_action()->add_level2 == 0) {


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
            }
        }

        $statistics_all_specialist = $this->obj_students->statistics_all_specialist($params);
        $students = $this->obj_students->get_all_option_students($params);

        if (!empty($students)) {
            $statistics['sum'] = $this->obj_students->statistics_all_option_all_students($params, 0);
        } else {
            $statistics['sum'] = 0;
        }

        if ($params['this']->is_level_3) {


            $params_option = $this->obj_students->get_option_student_level_2($params);
            $school_code_level = array('NULL' => '') + $this->obj_schools->pluck_select_option2($params_option)->toArray();
        } else {

            $school_code_level = array('NULL' => '') + $this->obj_students->school_option1_student_level_2($params)->toArray();
        }

        $params_option_specialist = $this->obj_specialists->pluck_select();
        $school_option_specialist = array('...' => '...') + $params_option_specialist->toArray();
        //END PEXCEL
        $school_student_school_option_1 = $this->obj_students->statistics_all_student_school_option_1($params);
        $pexcels = $this->obj_students->sendPexcels();
        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);
        $this->data = array_merge($this->data, array(
            'school_code_level' => !empty($school_code_level) ? $school_code_level : '',
            'students' => !empty($students) ? $students : '',
            'categories' => $categories,
            'school_level_choose' => $params['school_code_level'],
            'school_option_specialist' => $school_option_specialist,
            'statistics_all_specialist' => !empty($statistics_all_specialist) ? $statistics_all_specialist : '',
            'school_specialist_choose' => $params['school_option_specialist'],
            'addeditde' => $addeditde,
            'statistics' => $statistics,
            'request' => $request,
            'params' => $params,
            'pexcels' => array('0' => '...') + $pexcels->toArray(),
        ));


        return view('pnd::admin.management.pnd_option_list', $this->data);
    }
 public function absent(Request $request) {

       $this->isAuthentication();

        $params = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;


        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        } else {
            $params['school_code'] = "";
        }



        $addeditde = 0;

        if (!empty($this->current_user->permissions)) {
            $addeditde = $this->obj_schools->get_school_by_user($params)->school_aed;
        }//
        if ($this->obj_categories->get_pexcels_categories_action()->add_level3 == 1) {
            $addeditde = 1;
        }


        $school_option12 = "";
        $statistics = "";

        /**
         * EXPORT TO FILE EXCEL
         */
        // kiem tra them xoa sua 


        if (isset($params['school_subject_code'])) {
            
        } else {
            $params['school_subject_code'] = "NULL";
        }
        if (isset($params['school_option_specialist'])) {
            
        } else {
            $params['school_option_specialist'] = "NULL";
        }

      
        
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
        if (!empty($params['insert_absent'])) {

            if ($params['school_specialist']<>"..."){
            
            $params['student_identifi_name'] =$params['keysbd'];
            $params['school_subject_code'] = $params['school_specialist'];
            $params['school_subject_name'] =  $this->obj_specialists->get_mon_subject( $params['school_subject_code']);
            
            if ($params['school_subject_code']){
            $this->obj_students->add_absent_students($params);
            }
            }
        }

          if (!empty($params['search'])) {
 if ($params['school_specialist']<>"..."){
            $params['student_identifi_name'] = $params['keysbd'];
            $params['school_subject_code'] = $params['school_specialist'];
            $params['school_subject_name'] =  $this->obj_specialists->get_mon_subject( $params['school_subject_code']);
         
 }
        }

          if (isset($params['export'])) {

            $students = $this->obj_students->get_all_absent_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_absent_students($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['export']);
        }

        
        $statistics_all_specialist = $this->obj_students->statistics_all_specialist($params);
        $students = $this->obj_students->get_all_absent_students($params);

     
        
        if (!empty($students)) {
            $statistics['sum'] = $this->obj_students->statistics_all_option_all_students($params, 0);
        } else {
            $statistics['sum'] = 0;
        }

       

        $params_option_specialist = $this->obj_specialists->pluck_select();
        $school_option_specialist = array('...' => '...') + $params_option_specialist->toArray();
        
        $school_code_level = $this->obj_specialists->pluck_select_subject();
        $school_code_level = array('...' => '') + $school_code_level->toArray();
        
        
        
        //END PEXCEL
        $school_student_school_option_1 = $this->obj_students->statistics_all_student_school_option_1($params);
        $pexcels = $this->obj_students->sendPexcels();
        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);
        $this->data = array_merge($this->data, array(
            'school_code_level' => !empty($school_code_level) ? $school_code_level : '',
            'students' => !empty($students) ? $students : '',
            'categories' => $categories,
            'school_subject_code' => $params['school_subject_code'],
            'school_option_specialist' => $school_option_specialist,
            'statistics_all_specialist' => !empty($statistics_all_specialist) ? $statistics_all_specialist : '',
            'school_specialist_choose' => $params['school_option_specialist'],
            'addeditde' => $addeditde,
            'statistics' => $statistics,
            'request' => $request,
            'params' => $params,
            'pexcels' => array('0' => '...') + $pexcels->toArray(),
        ));

        
        return view('pnd::admin.management.pnd_exame_school_student_absent_list', $this->data);
    }

    public function school_student_index(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;

        $school_class123 = NULL;
        $school_option12 = NULL;
        $statistics = NULL;
        $school_student_school_option = "NULL";

        /**
         * EXPORT TO FILE EXCEL
         */
        // kiem tra them xoa sua 


        if (isset($params['school_code_level'])) {
            
        } else {
            $params['school_code_level'] = "";
        }
        if (isset($params['school_option123'])) {
            
        } else {
            $params['school_option123'] = "NULL";
        }
        if (isset($params['school_option1234'])) {
            
        } else {
            $params['school_option1234'] = "NULL";
        }

        if (isset($params['export'])) {

            $students = $this->obj_students->get_all_school_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_students($students, $params['school_code_level']);
            }

            unset($params['export']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        }

        //$params['user_id']

        $students = $this->obj_students->get_all_school_students($params);

        if (!empty($students)) {

            $statistics['sum'] = $this->obj_students->statistics_all_students($params, 0);
            $statistics['lvc'] = $this->obj_students->statistics_all_students($params, 1);
            $statistics['dtnt'] = $this->obj_students->statistics_all_students($params, 2);
        } else {
            $statistics['sum'] = 0;
            $statistics['lvc'] = 0;
            $statistics['dtnt'] = 0;
        }




        if (!empty($students)) {

            $statisticss['sum'] = $this->obj_students->statistics_all_all_students($params, 0);
            $statisticss['lvc'] = $this->obj_students->statistics_all_all_students($params, 1);
            $statisticss['dtnt'] = $this->obj_students->statistics_all_all_students($params, 2);

            // $this->obj_students->delete_pexcel_id_recybin($params);
        } else {
            $statisticss['sum'] = 0;
            $statisticss['lvc'] = 0;
            $statisticss['dtnt'] = 0;
        }

        $school_code_level = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(2)->toArray();

        $school_student_school_option = $this->obj_students->statistics_all_student_school_option($params);


        $school_option123 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();

        $school_option1234 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();

        // $school_option12 =$this->obj_schools->pluck_select_option_all($params);
        //  $school_student_school_level_2=$this->obj_students->statistics_all_student_school_level_2();
        //END PEXCEL
        $pexcels = $this->obj_students->sendPexcels();

        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);

        $this->data = array_merge($this->data, array(
            'students' => !empty($students) ? $students : '',
            'categories' => $categories,
            'school_code_level' => $school_code_level,
            'school_option123' => $school_option123,
            'school_option1234' => $school_option1234,
            'school_code_choose' => $params['school_code_level'],
            'school_option123_choose' => $params['school_option123'],
            'school_option1234_choose' => $params['school_option1234'],
            'school_student_school_option' => !empty($school_student_school_option) ? $school_student_school_option : '',
            'statisticss' => $statisticss,
            'statistics' => $statistics,
            'request' => $request,
            'params' => $params,
            'pexcels' => array('0' => '...') + $pexcels->toArray(),
        ));


        return view('pnd::admin.management.pnd_school_student_level_2_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $this->isAuthentication();


        $student = NULL;

        $specialists = NULL;
        $school_levels_3 = NULL;
        $school_levels_specialist = NULL;
        $districts = NULL;

        $params = $request->all();

        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;

        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
            $params['edit'] = $school->edit;
        }

        if (isset($params['school_class123'])) {
            
        } else {
            $params['school_class123'] = "";
        }
        if (isset($params['school_option123'])) {
            
        } else {
            $params['school_option123'] = "";
        }
        if (isset($params['school_option1234'])) {
            
        } else {
            $params['school_option1234'] = "";
        }

        if (isset($params['school_code_level'])) {
            
        } else {
            $params['school_code_level'] = "NULL";
        }

        $school_option123 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();

        $school_option1234 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();

        $school_class123 = ""; //array('NULL' => '') + $this->obj_students->pluck_select_class($params)->toArray();

        $specialists = $this->obj_specialists->pluck_select();

        $specialists = (object) array_merge(['NULL' => '...'], $specialists->toArray());


        $school_levels_3 = $this->obj_schools->pluck_select(['school_level_id' => 3]);
        $school_levels_3 = array('NULL' => '...') + $school_levels_3->toArray();


        $school_levels_specialist = $this->obj_schools->pluck_select(['school_level_id' => 3, 'school_choose_specialist' => 1]);
        $school_levels_specialist = array('NULL' => '...') + $school_levels_specialist->toArray();

        $school_class123 = array('NULL' => '') + $this->obj_students->pluck_select_class($params)->toArray();
        $districts = $this->obj_districts->pluck_select();
        $school_student_school_option_1 = $this->obj_students->statistics_all_student_school_option_1($params);


        $school_code_level = array('NULL' => '') + $this->obj_students->school_option1_student_level_2($params)->toArray();

        //$students = $this->obj_students->get_all_option_students($params);

        if (!empty($students)) {
            $statistics['sum'] = $this->obj_students->statistics_all_option_all_students($params, 0);
        } else {
            $statistics['sum'] = 0;
        }

        //PEXCEL
        if (!empty($params['id'])) {

            $student = $this->obj_students->find($params['id']);
        }


        $pexcels = $this->obj_students->sendPexcels();
        $this->data = array_merge($this->data, array(
            'student' => $student,
            'specialists' => $specialists,
            'school_code_level' => !empty($school_code_level) ? $school_code_level : '',
            'school_levels_3' => $school_levels_3,
            'school_level_choose' => $params['school_code_level'],
            'school_option123' => $school_option123,
            'school_option1234' => $school_option1234,
            'school_option123_choose' => $params['school_option123'],
            'school_option1234_choose' => $params['school_option1234'],
            'school_levels_specialist' => $school_levels_specialist,
            'school_class123_choose' => $params['school_class123'],
            'school_student_school_option_1' => !empty($school_student_school_option_1) ? $school_student_school_option_1 : '',
            'districts' => $districts,
            'statistics' => $statistics,
            'request' => $request,
            'pexcels' => $pexcels,
        ));


        return view('pnd::admin.management.pnd_option_edit', $this->data);
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

        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;
        $input['user_id'] = $this->current_user->id;
        $student_id = (int) $request->get('id');
        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
            $input['edit'] = $school->edit;
        }
        if ($this->is_admin == true) {

            $input['edit'] = 0;
        }


        // $school_student_school_option_1 = $this->obj_students->statistics_all_student_school_option_1($params);

        $student = NULL;

        $data = array();
        if (isset($params['school_option_specialist'])) {
            
        } else {
            $params['school_option_specialist'] = "NULL";
        }
        if (isset($params['school_class123'])) {
            
        } else {
            $params['school_class123'] = "";
        }
        if (isset($params['school_option123'])) {
            
        } else {
            $params['school_option123'] = "";
        }
        if (isset($params['school_option1234'])) {
            
        } else {
            $params['school_option1234'] = "";
        }


        if (isset($params['school_code_level'])) {
            
        } else {
            $params['school_code_level'] = "NULL";
        }

        $school_option123 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();
        $school_option1234 = array('NULL' => '') + $this->obj_schools->pluck_select_code_level(3)->toArray();
        $school_class123 = ""; //array('NULL' => '') + $this->obj_students->pluck_select_class($params)->toArray();


        $specialists = $this->obj_specialists->pluck_select();

        $specialists = (object) array_merge(['NULL' => '...'], $specialists->toArray());


        $school_levels_3 = $this->obj_schools->pluck_select(['school_level_id' => 3]);
        $school_levels_3 = array('NULL' => '...') + $school_levels_3->toArray();


        $school_levels_specialist = $this->obj_schools->pluck_select(['school_level_id' => 3, 'school_choose_specialist' => 1]);
        $school_levels_specialist = array('NULL' => '...') + $school_levels_specialist->toArray();

        $school_class123 = array('NULL' => '') + $this->obj_students->pluck_select_class($params)->toArray();
        $districts = $this->obj_districts->pluck_select();
        $school_student_school_option_1 = $this->obj_students->statistics_all_student_school_option_1($params);



        $school_code_level = array('NULL' => '') + $this->obj_students->school_option1_student_level_2($params)->toArray();

        $students = $this->obj_students->get_all_option_students($params);

        if (!empty($students)) {
            $statistics['sum'] = $this->obj_students->statistics_all_option_all_students($params, 0);
        } else {
            $statistics['sum'] = 0;
        }


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

                    $pexcel = $this->obj_pexcel->find($student->pexcel_id);

                    if (!empty($pexcel) && ($this->is_admin || ( $this->is_level_3))
                    ) {



                        $student = $this->obj_students->update_student($input);
                        //Message
                        $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                        return Redirect::route("admin_pnd_option.edit", ["id" => $student->student_id]);
                    } else {

                        $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));

                        return Redirect::route("admin_pnd_option.edit", ["id" => $student->student_id]);
                    }
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $obj_pexcel = new Pexcel();



                $input['pexcel_id'] = $obj_pexcel->get_pexcels_by_user_id_first($input['user_id'])->pexcel_id;

                if ($this->obj_categories->get_pexcels_categories_action()->add_level2 == 0) {


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
                } else {

                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }
        $pexcels = $this->obj_students->sendPexcels();
        $this->data = array_merge($this->data, array(
            'student' => $student,
            'specialists' => $specialists,
            'school_code_level' => !empty($school_code_level) ? $school_code_level : '',
            'school_levels_3' => $school_levels_3,
            'school_level_choose' => $params['school_code_level'],
            'school_option123' => $school_option123,
            'school_option1234' => $school_option1234,
            'school_option123_choose' => $params['school_option123'],
            'school_option1234_choose' => $params['school_option1234'],
            'school_levels_specialist' => $school_levels_specialist,
            'school_class123_choose' => $params['school_class123'],
            'school_student_school_option_1' => !empty($school_student_school_option_1) ? $school_student_school_option_1 : '',
            'districts' => $districts,
            'statistics' => $statistics,
            'request' => $request,
            'pexcels' => $pexcels,
                ), $data);

        return view('pnd::admin.management.pnd_option_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;


        $student = NULL;
        $student_id = $request->get('id');



        if (!empty($student_id)) {
            $student = $this->obj_students->find($student_id);



            if (!empty($student)) {

//if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3|| $params['this']->is_viewer) {
                if ($params['this']->is_admin || $params['this']->is_level_3 || $params['this']->is_level_2) {

                    if ($params['this']->is_admin) {

                        $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                        $obj_student = new PndUser();
                        $obj_student->delete_user(array('user_name' => $student->student_user));

                        $student->delete();
                    } else {


                        if ($this->obj_schools->get_school_by_user($params)->delete == 0) {

                            $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                            $obj_student = new PndUser();
                            $obj_student->delete_user(array('user_name' => $student->student_user));

                            $student->delete();
                        } else {
                            $this->addFlashMessage('message', trans('pnd::pnd.message_delete_unpermision'));
                        }
                    }
                }
            }
        } else {
            
        }

        $this->data = array_merge($this->data, array(
            'student' => $student,
        ));

        return Redirect::route("admin_pnd_option");
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

    public function getSchoolByDistrict_test(Request $request) {

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

    public function room_list(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;


        $school = $this->obj_schools->get_school_by_user($params);
        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
        } else {
            $params['school_code'] = "";
        }




        $school_option12 = "";
        $statistics = "";

        /**
         * EXPORT TO FILE EXCEL
         */
        // kiem tra them xoa sua 


        if (isset($params['school_test_name'])) {
            $params['school_test_code'] = $params['school_test_name'];
        } else {
            $params['school_test_name'] = "NULL";
        }
        if (isset($params['school_number_room_list'])) {
            
        } else {
            $params['school_number_room_list'] = "NULL";
        }

        if (isset($params['export'])) {

            if ($params['school_test_name'] <> "NULL") {
                if ($params['school_number_room_list'] <> "NULL") {
                    $students = $this->obj_students->get_all_sort_students($params);

                    if (!empty($students)) {
                        $obj_parse = new Parse();
                          if ($params['school_code'] == 9900) {
                            $obj_parse->export_data_room_chuyen_students($students, $this->obj_schools->get_school_by_user($params)->school_name, $this->obj_schoolTests->get_school_test_by_code($params)->school_test_name_title, $params['school_code'], $params['school_test_code'], $params['school_number_room_list']);
                        } else {
                            $obj_parse->export_data_room_students($students, $this->obj_schools->get_school_by_user($params)->school_name, $this->obj_schoolTests->get_school_test_by_code($params)->school_test_name_title, $params['school_code'], $params['school_test_code'], $params['school_number_room_list']);
                        }
                    }

                    unset($params['export']);
                }
            }
        }

        if (isset($params['export_gt'])) {
            if ($params['school_test_name'] <> "NULL") {
                if ($params['school_number_room_list'] <> "NULL") {
                    $students = $this->obj_students->get_all_sort_students($params);

                    if (!empty($students)) {
                        $obj_parse = new Parse();
                           if ($params['school_code'] == 9900) {
                         $obj_parse->export_data_room_ghiten_chuyen_students($students, $this->obj_schools->get_school_by_user($params)->school_name, $this->obj_schoolTests->get_school_test_by_code($params)->school_test_name_title, $params['school_code'], $params['school_test_code'], $params['school_number_room_list']);
                      } else {
                         $obj_parse->export_data_room_ghiten_students($students, $this->obj_schools->get_school_by_user($params)->school_name, $this->obj_schoolTests->get_school_test_by_code($params)->school_test_name_title, $params['school_code'], $params['school_test_code'], $params['school_number_room_list']);
                     }
                        
                        
                        
                        }

                    unset($params['export_gt']);
                }
            }
        }

        if (isset($params['export_tb'])) {
            if ($params['school_test_name'] <> "NULL") {
                if ($params['school_number_room_list'] <> "NULL") {
                    $students = $this->obj_students->get_all_sort_students($params);

                    if (!empty($students)) {
                        $obj_parse = new Parse();
                        $obj_parse->export_data_room_thubai_students($students, $this->obj_schools->get_school_by_user($params)->school_name, $this->obj_schoolTests->get_school_test_by_code($params)->school_test_name_title, $params['school_code'], $params['school_test_code'], $params['school_number_room_list']);
                    }

                    unset($params['export_tb']);
                }
            }
        }

        if (isset($params['export_gbt'])) {
            if ($params['school_test_name'] <> "NULL") {
                if ($params['school_number_room_list'] <> "NULL") {
                    $students = $this->obj_students->get_all_sort_students($params);

                    if (!empty($students)) {
                        $obj_parse = new Parse();
                        $obj_parse->export_data_room_giaybaothi_students($students, $this->obj_schools->get_school_by_user($params)->school_name, $this->obj_schoolTests->get_school_test_by_code($params)->school_test_name_title, $params['school_code'], $params['school_test_code'], $params['school_number_room_list']);
                    }

                    unset($params['export_gbt']);
                }
            }
        }

        if (isset($params['export_indentifi'])) {

            $students = $this->obj_students->get_all_sort_students($params);

            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_school_option_dieuchinh_students($students, $this->obj_schools->get_school_by_user($params)->school_name);
            }

            unset($params['export_indentifi']);
        }

        if (isset($params['export_in'])) {

            $students = $this->obj_examines->list_room_student($params);

            if (!empty($students)) {
                $obj_parse = new Parse();

                if ($params['school_code'] == 9900) {
                    $obj_parse->export_data_hoidong_coithi_chuyen($students, $this->obj_schools->get_school_by_user($params)->school_name, $params['school_code']);
                } else {
                    $obj_parse->export_data_hoidong_coithi($students, $this->obj_schools->get_school_by_user($params)->school_name, $params['school_code']);
                }
            }

            unset($params['export_in']);
        }

        if (isset($params['export_inde'])) {
       


            if ($params['school_code'] == 9900) {
                $students = $this->obj_examines->list_room_student($params);
                if (!empty($students)) {

                    $obj_parse = new Parse();

                    $obj_parse->export_data_print_exame_chuyen($students, $this->obj_schools->get_school_by_user($params)->school_name, $params['school_code']);
                }
            } else {
                $students = $this->obj_schoolTests->list_room_print_exame($params);
                if (!empty($students)) {
                    $obj_parse = new Parse();
                    $obj_parse->export_data_print_exame($students);
                }
            }






            unset($params['export_inde']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
        $statistics_all_specialist = $this->obj_students->statistics_all_specialist($params);
        $students = $this->obj_students->get_all_sort_students($params);


        if ($params['this']->is_level_3) {


            $school_code_level = array('NULL' => '') + $this->obj_examines->pluck_select_school_test($params)->toArray();
            $school_option_specialist = array('NULL' => '') + $this->obj_examines->pluck_select_number_test($params)->toArray();
        }


        $pexcels = $this->obj_students->sendPexcels();
        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);

        $student_list_room = $this->obj_examines->list_room_student($params);


        $this->data = array_merge($this->data, array(
            'school_code_level' => !empty($school_code_level) ? $school_code_level : '',
            'students' => !empty($students) ? $students : '',
            'categories' => $categories,
            'school_level_choose' => $params['school_test_name'],
            'school_option_specialist' => $school_option_specialist,
            'statistics_all_specialist' => !empty($statistics_all_specialist) ? $statistics_all_specialist : '',
            'school_specialist_choose' => $params['school_number_room_list'],
            'list_room' => !empty($student_list_room) ? $student_list_room : '',
            'request' => $request,
            'params' => $params,
            'pexcels' => array('0' => '...') + $pexcels->toArray(),
        ));


        return view('pnd::admin.management.pnd_exame_school_room_list', $this->data);
    }

}
