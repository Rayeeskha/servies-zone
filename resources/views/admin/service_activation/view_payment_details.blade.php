<x-admin-layout>
<div class="content container-fluid">
  <div class="page-header">
    <div class="page-title">
      <h4>Payment Details</h4>
      <h6>Payment Details</h6>
    </div> 
    @if(!is_null($electrician))
      <div class="page-btn">
        <a class="btn btn-added" href="{{ route('admin.payment-details.index') }}"><img src="{{ asset('backend/assets/img/icons/plus.svg') }}" alt="img" class="me-1">Back to payment</a>
      </div>
    @endif   
  </div>
  <div class="row">
      <div class="col-sm-12">
         <div class="card">
         	<div class="card-header">
         		@if(!is_null($electrician))
         			<h4>Electrician Name : {{@$electrician->name}}</h4>
         			<input type="hidden" name="electrician_id" value="{{ $electrician->id }}">
         		@endif
         	</div>
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
                        </tr>
                     </thead>
                     <tbody>                      
                       @foreach($paymentDetails ?? '' as $payments)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $payments->electrician->name ?? "N/A" }}</td>
                          <td>{{ $payments->electrician->number ?? "N/A" }}</td>
                          <td>{{ $payments->electrician->state->states_name ?? "N/A" }}</td>
                          <td>{{ $payments->electrician->city->districts_name ?? "N/A" }}</td>
                          <td>{{ @$payments->payment_amount }}</td>
                          <td>{{ @$payments->number_of_leads }}</td>
                          <td>
                            @if($payments->service_remarks == 'Reneval')
                              <span class='badge badge-danger' style='background-color:orange'>{{ @$payments->service_remarks }}</span>
                            @else
                              <span class='badge badge-danger' style='background-color:green'>{{ @$payments->service_remarks }}</span>
                            @endif                           
                          </td>
                          <td>{{ $payments->paymentBy->payment_by_name ?? "N/A" }}</td>
                          <td>{{ date('d M Y',strtotime($payments->service_activation_date)); }}</td>
                          <td>{{ date('d M Y',strtotime($payments->created_at)); }}</td>
                        </tr>
                       @endforeach                       
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
  </div>
</div>
</x-admin-layout>


