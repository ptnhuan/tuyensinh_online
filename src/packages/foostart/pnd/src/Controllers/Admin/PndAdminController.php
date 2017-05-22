<?php

namespace Foostart\Pnd\Controllers\Admin;

use Foostart\Pexcel\Helper\Parse;
use Illuminate\Http\Request;
use Foostart\Pnd\Controllers\Admin\PndController;
use URL;
use Route,
    Redirect;
/**
 * Models
 */
use Foostart\Pnd\Models\Students;
use Foostart\Pnd\Models\Schools;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\Specialists;
use Foostart\Pnd\Models\PndUser;
use Foostart\Pexcel\Models\Pexcel;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndAdminValidator;

class PndAdminController extends PndController {

    private $obj_students = NULL;
    private $obj_schools = NULL;
    private $obj_categories = NULL;
    private $obj_validator = NULL;
    private $obj_districts = null;
    private $obj_specialists = null;
    private $obj_pexcel = NULL;

    public function __construct() {

        $this->obj_students = new Students();
        $this->obj_schools = new Schools();
        $this->obj_categories = new PexcelCategories();
        $this->obj_districts = new Districts();
        $this->obj_specialists = new Specialists();

        $this->obj_pexcel = new Pexcel();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $this->isAuthentication();

        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;
        /**
         * EXPORT TO FILE EXCEL
         */
        // kiem tra them xoa sua 
        $addeditde = 0;

        if ( $params['user_name'] <> 'admin') {
            $addeditde = $this->obj_schools->get_school_by_user($params)->school_aed;
        }
        
        
        if (isset($params['export'])) {

            $students = $this->obj_students->get_all_students($params);
            $obj_parse = new Parse();
            $obj_parse->export_data_students($students, $this->obj_schools->get_school_by_user($params)->school_name);

            unset($params['export']);
        }
        /**
         * IMPORT FROM PEXCEL TO STUDENTS
         */
        if (!empty($params['id'])) {
            $pexcel = $this->obj_pexcel->find($params['id']);

            if ($pexcel && ($this->is_admin || ($pexcel->user_id == $this->current_user->id))) {

                $pexcel_status = config('pexcel.status');

                if ($pexcel->pexcel_status == $pexcel_status['new']) {

                    $students = (array) json_decode($pexcel->pexcel_value);

                    $pexcel->pexcel_status = $pexcel_status['confirmed'];
                    $pexcel->save();
                    $this->obj_students->add_students($students, $pexcel->pexcel_id);

                    $user = new PndUser();
                    $students = $this->obj_students->get_students($params);

                    $user->create_students($students);
                }
            }
        } else {
            $school = $this->obj_schools->get_school_by_user($params);
            if (!empty($school)) {
                $params['school_code'] = $school->school_code;
                $params['school_id'] = $school->school_id;
            }

            $students = $this->obj_students->get_all_students($params);
        }
        //END PEXCEL
        $pexcels = $this->obj_students->sendPexcels();

        $categories = $this->obj_categories->pluckSelect(@$params['pexcel_category_id']);

        $this->data = array_merge($this->data, array(
            'students' => !empty($students) ? $students : '',
            'categories' => $categories,
            'addeditde' => $addeditde,
            'request' => $request,
            'params' => $params,
            'pexcels' => array('0' => '...') + $pexcels->toArray(),
        ));
        return view('pnd::admin.pnd_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {
        $this->isAuthentication();
        $student = NULL;
        $specialists = NULL;
        $school_levels_3 = NULL;
        $school_levels_specialist = NULL;
        $districts = NULL;

        $params = $request->all();

        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;


        $specialists = $this->obj_specialists->pluck_select();

        $specialists = (object) array_merge(['NULL' => '...'], $specialists->toArray());


        $school_levels_3 = $this->obj_schools->pluck_select(['school_level_id' => 3]);
        $school_levels_3 = array('NULL' => '...') + $school_levels_3->toArray();


        $school_levels_specialist = $this->obj_schools->pluck_select(['school_level_id' => 3, 'school_choose_specialist' => 1]);
        $school_levels_specialist = array('NULL' => '...') + $school_levels_specialist->toArray();


        $districts = $this->obj_districts->pluck_select();

        //PEXCEL
        if (!empty($params['id'])) {

            $student = $this->obj_students->find($params['id']);

            if ($student) {
                $pexcel = $this->obj_pexcel->find($student->pexcel_id);


                if (empty($pexcel) || ($this->is_admin || ($pexcel->user_id == $this->current_user->id) || ($student->student_user == $this->current_user->user_name && $student->pexcel_id == $pexcel->pexcel_id))
                ) {
                    
                } elseif ($this->is_level_3) {// kiểm tra nguyện vọng 1 của học sinh có nằm trong danh sách trường hiện tại hay k
                    $school = $this->obj_schools->get_school_by_user($params);

                    if (empty($school) || $student->school_code_option_1 != $school->school_code) {
                        return;
                    }
                } else {
                    return;
                }
            }
        }
        $pexcels = $this->obj_students->sendPexcels();
        $this->data = array_merge($this->data, array(
            'student' => $student,
            'specialists' => $specialists,
            'school_levels_3' => $school_levels_3,
            'school_levels_specialist' => $school_levels_specialist,
            'districts' => $districts,
            'request' => $request,
            'pexcels' => $pexcels,
        ));

        return view('pnd::admin.pnd_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PndAdminValidator();

        $input = $request->all();

        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['this'] = $this;

        $student_id = (int) $request->get('id');

        $student = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($student_id) && is_int($student_id)) {
                $student = $this->obj_students->find($student_id);
            }
        } else {
            if (!empty($student_id) && is_int($student_id)) {

                $student = $this->obj_students->find($student_id);

                if (!empty($student)) {

                    $input['student_id'] = $student_id;

                    $pexcel = $this->obj_pexcel->find($student->pexcel_id);

                    if (!empty($pexcel) && ($this->is_admin || ($pexcel->user_id == $this->current_user->id) || ($student->student_user == $this->current_user->user_name && $student->pexcel_id == $pexcel->pexcel_id))
                    ) {
                        $student = $this->obj_students->update_student($input);
                        //Message
                        $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                        return Redirect::route("admin_pnd.edit", ["id" => $student->student_id]);
                    } else {

                        $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));

                        return Redirect::route("admin_pnd.edit", ["id" => $student->student_id]);
                    }
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $student = $this->obj_students->add_student($input);

                if (!empty($student)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    return Redirect::route("admin_pnd.edit", ["id" => $student->student_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $students->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }
        $pexcels = $this->obj_students->sendPexcels();
        $this->data = array_merge($this->data, array(
            'student' => $student,
            'request' => $request,
            'pexcels' => $pexcels,
                ), $data);

        return view('pnd::admin.pnd_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public
            function delete(Request $request) {

        $student = NULL;
        $student_id = $request->get('id');

        if (!empty($student_id)) {
            $student = $this->obj_students->find($student_id);

            if (!empty($student)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $obj_student = new PndUser();
                $obj_student->delete_user(array('user_name' => $student->student_user));
                $student->delete();
            }
        } else {
            
        }

        $this->data = array_merge($this->data, array(
            'student' => $student,
        ));

        return Redirect::route("admin_pnd");
    }

    /*
     * Get school by district
     */

    public
            function getSchoolByDistrict(Request $request) {

        $input = $request->all();
        $input['school_level_id'] = 2;
        $schools = $this->obj_schools->pluck_select($input);

        $html = null;
        if (!empty($schools)) {
            foreach ($schools as $key => $school) {
                $selected = ($key == $request['school_current']) ? "selected" : "";
                $html .= '<option ' . $selected . ' value="' . $key . '">' . $school . '</option>';
            }
        }

        return $html;
    }

    /* Kiểm tra user là học sinh hiện tại hay là trường cấp 2/ cấp 3 / user có quyền
      xem thông tin học sinh
     */

    public
            function check_view_user($request) {
        $this->isAuthentication();
        $params = $request->all();
        $params['user_name'] = $this->current_user->user_name;
        $params['user_id'] = $this->current_user->id;
        $params['permissions'] = $this->current_user->permissions;

        $check_student = $this->obj_students->get_student($params);

        if (!empty($check_student)) {
            return true;
        }

        $check_permission_user = 1;


        return false;
    }

}
