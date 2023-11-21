<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/apexchart/chart-data.js') }}"></script>

<!-- Common setup -->
<script src="{{ asset('backend/assets/js/common/validation.js') }}"></script> 
<script src="{{ asset('backend/assets/js/common/validate.min.js') }}"></script> 

<script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Toaster Js Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- Toaster Js Link -->
<script src="{{ asset('backend/assets/js/script.js') }}"></script>
<script>let ajax = '{{ url('/') }}'</script>
<!-- Custom js -->
<script src="{{ asset('backend/assets/js/common/common_setup.js') }}"></script>
<script src="{{ asset('backend/assets/js/common/backend.js') }}"></script>

<script type="text/javascript">
	@if(session('warning'))
		toastr.error("{{ session('warning') }}");
		swal("", "{{ session('warning') }}", "warning");
	@endif
</script>