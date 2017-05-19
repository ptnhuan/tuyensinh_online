<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

class Examinepoints extends Model {

    protected $table = 'school_points';
    public $timestamps = false;
    protected $fillable = [
        'school_point_capacity',
        'school_point_conduct',     
        'school_point_point'     
    ];
    protected $primaryKey = 'school_point_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_examinepoints($params = array()) {
        $eloquent = self::orderBy('school_point_point', 'DESC');
       
           if (!empty($params['examine_point_label'])) {
                            $eloquent->where('school_point_point',  $params['examine_point_label']);                           
                        }

        
   //pexcel_name
        if (!empty($params['pexcel_id'])) {
            $eloquent->where('pexcel_id', $params['pexcel_id']);
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
    public function update_examinepoint($input, $school_point_id = NULL) {

        if (empty($school_point_id)) {
            $school_point_id = $input['school_point_id'];
        }
        
        $examinepoints = self::find($school_point_id);

        if (!empty($examinepoints)) {

            $examinepoints->school_point_capacity = $input['school_point_capacity'];
            $examinepoints->school_point_conduct = $input['school_point_conduct'];
            $examinepoints->school_point_point = $input['school_point_point'];
           
          
            $examinepoints->save();
 
            return $examinepoints;
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
        $examinepoint = array();

        foreach ($this->fillable as $key) {
            $examinepoint[$key] = @$data[$key];
        }

        return $examinepoint;
    }

    
    public function add_examinepoint($input) {

        $examinepoints = $this->validRow($input);
 
        $examinepoints = self::create($examinepoints);
       
        return $examinepoints;
    }

   

    public function delete_examinepoint($school_point_id) {
        $eloquent = self::where('school_point_id', $school_point_id)->delete();
        return $eloquent;
    }

   
   
}
