<?php namespace Foostart\Pnd\Models;

use Illuminate\Support\Facades\Hash;

use LaravelAcl\Authentication\Models\User as AclUser;
use LaravelAcl\Authentication\Models\UserProfile as AclUserProfile;

class PndUser extends AclUser {

    public function create_student($student) {

        $user = [
            'email' => $student['student_user'].'@py.edu.vn',
            'user_name' => $student['student_user'],
            'password'=> $student['student_user'],
            'activated' => 1,
            'banned' => 0,
            'permissions' => ['_student' => 1],
        ];
        $user = self::create($user);
        $obj_profile = new UserProfile();
        $obj_profile->create_student_profile($user, $student);
        return $user;
    }


    public function update_user($user, $teacher) {
         switch ($teacher->school_level_id) {
            case 2:
                $user->permissions = ['_mod-2' => 1];
                break;
            case 3:
                 $user->permissions = ['_mod-3' => 1];
        }
        $user->email = $teacher->school_email;
        $user->user_name = $teacher->user_id;
        $user->password = $teacher->pass_id;
        $user->save();
        return $user;

    }
     public function create_user($teacher) {

        $user = [
            'email' => $teacher->school_email,
            'user_name' => $teacher->user_id,
            'password'=> $teacher->pass_id,
            'activated' => 1,
            'banned' => 0,
            'permissions' => '{"_mod-2":1}',
        ];
        switch ($teacher['school_level_id']) {
            case 2:
                $user['permissions'] = '{"_mod-2":1}';
                break;
            case 3:
                 $user['permissions'] = '{"_mod-3":1}';
        }
        $user = self::create($user);

        $obj_profile = new UserProfile();
        $obj_profile->create_user_profile($user, $teacher);
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
            $user = self::where('user_name', $params['user_name'])->first();
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

     public function create_user_profile($user, $info) {
        $user_profile = [
            'user_id' => $user->id,
            'first_name' => $info->school_contact,
        ];
        $user = self::create($user_profile);
        return $user;
    }
}