<?php

namespace Foostart\Phpexcel\Models;

use Illuminate\Database\Eloquent\Model;

class PhpexcelsCategories extends Model {

    protected $table = 'phpexcels_categories';
    public $timestamps = false;
    protected $fillable = [
        'phpexcel_category_name'
    ];
    protected $primaryKey = 'phpexcel_category_id';

    public function get_phpexcels_categories($params = array()) {
        $eloquent = self::orderBy('phpexcel_category_id');

        if (!empty($params['phpexcel_category_name'])) {
            $eloquent->where('phpexcel_category_name', 'like', '%'. $params['phpexcel_category_name'].'%');
        }
        $phpexcels_category = $eloquent->paginate(10);
        return $phpexcels_category;
    }

    /**
     *
     * @param type $input
     * @param type $phpexcel_id
     * @return type
     */
    public function update_phpexcel_category($input, $phpexcel_id = NULL) {

        if (empty($phpexcel_id)) {
            $phpexcel_id = $input['phpexcel_category_id'];
        }

        $phpexcel = self::find($phpexcel_id);

        if (!empty($phpexcel)) {

            $phpexcel->phpexcel_category_name = $input['phpexcel_category_name'];

            $phpexcel->save();

            return $phpexcel;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_phpexcel_category($input) {

        $phpexcel = self::create([
                    'phpexcel_category_name' => $input['phpexcel_category_name'],
        ]);
        return $phpexcel;
    }

    /**
     * Get list of phpexcels categories
     * @param type $category_id
     * @return type
     */
     public function pluckSelect($category_id = NULL) {
        if ($category_id) {
            $categories = self::where('phpexcel_category_id', '!=', $category_id)
                    ->orderBy('phpexcel_category_name', 'ASC')
                ->pluck('phpexcel_category_name', 'phpexcel_category_id');
        } else {
            $categories = self::orderBy('phpexcel_category_name', 'ASC')
                ->pluck('phpexcel_category_name', 'phpexcel_category_id');
        }
        return $categories;
    }

}
