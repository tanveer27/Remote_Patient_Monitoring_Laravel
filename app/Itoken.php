<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itoken extends Model
{
     protected $table='itoken';
    protected $fillable = [
        'u_id', 'itoken','refresh_token','exp','exp_refresh'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
