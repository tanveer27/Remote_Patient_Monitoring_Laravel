<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity_Report extends Model
{
    protected $table='activity_reports';
    protected $fillable = [
        'activity_report_status', 'activity_report','prescription','doctor_id','activity_id',
    ];
    public function activity(){
        return $this->belongsTo('App\Activity');
    }
}
