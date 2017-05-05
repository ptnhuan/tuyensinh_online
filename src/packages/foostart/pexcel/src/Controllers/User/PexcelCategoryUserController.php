<?php

namespace Foostart\Pexcel\Controllers\User;

use Illuminate\Http\Request;
use Foostart\Pexcel\Controllers\User\UserController;
use URL;
use Route,
    Redirect;
use Foostart\Pexcel\Models\PexcelsCategories;
/**
 * Validators
 */
use Foostart\Pexcel\Validators\PexcelCategoryAdminValidator;

class PexcelCategoryUserController extends UserController {

    private $obj_post_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_post_category = new PexcelsCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $this->isAuthentication();

        if ($this->current_user) {
            $params = $request->all();

            $list_post_category = $this->obj_post_category->get_posts_categories_byuserid($params, $this->current_user->id);

            $this->data = array_merge($this->data, array(
                'posts_categories' => $list_post_category,
                'request' => $request,
                'params' => $params
            ));
            return view('post::post_category.user.post_category_list', $this->data);
        }
         return redirect()->to('home-list/error');
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $this->isAuthentication();

        if ($this->current_user) {
            $post_category = NULL;
            $post_category_id = (int) $request->get('id');


            if (!empty($post_category_id) && (is_int($post_category_id))) {
                $post_category = $this->obj_post_category->find($post_category_id);

                if (!empty($post_category) && ($this->is_admin || ($post_category->user_id == $this->current_user->id))) {

                } else {
                    return redirect()->to('home-list/error');
                }
            }

            $this->data = array_merge($this->data, array(
                'post_category' => $post_category,
                'request' => $request
            ));
            return view('post::post_category.user.post_category_edit', $this->data);
        }

        return redirect()->to('home-list/error');
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

        $this->obj_validator = new PexcelCategoryAdminValidator();

        $input = $request->all();

        $input['user_id'] = $this->current_user->id;

        $post_category_id = (int) $request->get('id');

        $post_category = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($post_category_id) && is_int($post_category_id)) {

                $post_category = $this->obj_post_category->find($post_category_id);
            }
        } else {
            if (!empty($post_category_id) && is_int($post_category_id)) {

                $post_category = $this->obj_post_category->find($post_category_id);

                if (!empty($post_category)) {

                    $input['post_category_id'] = $post_category_id;
                    $post_category = $this->obj_post_category->update_post_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_update_successfully'));
                    return Redirect::route("user_post_category.edit", ["id" => $post_category->post_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_update_unsuccessfully'));
                }
            } else {

                $post_category = $this->obj_post_category->add_post_category($input);

                if (!empty($post_category)) {

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_add_successfully'));
                    return Redirect::route("user_post_category.edit", ["id" => $post_category->post_category_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data = array_merge($this->data, array(
            'post_category' => $post_category,
            'request' => $request,
                ), $data);

        return view('post::post_category.user.post_category_edit', $this->data);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {
        $this->isAuthentication();

        if ($this->current_user) {
            $post_category = NULL;
            $post_category_id = $request->get('id');

            if (!empty($post_category_id)) {
                $post_category = $this->obj_post_category->find($post_category_id);

                if (!empty($post_category)) {

                    if ($this->is_admin || ($post_category->user_id == $this->current_user->id)) {

                    } else {
                        return redirect()->to('home-list/error');
                    }
                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_delete_successfully'));

                    $post_category->delete();

                    $this->data = array_merge($this->data, array(
                        'post_category' => $post_category,
                    ));
                    return Redirect::route("user_post_category");
                }
            }
        }

        return redirect()->to('home-list/error');
    }

}
