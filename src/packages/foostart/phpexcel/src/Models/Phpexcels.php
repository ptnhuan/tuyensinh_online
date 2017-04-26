<?php

namespace Foostart\Phpexcel\Models;

use Illuminate\Database\Eloquent\Model;

class Phpexcels extends Model {

    protected $table = 'phpexcels';
    public $timestamps = false;
    protected $fillable = [
        'phpexcel_name',
        'category_id',
        'phpexcel_image',
        'phpexcel_overview',
        'phpexcel_description',
        'slideshow_id'
    ];
    protected $primaryKey = 'phpexcel_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_phpexcels($params = array()) {
        $eloquent = self::orderBy('phpexcel_id');

        //phpexcel_name
        if (!empty($params['phpexcel_name'])) {
            $eloquent->where('phpexcel_name', 'like', '%'. $params['phpexcel_name'].'%');
        }

        $phpexcels = $eloquent->paginate(10);//TODO: change number of item per page to configs

        return $phpexcels;
    }



    /**
     *
     * @param type $input
     * @param type $phpexcel_id
     * @return type
     */
    public function update_phpexcel($input, $phpexcel_id = NULL) {

        if (empty($phpexcel_id)) {
            $phpexcel_id = $input['phpexcel_id'];
        }

        $phpexcel = self::find($phpexcel_id);

        if (!empty($phpexcel)) {

            $phpexcel->phpexcel_name = $input['phpexcel_name'];
            $phpexcel->category_id = $input['category_id'];
            $phpexcel->phpexcel_image = $input['phpexcel_image'];
            $phpexcel->phpexcel_overview = $input['phpexcel_overview'];
            $phpexcel->phpexcel_description = $input['phpexcel_description'];
            $phpexcel->slideshow_id = $input['slideshow_id'];

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
    public function add_phpexcel($input) {

        $phpexcel = self::create([
                    'phpexcel_name' => @$input['phpexcel_name'],
                    'category_id' => @$input['category_id'],
                    'phpexcel_image' => @$input['phpexcel_image'],
                    'phpexcel_overview' => @$input['phpexcel_overview'],
                    'phpexcel_description' => @$input['phpexcel_description'],
                    'slideshow_id' => @$input['slideshow_id'],
        ]);
        return $phpexcel;
    }
}
