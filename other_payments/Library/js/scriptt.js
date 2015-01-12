 $(document).ready(function () {

 	$('#Credit_Card').click(function() {
	var status = $(this).attr('id');
	$('#cashed').val('');
	$('#credits').val('');
	$('#cc_name').val('');
	$('#cc_no').val('');
	$('#cc').val('');
	$('#cc1').val('');
	$('#cc2').val('');
	$('#chk1').val('');
	$('#chk2').val('');
	$('#date2').val('');
	$('#chk4').val('');
	$("#types").val(status);
	});

	$('#Cash').click(function() {
	var status = $(this).attr('id');
	$('#cashed').val('');
	$('#credits').val('');
	$('#cc_name').val('');
	$('#cc_no').val('');
	$('#cc').val('');
	$('#cc1').val('');
	$('#cc2').val('');
	$('#chk1').val('');
	$('#chk2').val('');
	$('#date2').val('');
	$('#chk4').val('');
	$("#types").val(status);
	});

	$('#Cheque').click(function() {
	var status = $(this).attr('id');
	$('#cashed').val('');
	$('#credits').val('');
	$('#cc_name').val('');
	$('#cc_no').val('');
	$('#cc').val('');
	$('#cc1').val('');
	$('#cc2').val('');
	$('#chk1').val('');
	$('#chk2').val('');
	$('#date2').val('');
	$('#chk4').val('');
	$("#types").val(status);
	});
	
	//Date pickers
	
	$('#date1').datepicker({
	format: "yyyy-mm-dd",
	autoclose: true,
	todayHighlight: true
	});  
	
	$('#date2').datepicker({
	format: "yyyy-mm-dd",
	autoclose: true,
	todayHighlight: true
	});
	
	
	//Form Submit
	
	$('#quickPay').click(function(event) {
   event.preventDefault();
   $.ajax({
		   url: "save.php",
		   type: "post",
		   data: $("#frms").serialize(),
		   dataType:'JSON',
		   success: function(response)
			{
			if(response.commitCode){
			$.ajax("printheadxy.php"),
			$('#modal-container-722600').modal('hide');
			$('#printPdf').modal('show');
			
			//$('#i').load('Library/components/iframe.php');
 $('#i').html('<iframe src="printheadxy.php" width="500px" height="500px" scrolling="no" >'+
'</iframe>');   
			}else{
			
			alert('There is an error');
			}
			}
       });
  });
	
	
	//Select currency according to Fee Stucture
	
	var getAccseptingCurrency = function(feeStructure){
	if (feeStructure.indexOf('|') != -1) {
	
	   $('.cur').text(feeStructure.substr(0, feeStructure.indexOf('|')));
	   $('#accept').val(feeStructure.substr(0, feeStructure.indexOf('|')));
	} else {
	
	 $('.cur').text('LKR');
	 $('#accept').val('LKR');
	}
	};
	
	//Retrive Student name while typing

	$("#reg_n").keyup(function(event){
	var txtVal = $.trim($('#reg_n').val());
	//event.preventDefault();
	   $.ajax({
		  type: "POST",
		  url: "filter.php",
		  data: {"reg_n": txtVal},
		  dataType:'JSON',
		  success: function(data) {
			  
		  getAccseptingCurrency(data['FEE']);
		  $('#submit-errors').show();
		  $('.getName').text(data['Name']);
		  $('#StuName').val(data['Name']);
		  $('.getBatch').text(data['Batch']);
		  }
		});
	  });
	

	//change currency type the execute below actions

	$('.detect_currency').click(function(){
		var a= $(this).attr('data-currency');
		$('.cur').text(a)
		$('#qq').val(a);
		$('#currency_cunverter').modal('show');
		$('#prep').text(a);
		
		});
		
	//Apply converted amount	
	
	$('#changcurr').click(function(){
		var s= $('#convertedAmount').val();
		$('#cashed').val(s);
		$('#credits').val(s);
		$('#chk1').val(s);
		$('#currency_cunverter').modal('hide');
		});
		
	//credit card currency selecter
		
	$('.detect_currency1').click(function(){
		var a= $(this).attr('data-currency');
		$('.cur').text(a);
		$('#qq').val(a);
		});	

	//cheqe card currency selecter


	$('.detect_currency2').click(function(){
		var a= $(this).attr('data-currency');
		$('.cur').text(a);
		$('#qq').val(a);
		});	
	
	
	//Retriving current currency rate from web
	
	
	$(document).on('click', '.detect_currency', function (event) {
		  $('.payingCurrency').text($(this).attr('data-currency')); 
	
	
		  $.ajax({
	
			  url: "http://esoftcareers.com/API/rates.json?jsonCallback?",
			  type: "GET",
			  jsonpCallback: 'jsonCallback',
			  contentType: "application/json",
			  dataType: 'JSONP',
			  success: function (response) {
	
				  var rateCurrency = $.trim($.trim($('#accept').val().substr(0,3)) + $.trim($('.cur').text().substr(0,3)));
			  	  console.log(rateCurrency);
				  $('#AmountAccspting').val(response[rateCurrency]);
			  }
		  });
	  });
	
	//Change amount according to currency rate
	
	$(document).on('keyup', '#AmountPaying', function (event) {
	
	var getValue = $(this).val() / $('#AmountAccspting').val(); 
	
	$('#convertedAmount').val(getValue.toFixed(2));

	});

	
});

