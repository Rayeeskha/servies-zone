<x-admin-layout>
<div class="content container-fluid">
    <div class="page-header">
	  <div class="page-title">
	    <h4>Employee Login Logs</h4>
	    <h6>Employee Login Logs</h6>
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
                          <th>User Name</th>
                          <th>Role</th>
                          <th>IP Address</th>
                          <th>User Agent</th>
                          <th>Created at</th>
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
      ajax: "{{ route('admin.login-log.index') }}",
      columns: [
        {data: 'DT_RowIndex', orderable: false,searchable: false},
        {data: 'user_id', name: 'user_id'},
        {data: 'role_id', name: 'role_id'},
        {data: 'ip_address', name: 'ip_address'},
        {data: 'user_agent', name: 'user_agent'},
        {data: 'created_at', name: 'created_at'},
      ],
      createdRow: function( row, data, dataIndex ) {
        $(row).attr('row-id',data.id+'-role_masters');
      }
    });
    
  });
</script>	