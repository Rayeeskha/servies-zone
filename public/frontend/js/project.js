$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// Lead Inquiry
$('.showLeadInquiryServices').click(function(){
	$('.leadInquiryServicesDiv').html('');
	$.ajax({
	    type:"GET",
	    url:ajax+'/lead-inquiry/lead-services/',
	    success:function(response){
	      $('.leadInquiryModal').modal('show');
	      $('.leadInquiryServicesDiv').html(response.inquiryPage);
	    }
	});
});

// State List
$(document).ready(function(){
    $('.state_list_select').change(function(){    	
     	var id=$(this).val();
	    $.ajax({
	      type:"GET",
	      url:ajax+'/get-cities/'+id,
	      async : true,
	      dataType : 'json',
	      success: function(response){
	        let resultData = response.cities;
	        let option = '';
	        $.each(resultData,function(index,row){
	          option+= '<option value='+row.id+' style="color: black">'+row.districts_name+'</option>';
	          $('.city_list').html(option); 
	        });
	      }
	    });
   	}); 
});