<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperature_Report extends Model
{
    //
    protected $table='temperature_reports';
    protected $fillable = [
        'temp_report_status', 'temp_report','prescription','doctor_id'
    ];
    public function temperature(){
        return $this->belongsTo('App\Temperature');
    }
}
