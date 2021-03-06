<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;
use Foostart\Pnd\Models\PndUser;
use Illuminate\Support\Facades\Hash;

class Schools extends Model {

    protected $table = 'schools';
    public $timestamps = false;
    protected $fillable = [
        'school_code',
        'school_name',
        'school_code_room',
        'school_number_room',
        'school_name_title',
        'school_address',
        'school_phone',
        'school_email',
        'school_contact',
        'school_contact_chutich',
        'school_district_code',
        'school_level_id',
        'school_index',
        'school_index2',
        'add',
        'edit',
        'delete',
        'user_id',
        'pass_id',
        'school_contact_phone',
        'school_contact_email',
        'school_contact_chutich_phone',
        'school_contact_chutich_email',
        'keylook_identifi',
        'keylook_room',
        'keylook_test'
    ];
    protected $primaryKey = 'school_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_schools($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        //pexcel_name
        if (!empty($params['school_level_id'])) {
          
            $eloquent->where('school_level_id', $params['school_level_id']);
        }
      
        if ($params['districts_search'] <> "NULL") {
            if (!empty($params['districts_search'])) {
                $eloquent->where('school_district_code', $params['districts_search']);
            }
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
            $school_id = $input['school_id'];
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
            $school->school_index = $input['school_index'];
            $school->school_index2 = $input['school_index2'];
            $school->add = $input['add_level'];
            $school->edit = $input['edit_level'];
            $school->delete = $input['delete_level'];
            $school->pexcel_edit = $input['pexcel_edit'];
            $school->school_email = $input['school_email'];          
            $school->school_district_code = $input['school_district_code'];
            $school->school_level_id = $input['school_level_id'];
            $school->user_id = $input['user_id'];
            $school->pass_id = $input['pass_id'];
            $school->school_contact_chutich_phone = $input['school_contact_chutich_phone'];
            $school->school_contact_chutich_email = $input['school_contact_chutich_email'];
              $school->school_contact_chutich = $input['school_contact_chutich'];
            $school->school_contact_phone = $input['school_contact_phone'];
            $school->school_contact_email = $input['school_contact_email'];
              $school->school_contact = $input['school_contact'];
            $school->school_examination = $input['school_examination'];
            $school->keylook_identifi = $input['keylook_identifi'];
            $school->keylook_test = $input['keylook_test'];
            $school->keylook_room = $input['keylook_room'];



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
public function update_school_permision($input) {

      
        $school = self::where('school_level_id', 2)
                ->update(['add' => $input['add_level2'], 'edit' => $input['edit_level2'], 'delete' => $input['delete_level2'], 'pexcel_edit' => $input['pexcel_edit']]);


        $eloquent = self::orderBy('school_name', 'ASC')->where('school_level_id', 2)->get();

        foreach ($eloquent as $s) {

            $obj_user = new PndUser();
            $user = $obj_user->search_user(['user_name' => $s['user_id']]);

            if ($user) {
                $obj_user->update_user_level_2($user, $s, $input['pexcel_edit']);
            }
        }
           

        $school = self::where('school_level_id', 3)
                ->update(['keylook_identifi' => $input['keylook_identifi'], 'keylook_room' => $input['keylook_room'], 'keylook_test' => $input['keylook_test'],'add' => $input['add_level3'], 'edit' => $input['edit_level3'], 'delete' => $input['delete_level3']]);
    }

    public function keylook_school_identifi($input, $school_id = NULL) {

        if (empty($school_id)) {
            $school_id = $input['school_id'];
       
        }

        $school = self::find($school_id);

        if (!empty($school)) {
           
            $school->keylook_identifi = 1;
                       
            $school->save();

            return $school;
        } else {
            return NULL;
        }
    }
    public function keylook_school_room($input, $school_id = NULL) {

        if (empty($school_id)) {
            $school_id = $input['school_id'];
       
        }

        $school = self::find($school_id);

        if (!empty($school)) {
           
            $school->keylook_room = 1;
                       
            $school->save();

            return $school;
        } else {
            return NULL;
        }
    }
    public function keylook_school_test($input, $school_id = NULL) {

        if (empty($school_id)) {
            $school_id = $input['school_id'];
        }

        $school = self::find($school_id);

        if (!empty($school)) {


            $school->keylook_test = 1;
                       
            $school->save();

            return $school;
        } else {
            return NULL;
        }
    }

        public function update_school_about($input, $school_id = NULL) {

        if (empty($school_id)) {
            $school_id = $input['school_id'];
        }

        $school = self::find($school_id);

        if (!empty($school)) {


            $school->school_name = $input['school_name'];
            $school->school_address = $input['school_address'];
            $school->school_phone = $input['school_phone'];
            $school->school_email = $input['school_email'];
            $school->school_contact = $input['school_contact'];

            $school->school_name_title = $input['school_name_title'];
            $school->pass_id = $input['pass_id'];

            $school->school_contact_phone = $input['school_contact_phone'];
            $school->school_contact_email = $input['school_contact_email'];

             $school->school_contact_chutich_phone = $input['school_contact_chutich_phone'];
            $school->school_contact_chutich_email = $input['school_contact_chutich_email'];
              $school->school_contact_chutich = $input['school_contact_chutich'];
            
              
            $school->save();

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

    public function createAccount($school) {

        $user_name = $this->generateAccount($school->school_id, $school->school_code);

        $school->user_id = $user_name;
        $school->pass_id = $user_name;


        $school->save();
    }

    public function add_school($input) {

        $school = $this->validRow($input);

        $school = self::create($school);
        // $school = $this->createAccount($school);
        //Update user account
        $obj_user = new PndUser();
        $user = $obj_user->search_user(['user_name' => $school->user_id]);
        if ($user) {
            $obj_user->update_user($user, $school);
        } else {

            $obj_user->create_user($school);
        }
            return $school;
    }

    public function delete_school($school_id) {
        $eloquent = self::where('school_id', $school_id)->delete();
        return $eloquent;
    }

    public function generateAccount($school_id, $school_code) {

        $school_id .= '';
        $school_code .= '';

        $user_name = array();
        $account_max_length = config('pexcel.account_max_length');


        for ($i = 0; $i < $account_max_length; $i++) {
            $user_name[] = 0;
        }

        for ($i = 0; $i < strlen($school_id); $i++) {
            $user_name[$i] = $school_id[$i];
        }

        for ($i = 0; $i < strlen($school_code); $i++) {
            $user_name[$account_max_length - $i - 1] = $school_code[$i];
        }

        return implode($user_name);
    }

    public function get_school_by_user($params = []) {
        $eloquent = self::where('user_id', $params['user_name'])->first();

        return $eloquent;
    }

    
    
    
    public function get_school_all() {
        $eloquent = self::orderBy('school_name', 'ASC');
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

    
     public function pluck_select_Level_23($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');
      
        if (!empty($params['school_district_code'])) {
           
            $eloquent = $eloquent->where('school_district_code', $params['school_district_code']); 
            
        }
        
        
           
       
        return $eloquent->pluck('school_name', 'school_code');
    }
    
    
    
    
    public function pluck_select1($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        return $eloquent->pluck('school_name', 'school_code');
    }

    public function pluck_select_test($params = array()) {
     
        $eloquent = self::orderBy('school_name', 'ASC');

        return $eloquent->pluck('school_name', 'school_code');
    }

    public function pluck_select_option($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        if (!empty($params)) {
            $eloquent = $eloquent->whereIn('school_code', $params);
        }

        $eloquent = $eloquent->orWhere('school_choose_specialist', 1);

        return $eloquent->pluck('school_name', 'school_code');
    }
    
    
     public function pluck_select_school_specialist() {
        $eloquent = self::orderBy('school_name', 'ASC');
        $eloquent = $eloquent->orWhere('school_choose_specialist', 1);

        return $eloquent->pluck('school_name', 'school_code');
    }
    
     public function pluck_select_option2($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        if (!empty($params)) {
            $eloquent = $eloquent->whereIn('school_code', $params);
        }
 
        return $eloquent->pluck('school_name', 'school_code');
    }

     public function pluck_select_option_specialist($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

      
        if (!empty($params)) {
            $eloquent = $eloquent->whereIn('school_code', $params);
        }
 
        return $eloquent->pluck('school_name', 'school_code');
    }
    
    public function pluck_select_option_all($params = array()) {
        $eloquent = self::orderBy('school_name', 'ASC');

        if (!empty($params)) {
            $eloquent = $eloquent->whereIn('school_code', $params);
        }

        return $eloquent->pluck('school_name', 'school_code', 'school_code');
    }

    public function pluck_select_code_level($level) {
        $eloquent = self::orderBy('school_district_code', 'ASC');

        $eloquent = $eloquent->where('school_level_id', $level);

        return $eloquent->pluck('school_name', 'school_code');
    }
    
    public function pluck_school_name_code($code) {
        $eloquent = self::where('school_code', $code)->first();
        return $eloquent ;
   
    
    }
}
