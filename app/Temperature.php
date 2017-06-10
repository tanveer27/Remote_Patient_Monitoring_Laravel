<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    //
    protected $fillable = [
        'body_temperature','temp_data_status','device','patient_id','data_id',
    ];
    public function temp_report(){
        return $this->hasOne('App\Temperature_Report');
    }
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
