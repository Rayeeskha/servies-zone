@extends('frontend.layouts.app')
@section('page_title','Wehome Contactus')
@section('meta_keywords','Wehome Contactus')
@section('meta_description', 'Wehome Contactus')
@section('container')

<div id="page_title">
<div class="container text-center">
  <div class="panel-heading">contact us</div>
  <ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Contact us</li>
  </ol>
</div>
</div>
<!--Page Title Section End--> 

<!--Contact Form Start-->
<section id="Contact_form">
<div class="contacts_mape">
  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1229.5864897864183!2d75.76904979762698!3d26.886852269789564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1499667244188" width="1600" height="490" allowfullscreen></iframe>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12">
      <div class="booking_form">
        <div class="container-fluid">
          <div class="row">
            <!-- class="validateForm"  action="{{ route('inquiry.contact_us') }}"-->
            <form enctype="multipart/form-data" method="post" >
              <!-- @csrf   -->
              <h2>Contact Form</h2>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <input class="form-control" id="name" name="name" placeholder="Full Name" type="text"/>
                <span class="text-danger Errname"></span>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <input class="form-control" id="Email" name="email" placeholder="Email" type="text"/>
                <span class="text-danger Erremail"></span>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <input class="form-control" id="Subject" name="subject" placeholder="Subject*" type="text"/>
                <span class="text-danger Errsubject"></span>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <input class="form-control" id="Phone_number" name="phone" placeholder="Phone Number" type="text"/>
                <span class="text-danger Errphone"></span>
              </div>
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                  <textarea class="form-control" rows="6" placeholder="Message" name="message"></textarea>
                  <span class="text-danger Errmessage"></span>
                </div>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <x-backend.proloader />
                <button class="btn btn-primary btn-skin" name="button" type="button"> Send Message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="about_info">
        <h2>Contact info</h2>
        <p><i class="fa fa-map-marker" aria-hidden="true"></i> Lorem Ipsum is simply dummy</p>
        <p><i class="fa fa-envelope" aria-hidden="true"></i> infor@example.com</p>
        <p><i class="fa fa-phone" aria-hidden="true"></i> +91807186985</p>
      </div>
    </div>
  </div>
</div>
</section>
<!--Contact Form End--> 

@endsection