<?php

namespace Foostart\Pexcel\Models;

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
        'school_class_code',
        'school_code_option_1',
        'school_code_option_2',
        'student_email',
        'student_phone',
    ];
    protected $primaryKey = 'student_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_students($params = array()) {
        $eloquent = self::orderBy('student_last_name', 'ASC');

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
    public function update_pexcel($input, $pexcel_id = NULL) {

        if (empty($pexcel_id)) {
            $pexcel_id = $input['pexcel_id'];
        }

        $pexcel = self::find($pexcel_id);

        if (!empty($pexcel)) {

            $pexcel->pexcel_name = $input['pexcel_name'];
            $pexcel->pexcel_description = $input['pexcel_description'];

            $pexcel->pexcel_category_id = $input['pexcel_category_id'];

            $pexcel->pexcel_file_path = $input['pexcel_file_path'];

            $pexcel->pexcel_updated_at = time();

            $pexcel->save();

            return $pexcel;
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

    public function add_student($input, $pexcel_id) {

        $student = $this->validRow($input);
        $student['student_birth'] = strtotime($student['student_birth_month'].'/'.$student['student_birth_day'].'/'.$student['student_birth_year']);

        $student['pexcel_id'] = $pexcel_id;
        $pexcel = self::create($student);
        return $pexcel;
    }

    public function add_students($students, $pexcel_id) {

        foreach ($students as $student) {
            $this->add_student($student, $pexcel_id);
        }
    }

    public function get_pexcels_by_user_id($user_id) {

        $eloquent = self::where('user_id', $user_id)
                ->orderby('pexcel_created_at');

        $pexcels = $eloquent->paginate(9);

        return $pexcels;
    }

    /**
     * USER POST
     * @param type $user_id
     * @return type
     */
    public function get_user_pexcels($params, $user_id) {
        $eloquent = self::where('user_id', $user_id)
                ->orderby('pexcel_id', 'DESC');

        //pexcel_name
        if (!empty($params['pexcel_name'])) {
            $eloquent->where('pexcel_name', 'like', '%' . $params['pexcel_name'] . '%');
        }

        $pexcels = $eloquent->paginate(config('buoumau.user_pexcel_per_page'));

        return $pexcels;
    }

    public function delete_old_data($pexcel_id) {
        $eloquent = self::where('pexcel_id', $pexcel_id)->delete();
        return $eloquent;
    }
}