<?php

namespace Foostart\Pexcel\Controllers\User;

use Illuminate\Http\Request;
use Foostart\Pexcel\Controllers\User\UserController;
use URL;
use Route,
    Redirect;
/**
 * Models
 */
use Foostart\Pexcel\Models\Pexcel;
use Foostart\Pexcel\Models\PexcelsCategories;
use Foostart\Slideshow\Models\Slideshows;
/**
 * Validators
 */
use Foostart\Pexcel\Validators\PexcelAdminValidator;

class PexcelUserController extends UserController {

    private $obj_post = NULL;
    private $obj_post_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_post = new Pexcel();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {
        $this->isAuthentication();

        if ($this->current_user) {
            $params = $request->all();

            $posts = $this->obj_post->get_user_posts($params, $this->current_user->id);

            $this->data = array_merge($this->data, array(
                'posts' => $posts,
                'request' => $request,
                'params' => $params
            ));
            return view('post::post.user.post_list', $this->data);
        }
         return redirect()->to('home-list/error');
    }

    public function like(Request $request) {
        $this->isAuthentication();

        $post_id = $request->get('post_id');

        if ($this->current_user && $post_id) {

            $post_likes = $request->session()->get('post_likes');

            if ($post_likes) {
                if (!in_array($post_id, $post_likes['ids'])) {

                    $request->session()->push('post_likes.ids', $post_id);
                    $this->obj_post->addLike($post_id);
                }
            } else {
                $request->session()->push('post_likes.ids', $post_id);
                $this->obj_post->addLike($post_id);
            }
        }
        return redirect()->to($request->get('callback'));
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $this->isAuthentication();

        if ($this->current_user) {
            $post = NULL;
            $post_id = (int) $request->get('id');

            if (!empty($post_id) && (is_int($post_id))) {

                $post = $this->obj_post->find($post_id);

                //IS AUTHOR POST
                if (!empty($post) && ($this->is_admin || ($post->user_id == $this->current_user->id))) {

                } else {
                    return redirect()->to('home-list/error');
                }
            }

            $obj_slideshow = new Slideshows();

            $this->obj_post_categories = new PexcelsCategories();

            $this->data = array_merge($this->data, array(
                'post' => $post,
                'request' => $request,
                'categories' => array(0 => '..........') + $this->obj_post_categories->pluckSelect_ByUserId($this->current_user->id)->toArray(),
                'slideshows' => array(0 => '..........') + $obj_slideshow->pluckSelect_ByUserId($this->current_user->id, null)->toArray()
            ));
            return view('post::post.user.post_edit', $this->data);
        }

        return redirect()->to('home-list/error');
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function post(Request $request) {

        $this->isAuthentication();

        if ($this->current_user) {
            $this->obj_validator = new PexcelAdminValidator();
            $this->obj_post_categories = new PexcelsCategories();
            $obj_slideshow = new Slideshows();

            $input = array_merge($request->all(), $this->parseImagePath($request->get('post_image_path')));

            $input['user_id'] = $this->current_user->id;

            $post_id = (int) $request->get('id');

            $post = NULL;

            $data = array();

            if (!$this->obj_validator->userValidate($input)) {

                $data['errors'] = $this->obj_validator->getErrors();

                if (!empty($post_id) && is_int($post_id)) {
                    $post = $this->obj_post->find($post_id);
                }
            } else {
                if (!empty($post_id) && is_int($post_id)) {

                    $post = $this->obj_post->find($post_id);


                    if (!empty($post)) {

                        //IS AUTHOR POST
                        if ($this->is_admin || ($post->user_id == $this->current_user->id)) {

                        } else {
                            return redirect()->to('home-list/error');
                        }

                        $input['post_id'] = $post_id;
                        $input['post_overview'] = $this->getOverview($input['post_description']);
                        $post = $this->obj_post->update_post($input);

                        //Message
                        $this->addFlashMessage('message', trans('post::post_admin.message_update_successfully'));
                        return Redirect::route("user_post.edit", ["id" => $post->post_id]);
                    } else {

                        //Message
                        $this->addFlashMessage('message', trans('post::post_admin.message_update_unsuccessfully'));
                    }
                } else {

                    $input = array_merge($input, array(
                    ));

                    $input['post_overview'] = $this->getOverview($input['post_description']);
                    $post = $this->obj_post->add_post($input);

                    if (!empty($post)) {

                        //Message
                        $this->addFlashMessage('message', trans('post::post_admin.message_add_successfully'));
                        return Redirect::route("user_post.edit", ["id" => $post->post_id]);
                    } else {

                        //Message
                        $this->addFlashMessage('message', trans('post::post_admin.message_add_unsuccessfully'));
                    }
                }
            }

            $this->data = array_merge($this->data, array(
                'post' => $post,
                'request' => $request,
                'categories' => array(0 => 'None') + $this->obj_post_categories->pluckSelect()->toArray(),
                'slideshows' => array(0 => 'None') + $obj_slideshow->pluckSelect($this->current_user->id, null)->toArray()
                    ), $data);

            return view('post::post.user.post_edit', $this->data);
        }
        return redirect()->to('home-list/error');
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $this->isAuthentication();

        if ($this->current_user) {
            $post = NULL;
            $post_id = $request->get('id');

            if (!empty($post_id)) {

                $post = $this->obj_post->find($post_id);

                if (!empty($post) && ($this->is_admin || ($this->current_user->id == $post->user_id))) {
                    //Message
                    $this->addFlashMessage('message', trans('post::post_admin.message_delete_successfully'));

                    $post->delete();

                    $this->data = array_merge($this->data, array(
                        'post' => $post,
                    ));

                    return Redirect::route("user_post");
                }
            }
        }

        return redirect()->to('home-list/error');
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

    function getOverview($string) {

        $index = config('buoumau.length_overview_max');

        while (isset($string[$index]) && strcmp($string[$index], ' ') != 0) {
            $index++;
        }

        $overview = substr($string, 0, $index) . '...';

        return $overview;
    }

}
