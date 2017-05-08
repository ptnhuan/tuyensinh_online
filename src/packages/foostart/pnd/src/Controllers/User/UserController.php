<?php

namespace Foostart\Pexcel\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use URL,
    Route,
    Redirect;

class UserController extends Controller {

    public $data = array();
    public $authentication = NULL;
    public $is_members = FALSE;
    public $current_user = NULL;
    public $is_admin = FALSE;

    public function isAuthentication() {

        $this->authentication = \App::make('authenticator');

        $this->current_user = $this->authentication->getLoggedUser();

        if ($this->current_user) {
            $this->is_members = TRUE;

            $auth_helper = \App::make('authentication_helper');

            if ($auth_helper->hasPermission(array('_superadmin'))) {
                $this->is_admin = TRUE;
            }
        }

        $this->data = array(
            'is_members' => $this->is_members,
            'current_user' => $this->current_user,
        );
    }

    public function addFlashMessage($message_key, $message_value) {
        \Session::flash($message_key, $message_value);
    }

}
