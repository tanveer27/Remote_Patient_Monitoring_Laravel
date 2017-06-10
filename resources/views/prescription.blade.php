@extends('layouts.patient')

<link rel="stylesheet" type="text/css" href="{{asset('css/bloodpressure.css')}}">
<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
<script>
	 var pusher = new Pusher('77dedbd03132b3ece59d', {
      encrypted: true
    });
    var channel = pusher.subscribe('test');
    channel.bind('App\\Events\\UserUpdates', function(data) {
  	location.reload();
    });
</script>
@section('information')

	

<div class="personalinfo">

    <div class="row">

        <div class="col-md-6">

            <h3 style="color: #5bbed8">Personal Information</h3> <br>

            <p><strong>First Name :</strong> {{$patient->patient_first_name}}</p>
            <p><strong>Last Name :</strong> {{$patient->patient_last_name}}</p>
            <p><strong>Sex :</strong> {{$patient->sex}}</p>
            <p><strong>Height :</strong> {{$patient->height}}</p>
            <p><strong>Weight :</strong> {{$patient->weight}}</p>
            <p><strong>Date of Birth :</strong> {{$patient->dob}}</p>
            <p><strong>Address :</strong> {{$patient->address}}</p>
            
        </div>

        <div class="col-md-6">
            <img src="{{asset('images/').'/'.$patient->image}}" width="70%" height="300px" alt="patient image" style="border: 3px solid lightgrey">
        </div>
        
            
    </div> <br> <br>

    <div class="row">

        <div class="col-md-6">

            <h3 style="color: #5bbed8">Medical Information</h3> <br>

            <p><strong>Blood Group : </strong> {{$patient->bloodgroup}}</p>
            <p><strong>Smoker : </strong> {{$patient->smoke}}</p>
            <p><strong>Alcohol : </strong> {{$patient->alcohol}}</p>
            <p><strong>Drug Addict : </strong> {{$patient->drugs}}</p>
            <p><strong>Hepatitis : </strong> {{$patient->hepatitis}}</p>
            <p><strong>Allergy : </strong> {{$patient->allergy}}</p>
            <p><strong>Family Diesaese History : </strong> {{$patient->fdh}}</p>
            <p><strong>Medications : </strong> {{$patient->medication}}</p>
        </div>

            
    </div>
        
</div> <!--menu-->

		<h2 id="prescription">Prescription <br>
		<small>Your latest health prescription is here</small> </h2>

		<?php 
			
			$bppresc;
			$temppresc;
			$weightpresc;
			$glucosepresc;
			$spo2presc;
			$activitypresc;
			$spo2presc=DB::table('spo2')->join('spo2_report', 'spo2.id', '=', 'spo2_report.spo2_id')->where('spo2.patient_id',$patient->id)->where('spo2_report.prescription','<>', '')->orderBy('spo2.id', 'desc')->first();
			$bppresc=DB::table('bloodpressures')->join('blood_pressure_reports', 'bloodpressures.id', '=', 'blood_pressure_reports.bp_id')->where('bloodpressures.patient_id',$patient->id)->where('blood_pressure_reports.prescription','<>', '')->orderBy('bloodpressures.id', 'desc')->first();
			$temppresc=DB::table('temperatures')->join('temperature_reports', 'temperatures.id', '=', 'temperature_reports.temperature_id')->where('temperatures.patient_id',$patient->id)->where('temperature_reports.prescription','<>', '')->orderBy('temperatures.id', 'desc')->first();
			$glucosepresc=DB::table('glucoses')->join('glucose_reports', 'glucoses.id', '=', 'glucose_reports.glucose_id')->where('glucoses.patient_id',$patient->id)->where('glucose_reports.prescription','<>', '')->orderBy('glucoses.id', 'desc')->first();
			$weightpresc=DB::table('weights')->join('weight_reports', 'weights.id', '=', 'weight_reports.weight_id')->where('weights.patient_id',$patient->id)->where('weight_reports.prescription','<>', '')->orderBy('weights.id', 'desc')->first();
			$activitypresc=DB::table('activity')->join('activity_reports', 'activity.id', '=', 'activity_reports.activity_id')->where('activity.patient_id',$patient->id)->where('activity_reports.prescription','<>', '')->orderBy('activity.id', 'desc')->first();
			// $bp=\App\Blood_Pressure::where('patient_id',$patient->id)->where('bp_data_status',"seen")->orderBy('id', 'desc')->first();
			// $spo2=\App\SPO2::where('patient_id',$patient->id)->where('spo2_data_status',"seen")->orderBy('id', 'desc')->first();
			// $glucose=$patient->glucose()->where('glucose_data_status',"seen")->orderBy('id', 'desc')->first();
			// $temp=$patient->temperature()->where('temp_data_status',"seen")->orderBy('id', 'desc')->first();
			// $weight=$patient->weight()->where('weight_data_status',"seen")->orderBy('id', 'desc')->first();
			// if(!empty($weight)){
			// $weightrep=\App\Weight_Report::where('weight_id',$weight->id)->first();
			// if(!empty($weightrep)){
			// $weightpresc=$weightrep['prescription'];}
			// }
			// if(!empty($glucose)){
			// $glucoserep=\App\Glucose_Report::where('glucose_id',$glucose->id)->first();
			// if(!empty($glucoserep)){
			// $glucosepresc=$glucoserep['prescription'];}
			// }
			// if(!empty($temp)){
			// $temprep=\App\Temperature_Report::where('temperature_id',$temp->id)->first();
			// if(!empty($temprep)){
			// $temppresc=$temprep['prescription'];}
			// }
			
			// if(!empty($bp)){
			// $bprep=\App\Blood_Pressure_Report::where('bp_id',$bp->id)->first();
			// if(!empty($bprep)){
			// $bppresc=$bprep['prescription'];}
			// }
			// if(!empty($spo2)){
			// $spo2rep=\App\SPO2_Report::where('spo2_id',$spo2->id)->first();
			// if(!empty($spo2rep)){
			// $spo2presc=$spo2rep['prescription'];}
			// }
			
			
			
		?>
		<table class="table table-bordered table-nonfluid">

		<thead>
			<td width="20%">Health Parameters</td>
			<td width="50%">Prescription</td>
		</thead>

		<tr>
			<td>Weight</td>
			@if($weightpresc!=NULL)
			<td>{{$weightpresc->prescription}}</td>
			@else
			<td>No Data </td>
			@endif
		</tr>

		<tr>
			<td>Temperature</td>
			@if($temppresc!=NULL)
			<td>{{$temppresc->prescription}}</td>
			@else
			<td>No Data </td>
			@endif
		</tr>


		<tr>
			<td>Bloodpressure</td>
			@if($bppresc!=NULL)
			<td>{{$bppresc->prescription}}</td>
			@else
			<td>No Data </td>
			@endif

		</tr>
		<tr>
			<td>Glucose</td>
			@if($glucosepresc!=NULL)
			<td>{{$glucosepresc->prescription}}</td>
			@else
			<td>No Data </td>
			@endif
			
		</tr>
		<tr>
			<td>SPO2</td>
			@if($spo2presc!=NULL)
			<td>{{$spo2presc->prescription}}</td>
			@else
			<td>No Data </td>
			@endif
		</tr>
		
		<tr>
			<td>Activity</td>
			@if($activitypresc!=NULL)
			<td>{{$activitypresc->prescription}}</td>
			@else
			<td>No Data </td>
			@endif
		</tr>



		</table> <br><br>

		
	</div>	

 @endsection