<x-admin-layout>
<div class="content container-fluid">
  <div class="page-header">
    <div class="page-title">
      <h4>Service Activation</h4>
      <h6>Service Activation</h6>
    </div>
    @if($addPermission)
      <div class="page-btn">
        <a class="btn btn-added addServiceActivation"  href="javascript:void(0)"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Service Activation</a>
      </div>
    @endif
  </div>
  <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table  yajra-datatable">
                     <thead>
                        <tr>
                          <th>#</th>
                          <th>Electrician ID</th>
                          <th>Electrician Name</th>
                          <th>Electrician Number</th>
                          <th>State</th>
                          <th>City</th>
                          <th>Payment Amount</th>
                          <th>Total Leads</th>
                          <th>Remarks</th>
                          <th>Payment By</th>
                          <th>Activation Date</th>
                          <th>Created Date</th>
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

<!-- Service Activation -->
<div class="modal fade serviceActivationModal" tabindex="-1" aria-labelledby="employeeFeedBack" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <form action="{{ route('admin.service-activation.store') }}" class="validateForm" method="post">
            <input type="hidden" name="id" class="service_id">
            <div class="modal-body">
              <div class="row">
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>Electrician</label>
                       <select name="electrician_id" class="form-control electrician_id electricianDataOption"></select>
                       <span class="text-danger Errelectrician_id"></span>
                    </div>
                 </div> 
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>Electrician Id</label>
                       <input type="text" name="electrician_unique_id" class="form-control electrician_unique_id" value="">
                       <span class="text-danger Errelectrician_unique_id"></span>
                    </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>State</label>
                       <select name="state_id" class="form-control state_id">
                         <option value="" selected="" disabled="">Select State</option>
                       </select>
                       <span class="text-danger Errstate_id"></span>
                    </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>City</label>
                       <select name="city_id" class="form-control city_id">
                         <option value="" selected="" disabled="">Select City</option>
                       </select>
                       <span class="text-danger Errcity_id"></span>
                    </div>
                 </div> 
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>Payment Amount</label>
                       <input type="text" name="payment_amount" class="form-control payment_amount" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                       <span class="text-danger Errpayment_amount"></span>
                    </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>Number of Leads</label>
                       <input type="text" name="number_of_leads" class="form-control number_of_leads" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                       <span class="text-danger Errnumber_of_leads"></span>
                    </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>Service Activation Date</label>
                       <input type="date" name="service_activation_date" class="form-control service_activation_date" >
                       <span class="text-danger Errservice_activation_date"></span>
                    </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-6">
                    <div class="form-group">
                       <label>Remarks</label>
                       <select name="service_remarks" class="form-control service_remarks"></select>
                       <span class="text-danger Errservice_remarks"></span>
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

</x-admin-layout>
<script type="text/javascript">
  $(function () {
    let table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.service-activation.index') }}",
      columns: [
        {data: 'DT_RowIndex', orderable: false,searchable: false},
        {data: 'electrician_unique_id', name: 'electrician_unique_id'},
        {data: 'electrician_name', name: 'electrician_name'},
        {data: 'electrician_number', name: 'electrician_number'},
        {data: 'state', name: 'state'},
        {data: 'city', name: 'city'},
        {data: 'payment_amount', name: 'payment_amount'},
        {data: 'number_of_leads', name: 'number_of_leads'},
        {data: 'service_remarks', name: 'service_remarks'},
        {data: 'payment_by', name: 'payment_by'},
        {data: 'service_activation_date', name: 'service_activation_date'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action',  name: 'action',  orderable: false,   searchable: false },
      ],
      createdRow: function( row, data, dataIndex ) {
        $(row).attr('row-id',data.id+'-service_activation');
        $(row).attr('row-service_id',data.id);
        $(row).attr('row-electrician_id',data.electrician_id);
        $(row).attr('row-payment_amount',data.payment_amount);
        $(row).attr('row-number_of_leads',data.number_of_leads);
        $(row).attr('row-service_activation_date',data.service_activation_date);
        $(row).attr('row-service_remarks',data.service_remarks);
        $(row).attr('row-electrician_unique_id',data.electrician_unique_id);
      }
    });
  });


</script> 