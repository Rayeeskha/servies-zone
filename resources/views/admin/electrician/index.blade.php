<x-admin-layout>
<div class="content container-fluid">
  <div class="page-header">
    <div class="page-title">
      <h4>Manage Electrician</h4>
      <h6>Manage Electrician</h6>
    </div>
    @if($addPermission)
      <div class="page-btn">
        <a class="btn btn-added" href="{{ route('admin.electrician.create') }}"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Add  Electrician</a>
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
                          <th>Profile</th>
                          <th>Electrician Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Number</th>
                          <th>State</th>
                          <th>City</th>
                          <th>Experience</th>
                          <th>Services</th>
                          <th>Status</th>
                          <th>Added By</th>
                          <th>Added date</th>
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
      ajax: "{{ route('admin.electrician.index') }}",
      columns: [
        {data: 'DT_RowIndex', orderable: false,searchable: false},
        {data: 'profile', name: 'profile'},
        {data: 'electrician_id', name: 'electrician_id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'number', name: 'number'},
        {data: 'state_id', name: 'state_id'},
        {data: 'city_id', name: 'city_id'},
        {data: 'work_experience', name: 'work_experience'},
        {data: 'lead_service_id', name: 'lead_service_id'},        
        {data: 'status', name: 'status'},
        {data: 'added_by', name: 'added_by'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action',  name: 'action',  orderable: false,   searchable: false },
      ],
      createdRow: function( row, data, dataIndex ) {
        $(row).attr('row-id',data.id+'-employees');
      }
    });
  });
</script> 