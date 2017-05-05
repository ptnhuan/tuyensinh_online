<?php namespace Foostart\Pexcel\Models;

use Illuminate\Database\Eloquent\Model;

class Pexcel extends Model {

    protected $table = 'pexcel';
    public $timestamps = true;
    protected $fillable = [
        'pexcel_name',
        'user_id',
        'pexcel_created_at',
        'pexcel_updated_at',
    ];
    protected $primaryKey = 'pexcel_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_pexcels($params = array()) {
        $eloquent = self::orderBy('pexcel_id', 'DESC');

        //pexcel_name
        if (!empty($params['pexcel_name'])) {
            $eloquent->where('pexcel_name', 'like', '%' . $params['pexcel_name'] . '%');
        }

        $pexcels = $eloquent->paginate(config('pexcel.per_page'));

        return $pexcels;
    }

    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_pexcel($input, $pexcel_id = NULL) {

        if (empty($pexcel_id)) {
            $pexcel_id = $input['pexcel_id'];
        }

        $pexcel = self::find($pexcel_id);

        if (!empty($pexcel)) {

            $pexcel->pexcel_name = $input['pexcel_name'];
            $pexcel->pexcel_slug = $input['pexcel_slug'];

            $pexcel->category_id = $input['category_id'];
            $pexcel->slideshow_id = $input['slideshow_id'];

            $pexcel->pexcel_image_name = @$input['pexcel_image_name'];
            $pexcel->pexcel_image_dir = @$input['sub_path'];

            $pexcel->pexcel_overview = $input['pexcel_overview'];
            $pexcel->pexcel_description = $input['pexcel_description'];

            $pexcel->updated_at = time();

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
    public function add_pexcel($input) {

        $pexcel = self::create([
                    'pexcel_name' => @$input['pexcel_name'],
                    'pexcel_slug' => @$input['pexcel_slug'],
                    'category_id' => @$input['category_id'],
                    'user_id' => $input['user_id'],
                    'pexcel_image_name' => @$input['pexcel_image_name'],
                    'pexcel_image_dir' => @$input['sub_path'],
                    'pexcel_overview' => @$input['pexcel_overview'],
                    'pexcel_description' => @$input['pexcel_description'],
                    'slideshow_id' => @$input['slideshow_id'],
                    'status_id' => $this->status_id['NEW_POST'],
                    'pexcel_created_at' => time(),
                    'pexcel_updated_at' => time(),
        ]);
        return $pexcel;
    }

    public function get_pexcels_by_user_id($user_id) {

        $eloquent = self::where('user_id', $user_id)
                ->orderby('pexcel_created_at');

        $pexcels = $eloquent->paginate(9);

        return $pexcels;
    }

    /**
     * USER POST
     * @param type $user_id
     * @return type
     */
    public function get_user_pexcels($params, $user_id) {
        $eloquent = self::where('user_id', $user_id)
                ->orderby('pexcel_id', 'DESC');

        //pexcel_name
        if (!empty($params['pexcel_name'])) {
            $eloquent->where('pexcel_name', 'like', '%' . $params['pexcel_name'] . '%');
        }

        $pexcels = $eloquent->paginate(config('buoumau.user_pexcel_per_page'));

        return $pexcels;
    }

    public function addLike($pexcel_id) {

        $pexcel = self::find($pexcel_id);

        if (!empty($pexcel)) {

            $pexcel->pexcel_likes = $pexcel->pexcel_likes + 1;
            $pexcel->save();

            return $pexcel;
        } else {
            return NULL;
        }
    }

}
