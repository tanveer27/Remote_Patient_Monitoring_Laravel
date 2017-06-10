@extends('layouts.app')

  <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-theme.css')}}">

  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="httpa://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


@section('content')

<div class="container">

   <!-- <div id="upperlist"> -->

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#product">Product</a></li>
            <li><a data-toggle="tab" href="#gallery">Gallery</a></li>
            <li><a data-toggle="tab" href="#aboutus">About Us</a></li>
            <li><a data-toggle="tab" href="#service">Service</a></li>
            <li><a data-toggle="tab" href="#news">News</a></li>
            <li><a data-toggle="tab" href="#contact">Contact Us</a></li>
        </ul>
    
        <div class="tab-content">

            <div id="home" class="tab-pane fade in active">

                <div class="header">
                    <h1 class="head1">Digital Health Care.BD <br>
                    <small>An Online Based Health Care System</small>
                    </h1>
                </div>



                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">

                        <div class="item active">
                        <img src="{{asset('image/new1.jpg')}}" width="100%" height="65%"  alt="clipartsgram.com" name="clipartsgram.com">
                        </div>

                        <div class="item">
                        <img src="{{asset('image/slide2.jpg')}}" width="100%" height="65%" alt="clipartsgram.com" name="clipartsgram.com">
                        </div>

                        <div class="item">
                        <img src="{{asset('image/slide3.png')}}" width="100%" height="65%" alt="clipartsgram.com" name="clipartsgram.com">
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>

                    </div> <!--mycarousel-->
        
                

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12">

                    <div class="panel panel-success">
                        <div class="panel-heading"> <h3 style="text-align: center;">Digital Health Care.BD </h3></div>
                        <div class="panel-body">
                       <p>Digital Health Care.BD is an <b>online</b> based health care system.
                        It is a discipline that involves the use of information and communication technologies to help address the health problems and challenges faced by patients. These technologies include both hardware and software solutions and services. <br> <br>
                        Generally, digital healthcare is concerned about the development of interconnected health systems so as to improve the use of computational technologies, smart devices, computational analysis techniques and communication media to aid healthcare professionals and patients manage illnesses and health risks, as well as promote health and wellbeing. <br> <br>
                        Monitoring programs can collect a wide range of health data from the point of care, such as temperature, weight, blood pressure, blood sugar, blood oxygen levels, heart rate, and electrocardiograms. <br> <br>
                        This data is then transmitted to health professionals in facilities such as hospitals and intensive care units, skilled nursing facilities, and centralized off-site case management programs.  Health professionals monitor these patients remotely and act on the information received as part of the treatment plan.
                        </p> 
                        </div>
                    </div>
                </div>    
                    
            </div> <!-- row of introduction--> <br> <br> <br>
                
               
                 
               <!-- </div>  -->

                <div class="row">
                    <header>
                        <h2 class="bottomhead">Some of our Products</h2>
                    </header> 

                    <div class=" col-sm-4 col-md-4">
                        <div class="thumbnail">
                            <a data-toggle="tab" href="#product">
                            <img src="{{asset('image/bp.jpg')}}" alt="bloodpressure" style="width:100%">
                            <div class="caption">
                                <p>Bloodpressure Machine</p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class=" col-sm-4 col-md-4">
                        <div class="thumbnail">
                            <a data-toggle="tab" href="#product">
                            <img src="{{asset('image/ecg.jpg')}}" alt="bloodpressure" style="width:100%">
                            <div class="caption">
                                <p>ECG Machine</p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-4">
                        <div class="thumbnail">
                            <a data-toggle="tab" href="#product">
                            <img src="{{asset('image/glucose.png')}}" alt="glucose" style="width:100% height:221.15px">
                            <div class="caption">
                                <p>Glucose Machine</p>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div> <!--idhome-->


            <div id="product" class="tab-pane fade">

                <div class="header">
                    <h1 class="head1">Our Products</h1>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#" >
                            <img src="{{asset('image/bp.jpg')}}" alt="bloodpressure" style="width:100%">
                            <div class="caption">
                                <p><b>Bloodpressure Machine</b></p>
                                <p>Bloodpressure machine is used to measure blood pressure. <br>
                                Accurate, efficient, and consistent blood pressure monitors for at-home tracking and care can make all the difference in managing your health and medical conditions. Whether you need it for yourself or for a loved one, our selection of blood pressure monitors are portable, easy to use, and easy to maintain.
                                </p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#" >
                            <img src="{{asset('image/ecg.jpg')}}" alt="bloodpressure" style="width:100%">
                            <div class="caption">
                                <p><b>ECG Machine</b></p>
                                <p>ECG machine is used to measures the electrical activity of your heart to show whether or not it is working normally. <br>
                                Using the easy-to-use software provided, simply connect the device to a computer to transmit heart readings to an ECG Coordinating Centre for an ECG analysis. Whether at home or at work, the ECG Device with remote monitoring can help detect and monitor arrhythmias from wherever you are. 
                                </p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#">
                            <img src="{{asset('image/glucose.png')}}" alt="glucose" style="width:100% height:221.15px">
                            <div class="caption">
                                <p><b>Glucose Machine</b></p>
                                <p>Glucose machine is used for determining the approximate concentration of glucose in the blood.<br>
                                 A small drop of blood, obtained by pricking the skin with a lancet, is placed on a disposable test strip that the meter reads and uses to calculate the blood glucose level. The meter then displays the level in units of mg/dl or mmol/l.</p>
                            </div>
                            </a>
                        </div>
                    </div>
                </div> <br> <br> <br>

                <div class="row">

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#">
                            <img src="{{asset('image/temperature.png')}}" alt="temperature" style="width:331.33px height:221px">
                            <div class="caption">
                                <p><b>Temperature Machine</b></p>
                                <p>Temperature Machine is used for determining body temperature.</p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#">
                            <img src="{{asset('image/weight.png')}}" alt="weight" style="width:331.33px height:221px">
                            <div class="caption">
                                <p><b>Weight Machine</b></p>
                                <p>Weight Machine is used for measuring body weight.</p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#">
                            <img src="{{asset('image/new4.jpg')}}" alt="spo2" style="width:331.33px height:221px">
                            <div class="caption">
                                <p><b>SPO2 Machine</b></p>
                                <p>SpO2 stands for peripheral capillary oxygen saturation, this machine estimates the amount of oxygen in the blood.SpO2 is an estimate of arterial oxygen saturation, or SaO2, which refers to the amount of oxygenated haemoglobin in the blood.Normal SpO2 values vary between 95 and 100%.</p>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!--product id-->

            <div id="gallery" class="tab-pane fade">

                <div class="header">
                    <h1 class="head1">Gallery</h1>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#" >
                            <img src="{{asset('image/bp.jpg')}}" alt="bloodpressure" style="width:100%">
                            <div class="caption">
                                <p><b>Bloodpressure Machine</b></p>
                                <p>Bloodpressure machine is used to measure blood pressure. <br>
                                Accurate, efficient, and consistent blood pressure monitors for at-home tracking and care can make all the difference in managing your health and medical conditions. Whether you need it for yourself or for a loved one, our selection of blood pressure monitors are portable, easy to use, and easy to maintain.
                                </p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#" >
                            <img src="{{asset('image/ecg.jpg')}}" alt="bloodpressure" style="width:100%">
                            <div class="caption">
                                <p><b>ECG Machine</b></p>
                                <p>ECG machine is used to measures the electrical activity of your heart to show whether or not it is working normally. <br>
                                Using the easy-to-use software provided, simply connect the device to a computer to transmit heart readings to an ECG Coordinating Centre for an ECG analysis. Whether at home or at work, the ECG Device with remote monitoring can help detect and monitor arrhythmias from wherever you are. 
                                </p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#">
                            <img src="{{asset('image/glucose.png')}}" alt="glucose" style="width:100% height:221.15px">
                            <div class="caption">
                                <p><b>Glucose Machine</b></p>
                                <p>Glucose machine is used for determining the approximate concentration of glucose in the blood.<br>
                                 A small drop of blood, obtained by pricking the skin with a lancet, is placed on a disposable test strip that the meter reads and uses to calculate the blood glucose level. The meter then displays the level in units of mg/dl or mmol/l.</p>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!--gallery id-->



            <div id="aboutus" class="tab-pane fade">

                <div class="panel-group">

                    <div class="panel panel-info">

                        <div class="panel-heading"><h2 style="text-align: center;">About Us</h2></div>

                        <div class="panel-body">
                            <p>Digital Health Care.BD is an <b>online</b> based health care system. 
                            <br> <br>
                            It is a discipline that involves the use of information and communication technologies to help address the health problems and challenges faced by patients. These technologies include both hardware and software solutions and services.
                            </p>
                        </div>

                    </div>
                        
                </div> <!--panel 1-->
                    
              

                <div class="panel-group">

                    <div class="panel panel-info">

                        <div class="panel-heading"><h2 style="text-align: center;">Our Mission</h2>
                        </div>

                        <div class="panel-body">
                            <p>Digital healthcare is concerned about the development of interconnected health systems so as to improve the use of computational technologies, smart devices, computational analysis techniques and communication media to aid healthcare professionals and patients manage illnesses and health risks, as well as promote health and wellbeing. </p>
                        </div>
                    </div>
                        
                </div>

                

                <div class="panel-group">

                    <div class="panel panel-info">

                        <div class="panel-heading"><h2 style="text-align: center;">Our Goal</h2></div>

                        <div class="panel-body">
                            <p>Our goal is to collect a wide range of health data from the point of care, such as temperature, weight, blood pressure, blood sugar, blood oxygen levels, heart rate, and electrocardiograms.
                        <br> <br>

                        This data is then transmitted to health professionals in facilities such as monitoring centers in primary care settings, hospitals and intensive care units, skilled nursing facilities, and centralized off-site case management programs.  Health professionals monitor these patients remotely and act on the information received as part of the treatment plan. <br> <br>

                        Monitoring programs can also help keep people healthy, allow older and disabled individuals to live at home longer and avoid having to move into skilled nursing facilities. Digital health care can also serve to reduce the number of hospitalizations, readmissions, and lengths of stay in hospitals—all of which help improve quality of life and contain costs. </p>
                        </div>

                    </div>
                        
                </div>

            </div> <!--about us-->
            

            <div id="service" class="tab-pane fade">

                <div class="header">
                    <h1 class="head1">Our Services <br>
                    <small>What we offer</small> </h1>
                </div>
                  <br>

                  <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                      <span class="glyphicon glyphicon-doctor logo-small"></span>
                      <h4 style="color: #329386;">Online Health Care</h4>
                      <p>Digital Health Care uses digital technologies to collect medical and other forms of health data from individuals in one location and electronically transmit that information securely to health care providers in a different location for assessment and recommendations.</p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                      <span class="glyphicon glyphicon-stethoscope logo-small"></span>
                      <h4 style="color: #329386;">Hardware Products </h4>
                      <p> By using our products, users can measure and monitor various medical 
                      data such as-temperature, weight, blood pressure, blood sugar, blood oxygen levels, heart rate, and electrocardiograms.</p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                      <span class="glyphicon glyphicon-iphone logo-small"></span>
                      <h4 style="color: #329386;">Android App</h4>
                      <p>As our products are integrated with android app, users can send their measured data from hardware machine to our android app via wi-fi and keep track of their health condition.</p>
                    </div>
                  </div>
                  <br><br>
                  <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                      <span class="glyphicon glyphicon-display logo-small"></span>
                      <h4 style="color: #329386;">Website</h4>
                      <p>Users can create an account in our website to send their health related data to their subscribed doctors.<br>
                      Doctors can check and give review to their respective subscribers.
                      </p>
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4">
                      <span class="glyphicon glyphicon-folder-plus logo-small"></span>
                      <h4 style="color: #329386;">Data Storage and share</h4>
                      <p>All the health related data and the prescriptions are safely stored and organized. Therefore, it is much easier for the users to keep track of their health condition.<br>
                      Users can share their health data with their family by giving access to them.</p>
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4">
                      <span class="glyphicon glyphicon-group logo-small"></span>
                      <h4 style="color: #329386;">Remote Monitoing</h4>
                      <p>This remote monitoring can also help keep people healthy, allow older and disabled individuals to live at home longer and avoid having to move into skilled nursing facilities. <br>
                      This system can also serve to reduce the number of hospitalizations, readmissions, and lengths of stay in hospitals—all of which help improve quality of life and contain costs.</p>
                    </div>
                  </div>
            </div> <!--service-->


            <div id="news" class="tab-pane fade">

                <div class="header">
                    <h1 class="head1">News Feed</h1>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#" target="_blank">
                            <img src="{{asset('image/news2.jpg')}}" alt="" style=" height: 50% width:60%">
                            <div class="caption">
                                <p>We are launching soon</p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#" target="_blank">
                            <img src="{{asset('image/news1.jpg')}}" alt="" style=" height: 50% width:60%">
                            <div class="caption">
                                <p>More products are coming</p>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="#" target="_blank">
                            <img src="{{asset('image/news3.png')}}" alt="" style=" height: 50% width:60%">
                            <div class="caption">
                                <p>The App will be available at the playstore soon.</p>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!--news-->

            <div id="contact" class="tab-pane fade"> <!-- Container (Contact Section) -->
                      
                <div class="header">
                    <h1 class="head1">Contact</h1>
                </div>

                    <div class="row">

                        <div class="col-sm-4">
                          <p>Contact us and we'll get back to you.</p>
                          <p><span class="glyphicon glyphicon-map-marker"></span> Dhaka, Bangladesh</p>
                          <p><span class="glyphicon glyphicon-phone"></span> +800 000000</p>
                          <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
                        </div>

                        <div class="col-sm-8">

                            <div class="row">
                                <div class="col-sm-8 form-group">
                            	<form method="POST" class="form-horizontal" action="{{ url('/contactUs') }}">
				{{ csrf_field() }}
                                
                                <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                                </div>
                            </div>    

                            <div class="row">
                                <div class="col-sm-8 form-group">
                                  <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-8 form-group">

                                <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>

                                </div>
                            </div>

                            <div class="row">
                            <div class="col-sm-4 form-group">
                              <button class="btn btn-default pull-left" type="submit">Send</button>
                            </div>
                            </div>

                            </form>
                        </div>    
                    </div>  
                </div>

            </div> <!--contact -->
               
        </div> <!--tab content-->

  <!--  </div> --><!--upperlist-->
            
    
    <div class="well well-lg"><p>&copy; 2016 Digital Health Care.BD</p></div>

</div> <!--container-fluid-->


@endsection
