<body>
<!--Wrapper Start-->
<div id="wrapper"> 
<!--Header Section Start-->
<header id= "header" data-spy="affix" data-offset-top="60" data-offset-bottom="60">
  <div class="container">
    <div class="row">
      <div class="col-md-8  col-sm-12 col-xs-12 col-sm-12">
        <nav class="navbar"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            
            <a class="navbar-brand" href="/"><img class="logo-dark hidden-xs"  src="{{ asset('backend/assets/images/logo/wehome_lg.png') }}" alt="" style="width: 100px" /> <img class="logo-dark hidden-lg hidden-md hidden-sm"  src="{{ asset('backend/assets/images/logo/wehome_lg.png') }}" alt="" style="width: 100px" /></a> </div>
          
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="main-menu collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">              
              <li><a href="/">Home</a></li>
              <li><a href="{{ route('page', 'about-us') }}">About us</a></li>
              <li><a href="{{ route('page', 'services') }}">Service</a></li>              
              <li><a href="{{ route('page', 'contact-us') }}">Contact</a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse --> 
        </nav>
      </div>
      <div class="col-md-4  col-sm-12 col-xs-12 col-sm-12 hidden-xs">
        <ul class="right-contact">
          <li><i class="fa fa-phone" aria-hidden="true"></i> +91 <a href="tel:8303704028">8303704028</a></li>
          <li><a href="javascript:void(0)" class="btn btn-primary btn-skin showLeadInquiryServices">Book now</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- /.container --> 
</header>
<!--/Header Section End--> 