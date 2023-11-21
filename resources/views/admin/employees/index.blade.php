<x-admin-layout>
<div class="content container-fluid">
  <div class="page-header">
    <div class="page-title">
      <h4>Manage Employees</h4>
      <h6>Manage Employees</h6>
    </div>
    @if($addPermission)
      <div class="page-btn">
        <a class="btn btn-added" href="{{ route('admin.employee.create') }}"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Add  Employee</a>
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
                          <th>Name</th>
                          <th>Email</th>
                          <th>Number</th>
                          <th>Role</th>
                          <th>Lead Access</th>
                          <th>Status</th>
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
      ajax: "{{ route('admin.employee.index') }}",
      columns: [
        {data: 'DT_RowIndex', orderable: false,searchable: false},
        {data: 'profile', name: 'profile'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'number', name: 'number'},
        {data: 'role_id', name: 'role_id'},
        {data: 'lead_service_id', name: 'lead_service_id'},
        {data: 'status', name: 'status'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action',  name: 'action',  orderable: false,   searchable: false },
      ],
      createdRow: function( row, data, dataIndex ) {
        $(row).attr('row-id',data.id+'-employees');
      }
    });
  });
</script> 