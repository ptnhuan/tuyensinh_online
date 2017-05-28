<?php

namespace Foostart\Pnd\Controllers\Front;

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

       
        $school_student_school_level_2 = $this->obj_students->statistics_all_student_school_level_front_2();
       
$data_update = $this->obj_students->get_first_statistics_all_student_school_level_2()->first()->updatetime;

        //END PEXCEL


        $this->data = array_merge($this->data, array(
            
 
            'school_student_school_level_2' => !empty($school_student_school_level_2) ? $school_student_school_level_2: '',
            'request' => $request,
              'data_update' => $data_update,
           
        ));


       
        return view('pnd::Front.pnd_statistics_level_2_list', $this->data);
    }

    public function index_3(Request $request) {
  
        
 
        $school_student_school_level_3 = $this->obj_students->statistics_all_student_school_level_front_3();
       


        //END PEXCEL

$data_update = $this->obj_students->get_first_statistics_all_student_school_level_3()->first()->updatetime;

        $this->data = array_merge($this->data, array(
            
 
            'school_student_school_level_3' => !empty($school_student_school_level_3) ? $school_student_school_level_3 : '',
            'request' => $request,
              'data_update' => $data_update,
           
        ));


        return view('pnd::Front.pnd_statistics_level_3_list', $this->data);
    }

}
