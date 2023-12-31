@extends('frontend.layouts.app')
@section('page_title','Wehome Aboutus')
@section('meta_keywords','Wehome Aboutus')
@section('meta_description', 'Wehome Aboutus')
@section('container')

<div id="page_title">
<div class="container text-center">
  <div class="panel-heading">About Us</div>
  <ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">About Us</li>
  </ol>
</div>
</div>
<!--page_title Section End--> 

<!--page content Section Satrt-->
<div id="about">
<div class="container">
  <div class="row">
    <div class="col-md-6 col-sm-6 about_l"> <img src="{{ asset('frontend/images/about/desk.png') }}" alt="desk" /> </div>
    <div class="col-md-6 col-sm-6">
      <p>We are a creative team, provide you a great Cleaning WordPress theme. A long time working in this field brings us enough experience to serve every customer, even the hardest one. That is the reason why we are acclaimed by all our valuable customers. "If you have passion and you are hardworking", you can create a masterpiece, and we think we have that. We are trying everyday to bring our dear customers, dear partners the best thing you have ever had, believe us, your visitors will be immersed in a remarkable browsing experience.</p>
      <p>We base on the latest and most modern technology to create and provide you a perfect  blog theme WordPress. Cleaning is also compatible with many utility tools which help you to use Cleaning WordPress theme easily. Some of them are: </p>
      <ul class="list-star">
        <li>Full responsive & Retina Ready</li>
        <li>Retina Compatible</li>
        <li>A Range of Layout</li>
      </ul>
      <button type="button" class="btn btn-default btn-lg skin-border showLeadInquiryServices">Book Now</button>
    </div>
  </div>
</div>
</div>
<!--page content Section End--> 

<!--Start team area-->
<section class="team-area">
<div class="container">
  <h1 class="panel-heading text-center">Our Team</h1>
  <div class="row"> 
    <!--Start single team member-->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="single-team-member text-center">
        <div class="img-holder"> <img src="{{ asset('frontend/images/about/Team1.png') }}" class="img-circle" alt="Awesome Image"> </div>
        <div class="text-holder text-center">
          <h3>ADAM FINLAY</h3>
          <p>Expert Cleaner</p>
          <ul class="social-links">
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> </a></li>
            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--End single team member--> 
    <!--Start single team member-->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="single-team-member text-center">
        <div class="img-holder"> <img src="{{ asset('frontend/images/about/Team2.png') }}" class="img-circle" alt="Awesome Image"> </div>
        <div class="text-holder text-center">
          <h3>ADAM FINLAY</h3>
          <p>Expert Cleaner</p>
          <ul class="social-links">
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> </a></li>
            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--End single team member--> 
    <!--Start single team member-->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="single-team-member text-center">
        <div class="img-holder"> <img src="{{ asset('frontend/images/about/Team3.png') }}" class="img-circle" alt="Awesome Image"> </div>
        <div class="text-holder text-center">
          <h3>ADAM FINLAY</h3>
          <p>Expert Cleaner</p>
          <ul class="social-links">
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> </a></li>
            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--End single team member--> 
    <!--Start single team member-->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="single-team-member text-center">
        <div class="img-holder"> <img src="{{ asset('frontend/images/about/Team4.png') }}" class="img-circle" alt="Awesome Image"> </div>
        <div class="text-holder text-center">
          <h3>ADAM FINLAY</h3>
          <p>Expert Cleaner</p>
          <ul class="social-links">
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> </a></li>
            <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--End single team member--> 
  </div>
</div>
</section>
<!--/End Start team area--> 

<!-- World Service Provider -->
<x-frontend.world-service-provider />

<!-- Testimonial -->
<x-frontend.testimonial />

@endsection