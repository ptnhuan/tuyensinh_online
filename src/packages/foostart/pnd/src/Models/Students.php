<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Foostart\Pexcel\Models\Pexcel;
use Foostart\Pexcel\Models\PexcelCategories;
use Foostart\Pnd\Models\PndUser;
use Foostart\Pnd\Models\Districts;
use \DateTime;

class Students extends Model {

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
    public function get_students($params = array()) {
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

    public function sendPexcels() {

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

    public function get_all_option_2_students($params) {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

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

                    $eloquent = self::orderBy('student_id', 'ASC')
                            ->whereIn('pexcel_id', $pexcel_ids);

                    if ($params['this']->is_level_3) {
                        $eloquent = $eloquent->where('school_code_option_2', $params['school_code']);
                    }

                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                    ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }

                    //school level 2
                    if (@$params['school_code_level'] <> "NULL") {



                        $eloquent = $eloquent->where('school_code', $params['school_code_level']);
                    }




                    // if (!empty($params['school_option1234'])) {
                    if (@$params['school_option123'] <> "NULL") {


                        if (!empty($params['school_option123'])) {

                            $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
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

    public function get_all_option_1_students($params) {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

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

                    $eloquent = self::orderBy('student_id', 'ASC')
                            ->whereIn('pexcel_id', $pexcel_ids);

                    if ($params['this']->is_level_3) {
                        $eloquent = $eloquent->where('school_code_option_1', $params['school_code']);
                    }

                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                    ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }

                    //school level 2
                    if (@$params['school_code_level'] <> "NULL") {



                        $eloquent = $eloquent->where('school_code', $params['school_code_level']);
                    }


                    // if (!empty($params['school_option123'])) {
                    if (@$params['school_code_option'] <> "NULL") {

                        if (($params['school_code_option'] == "9900" || $params['school_code_option'] == "9901")) {

                            $eloquent = $eloquent->where('school_code_option', $params['school_code_option']);
                        }
                    }

                    // if (!empty($params['school_option1234'])) {
                    if (@$params['school_option1234'] <> "NULL") {


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

    public function get_all_option_students($params) {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

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

                    $eloquent = self::orderBy('student_id', 'ASC')
                            ->whereIn('pexcel_id', $pexcel_ids);
                    if (!empty($params['school_code'])) {


                        if (($params['school_code'] == 9900)or ( $params['school_code'] == 9901)) {


                            $eloquent->where('school_code_option', $params['school_code']);
                            if ($params['school_option_specialist'] <> 'NULL') {
                                if ($params['school_option_specialist'] <> '...') {

                                    $eloquent->where('school_class_code', $params['school_option_specialist']);
                                }
                            }
                        } else {



                            $eloquent->where('school_code_option_1', $params['school_code'])
                                    ->where(function($q) {
                                        $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                    });
                        }
                    } else {

                        $eloquent->WhereNotNull('school_code_option_1')
                                ->where(function($q) {
                                    $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                });
                    }




                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                    ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }

                    //school level 2
                    if (@$params['school_code_level'] <> "NULL") {
                        $eloquent->where('school_code', $params['school_code_level']);
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
    public function get_all_absent_students($params) {

        $students = NULL;

        $eloquent = DB::table('school_student_absent_rooms')->orderBy('student_identifi', 'ASC');

        if (!empty($params['school_code'])) {
                $eloquent->where('school_code', $params['school_code']);
               
             if ($params['school_subject_code'] <> 'NULL') {
                    if ($params['school_subject_code'] <> '') {

                        $eloquent->where('school_subject_code', $params['school_subject_code']);
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

    public function get_all_order_students($params) {

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
            } else if ($params['this']->is_my || $params['this']->is_level_2) {

                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($params['school_code'] <> "999") {


                if ($pexcels) {
                    $pexcel_ids = [];
                    foreach ($pexcels as $pexcel) {
                        $pexcel_ids[] = $pexcel->pexcel_id;
                    }
                    if ($pexcel_ids) {

                        $eloquent = self::orderBy('student_point_sum', 'DESC')
                                ->whereIn('pexcel_id', $pexcel_ids);

                        if (!empty($params['keyword'])) {

                            $eloquent = $eloquent->where(function ($where) use ($params) {
                                $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                        ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                            });
                        }

                        if (!empty($params['school_class123'])) {
                            if ($params['school_class123'] <> "NULL") {
                                $eloquent = $eloquent->where('student_class', $params['school_class123']);
                            }
                        }

                        if (!empty($params['school_option123'])) {
                            if ($params['school_option123'] <> "NULL") {

                                if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {

                                    $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                                } else {

                                    if (!empty($params['school_option123'])) {
                                        $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                                    }
                                }
                            }
                        }
                        if (!empty($params['school_option1234'])) {
                            if ($params['school_option1234'] <> "NULL") {


                                if (!empty($params['school_option1234'])) {

                                    $eloquent = $eloquent->where('school_code_option_2', $params['school_option1234']);
                                }
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
            } else {
                // su dung cho truong quang lai    
                // var_dump($pexcels->toArray()) ;die();
                // $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
                // $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }


                $eloquent = self::orderBy('student_id', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);
                $eloquent->Orwhere('school_code', $params['school_code']);

                if (!empty($params['keyword'])) {

                    $eloquent = $eloquent->where(function ($where) use ($params) {
                        $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                    });
                }

                if (!empty($params['school_class123'])) {
                    if ($params['school_class123'] <> "NULL") {
                        $eloquent = $eloquent->where('student_class', $params['school_class123']);
                    }
                }

                if (!empty($params['school_option123'])) {
                    if ($params['school_option123'] <> "NULL") {

                        if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {

                            $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                        } else {

                            if (!empty($params['school_option123'])) {
                                $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                            }
                        }
                    }
                }
                if (!empty($params['school_option1234'])) {
                    if ($params['school_option1234'] <> "NULL") {


                        if (!empty($params['school_option1234'])) {

                            $eloquent = $eloquent->where('school_code_option_2', $params['school_option1234']);
                        }
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

    public function get_all_order_students2($params) {

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
            } else if ($params['this']->is_my || $params['this']->is_level_2) {

                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($params['school_code'] <> "999") {


                if ($pexcels) {
                    $pexcel_ids = [];
                    foreach ($pexcels as $pexcel) {
                        $pexcel_ids[] = $pexcel->pexcel_id;
                    }
                    if ($pexcel_ids) {

                        $eloquent = self::orderBy('student_point_sum', 'DESC')
                                ->whereIn('pexcel_id', $pexcel_ids);

                        if ($params['this']->is_level_3) {

                            $eloquent = $eloquent->where('school_code_option_2', $params['school_code']);
                        }


                        if (!empty($params['export'])) {

                            $students = $eloquent->get();
                        } else {

                            $students = $eloquent->paginate(config('pexcel.per_page_students'));
                        }

                        return $students;
                    }
                }
            } else {
                // su dung cho truong quang lai    
                // var_dump($pexcels->toArray()) ;die();
                // $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
                // $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }


                $eloquent = self::orderBy('student_id', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);
                $eloquent->Orwhere('school_code', $params['school_code']);

                if (!empty($params['keyword'])) {

                    $eloquent = $eloquent->where(function ($where) use ($params) {
                        $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                    });
                }

                if (!empty($params['school_class123'])) {
                    if ($params['school_class123'] <> "NULL") {
                        $eloquent = $eloquent->where('student_class', $params['school_class123']);
                    }
                }

                if (!empty($params['school_option123'])) {
                    if ($params['school_option123'] <> "NULL") {

                        if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {

                            $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                        } else {

                            if (!empty($params['school_option123'])) {
                                $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                            }
                        }
                    }
                }
                if (!empty($params['school_option1234'])) {
                    if ($params['school_option1234'] <> "NULL") {


                        if (!empty($params['school_option1234'])) {

                            $eloquent = $eloquent->where('school_code_option_2', $params['school_option1234']);
                        }
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

    public function get_all_students($params) {

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
            } else if ($params['this']->is_my || $params['this']->is_level_2) {

                $pexcels = $obj_pexcel->get_by_userId_categoryIds($params, $category_ids);
            } else {
                return;
            }

            if ($params['school_code'] <> "999") {


                if ($pexcels) {
                    $pexcel_ids = [];
                    foreach ($pexcels as $pexcel) {
                        $pexcel_ids[] = $pexcel->pexcel_id;
                    }
                    if ($pexcel_ids) {

                        $eloquent = self::orderBy('student_id', 'ASC')
                                ->whereIn('pexcel_id', $pexcel_ids);

                        if (!empty($params['keyword'])) {

                            $eloquent = $eloquent->where(function ($where) use ($params) {
                                $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                        ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                            });
                        }

                        if (!empty($params['school_class123'])) {
                            if ($params['school_class123'] <> "NULL") {
                                $eloquent = $eloquent->where('student_class', $params['school_class123']);
                            }
                        }

                        if (!empty($params['school_option123'])) {
                            if ($params['school_option123'] <> "NULL") {

                                if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {

                                    $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                                } else {

                                    if (!empty($params['school_option123'])) {
                                        $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                                    }
                                }
                            }
                        }
                        if (!empty($params['school_option1234'])) {
                            if ($params['school_option1234'] <> "NULL") {


                                if (!empty($params['school_option1234'])) {

                                    $eloquent = $eloquent->where('school_code_option_2', $params['school_option1234']);
                                }
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
            } else {
                // su dung cho truong quang lai    
                // var_dump($pexcels->toArray()) ;die();
                // $pexcels = $obj_pexcel->get_all_by_categoryIds($category_ids);
                // $pexcel_ids = [];

                foreach ($pexcels as $pexcel) {
                    $pexcel_ids[] = $pexcel->pexcel_id;
                }


                $eloquent = self::orderBy('student_id', 'ASC')
                        ->whereIn('pexcel_id', $pexcel_ids);
                $eloquent->Orwhere('school_code', $params['school_code']);

                if (!empty($params['keyword'])) {

                    $eloquent = $eloquent->where(function ($where) use ($params) {
                        $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                    });
                }

                if (!empty($params['school_class123'])) {
                    if ($params['school_class123'] <> "NULL") {
                        $eloquent = $eloquent->where('student_class', $params['school_class123']);
                    }
                }

                if (!empty($params['school_option123'])) {
                    if ($params['school_option123'] <> "NULL") {

                        if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {

                            $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                        } else {

                            if (!empty($params['school_option123'])) {
                                $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                            }
                        }
                    }
                }
                if (!empty($params['school_option1234'])) {
                    if ($params['school_option1234'] <> "NULL") {


                        if (!empty($params['school_option1234'])) {

                            $eloquent = $eloquent->where('school_code_option_2', $params['school_option1234']);
                        }
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

    public function get_all_school_students($params) {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }



            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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
                    if ($params['school_option_specialist'] <> '...') {


                        $eloquent->where('school_class_code', $params['school_option_specialist']);
                    }

                    if ($params['school_code_level'] <> '') {
                        if ($params['school_code_level'] <> 'NULL') {
                            //      if (!empty($params['school_code_level'])) {

                            $eloquent->where('school_code', $params['school_code_level']);
                        }
                    }


                    if ($params['school_option123'] <> 'NULL') {

                        if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {
                            $eloquent->where('school_code_option', $params['school_option123']);
                        } else {
                            if (!empty($params['school_option123'])) {


                                $eloquent->where('school_code_option_1', $params['school_option123'])
                                        ->where(function($q) {
                                            $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                        });
                            }
                        }
                    }

                    // if (!empty($params['school_option1234'])) {
                    if ($params['school_option1234'] <> 'NULL') {

                        if (!empty($params['school_option1234'])) {

                            $eloquent->where('school_code_option_2', $params['school_option1234']);
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

    public function get_all_school_students_level_2($params) {

        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }



            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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

                    $eloquent = self::orderBy('student_id', 'ASC')
                            ->whereIn('pexcel_id', $pexcel_ids);

                    if (!empty($params['keyword'])) {
                        $eloquent = $eloquent->where(function ($where) use ($params) {
                            $where->where('student_first_name', 'like', '%' . $params['keyword'] . '%')
                                    ->orWhere('student_last_name', 'like', '%' . $params['keyword'] . '%');
                        });
                    }

                    if ($params['school_option_specialist'] <> '...') {
                        if ($params['school_option_specialist'] <> "NULL") {


                            $eloquent->where('school_class_code', $params['school_option_specialist']);
                        }
                    }

                    if ($params['school_code_level'] <> '') {
                        if ($params['school_code_level'] <> 'NULL') {
                            //      if (!empty($params['school_code_level'])) {

                            $eloquent->where('school_code', $params['school_code_level']);
                        }
                    }


                    if ($params['school_option123'] <> 'NULL') {

                        if (($params['school_option123'] == "9900" || $params['school_option123'] == "9901")) {
                            $eloquent = $eloquent->where('school_code_option', $params['school_option123']);
                        } else {
                            //   if (!empty($params['school_option123'])) {


                            $eloquent->where('school_code_option_1', $params['school_option123']);
                        }
                        // }
                    }

                    // if (!empty($params['school_option1234'])) {
                    if ($params['school_option1234'] <> 'NULL') {

                        if (!empty($params['school_option1234'])) {

                            $eloquent->where('school_code_option_2', $params['school_option1234']);
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

    public function get_all_sort_students($params) {
        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

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

                    $eloquent = self::orderBy('student_identifi', 'ASC')
                            ->whereIn('pexcel_id', $pexcel_ids);

           

                    if (!empty($params['school_code'])) {

                        if ($params['school_test_name'] <> 'NULL') {
                            if (!empty($params['school_test_name'])) {
                                $eloquent->where('school_code_test', $params['school_test_name']);
                            }
                        }
                        if ($params['school_number_room_list'] <> 'NULL') {
                            if (!empty($params['school_number_room_list'])) {
                                $eloquent->where('student_room', $params['school_number_room_list']);
                            }
                        }


                        if (($params['school_code'] == 9900)or ( $params['school_code'] == 9901)) {

                            if ($params['school_code'] == 9900) {
                                    //     var_dump($params['school_code']);die();
                                $eloquent->where('school_code_option', $params['school_code']);
                               // if (@$params['school_option_specialist'] <> 'NULL') {
                                 //   if (@$params['school_option_specialist'] <> '...') {

                                   //     $eloquent->where('school_class_code', $params['school_option_specialist']);
                                   // }
                                //}
                            }
                            //truong dtnt
                            if ($params['school_code'] == 9901) {
                                $eloquent->where('school_code_option', $params['school_code']);
                            }
                            
                            
                        } else {



                            $eloquent->where('school_code_option_1', $params['school_code'])
                                    ->where(function($q) {
                                        $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                    });
                        }
                    } else {

                        $eloquent->WhereNotNull('school_code_option_1')
                                ->where(function($q) {
                                    $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                });
                    }





                    $students = $eloquent->paginate(config('pexcel.per_page_students'));


                    return $students;
                }
            }
        }
    }

    
    
    

     public function get_all_sort_identifi_students($params) {
        $students = NULL;

        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();

        $categories = $obj_pexcel_category->get_available_categories();

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

                    $eloquent = self::orderBy('student_last_namez', 'ASC')
                            ->whereIn('pexcel_id', $pexcel_ids);
                    if (!empty($params['school_code'])) {


                        if (($params['school_code'] == 9900)or ( $params['school_code'] == 9901)) {

                             if ($params['school_code'] == 9900) {

                                $eloquent->where('school_code_option', $params['school_code']);
                                if ($params['school_option_specialist'] <> 'NULL') {
                                    if ($params['school_option_specialist'] <> '...') {

                                        $eloquent->where('school_class_code', $params['school_option_specialist']);
                                    }
                                }
                            }
//dtnt
                            if ($params['school_code'] == 9901) {
                                $eloquent->where('school_code_option', $params['school_code']);
                            }
                        } else {



                            $eloquent->where('school_code_option_1', $params['school_code'])
                                    ->where(function($q) {
                                        $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                    });
                        }
                    } else {

                        $eloquent->WhereNotNull('school_code_option_1')
                                ->where(function($q) {
                                    $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                });
                    }



                    $students = $eloquent->get();

                    return $students;
                }
            }
        }
    }
    
    public
            function get_all_students_order($params) {
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
    public function get_all_identifi_students($params) {

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
                    if ($params['this']->is_level_3) {
                        $eloquent->where('school_code_option_1', $params['school_code']);
                    }

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
    public function statistics_all_option2_students($params, $choose) {
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
                    if (!empty($params['school_code'])) {
                        $eloquent = $eloquent->where('school_code_option_2', $params['school_code']);
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

    public function statistics_all_option_students($params, $choose) {
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

                    $eloquent = $eloquent->where('school_code_option_1', $params['school_code']);


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

    public function statistics_all_option_all_students($params, $choose) {
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

                    $eloquent = self::orderBy('student_id', 'ASC');
                    $eloquent->whereIn('pexcel_id', $pexcel_ids);

                    //SELECT count(`student_id`) FROM `school_students` WHERE (`school_code_option` <> 9900 or isnull(school_code_option)) and school_code_option_1=9903

                    if (!empty($params['school_code'])) {


                        if (($params['school_code'] == 9900)or ( $params['school_code'] == 9901)) {



                            $eloquent->where('school_code_option', $params['school_code']);
                        } else {

                            //  ->whereIn('school_students.pexcel_id', $pexcel_ids);
                            $eloquent->where('school_code_option_1', $params['school_code'])
                                    ->where(function($q) {
                                        $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                    });
                        }
                    } else {

                        $eloquent->WhereNotNull('school_code_option_1')
                                ->where(function($q) {
                                    $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                                });
                    }

                    $students = $eloquent->count();


                    return $students;
                }
            }
        }
    }

    public function statistics_all_option1_students($params, $choose) {
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
                    if (!empty($params['school_code'])) {
                        $eloquent = $eloquent->where('school_code_option_1', $params['school_code']);
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

    public function statistics_all_students($params, $choose) {
        $students = NULL;
        $obj_pexcel = new Pexcel();
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_available_categories();

        if ($categories) {

            $category_ids = [];

            foreach ($categories as $category) {
                $category_ids[] = $category->pexcel_category_id;
            }

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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
                        if ($params['school_code_level'] <> 'NULL') {
                            $eloquent = $eloquent->where('school_code', $params['school_code_level']);
                        }
                    }

                    if (!empty($params['school_option123'])) {
                        if ($params['school_option123'] <> 'NULL') {

                            $eloquent = $eloquent->where('school_code_option_1', $params['school_option123']);
                        }
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

    public function statistics_all_all_students($params, $choose) {
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

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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

    public function school_option1_student_level_2($params) {


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
                            ->leftjoin('school_students', 'schools.school_code', '=', 'school_students.school_code')
                            ->where('schools.school_level_id', 2)
                            ->whereIn('school_students.pexcel_id', $pexcel_ids);

                    if (!empty($params['school_code'])) {
                        $eloquent->where('school_students.school_code_option_1', $params['school_code']);
                    }
                    $eloquent->groupBy('schools.school_code', 'schools.school_name');

                    // $eloquent = $eloquent->get();

                    return $eloquent->pluck('schools.school_name', 'schools.school_code');
                }
            }
        }
    }

    public function statistics_all_student_school_level_2($params) {


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

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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
                            ->select('schools.school_code as school_code', 'schools.school_name as school_name', 'schools.school_district_code as school_district_code', DB::raw('count(school_students.student_id) as countstudent'))
                            ->leftjoin('school_students', 'schools.school_code', '=', 'school_students.school_code')
                            ->where('schools.school_level_id', 2)
                            ->whereIn('school_students.pexcel_id', $pexcel_ids);
                    // if ($params['school_option123'] <> 'NULL') {
                    if ($params['districts_search'] <> 'NULL') {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }
                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_district_code');

                    $eloquent = $eloquent->get();
                    DB::table('school_student_level_2')->delete();
                    $obj_districts = new Districts();

                    $dt = new DateTime();
                    //,'updatetime'=>$dt->format('H:i:s d-m-Y')
                    foreach ($eloquent as $s) {

                        $add = $obj_districts->get_name_district($s->school_district_code);



                        DB::table('school_student_level_2')->insert([
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_name_district' => $add, 'school_index' => $s->countstudent, 'updatetime' => $dt->format('H:i:s d-m-Y')]);
                    }




                    return $eloquent;
                }
            }
        }
    }

    public function get_first_statistics_all_student_school_level_2() {
        $eloquent = NULL;
        $eloquent = DB::table('school_student_level_2')->get();
        return $eloquent;
    }

    public function get_first_statistics_all_student_school_level_3() {
        $eloquent = NULL;
        $eloquent = DB::table('school_student_option')->get();
        return $eloquent;
    }

    /*
     * @param type $params
     * @return type
     */

    public function statistics_all_student_school_option_1($params) {


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

    public function statistics_all_student_school_option_level_3($params) {


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
            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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
                            ->select('schools.school_name as school_name', DB::raw('count(school_students.student_id) as countstudent'))
                            ->leftjoin('school_students', 'schools.school_code', '=', 'school_students.school_code_option_1')
                            ->where('schools.school_level_id', 3)
                            ->whereIn('school_students.pexcel_id', $pexcel_ids);
                    $eloquent->where(function($q) {
                        $q->whereNotIn('school_students.school_code_option', [9900, 9901])->orWhereNull('school_students.school_code_option');
                    });


                    if (!empty($params['school_code_level'])) {
                        if ($params['school_code_level'] <> 'NULL') {
                            $eloquent->where('school_students.school_code', $params['school_code_level']);
                        }
                    }



                    if (!empty($params['districts_search'])) {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }

                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index');


                    return $eloquent->get();
                }
            }
        }
    }

    public function statistics_all_student_school_option($params) {


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
            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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
                            ->select('schools.school_name as school_name', DB::raw('count(school_students.student_id) as countstudent'))
                            ->leftjoin('school_students', 'schools.school_code', '=', 'school_students.school_code_option_1')
                            ->where('schools.school_level_id', 3)
                            ->whereIn('school_students.pexcel_id', $pexcel_ids);


                    if (!empty($params['school_code_level'])) {
                        if ($params['school_code_level'] <> 'NULL') {
                            $eloquent->where('school_students.school_code', $params['school_code_level']);
                        }
                    }



                    if (!empty($params['districts_search'])) {
                        $eloquent->where('schools.school_district_code', $params['districts_search']);
                    }

                    $eloquent->groupBy('schools.school_code', 'schools.school_name', 'schools.school_index');


                    return $eloquent->get();
                }
            }
        }
    }

    public function statistics_all_student_school_level_front_3() {
        $students = NULL;
        $students = DB::table('school_student_option')->get();
        return $students;
    }

    public function statistics_all_student_school_level_front_2() {


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
    public function statistics_all_specialist($params) {


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

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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

                    DB::table('school_code_specialist')->delete();


                    $dt = new DateTime();







                    $eloquent = DB::table('school_classes')
                            ->select('school_classes.school_class_code as school_class_code', 'school_classes.school_class_name as school_class_name', DB::raw('count(s1.student_id) as countstudent'))
                            ->leftjoin('school_students as s1', 'school_classes.school_class_code', '=', 's1.school_class_code')
                            ->where('s1.school_code_option', 9900)
                            ->whereIn('s1.pexcel_id', $pexcel_ids);
                    if (!empty($params['school_code_level'])) {
                        if ($params['school_code_level'] <> 'NULL') {
                            $eloquent->where('s1.school_code', $params['school_code_level']);
                        }
                    }

                    if (!empty($params['school_option123'])) {
                        if ($params['school_option123'] <> 'NULL') {

                            $eloquent->where('s1.school_code_option_1', $params['school_option123']);
                        }
                    }


                    $eloquent->groupBy('school_classes.school_class_code', 'school_classes.school_class_name');

                    //   var_dump($eloquent->count());die();
                    $students = $eloquent->get();


                    foreach ($students as $s) {

                        DB::table('school_code_specialist')->insert([
                            'school_class_code' => $s->school_class_code, 'school_class_name' => $s->school_class_name, 'school_class_count' => $s->countstudent]);
                    }



                    $students = DB::table('school_code_specialist')->get();

                    return $students;
                }
            }
        }
    }

    public function statistics_all_student_school_level_3($params) {


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

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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


                    $dt = new DateTime();


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
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_index_1' => $s->school_index, 'school_index_2' => $s->school_index2, 'school_option_1' => $s->countstudent, 'updatetime' => $dt->format('H:i:s d-m-Y')]);
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
                        //DB::table('school_student_option')->delete();
                        DB::table('school_student_option')->insert([
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_index_1' => $s->school_index, 'school_index_2' => $s->school_index2, 'school_option_1' => $s->countstudent, 'updatetime' => $dt->format('H:i:s d-m-Y')]);
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
                            'school_code' => $s->school_code, 'school_name' => $s->school_name, 'school_index_1' => $s->school_index, 'school_index_2' => $s->school_index2, 'school_option_1' => $s->countstudent, 'updatetime' => $dt->format('H:i:s d-m-Y')]);
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
            function update_student($input, $student_id = NULL) {


        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_pexcels_categories_action();
        // if ($categories->edit_level2 == 1) 

        if (empty($student_id)) {
            $student_id = $input['student_id'];
        }

        $student = self::find($student_id);


        if (!empty($student)) {

            if ($input['edit'] == 1) {

                $student->student_email = $input['student_email'];
                $student->student_phone = $input['student_phone'];
                $student->student_pass = $input['student_pass'];

                $student->save();

                $obj_user = new PndUser();
                $user = $obj_user->search_user(['user_name' => $input['student_user']]);
                if ($user) {
                    $obj_user->update_user_student($user, $input);
                } else {

                    $obj_user->create_student($input);
                }
            }

            if ($input['edit'] == 0) {

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
                $student->student_pass = $input['student_pass'];

                $student->save();

                $obj_user = new PndUser();
                $user = $obj_user->search_user(['user_name' => $input['student_user']]);
                if ($user) {
                    $obj_user->update_user_student($user, $input);
                } else {

                    $obj_user->create_student($input);
                }
            }

            return $student;
        } else {
            return NULL;
        }
    }

    public function user_update_student($input, $student_id = NULL) {

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
    public function user_update_student_k($input, $student_id = NULL) {

        if (empty($student_id)) {
            $student_id = $input['student_id'];
        }

        $input['student_user'] = $this->get_student_id($student_id)->student_user;

        $student = self::find($student_id);

        if (!empty($student)) {


            if ($input['school_aed'] == 0) {


                $student->student_email = $input['student_email'];
                $student->student_phone = $input['student_phone'];
                $student->student_pass = $input['student_pass'];
                $student->save();
                $obj_user = new PndUser();
                $user = $obj_user->search_user(['user_name' => $input['student_user']]);
                if ($user) {
                    $obj_user->update_user_student($user, $input);
                } else {

                    $obj_user->create_student($input);
                }
            }

            if ($input['school_aed'] == 2) {
                $student->student_aed = $input['student_aed'];

                $student->save();
            }

            if ($input['school_aed'] == 1) {

                $student->student_first_name = $input['student_first_name'];
                $student->student_last_name = $input['student_last_name'];
                $student->student_sex = $input['student_sex'];
                $student->student_birth_day = $input['student_birth_day'];
                $student->student_birth_month = $input['student_birth_month'];
                $student->student_birth_year = $input['student_birth_year'];

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
                $student->student_pass = $input['student_pass'];
                $student->save();

                $obj_user = new PndUser();
                $user = $obj_user->search_user(['user_name' => $input['student_user']]);

                if ($user) {
                    $obj_user->update_user_student($user, $input);
                } else {

                    $obj_user->create_student($input);
                }
            }

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
            function validRow($data) {
        $student = array();

        foreach ($this->fillable as $key) {
            $student[$key] = @$data[$key];
        }

        return $student;
    }

    public
            function createAccount($student) {

        $user_name = $this->generateAccount($student->school_code, $student->student_id);

        $student->student_user = $user_name;
        $student->student_pass = $user_name;

        $student->save();
    }

    public function add_student($input) {

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

    public function add_students($students, $pexcel_id) {

        foreach ($students as $student) {
            $this->add_student((array) $student, $pexcel_id);
        }
    }
    public function add_absent_students($input) {

        
        if (($input['school_code'] == 9900)or ($input['school_code'] == 9901)) {
            $eloquent = DB::table('school_students')
                    ->select('student_id', 'student_identifi', 'student_identifi_name', 'student_room', 'school_code_test')
                    ->where('school_code_option', $input['school_code'])
                    ->where('student_identifi_name', $input['student_identifi_name']);
            $eloquent = $eloquent->get();

            if (!empty($eloquent)) {
                if ($eloquent->student_id) {
                    DB::table('school_student_absent_rooms')->insert([
                        'school_code' => $input['school_code'], 'school_code_test' => $eloquent->school_code_test, 'school_room' => $eloquent->student_room, 'student_id' => $eloquent->student_id, 'student_identifi' => $eloquent->student_identifi, 'student_identifi_name' => $eloquent->student_identifi_name, 'school_subject_code' => $params['school_subject_code'], 'school_subject_name' => $params['school_subject_name']]);
                }
            }
        } else {

            $eloquent = DB::table('school_students')
                    ->select('student_id', 'student_identifi', 'student_identifi_name', 'student_room', 'school_code_test', 'student_first_name', 'student_last_name', 'student_birth_day', 'student_birth_month', 'student_birth_year')
                    ->where('student_identifi_name', $input['student_identifi_name']);
            $eloquent->where('school_code_option_1', $input['school_code'])
                    ->where(function($q) {
                        $q->whereNotIn('school_code_option', [9900, 9901])->orWhereNull('school_code_option');
                    });
            $eloquent = $eloquent->get()->first();



            if (!empty($eloquent)) {


                $eloquent1 = DB::table('school_student_absent_rooms')
                                ->select('student_id')
                                ->where('student_identifi_name', $input['student_identifi_name'])->where('school_subject_code', $input['school_subject_code'])->where('school_code', $input['school_code']);
                $eloquent1 = $eloquent1->get()->first();

                if (empty($eloquent1)) {

                    DB::table('school_student_absent_rooms')->insert([
                        'school_code' => $input['school_code'], 'school_code_test' => $eloquent->school_code_test, 'school_room' => $eloquent->student_room, 'student_id' => $eloquent->student_id, 'student_identifi' => $eloquent->student_identifi, 'student_identifi_name' => $eloquent->student_identifi_name, 'school_subject_code' => $input['school_subject_code'], 'school_subject_name' => $input['school_subject_name'], 'student_first_name' => $eloquent->student_first_name, 'student_last_name' => $eloquent->student_last_name, 'student_birth_day' => $eloquent->student_birth_day, 'student_birth_month' => $eloquent->student_birth_month, 'student_birth_year' => $eloquent->student_birth_year]);
                }
            }
        }
    }
    public function update_pexcel_students($students, $p_option) {

       
        
        foreach ($students as $student) {
            
           $school = self::where('student_identifi_name',$student->student_identifi_name )->where('student_room',$student->student_room )->where('school_code_option_1',$p_option )
                ->update(['student_score_prior' => $student->student_score_prior,'student_score_prior_comment' => $student->student_score_prior_comment]);
            
            
        }
    }

      
    
    public function delete_student($student_id) {
        $eloquent = null;
        $obj_pexcel_category = new PexcelCategories();
        $categories = $obj_pexcel_category->get_pexcels_categories_action();

        if ($categories->delete_level2 == 0) {

            $eloquent = self::where('student_id', $student_id)->delete();
        }
        return $eloquent;
    }

    public
            function generateAccount($school_id, $student_id) {

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
            function get_student($params = []) {

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

    public function get_student_id($id) {
        $eloquent = self::where('student_id', $id)->first();
        return $eloquent;
    }

    function get_student_option($params) {
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

    function get_student_option_specialist($params) {
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

            if ($params['this']->is_admin || $params['this']->is_all || $params['this']->is_level_3 || $params['this']->is_viewer) {//user is admin
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
                                    ->select('school_code_option as school_code', 'school_code_option as school_name')
                                    ->whereIn('pexcel_id', $pexcel_ids)
                                    ->groupBy('school_code_option')->get();
                    $students = $eloquent->pluck('school_code', 'school_name');





                    //$eloquent = self::orderBy('school_code_option_2', 'ASC')
                    //      ->whereIn('pexcel_id', $pexcel_ids)
                    //    ->groupBy('school_code_option_1') ;
                    //$students = $eloquent->get();


                    return $students;
                }
            }
        }
    }

    function get_student_option_2($params) {
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

    function get_option1_student_level_2($params) {

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
                            ->where('school_code_option_1', $params['school_code'])
                            ->whereIn('pexcel_id', $pexcel_ids);

                    $students = $eloquent->get();

                    return $students->pluck('school_code');
                }
            }
        }
    }

    function get_option2_student_level_2($params) {

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

                    if (!empty($params['school_code'])) {
                        $eloquent = self::orderBy('student_last_name', 'ASC')
                                ->where('school_code_option_2', $params['school_code'])
                                ->whereIn('pexcel_id', $pexcel_ids);
                    } else {
                        $eloquent = self::orderBy('student_last_name', 'ASC')
                                ->whereIn('pexcel_id', $pexcel_ids);
                    }



                    $students = $eloquent->get();

                    return $students->pluck('school_code');
                }
            }
        }
    }

    function get_option_student_level_2($params) {

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

                    if (($params['school_code'] == 9900) or ( $params['school_code'] == 9901)) {
                        $eloquent = self::orderBy('student_last_name', 'ASC')
                                ->where('school_code_option', $params['school_code'])
                                ->whereIn('pexcel_id', $pexcel_ids);
                    } else {

                        $eloquent = self::orderBy('student_last_name', 'ASC')
                                ->where('school_code_option_1', $params['school_code'])
                                ->whereIn('pexcel_id', $pexcel_ids);
                    }



                    $students = $eloquent->get();

                    return $students->pluck('school_code');
                }
            }
        }
    }

    function get_option2_student_option_2($params) {

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
                            ->where('school_code_option_2', $params['school_code'])
                            ->whereIn('pexcel_id', $pexcel_ids);

                    $students = $eloquent->get();

                    return $students->pluck('school_code_option_1');
                }
            }
        }
    }

    function get_option1_student_option_2($params) {

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
                            ->where('school_code_option_1', $params['school_code'])
                            ->whereIn('pexcel_id', $pexcel_ids);

                    $students = $eloquent->get();

                    return $students->pluck('school_code_option_2');
                }
            }
        }
    }

    public function deleteStudentsByPexcelId($pexcel_id) {

        $obj_user = new PndUser();
        //Delete in user table

        $students = self::where('pexcel_id', $pexcel_id)->get();

        if (!empty($students)) {
            foreach ($students as $student) {
                $user = $obj_user->delete_user(array('user_name' => $student['student_user']));
            }
        }
    }

    public function pluck_select_class($params = array()) {

        $eloquent = self::orderBy('student_class', 'ASC');


        if (!empty($params['school_code'])) {
            $eloquent = $eloquent->where('school_code', $params['school_code']);
        }

        $eloquent = $eloquent->groupBy('student_class');

        return $eloquent->pluck('student_class', 'student_class');
    }

    public function delete_pexcel_id_recybin($params) {


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

    public function update_student_permision($input) {

        $school = self::where('student_id', '<>', 0)
                ->update(['school_aed' => $input['add_levelstd']]);
    }

}
