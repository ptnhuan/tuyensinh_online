<?php namespace Foostart\Pexcel\Models;

use Illuminate\Database\Eloquent\Model;

class Pexcel extends Model {

    protected $table = 'pexcel';
    public $timestamps = false;
    protected $fillable = [
        'pexcel_name',
        'pexcel_fromrow',
        'pexcel_torow',
        'pexcel_description',
        'pexcel_category_id',
        'user_id',
        'pexcel_file_path',
        'pexcel_created_at',
        'pexcel_updated_at',

        'pexcel_status'
    ];

    protected $primaryKey = 'pexcel_id';

    protected  $pstatus;

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->pstatus = config('pexcel.status');
    }

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

        //date from
        if (!empty($params['pexcel_date_from'])) {
            $params['pexcel_date_from'] = strtotime($params['pexcel_date_from']);
            $eloquent->where('pexcel_updated_at', '>=', $params['pexcel_date_from']);
        }

        //date to
        if (!empty($params['pexcel_date_to'])) {
            $params['pexcel_date_to'] = strtotime($params['pexcel_date_to']);
            $eloquent->where('pexcel_updated_at', '<=', $params['pexcel_date_to']);
        }

        //owner
        if (!empty($params['user_id'])) {
            $eloquent->where('user_id', $params['user_id']);
        }

        if (!empty($params['export'])) {
            $pexcels = $eloquent->get();
        } else {
            $pexcels = $eloquent->paginate(config('pexcel.per_page'));
        }

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

            $pexcel->pexcel_description = $input['pexcel_description'];

            $pexcel->pexcel_fromrow = $input['pexcel_fromrow'];

            $pexcel->pexcel_torow = $input['pexcel_torow'];

            $pexcel->pexcel_status = $this->pstatus['new'];

            $pexcel->pexcel_category_id = $input['pexcel_category_id'];

            $pexcel->pexcel_file_path = $input['pexcel_file_path'];

            $pexcel->pexcel_updated_at = time();

            $pexcel->save();
            return $pexcel;
        } else {
            return NULL;
        }
    }

    /**
     * Insert new pexcel item
     * @param type $input
     * @return type
     */
    public function add_pexcel($input) {

        $pexcel = self::create([
                    'pexcel_name' => @$input['pexcel_name'],
                    'pexcel_fromrow' => @$input['pexcel_fromrow'],
                    'pexcel_torow' => @$input['pexcel_torow'],
                    'pexcel_description' => @$input['pexcel_description'],
                    'pexcel_file_path' => @$input['pexcel_file_path'],

                    'user_id' => @$input['user_id'],
                    'pexcel_category_id' => @$input['pexcel_category_id'],

                    'pexcel_created_at' => time(),
                    'pexcel_updated_at' => time(),

                    'pexcel_status' => $this->pstatus['new'],
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

        $pexcels = $eloquent->paginate(config('pexcel.user_pexcel_per_page'));

        return $pexcels;
    }

    public function get_by_userId_categoryIds($user_id, $category_ids) {
        $pexcels = self::where('user_id', $user_id)
                        ->whereIn('pexcel_category_id', $category_ids)
                        ->get();
        return $pexcels;
    }

}
