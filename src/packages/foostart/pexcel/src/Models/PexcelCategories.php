<?php

namespace Foostart\Pexcel\Models;

use Illuminate\Database\Eloquent\Model;

class PexcelCategories extends Model {

    protected $table = 'pexcel_categories';
    public $timestamps = false;
    protected $fillable = [
        'pexcel_category_name',
        'user_id',
        'pexcel_category_created_at',
        'pexcel_category_updated_at',
    ];
    protected $primaryKey = 'pexcel_category_id';

    public function get_pexcels_categories($params = array()) {
        $eloquent = self::orderBy('pexcel_category_id');

        if (!empty($params['pexcel_category_name'])) {
            $eloquent->where('pexcel_category_name', 'like', '%' . $params['pexcel_category_name'] . '%');
        }
        $pexcels_category = $eloquent->paginate(config('pexcel.per_page'));
        return $pexcels_category;
    }

    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_pexcel_category($input, $pexcel_id = NULL) {

        if (empty($pexcel_id)) {
            $pexcel_id = $input['pexcel_category_id'];
        }

        $pexcel = self::find($pexcel_id);

        if (!empty($pexcel)) {

            $pexcel->pexcel_category_name = $input['pexcel_category_name'];
            $pexcel->pexcel_category_updated_at = time();

            $pexcel->save();

            return $pexcel;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_pexcel_category($input) {

        $pexcel = self::create([
                    'pexcel_category_name' => $input['pexcel_category_name'],
                    'pexcel_category_created_at' => time(),
                    'pexcel_category_updated_at' => time(),
                    'user_id' => $input['user_id'],
        ]);
        return $pexcel;
    }

    /**
     * Get list of pexcels categories
     * @param type $category_id
     * @return type
     */
    public function pluckSelect($category_id = NULL) {
        $status_category = config('pexcel.status_category_lable');
        if ($category_id) {
            $categories = self::where('pexcel_category_id', '!=', $category_id)
                    ->where('pexcel_status', $status_category['available'])
                    ->orderBy('pexcel_category_name', 'DESC')
                    ->pluck('pexcel_category_name', 'pexcel_category_id');
        } else {
            $categories = self::orderBy('pexcel_category_name', 'DESC')
                    ->where('pexcel_status', $status_category['available'])
                    ->pluck('pexcel_category_name', 'pexcel_category_id');
        }
        return $categories;
    }

    /**
     * Get list of pexcels categories
     * @param type $category_id
     * @return type
     */
    public function pluckSelect_ByUserId($user_id) {
        $categories = self::where('user_id', $user_id)
                ->orderBy('pexcel_category_name', 'ASC')
                ->pluck('pexcel_category_name', 'pexcel_category_id');
        return $categories;
    }

     public function get_pexcels_categories_byuserid($params = array(),$user_id) {
        $eloquent = self::where('user_id', $user_id)
                        ->orderby('pexcel_category_name');

        if (!empty($params['pexcel_category_name'])) {
            $eloquent->where('pexcel_category_name', 'like', '%' . $params['pexcel_category_name'] . '%');
        }
        $pexcels_category = $eloquent->paginate(10);
        return $pexcels_category;
    }

}
