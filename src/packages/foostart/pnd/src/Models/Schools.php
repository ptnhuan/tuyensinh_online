<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

class Schools extends Model {

    protected $table = 'schools';
    public $timestamps = false;
    protected $fillable = [
        'school_code',
        'school_name',
        'school_address',
        'school_phone',
        'school_email',
        'school_contact',
        'school_district_id',
        'school_level_id',
        'school_user',
        'school_pass'      
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
        if (!empty($params['pexcel_id'])) {
            $eloquent->where('pexcel_id', $params['pexcel_id']);
        }

        $pexcels = $eloquent->paginate(config('pexcel.per_page'));

        return $pexcels;
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
            $school->school_phone = $input['school_code'];
            $school->school_email = $input['school_email'];
            $school->school_contact = $input['school_contact'];
            $school->school_district_id = $input['school_district_id'];
            $school->school_level_id = $input['school_level_id'];
            $school->school_user = $input['school_user'];
            $school->school_pass = $input['school_pass'];
                          
            
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

    public function createAccount($school) {

        $user_name = $this->generateAccount($school->school_id, $school->school_code);

        $school->school_user = $user_name;
        $school->school_pass = $user_name;
      
        
        $school->save();
    }

    public function add_school($input) {

        $school = $this->validRow($input);
 
        $school = self::create($school);

        $school = $this->createAccount($school);
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

}
