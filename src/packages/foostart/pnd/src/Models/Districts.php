<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model {

    protected $table = 'school_districts';
    public $timestamps = false;
    protected $fillable = [
          'school_district_code',
          'school_district_name'        
    ];
    protected $primaryKey = 'school_district_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_districts($params = array()) {
        $eloquent = self::orderBy('school_district_name', 'ASC');

        //pexcel_name
        if (!empty($params['school_district_code'])) {
            $eloquent->where('school_district_code', $params['school_district_code']);
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
    public function update_district($input, $school_district_id = NULL) {

        if (empty($school_district_id)) {
            $school_district_id = $input['school_district_id'];
        }
        
        $district = self::find($school_district_id);

        if (!empty($district)) {

            $district->school_district_code = $input['school_district_code'];
            $district->school_district_name = $input['school_district_name'];
           
            
            $district->save();
 
            return $district;
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
        $district = array();

        foreach ($this->fillable as $key) {
            $district[$key] = @$data[$key];
        }

        return $district;
    }

   

    public function add_district($input) {

        $district = $this->validRow($input);
 
        $district = self::create($district);

             return $district;
    }

   

    public function delete_district($school_district_id) {
        $eloquent = self::where('school_district_id', $school_district_id)->delete();
        return $eloquent;
    }

    public function pluck_select(){
        $eloquent = self::orderBy('school_district_name', 'ASC');
        
        return  $eloquent->pluck('school_district_name', 'school_district_code');
    }
   
  

}
