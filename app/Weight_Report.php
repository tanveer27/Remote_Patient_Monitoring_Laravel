<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight_Report extends Model
{
    protected $table='weight_reports';
    protected $fillable = [
        'weight_report_status', 'weight_report','prescription','doctor_id'
    ];
    public function temperature(){
        return $this->belongsTo('App\Weight');
    }
}
