<?php namespace Foostart\Pexcel\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Pexcel\Controllers\Admin\PexcelController;
use URL;
use Route,
    Redirect;

/**
 * Models
 */
use Foostart\Pexcel\Models\Pexcel;
use Foostart\Slideshow\Models\Slideshows;

/**
 * Validators
 */
use Foostart\Pexcel\Validators\PexcelAdminValidator;

class PexcelAdminController extends PexcelController {

    private $obj_pexcel = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_pexcel = new Pexcel();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $pexcels = $this->obj_pexcel->get_pexcels($params);

        $this->data = array_merge($this->data, array(
            'pexcels' => $pexcels,
            'request' => $request,
            'params' => $params
        ));
        return view('pexcel::admin.pexcel_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $pexcel = NULL;
        $pexcel_id = (int) $request->get('id');


        if (!empty($pexcel_id) && (is_int($pexcel_id))) {
            $pexcel = $this->obj_pexcel->find($pexcel_id);
        }


        $this->data = array_merge($this->data, array(
            'pexcel' => $pexcel,
            'request' => $request,
        ));
        return view('pexcel::admin.pexcel_edit', $this->data);
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function pexcel(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PexcelAdminValidator();
        $this->obj_pexcel_categories = new PexcelsCategories();
        $obj_slideshow = new Slideshows();

        $input = array_merge($request->all(),$this->parseImagePath($request->get('pexcel_image_path')));

        $input['user_id'] = $this->current_user->id;

        $pexcel_id = (int) $request->get('id');

        $pexcel = NULL;

        $data = array();

        if (!$this->obj_validator->adminValidate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($pexcel_id) && is_int($pexcel_id)) {
                $pexcel = $this->obj_pexcel->find($pexcel_id);
            }
        } else {
            if (!empty($pexcel_id) && is_int($pexcel_id)) {

                $pexcel = $this->obj_pexcel->find($pexcel_id);

                if (!empty($pexcel)) {

                    $input['pexcel_id'] = $pexcel_id;
                    $pexcel = $this->obj_pexcel->update_pexcel($input);

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_update_successfully'));
                    return Redirect::route("admin_pexcel.edit", ["id" => $pexcel->pexcel_id]);

                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_update_unsuccessfully'));

                }
            } else {

                $input = array_merge($input, array(
                ));

                $pexcel = $this->obj_pexcel->add_pexcel($input);

                if (!empty($pexcel)) {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_add_successfully'));
                    return Redirect::route("admin_pexcel.edit", ["id" => $pexcel->pexcel_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'pexcel' => $pexcel,
            'request' => $request,
            'categories' =>  array(0 => 'None') + $this->obj_pexcel_categories->pluckSelect()->toArray(),
            'slideshows' => array(0 => 'None') + $obj_slideshow->pluckSelect()->toArray()
        ), $data);

        return view('pexcel::pexcel.admin.pexcel_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $pexcel = NULL;
        $pexcel_id = $request->get('id');

        if (!empty($pexcel_id)) {
            $pexcel = $this->obj_pexcel->find($pexcel_id);

            if (!empty($pexcel)) {
                //Message
                $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_delete_successfully'));

                $pexcel->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'pexcel' => $pexcel,
        ));

        return Redirect::route("admin_pexcel");
    }


    public function parseImagePath($url) {

        $patern = '/http:\/\/.*?\/(.*?)\/[a-z0-9-_\.]*$/';
        preg_match($patern, $url, $parse_url);

        $image_info = array(
            'full_path' => $url,
            'sub_path' => @$parse_url[1],
        );

        return $image_info;
    }

}