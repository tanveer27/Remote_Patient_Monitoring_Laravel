@extends('layouts.userheader')

<link rel="stylesheet" type="text/css" href="{{ asset('css/user_home.css')}}">

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
    
    <div id="header">
    <h1 id="head1">Digital Health Care.BD <br>
    <small>Doctor's Advice at home</small></h1>
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
            <img src="{{asset('image/new10.png')}}" width="245px" height="245px" alt="miankoutt.com" name="miankoutt.com">
        </div>
            
        </div>
        
    </div>
    

    <div class="content"> <!--content-->

    
        <h1 class="head_3">Welcome</h1> 

        <div class="row">

        <div class="col-md-6">
            <p class="permission">You can <b>check</b> the health condition of your family members and relatives from here.</p>
        </div>

        <div class="col-md-6">
            <p class="permission"> You can also give <b>access</b> to other members to check your own health data. </p>
        <p class="permission">Write the Email address to whom you want to give <b>access</b> to your health data</p> <br>

        <form method="POST" class="form-horizontal" action="{{ url('/viewPermit') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="User Email to Give Access">
                </div>
            </div>

            <div class="form-group">
                <div id="send-request" class="col-md-4 col-md-offset-2">
                    <button  type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i> Give Access
                    </button>
                </div>
            </div>
        </form>
        </div>
            
        </div> 

        <table class="table table-bordered table-nonfluid">

          <caption>Patient's Health's Data</caption>


           <thead> 
            
            <td width="15%">Identity</td>
            <td width="10%">Weight</td>
            <td width="10%">Temparature</td>
            <td width="10%">Blood Pressure</td>
            <td width="10%">Glucose</td>
            <td width="10%">SPO2</td>
            <td width="10%">Activity</td>
            <td width="13%">Prescription Overview</td>

           </thead>
            @foreach($patient as $patient)
                <?php
                $bp=$patient->blood_pressure()->orderBy('created_at', 'desc')->first();
                $glucose=$patient->glucose()->orderBy('created_at', 'desc')->first();
                $temp=$patient->temperature()->orderBy('created_at', 'desc')->first();
                $weight=$patient->weight()->orderBy('id', 'desc')->first();
                $spo2=\App\SPO2::where('patient_id',$patient->id)->orderBy('id', 'desc')->first();
                $activity=\App\Activity::where('patient_id',$patient->id)->orderBy('id', 'desc')->first();
                ?>
                <tr>
                    <td>{{\App\User::where('id',$patient->user_id)->first()->identification}}</td>
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
                @elseif($glucose['glucose']>5 && $glucose['glucose']<=9)
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

               
                 @if(($temp['body_temperature']=="")&&($bp['systolic']=="")&&($glucose['glucose']==""))
                 <td>No data</td>
                 @else
                  <td><a href="{!! route('prescriptionOverview', ['patient'=>$patient]) !!}"> Prescriptions</a></td>
                  @endif
                </tr>
            @endforeach
        </table> <br> 

    
    </div> <br> <br>

      <div class="well well-lg"><p>&copy; 2016 Digital Health Care.BD</p></div>

  </div> 

@endsection
