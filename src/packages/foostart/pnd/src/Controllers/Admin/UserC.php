<?php namespace Foostart\Pnd\Controllers\Admin;

use LaravelAcl\Authentication\Controllers\UserController;

class UserC extends UserController {

  
    public function create_user($user) {
        $id = null;
        var_dump($user);
        die();
        DbHelper::startTransaction();
        try
        {
            $user = $this->f->process($user);
            $this->profile_repository->attachEmptyProfile($user);
        } catch(JacopoExceptionsInterface $e)
        {
            DbHelper::rollback();
            $errors = $this->f->getErrors();
            // passing the id incase fails editing an already existing item
            return Redirect::route("users.edit", $id ? ["id" => $id] : [])->withInput()->withErrors($errors);
        }

        DbHelper::commit();
    }
}