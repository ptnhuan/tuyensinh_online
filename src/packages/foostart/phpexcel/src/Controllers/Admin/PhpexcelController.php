<?php

namespace Foostart\Phpexcel\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;

/**
 * Validators
 */
class PhpexcelController extends Controller {

    public $data = array();
    private $obj_validator = NULL;

    public function __construct() {

    }

    public function addFlashMessage($message_key, $message_value) {
        \Session::flash($message_key, $message_value);
    }

    public function invalidKey() {
        $data = ['error' => [
                'message' => trans('api::api_admin.errors.111'),
                'code' => 111,
                'type' => 'vailidRequest'
        ]];

        return $data;
    }

    public function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    public function getOverview($string) {

        $index = config('buoumau.length_overview_max');

        while (isset($string[$index]) && strcmp($string[$index], ' ') != 0) {
            $index++;
        }

        $overview = substr($string, 0, $index) . '...';

        return $overview;
    }

}
