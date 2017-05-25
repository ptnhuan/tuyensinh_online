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
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\Specialists;
use Foostart\Pnd\Models\PndUser;
use Foostart\Pexcel\Models\Pexcel;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminValidator;

class PndStatisticsAdminController extends PndController {

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

        $params1 = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;
        
        $statistics=NULL;
        
        if (isset($params1['districts_search'])) {
            $params['districts_search']=$params1['districts_search'];
     } else{
         $params['districts_search']=NULL; 
     }
     
                $districts_search = $this->obj_districts->pluck_select();

        $districts_search = array('NULL' => '...') + $districts_search->toArray();

  
        if (isset($params1['export'])) {

          
            $students = $this->obj_students->statistics_all_student_school_level_2($params);
                
          
            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_school_students($students);
            }
            unset($params1['export']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
       
        

           // $school_option12 =$this->obj_schools->pluck_select_option_all($params);
           $school_student_school_level_2=$this->obj_students->statistics_all_student_school_level_2($params);
     
        //END PEXCEL
        
 

        $this->data = array_merge($this->data, array(
           // 'students' => !empty($students) ? $students : '',
            //'categories' => $categories,
            //'school_option123' => $school_option123,
            //'school_option12' =>$school_option12,
            //'school_option123_choose' => $params['school_option123'],
            //'addeditde' => $addeditde,
           // 'statistics' => $statistics,
               
              'districts_code_choose' => $params['districts_search'],
                'districts_search' => $districts_search,
            'school_student_school_level_2' => !empty($school_student_school_level_2) ? $school_student_school_level_2 : '',
            'request' => $request,
            'params' => $params,
            
        ));
        
        
        return view('pnd::admin.management.pnd_statistics_level_2_list', $this->data);
       
    } 

      public function index_3(Request $request) {

        $this->isAuthentication();

        $params1 = $request->all();
        $params_option = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;
        
        $statistics=NULL;
        
        if (isset($params1['districts_search'])) {
            $params['districts_search']=$params1['districts_search'];
     } else{
         $params['districts_search']=NULL; 
     }
     
                $districts_search = $this->obj_districts->pluck_select();

        $districts_search = array('NULL' => '...') + $districts_search->toArray();

  
        if (isset($params1['export'])) {

          
            $students = $this->obj_students->statistics_all_student_school_level_3($params);
                
          
            if (!empty($students)) {
                $obj_parse = new Parse();
                $obj_parse->export_data_school_students($students);
            }
            unset($params1['export']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
       
        

           // $school_option12 =$this->obj_schools->pluck_select_option_all($params);
           $school_student_school_level_3=$this->obj_students->statistics_all_student_school_level_3($params);
     
        //END PEXCEL
        
 

        $this->data = array_merge($this->data, array(
           // 'students' => !empty($students) ? $students : '',
            //'categories' => $categories,
            //'school_option123' => $school_option123,
            //'school_option12' =>$school_option12,
            //'school_option123_choose' => $params['school_option123'],
            //'addeditde' => $addeditde,
           // 'statistics' => $statistics,
               
              'districts_code_choose' => $params['districts_search'],
                'districts_search' => $districts_search,
            'school_student_school_level_3' => !empty($school_student_school_level_3) ? $school_student_school_level_3 : '',
            'request' => $request,
            'params' => $params,
            
        ));
        
        
        return view('pnd::admin.management.pnd_statistics_level_3_list', $this->data);
       
    } 
}
