<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

class Examinepointpriors extends Model {

    protected $table = 'school_point_priors';
    public $timestamps = false;
    protected $fillable = [
        'school_prior_point_1',
        'school_prior_point_2',
         'school_prior_point_3'
       
    ];
    protected $primaryKey = 'school_prior_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_examinepointpriors( ) {
        $eloquent = self::orderBy('school_prior_id', 'DESC');
        $pexcels = $eloquent->paginate(config('pexcel.per_page'))->first();

        return $pexcels;
    }
    
    
    

    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_examinepointpriors($input, $school_prior_id= NULL) {

        if (empty($school_prior_id)) {
            $school_prior_id = $input['school_prior_id'];
        }

        $examinepointprior = self::find($school_prior_id);

        if (!empty($examinepointprior)) {

            $examinepointprior->school_prior_point_1 = $input['school_prior_point_1'];
            $examinepointprior->school_prior_point_2 = $input['school_prior_point_2'];
           $examinepointprior->school_prior_point_3 = $input['school_prior_point_3'];


            $examinepointprior->save();

            return $examinepointprior;
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

    /**
     *
     * @get Point
     * @return POINT
     */
      
      
       
    
    
}
