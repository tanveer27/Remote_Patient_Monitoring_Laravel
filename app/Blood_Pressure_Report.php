<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood_Pressure_Report extends Model
{
    //
    protected $table='blood_pressure_reports';
    protected $fillable = [
        'bp_id','bp_report_status', 'bp_report','prescription','doctor_id'
    ];
    public function blood_pressure(){
        return $this->belongsTo('App\Blood_Pressure');
    }
}
