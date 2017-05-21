<?php

namespace Foostart\Pnd\Validators;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Illuminate\Support\MessageBag as MessageBag;

class PndUserValidator extends AbstractValidator {

    protected static $rules = array(
        'student_first_name' => 'required',
        'student_last_name' => 'required',
        'student_sex' => 'required',
        'student_birth_day' => 'required',
        'student_birth_month' => 'required',
        'student_birth_year' => 'required',
        'student_birth_place' => 'required',
        'school_code' => 'required',
        'school_district_code' => 'required',
        'student_class' => 'required',
        'student_capacity_6' => 'required',
        'student_conduct_6' => 'required',
        'student_capacity_7' => 'required',
        'student_conduct_7' => 'required',
        'student_capacity_8' => 'required',
        'student_conduct_8' => 'required',
        'student_capacity_9' => 'required',
        'student_conduct_9' => 'required',
        'student_average' => 'required',
        'student_average_1' => 'required',
        'student_average_2' => 'required',
        'student_graduate' => 'required',
        'student_score_prior' => 'required',
        'student_score_prior_comment' => 'required',
  
        'school_code_option_1' => 'required',
       
        'student_pass' => 'required',
    );
    protected static $messages = [];

    public function __construct() {
        Event::listen('validating', function($input) {
            
        });
        $this->messages();
    }

    public function adminValidate($input) {

        $flag = parent::validate($input);

        $this->errors = $this->errors ? $this->errors : new MessageBag();

//        $flag = $this->isValidTitle($input)?$flag:FALSE;
//        $flag = $this->isValidDescription($input)?$flag:FALSE;

        return $flag;
    }

    public function userValidate($input) {

        $flag = parent::validate($input);

        $this->errors = $this->errors ? $this->errors : new MessageBag();

        $flag = $this->isValidTitle($input) ? $flag : FALSE;
        $flag = $this->isValidDescription($input) ? $flag : FALSE;

        return $flag;
    }

    public function apiUserValidate($input) {

        $flag = $this->userValidate($input);

        $this->errors = $this->errors ? $this->errors : new MessageBag();

        if (empty($input['user_id'])) {
            $this->errors->add('user_id', 'Yêu cầu nhập mã học sinh');
            $flag = FALSE;
        }

        return $flag;
    }

    public function messages() {
        self::$messages = [
            'student_first_name.required' => 'Yêu cầu nhập họ học sinh.',
            'student_last_name.required' => 'Nhập tên học sinh .',
            'student_sex.required' => 'Nhập giới tính .',
            'student_birth_day.required' => 'Nhập ngày sinh .',
            'student_birth_month.required' => 'Nhập tháng sinh .',
            'student_birth_year.required' => 'Nhập năm sinh .',
            'student_birth_place.required' => 'Nhập nơi sinh .',
            'school_code.required' => 'Chọn trường học THCS .',
            'school_district_code.required' => 'Chọn huyện .',
            'student_class.required' => 'Nhập lớp .',
            'student_capacity_6.required' => ' Chọn Học lực Lớp 6  .',
            'student_conduct_6.required' => ' Chọn Hạnh kiểm Lớp 6 .',
            'student_capacity_7.required' => ' Chọn Học lực Lớp 7.',
            'student_conduct_7.required' => ' Chọn Hạnh kiểm Lớp 7.',
            'student_capacity_8.required' => 'Chọn Học lực Lớp 8  .',
            'student_conduct_8.required' => 'Chọn Hạnh kiểm Lớp 8 .',
            'student_capacity_9.required' => 'Chọn Học lực Lớp 9  .',
            'student_conduct_9.required' => 'Chọn Hạnh kiểm Lớp 9 .',
            'student_average.required' => ' Nhập điểm TB Lớp 9 .',
            'student_average_1.required' => ' Nhập điểm TB Môn Toán .',
            'student_average_2.required' => ' Nhập điểm TB Môn Văn.',
            'student_graduate.required' => ' Chọn loại Tốt nghiệp .',
            'student_score_prior.required' => ' Nhập điểm Ưu tiên-khuyến khích .',
            'student_score_prior_comment.required' => 'Nhập ghi chú Ưu tiên-khuyến khích.',           
            'school_code_option_1.required' => ' Chọn trường THPT Nguyện vọng 1 .',
            'student_pass.required' => 'Nhập mật khẩu đăng nhập .',
        ];
    }

    public function isValidTitle($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_name_min');
        $max_lenght = config('buoumau.length_name_max');

        $pnd_name = @$input['pnd_name'];

        if ((strlen($pnd_name) < $min_lenght) || ((strlen($pnd_name) > $max_lenght))) {
            $this->errors->add('length_name', trans('pnd::pnd.length_name', ['LENGTH_NAME_MIN' => $min_lenght, 'LENGTH_NAME_MAX' => $max_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }

    public function isValidOverview($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_overview_min') + 7;
        $max_lenght = config('buoumau.length_overview_max');

        $pnd_overiew = @$input['pnd_overview'];

        if ((strlen($pnd_overiew) < $min_lenght) || ((strlen($pnd_overiew) > $max_lenght))) {
            $this->errors->add('length_overview', trans('pnd::pnd.length_overview', ['LENGTH_OVERVIEW_MIN' => 10, 'LENGTH_OVERVIEW_MAX' => $max_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }

    public function isValidDescription($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_description_min');

        $pnd_overiew = @$input['pnd_description'];

        if (strlen($pnd_overiew) < $min_lenght) {
            $this->errors->add('length_description', trans('pnd::pnd.length_description', ['LENGTH_DESCRIPTION_MIN' => $min_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }

}
