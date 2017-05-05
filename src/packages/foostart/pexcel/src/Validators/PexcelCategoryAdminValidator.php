<?php
namespace Foostart\Post\Validators;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

use Illuminate\Support\MessageBag as MessageBag;

class PostCategoryAdminValidator extends AbstractValidator
{
    protected static $rules = array(
        'post_category_name' => 'required',
    );

    protected static $messages = [];


    public function __construct()
    {
        Event::listen('validating', function($input)
        {
        });
        $this->messages();
    }

    public function validate($input) {

        $flag = parent::validate($input);

        $this->errors = $this->errors?$this->errors:new MessageBag();

        $flag = $this->isValidName($input)?$flag:FALSE;
        return $flag;
    }


    public function messages() {
        self::$messages = [
            'post_category_name.required' => 'Yêu cầu nhập tên danh mục.'
        ];
    }

    public function isValidName($input) {

        $flag = TRUE;

        $min_lenght = config('buoumau.length_category_name_min');
        $max_lenght = config('buoumau.length_category_name_max');

        $post_category_name = @$input['post_category_name'];


        if ((strlen($post_category_name) < $min_lenght)  || ((strlen($post_category_name) > $max_lenght))) {
            $this->errors->add('length_category_name', trans('post::post_admin.length_category_name', ['LENGTH_CATEGORY_NAME_MIN' => $min_lenght, 'LENGTH_CATEGORY_NAME_MAX' => $max_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }
}