<x-admin-layout>
   <div class="content container-fluid">
      <div class="page-header">
         <div class="page-title">
            <h4>Manage Lead Inquiry</h4>
            <h6>Manage Lead Inquiry</h6>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="table-top">
                     <div class="search-set">
                        <div class="search-path">
                           <a class="btn btn-filter" id="filter_search">
                           <img src="{{ asset('backend/assets/img/icons/filter.svg') }}" alt="img">
                           <span><img src="{{ asset('backend/assets/img/icons/closes.svg') }}" alt="img"></span>
                           </a>
                        </div>
                        <div class="search-input">
                           <a class="btn btn-searchset"><img src="{{ asset('backend/assets/img/icons/search-white.svg') }}" alt="img"></a>
                        </div>
                     </div>
                  </div>
                  <div class="card" id="filter_inputs">
                     <div class="card-body pb-0">
                        <div class="row">
                           <div class="col-lg-2 col-sm-6 col-12">
                              <div class="form-group">
                                <select name="lead_service_id" id="lead_service_id" class="select">
                                  <option value="" selected="" disabled="">Select Lead Service</option>
                                  @foreach(CustomHelper::getLeadServices() as $key => $service_name)
                                    <option value="{{ @$key }}">{{ @$service_name }}</option>
                                  @endforeach
                                </select>
                              </div>
                           </div>
                           <div class="col-lg-2 col-sm-6 col-12">
                              <div class="form-group">
                                 <select name="state_id"  id="state_id" class="select">
                                  <option value="" selected="" disabled="">Select State</option>
                                  @foreach(CustomHelper::getStates() as $key => $name)
                                    <option value="{{ @$key }}">{{ @$name }}</option>
                                  @endforeach
                                </select>
                              </div>
                           </div>
                           <div class="col-lg-2 col-sm-6 col-12">
                              <div class="form-group">
                                 <select name="city_id" id="city_id" class="select">
                                  <option value="" selected="" disabled="">Select City</option>
                                  @foreach(CustomHelper::getCities()  as  $key => $name)
                                    <option value="{{ @$key }}">{{ @$name }}</option>
                                  @endforeach
                                </select>
                              </div>
                           </div>
                           <div class="col-lg-2 col-sm-6 col-12">
                              <div class="form-group">
                                <div class="input-groupicon">
                                    <input type="date" name="start_date" class="form-control">
                                </div>                                 
                              </div>
                           </div>
                           <div class="col-lg-2 col-sm-6 col-12">
                              <div class="form-group">
                                 <div class="input-groupicon">
                                    <input type="date" name="end_date" class="form-control">
                                  </div>
                              </div>
                           </div>
                           <div class="col-lg-2 col-sm-6 col-12">
                              <div class="form-group">
                                 <a class="btn btn-filters ms-auto"><img src="{{ asset('backend/assets/img/icons/search-whites.svg') }}" alt="img"></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table class="table  yajra-datatable">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Service</th>
                              <th>State</th>
                              <th>City</th>
                              <th>Location</th>
                              <th>Assign Electrician</th>
                              <th>Employee Feedback</th>
                              <th>Electrician Feedback</th>
                              <!-- <th>Status</th> -->
                              <th>Create At</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody></tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


   <!-- Feedback Feedback -->
   <div class="modal fade feedBackModal" tabindex="-1" aria-labelledby="employeeFeedBack" aria-hidden="true">
       <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
             </div>
             <form action="{{ route('admin.lead-inquiry.store') }}" class="submitForm" method="post">
                <input type="hidden" name="id" class="lead_inquiry_id">
                <input type="hidden" name="slug" class="lead_inquiry_type">
                <div class="modal-body">
                  <div class="row">
                     <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">                           
                           <div class="form-group">
                             <label>Feedback</label>
                             <textarea class="form-control" name="feedback"></textarea>

                             <span class="text-danger Errfeedback"></span>
                          </div>
                        </div>
                     </div>                     
                  </div>
               </div>
               <div class="modal-footer">
                  <x-backend.proloader />
                  <button type="submit" class="btn btn-submit">Submit</button>
               </div>
             </form>               
          </div>
       </div>
    </div>
   <!-- Electrician Feedback -->


</x-admin-layout>
<script type="text/javascript">
   $(function () {
     let table = $('.yajra-datatable').DataTable({
       processing: true,
       serverSide: true,
        ajax: {
          "url": "{{ route('admin.lead-inquiry.index') }}",
          data: function (d) {
            d.start_date = $("input[name='start_date']").val(),
            d.end_date = $("input[name='end_date']").val(),
            d.lead_service_id = $("#lead_service_id").val(),
            d.state_id = $("#state_id").val(),
            d.city_id = $("#city_id").val()
          }
        },
       columns: [
         {data: 'DT_RowIndex', orderable: false,searchable: false},
         {data: 'name', name: 'name'},
         {data: 'phone', name: 'phone'},
         {data: 'lead_service_id', name: 'lead_service_id '},
         {data: 'state_id', name: 'state_id'},
         {data: 'city_id', name: 'city_id'},
         {data: 'location', name: 'location'},
         {data: 'assign_electrician_id', name: 'assign_electrician_id'},
         {data: 'employee_feedback', name: 'employee_feedback'},
         {data: 'electrician_feedback', name: 'electrician_feedback'},
         // {data: 'status', name: 'status'},
         {data: 'created_at', name: 'created_at'},
         {data: 'action',  name: 'action',  orderable: false,   searchable: false },
       ],
        createdRow: function( row, data, dataIndex ) {
         $(row).attr('row-id',data.id+'-lead_inquiries');
        }
     });
      $("input[name='start_date']").change(function(){
        table.draw();
      });
      $("input[name='end_date']").change(function(){
        table.draw();
      });
      $("#lead_service_id").change(function(){
        table.draw();
      });
      $("#state_id").change(function(){
        table.draw();
      });
      $("#city_id").change(function(){
        table.draw();
      });
   });

  


</script>