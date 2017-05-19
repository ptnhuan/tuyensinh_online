<?php namespace Foostart\Pnd\Models;

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
    protected $primaryKey = 'pnd_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_pnds($params = array()) {
        $eloquent = self::orderBy('school_id', 'DESC');

        //pnd_name
        if (!empty($params['pnd_name'])) {
            $eloquent->where('pnd_name', 'like', '%' . $params['pnd_name'] . '%');
        }

        $pnds = $eloquent->paginate(config('pnd.per_page'));

        return $pnds;
    }

    /**
     *
     * @param type $input
     * @param type $pnd_id
     * @return type
     */
    public function update_pnd($input, $school_id = NULL) {

        if (empty($school_id)) {
            $school_id = $input['school_id'];
        }

        $pnd = self::find($school_id);

        if (!empty($pnd)) {

            $pnd->pnd_name = $input['pnd_name'];
            $pnd->pnd_description = $input['pnd_description'];

            $pnd->pnd_category_id = $input['pnd_category_id'];

            $pnd->pnd_file_path = $input['pnd_file_path'];

            $pnd->pnd_updated_at = time();

            $pnd->save();

            return $pnd;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_pnd($input) {

        $pnd = self::create([
                    'pnd_name' => @$input['pnd_name'],
                    'pnd_description' => @$input['pnd_description'],
                    'pnd_file_path' => @$input['pnd_file_path'],

                    'user_id' => @$input['user_id'],
                    'pnd_category_id' => @$input['pnd_category_id'],

                    'pnd_created_at' => time(),
                    'pnd_updated_at' => time(),
        ]);
        return $pnd;
    }

    public function get_pnds_by_user_id($user_id) {

        $eloquent = self::where('user_id', $user_id)
                ->orderby('pnd_created_at');

        $pnds = $eloquent->paginate(9);

        return $pnds;
    }

    /**
     * USER POST
     * @param type $user_id
     * @return type
     */
    public function get_user_pnds($params, $user_id) {
        $eloquent = self::where('user_id', $user_id)
                ->orderby('pnd_id', 'DESC');

        //pnd_name
        if (!empty($params['pnd_name'])) {
            $eloquent->where('pnd_name', 'like', '%' . $params['pnd_name'] . '%');
        }

        $pnds = $eloquent->paginate(config('buoumau.user_pnd_per_page'));

        return $pnds;
    }

}
