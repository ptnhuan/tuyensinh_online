<?php namespace Foostart\Pnd\Validators;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

use Illuminate\Support\MessageBag as MessageBag;

class PndSchoolAdminValidator extends AbstractValidator
{
    protected static $rules = array(
        'school_code' => 'required',
        'school_name' => 'required',
        'school_address' => 'required',
        'school_phone' => 'required',
        'school_email' => 'required',
        'school_contact' => 'required',
        'school_district_code' => 'required',
        'school_level_id' => 'required',
        'user_id' => 'required',
        'pass_id' => 'required'    
                
               
    );

    protected static $messages = [];


    public function __construct()
    {
        Event::listen('validating', function($input)
        {
        });
        $this->messages();
    }

    public function adminValidate($input) {

        $flag = parent::validate($input);

        $this->errors = $this->errors?$this->errors:new MessageBag();

//        $flag = $this->isValidTitle($input)?$flag:FALSE;
//        $flag = $this->isValidDescription($input)?$flag:FALSE;

        return $flag;
    }

    public function userValidate($input) {

        $flag = parent::validate($input);

        $this->errors = $this->errors?$this->errors:new MessageBag();

        $flag = $this->isValidTitle($input)?$flag:FALSE;
        $flag = $this->isValidDescription($input)?$flag:FALSE;

        return $flag;
    }

    public function apiUserValidate($input) {

        $flag = $this->userValidate($input);

        $this->errors = $this->errors?$this->errors:new MessageBag();

        if (empty($input['user_id'])) {
            $this->errors->add('user_id', 'Yêu cầu nhập mã thành viên');
            $flag = FALSE;
        }

        return $flag;
    }

    public function messages() {
        self::$messages = [
            'school_first_name.required' => 'Yêu cầu nhập họ học viên.',
            'school_last_name.required' => 'Yêu cầu nhập tên học viên.',
            'school_email.required' => 'Yêu cầu nhâp email học viên.',
            
            
             'school_code.required' => 'Nhập mã trường',
        'school_name.required' => 'Nhập tên trường',
        'school_address.required' => 'Nhâp địa chỉ',
        'school_phone.required' => 'Nhập điện thoại',
        'school_email.required' => 'Nhập thư điện tử',
        'school_contact.required' => 'Nhập người Liên hệ',
        'school_district_code.required' => 'Nhập huyện',
        'school_level_id.required' => 'Cấp học',
        'user_id.required' => 'Nhập tên đăng nhập',
        'pass_id.required' => 'Nhập mật khẩu'    
            
            
            
            
            
        ];
    }

    public function isValidTitle($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_name_min');
        $max_lenght = config('buoumau.length_name_max');

        $pnd_name = @$input['pnd_name'];

        if ((strlen($pnd_name) < $min_lenght)  || ((strlen($pnd_name) > $max_lenght))) {
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

        if ((strlen($pnd_overiew) < $min_lenght)  || ((strlen($pnd_overiew) > $max_lenght))) {
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
