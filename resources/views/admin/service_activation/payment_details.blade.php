<x-admin-layout>
<div class="content container-fluid">
  <div class="page-header">
    <div class="page-title">
      <h4>Payment Details</h4>
      <h6>Payment Details</h6>
    </div> 
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
</x-admin-layout>

<script type="text/javascript">
  $(function () {
    let table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.payment-details.index') }}",
      columns: [
        {data: 'DT_RowIndex', orderable: false,searchable: false},
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
        $(row).attr('row-id',data.id+'-payment_details')
      }
    });
  });
</script>
