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
use Foostart\Pnd\Models\Examinepoints;
use Foostart\Pnd\Models\Examinepointpriors;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Helper\Parse;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndExaminepointAdminValidator;
use Foostart\Pnd\Validators\PndExaminepointpriorAdminValidator;

class PndExaminepointAdminController extends PndController
{

    private $obj_examinepoints = NULL;
    private $obj_examinepointpriors = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;
    private $obj_validatorprior = NULL;

    public function __construct()
    {
        $this->obj_examinepointpriors = new Examinepointpriors();
        $this->obj_examinepoints = new Examinepoints();
        $this->obj_pexcel_categories = new PexcelCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request)
    {

        $params = $request->all();

        $examinepoints = $this->obj_examinepoints->get_examinepoints($params);
        $school_prior_point = $this->obj_examinepointpriors->get_examinepointpriors();
        $this->data = array_merge($this->data, array(
            'examinepoints' => $examinepoints,
            'school_prior_point' => $school_prior_point,
            'request' => $request,
            'params' => $params
        ));


        return view('pnd::admin.management.pnd_examine_point_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request)
    {


        $examinepoint = NULL;
        $school_point_id = (int)$request->get('id');


        if (!empty($school_point_id) && (is_int($school_point_id))) {

            $examinepoint = $this->obj_examinepoints->find($school_point_id);

        }

        $this->data = array_merge($this->data, array(
            'examinepoints' => $examinepoint,
            'request' => $request,
        ));

        return view('pnd::admin.management.pnd_examine_point_edit', $this->data);
    }

    public function prior(Request $request)
    {
        $this->isAuthentication();

        $this->obj_validatorprior = new PndExaminepointpriorAdminValidator();

        $input = $request->all();


        $school_prior_id = 1;

        $examinepointprior = NULL;

        $data = array();


        $examinepointprior = $this->obj_examinepointpriors->find($school_prior_id);

        if (!empty($examinepointprior)) {

            $input['school_prior_id'] = $school_prior_id;

            $examinepointprior = $this->obj_examinepointpriors->update_examinepointpriors($input);

            //Message
            $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));
        }


        return Redirect::route("admin_pnd_examine_point");
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request)
    {

        $this->isAuthentication();

        $this->obj_validator = new PndExaminepointAdminValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $school_point_id = (int)$request->get('id');

        $examinepoint = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_point_id) && is_int($school_point_id)) {
                $examinepoint = $this->obj_examinepoints->find($school_point_id);
            }
        } else {
            if (!empty($school_point_id) && is_int($school_point_id)) {

                $examinepoint = $this->obj_examinepoints->find($school_point_id);

                if (!empty($examinepoint)) {

                    $input['school_point_id'] = $school_point_id;

                    $examinepoint = $this->obj_examinepoints->update_examinepoint($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));


                    return Redirect::route("admin_pnd_examine_point.edit", ["id" => $examinepoint->school_point_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $examinepoint = $this->obj_examinepoints->add_examinepoint($input);

                if (!empty($examinepoint)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                    //  return Redirect::route("admin_pnd.parse", ["id" => $examinepoints->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'examinepoints' => $examinepoint,
            'request' => $request,
        ), $data);

        return view('pnd::admin.management.pnd_examine_point_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request)
    {

        $examinepoint = NULL;
        $school_point_id = $request->get('id');

        if (!empty($school_point_id)) {
            $examinepoint = $this->obj_examinepoints->find($school_point_id);

            if (!empty($examinepoint)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $examinepoint->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'examinepoint' => $examinepoint,
        ));

        return Redirect::route("admin_pnd_examine_point");
    }


}
