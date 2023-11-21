<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <!--Banner Start-->
	<!-- <section id="banner" class="home-one">
	  <div class="container text-center parallax-section">
	    <div class="row text-center">
	      <div class="col-md-12">
	        <h1 class="panel-heading" style="color: red">WE HOME</h1>
	        <p class="caption">Local  Expert in your home..<br/> -->
	          <!-- time and we'll do the rest -->
	      <!-- 	</p>
	         <a href="tel:8303704028" class="btn btn-white" style="background: black;width: 20%; height: 40px; box-shadow: none;color: white"><span class="fa fa-phone"></span>&nbsp; 8303704028</a>
	         <a href="javascript:void(0)"  class="btn btn-primary btn-lg showLeadInquiryServices"  style="width: 20%; height: 40px"><span class="fa fa-book" ></span>&nbsp;Book now</a>
	      </div>
	    </div>
	  </div>
	</section> -->
	<!--/Banner End--> 


	<section id="service_banner">
		<!-- service_banner_layer -->
	    <div class="container text-center  ">
	      <div class="banner_content">
	        <div class="row text-left">
	          <div class="col-md-8 col-sm-8 col-xs-12">
	            <h1 class="service-heading">Book a Cleaning Service Today</h1>
	            <p>Wehome</p>
	            <h2>Why choose wehome?</h2>
	            <ul class="featurs_list">
	              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> High end cleaning machinery</li>
	              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> High end cleaning machinery</li>
	              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> High end cleaning machinery</li>
	              <li><i class="fa fa-check-square-o" aria-hidden="true"></i> High end cleaning machinery</li>
	            </ul>
	            <a href="javascript:void(0)" class="btn btn-warning btn-booknow showLeadInquiryServices" > Book now </a> </div>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <div class="quick_contact">
	              <p>We Are Here To Help <br />
	                You!!!</p>
	              <form class="validateForm2" action="{{ route('inquiry.book_service') }}" enctype="multipart/form-data" method="post" >
	              	@csrf
	              	<div class="form-group">
	                  <div class="input-group">
	                    <div class="input-group-addon"><i class="fa fa-eye" aria-hidden="true"></i></div>
	                    <select name="lead_service_id" class="form-control">
			               <option value="" selected="" disabled="">Select Service</option>
			               @foreach(CustomHelper::getBookingLeadService() ?? '' as $key => $val)
			                  <option value="{{ @$val->id }}" style="color: black">{{ @$val->service_name }}</option>
			               @endforeach
			            </select>

			            <span class="text-danger Errlead_service_id"></span>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <div class="input-group">
	                    <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
	                    <input type="text" class="form-control" id="exampleName" placeholder="Name" name="name" />

	                    <span class="text-danger Errname"></span>
	                  </div>
	                </div>
	                
	                <div class="form-group">
	                  <div class="input-group">
	                    <div class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
	                    <input type="text" class="form-control" id="examplePhone" placeholder="Phone" name="phone" />
	                    <span class="text-danger Errphone"></span>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <div class="input-group">
	                    <div class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></div>
	                    <select name="state_id" class="form-control state_list_select">
			               <option value="" selected="" disabled="">Select State</option>
			               @foreach(CustomHelper::getStates() ?? '' as $key => $val)
			                  <option value="{{ $key }}" style="color: black">{{ $val }}</option>
			               @endforeach
			            </select>
			            <span class="text-danger Errstate_id"></span>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <div class="input-group">
	                    <div class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></div>
	                    <select name="city_id" class="form-control city_list"></select>
	            		<span class="text-danger Errcity_id"></span>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <div class="input-group">
	                    <div class="input-group-addon"><i class="fa fa-comment" aria-hidden="true"></i></div>
	                    <textarea class="form-control" rows="2" name="location" placeholder="Enter Location"></textarea>
	                    <span class="text-danger Errlocation"></span>
	                  </div>
	                </div>
	                <div class="form-group">
	                	<x-backend.proloader2 />
	                  <div class="quick_btn">
	                    <button type="submit" class="btn btn-info btn-skin"><span class="fa fa-send"></span>&nbsp;Send Your Inquiry</button>
	                  </div>
	                </div>
	              </form>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
  	</section>



<!-- data-toggle="modal" data-target="#myModal" -->


</div>