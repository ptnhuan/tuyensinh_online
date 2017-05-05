<?php

namespace Foostart\Post\Models;

use Illuminate\Database\Eloquent\Model;

class PostsCategories extends Model {

    protected $table = 'posts_categories';
    public $timestamps = true;
    protected $fillable = [
        'post_category_name',
        'user_id',
        'post_category_created_at',
        'post_category_updated_at',
    ];
    protected $primaryKey = 'post_category_id';

    public function get_posts_categories($params = array()) {
        $eloquent = self::orderBy('post_category_id');

        if (!empty($params['post_category_name'])) {
            $eloquent->where('post_category_name', 'like', '%' . $params['post_category_name'] . '%');
        }
        $posts_category = $eloquent->paginate(10);
        return $posts_category;
    }

    /**
     *
     * @param type $input
     * @param type $post_id
     * @return type
     */
    public function update_post_category($input, $post_id = NULL) {

        if (empty($post_id)) {
            $post_id = $input['post_category_id'];
        }

        $post = self::find($post_id);

        if (!empty($post)) {

            $post->post_category_name = $input['post_category_name'];
            $post->post_category_updated_at = time();

            $post->save();

            return $post;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_post_category($input) {

        $post = self::create([
                    'post_category_name' => $input['post_category_name'],
                    'post_category_created_at' => time(),
                    'post_category_updated_at' => time(),
                    'user_id' => $input['user_id'],
        ]);
        return $post;
    }

    /**
     * Get list of posts categories
     * @param type $category_id
     * @return type
     */
    public function pluckSelect($category_id = NULL) {
        if ($category_id) {
            $categories = self::where('post_category_id', '!=', $category_id)
                    ->orderBy('post_category_name', 'ASC')
                    ->pluck('post_category_name', 'post_category_id');
        } else {
            $categories = self::orderBy('post_category_name', 'ASC')
                    ->pluck('post_category_name', 'post_category_id');
        }
        return $categories;
    }

    /**
     * Get list of posts categories
     * @param type $category_id
     * @return type
     */
    public function pluckSelect_ByUserId($user_id) {
        $categories = self::where('user_id', $user_id)
                ->orderBy('post_category_name', 'ASC')
                ->pluck('post_category_name', 'post_category_id');
        return $categories;
    }

     public function get_posts_categories_byuserid($params = array(),$user_id) {
        $eloquent = self::where('user_id', $user_id)
                        ->orderby('post_category_name');

        if (!empty($params['post_category_name'])) {
            $eloquent->where('post_category_name', 'like', '%' . $params['post_category_name'] . '%');
        }
        $posts_category = $eloquent->paginate(10);
        return $posts_category;
    }

}
