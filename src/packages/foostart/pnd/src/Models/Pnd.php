<?php namespace Foostart\Pexcel\Models;

use Illuminate\Database\Eloquent\Model;

class Pexcel extends Model {

    protected $table = 'school_students';
    public $timestamps = false;
    protected $fillable = [
        'pnd_name',
        'pnd_description',
        'pnd_category_id',
        'user_id',
        'pnd_file_path',
        'pnd_created_at',
        'pnd_updated_at',
    ];
    protected $primaryKey = 'pnd_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_pnds($params = array()) {
        $eloquent = self::orderBy('pnd_id', 'DESC');

        //pnd_name
        if (!empty($params['pnd_name'])) {
            $eloquent->where('pnd_name', 'like', '%' . $params['pnd_name'] . '%');
        }

        $pnds = $eloquent->paginate(config('pnd.per_page'));

        return $pnds;
    }

    /**
     *
     * @param type $input
     * @param type $pnd_id
     * @return type
     */
    public function update_pnd($input, $pnd_id = NULL) {

        if (empty($pnd_id)) {
            $pnd_id = $input['pnd_id'];
        }

        $pnd = self::find($pnd_id);

        if (!empty($pnd)) {

            $pnd->pnd_name = $input['pnd_name'];
            $pnd->pnd_description = $input['pnd_description'];

            $pnd->pnd_category_id = $input['pnd_category_id'];

            $pnd->pnd_file_path = $input['pnd_file_path'];

            $pnd->pnd_updated_at = time();

            $pnd->save();

            return $pnd;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_pnd($input) {

        $pnd = self::create([
                    'pnd_name' => @$input['pnd_name'],
                    'pnd_description' => @$input['pnd_description'],
                    'pnd_file_path' => @$input['pnd_file_path'],

                    'user_id' => @$input['user_id'],
                    'pnd_category_id' => @$input['pnd_category_id'],

                    'pnd_created_at' => time(),
                    'pnd_updated_at' => time(),
        ]);
        return $pnd;
    }

    public function get_pnds_by_user_id($user_id) {

        $eloquent = self::where('user_id', $user_id)
                ->orderby('pnd_created_at');

        $pnds = $eloquent->paginate(9);

        return $pnds;
    }

    /**
     * USER POST
     * @param type $user_id
     * @return type
     */
    public function get_user_pnds($params, $user_id) {
        $eloquent = self::where('user_id', $user_id)
                ->orderby('pnd_id', 'DESC');

        //pnd_name
        if (!empty($params['pnd_name'])) {
            $eloquent->where('pnd_name', 'like', '%' . $params['pnd_name'] . '%');
        }

        $pnds = $eloquent->paginate(config('buoumau.user_pnd_per_page'));

        return $pnds;
    }

}
