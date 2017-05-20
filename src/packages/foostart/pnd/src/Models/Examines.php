<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

class Examines extends Model {

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
        'student_pass',
        'pnd_created_at',
        'pnd_updated_at',
    ];
    protected $primaryKey = 'student_id';

    public function user_update_student($input) {
        $student_id = $input['student_id'];
        $student = self::find($student_id);

        if (!empty($student)) {
            $student->student_point_6 = $input['student_point_6'];
            $student->student_point_7 = $input['student_point_7'];
            $student->student_point_8 = $input['student_point_8'];
            $student->student_point_9 = $input['student_point_9'];
            $student->student_point_sum = $input['student_point_sum'];
            $student->save();
            return $student;
        } else {
            return NULL;
        }
    }
    
     public function user_update_identifi_student($input) {
        $student_id = $input['student_id'];
        $student = self::find($student_id);

        if (!empty($student)) {
            $student->student_identifi = $input['student_identifi'];
            $student->student_identifi_name = $input['student_identifi_name'];
            
            $student->save();
            return $student;
        } else {
            return NULL;
        }
    }
    
     public function user_update_room_student($input) {
        $student_id = $input['student_id'];
        $student = self::find($student_id);

        if (!empty($student)) {
            $student->student_room = $input['student_room'];
              
            $student->save();
            return $student;
        } else {
            return NULL;
        }
    }

}
