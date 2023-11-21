<x-admin-layout>
<div class="content container-fluid">
  <div class="page-header">
	  <div class="page-title">
	    <h4>Role & Permissions</h4>
	    <h6>Manage Role & Permissions</h6>
	  </div>
    @if($addPermission)
	    <div class="page-btn">
	      <a class="btn btn-added" href="{{ route('admin.role-master.create') }}"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Add Role Permission</a>
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
                          <th>Role Name</th>
                          <th>Permission</th>
                          <th>Status</th>
                          <th>Created at</th>
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
      ajax: "{{ route('admin.role-master.index') }}",
      columns: [
        {data: 'DT_RowIndex', orderable: false,searchable: false},
        {data: 'name', name: 'name'},
        {data: 'permissions', name: 'permissions'},
        {data: 'status', name: 'status'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action',  name: 'action',  orderable: false,   searchable: false },
      ],
      createdRow: function( row, data, dataIndex ) {
        $(row).attr('row-id',data.id+'-role_masters');
      }
    });
  });
</script>	