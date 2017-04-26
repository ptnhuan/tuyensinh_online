<?php namespace Foostart\Phpexcel\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Phpexcel\Controllers\Admin\PhpexcelController;
use URL;
use Route,
    Redirect;
use Foostart\Phpexcel\Models\Phpexcels;
use Foostart\Phpexcel\Models\PhpexcelCategories;
use Foostart\Slideshow\Models\Slideshows;
/**
 * Validators
 */
use Foostart\Phpexcel\Validators\PhpexcelAdminValidator;

class PhpexcelAdminController extends MyController {

    private $obj_phpexcel = NULL;
    private $obj_phpexcel_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_phpexcel = new Phpexcels();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {
        var_dump(22);
        die();

        $params = $request->all();

        $list_phpexcel = $this->obj_phpexcel->get_phpexcels($params);

        $this->data = array_merge($this->data, array(
            'phpexcels' => $list_phpexcel,
            'request' => $request,
            'params' => $params
        ));
        return view('phpexcel::phpexcel.admin.phpexcel_list', $this->data);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $phpexcel = NULL;
        $phpexcel_id = (int) $request->get('id');

        $obj_slideshow = new Slideshows();

        if (!empty($phpexcel_id) && (is_int($phpexcel_id))) {
            $phpexcel = $this->obj_phpexcel->find($phpexcel_id);
        }

        $this->obj_phpexcel_categories = new phpexcelsCategories();

        $this->data = array_merge($this->data, array(
            'phpexcel' => $phpexcel,
            'request' => $request,
            'categories' => array(0 => 'None') + $this->obj_phpexcel_categories->pluckSelect()->toArray(),
            'slideshows' => array(0 => 'None') + $obj_slideshow->pluckSelect()->toArray()
        ));
        return view('phpexcel::phpexcel.admin.phpexcel_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new phpexcelAdminValidator();
        $this->obj_phpexcel_categories = new phpexcelsCategories();

        $obj_slideshow = new Slideshows();
        $input = $request->all();


        $phpexcel_id = (int) $request->get('id');
        $phpexcel = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($phpexcel_id) && is_int($phpexcel_id)) {

                $phpexcel = $this->obj_phpexcel->find($phpexcel_id);
            }
        } else {
            if (!empty($phpexcel_id) && is_int($phpexcel_id)) {

                $phpexcel = $this->obj_phpexcel->find($phpexcel_id);

                if (!empty($phpexcel)) {

                    $input['phpexcel_id'] = $phpexcel_id;
                    $phpexcel = $this->obj_phpexcel->update_phpexcel($input);

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_update_successfully'));
                    return Redirect::route("admin_phpexcel.edit", ["id" => $phpexcel->phpexcel_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_update_unsuccessfully'));
                }
            } else {

                $phpexcel = $this->obj_phpexcel->add_phpexcel($input);

                if (!empty($phpexcel)) {

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_add_successfully'));
                    return Redirect::route("admin_phpexcel.edit", ["id" => $phpexcel->phpexcel_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data_view, array(
            'phpexcel' => $phpexcel,
            'request' => $request,
            'categories' =>  array(0 => 'None') + $this->obj_phpexcel_categories->pluckSelect()->toArray(),
            'slideshows' => array(0 => 'None') + $obj_slideshow->pluckSelect()->toArray()
        ), $data);

        return view('phpexcel::phpexcel.admin.phpexcel_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $phpexcel = NULL;
        $phpexcel_id = $request->get('id');

        if (!empty($phpexcel_id)) {
            $phpexcel = $this->obj_phpexcel->find($phpexcel_id);

            if (!empty($phpexcel)) {
                //Message
                $this->addFlashMessage('message', trans('phpexcel::phpexcel_admin.message_delete_successfully'));

                $phpexcel->delete();
            }
        } else {

        }

        $this->data = array_merge($this->data, array(
            'phpexcel' => $phpexcel,
        ));

        return Redirect::route("admin_phpexcel");
    }

}
