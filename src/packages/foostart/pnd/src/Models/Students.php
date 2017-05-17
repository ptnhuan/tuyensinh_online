<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Students extends Model
{

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
        'school_code',
        'school_district_code',
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
        'student_pass',
        'pexcel_id'

    ];
    protected $primaryKey = 'student_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_students($params = array())
    {
        $eloquent = self::orderBy('student_last_name', 'ASC');

        //By School
        if (!empty($params['school_code'])) {
            $eloquent = $eloquent->where('school_code', $params['school_code']);
            if (intval(@$params['school_option']) == 1) {
                if (!empty($params['school_code_option']))
                    $eloquent = $eloquent->where('school_code_option_1', $params['school_code_option']);
                else {
                    $eloquent = $eloquent->whereNotNull('school_code_option_1');
                    $eloquent = $eloquent->whereNull('school_code_option_2');
                }
            } elseif (@intval($params['school_option']) == 2) {
                if (!empty($params['school_code_option']))
                    $eloquent = $eloquent->where('school_code_option_2', $params['school_code_option']);
                else {
                    $eloquent = $eloquent->whereNotNull('school_code_option_2');
                    $eloquent = $eloquent->whereNull('school_code_option_1');
                }
            }
        }



        //SEARCH BY NAME OR EMAIL
        if (!empty($params['search_student'])) {

            $eloquent = $eloquent->where(function ($where) use ($params) {
                $where->where('student_email', 'like', '%' . $params['search_student'] . '%')
                    ->orWhere('student_last_name', 'like', '%' . $params['search_student'] . '%');
            });
        }


        //By Categories
        $eloquent = $eloquent->join('pexcel', function ($join) use ($params) {
            $join->on('pexcel.pexcel_id', 'school_students.pexcel_id')
                ->where('pexcel.user_id', $params['user_id']);
        })->leftjoin('pexcel_categories', function ($join) use ($params) {
            $join->on('pexcel.pexcel_category_id', 'pexcel_categories.pexcel_category_id')
                ->where('pexcel_categories.user_id', $params['user_id']);
        });

        if (!empty(@$params['pexcel_category_id'])) {
            $eloquent = $eloquent->where('pexcel_categories.pexcel_category_id', $params['pexcel_category_id']);
        } else {
            $eloquent = $eloquent->where('pexcel_categories.pexcel_category_id', $eloquent->max('pexcel_categories.pexcel_category_id'));
        }

        //pexcel_name
        if (!empty($params['pexcel_id'])) {
            $eloquent = $eloquent->where('pexcel_id', $params['pexcel_id']);
        }

        return $eloquent->paginate(config('buoumau.user_pexcel_per_page'));
    }

    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_student($input, $student_id = NULL)
    {

        if (empty($student_id)) {
            $student_id = $input['student_id'];
        }

        $student = self::find($student_id);

        if (!empty($student)) {

            $student->student_first_name = $input['student_first_name'];
            $student->student_last_name = $input['student_last_name'];
            $student->student_sex = $input['student_sex'];
            $student->student_birth_day = $input['student_birth_day'];
            $student->student_birth_month = $input['student_birth_month'];
            $student->student_birth_year = $input['student_birth_year'];
            $student->student_birth_place = $input['student_birth_place'];
            $student->school_district_code = $input['school_district_code'];
            $student->school_code = $input['school_code'];
            $student->student_class = $input['student_class'];
            $student->student_capacity_6 = $input['student_capacity_6'];
            $student->student_conduct_6 = $input['student_conduct_6'];
             $student->student_capacity_7 = $input['student_capacity_7'];
            $student->student_conduct_7 = $input['student_conduct_7'];
             $student->student_capacity_8 = $input['student_capacity_8'];
            $student->student_conduct_8 = $input['student_conduct_8'];
             $student->student_capacity_9 = $input['student_capacity_9'];
            $student->student_conduct_9 = $input['student_conduct_9'];



            $student->student_average = $input['student_average'];
            $student->student_average_1 = $input['student_average_1'];
            $student->student_average_2 = $input['student_average_2'];
            $student->student_graduate = $input['student_graduate'];
            $student->student_score_prior = $input['student_score_prior'];
            $student->student_score_prior_comment = $input['student_score_prior_comment'];
            $student->student_nominate = $input['student_nominate'];
            $student->school_id_option = $input['school_id_option'];
            $student->school_class_code = $input['school_class_code'];
            $student->school_code_option_1 = $input['school_code_option_1'];
            $student->school_code_option_2 = $input['school_code_option_2'];
            $student->student_email = $input['student_email'];
            $student->student_phone = $input['student_phone'];
            $student->student_user = $input['student_user'];
            $student->student_pass = $input['student_pass'];



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
    private function validRow($data)
    {
        $student = array();

        foreach ($this->fillable as $key) {
            $student[$key] = @$data[$key];
        }

        return $student;
    }

    public function createAccount($student)
    {

        $user_name = $this->generateAccount($student->school_id, $student->student_id);

        $student->student_user = $user_name;
        $student->student_pass = $user_name;

        $student->save();
    }

    public function add_student($input)
    {

        $student = $this->validRow($input);
        $student['student_birth'] = strtotime($student['student_birth_month'] . '/' . $student['student_birth_day'] . '/' . $student['student_birth_year']);

        $student = self::create($student);

        $student = $this->createAccount($student);
        return $student;
    }

    public function add_students($students, $pexcel_id) {

        foreach ($students as $student) {
            $this->add_student((array)$student, $pexcel_id);
        }
    }


    public function delete_student($student_id)
    {
        $eloquent = self::where('student_id', $student_id)->delete();
        return $eloquent;
    }

    public function generateAccount($school_id, $student_id)
    {

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
