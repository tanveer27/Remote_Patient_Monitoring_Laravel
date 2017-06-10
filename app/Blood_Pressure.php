<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood_Pressure extends Model
{
    protected $table='bloodpressures';
    protected $fillable = [
        'data_id','systolic', 'diastolic','bp_data_status','patient_id','device',
    ];
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
    public function bp_report(){
        return $this->hasOne('App\Blood_Pressure_Report');
    }
}
