@extends('frontend.layouts.app')
@section('page_title', @$service->service_name)
@section('meta_keywords', @$service->service_name)
@section('meta_description',  @$service->service_name)
@section('container')

<!--page_title Section Satrt-->
  <div id="page_title">
    <div class="container text-center">
      <div class="panel-heading">{{ @$service->service_name }}</div>
      <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">{{ @$service->service_name }}</li>
      </ol>
    </div>
  </div>
  <!--page_title Section End--> 

  <!-- header section--->
 <section id="service_provider">
    <div class="container text-center">
      <h1 class="panel-heading" style="color:red;font-size: 34px;">Book Service <i class="fa fa-phone"></i> 8303704028 (7AM To 9PM)</h1>
      <div class="row">
        <div class="col-md-12"> 
          <!--counter box-->
          <div class="counter_box">
            <div class="counter_number_right">
              <button type="button" class="btn btn-default btn-lg skin-border showLeadInquiryServices">Book Now</button>
            </div>
          </div>
          <div class="counter_box">
            <div class="counter_number_right">
            	<a href="tel:8303704028"  class="btn btn-default btn-lg skin-border">Call Now - 8303704028</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!---end of header section--->
  
  <!--page content Section Satrt-->
  <div id="about" style="padding-bottom: 32px;">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 about_l"> <img src="{{ asset(@$service->image ) }}" alt="desk" style="width: 500px" /> </div>
        <div class="col-md-6 col-sm-6">
          <h1 class="panel-heading">{{ @$service->service_name }}</h1>
          <p>{{ @$service->description }}</p>
          <ul class="list-star">
            <li>Full responsive & Retina Ready</li>
            <li>Retina Compatible</li>
            <li>A Range of Layout</li>
          </ul>
          <button type="button" class="btn btn-default btn-lg skin-border showLeadInquiryServices">Book now</button>
        </div>
      </div>
    </div>
  </div>
  <!--page content Section End--> 
  
  <!---details page start--->
   <section id="service_provider">
    <div class="container text-center">      
      <div class="row">
        <div class="col-md-4"> 
          <img src="{{ asset($service->desc_img1) }}" alt="desk" /><br>
          <h1 class="panel-heading" style="margin-top:20px;">{{ @$service->title1 }}</h1>
          <p>{{ @$service->desc1 }}</p><br>
          <button type="button" class="btn btn-default btn-lg skin-border showLeadInquiryServices">Book now</button>
        </div>
        <div class="col-md-4">
        <img src="{{ asset($service->desc_img2) }}" alt="desk" /><br>
          <h1 class="panel-heading" style="margin-top:20px;">{{ @$service->title2 }}</h1>
          <p>{{ @$service->desc2 }}</p><br>
          <button type="button" class="btn btn-default btn-lg skin-border showLeadInquiryServices">Book now</button> 
        </div>
        <div class="col-md-4">
        <img src="{{ asset($service->desc_img3) }}" alt="desk" /><br>
          <h1 class="panel-heading" style="margin-top:20px;">{{ @$service->title3 }}</h1>
          <p>{{ @$service->desc3 }}</p><br>
          <button type="button" class="btn btn-default btn-lg skin-border showLeadInquiryServices">Book now</button> 
        </div>        
      </div>      
    </div>
  </section>

  <!-- end details page--->
  
 

@endsection