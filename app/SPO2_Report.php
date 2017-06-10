<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPO2_Report extends Model
{
    protected $table='spo2_report';
    protected $fillable = [
        'spo2_id','spo2_report_status', 'spo2_report','prescription','doctor_id'
    ];
    public function blood_pressure(){
        return $this->belongsTo('App\SPO2');
    }
}
