<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model {

    protected $table = 'school_students';
    public $timestamps = false;
    protected $fillable = [
        'student_first_name',
        'student_last_name',
        'student_sex',
        'student_birth',
        'student_birth_day',
        'student_birth_month',
        'student_birth_year',
        'student_birth_place',
        'school_id',
        'school_district_id',
        'student_class',
        'student_capacity_6',
        'student_conduct_6',
        'student_capacity_7',
        'student_conduct_7',
        'student_capacity_8',
        'student_conduct_8',
        'student_capacity_9',
        'student_conduct_9',
        'student_average',
        'student_average_1',
        'student_average_2',
        'student_graduate',
        'student_score_prior',
        'student_score_prior_comment',
        'student_nominate',
        'school_id_option',
        'school_class_code',
        'school_code_option_1',
        'school_code_option_2',
        'student_email',
        'student_phone',

        'student_user',
        'student_pass'
    ];
    protected $primaryKey = 'student_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_students($params = array()) {
        $eloquent = self::orderBy('student_last_name', 'DESC');

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
    public function update_student($input, $student_id = NULL) {

        if (empty($student_id)) {
            $student_id = $input['student_id'];
        }
        
        $student = self::find($student_id);

        if (!empty($student)) {

            $student->student_first_name = $input['student_first_name'];
            $student->student_last_name = $input['student_last_name'];

            $student->student_email = $input['student_email'];
   

            $student->save();
 
            return $student;
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
        $student = array();

        foreach ($this->fillable as $key) {
            $student[$key] = @$data[$key];
        }

        return $student;
    }

    public function createAccount($student) {

        $user_name = $this->generateAccount($student->school_id, $student->student_id);

        $student->student_user = $user_name;
        $student->student_pass = $user_name;

        $student->save();
    }

    public function add_student($input) {

        $student = $this->validRow($input);
        $student['student_birth'] = strtotime($student['student_birth_month'] . '/' . $student['student_birth_day'] . '/' . $student['student_birth_year']);
 
        $student = self::create($student);
                
        $student = $this->createAccount($student);
        return $student;
    }


    public function delete_student($student_id) {
        $eloquent = self::where('student_id', $student_id)->delete();
        return $eloquent;
    }

    public function generateAccount($school_id, $student_id) {

        $school_id .= '';
        $student_id .= '';

        $user_name = array();
        $account_max_length = config('pexcel.account_max_length');


        for ($i = 0; $i < $account_max_length; $i++) {
            $user_name[] = 0;
        }

        for ($i = 0; $i < strlen($school_id); $i++) {
            $user_name[$i] = $school_id[$i];
        }

        for ($i = 0; $i < strlen($student_id); $i++) {
            $user_name[$account_max_length - $i - 1] = $student_id[$i];
        }

        return implode($user_name);
    }

}
