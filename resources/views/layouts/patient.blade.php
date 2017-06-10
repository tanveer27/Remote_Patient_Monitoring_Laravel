@extends('layouts.header')

<link rel="stylesheet" type="text/css" href="{{ asset('css/bloodpressure.css') }}">
@section('content')



<div class="container-fluid">
    

    <div id="header">
    <h1 id="head1">Digital Health Care.BD <br>
    <small>Doctor's Advice at home</small></h1>
    </div>

    <div class="menu">

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

    
        <h2 class="heading">Patient Information</h2>
    @yield('information')
      

        <div class="clr"></div>

        @yield('table')
    </div> <br> <br> <br>

    

  <div class="well well-lg"><p>&copy; 2016 Digital Health Care.BD</p></div>

</div> 

@endsection