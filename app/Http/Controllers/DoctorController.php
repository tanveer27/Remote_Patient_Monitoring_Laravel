<?php

namespace App\Http\Controllers;

use App\Blood_Pressure;
use App\SPO2;
use App\SPO2_Report;
use App\Blood_Pressure_Report;
use App\Doctor;
use App\Events\UserUpdates;
use App\Glucose;
use App\Glucose_Report;
use App\Temperature;
use App\Temperature_Report;
use App\Activity;
use App\Activity_Report;
use App\Weight;
use App\Weight_Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Http\Requests;
use App\Patient;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function getPatients()
    {
        $id= auth()->user()->id;
        $doctor=Doctor::where('user_id',$id)->first();
        if($doctor->doctor_first_name=="")
        return redirect('/doctorProfile');
        $patient=$doctor->patients()->get();
        return view('home',compact('patient'));


    }
    public function bloodpressure(Patient $patient)
    {

        return view('bloodpressure')->with('patient',$patient);

    }
    public function patient_information(Patient $patient)
    {

        return view('patient_information')->with('patient',$patient);

    }
     public function confirmSubscribe(Patient $patient)
    {
	$id= auth()->user()->id;
        $doctor=Doctor::where('user_id',$id)->first();
        $doctor->patients()->updateExistingPivot($patient->id, ['subscribed' => 1]);
        return back();

    }
    public function bpreport(Blood_Pressure $bp,$report)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        if(Blood_Pressure_Report::where('bp_id',$bp->id)->exists()){
            $Rep=Blood_Pressure_Report::where('bp_id',$bp->id)->first();
            $Rep->bp_report=$report;
            $Rep->bp_report_status="unseen";
            $Rep->doctor_id=$doctor_id;
            $Rep->save();
            $bp->bp_data_status="seen";
            $bp->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Blood_Pressure_Report();
        $Rep->bp_report=$report;
        $Rep->bp_id=$bp->id;
        $Rep->bp_report_status="unseen";
        $Rep->doctor_id=$doctor_id;
        $Rep->save();
        $bp->bp_data_status="seen";
        $bp->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function spo2report(SPO2 $spo2,$report)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        if(SPO2_Report::where('spo2_id',$spo2->id)->exists()){
            $Rep=SPO2_Report::where('spo2_id',$spo2->id)->first();
            $Rep->spo2_report=$report;
            $Rep->spo2_report_status="unseen";
            $Rep->doctor_id=$doctor_id;
            $Rep->save();
            $spo2->spo2_data_status="seen";
            $spo2->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new SPO2_Report();
        $Rep->spo2_report=$report;
        $Rep->spo2_id=$spo2->id;
        $Rep->spo2_report_status="unseen";
        $Rep->doctor_id=$doctor_id;
        $Rep->save();
        $spo2->spo2_data_status="seen";
        $spo2->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    
     public function activityreport(Activity $activity,$report)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        if(Activity_Report::where('activity_id',$activity->id)->exists()){
            $Rep=Activity_Report::where('activity_id',$activity->id)->first();
            $Rep->activity_report=$report;
            $Rep->activity_report_status="unseen";
            $Rep->doctor_id=$doctor_id;
            $Rep->save();
            $activity->activity_data_status="seen";
            $activity->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Activity_Report();
        $Rep->activity_report=$report;
        $Rep->activity_id=$activity->id;
        $Rep->activity_report_status="unseen";
        $Rep->doctor_id=$doctor_id;
        $Rep->save();
        $activity->activity_data_status="seen";
        $activity->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }

    public function tempreport(Temperature $temp,$report)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        if(Temperature_Report::where('temperature_id',$temp->id)->exists()){
            $Rep=Temperature_Report::where('temperature_id',$temp->id)->first();
            $Rep->temp_report=$report;
            $Rep->temp_report_status="unseen";
            $Rep->doctor_id=$doctor_id;
            $Rep->save();
            $temp->temp_data_status="seen";
            $temp->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Temperature_Report();
        $Rep->temp_report=$report;
        $Rep->temperature_id=$temp->id;
        $Rep->temp_report_status="unseen";
        $Rep->doctor_id=$doctor_id;
        $Rep->save();
        $temp->temp_data_status="seen";
        $temp->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function temperature(Patient $patient)
    {

        return view('temperature')->with('patient',$patient);

    }
    public function glucose(Patient $patient)
    {

        return view('glucose')->with('patient',$patient);

    }
    public function glucosereport(Glucose $glucose,$report)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        if(Glucose_Report::where('glucose_id',$glucose->id)->exists()){
            $Rep=Glucose_Report::where('glucose_id',$glucose->id)->first();
            $Rep->glucose_report=$report;
            $Rep->glucose_report_status="unseen";
            $Rep->doctor_id=$doctor_id;
            $Rep->save();
            $glucose->glucose_data_status="seen";
            $glucose->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Glucose_Report();
        $Rep->glucose_report=$report;
        $Rep->glucose_id=$glucose->id;
        $Rep->glucose_report_status="unseen";
        $Rep->doctor_id=$doctor_id;
        $Rep->save();
        $glucose->glucose_data_status="seen";
        $glucose->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function weight(Patient $patient)
    {

        return view('weight')->with('patient',$patient);

    }
    public function spo2(Patient $patient)
    {

        return view('spo2')->with('patient',$patient);

    }
    
     public function activity(Patient $patient)
    {

        return view('activity')->with('patient',$patient);

    }
    public function weightreport(Weight $weight,$report)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        if(Weight_Report::where('weight_id',$weight->id)->where('doctor_id',$doctor_id)->exists()){
            $Rep=Weight_Report::where('weight_id',$weight->id)->where('doctor_id',$doctor_id)->first();
            $Rep->weight_report=$report;
            $Rep->weight_report_status="unseen";
            $Rep->doctor_id=$doctor_id;
            $Rep->save();
            $weight->weight_data_status="seen";
            $weight->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Weight_Report();
        $Rep->weight_report=$report;
        $Rep->weight_id=$weight->id;
        $Rep->weight_report_status="unseen";
        $Rep->doctor_id=$doctor_id;
        $Rep->save();
        $weight->weight_data_status="seen";
        $weight->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function profileUpdate(Request $request){
    	$name=null;
        if(isset($request['image'])){
        $file = $request['image'];
        $name=$file->getClientOriginalName();
        $file->move(public_path().'/images/', $name);
        }
        $id=$id= auth()->user()->id;
        $first_name=$request['first_name'];
        $last_name=$request['last_name'];
        $degree=$request['degree'];
        $speciality=$request['speciality'];
        $hospital=$request['hospital'];
        $consulting_hour=$request['consulting_hour'];
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor->doctor_first_name=$first_name;
        $doctor->doctor_last_name=$last_name;
        $doctor->degree=$degree;
        $doctor->speciality=$speciality;
        $doctor->hospital=$hospital;
        $doctor->consulting_hour=$consulting_hour;
        $doctor->image=$name;
        $doctor->save();

        return redirect()->back();
    }
}
