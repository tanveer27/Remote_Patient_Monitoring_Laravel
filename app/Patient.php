<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'user_id','patient_first name', 'patient_last name', 'sex','height','weight','address','dob','bloodgroup','smoke','alcohol','drugs','allergy','hepatitis','fdh','medication','image',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function blood_pressure(){
        return $this->hasMany('App\Blood_Pressure');
    }
    public function glucose(){
        return $this->hasMany('App\Glucose');
    }
    public function temperature(){
        return $this->hasMany('App\Temperature');
    }
    public function weight(){
        return $this->hasMany('App\Weight');
    }
    public function doctors(){
        return $this->belongsToMany('App\Doctor')->withPivot('subscribed')->withTimestamps();
    }
    public function patients(){
        return $this->belongsToMany('App\Patient','patient_patient','viewer_id','view_id')->withTimestamps();
    }
    public function getID(){
        return $this->id;
    }
}
