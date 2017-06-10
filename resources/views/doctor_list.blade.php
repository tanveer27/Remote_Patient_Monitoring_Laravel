@extends('layouts.userheader')


<link rel="stylesheet" type="text/css" href="{{ asset('css/doctor_list.css')}}">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset ('css/bootstrap-theme.css')}}" />

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
    
    <br>

    <h2 class="dlist">List of Doctors <br>

        <small>Subscribe Doctor From the List of Doctors</small>
        </h2> <br>


    <div id="doc_list">

    	 <!--<ul class="w3-ul w3-card-8" style="width:70%" > -->
    	 <table class="table table-striped">
             @foreach($doctors as $doctor)
             @if($doctor->doctor_first_name!="" && $doctor->doctor_last_name!="")
             <tr>
                 <?php
                    $patient=\App\Patient::where('user_id',auth()->user()->id)->first();
                    $patient_id=$patient->id;
                 ?>
                 
            <td> {{$doctor->doctor_first_name }} {{$doctor->doctor_last_name}} &nbsp; &nbsp; &nbsp;</td>

             <td>   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-{{$doctor->id}}">View Profile</button> </td>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal-{{$doctor->id}}" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Doctor's Profile</h4>
                        </div>

                        <div class="modal-body">
                          <img src="{{asset('images/').'/'.$doctor->image}}" width="50%" height="300px" alt="doctor's image"> <br> <br>

                          <p><strong>First Name : {{$doctor->doctor_first_name}}</strong></p><br>

                          <p><strong>Last Name : {{$doctor->doctor_last_name}}</strong></p> <br>
                          <p><strong>Degree : {{$doctor->degree}}</strong></p><br>
                          <p><strong>Speciality : {{$doctor->speciality}}</strong></p><br>
                          <p><strong>Hospital : {{$doctor->hospital}}</strong></p><br>
                          <p><strong>Consulting Hour : {{$doctor->consulting_hour}}</strong></p>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div> <!--modal fade-->

                @if(!($doctor->patients()->find($patient_id)))
            <td> <a class="w3-btn w3-green w3-round-large" href="{!! route('webSubscribe', ['$doctor'=>$doctor]) !!}">
                 <i class="fa fa-btn fa-user"></i> Subscribe</a>&nbsp; &nbsp; &nbsp; </td>
                @else
            <td> <a class="w3-btn w3-teal w3-round-large" href="{!! route('webUnSubscribe', ['$doctor'=>$doctor]) !!}">
                 <i class="fa fa-btn fa-user"></i> UnSubscribe </a> </td>
            
            </tr> <br>
            @endif
                 @endif
             @endforeach
             </table>
    
        
    	
    </div>

    <div class="well well-lg"><p>&copy; 2016 Digital Health Care.BD</p></div>

</div>
    @endsection