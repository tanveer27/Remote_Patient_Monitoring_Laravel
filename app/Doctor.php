<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $fillable = [
        'user_id','doctor_first name', 'doctor_last name', 'degree','speciality','hospital','consulting_hour','image',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function patients(){
        return $this->belongsToMany('App\Patient')->withPivot('subscribed')->withTimestamps();
    }
}
