<?php

namespace Foostart\Pexcel\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Pexcel\Models\Pexcel;

class PexcelFrontController extends Controller
{
    public $data = array();
    public function __construct() {

    }

    public function index(Request $request)
    {

        $obj_post = new Pexcels();
        $posts = $obj_post->get_posts();
        $this->data = array(
            'request' => $request,
            'posts' => $posts
        );
        return view('post::post.index', $this->data);
    }

}