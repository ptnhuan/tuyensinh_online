<?php

namespace Foostart\Phpexcel\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Phpexcel\Models\phpexcels;

class PhpexcelGuestController extends Controller
{
    public $data = array();
    public function __construct() {

    }

    public function index(Request $request)
    {

        $obj_phpexcel = new phpexcels();
        $phpexcels = $obj_phpexcel->get_phpexcels();
        $this->data = array(
            'request' => $request,
            'phpexcels' => $phpexcels
        );

        return view('phpexcel::phpexcel.index', $this->data);
    }

}