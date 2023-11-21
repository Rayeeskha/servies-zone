@extends('frontend.layouts.app')
@section('page_title','Wehome Services')
@section('meta_keywords','Wehome Services')
@section('meta_description', 'Wehome Services')
@section('container')

<!--Page Title Section Satrt-->
<div id="page_title">
<div class="container text-center">
  <div class="panel-heading">services</div>
  <ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Services</li>
  </ol>
</div>
</div>
<!--Page Title Section End--> 

<!--Service Page Start-->
<section id="service_page">
  <div class="container text-center">
    <div class="row">
      @foreach($services ?? '' as $service)
      <div class="col-md-4 col-sm-6 col-xs-12 srevice_img"> <a href="{{ route('services', $service->slug) }}"><img src="{{ asset($service->image) }}" class="img-circle htw" alt="cleaning" /></a>
        <h4><a href="{{ route('services', $service->slug) }}">{{ @$service->service_name }}</a></h4>
      </div>
      @endforeach    
    </div>
  </div>
</section>
<!--Service Page End--> 

<!-- World Service Provider -->
<x-frontend.world-service-provider />
<!--/Service Provider Satrt End--> 

<!-- Testimonial -->
<x-frontend.testimonial />

@endsection