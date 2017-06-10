@extends('layouts.userheader')
<link rel="stylesheet" type="text/css" href="{{asset('css/doctor_profile.css')}}">
<?php
$id=auth()->user()->id;
$patient=\App\Patient::where('user_id',$id)->first();
?>
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

            <h3 id="head_3">Profile Update</h3>

            <form method="POST" class="form-horizontal" action="{{ url('/userProfileUpdate') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="patient_first_name" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-4">
                        <input type="name" class="form-control" id="first_name" name="first_name" value="{{$patient->patient_first_name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="patient_last_name" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-4">
                        <input type="name" class="form-control" id="last_name" name="last_name" value="{{$patient->patient_last_name}}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Image upload</label>

                    <div class="col-sm-4">
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sex" class="col-sm-2 control-label">Sex</label>

                    <div class="col-sm-4">
                        <input type="sex" class="form-control" id="sex" name="sex" value="{{$patient->sex}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="dob" name="dob" value="{{$patient->dob}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="height" class="col-sm-2 control-label">Height</label>

                    <div class="col-sm-4">
                        <input type="name" class="form-control" id="height" name="height" value="{{$patient->height}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address" name="address" value="{{$patient->address}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="bloodgroup" class="col-sm-2 control-label">Bloodgroup</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="bloodgroup" name="bloodgroup" value="{{$patient->bloodgroup}}">
                    </div>
                </div> <br> <br>

                <div class="form-group">
                	<label for="smoking" class="col-sm-2 control-label">Do You Smoke</label>

                	<div class="col-sm-4">
                    <label class="checkbox-inline"><input type="checkbox" id="" name="smoke" value="yes">Yes</label>
					<label class="checkbox-inline"><input type="checkbox" id="smoke" name="smoke" value="no">No</label>
					</div>
                </div> <br> <br>

                <div class="form-group">
                	<label for="alcohol" class="col-sm-2 control-label">Alcohol</label>

                	<div class="col-sm-4">
                    <label class="checkbox-inline"><input type="checkbox" id="" name="alcohol" value="yes">Yes</label>
					<label class="checkbox-inline"><input type="checkbox" id="alcohol" name="alcohol" value="no">No</label>
					</div>
                </div> <br> <br>

                <div class="form-group">
                	<label for="drug" class="col-sm-2 control-label">Drug</label>

                	<div class="col-sm-4">
                    <label class="checkbox-inline"><input type="checkbox" id="drug" name="drug" value="yes">Yes</label>
					<label class="checkbox-inline"><input type="checkbox" id="" name="drug" value="no">No</label>
					</div>
                </div> <br> <br>

                <div class="form-group">
                    <label for="allergy" class="col-sm-2 control-label">Allergy</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="allergy" name="allergy" value="{{$patient->allergy}}">
                    </div>
                </div> <br> <br>

                  <div class="form-group">
                    <label for="hep" class="col-sm-2 control-label">Hepatitis</label>

                    <div class="col-sm-4">
                        <label class="radio-inline"><input type="radio" id="" name="hepatitis" value="A">A</label>
						<label class="radio-inline"><input type="radio" id="" name="hepatitis" value="B">B</label>
						<label class="radio-inline"><input type="radio" id="" name="hepatitis" value="C">C</label> 
						<label class="radio-inline"><input type="radio" id="" name="hepatitis" value="none" checked>None</label>
                    </div>
                </div> <br><br>

                <div class="form-group">
                    <label for="family_disease" class="col-sm-2 control-label">Family Disease History</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="fdh" name="fdh" value="{{$patient->fdh}}">
                    </div>
                </div> <br> <br>


                <div class="form-group">
                    <label for="current_medication" class="col-sm-2 control-label">Current Medication</label>

                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="medication" name="medication" value="{{$patient->medication}}">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div> <br> <br> <br>

     <div class="well well-lg"><p>&copy; 2016 Digital Health Care.BD</p>
     </div>

    </div>

@endsection