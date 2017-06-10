<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glucose extends Model
{
    //
    protected $fillable = [
        'glucose','glucose_data_status','dinner_situation','note','patient_id','device',
    ];
    public function glucose_report(){
        return $this->hasOne('App\Glucose_Report');
    }
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
