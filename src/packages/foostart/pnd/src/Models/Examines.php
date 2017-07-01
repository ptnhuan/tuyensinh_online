<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function user_update_student_order($input) {
        $student_id = $input['student_id'];
        $student = self::find($student_id);

        if (!empty($student)) {
            $student->active = $input['active'];

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

    public function user_update_namez_student($input) {
        $student_id = $input['student_id'];
        $student = self::find($student_id);

        if (!empty($student)) {
            $student->student_last_namez = $input['student_last_namez'];
            $student->student_last_name = $input['student_last_name'];
            $student->school_class_code = $input['school_class_code'];


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

    public function insert_room_student($input) {

        if ($input['school_code'] == 9900) {


            $eloquent = DB::table('school_students')
                    ->select('student_identifi as student_indentifi', 'student_identifi_name as student_identifi_name', 'school_code_option', 'student_room', 'category_name')
                    ->where('school_code_option', $input['school_code'])
                    ->where('student_room', $input['school_code_room']);


            $eloquent = $eloquent->get();
         
            if (!empty($eloquent)) {
                if ($eloquent->max('school_code_option')) {
                    DB::table('school_student_rooms')->insert([
                        'school_code' => $eloquent->max('school_code_option'), 'school_room' => $eloquent->max('student_room'), 'student_indentifi_to' => $eloquent->min('student_indentifi'), 'student_indentifi_from' => $eloquent->max('student_indentifi'), 'school_number_students' => ($eloquent->max('student_indentifi') - $eloquent->min('student_indentifi') + 1), 'category_name' => $eloquent->max('category_name'), 'school_choose_specialist' => $input['school_option_specialist']]);
                }
            }
        } else {

            if ($input['school_code'] == 9901) {



                $eloquent = DB::table('school_students')
                        ->select('student_identifi as student_indentifi', 'student_identifi_name as student_identifi_name', 'school_code_option', 'student_room', 'category_name')
                        ->where('school_code_option', $input['school_code'])
                        ->where('student_room', $input['school_code_room']);


                $eloquent = $eloquent->get();

                if (!empty($eloquent)) {

                    DB::table('school_student_rooms')->insert([
                        'school_code' => $eloquent->max('school_code_option'), 'school_room' => $eloquent->max('student_room'), 'student_indentifi_to' => $eloquent->min('student_indentifi'), 'student_indentifi_from' => $eloquent->max('student_indentifi'), 'school_number_students' => ($eloquent->max('student_indentifi') - $eloquent->min('student_indentifi') + 1), 'category_name' => $eloquent->max('category_name')]);
                }
            } else {

            
                $eloquent = DB::table('school_students')
                        ->select('student_identifi as student_indentifi', 'student_identifi_name as student_identifi_name', 'school_code_option_1', 'student_room', 'category_name')
                        ->where('school_code_option_1', $input['school_code'])
                        ->where('student_room', $input['school_code_room'])->where(function($q) {
                                        $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                    });


                $eloquent = $eloquent->get();

                if (!empty($eloquent)) {

                    DB::table('school_student_rooms')->insert([
                        'school_code' => $eloquent->max('school_code_option_1'), 'school_room' => $eloquent->max('student_room'), 'student_indentifi_to' => $eloquent->min('student_indentifi'), 'student_indentifi_from' => $eloquent->max('student_indentifi'), 'school_number_students' => ($eloquent->max('student_indentifi') - $eloquent->min('student_indentifi') + 1), 'category_name' => $eloquent->max('category_name')]);
                }
            }
        }
    }

    public function list_room_student($input) {
        $students = NULL;
        $eloquent = DB::table('school_student_rooms');
        $eloquent->orderBy('school_id', 'ASC');
        if (!empty($input['school_code'])) {
            $eloquent->where('school_code', $input['school_code']);
        }
        $students = $eloquent->get();
        return $students;
    }

    public function min_room_number_student($school_code, $school_code_test) {

        $students = NULL;
        $eloquent = DB::table('school_student_rooms');

        $eloquent->where('school_code', $school_code);
        $eloquent->where('school_code_test', $school_code_test);


        $students = $eloquent->get();
        return $students;
    }

    public function pluck_select_school_test($input) {
        $eloquent = DB::table('school_tests');
        $eloquent->orderBy('school_test_id', 'ASC')
                ->where('school_code', $input['school_code']);
        return $eloquent->pluck('school_test_name', 'school_test_code');
    }

    public function pluck_select_number_test($input) {
        $eloquent = DB::table('school_student_rooms');
        $eloquent->orderBy('school_room', 'ASC')
                ->where('school_code', $input['school_code']);
        if (!empty($input['school_test_name'])) {
            $eloquent->where('school_code_test', $input['school_test_name']);
        }


        return $eloquent->pluck('school_room', 'school_room');
    }

}
