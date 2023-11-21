<x-admin-layout>
   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Electrician Management</h4>
         </div>
         <div class="page-btn">
            <a class="btn btn-added" href="{{ route('admin.electrician.index') }}"><span class="fa fa-share"></span>&nbsp;&nbsp;All Electrician</a>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <form class="validateForm" action="{{ route('admin.electrician.store') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="{{ @$user->id }}">
               <div class="row">
                  <div class="col-lg-4 col-sm-6 col-12">
                     <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="name" value="{{ @$user->name }}">
                        <span class="text-danger Errname"></span>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ @$user->email }}">
                        <span class="text-danger Erremail"></span>
                     </div>
                     <div class="form-group">
                        <label>Year of Work Experience</label>
                        <div class="form-group">
                           <input type="text" name="work_experience" value="{{ @$user->work_experience }}">
                         </div>
                        <span class="text-danger Errwork_experience"></span>
                     </div>
                     <div class="form-group">
                        <label>Lead Services </label>
                        <select class="select" name="lead_services_id[]" multiple="">
                           <option value="" selected="" disabled="">Select Lead Services</option>
                           @foreach(CustomHelper::getBookingLeadService() as $key => $val)
                              <option value="{{ @$val->id }}" {{in_array($val->id, explode(",",@$user->lead_service_id) ?: []) ? "selected": ""}}>{{ @$val->service_name }}</option>
                           @endforeach
                        </select>
                        <span class="text-danger Errlead_service_id"></span>
                     </div> 
                 </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                     <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="number" value="{{ @$user->number }}">
                        <span class="text-danger Errnumber"></span>
                     </div>
                     <div class="form-group">
                        <label>State </label>
                        <select name="state_id" class="form-control state_list_select">
                           <option value="" selected="" disabled="">Select State</option>
                           @foreach(CustomHelper::getStates() ?? '' as $key => $val)
                              <option value="{{ $key }}" {{ @$user->state_id == $key ? 'selected' : '' }}>{{ $val }}</option>
                           @endforeach
                        </select>
                        <span class="text-danger Errstate_id"></span>
                     </div>
                     <div class="form-group">
                        <label>City </label>
                        <select name="city_id" class="form-control city_list">
                           <option value="{{ @$user->city->id }}">{{ @$user->city->districts_name }}</option>
                        </select>
                        <span class="text-danger Errcity_id"></span>
                     </div> 
                                        
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                     <div class="form-group">
                        <label> Profile Picture</label>
                        <div class="image-upload image-upload-new">
                           <input type="file" name="profile" class="image">
                           <div class="image-uploads">
                              <img src="{{ @$user->profile ? asset($user->profile) : asset('backend/assets/img/icons/upload.svg') }}" alt="img">
                              <h4>Drag and drop a file to upload</h4>
                           </div>
                        </div>
                        <div class="preview_image_div" style="display: none;">
                           <img src="" class="preview_image image_responsive" style="width: 50px;height: 50px; border-radius: 50%;">
                        </div>
                        <div class="image_show"></div>
                        <span class="text-danger Errprofile"></span>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <x-backend.proloader />
                     <button type="submit" class="btn btn-submit me-2"><span class="fa fa-plus"></span>&nbsp;&nbsp;Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</x-admin-layout>