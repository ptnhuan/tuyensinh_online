<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;
use Foostart\Pnd\Models\PndUser;
use Illuminate\Support\Facades\Hash;
use DB;

class SchoolTests extends Model {

    protected $table = 'school_tests';
    public $timestamps = false;
    protected $fillable = [
        'school_code',
        'school_test_code',
        'school_test_name',
        'school_test_name_title',
        'school_test_address',
        'school_test_phone',
        'school_test_phone_chutich',
        'school_test_email_chutich',
        'school_test_phone_thuky',
        'school_test_email_thuky',
        'school_test_chutich',
        'school_test_thuky',
         'school_number_room' ,
    'school_number_room_to' ,
    'school_number_room_from'  
    ];
    protected $primaryKey = 'school_test_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_schools($params = array()) {
        $eloquent = self::orderBy('school_test_id', 'ASC');

        
        if (!empty($params['school_code'])) {
            $eloquent->where('school_code', $params['school_code']);
        }
      
 

        $schools = $eloquent->get();

        return $schools;
    }

     public function get_schooltests($params = array()) {
         
      //  $eloquent = self::orderBy('school_tests.school_test_id', 'DESC');
                          
                        $eloquent = DB::table('school_tests')->orderBy('school_tests.school_code', 'ASC')
                            ->select( 'school_tests.school_code as school_code', 'school_tests.school_test_code as school_test_code','schools.school_name as school_name', 'school_tests.school_test_chutich as school_test_chutich','school_tests.school_test_phone_chutich as school_test_phone_chutich','school_tests.school_test_email_chutich as school_test_email_chutich', 'school_tests.school_test_thuky as school_test_thuky','school_tests.school_test_phone_thuky as school_test_phone_thuky','school_tests.school_test_email_thuky as school_test_email_thuky', 'school_tests.school_test_name as school_test_name', 'school_tests.school_number_room as school_number_room', 'school_tests.school_number_room_to as school_number_room_to', 'school_tests.school_number_room_from as school_number_room_from')
                            ->leftjoin('schools', 'schools.school_code', '=', 'school_tests.school_code');
                        
                     
        $schools = $eloquent->get();

        return $schools;
    }
    
    
    
        public function get_school_test_by_code($params = []) {
        $eloquent = self::where('school_code', $params['school_code'])
                ->where('school_test_code', $params['school_test_code'])                
                ->first();
        return $eloquent;
    }
    
    
      public function get_school_test_by_school_code($school_code,$school_test_code) {
        $eloquent = self::where('school_code', $school_code)
                ->where('school_test_code', $school_test_code)                
                ->first();
        return $eloquent;
    }
    
    
    public function list_room_print_exame($input) {
         
         $eloquent = self::orderBy('school_test_id', 'ASC');

        
        if (!empty($input['school_code'])) {
            $eloquent->where('school_code', $input['school_code']);
        }
   
        $schools = $eloquent->get();

        return $schools;
        
      
    }
    
    
    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_school($input, $school_id = NULL) {

        if (empty($school_id)) {
            $school_test_id = $input['school_id'];
            
           
        }

        $school = self::find($school_test_id);

        if (!empty($school)) {

         
            $school->school_code = $input['school_code'];
            $school->school_test_code = $input['school_test_code'];
            $school->school_test_name = $input['school_test_name'];
             $school->school_test_name_title = $input['school_test_name_title'];
            $school->school_test_address = $input['school_test_address'];
            
              $school->school_test_phone = $input['school_test_phone'];
            $school->school_test_phone_chutich = $input['school_test_phone_chutich'];
            
            
            $school->school_test_email_chutich = $input['school_test_email_chutich'];
            $school->school_test_phone_thuky = $input['school_test_phone_thuky'];
            $school->school_test_email_thuky = $input['school_test_email_thuky'];
            $school->school_test_chutich = $input['school_test_chutich'];
            $school->school_test_thuky = $input['school_test_thuky'];
            $school->school_number_room = $input['school_number_room'];
            $school->school_number_room_to = $input['school_number_room_to'];
            $school->school_number_room_from = $input['school_number_room_from'];
           
            
           
            $school->save();
 
            return $school;
        } else {
            return NULL;
        }
    }

    
    /**
     *
     * @param type $input
     * @return type
     */
    private function validRow($data) {
        $school = array();

        foreach ($this->fillable as $key) {
            $school[$key] = @$data[$key];
        }

        return $school;
    }

    
    public function add_school($input) {

        $school = $this->validRow($input);

        $school = self::create($school);
        

        return $school;
    }

    public function delete_school($school_id) {
        $eloquent = self::where('school_test_id', $school_id)->delete();
        return $eloquent;
    }

   
    public function get_school_by_user_id($user_id = null) {
        $eloquent = self::where('user_id', $user_id)->first();
     
        return $eloquent;
        
    }
    
     
    
    
    
    public function pluck_select($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        if (!empty($params['school_district_code'])) {
            $eloquent = $eloquent->where('school_district_code', $params['school_district_code']);
        }
        if (!empty($params['school_choose_specialist'])) {
            $eloquent = $eloquent->where('school_choose_specialist', $params['school_choose_specialist']);
        }
        $eloquent = $eloquent->where('school_level_id', $params['school_level_id']);

        return $eloquent->pluck('school_name', 'school_code');
    }

    public function pluck_select1($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        return $eloquent->pluck('school_name', 'school_code');
    }



    
    
    public function update_room_test_student($input) {

      $eloquent = self::orderBy('school_test_id', 'ASC');
        
        if (!empty($input['school_code'])) {
            $eloquent->where('school_code', $input['school_code']);
        }
                      
        $eloquent = $eloquent->get();
     
        foreach ($eloquent as $s) {
          
            DB::table('school_student_rooms')
                    ->where('school_code', $s->school_code)
                    ->where('school_room', '>=', $s->school_number_room_to)
                    ->where('school_room', '<=', $s->school_number_room_from)
                    ->update(['school_code_test' => $s->school_test_code]);


            if ($input['school_code'] == 9900) {

                DB::table('school_students')
                        ->where('school_code_option', $s->school_code)
                        ->where('student_room', '>=', $s->school_number_room_to)
                        ->where('student_room', '<=', $s->school_number_room_from)
                        ->update(['school_code_test' => $s->school_test_code]);
            } else {

                if ($input['school_code'] == 9901) {

                    DB::table('school_students')
                            ->where('school_code_option', $s->school_code)
                            ->where('student_room', '>=', $s->school_number_room_to)
                            ->where('student_room', '<=', $s->school_number_room_from)
                            ->update(['school_code_test' => $s->school_test_code]);
                } else {
                    DB::table('school_students')
                            ->where('school_code_option_1', $s->school_code)
                            ->where('student_room', '>=', $s->school_number_room_to)
                            ->where('student_room', '<=', $s->school_number_room_from)
                            ->update(['school_code_test' => $s->school_test_code]);
                }
            }
        }
        
      
    }
    
    
    
    
    
    
     



    
    
    
    
    
    
    
    
    
}
