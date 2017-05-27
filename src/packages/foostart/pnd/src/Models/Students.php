<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Foostart\Pexcel\Models\Pexcel;
use Foostart\Pexcel\Models\PexcelCategories;
use Foostart\Pnd\Models\PndUser;
use Foostart\Pnd\Models\Districts;
class Students extends Model
{
 
  
    protected $table = 'school_students';
    public $timestamps = false;
    protected $fillable = [
        // 'student_identifi_name',
        //'student_room',
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
        'school_code_option',
        'school_class_code',
        'school_code_option_1',
        'school_code_option_2',
        'student_email',
        'student_phone',
        'student_user',
        'student_pass',
        'pexcel_id',
        'category_name'
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

        //PEXCEL
        if (!empty($params['id'])) {
            $eloquent->where('pexcel_id', $params['id']);
        }

        //SEARCH BY SCHOOL
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

        return $eloquent->paginate(config('pexcel.per_page'));
    }

    public function sendPexcels()
    {

        $pexcels = [];
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {
            $category_ids = [];
            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            $pexcels = $obj_pexcel->pluck_by_categories($category_ids);
        }

        return $pexcels;
    }

    public function get_all_students($params)
    {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my || $params['this']->is_level_2) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }
                if ($pexcel_ids) {

                    $eloquent = self::orderBy('student_last_name', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);

                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }

                    //  if (!empty($params['school_class123'])) {
                    if ($params['school_class123'] <> 'NULL') {
                        $eloquent = $eloquent->where('student_class', $params['school_class123']);
                    }

                    // if (!empty($params['school_option123'])) {
                    if ($params['school_option123'] <> 'NULL') {

                        if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {

                            $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                        } else {

                            if (!empty($params['school_option123'])) {
                                $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                            }
                        }
                    }

                    // if (!empty($params['school_option1234'])) {
                    if ($params['school_option1234'] <> 'NULL') {


                        if (!empty($params['school_option1234'])) {

                            $eloquent = $eloquent->where('school_code_option_2', $params['school_option1234']);
                        }

                    }


                    if ($params['this']->is_level_3) {
                        $eloquent = $eloquent->where('school_code_option_1', $params['school_code']);
                    }

                    if (!empty($params['export'])) {

                        $students = $eloquent->get();
                    } else {

                        $students = $eloquent->paginate(config('pexcel.per_page_students'));
                    }

                    return $students;
                }
            }
        }
    }

    public function get_all_school_students($params)
    {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }
                if ($pexcel_ids) {

                    $eloquent = self::orderBy('student_last_name', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);

                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }
                    if ($params['school_code_level'] <> 'NULL') {
                        //      if (!empty($params['school_code_level'])) {

                        $eloquent = $eloquent->where('school_code', $params['school_code_level']);
                    }

                    if ($params['school_option123'] <> 'NULL') {

                        if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {

                            $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                        } else {

                            if (!empty($params['school_option123'])) {
                                $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                            }
                        }
                    }

                    // if (!empty($params['school_option1234'])) {
                    if ($params['school_option1234'] <> 'NULL') {

                        if (!empty($params['school_option1234'])) {

                            $eloquent = $eloquent->where('school_code_option_2', $params['school_option1234']);
                        }

                    }


                    if (!empty($params['export'])) {

                        $students = $eloquent->get();
                    } else {

                        $students = $eloquent->paginate(config('pexcel.per_page_students'));
                    }

                    return $students;
                }
            }
        }
    }

    public function get_all_sort_students($params)
    {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {
            $category_ids = [];
            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            //id is pexcel_id
            $pexcels = $obj_pexcel->get_by_userId_categoryIds($params['user_id'], $category_ids);

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {
                    $eloquent = self::orderBy('student_identifi', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);

                    if (!empty($params['keyword'])) {
                        $eloquent->where('student_first_name', 'like', '%' . $params['keyword'] . '%');
                        $eloquent->orwhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                    }

                    //school option
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


                    if (!empty($params['export'])) {
                        $students = $eloquent->get();
                    } else {
                        $students = $eloquent->paginate(config('pexcel.per_page_students'));
                    }
                    return $students;
                }
            }
        }
    }

    public
    function get_all_students_order($params)
    {
        $students = NULL;


        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {
            $category_ids = [];
            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }


            //id is pexcel_id
            $pexcels = $obj_pexcel->get_by_userId_categoryIds($params['user_id'], $category_ids);

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {
                    $eloquent = self::orderBy('student_identifi', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);


                    $students = $eloquent->get();
                    return $students;
                }
            }
        }
    }

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_all_identifi_students($params)
    {

        $students = NULL;


        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {
            $category_ids = [];
            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }


            //id is pexcel_id
            $pexcels = $obj_pexcel->get_by_userId_categoryIds($params['user_id'], $category_ids);

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {
                    $eloquent = self::orderBy('student_last_name', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);


                    $students = $eloquent->get();
                    return $students;
                }
            }
        }
    }

    /**
     *
     * @param type $params
     * @return type
     */
    public function statistics_all_students($params, $choose)
    {
        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();
        // var_dump($categories); die();
        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }
                if ($pexcel_ids) {

                    $eloquent = self::whereIn('pexcel_id', $pexcel_ids);
//1 Luong Van Chanh 
                    if (!empty($params['school_code_level'])) {
                        $eloquent = $eloquent->where('school_code', $params['school_code_level']);
                    }

                    if ($choose == "1") {

                        $eloquent = $eloquent->where('school_code_option', "9900");
                    }
//1 Luong Van Chanh
                    if ($choose == "2") {

                        $eloquent = $eloquent->where('school_code_option', "9901");
                    }

                    $students = $eloquent->count();


                    return $students;
                }
            }
        }
    }


    public function statistics_all_all_students($params, $choose)
    {
        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();
        // var_dump($categories); die();
        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }
                if ($pexcel_ids) {

                    $eloquent = self::whereIn('pexcel_id', $pexcel_ids);


                    if ($choose == "1") {

                        $eloquent = $eloquent->where('school_code_option', "9900");
                    }
//1 Luong Van Chanh
                    if ($choose == "2") {

                        $eloquent = $eloquent->where('school_code_option', "9901");
                    }

                    $students = $eloquent->count();


                    return $students;
                }
            }
        }
    }

    /*
     * @param type $params
     * @return type FRONT
     */


    public function statistics_all_student_school_level_2($params)
    {


        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();
        // var_dump($categories); die();
        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {


                    $eloquent = DB::table('schools')
                        ->select('schools.school_code as school_code', 'schools.school_name as school_name','schools.school_district_code as school_district_code', DB::raw('count(school_students.student_id) as countstudent'))
                        ->leftjoin('school_students', 'schools.school_code', '=', 'school_students.school_code')
                        ->where('schools.school_level_id', 2)
                        ->whereIn('school_students.pexcel_id', $pexcel_ids);
                    // if ($params['school_option123'] <> 'NULL') {
                    if ($params['districts_search'] <> 'NULL') {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }
                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_district_code');

$eloquent=$eloquent->get();
                    DB::table('school_student_level_2')->delete();
                     $obj_districts = new Districts();
                    
                    foreach ($eloquent as $s) {

                         $add= $obj_districts->get_name_district($s->school_district_code);
                        
                        DB::table('school_student_level_2')->insert([
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_name_district' => $add, 'school_index' => $s->countstudent]);
                    }

                    
                

                    return $eloquent;
                }
            }
        }
    }
    /*
     * @param type $params
     * @return type
     */

    
    public function statistics_all_student_school_option_1($params)
    {


        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();
        // var_dump($categories); die();
        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my || $params['this']->is_level_2) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }
 
            if ($pexcels) {
                $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {


                    $eloquent = DB::table('schools')
                        ->select('schools.school_name as school_name', DB::raw('count(school_students.student_id) as countstudent'))
                        ->leftjoin('school_students', 'schools.school_code', '=', 'school_students.school_code_option_1')
                        ->where('schools.school_level_id', 3)
                        ->whereIn('school_students.pexcel_id', $pexcel_ids);
                    if (!empty($params['districts_search'])) {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }

                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index');
                    
              
                    return $eloquent->get();
                }
            }
        }
    }

    /*
     * @param type $params
     * @return type
     */

    public function statistics_all_student_school_option($params)
    {


        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();
        // var_dump($categories); die();
        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);

            if ($pexcels) {
                $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {


                    $eloquent = DB::table('schools')
                        ->select('schools.school_name as school_name', DB::raw('count(school_students.student_id) as countstudent'))
                        ->leftjoin('school_students', 'schools.school_code', '=', 'school_students.school_code_option_1')
                        ->where('schools.school_level_id', 3)
                        ->where('school_students.school_code', $params['school_code_level'])
                        ->whereIn('school_students.pexcel_id', $pexcel_ids);
                    if (!empty($params['districts_search'])) {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }

                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index');


                    return $eloquent->get();
                }
            }
        }
    }

    public function statistics_all_student_school_level_front_3()
    {


        $students = NULL;
     
                    $students = DB::table('school_student_option')->get();

                    return $students;
     

    }

    
     public function statistics_all_student_school_level_front_2()
    {


        $students = NULL;
     
                    $students = DB::table('school_student_level_2')->get();

                    return $students;
     

    }
    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    
     public function statistics_all_student_school_level_3($params)
    {


        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();
        // var_dump($categories); die();
        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {

                    DB::table('school_student_option')->delete();

                    $eloquent = DB::table('schools')
                        ->select('schools.school_code as school_code', 'schools.school_name as school_name', 'schools.school_index as school_index', 'schools.school_index2 as school_index2', DB::raw('count(s1.student_id) as countstudent'))
                        ->leftjoin('school_students as s1', 'schools.school_code', '=', 's1.school_code_option')
                        ->where('schools.school_level_id', 3)
                        ->where('schools.school_code', '=', 9900)
                        ->whereIn('s1.pexcel_id', $pexcel_ids);
                    if ($params['districts_search'] <> 'NULL') {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }
                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index', 'schools.school_index2');

                    //   var_dump($eloquent->count());die();
                    $students = $eloquent->get();


                    foreach ($students as $s) {

                        DB::table('school_student_option')->insert([
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_index_1' => $s->school_index, 'school_index_2' => $s->school_index2, 'school_option_1' => $s->countstudent]);
                    }

                    $eloquent = DB::table('schools')
                        ->select('schools.school_code as school_code', 'schools.school_name as school_name', 'schools.school_index as school_index', 'schools.school_index2 as school_index2', DB::raw('count(s1.student_id) as countstudent'))
                        ->leftjoin('school_students as s1', 'schools.school_code', '=', 's1.school_code_option')
                        ->where('schools.school_level_id', 3)
                        ->where('schools.school_code', '=', 9901)
                        ->whereIn('s1.pexcel_id', $pexcel_ids);
                    if ($params['districts_search'] <> 'NULL') {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }
                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index', 'schools.school_index2');

                    //   var_dump($eloquent->count());die();
                    $students = $eloquent->get();


                    foreach ($students as $s) {

                        DB::table('school_student_option')->insert([
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_index_1' => $s->school_index, 'school_index_2' => $s->school_index2, 'school_option_1' => $s->countstudent]);
                    }


                    $eloquent = DB::table('schools')
                        ->select('schools.school_code as school_code', 'schools.school_name as school_name', 'schools.school_index as school_index', 'schools.school_index2 as school_index2', DB::raw('count(s1.student_id) as countstudent'))
                        ->leftjoin('school_students as s1', 'schools.school_code', '=', 's1.school_code_option_1')
                        ->where('schools.school_level_id', 3)
                        ->where('schools.school_code', '<>', 9900)
                        ->where('schools.school_code', '<>', 9901)
                        ->whereIn('s1.pexcel_id', $pexcel_ids);
                    if ($params['districts_search'] <> 'NULL') {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }
                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index', 'schools.school_index2');

                    //   var_dump($eloquent->count());die();
                    $students = $eloquent->get();


                    foreach ($students as $s) {

                        DB::table('school_student_option')->insert([
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_index_1' => $s->school_index, 'school_index_2' => $s->school_index2, 'school_option_1' => $s->countstudent]);
                    }


                    $eloquent = DB::table('schools')
                        ->select('schools.school_code as school_code', 'schools.school_name as school_name', 'schools.school_index as school_index', DB::raw('count(s1.student_id) as countstudent'))
                        ->leftjoin('school_students as s1', 'schools.school_code', '=', 's1.school_code_option_2')
                        ->where('schools.school_level_id', 3)
                        ->where('schools.school_code', '<>', 9900)
                        ->where('schools.school_code', '<>', 9901)
                        ->whereIn('s1.pexcel_id', $pexcel_ids);
                    if ($params['districts_search'] <> 'NULL') {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }
                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index', 'schools.school_index2');

                    //   var_dump($eloquent->count());die();
                    $students = $eloquent->get();

                    foreach ($students as $s) {

                        DB::table('school_student_option')->where('school_code', $s->school_code)
                            ->update(['school_option_2' => $s->countstudent]);

                    }

                    $students = DB::table('school_student_option')->get();

                    return $students;
                }
            }
        }


    }

    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public
    function update_student($input, $student_id = NULL)
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
            $student->school_code_option = $input['school_code_option'];
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

    public function user_update_student($input, $student_id = NULL)
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

            $student->school_code = $input['school_code'];
            $student->student_class = $input['student_class'];

            $student->student_email = $input['student_email'];
            $student->student_phone = $input['student_phone'];


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
            $student->school_code_option = $input['school_code_option'];
            $student->school_class_code = $input['school_class_code'];
            $student->school_code_option_1 = $input['school_code_option_1'];
            $student->school_code_option_2 = $input['school_code_option_2'];

            $student->student_pass = $input['student_pass'];


            $student->save();

            return $student;
        } else {
            return NULL;
        }
    }

    // luu sinh vien cap nhat mat khau
    public function user_update_student_k($input, $student_id = NULL)
    {

        if (empty($student_id)) {
            $student_id = $input['student_id'];
        }

        $student = self::find($student_id);

        if (!empty($student)) {


            $student->student_email = $input['student_email'];
            $student->student_phone = $input['student_phone'];


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
    private
    function validRow($data)
    {
        $student = array();

        foreach ($this->fillable as $key) {
            $student[$key] = @$data[$key];
        }

        return $student;
    }

    public
    function createAccount($student)
    {

        $user_name = $this->generateAccount($student->school_code, $student->student_id);

        $student->student_user = $user_name;
        $student->student_pass = $user_name;

        $student->save();
    }

    public
    function add_student($input)
    {

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_pexcels_categories_action();

        $student = $this->validRow($input);
        //  $student['student_birth'] = strtotime($student['student_birth_month'] . '/' . $student['student_birth_day'] . '/' . $student['student_birth_year']);
        $student['category_name'] = $categories->pexcel_category_name;

        //    $pexcels = $obj_pexcel->get_by_userId_categoryIds_first($input['user_id'], $categories->pexcel_category_id);
        //     $student['pexcel_id'] = $pexcels->pexcel_id;

        $student = self::create($student);

        $student = $this->createAccount($student);
        return $student;
    }

    public function add_students($students, $pexcel_id)
    {

        foreach ($students as $student) {
            $this->add_student((array)$student, $pexcel_id);
        }
    }

    public function delete_student($student_id)
    {
        $eloquent = self::where('student_id', $student_id)->delete();
        return $eloquent;
    }

    public
    function generateAccount($school_id, $student_id)
    {

        $school_id .= '';
        $student_id .= '';

        $user_name = array();
        $account_max_length = config('pexcel.account_max_length');


        //array user
        for ($i = 0; $i < $account_max_length; $i++) {
            $user_name[] = 0;
        }

        //insert first
        for ($i = 0; $i < strlen($school_id); $i++) {
            $user_name[$i] = $school_id[$i];
        }

        //insert last
        for ($i = 0; $i < strlen($student_id); $i++) {
            $user_name[$account_max_length - strlen($student_id) + $i] = $student_id[$i];
        }

        return implode($user_name);
    }

    public
    function get_student($params = [])
    {

        $eloquent = null;
        if (!empty($params['user_name'])) {
            $eloquent = self::where('student_user', $params['user_name'])->first();
        }
        if (!empty($params['school_code']) && !empty($params['id'])) {
            $eloquent = self::where('student_id', $params['id'])
                ->where('school_code', $params['school_code'])->first();
        }

        return $eloquent;
    }

    function get_student_option($params)
    {
        // $eloquent = self::groupBy('school_code_option_1') ;

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }
                if ($pexcel_ids) {

                    $eloquent = self::orderBy('student_last_name', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);

                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }


                    $students = $eloquent->get();


                    return $students->pluck('school_code_option_1');
                }
            }
        }
    }

    function get_student_option_2($params)
    {
        // $eloquent = self::groupBy('school_code_option_1') ;

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];
                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }
                if ($pexcel_ids) {

                    $eloquent = self::orderBy('student_last_name', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);

                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }


                    $students = $eloquent->get();


                    return $students->pluck('school_code_option_2');
                }
            }
        }
    }

    public function deleteStudentsByPexcelId($pexcel_id)
    {

        $obj_user = new PndUser();
        //Delete in user table

        $students = self::where('pexcel_id', $pexcel_id)->get();

        if (!empty($students)) {
            foreach ($students as $student) {
                $user = $obj_user->delete_user(array('user_name' => $student['student_user']));
            }
        }
    }

    public function pluck_select_class($params = array())
    {

        $eloquent = self::orderBy('student_class', 'ASC');

        if (!empty($params)) {
            $eloquent = $eloquent->where('school_code', $params['school_code']);
        }

        $eloquent = $eloquent->groupBy('student_class');

        return $eloquent->pluck('student_class', 'student_class');
    }


    public function delete_pexcel_id_recybin($params)
    {


        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();
        // var_dump($categories); die();
        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3) {//user is admin
                $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
            } else if ($params['this']->is_my) {
                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($pexcels) {
                $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }

                if ($pexcel_ids) {

                    $eloquent = DB::table('school_students')
                        ->whereNotIn('pexcel_id', $pexcel_ids)->delete();

                    $eloquent = DB::table('school_students')
                        ->whereNull('pexcel_id')->delete();
                }

            }
        }
    }


}
