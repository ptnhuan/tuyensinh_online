<?php
namespace Foostart\Pnd\Validators;

use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;

use Illuminate\Support\MessageBag as MessageBag;

class PndCategoryAdminValidator extends AbstractValidator
{
    protected static $rules = array(
        'pnd_category_name' => 'required',
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
            'pnd_category_name.required' => 'Yêu cầu nhập tên danh mục.'
        ];
    }

    public function isValidName($input) {

        $flag = TRUE;

        $min_lenght = config('pnd.length_category_name_min');
        $max_lenght = config('pnd.length_category_name_max');

        $pnd_category_name = @$input['pnd_category_name'];


        if ((strlen($pnd_category_name) < $min_lenght)  || ((strlen($pnd_category_name) > $max_lenght))) {
            $this->errors->add('length_category_name', trans('pnd::pnd.length_category_name', ['LENGTH_CATEGORY_NAME_MIN' => $min_lenght, 'LENGTH_CATEGORY_NAME_MAX' => $max_lenght]));
            $flag = FALSE;
        }

        return $flag;
    }
}
