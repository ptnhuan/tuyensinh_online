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
use Foostart\Pnd\Models\Schools;
use Foostart\Pnd\Models\SchoolTests;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\Examines;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Helper\Parse;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndSchoolTestAdminValidator;

class PndSchoolTestAdminController extends PndController {

    private $obj_school_tests = NULL;
    private $obj_schools = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;
    private $obj_districts = NULL;
    private $obj_examines = NULL;

    public function __construct() {
        $this->obj_school_tests = new SchoolTests();
        $this->obj_schools = new Schools();
        $this->obj_districts = new Districts();
        $this->obj_examines = new Examines();
        $this->obj_pexcel_categories = new PexcelCategories();
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
               $params['keylook_test'] = $school->keylook_test;
        }

        
        
  $student_list_room = $this->obj_examines->list_room_student($params);
    //     'list_room' => !empty($student_list_room) ? $student_list_room : '',
        $school_tests = $this->obj_school_tests->get_schools($params);
    
        $this->data = array_merge($this->data, array(
             'schooltests' => $school_tests,
            'request' => $request,
            'list_room' => !empty($student_list_room) ? $student_list_room : '',
            'params' => $params
        ));
        return view('pnd::admin.management.pnd_exame_school_test_list', $this->data);
        
    }

    /**
     *
     * @return type
     */
   

    /**
     *
     * @return type
     */
    public function edit(Request $request) {
         
        $param_users = $request->all();
        $this->isAuthentication();
        $school_users = $this->current_user->user_name;
        $param_users['user_name'] = $school_users;
       
        $school_id_test=NULL;
         $school = NULL;
         
        $school_id = (int)$request->get('id');

        if ($school_users <> 'admin') {
             $school_id_test = $this->obj_schools->get_school_by_user($param_users)->school_code;
                     
        }
        
        
        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();


        $school_levels_3 = $this->obj_schools->pluck_select(['school_level_id' => 3]);
        $school_levels_3 = array('NULL' => '...') + $school_levels_3->toArray();

          $school_all = $this->obj_schools->pluck_select_test();
 
         
     if (!empty($school_id) && (is_int($school_id))) {

            $school = $this->obj_school_tests->find($school_id);
                  
       }
  
        $this->data = array_merge($this->data, array(
            'school' => $school,
             'school_all' => $school_all,
            'school_id_test' => $school_id_test,            
            'school_levels_3' => $school_levels_3,
            'districts' => $districts,
            'districts_search' => $districts_search,
            'request' => $request,
        ));
 
        return view('pnd::admin.management.pnd_exame_school_test_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request) {
      
        $param_users = $request->all();
        $this->isAuthentication();
        $school_users = $this->current_user->user_name;
        $param_users['user_name'] = $school_users;
       
        $school_id_test=NULL;
         $school = NULL;
         $input = $request->all();

        $school_id = (int)$request->get('id');
       
      

 
        if ($school_users <> 'admin') {
             $school_id_test = $this->obj_schools->get_school_by_user($param_users)->school_code;
                     
        }

        $this->obj_validator = new PndSchoolTestAdminValidator();

     
   
        
        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();

        $schools = NULL;
        $data = array();
      
        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_id) && is_int($school_id)) {
                $school = $this->obj_school_tests->find($school_id);
            }
        } else {
            if (!empty($school_id) && is_int($school_id)) {

            
                $school = $this->obj_school_tests->find($school_id);

                if (!empty($school)) {
                  
                    $input['school_id'] = $school_id;
 
                    $school = $this->obj_school_tests->update_school($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));
     return Redirect::route("admin_pnd_exame_school_test.edit", ["id" => $school->school_test_id]);
                   // return Redirect::route("admin_pnd_exame_school_test.edit", ["id" => $school->school_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {
             
                $input = array_merge($input, array());

                $schools = $this->obj_school_tests->add_school($input);

                if (!empty($schools)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));
                    return Redirect::route("admin_pnd_exame_school_test.edit", ["id" => $schools->school_test_id]);
                    //  return Redirect::route("admin_pnd.parse", ["id" => $schools->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'schools' => $schools,
            'districts' => $districts,
            'districts_search' => $districts_search,
              'school_id_test' => $school_id_test,
            'request' => $request,
                ), $data);

        return view('pnd::admin.management.pnd_exame_school_test_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    
     public function order(Request $request) {
      
         $this->isAuthentication();

        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;
        $school_users = $this->current_user->user_name;

         $school = $this->obj_schools->get_school_by_user($params);


        if (!empty($school)) {
            $params['school_code'] = $school->school_code;
            $params['school_id'] = $school->school_id;
             $params['keylook_test'] = $school->keylook_test;
        }
       
       
        if (isset($params['indentk'])) {
             
          $this->obj_schools->keylook_school_test($params);
        }

       if (isset($params['indent'])) {
         
       $this->obj_school_tests->update_room_test_student($params);

        }
 $student_list_room = $this->obj_examines->list_room_student($params);
   
    $school_tests = $this->obj_school_tests->get_schools($params);
    
        $this->data = array_merge($this->data, array(
             'schooltests' => $school_tests,
            'request' => $request,
               'list_room' => !empty($student_list_room) ? $student_list_room : '',
            'params' => $params
        ));
        return view('pnd::admin.management.pnd_exame_school_test_list', $this->data);
    }

    
    public function post_about(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PndSchoolAdminValidator();
        $input = $request->all();
        //$input['user_id'] = $this->current_user->id;

        $school_id = (int) $request->get('id');
        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();

        $schools = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_id) && is_int($school_id)) {
                $school = $this->obj_schools->find($school_id);
            }
        } else {
            if (!empty($school_id) && is_int($school_id)) {

                $school = $this->obj_schools->find($school_id);

                if (!empty($school)) {

                    $input['school_id'] = $school_id;

                    $school = $this->obj_schools->update_school_about($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("admin_pnd_school_about", ["id" => $school->school_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $schools = $this->obj_schools->add_school($input);

                if (!empty($schools)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    //  return Redirect::route("admin_pnd.parse", ["id" => $schools->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'schools' => $schools,
            'districts' => $districts,
            'districts_search' => $districts_search,
            'request' => $request,
                ), $data);

        return view('pnd::admin.management.pnd_school_about', $this->data);
    }

    /**
     *
     * @return type
     */

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $school = NULL;
        $school_id = $request->get('id');

        if (!empty($school_id)) {
            $school = $this->obj_school_tests->find($school_id);

            if (!empty($school)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $school->delete();
            }
        } else {
            
        }

        $this->data = array_merge($this->data, array(
            'school' => $school,
        ));

        return Redirect::route("admin_pnd_exame_school_test");
    }

   

}
