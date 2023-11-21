<x-admin-layout>
<div class="content container-fluid">
  <div class="page-header">
    <div class="page-title">
      <h4>Contact us</h4>
      <h6>Contact us</h6>
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
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Subject</th>                          
                          <th>Message</th>
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
      ajax: "{{ route('admin.contact-us.index') }}",
      columns: [
        {data: 'DT_RowIndex', orderable: false,searchable: false},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'phone', name: 'phone'},
        {data: 'subject', name: 'subject'},
        {data: 'message', name: 'message'},
      ],
      createdRow: function( row, data, dataIndex ) {
        $(row).attr('row-id',data.id+'-contacts');
      }
    });
  });
</script> 