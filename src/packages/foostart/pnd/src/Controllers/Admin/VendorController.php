<?php

namespace Foostart\Pnd\Controllers\Admin;

use Illuminate\Http\Request;
use LaravelAcl\Authentication\Controllers\AuthController;
use URL;
use Route,
    Redirect;

/**
 * Models
 */
class VendorController extends AuthController {

    public function postAdminLogin(Request $request) {
        $login_attribute = config('acl_sentry.users.login_attribute');
        list($user_name, $password, $remember) = $this->getLoginInput($request);

        try {
            $this->authenticator->authenticate(array(
                $login_attribute => $user_name,
                "password" => $password
                    ), $remember);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->authenticator->getErrors();
            return redirect()->route("user.admin.login")->withInput()->withErrors($errors);
        }

        return Redirect::to(Config::get('acl_base.admin_login_redirect_url'));
    }

    public function postClientLogin(Request $request) {
        $login_attribute = config('acl_sentry.users.login_attribute');
        list($user_name, $password, $remember) = $this->getLoginInput($request);

        try {
            $this->authenticator->authenticate(array(
                $login_attribute => $user_name,
                "password" => $password
                    ), $remember);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->authenticator->getErrors();
            return redirect()->route("user.login")->withInput()->withErrors($errors);
        }

        return Redirect::to(Config::get('acl_base.user_login_redirect_url'));
    }

}
