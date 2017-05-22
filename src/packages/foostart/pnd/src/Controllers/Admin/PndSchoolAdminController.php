<?php

namespace Foostart\Pnd\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Pnd\Controllers\Admin\PndController;
use URL;
use Route,
    Redirect;
/**
 * Models
 */
use Foostart\Pnd\Models\Pnd;
use Foostart\Pnd\Models\Schools;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Helper\Parse;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndSchoolAdminValidator;
use Foostart\Pnd\Validators\PndSchoolAboutAdminValidator;
use Illuminate\Support\Facades\Mail;
class PndSchoolAdminController extends PndController
{

    private $obj_schools = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;
    private $obj_districts = NULL;

    public function __construct()
    {

        $this->obj_schools = new Schools();
        $this->obj_districts = new Districts();
        $this->obj_pexcel_categories = new PexcelCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request)
    {

       $params = $request->all();
     
       
        if (isset($params['districts_search'])) {
     } else{
         $params['districts_search']=""; 
     }
     
        if (isset($params['school_level_id'])) {
     } else{
         $params['school_level_id']=""; 
     }

 
        $schools = $this->obj_schools->get_schools($params);
        
        $districts_search = $this->obj_districts->pluck_select();
         
        $districts_search = array('NULL' => '...') + $districts_search->toArray();
  
        $this->data = array_merge($this->data, array(
            'schools' => $schools,              
            'request' => $request,
            'school_level_choose'=>$params['school_level_id'],
             'districts_code_choose' => $params['districts_search'],
            'districts_search' => $districts_search,
            'params' => $params
        ));
        return view('pnd::admin.management.pnd_school_list', $this->data);
    }

     public function index_about(Request $request)
    {

        $params = $request->all();

        $schools = $this->obj_schools->get_schools($params);
        $districts_search = $this->obj_districts->pluck_select();

        $districts_search = array('NULL' => '...') + $districts_search->toArray();

        $this->data = array_merge($this->data, array(
            'schools' => $schools,
            'request' => $request,
            'districts_search' => $districts_search,
            'params' => $params
        ));
        return view('pnd::admin.pnd_school_list', $this->data);
    }
    /**
     *
     * @return type
     */
    public function about(Request $request)
    {


        $param_users = $request->all();
        $this->isAuthentication();
        $school_users = $this->current_user->user_name;
        $param_users['user_name'] = $school_users;

        $school = NULL;

   
        if (!empty($this->current_user->permissions)) {
            
            $school_id = $this->obj_schools->get_school_by_user($param_users)->school_id;
        }

        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();


        if (!empty($school_id) && (is_int($school_id))) {

            $school = $this->obj_schools->find($school_id);
        }

        $this->data = array_merge($this->data, array(
            'school' => $school,
            'districts' => $districts,
            'districts_search' => $districts_search,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_school_about', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request)
    {

        $school = NULL;
        $school_id = (int)$request->get('id');

        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();


        if (!empty($school_id) && (is_int($school_id))) {

            $school = $this->obj_schools->find($school_id);
        }

        $this->data = array_merge($this->data, array(
            'school' => $school,
            'districts' => $districts,
              'school_level_choose'=>$school->school_level_id,
             'districts_code_choose' => $school->school_district_code,
            'districts_search' => $districts_search,
            'request' => $request,
        ));

        return view('pnd::admin.management.pnd_school_edit', $this->data);
    }
  public function edit_about(Request $request)
    {

        $school = NULL;
        $school_id = (int)$request->get('id');

        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();


        if (!empty($school_id) && (is_int($school_id))) {

            $school = $this->obj_schools->find($school_id);
        }

        $this->data = array_merge($this->data, array(
            'school' => $school,
            'districts' => $districts,
            'districts_search' => $districts_search,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_school_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request)
    {

        $this->isAuthentication();

        $this->obj_validator = new PndSchoolAdminValidator();

        $input = $request->all();

        //$input['user_id'] = $this->current_user->id;

        $school_id = (int)$request->get('id');

        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();

        $schools = NULL;

        $data = array();
 $usermail= array();

        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_id) && is_int($school_id)) {
                $school = $this->obj_schools->find($school_id);
            }
        } else {
            if (!empty($school_id) && is_int($school_id)) {

                $school = $this->obj_schools->find($school_id);

                if (!empty($school)) {

                      
                    $input['school_id'] = $school_id;
                    
                    $school = $this->obj_schools->update_school($input);

                 //$usermail['email']="phamngoctho@phuyen.edu.vn";
                   $usermail['email'] = $input['school_email'];
                    $usermail['name'] = "Đơn vị ".$input['school_name'];
                   
                      $usermail['body'] ="THÔNG TIN ĐĂNG NHẬP HỆ THỐNG TUYỂN SINH TRỰC TUYẾN ".'<br>' ."Đơn vị ".$input['school_name'].'<br>' ."Tên đăng nhập: ".$input['user_id'].'<br>' ."Mật khẩu: ".$input['pass_id'].'<br>' ."Địa chỉ truy cập: http://tuyensinh.phuyen.edu.vn";
                    //  $usermail['body'] ="THÔNG TIN ĐĂNG NHẬP HỆ THỐNG TUYỂN SINH TRỰC TUYẾN ".'<br>' ."Đơn vị: Trần Thế Vấn ".'<br>' ."Tên đăng nhập: tranthevan".'<br>' ."Mật khẩu: ttv300".'<br>' ."Địa chỉ truy cập: http://tuyensinh.phuyen.edu.vn";
                  //    $usermail['body'] ="THÔNG TIN ĐĂNG NHẬP HỆ THỐNG TUYỂN SINH TRỰC TUYẾN ".'<br>' ."Đơn vị: Phạm Ngọc Thơ ".'<br>' ."Tên đăng nhập: phamngoctho".'<br>' ."Mật khẩu: pnt578".'<br>' ."Địa chỉ truy cập: http://tuyensinh.phuyen.edu.vn";
                 
                    Mail::send(['view' => 'mail'], ['usermail' => $usermail], function ($m) use ($usermail) {
                        $m->from('tuyensinh@phuyen.edu.vn', 'Hệ thống Tuyển sinh Trực Tuyến-Sở Giáo dục và Đào tạo Phú Yên');
                        $m->to($usermail['email'], $usermail['name'])->subject('Thông tin mật khẩu đăng nhập!')
                        ->setBody($usermail['body'] , 'text/html'); 
                        
                    });

 
                    
                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("admin_pnd_school.edit", ["id" => $school->school_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $schools = $this->obj_schools->add_school($input);

                 // Mail::send(['view' => 'mail'], $input, function($message) use ($input){
                   // $message->to($input['school_email'])->cc($input['school_email'])
                     //   ->subject('Mail sent from 1 23')
                       // ->setBody('123123123123123');
                    //$message->from('tuyensinh@phuyen.edu.vn');
               // });
               // var_dump(123);
               /// die();
                
                if (!empty($schools)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    //  return Redirect::route("admin_pnd.parse", ["id" => $schools->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'schools' => $schools,
            'districts' => $districts,
            'districts_search' => $districts_search,
            'request' => $request,
        ), $data);

        return view('pnd::admin.management.pnd_school_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post_about(Request $request)
    {

        $this->isAuthentication();

        $this->obj_validator = new PndSchoolAboutAdminValidator();

        $input = $request->all();

        //$input['user_id'] = $this->current_user->id;

        $school_id = (int)$request->get('id');

        $districts = $this->obj_districts->pluck_select();
        $districts_search = $this->obj_districts->pluck_select();
        $districts_search = array('NULL' => '...') + $districts_search->toArray();

        $schools = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_id) && is_int($school_id)) {
                $school = $this->obj_schools->find($school_id);
            }
        } else {
            if (!empty($school_id) && is_int($school_id)) {

                
                
                $school = $this->obj_schools->find($school_id);

                if (!empty($school)) {

                    $input['school_id'] = $school_id;
                   
                    $school = $this->obj_schools->update_school_about($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));

                    return Redirect::route("admin_pnd_school_about", ["id" => $school->school_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $schools = $this->obj_schools->add_school($input);

                if (!empty($schools)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    //  return Redirect::route("admin_pnd.parse", ["id" => $schools->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'schools' => $schools,
            'districts' => $districts,
            'districts_search' => $districts_search,
            'request' => $request,
        ), $data);
 
        return view('pnd::admin.pnd_school_about', $this->data);
    }

    /**
     *
     * @return type
     */
    /**
     *
     * @return type
     */
    public function delete(Request $request)
    {

        $school = NULL;
        $school_id = $request->get('id');

        if (!empty($school_id)) {
            $school = $this->obj_schools->find($school_id);

            if (!empty($school)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $school->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'school' => $school,
        ));

        return Redirect::route("admin_pnd_school");
    }

    public function parse(Request $request)
    {

        $obj_parse = new Parse();
        $obj_schools = new Schools();

        $input = $request->all();

        $school_id = $request->get('id');
        $schools = $this->obj_schools->find($school_id);


        $schools = $obj_parse->get_schools($schools);

        /**
         * Import data
         */
        $obj_schools->delete_old_data($schools->pexel_id);
        $obj_schools->add_schools($schools, $schools->pnd_id);

        $schools = $obj_schools->get_schools();

        $this->data = array_merge($this->data, array(
            'schools' => $schools,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_parse', $this->data);
    }

}
