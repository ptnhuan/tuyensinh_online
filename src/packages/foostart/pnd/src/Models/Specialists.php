<?php

namespace Foostart\Pnd\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Specialists extends Model {

    protected $table = 'school_classes';
    public $timestamps = false;
    protected $fillable = [
        'school_class_code',
        'school_class_name' ,    
        'school_class_order'     
    ];
    protected $primaryKey = 'school_class_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_specialists($params = array()) {
        $eloquent = self::orderBy('school_class_order', 'ASC');

         if (!empty($params['specialist_label'])) {
                     
             $eloquent->where('school_class_code', 'like', '%' . $params['specialist_label'] . '%');
                            $eloquent->orwhere('school_class_name', 'like', '%' . $params['specialist_label'] . '%');
            
        }
        
        //pexcel_name
        if (!empty($params['pexcel_id'])) {
            $eloquent->where('pexcel_id', $params['pexcel_id']);
        }

        $pexcels = $eloquent->paginate(config('pexcel.per_page'));

        return $pexcels;
    }

    
     public function get_sbd_specialists() {
        $eloquent = self::orderBy('school_class_order', 'ASC');
        $pexcels = $eloquent->get();

        return $pexcels;
    }
    

    public function get_mon_specialists($mamon) {
        $eloquent = self::orderBy('school_class_order', 'ASC')->where('school_class_code', $mamon);
        $pexcels = $eloquent->first();
      
        return $pexcels['school_class_name'];
    }
    
    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_specialist($input, $school_class_id = NULL) {

        if (empty($school_class_id)) {
            $school_class_id = $input['school_class_id'];
        }
        
        $specialist = self::find($school_class_id);

        if (!empty($specialist)) {

            $specialist->school_class_code = $input['school_class_code'];
            $specialist->school_class_name = $input['school_class_name'];
            $specialist->school_class_order = $input['school_class_order'];
           
            
            $specialist->save();
 
            return $specialist;
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
        $specialist = array();

        foreach ($this->fillable as $key) {
            $specialist[$key] = @$data[$key];
        }

        return $specialist;
    }

    
    public function add_specialist($input) {

        $specialist = $this->validRow($input);
 
        $specialist = self::create($specialist);
       
        return $specialist;
    }

   

    public function delete_specialist($school_class_id) {
        $eloquent = self::where('school_class_id', $school_class_id)->delete();
        return $eloquent;
    }

   public function pluck_select() {
        $eloquent = self::orderBy('school_class_name', 'ASC');             
        return $eloquent->pluck('school_class_name', 'school_class_code');
    }
   
     public function get_school_subject() {
            $eloquent = DB::table('school_subject')->orderBy('school_class_id', 'ASC');
      
        $pexcels = $eloquent->get();

        return $pexcels;
    }
    
   public function pluck_select_subject() {
        $eloquent = DB::table('school_subject')->orderBy('school_class_id', 'ASC');     
        return $eloquent->pluck('school_class_name', 'school_class_code');
    }
   
    public function get_mon_subject($mamon) {
        $eloquent =DB::table('school_subject')->where('school_class_code', $mamon);
        $pexcels = $eloquent->first();    
        
        return $pexcels->school_class_name;
    }
}
