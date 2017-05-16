<?php namespace Foostart\Pexcel\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use URL,
    Route,
    Redirect;

class PexcelController extends Controller {

    public $data = array();
    public $authentication = NULL;
    public $is_members = FALSE;
    public $current_user = NULL;

    public $is_admin = FALSE;
    public $is_all = FALSE;
    public $is_my = FALSE;


    public function isAuthentication() {

        $this->authentication = \App::make('authenticator');
        $this->current_user = $this->authentication->getLoggedUser();
        if ($this->current_user) {
            $this->is_members = TRUE;

            $auth_helper = \App::make('authentication_helper');

            if ($auth_helper->hasPermission(array('_superadmin'))) {
                $this->is_admin = TRUE;
            }

            if ($auth_helper->hasPermission(array('_all-pexcel'))) {
                $this->is_all = TRUE;
            }

            if ($auth_helper->hasPermission(array('_my-pexcel'))) {
                $this->is_my = TRUE;
            }
        }
        $this->data = array(
            'is_members' => $this->is_members,
            'is_admin' => $this->is_admin,
            'current_user' => $this->current_user,
        );
    }

    public function addFlashMessage($message_key, $message_value) {
        \Session::flash($message_key, $message_value);
    }
}