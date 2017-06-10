<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glucose_Report extends Model
{
    //
    protected $table='glucose_reports';
    protected $fillable = [
        'glucose_report_status', 'glucose_report','prescription','doctor_id'
    ];
    public function glucose(){
        return $this->belongsTo('App\Glucose');
    }
}
