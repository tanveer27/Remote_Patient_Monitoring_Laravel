<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPO2 extends Model
{	
	protected $table='spo2';
    protected $fillable = [
        'patient_id','blood_oxygen','spo2_data_status','heart_rate','note','device',
    ];
    public function weight_report(){
        return $this->hasOne('App\SPO2_Report');
    }
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
