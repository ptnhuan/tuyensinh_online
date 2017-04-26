<?php namespace Foostart\Phpexcel\Controllers\Admin;

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

}