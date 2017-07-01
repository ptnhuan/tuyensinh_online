<?php namespace Foostart\Pnd\Validators;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

use Illuminate\Support\MessageBag as MessageBag;

class PndSchoolTestAdminValidator extends AbstractValidator
{
    protected static $rules = array(
        'school_code' => 'required',
        'school_test_code' => 'required',
       'school_test_name'=> 'required',
        'school_test_name_title' => 'required',
        'school_test_address' => 'required',
        'school_test_phone' => 'required',
        'school_test_phone_chutich' => 'required',
        'school_test_email_chutich' => 'required',
         'school_test_phone_thuky' => 'required',
        'school_test_thuky' => 'required',  
        'school_test_chutich' => 'required',
        'school_test_thuky' => 'required'    
                    
       
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
           
            
         'school_code.required' => 'Mã hội đồng tuyển sinh ',
        'school_test_code.required' => 'Mã hội đồng coi thi',
         'school_test_name.required' => 'Tên  trường HĐCT',
        'school_test_name_title.required' => 'Tên viết tắt trường HĐCT',
        'school_test_address.required' => 'Địa chỉ',
        'school_test_phone.required' => 'Điện thoại',
        'school_test_phone_chutich.required' => 'Điện thoại chủ tịch',
        'school_test_email_chutich.required' => 'Email chủ tịch',
         'school_test_phone_thuky.required' => 'Điện thoại thư ký',
        'school_test_thuky.required' => 'Tên thư ký',  
        'school_test_chutich.required' => 'Tên chủ tịch',
        
                    
            
       
            
            
            
            
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
