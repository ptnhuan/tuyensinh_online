<?php namespace Foostart\Pnd\Models;

use Illuminate\Support\Facades\Hash;

use LaravelAcl\Authentication\Models\User as AclUser;
use LaravelAcl\Authentication\Models\UserProfile as AclUserProfile;

class User extends AclUser {

    public function create_student($student) {

        $user = self::create([
            'email' => $student['student_user'].'@py.edu.vn',
            'user_name' => $student['student_user'],
            'password'=> Hash::make($student['student_pass']),
            'activated' => 1,
            'banned' => 0,

        ]);
        return $user;
    }

    public function create_students($students){
        foreach ($students as $student) {
            $this->create_student($student->toArray());
        }
    }

}
class UserProfile extends AclUserProfile {

}