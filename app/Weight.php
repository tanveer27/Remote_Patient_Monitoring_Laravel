<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = [
        'patient_id','weight','weight_data_status','bmi','note','device',
    ];
    public function weight_report(){
        return $this->hasOne('App\Weight_Report');
    }
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
