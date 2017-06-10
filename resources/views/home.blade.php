@extends('layouts.header')

<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css')}}" >

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

@section('content')


<div class="container-fluid">

  <!--  <div id="cover-pic">

        <img src="{{asset('image/new1.jpg')}}" width="100%" height="350px" alt="clipartsgram.com" name="clipartsgram.com">
        
    </div> -->

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
    


    <div class="content"> <!--content-->
    

        <h2 id="head_2">Welcome, Doctor</h2>
         
        <p id="para_1">Check Patient's Health Data and give your feedback.</p>

       <!-- <p><img src="{{asset('image/img3.jpg')}}" width="287" height="97" alt="" />

        <img src="{{asset('image/img4.jpg')}}" width="287" height="97" alt="" /> </p> <br> -->
           

        <table class="table table-bordered table-nonfluid">

           <thead>

           <td width="14%">Id</td>
           <td width="9.5%">Weight</td>
           <td width="9.5%">Temparature</td>
           <td width="9.5%">Blood Pressure</td>
           <td width="9.5%">Glucose</td>
           <td width="9.5%">SPO2(Oxygen)/Pulse</td>
           <td width="9.5%">Activity</td>
           <td width="10%">Prescription Overview</td>
           <td width="10%">Subscription</td>

           </thead>

            @foreach($patient as $patient)
                @if($patient->pivot->subscribed)
                <?php
                    $bp=$patient->blood_pressure()->orderBy('id', 'desc')->first();
                    $glucose=$patient->glucose()->orderBy('id', 'desc')->first();
                    $temp=$patient->temperature()->orderBy('id', 'desc')->first();
                    $weight=$patient->weight()->orderBy('id', 'desc')->first();
                    $spo2=\App\SPO2::where('patient_id',$patient->id)->orderBy('id', 'desc')->first();
                    $activity=\App\Activity::where('patient_id',$patient->id)->orderBy('id', 'desc')->first();
                ?>
                    <tr>
                        <td><a href="{!! route('patient_information', ['patient'=>$patient]) !!}">{{\App\User::where('id',$patient->user_id)->first()->identification}}</a></td>
                        <td><a href="{!! route('weight', ['patient'=>$patient]) !!}"> {{$weight['weight']}}</a></td>
                        @if($temp['body_temperature']=="")
                            <td>No data</td>
                        @elseif($temp['body_temperature']>102 || $temp['body_temperature']<95)
                            <td><a href="{!! route('temperature', ['patient'=>$patient]) !!}" class="circle_red"></a></td>
                        @else
                            <td><a href="{!! route('temperature', ['patient'=>$patient]) !!}" class="circle_green"></a></td>
                        @endif
                        @if($bp['systolic']=="")
                            <td>No data</td>
                        @elseif($bp['systolic']<130 && $bp['diastolic']>70)
                            <td><a href="{!! route('bloodpressure', ['patient'=>$patient]) !!}" class="circle_green"></a></td>
                        @elseif($bp['systolic']<140 && $bp['diastolic']>60)
                            <td><a href="{!! route('bloodpressure', ['patient'=>$patient]) !!}" class="circle_yellow"></a></td>
                        @else
                            <td><a href="{!! route('bloodpressure', ['patient'=>$patient]) !!}" class="circle_red"></a></td>
                        @endif
                        @if($glucose['glucose']=="")
                            <td>No data</td>
                        @elseif($glucose['glucose']/18>5 && $glucose['glucose']/18<=9)
                            <td><a href="{!! route('glucose', ['patient'=>$patient]) !!}" class="circle_green"></a></td>
                        @else
                            <td><a href="{!! route('glucose', ['patient'=>$patient]) !!}" class="circle_red"></a></td>
                        @endif
                        @if($spo2['heart_rate']=="")
                            <td>No data</td>
                        @elseif($spo2['heart_rate']>75 && $spo2['heart_rate']<=85)
                            <td><a href="{!! route('spo2', ['patient'=>$patient]) !!}" class="circle_green"></a></td>
                        @else
                            <td><a href="{!! route('spo2', ['patient'=>$patient]) !!}" class="circle_red"></a></td>
                        @endif
                         @if($activity['steps']=="")
                            <td>No data</td>
                        @else
                            <td><a href="{!! route('activity', ['patient'=>$patient]) !!}" class="circle_green"></a></td>
                        @endif
                        
                        @if(($temp['body_temperature']=="")&&($bp['systolic']=="")&&($glucose['glucose']=="")&&($spo2['heart_rate']=="")&&($weight['weight']==""))
                            <td>No data</td>
                        @else
                            <td><a href="{!! route('prescriptionOverview', ['patient'=>$patient]) !!}"> Prescriptions</a></td>
                        @endif
                        <td>Subscribed</td>
                    </tr>
                @else
                    <tr>
                        <td>{{\App\User::where('id',$patient->user_id)->first()->identification}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="w3-btn w3-teal w3-round-large" href="{!! route('confirmSubscribe', ['patient'=>$patient]) !!}">
                                <i class="fa fa-btn fa-user"></i> Confirm Subscribtion </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table> <br> <br> <br>

    </div>

     <div class="well well-lg"><p>&copy; 2016 Digital Health Care.BD</p></div>


</div> 

@endsection
