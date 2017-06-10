<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
     protected $table='activity';
    protected $fillable = [
        'steps','distance','calories','activity_data_status','device','patient_id','data_id',
    ];
    public function activity_report(){
        return $this->hasOne('App\Activity_Report');
    }
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
