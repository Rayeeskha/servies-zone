function onClickHandlerModule(argument) {
  $("#" + argument+'_add').prop('checked', false);
  $("#" + argument+'_edit').prop('checked', false);
  $("#" + argument+'_delete').prop('checked', false);
}

function onClickHandler(argument) {
  var withoutLastChunk = argument.slice(0, argument.lastIndexOf("_"));
  $("#" + withoutLastChunk).prop('checked', true);
}

function feedBackModal(id, slug){
  let title = "Electrician Feedback";
  if (slug == "employee") {
    title = "Employee Feedback";
  }
  $('.modal-title').html(title);
  $('.lead_inquiry_id').val(id);
  $('.lead_inquiry_type').val(slug);
  $('.feedBackModal').modal('show');
}

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
          option+= '<option value='+row.id+'>'+row.districts_name+'</option>';
          $('.city_list').html(option); 
        });
      }
    });
  }); 
});

// Add Service  Activation
$('.addServiceActivation').click(function() {
  $('.text-danger').html('');
  $('.state_id').html('');
  $('.city_id').html('');
  $('.validateForm')[0].reset();
  $('.modal-title').html('Service Activation');
  // Get Single Employee
  getEmployees();
  // Service Remarks
  serviceActivationRemarks();
  $('.serviceActivationModal').modal('show');
});

//Edit Service  Activation
$(document).on('click','.editServiceActivationData',function(){
  $('.text-danger').html('');
  $('.validateForm')[0].reset();
  $('.modal-title').html('Reneval Service Activation');
  let selector = $(this);
  let tr  = selector.closest('tr');   
  // Electrician
  $('.service_id').val(tr.attr('row-service_id'));
  $('.payment_amount').val(tr.attr('row-payment_amount'));   
  $('.number_of_leads').val(tr.attr('row-number_of_leads'));
  $('.service_activation_date').val(tr.attr('row-service_activation_date'));
  $('.electrician_unique_id').val(tr.attr('row-electrician_unique_id'));
  //Get sigle Employee 
  getEmployees(tr.attr('row-electrician_id'));
  // Electrician Address
  getElectricianRowData(tr.attr('row-electrician_id'));
  // Service Remarks 
  let remarks = tr.attr('row-service_remarks');
  let remarksValue = 'Activation';
  if (remarks == "<span class='badge badge-danger' style='background-color:orange'>Reneval</span>") {
    remarksValue = 'Reneval';
  }
  serviceActivationRemarks(remarksValue);
  $('.serviceActivationModal').modal('show');
});

$(document).ready(function(){
  $('.electrician_id').change(function(){      
    var id=$(this).val();
    getElectricianRowData(id);
  }); 
});

// Get Single Electrician
function getElectricianRowData(electricianId){ 
  let stateOption = '';
  let cityOption = ''; 
  $.ajax({
    type:"GET",
    url:ajax+'/admin/get-electrician/'+electricianId,
    async : true,
    dataType : 'json',
    success: function(response){
      let state = response.state;
      let city = response.city;  
      let electricianId = response.electricianId;  
      stateOption += '<option>'+state+'</option>';
      $('.state_id').html(stateOption);
      cityOption += '<option>'+city+'</option>';
      $('.city_id').html(cityOption); 
      $('.electrician_unique_id').val(electricianId);
    }
  });
}


// Get All Electrician with selected if id found
function getEmployees(electricianId =  ''){
  $.ajax({
    type:"GET",
    url:ajax+'/admin/get-all-electrician',
    async : true,
    dataType : 'json',
    success: function(response){
      let electriciansData = response.electricians;
      console.log(electriciansData);
      let option = '';
      option = '<option value="" selected="" disabled="">Select Electrician</option>';
      $.each(electriciansData,function(index,row){
        let selected = "";
        if (electricianId == row.id) {
          selected = "selected";
        }
        option += '<option value='+row.id+' '+selected+'>'+row.name+'</option>';
        $('.electricianDataOption').html(option);
      });
    }
  });
}

// Service Activation Remarks
function serviceActivationRemarks(type=''){
  let  remarksData = ["Activation", "Reneval"];
  let option = '';
  $.each(remarksData,function(index,row){
    let selected = '';
    if (row == type) {
      selected = "selected";
    }
    option += '<option value='+row+' '+selected+'>'+row+'</option>';
    $('.service_remarks').html(option); 
  });
}