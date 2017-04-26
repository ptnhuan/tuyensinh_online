<?php namespace Foostart\Phpexcel\Models;

use Illuminate\Database\Eloquent\Model;

class Phpexcels extends Model {

    protected $table = 'phpexcels';
    public $timestamps = false;
    protected $fillable = [
        'phpexcel_name',
    ];

    protected $primaryKey = 'phpexcel_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_phpexcels($params = array()) {
        $api = self::get();
        return $api;
    }



    /**
     *
     * @param type $input
     * @param type $api_id
     * @return type
     */
    public function update_api($input, $api_id = NULL) {

        if (empty($api_id)) {
            $api_id = $input['api_id'];
        }

        $api = self::find($api_id);

        if (!empty($api)) {

            $api->api_key = $input['_token'];
            $api->api_status = (int)$input['api_status'];
            $api->api_updated_at = time();

            $api->save();

            return $api;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_api($input) {

        $api = self::create([
                    'api_key' => @$input['_token'],
                    'api_status' => @$input['api_status'],
                    'api_created_at' => time(),
                    'api_updated_at' => time(),
        ]);

        return $api;
    }



}
