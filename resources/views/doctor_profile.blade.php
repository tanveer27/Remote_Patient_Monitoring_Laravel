@extends('layouts.header')
<link rel="stylesheet" type="text/css" href="{{asset('css/doctor_profile.css')}}">
<?php
	$id=auth()->user()->id;
	$doctor=\App\Doctor::where('user_id',$id)->first();
?>
@section('content')

<div class="container-fluid">
    

    <div id="header">

        <h1 id="head1">Digital Health Care.BD <br>
        <small>An Online Based Health Care System</small></h1>

    </div>


    <div id="menu">

        <div class="row">

        <div class="col-md-4">
            <img src="{{asset('image/new8.png')}}" width="230px" height="240px" alt="miankoutt.com" name="miankoutt.com">
            
        </div>

        <div class="col-md-4">
            <img src="{{asset('image/new9.png')}}" width="230px" height="240px" alt="miankoutt.com" name="miankoutt.com">
        </div>
        <div class="col-md-4">
            <img src="{{asset('image/new10.png')}}" width="230px" height="240px" alt="miankoutt.com" name="miankoutt.com">
        </div>
            
        </div>
        
    </div> <br> <br> 

    <div class="content"> <!--content-->

    	<h3 id="head_3">Update Your Profile</h3>

		<form method="POST" class="form-horizontal" enctype="multipart/form-data" action="{{ url('/doctorProfileUpdate') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="doctor_first_name" class="col-sm-2 control-label">First Name</label>

				<div class="col-sm-4">
					<input type="name" class="form-control" id="first_name" name="first_name" value="{{$doctor->doctor_first_name}}">
				</div>
			</div>

			<div class="form-group">
				<label for="doctor_last_name" class="col-sm-2 control-label">Last Name</label>

				<div class="col-sm-4">
					<input type="name" class="form-control" id="last_name" name="last_name" value="{{$doctor->doctor_last_name}}">
				</div>

			</div>

			<div class="form-group">

				<label  class="col-sm-2 control-label">Image upload</label>
				<div class="col-sm-4">
					<input type="file" name="image" id="image">
				</div>

			</div>

			<div class="form-group">
				<label for="degree" class="col-sm-2 control-label">Degree</label>

				<div class="col-sm-4">
					<input type="degree" class="form-control" id="degree" name="degree" value="{{$doctor->degree}}">
				</div>
			</div>

			<div class="form-group">
				<label for="speciality" class="col-sm-2 control-label">Speciality</label>

				<div class="col-sm-4">
					<input type="name" class="form-control" id="speciality" name="speciality" value="{{$doctor->speciality}}">
				</div>
			</div>

			<div class="form-group">
				<label for="hospital" class="col-sm-2 control-label">Hospital</label>

				<div class="col-sm-4">
					<input type="name" class="form-control" id="hospital" name="hospital" value="{{$doctor->hospital}}">
				</div>
			</div>

			<div class="form-group">
				<label for="consulting_hour" class="col-sm-2 control-label">Consulting Hour</label>

				<div class="col-sm-4">
					<input type="name" class="form-control" id="consulting_hour" name="consulting_hour" value="{{$doctor->consulting_hour}}">
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