<?php

namespace App\Http\Controllers;

use App\Blood_Pressure;
use App\Blood_Pressure_Report;
use App\Glucose;
use App\Events\UserUpdates;
use App\Glucose_Report;
use App\Http\Requests;
use App\Temperature;
use App\Temperature_Report;
use App\Weight;
use App\Weight_Report;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Doctor;
use App\Patient;
use App\SPO2;
use App\SPO2_Report;
use App\Activity;
use App\Activity_Report;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;
use App\ActivationService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     protected $activationService;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->activated){
        $type= auth()->user()->type;
        $id= auth()->user()->id;
        if($type=="doc") {
           // $doctor=new Doctor();
            //$doctor->create(['user_id'=>$id]);
           return redirect()->route('doctorHome');
        }
        else{
            return redirect()->route('patientHome');
        }
        }
        else{
        	return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
        }

    }
  
    public function doctorProfile()
    {

        return view('doctor_profile');

    }
    public function userProfile()
    {

        return view('user_profile');

    }
    public function doctorProfileUpdate(Request $request){
    	$name=null;
    	$id=$id= auth()->user()->id;
        if(isset($request['image'])){
        $file = $request['image'];
        $name=$id."_".$file->getClientOriginalName();
        $file->move(public_path().'/images/', $name);
        }
        
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
    public function userProfileUpdate(Request $request){
    	$name=null;
    	 $id=$id= auth()->user()->id;
        if(isset($request['image'])){
        $file = $request['image'];
        $name=$id."_".$file->getClientOriginalName();
        $file->move(public_path().'/images/', $name);
        }
       
        $first_name=$request['first_name'];
        $last_name=$request['last_name'];
        $sex=$request['sex'];
        $dob=$request['dob'];
        $height=$request['height'];
        $address=$request['address'];
        $bloodgroup=$request['bloodgroup'];
        $smoke=$request['smoke'];
        $alcohol=$request['alcohol'];
        $drug=$request['drug'];
        $allergy=$request['allergy'];
        $hepatitis=$request['hepatitis'];
        $fdh=$request['fdh'];
        $medication=$request['medication'];
        $patient= Patient::where('user_id',$id)->first();
        $patient->patient_first_name=$first_name;
        $patient->patient_last_name=$last_name;
        $patient->sex=$sex;
        $patient->dob=$dob;
        $patient->height=$height;
        $patient->address=$address;
        $patient->bloodgroup=$bloodgroup;
        $patient->smoke=$smoke;
        $patient->alcohol=$alcohol;
        $patient->drugs=$drug;
        $patient->hepatitis=$hepatitis;
        $patient->allergy=$allergy;
        $patient->fdh=$fdh;
        $patient->medication=$medication;
        $patient->image=$name;
        $patient->save();

        return redirect()->back();
    }
    public function viewPermit(Request $request){
        $id=auth()->user()->id;
        $view=Patient::where('user_id',$id)->first();
        $view_id=$view->id;
        $email=$request->only('email');
        $viewer= User::where('email',$email)->first();
        $viewer_id=$viewer->id;
        $patient= Patient::where('user_id',$viewer_id)->first();
        $patient->patients()->attach($view_id);
         Event::fire(new UserUpdates());
        return redirect()->back();

    }
    public function weightprescription(Request $request)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        $weight_id=$request['id'];
        $weight=Weight::where('id',$weight_id)->first();
        if(Weight_Report::where('weight_id',$weight_id)->where('doctor_id',$doctor_id)->exists()){
            $Rep=Weight_Report::where('weight_id',$weight_id)->where('doctor_id',$doctor_id)->first();
            $Rep->prescription=$request['prescription'];
            $Rep->save();
            $weight->weight_data_status="seen";
            $weight->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Weight_Report();
        $Rep->prescription=$request['prescription'];
        $Rep->doctor_id=$doctor_id;
        $Rep->weight_id=$weight_id;
        $Rep->save();
        $weight->weight_data_status="seen";
        $weight->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function tempprescription(Request $request)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        $temp_id=$request['id'];
        $temp=Temperature::where('id',$temp_id)->first();
        if(Temperature_Report::where('temperature_id',$temp_id)->where('doctor_id',$doctor_id)->exists()){
            $Rep=Temperature_Report::where('temperature_id',$temp_id)->where('doctor_id',$doctor_id)->first();
            $Rep->prescription=$request['prescription'];
            $Rep->save();
            $temp->temp_data_status="seen";
            $temp->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Temperature_Report();
        $Rep->prescription=$request['prescription'];
        $Rep->doctor_id=$doctor_id;
        $Rep->temperature_id=$temp_id;
        $Rep->save();
        $temp->temp_data_status="seen";
        $temp->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function glucoseprescription(Request $request)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        $glucose_id=$request['id'];
        $glucose=Glucose::where('id',$glucose_id)->first();
        if(Glucose_Report::where('glucose_id',$glucose_id)->where('doctor_id',$doctor_id)->exists()){
            $Rep=Glucose_Report::where('glucose_id',$glucose_id)->where('doctor_id',$doctor_id)->first();
            $Rep->prescription=$request['prescription'];
            $Rep->save();
            $glucose->glucose_data_status="seen";
            $glucose->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Glucose_Report();
        $Rep->prescription=$request['prescription'];
         $Rep->doctor_id=$doctor_id;
        $Rep->glucose_id=$glucose_id;
        $Rep->save();
        $glucose->glucose_data_status="seen";
        $glucose->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function spo2prescription(Request $request)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        $spo2_id=$request['id'];
        $spo2=SPO2::where('id',$spo2_id)->first();
        if(SPO2_Report::where('spo2_id',$spo2_id)->where('doctor_id',$doctor_id)->exists()){
            $Rep=SPO2_Report::where('spo2_id',$spo2_id)->where('doctor_id',$doctor_id)->first();
            $Rep->prescription=$request['prescription'];
            $Rep->save();
            $spo2->spo2_data_status="seen";
            $spo2->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new SPO2_Report();
        $Rep->prescription=$request['prescription'];
        $Rep->doctor_id=$doctor_id;
        $Rep->spo2_id=$spo2_id;
        $Rep->save();
        $spo2->spo2_data_status="seen";
        $spo2->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
     public function activityprescription(Request $request)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        $activity_id=$request['id'];
        $activity=Activity::where('id',$activity_id)->first();
        if(Activity_Report::where('activity_id',$activity_id)->where('doctor_id',$doctor_id)->exists()){
            $Rep=Activity_Report::where('activity_id',$activity_id)->where('doctor_id',$doctor_id)->first();
            $Rep->prescription=$request['prescription'];
            $Rep->save();
            $activity->activity_data_status="seen";
            $activity->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Activity_Report();
        $Rep->prescription=$request['prescription'];
        $Rep->doctor_id=$doctor_id;
        $Rep->activity_id=$activity_id;
        $Rep->save();
        $activity->activity_data_status="seen";
        $activity->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function bpprescription(Request $request)
    {
        $id=$id= auth()->user()->id;
        $doctor= Doctor::where('user_id',$id)->first();
        $doctor_id=$doctor->id;
        $bp_id=$request['id'];
        $bp=Blood_Pressure::where('id',$bp_id)->first();
        if(Blood_Pressure_Report::where('bp_id',$bp_id)->where('doctor_id',$doctor_id)->exists()){
            $Rep=Blood_Pressure_Report::where('bp_id',$bp_id)->where('doctor_id',$doctor_id)->first();
            $Rep->prescription=$request['prescription'];
            $Rep->save();
            $bp->bp_data_status="seen";
            $bp->save();
            Event::fire(new UserUpdates());
            return redirect()->back();
        }
        $Rep=new Blood_Pressure_Report();
        $Rep->prescription=$request['prescription'];
        $Rep->doctor_id=$doctor_id;
        $Rep->bp_id=$bp_id;
        $Rep->save();
        $bp->bp_data_status="seen";
        $bp->save();
        Event::fire(new UserUpdates());
        return redirect()->back();


    }
    public function webSubscribe(Doctor $doctor){

        $user_id=auth()->user()->id;
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        //$patient_id=$patient['patient_id'];
        $doctor->patients()->attach($patient_id);
        Event::fire(new UserUpdates());
        return back();

    }
    public function webUnSubscribe(Doctor $doctor){

        $user_id=auth()->user()->id;
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        //$patient_id=$patient['patient_id'];
        $doctor->patients()->detach($patient_id);
         Event::fire(new UserUpdates());
        return back();

    }
    public function doctorList(){

        if(auth()->user()){
        $doctors= Doctor::all();
        return view('doctor_list')->with('doctors',$doctors);
        }
        return view('welcome');

    }
    public function prescriptionOverview(Patient $patient){

	if(auth()->user()){
	return view('prescription')->with('patient',$patient);
	}
	return view('welcome');

    }
}
