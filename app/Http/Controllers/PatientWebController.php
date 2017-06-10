<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Patient;

class PatientWebController extends Controller
{
    public function getViews()
    {
        $id= auth()->user()->id;
        $user=Patient::where('user_id',$id)->first();
       if($user->patient_first_name=="")
        return redirect('/userProfile');
        $patient=$user->patients()->get();
        return view('user_home',compact('patient'));


    }
}
