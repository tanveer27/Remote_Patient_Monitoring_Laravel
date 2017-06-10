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

 <?php
    $patient_weight="N/A";
     $weight=\App\Weight::where('patient_id',$patient->id)->orderBy('id','desc')->first();
    	if($weight!=null){
    		$patient_weight=$weight->weight;	
    	}
    ?>

<div class="personalinfo">

    <div class="row">

        <div class="col-md-6">

            <h3 style="color: #5bbed8">Personal Information</h3> <br>

            <p><strong>First Name :</strong> {{$patient->patient_first_name}}</p>
            <p><strong>Last Name :</strong> {{$patient->patient_last_name}}</p>
            <p><strong>Sex :</strong> {{$patient->sex}}</p>
            <p><strong>Height :</strong> {{$patient->height}}</p>
            <p><strong>Weight :</strong> {{$patient_weight}}</p>
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

    
 @endsection
<?php $bp=$patient->blood_pressure()->get(); ?>

@section('table')

    <p id="bp_table">Blood Pressure Data Table</p>

        <table class="table table-bordered table-nonfluid">

            <thead>
                <td width="15%">Date</td>
                <td width="10%">Systolic</td>
                <td width="10%">Diastolic</td>
                <td width="10%">Patient Note</td>
                @if(auth()->user()->type==="doc")
                <td width="10%">Status</td>
                @endif
                <td width="10%">Report</td>
                <td width="35%">Prescription</td>
            </thead>
            @foreach($bp as $bp)
            <tr>
            	<td>{{$bp['updated_at']}}</td>
            	<td>{{$bp['systolic']}}</td>
                <td>{{$bp['diastolic']}}</td>
                <td>{{$bp['note']}}</td>
                @if(auth()->user()->type==="doc")
            	<td>{{$bp['bp_data_status']}}</td>
            	<td>
            		<a href="{!! route('bpreport', ['bp'=>$bp,'report'=>'consult']) !!}">Consult</a> <br>
            		<a href="{!! route('bpreport', ['bp'=>$bp,'report'=>'ok']) !!}">Ok</a>
            	</td>
                    <td>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/bpprescription') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-12">
                                <input type="hidden" class="form-control" id="" name="id" value={{$bp['id']}}>
                                <input type="text" class="form-control" id="" name="prescription" value=""> </div> <br>


                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Send
                                </button>
                            </div>

                        </form>
                    </td>
                @else
                    <?php $report=\App\Blood_Pressure_Report::where('bp_id',$bp->id)->first(); ?>
                    <td>{{$report['bp_report']}}</td>
                    <td>{{$report['prescription']}}</td>
                @endif
            </tr>
            @endforeach
        </table>

@endsection