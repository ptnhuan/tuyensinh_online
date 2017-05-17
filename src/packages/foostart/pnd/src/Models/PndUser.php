<?php namespace Foostart\Pnd\Models;

use Illuminate\Support\Facades\Hash;

use LaravelAcl\Authentication\Models\User as AclUser;
use LaravelAcl\Authentication\Models\UserProfile as AclUserProfile;

class PndUser extends AclUser {

    public function create_user($student) {

        $user = [
            'email' => $student['student_user'].'@py.edu.vn',
            'user_name' => $student['student_user'],
            'password'=> $student['student_user'],
            'activated' => 1,
            'banned' => 0,

        ];
        $user = self::create($user);

        $obj_profile = new UserProfile();
        $obj_profile->create_student_profile($user, $student);
        return $user;
    }

    public function create_students($students){
        foreach ($students as $student) {
            $this->create_student($student->toArray());
        }
    }

    public function search_user($params){
        $user = NULL;
        if (!empty($params['user_name'])) {
            $user = self::where('user_name', $user_name)->first();
        }
        return $user;
    }

}
class UserProfile extends AclUserProfile {

    public function create_student_profile($user, $student) {
        $student_profile = [
            'user_id' => $user->id,
            'first_name' => $student['student_first_name'],
            'last_name' => $student['student_last_name'],
        ];
        $user = self::create($student_profile);
        return $user;
    }
}