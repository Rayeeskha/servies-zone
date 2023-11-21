<form class="validateForm" action="{{ route('inquiry.book_service') }}" enctype="multipart/form-data" method="post" >
   @csrf
   <input type="hidden" name="country_id" value="1">
   <div class="modal-body">
      <div class="row">
         <div class="col-md-12">
            <label>Service</label>
            <select name="lead_service_id" class="form-control">
               <option value="" selected="" disabled="">Select Service</option>
               @foreach(CustomHelper::getBookingLeadService() ?? '' as $key => $val)
                  <option value="{{ @$val->id }}" {{ @$serviceId == @$val->id ? 'selected' : '' }}>{{ @$val->service_name }}</option>
               @endforeach
            </select>

            <span class="text-danger Errlead_service_id"></span>
         </div>
         <div class="col-md-6">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Name">

            <span class="text-danger Errname"></span>
         </div>
         <div class="col-md-6">
            <label>Mobile </label>
            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">

            <span class="text-danger Errphone"></span>
         </div>
         <div class="col-md-6">
            <label>State </label>
            <select name="state_id" class="form-control state_list_select">
               <option value="" selected="" disabled="">Select State</option>
               @foreach(CustomHelper::getStates() ?? '' as $key => $val)
                  <option value="{{ $key }}">{{ $val }}</option>
               @endforeach
            </select>

            <span class="text-danger Errstate_id"></span>
         </div>
         <div class="col-md-6">
            <label>City </label>
            <select name="city_id" class="form-control city_list"></select>
            <span class="text-danger Errcity_id"></span>
         </div>
         <div class="col-md-12">
            <label>Address </label>
            <textarea name="location" class="form-control" placeholder="Enter Location "></textarea>

            <span class="text-danger Errlocation"></span>
         </div>
      </div>
   </div>
   <div class="modal-footer">
      <x-backend.proloader />
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-primary">Save changes</button>
   </div>
</form>
@include('frontend.layouts.include.js')