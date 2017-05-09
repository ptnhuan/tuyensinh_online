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
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Helper\Parse;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndDistrictAdminValidator;

class PndDistrictAdminController extends PndController
{

    private $obj_districts = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;

    public function __construct()
    {

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

        $districts = $this->obj_districts->get_districts($params);

        $this->data = array_merge($this->data, array(
            'districts' => $districts,
            'request' => $request,
            'params' => $params
        ));
        return view('pnd::admin.pnd_district_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request)
    {

        $district = NULL;
        $school_district_id = (int)$request->get('id');


        if (!empty($school_district_id) && (is_int($school_district_id))) {

            $district = $this->obj_districts->find($school_district_id);

        }

        $this->data = array_merge($this->data, array(
            'district' => $district,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_district_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request)
    {

        $this->isAuthentication();

        $this->obj_validator = new PndDistrictAdminValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $school_district_id = (int)$request->get('id');

        $districts = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_district_id) && is_int($school_district_id)) {
                $district = $this->obj_districts->find($school_district_id);
            }
        } else {
            if (!empty($school_district_id) && is_int($school_district_id)) {

                $district = $this->obj_districts->find($school_district_id);

                if (!empty($district)) {

                    $input['school_district_id'] = $school_district_id;

                    $district= $this->obj_districts->update_district($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));
                   
                    return Redirect::route("admin_pnd_district.edit", ["id" => $district->school_district_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $districts = $this->obj_districts->add_district($input);

                if (!empty($districts)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    return Redirect::route("admin_pnd.parse", ["id" => $districts->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'districts' => $districts,
            'request' => $request,
        ), $data);

        return view('pnd::admin.pnd_district_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request)
    {

        $district = NULL;
        $school_district_id = $request->get('id');

        if (!empty($school_district_id)) {
            $district= $this->obj_districts->find($school_district_id);

            if (!empty($district)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $district->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'district' => $district,
        ));

        return Redirect::route("admin_pnd_district");
    }

    public function parse(Request $request)
    {

        $obj_parse = new Parse();
        $obj_districts = new Districts();

        $input = $request->all();

        $school_district_id = $request->get('id');
        $districts = $this->obj_districts->find($school_district_id);


        $districts = $obj_parse->get_districts($districts);

        /**
         * Import data
         */
        $obj_districts->delete_old_data($districts->pexel_id);
        $obj_districts->add_districts($districts, $districts->pnd_id);

        $districts = $obj_districts->get_districts();

        $this->data = array_merge($this->data, array(
            'districts' => $districts,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_parse', $this->data);
    }

}
