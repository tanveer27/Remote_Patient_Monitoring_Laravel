@extends('layouts.header')

	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('css/patient_information.css')}}" />
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>

  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@section('content')

	<div class="container-fluid">

		<div id="header">

      <h1 id="head1">Digital Health Care.BD <br>
      <small>An Online Based Health Care System</small></h1>

    </div>

    <div id="menu">

        <div class="row">

        <div class="col-md-4">
            <img src="{{asset('image/new8.png')}}" width="245px" height="245px" alt="miankoutt.com" name="miankoutt.com">
            
        </div>

        <div class="col-md-4">
            <img src="{{asset('image/new9.png')}}" width="245px" height="245px" alt="miankoutt.com" name="miankoutt.com">
        </div>
        <div class="col-md-4">
            <img src="{{asset('image/new5.jpg')}}" width="245px" height="245px" alt="miankoutt.com" name="miankoutt.com">
        </div>
            
        </div>
        
    </div>
    <?php
    $patient_weight="N/A";
     $weight=\App\Weight::where('patient_id',$patient->id)->orderBy('id','desc')->first();
    	if($weight!=null){
    		$patient_weight=$weight->weight;	
    	}
    ?>


    	<div class="content">

        <h2 id="patient_info">Patient's Information</h2>

        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mymodal">Personal Information</button>

        <!-- Modal -->
        <div class="modal fade" id="mymodal">
        <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Personal Information</h4>
        </div>

        <div class="modal-body">

          <img src="{{asset('images/').'/'.$patient->image}}" width="50%" height="300px" alt="patient image"> <br> <br>

          <p><strong>First Name : {{$patient->patient_first_name}}</strong></p>
          <br>
          <p><strong>Last Name : {{$patient->patient_last_name}}</strong></p> <br>
          <p><strong>Sex : {{$patient->sex}}</strong></p><br>
          <p><strong>Height : {{$patient->height}}</strong></p><br>
          <p><strong>Weight : {{$patient_weight}}</strong></p><br>
          <p><strong>Date of Birth : {{$patient->dob}}</strong></p><br>
          <p><strong>Address : {{$patient->address}}</strong></p>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
      
        </div>
        </div> <!-- personal info-->


        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mymodal2">Medical Information</button>

        <!-- Modal -->
        <div class="modal fade" id="mymodal2">
        <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Medical Information</h4>
        </div>

        <div class="modal-body">
          
          <p><strong>Blood Group : {{$patient->bloodgroup}}</strong></p>   <br>
          <p><strong>Smoker : {{$patient->smoke}}</strong></p>  <br>
          <p><strong>Alcohol : {{$patient->alcohol}}</strong></p> <br>
          <p><strong>Drug Addict : {{$patient->drugs}}</strong></p> <br>
          <p><strong>Hepatitis : {{$patient->hepatitis}}</strong></p> <br>
          <p><strong>Allergy : {{$patient->allergy}}</strong></p> <br>
          <p><strong>Family Diesaese History : {{$patient->fdh}}</strong></p> <br>
          <p><strong>Medications : {{$patient->medication}}</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
      
        </div>
        </div> <!--medical info-->

        <?php 
            $spo2presc=DB::table('spo2')->join('spo2_report', 'spo2.id', '=', 'spo2_report.spo2_id')->where('spo2.patient_id',$patient->id)->where('spo2_report.prescription','<>', '')->orderBy('spo2.id', 'desc')->first();
      $bppresc=DB::table('bloodpressures')->join('blood_pressure_reports', 'bloodpressures.id', '=', 'blood_pressure_reports.bp_id')->where('bloodpressures.patient_id',$patient->id)->where('blood_pressure_reports.prescription','<>', '')->orderBy('bloodpressures.id', 'desc')->first();
      $temppresc=DB::table('temperatures')->join('temperature_reports', 'temperatures.id', '=', 'temperature_reports.temperature_id')->where('temperatures.patient_id',$patient->id)->where('temperature_reports.prescription','<>', '')->orderBy('temperatures.id', 'desc')->first();
      $glucosepresc=DB::table('glucoses')->join('glucose_reports', 'glucoses.id', '=', 'glucose_reports.glucose_id')->where('glucoses.patient_id',$patient->id)->where('glucose_reports.prescription','<>', '')->orderBy('glucoses.id', 'desc')->first();
      $weightpresc=DB::table('weights')->join('weight_reports', 'weights.id', '=', 'weight_reports.weight_id')->where('weights.patient_id',$patient->id)->where('weight_reports.prescription','<>', '')->orderBy('weights.id', 'desc')->first();
      $activitypresc=DB::table('activity')->join('activity_reports', 'activity.id', '=', 'activity_reports.activity_id')->where('activity.patient_id',$patient->id)->where('activity_reports.prescription','<>', '')->orderBy('activity.id', 'desc')->first();        
      // $bppresc="";
      // $temppresc="";
      // $weightpresc="";
      // $glucosepresc="";
      // $spo2presc="";
      // $bp=\App\Blood_Pressure::where('patient_id',$patient->id)->orderBy('id', 'desc')->first();
      // $spo2=\App\SPO2::where('patient_id',$patient->id)->orderBy('id', 'desc')->first();
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
	//if($activitypresc==NULL)
	//$activitypresc="no data";
	//if($bppresc==NULL)
	//$bppresc="no data";
	//if($spo2presc==NULL)
	//$spo2presc="no data";
	//if($glucosepresc==NULL)
	//$glucosepresc="no data";
	//if($weightpresc==NULL)
	//$weightpresc="no data";
	//if($temppresc==NULL)
	//$temppresc="no data";
      
      
      
    ?>

        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mymodal3">Prescription</button>

        <!-- Modal -->
        <div class="modal fade" id="mymodal3">
        <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Prescription</h4>
        </div>

        <div class="modal-body">
          @if($weightpresc!=null)
          <p><strong>Weight : {{$weightpresc->prescription}} </strong></p>   <br>
          @endif
          @if($temppresc!=null)
          <p><strong>Temperature : {{$temppresc->prescription}} </strong></p>  <br>
          @endif
          @if($bppresc!=null)
          <p><strong>Bloodpressure : {{$bppresc->prescription}} </strong></p> <br>
          @endif
          @if($glucosepresc!=null)
          <p><strong>Glucose : {{$glucosepresc->prescription}} </strong></p> <br>
          @endif
          @if($spo2presc!=null)
          <p><strong>SPO2 : {{$spo2presc->prescription}} </strong></p> <br>
          @endif
          @if($activitypresc!=null)
          <p><strong>Pulse rate : {{$activitypresc->prescription}} </strong></p> <br>
      	  @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
      
        </div>
        </div> <!--prescription-->

    </div> <!--content-->

    <div class="well well-lg"><p>&copy; 2016 Digital Health Care.BD</p></div>

  </div> <!--containerfluid-->

@endsection

