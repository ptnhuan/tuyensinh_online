<?php namespace Foostart\Post\Validators;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

use Illuminate\Support\MessageBag as MessageBag;

class PostAdminValidator extends AbstractValidator
{
    protected static $rules = array(
        'post_name' => 'required',
        'post_description' => 'required',
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

        $flag = $this->isValidTitle($input)?$flag:FALSE;
        $flag = $this->isValidOverview($input)?$flag:FALSE;
        $flag = $this->isValidDescription($input)?$flag:FALSE;

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
            'post_name.required' => 'Yêu cầu nhập tiêu đề.',
            'post_description.required' => 'Yêu cầu nhập nội dung bài viết.',
        ];
    }

    public function isValidTitle($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_name_min');
        $max_lenght = config('buoumau.length_name_max');

        $post_name = @$input['post_name'];

        if ((strlen($post_name) < $min_lenght)  || ((strlen($post_name) > $max_lenght))) {
            $this->errors->add('length_name', trans('post::post_admin.length_name', ['LENGTH_NAME_MIN' => $min_lenght, 'LENGTH_NAME_MAX' => $max_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }

    public function isValidOverview($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_overview_min') + 7;
        $max_lenght = config('buoumau.length_overview_max');

        $post_overiew = @$input['post_overview'];

        if ((strlen($post_overiew) < $min_lenght)  || ((strlen($post_overiew) > $max_lenght))) {
            $this->errors->add('length_overview', trans('post::post_admin.length_overview', ['LENGTH_OVERVIEW_MIN' => 10, 'LENGTH_OVERVIEW_MAX' => $max_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }

     public function isValidDescription($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_description_min');

        $post_overiew = @$input['post_description'];

        if (strlen($post_overiew) < $min_lenght) {
            $this->errors->add('length_description', trans('post::post_admin.length_description', ['LENGTH_DESCRIPTION_MIN' => $min_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }
}