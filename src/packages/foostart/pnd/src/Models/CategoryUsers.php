<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryUsers extends Model {

    protected $table = 'user_categoy';
    public $timestamps = false;
    protected $fillable = [
        'user_categoy_name'
       
    ];
    protected $primaryKey = 'user_categoy_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_categoryusers($params = array()) {
        $eloquent = self::orderBy('user_categoy_name', 'ASC');

        //pexcel_name
        //if (!empty($params['school_district_code'])) {
        //  $eloquent->where('school_district_code', $params['school_district_code']);
        // }

        $pexcels = $eloquent->paginate(config('pexcel.per_page'));

        return $pexcels;
    }

    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_categoryuser($input, $user_categoy_id = NULL) {

        if (empty($user_categoy_id)) {
            $user_categoy_id = $input['user_categoy_id'];
        }

        $categoryuser = self::find($user_categoy_id);

        if (!empty($categoryuser)) {

            $categoryuser->user_categoy_name = $input['user_categoy_name'];
            //$categoryuser->uc_updated_at = $input['uc_updated_at'];
            //$categoryuser->uc_created_at = $input['uc_created_at'];
            ///$categoryuser->update_at = $input['update_at'];
            //$categoryuser->created_at = $input['created_at'];


            $categoryuser->save();

            return $categoryuser;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    private function validRow($data) {
        $categoryuser = array();

        foreach ($this->fillable as $key) {
            $categoryuser[$key] = @$data[$key];
        }

        return $categoryuser;
    }

    public function add_categoryuser($input) {

        $categoryuser = $this->validRow($input);

        $categoryuser = self::create($categoryuser);

        return $categoryuser;
    }

    public function delete_categoryuser($user_categoy_id) {
        $eloquent = self::where('user_categoy_id', $user_categoy_id)->delete();
        return $eloquent;
    }

}
