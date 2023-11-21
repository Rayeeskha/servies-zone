@extends('frontend.layouts.app')
@section('page_title','Wehome Services')
@section('meta_keywords','Wehome Services')
@section('meta_description', 'Wehome Services')
@section('container')

<!-- Slider -->
<x-frontend.slider />

<!-- How it works -->
@include('frontend.layouts.include.how_it_works')

<!-- Our Services -->
<x-frontend.our-services name="services" :services="$services" />

<!-- Trust -->
@include('frontend.layouts.include.trust')
	
<!-- Our Number -->
@include('frontend.layouts.include.our_number')

<!-- Feature -->
@include('frontend.layouts.include.feature')

<!-- Testimonial -->
<x-frontend.testimonial />

<!-- Download App -->
@include('frontend.layouts.include.download')

@endsection