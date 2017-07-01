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
use Foostart\Pnd\Models\Specialists;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Helper\Parse;
/**
 * Validators
 */
use Foostart\Pnd\Validators\PndSpecialistAdminValidator;

class PndSpecialistAdminController extends PndController
{

    private $obj_specialists = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;

    public function __construct()
    {

        $this->obj_specialists = new Specialists();
        $this->obj_pexcel_categories = new PexcelCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request)
    {

        $params = $request->all();

        $specialists = $this->obj_specialists->get_specialists($params);

        $this->data = array_merge($this->data, array(
            'specialists' => $specialists,
            'request' => $request,
            'params' => $params
        ));
        return view('pnd::admin.management.pnd_specialist_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request)
    {

        $specialist = NULL;
        $school_class_id = (int)$request->get('id');


        if (!empty($school_class_id) && (is_int($school_class_id))) {

            $specialist = $this->obj_specialists->find($school_class_id);

        }

        $this->data = array_merge($this->data, array(
            'specialist' => $specialist,
            'request' => $request,
        ));

        return view('pnd::admin.management.pnd_specialist_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request)
    {

        $this->isAuthentication();

        $this->obj_validator = new PndSpecialistAdminValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $school_class_id = (int)$request->get('id');

        $specialists = NULL;

        $data = array();


        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($school_class_id) && is_int($school_class_id)) {
                $specialist = $this->obj_specialists->find($school_class_id);
            }
        } else {
            if (!empty($school_class_id) && is_int($school_class_id)) {

                $specialist = $this->obj_specialists->find($school_class_id);

                if (!empty($specialist)) {

                    $input['school_class_id'] = $school_class_id;

                    $specialist= $this->obj_specialists->update_specialist($input);

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_successfully'));
                   
                 //   return Redirect::route("admin_pnd_specialist.edit", ["id" => $specialist->$school_class_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_update_unsuccessfully'));
                }
            } else {

                $input = array_merge($input, array());

                $specialists = $this->obj_specialists->add_specialist($input);

                if (!empty($specialists)) {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_successfully'));

                  //  return Redirect::route("admin_pnd.parse", ["id" => $specialists->pnd_id]);
                    //return Redirect::route("admin_pnd.edit", ["id" => $schools->pnd_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pnd::pnd.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'specialists' => $specialists,
            'request' => $request,
        ), $data);

        return view('pnd::admin.management.pnd_specialist_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request)
    {

        $specialist = NULL;
        $school_class_id = $request->get('id');

        if (!empty($school_class_id)) {
            $specialist= $this->obj_specialists->find($school_class_id);

            if (!empty($specialist)) {
                //Message
                $this->addFlashMessage('message', trans('pnd::pnd.message_delete_successfully'));

                $specialist->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'specialist' => $specialist,
        ));

        return Redirect::route("admin_pnd_specialist");
    }

    public function parse(Request $request)
    {

        $obj_parse = new Parse();
        $obj_specialists = new Districts();

        $input = $request->all();

        $school_class_id = $request->get('id');
        $specialists = $this->obj_specialists->find($school_class_id);


        $specialists = $obj_parse->get_specialists($specialists);

        /**
         * Import data
         */
        $obj_specialists->delete_old_data($specialists->pexel_id);
        $obj_specialists->add_specialists($specialists, $specialists->pnd_id);

        $specialists = $obj_specialists->get_specialists();

        $this->data = array_merge($this->data, array(
            'specialists' => $specialists,
            'request' => $request,
        ));

        return view('pnd::admin.pnd_parse', $this->data);
    }

}
