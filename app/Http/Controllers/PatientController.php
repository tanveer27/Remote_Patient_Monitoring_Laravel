<?php

namespace App\Http\Controllers;

use App\Blood_Pressure;
use App\Blood_Pressure_Report;
use App\Glucose_Report;
use App\Events\UserUpdates;
use App\Temperature;
use App\Temperature_Report;
use App\Weight;
use App\Weight_Report;
use App\SPO2;
use App\SPO2_Report;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Http\Requests;
use App\Doctor;
use App\Patient;
use App\User;
use App\Itoken;
use DB;
use App\Glucose;
use App\Activity;
use App\Activity_Report;

class PatientController extends Controller
{
    use Helpers;
    public function subscribe(Request $request){
        $user = $this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $doctor_id=$request->only('doctor_id');
       $doctor= Doctor::find($doctor_id)->first();
       $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        //$patient_id=$patient['patient_id'];
        $doctor->patients()->attach($patient_id);
        Event::fire(new UserUpdates());
        return response()->json("Successfully Subscribed");

    }
    
    public function itoken(Request $request){
        $user = $this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $u_id=$request['UserID'];
        $accesstoken=$request['AccessToken'];
        $exp=$request['Expires'];
        $refresh=$request['RefreshToken'];
        $refresh_exp=$request['RefreshTokenExpires'];
        $device=$request['device'];
        $itok= Itoken::where('user_id',$user_id)->where('device',$device)->first();
        if(!empty($itok)) {
        
            if(!($u_id=="")){
            	$itok->u_id=$u_id;
            }
            if(!($accesstoken=="")){
            $itok->itoken=$accesstoken;}
            if(!($exp=="")){
            $itok->exp=$exp;}
            if(!($refresh=="")){
            $itok->refresh_token=$refresh;}
            if(!($refresh_exp=="")){
            $itok->exp_refresh=$refresh_exp;}
            if(!($device=="")){
            $itok->device=$device;}
            $itok->save();
 
        
        }
        else{
            $itok=new Itoken();
            $itok->user_id=$user_id;
            $itok->u_id=$u_id;
            $itok->itoken=$accesstoken;
            $itok->exp=$exp;
            $itok->refresh_token=$refresh;
            $itok->exp_refresh=$refresh_exp;
            $itok->device=$device;
            $itok->save();   
        }
        return "done";

    }
    public function enterBpData(Request $request){
        //$systolic=$request['systolic'];
        //$diastolic=$request['diastolic'];
        
        // Roaim's work starts here...
        $json = $request['data'];
       
        $decoded_json = json_decode($json);
        $device=$request['device'];
        $data_array = $decoded_json->BPDataList; //note: BPDATALIST is for bp only for others refer to the ihealth doc.
         if(count($data_array)==0) return "empty data";
        //return $data_array;
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        DB::beginTransaction();
        
            foreach ($data_array as $data) {
            $DataID = $data->DataID;
            $systolic = $data->HP;
            $diastolic = $data->LP;
            $Note = $data->Note;
            $created_at=$data->MDate;
            //add data to bp object here according to the righ params here...
            try{
            DB::table('bloodpressures')->insert([['systolic' => $systolic, 'diastolic' => $diastolic,'data_id'=>$DataID,'note'=>$Note,'patient_id'=>$patient_id,'bp_data_status'=>"unseen",'device'=>$device]]);
            }
            catch (\Illuminate\Database\QueryException $e){
                //$errorCode = $e->errorInfo[1];
                //if($errorCode == 1062){
        // houston, we have a duplicate entry problem
               // }
               // else{
               //     DB::rollback();
               // }
             }
             }
             DB::commit();        
        // end transaction 
        // Roaim's work ends here...
        
        //$user=$this->api->get('authenticatedUser');
        //$user_id=$user['id'];
        //$bp=new Blood_Pressure;
        //$bp->systolic=$systolic;
        //$bp->diastolic=$diastolic;
        //$bp->bp_data_status="unseen";
        //$patient= Patient::where('user_id',$user_id)->first();
        //$patient->blood_pressure()->save($bp);
        Event::fire(new UserUpdates());
        return 'Successful';

    }
    public function enterGlucoseData(Request $request){
        $json = $request['data'];
       
        $decoded_json = json_decode($json);
        $device=$request['device'];
        $data_array = $decoded_json->BGDataList; //note: BPDATALIST is for bp only for others refer to the ihealth doc.
         if(count($data_array)==0) return "empty data";
        //return $data_array;
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        DB::beginTransaction();
        
            foreach ($data_array as $data) {
            $bg=intval($data->BG)/18;
            $DataID = $data->DataID;
            $Glucose = $bg;
            $DinnerSituation = $data->DinnerSituation;
            $Note = $data->Note;
            $created_at=$data->MDate;
            //add data to bp object here according to the righ params here...
            try{
            DB::table('glucoses')->insert([['glucose' => $Glucose, 'dinner_situation' => $DinnerSituation,'data_id'=>$DataID,'note'=>$Note,'patient_id'=>$patient_id,'glucose_data_status'=>"unseen",'device'=>$device]]);
            }
            catch (\Illuminate\Database\QueryException $e){
            	
                //$errorCode = $e->errorInfo[1];
                //if($errorCode == 1062){
        // houston, we have a duplicate entry problem
               // }
               // else{
               //     DB::rollback();
               // }
             }
             }
             DB::commit();        
        // end transaction 
        // Roaim's work ends here...
        
        //$user=$this->api->get('authenticatedUser');
        //$user_id=$user['id'];
        //$bp=new Blood_Pressure;
        //$bp->systolic=$systolic;
        //$bp->diastolic=$diastolic;
        //$bp->bp_data_status="unseen";
        //$patient= Patient::where('user_id',$user_id)->first();
        //$patient->blood_pressure()->save($bp);
        Event::fire(new UserUpdates());
        return 'Successful';

    }
    public function enterTemperatureData(Request $request){
        $body_temperature=floatval($request['body_temperature']);
        $temp=floatval($body_temperature)*.18+32;
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $temperature=new Temperature();
        $temperature->body_temperature=$temp;
        $temperature->temp_data_status="unseen";
        $temperature->device="withings";
        $temperature->patient_id=$patient->id;
        $temperature->save();
        Event::fire(new UserUpdates());
        return response()->json('Temperature Upload Successful!');

    }
    public function getDoctorList(){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $doctor=Doctor::all();
        return response()->json($doctor);

    }
    public function getBpReports(){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient['id'];
        //$bplist=Blood_Pressure::where('patient_id',$patient_id)->where('bp_data_status','seen')->get();
       // $bpreport =array();
        $report;
        //foreach($bplist as $bp){  
        $report=DB::table('blood_pressure_reports')->join('bloodpressures', 'blood_pressure_reports.bp_id', '=', 'bloodpressures.id')->join('doctors', 'blood_pressure_reports.doctor_id', '=', 'doctors.id')->where('bloodpressures.patient_id',$patient_id)->where('bloodpressures.bp_data_status','seen')->get(); 
        //$report = Blood_Pressure_Report::where('bp_id',$bp['id'])->get();
        //if($report!=null){
            //$doctor=Doctor::where('id',$report->doctor_id)->first();
            //$bpreport[]=array_merge($bp->toArray(), $report->toArray());
           //}
           //$bpreport[]=Blood_Pressure_Report::where('bp_id',$bp['id'])->get();
       //}
        return response()->json($report);
        //return json_encode($bpreport);
    }
    public function getBpData(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $data_id=$request['data_id'];
        $bpdata=Blood_Pressure::where('id',$data_id)->first();
        $bpreport= Blood_Pressure_Report::where('bp_id',$data_id)->first();
        $bpreport->bp_report_status="seen";
       $bpreport->save();
        return response()->json($bpdata);
        //return json_encode($bpdata);
    }
    public function getGlucoseReports(){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient['id'];
        //$glucoselist=Glucose::where('patient_id',$patient_id)->where('glucose_data_status','seen')->get();
        //$glucosereport =array();
        $report;
        //foreach($glucoselist as $glucose){
            $report=DB::table('glucose_reports')->join('glucoses', 'glucose_reports.glucose_id', '=', 'glucoses.id')->join('doctors', 'glucose_reports.doctor_id', '=', 'doctors.id') ->where('glucoses.patient_id',$patient_id)->where('glucoses.glucose_data_status','seen')->get();
            //$report=Glucose_Report::where('glucose_id',$glucose['id'])->get();
           // if($report!=null){
            //$doctor=Doctor::where('id',$report->doctor_id)->first();
           //$glucosereport[]= array_merge($glucose->toArray(), $report->toArray(),$doctor->toArray());;
           //}
        //}
        return response()->json($report);
    }
    public function getGlucoseData(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $data_id=$request['data_id'];
        $glucosedata=Glucose::where('id',$data_id)->first();
        $glucosereport= Glucose_Report::where('glucose_id',$data_id)->first();
        $glucosereport->glucose_report_status="seen";
        $glucosereport->save();
        return response()->json($glucosedata);
    }
    public function getTemperatureReports(){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient['id'];
        //$templist=Temperature::where('patient_id',$patient_id)->where('temp_data_status','seen')->get();
        //$tempreport =array();
        $report;
        //foreach($templist as $temp){
        	$report=DB::table('temperature_reports')->join('temperatures', 'temperature_reports.temperature_id', '=', 'temperatures.id')->join('doctors', 'temperature_reports.doctor_id', '=', 'doctors.id') ->where('temperatures.patient_id',$patient_id)->where('temperatures.temp_data_status','seen')->get();
        	//$report= Temperature_Report::where('temperature_id',$temp['id'])->get();
        	//if($report!=null){
        		//$doctor=Doctor::where('id',$report->doctor_id)->first();
            		//$tempreport[]= array_merge($temp->toArray(), $report->toArray(),$doctor->toArray());
            //}
        //}
        return response()->json($report);
    }
    public function getTemperatureData(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $data_id=$request['data_id'];
        $tempdata=Temperature::where('id',$data_id)->first();
        $tempreport= Temperature_Report::where('temperature_id',$data_id)->first();
        $tempreport->temp_report_status="seen";
        $tempreport->save();
        return response()->json($tempdata);
    }
    public function getWeightReports(){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient['id'];
        //$weightlist=Weight::where('patient_id',$patient_id)->where('weight_data_status','seen')->get();
        //$weightreport =array();
        $report;
        //foreach($weightlist as $weight){
            $report=DB::table('weight_reports')->join('weights', 'weight_reports.weight_id', '=', 'weights.id')->join('doctors', 'weight_reports.doctor_id', '=', 'doctors.id') ->where('weights.patient_id',$patient_id)->where('weights.weight_data_status','seen')->get();
            //$report=Weight_Report::where('weight_id',$weight['id'])->get();
            //if($report!=null){
            //$doctor=Doctor::where('id',$report->doctor_id)->first();
           //$weightreport[]= array_merge($weight->toArray(), $report->toArray(),$doctor->toArray());
          // }
       // }
        return response()->json($report);
    }
    public function getWeightData(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $data_id=$request['data_id'];
        $weightdata=Weight::where('id',$data_id)->first();
        $weightreport= Weight_Report::where('weight_id',$data_id)->first();
        $weightreport->weight_report_status="seen";
        $weightreport->save();
        return response()->json($weightdata);
    }
    public function enterWeightData(Request $request){
        $json = $request['data'];
       
        $decoded_json = json_decode($json);
        $device=$request['device'];
        $data_array = $decoded_json->WeightDataList;
        
         //note: BPDATALIST is for bp only for others refer to the ihealth doc.
         if(count($data_array)==0) return "empty data";
        //return $data_array;
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        DB::beginTransaction();
        
            foreach ($data_array as $data) {
            $DataID = $data->DataID;
            $Weight = $data->WeightValue;
            $BMI = $data->BMI;
            $Note = $data->Note;
            $created_at=$data->MDate;
            //add data to bp object here according to the righ params here...
            try{
            DB::table('weights')->insert([['weight' => $Weight, 'bmi' => $BMI,'data_id'=>$DataID,'note'=>$Note,'patient_id'=>$patient_id,'weight_data_status'=>"unseen",'device'=>$device]]);
            }
            catch (\Illuminate\Database\QueryException $e){
                //$errorCode = $e->errorInfo[1];
                //if($errorCode == 1062){
        // houston, we have a duplicate entry problem
               // }
               // else{
               //     DB::rollback();
               // }
             }
             }
             DB::commit();        
        // end transaction 
        // Roaim's work ends here...
        
        //$user=$this->api->get('authenticatedUser');
        //$user_id=$user['id'];
        //$bp=new Blood_Pressure;
        //$bp->systolic=$systolic;
        //$bp->diastolic=$diastolic;
        //$bp->bp_data_status="unseen";
        //$patient= Patient::where('user_id',$user_id)->first();
        //$patient->blood_pressure()->save($bp);
        Event::fire(new UserUpdates());
        return 'Successful';

    }
    public function enterSPO2Data(Request $request){
        //$systolic=$request['systolic'];
        //$diastolic=$request['diastolic'];
        
        // Roaim's work starts here...
        $json = $request['data'];
       
        $decoded_json = json_decode($json);
        $device=$request['device'];
        $data_array = $decoded_json->BODataList; //note: BPDATALIST is for bp only for others refer to the ihealth doc.
         if(count($data_array)==0) return "empty data";
        //return $data_array;
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        DB::beginTransaction();
        
            foreach ($data_array as $data) {
            $DataID = $data->DataID;
            $blood_oxygen = $data->BO;
            $heart_rate = $data->HR;
            $Note = $data->Note;
            $created_at=$data->MDate;
            //add data to bp object here according to the righ params here...
            try{
            DB::table('spo2')->insert([['blood_oxygen' => $blood_oxygen, 'heart_rate' => $heart_rate,'data_id'=>$DataID,'note'=>$Note,'patient_id'=>$patient_id,'spo2_data_status'=>"unseen",'device'=>$device]]);
            }
            catch (\Illuminate\Database\QueryException $e){
                //$errorCode = $e->errorInfo[1];
                //if($errorCode == 1062){
        // houston, we have a duplicate entry problem
               // }
               // else{
               //     DB::rollback();
               // }
             }
             }
             DB::commit();        
        // end transaction 
        // Roaim's work ends here...
        
        //$user=$this->api->get('authenticatedUser');
        //$user_id=$user['id'];
        //$bp=new Blood_Pressure;
        //$bp->systolic=$systolic;
        //$bp->diastolic=$diastolic;
        //$bp->bp_data_status="unseen";
        //$patient= Patient::where('user_id',$user_id)->first();
        //$patient->blood_pressure()->save($bp);
        Event::fire(new UserUpdates());
        return 'Successful';

    }
    public function getSPO2Reports(){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient['id'];
        //$spo2list=SPO2::where('patient_id',$patient_id)->where('spo2_data_status','seen')->get();
        //$spo2report =array();
        $report;
        //foreach($spo2list as $spo2){
            $report=DB::table('spo2_report')->join('spo2', 'spo2_report.spo2_id', '=', 'spo2.id')->join('doctors', 'spo2_report.doctor_id', '=', 'doctors.id') ->where('spo2.patient_id',$patient_id)->where('spo2.spo2_data_status','seen')->get();
            //$report=SPO2_Report::where('spo2_id',$spo2['id'])->get();
            //if($report!=null){
            //$doctor=Doctor::where('id',$report->doctor_id)->first();
           //$spo2report[]= array_merge($spo2->toArray(), $report->toArray(),$doctor->toArray());
           //}
        //}
        return response()->json($report);
    }
    public function getSPO2Data(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $data_id=$request['data_id'];
        $spo2data=SPO2::where('id',$data_id)->first();
        $spo2report= SPO2_Report::where('spo2_id',$data_id)->first();
        $spo2report->spo2_report_status="seen";
        $spo2report->save();
        return response()->json($spo2data);
    }
    public function enterActivityData(Request $request){
        //$systolic=$request['systolic'];
        //$diastolic=$request['diastolic'];

        // Roaim's work starts here...
        $json = $request['data'];

        $decoded_json = json_decode($json);
        $device=$request['device'];
        $data_array = $decoded_json->ARDataList; //note: BPDATALIST is for bp only for others refer to the ihealth doc.
        if(count($data_array)==0) return "empty data";
        //return $data_array;
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        DB::beginTransaction();

        foreach ($data_array as $data) {
            $steps = $data->Steps;
            $distance = $data->DistanceTraveled;
            $calories = $data->Calories;
            $dataid=$data->DataID;
            //add data to bp object here according to the righ params here...
            try{
                DB::table('activity')->insert([['steps' => $steps, 'distance' => $distance,'calories'=>$calories,'patient_id'=>$patient_id,'activity_data_status'=>"unseen",'data_id'=>$dataid,'device'=>$device]]);
            }
            catch (\Illuminate\Database\QueryException $e){
                //$errorCode = $e->errorInfo[1];
                //if($errorCode == 1062){
                // houston, we have a duplicate entry problem
                // }
                // else{
                //     DB::rollback();
                // }
            }
        }
        DB::commit();
        // end transaction
        // Roaim's work ends here...

        //$user=$this->api->get('authenticatedUser');
        //$user_id=$user['id'];
        //$bp=new Blood_Pressure;
        //$bp->systolic=$systolic;
        //$bp->diastolic=$diastolic;
        //$bp->bp_data_status="unseen";
        //$patient= Patient::where('user_id',$user_id)->first();
        //$patient->blood_pressure()->save($bp);
        Event::fire(new UserUpdates());
        return 'Successful';

    }
    public function getActivityReports(){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient['id'];
        //$spo2list=SPO2::where('patient_id',$patient_id)->where('spo2_data_status','seen')->get();
        //$spo2report =array();
        $report;
        //foreach($spo2list as $spo2){
        $report=DB::table('activity_reports')->join('activity', 'activity_reports.activity_id', '=', 'activity.id')->join('doctors', 'activity_reports.doctor_id', '=', 'doctors.id') ->where('activity.patient_id',$patient_id)->where('activity.activity_data_status','seen')->get();
        //$report=SPO2_Report::where('spo2_id',$spo2['id'])->get();
        //if($report!=null){
        //$doctor=Doctor::where('id',$report->doctor_id)->first();
        //$spo2report[]= array_merge($spo2->toArray(), $report->toArray(),$doctor->toArray());
        //}
        //}
        return response()->json($report);
    }
    public function getActivityData(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $data_id=$request['data_id'];
        $activitydata=Activity::where('id',$data_id)->first();
        $activityreport= Activity_Report::where('activity_id',$data_id)->first();
        $activityreport->activity_report_status="seen";
        $activityreport->save();
        return response()->json($activitydata);
    }
    public function getPrescriptions(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient['id'];
        $spo2presc="";
        $bppresc="";
        $temppresc="";
        $weightpresc="";
        $glucosepresc="";
        $activitypresc="";
        $spo2=DB::table('spo2')->join('spo2_report', 'spo2.id', '=', 'spo2_report.spo2_id')->where('spo2.patient_id',$patient_id)->where('spo2_report.prescription','<>', '')->orderBy('spo2.id', 'desc')->first();
	$bp=DB::table('bloodpressures')->join('blood_pressure_reports', 'bloodpressures.id', '=', 'blood_pressure_reports.bp_id')->where('bloodpressures.patient_id',$patient_id)->where('blood_pressure_reports.prescription','<>', '')->orderBy('bloodpressures.id', 'desc')->first();
			$temp=DB::table('temperatures')->join('temperature_reports', 'temperatures.id', '=', 'temperature_reports.temperature_id')->where('temperatures.patient_id',$patient_id)->where('temperature_reports.prescription','<>', '')->orderBy('temperatures.id', 'desc')->first();
			$glucose=DB::table('glucoses')->join('glucose_reports', 'glucoses.id', '=', 'glucose_reports.glucose_id')->where('glucoses.patient_id',$patient_id)->where('glucose_reports.prescription','<>', '')->orderBy('glucoses.id', 'desc')->first();
			$weight=DB::table('weights')->join('weight_reports', 'weights.id', '=', 'weight_reports.weight_id')->where('weights.patient_id',$patient_id)->where('weight_reports.prescription','<>', '')->orderBy('weights.id', 'desc')->first();
			$activity=DB::table('activity')->join('activity_reports', 'activity.id', '=', 'activity_reports.activity_id')->where('activity.patient_id',$patient_id)->where('activity_reports.prescription','<>', '')->orderBy('activity.id', 'desc')->first();
	if($activity!=null)
	$activitypresc=$activity->prescription;
	if($bp!=null)
	$bppresc=$bp->prescription;
	if($weight!=null)
	$weightpresc=$weight->prescription;
	if($temp!=null)
	$temppresc=$temp->prescription;
	if($glucose!=null)
	$glucosepresc=$glucose->prescription;
	if($spo2!=null)
	$spo2presc=$spo2->prescription;		
        return json_encode(array("activity"=>$activitypresc,"bp"=>$bppresc,"weight"=>$weightpresc,"temp"=>$temppresc,"glucose"=>$glucosepresc,"spo2"=>$spo2presc));
    }
    public function updateProfile(Request $request){
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $first_name=$request['first_name'];
        $last_name=$request['last_name'];
        $sex=$request['sex'];
        $dob=$request['dob'];
        $height=$request['height'];
        $weight=$request['weight'];
        $address=$request['address'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient->patient_first_name=$first_name;
        $patient->patient_last_name=$last_name;
        $patient->sex=$sex;
        $patient->dob=$dob;
        $patient->height=$height;
        $patient->weight=$weight;
        $patient->address=$address;
        $patient->save();
	Event::fire(new UserUpdates());
        return "Success";
    }
    public function enterWithingsData(Request $request){

        $ajson = $request['activities'];

        $activities = json_decode($ajson);
        $bjson=$request['body_measures'];
        $bodymeasures = json_decode($bjson);
        if((count($activities)==0)&&(count($bodymeasures)==0)) return "empty data";
        //return $data_array;
        $user=$this->api->get('authenticatedUser');
        if(!array_key_exists("id",$user)){
            return "token mismatch";
        }
        $user_id=$user['id'];
        $patient= Patient::where('user_id',$user_id)->first();
        $patient_id=$patient->id;
        DB::beginTransaction();

        foreach ($activities as $activity) {
            $steps = $activity->steps;
            $distance = $activity->distance;
            $calories = $activity->calories;
            $dataid=$activity->totalcalories;
            //add data to bp object here according to the righ params here...
            try{
                DB::table('activity')->insert([['steps' => $steps, 'distance' => $distance,'calories'=>$calories,'patient_id'=>$patient_id,'activity_data_status'=>"unseen",'data_id'=>$dataid,'device'=>"withings"]]);
            }
            catch (\Illuminate\Database\QueryException $e){

            }
        }
        foreach($bodymeasures as $bodymeasure){
            $measures=$bodymeasure->measures;
            $dataid=$bodymeasure->grpid;
            if(count($measures)==1) {
                foreach ($measures as $measure) {
                    if ($measure->type == 1) {
                        $weight = intval($measure->value);
                        $weight=$weight/1000;
                        try {
                            DB::table('weights')->insert([['weight' => $weight, 'patient_id' => $patient_id, 'weight_data_status' => "unseen",'data_id'=>$dataid, 'device' => "withings"]]);
                        } catch (\Illuminate\Database\QueryException $e) {
                            //$errorCode = $e->errorInfo[1];
                            //if($errorCode == 1062){
                            // houston, we have a duplicate entry problem
                            // }
                            // else{
                            //     DB::rollback();
                            // }
                        }
                    } elseif ($measure->type == 71) {
                    	$unit=$measure->unit;
                        $reading = $measure->value;
                        $temperature=floatval($reading*pow(10,$unit)*1.8+32);
                        
                        try {
                            DB::table('temperatures')->insert([['body_temperature' => $temperature, 'patient_id' => $patient_id, 'temp_data_status' => "unseen",'data_id'=>$dataid, 'device' => "withings"]]);
                        } catch (\Illuminate\Database\QueryException $e) {
                            //$errorCode = $e->errorInfo[1];
                            //if($errorCode == 1062){
                            // houston, we have a duplicate entry problem
                            // }
                            // else{
                            //     DB::rollback();
                            // }
                        }
                    }
                }
            }
            else{
                $systolic=0;
                $diastolic=0;
                $spo2=0;
                $pulse=0;
                foreach ($measures as $measure) {
                    if($measure->type == 9){
                        $diastolic=$measure->value;
                    }
                    elseif ($measure->type == 10) {
                        $systolic = $measure->value;
                        try {
                            DB::table('bloodpressures')->insert([['systolic' => $systolic, 'diastolic' => $diastolic,'patient_id'=>$patient_id,'bp_data_status'=>"unseen",'data_id'=>$dataid,'device'=>"withings"]]);
                        } catch (\Illuminate\Database\QueryException $e) {
                            //$errorCode = $e->errorInfo[1];
                            //if($errorCode == 1062){
                            // houston, we have a duplicate entry problem
                            // }
                            // else{
                            //     DB::rollback();
                            // }
                        }
                    }
                    elseif($measure->type == 11){
                            $pulse=$measure->value;
                    }
                    elseif ($measure->type == 54) {
                        $spo2 = $measure->value;
                        try {
                            DB::table('spo2')->insert([['blood_oxygen' => $spo2, 'heart_rate' => $pulse,'patient_id'=>$patient_id,'spo2_data_status'=>"unseen",'data_id'=>$dataid,'device'=>"withings"]]);
                        } catch (\Illuminate\Database\QueryException $e) {
                            //$errorCode = $e->errorInfo[1];
                            //if($errorCode == 1062){
                            // houston, we have a duplicate entry problem
                            // }
                            // else{
                            //     DB::rollback();
                            // }
                        }
                    }
                }

            }
        }
        DB::commit();
        Event::fire(new UserUpdates());
        return 'Successful';

    }

}
