<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;
use Foostart\Pnd\Models\PndUser;
use Illuminate\Support\Facades\Hash;


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
        'school_test_email',
        'school_test_contact',
        'school_test_district_code',
             'school_test_contact_phone',
        'school_test_contact_email'
    ];
    protected $primaryKey = 'school_test_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_schools($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        
        if (!empty($params['school_district_label'])) {
            $eloquent->where('school_district_code', $params['school_district_label']);
        }
        if (!empty($params['school_label'])) {

            $eloquent->where('school_name', 'like', '%' . $params['school_label'] . '%');
            $eloquent->orwhere('school_address', 'like', '%' . $params['school_label'] . '%');
            $eloquent->orwhere('school_email', 'like', '%' . $params['school_label'] . '%');
            $eloquent->orwhere('school_level_id', $params['school_level_id']);
            $eloquent->orwhere('school_contact_phone', 'like', '%' . $params['school_label'] . '%');
        }


        if (!empty($params['permissions'])) {
            if (!empty($params['pexcel_id'])) {
                $eloquent->where('pexcel_id', $params['pexcel_id']);
            }
        }

        $schools = $eloquent->paginate(config('pexcel.per_page'));

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

        $school = self::find($school_id);

        if (!empty($school)) {

            $school->school_code = $input['school_code'];
            $school->school_name = $input['school_name'];
            $school->school_address = $input['school_address'];
                 $school->school_number_room = $input['school_number_room'];
            $school->school_phone = $input['school_phone'];
            
              $school->school_code_room = $input['school_code_room'];
            $school->school_name_title = $input['school_name_title'];
            
            
            $school->school_email = $input['school_email'];
            $school->school_contact = $input['school_contact'];
            $school->school_district_code = $input['school_district_code'];
            $school->school_level_id = $input['school_level_id'];
            $school->user_id = $input['user_id'];
            $school->pass_id = $input['pass_id'];
            $school->school_contact_phone = $input['school_contact_phone'];
            $school->school_contact_email = $input['school_contact_email'];

            
          
            $school->save();

            //Update user account
            $obj_user = new PndUser();
            $user = $obj_user->search_user(['user_name' => $school->user_id]);
            if ($user) {
                $obj_user->update_user($user, $school);
            } else {

                $obj_user->create_user($school);
            }
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



}
