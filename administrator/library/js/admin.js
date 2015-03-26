$(document).ready(function () {
function AjaxFun(Url, Data) {
    return $.ajax({
        url: Url,
        type: "POST",
        data: Data
    });
}


//Table Row Delete Function
 function DeleteTableRow(){
	$(".delete").click(function(){
	

         if(confirm('Do you want to delete?'))
		 {   
				 
				 
				  var sss=$(this).attr('delete');
	
                   $.ajax({

                    url: "Controller/deleterow.php",
                    type: "POST",
                    data:{deletedata:sss},

                    success: function (response) {
					
                    if(!isNaN(response))
					{
				     $('#'+response).remove();
                     }
                    }
                });	
			
			}	 
   
	 });
	 }	
//Table Row Delete Function end





//Table Row Edit Function
 function EditTableCell() {
	
   $('.edit').editable({
    type: 'text',
    url: 'Controller/saveupdate.php',
    title: 'Enter Value',
	success: function(response, newValue) { }
    });	 
};	
//Table Row Edit Function End

 

//Load Bootstrap Table Sorter

//Load Bootstrap Table Sorter End
	function PaginationAndSearch(event,eventselecter,url,dataform){
	      var data_save = $(dataform).serializeArray();
				 
                var page = $(eventselecter).attr('href');
                if (page) {
					
                    var per_page = $('#PagiN_Reg .per_page').val();
                    page = page.substring(1);;
                    data_save.push({
                        name: "Page",
                        value: page
                    });
                    data_save.push({
                        name: "per_page",
                        value: per_page
                    });

                }
                $('#content').html('<h1 align="center"><img align="middle"  src="library/img/loader.gif" ></h1>');

                AjaxFun(url, data_save).done(function (result) {
                    $('#content').html(result);
                    //EditTableCell();

                });	
		
	}  

	//Call Date Picker						
   $('.dp3').datepicker();
	//Call Date Picker	End	
   
  //Admin Menu Link Click Actions
$('#AdminMainMenu .link').click(function (e) {
  e.preventDefault();
 var href= $(this).attr('href');
 switch(href)
{
case '#SystemSettings':
 $('#SystemSettingsFormDiv').load('View/SysSettingsForm.php',function(){
		$('#SystemSettingsFormDiv').modal();
		 $('.dp3').datepicker();
		 $("#SysSettingsSave").click(function() {
                AjaxFun('Controller/saveSysSettings.php', $('#SysSettingsForm').serializeArray()).done(function (result) {
                    $('#SysSettingBody').html(result);
                });	
});															  
																	  });	  
break;	
case '#SystemUpdate' :
  $('#content').html('<h3 align="center">Wait We are checking for system updates..</br><img align="middle"  src="library/img/loader.gif" ></h3>');
                AjaxFun('Modal/SystemUpdate.php', {UpdateNoW:'UpdateNoW'}).done(function (result) {
 $('#content').html(result);
                });	
break;	
case '#RerintInvoice' :
 $('#CommonModal').load('View/RerintInvoiceForm.php',function(){
		$('#CommonModal').modal();
		
   $("#ReprintCheckCheck").click( function(){
	   
     $('#InvoicePreview').html('<iframe src="View/printheadxy.php?PM_Receipt_No='+$('#ReprintInvoiceNum').val()+'" width="500px" height="500px" scrolling="no" >'+
'</iframe>');       
	
			 
				});
   });	

break;
case '#RegCountBDwiseForm' :
 $('#CommonModal').load('View/RegCountBDwiseForm.php',function(){
		$('#CommonModal').modal();
		 $('.dp3').datepicker();
		 
		$("#RegCountBDwiseForm").submit(function( event ) {
event.preventDefault();
 AjaxFun('Controller/RegCountBDwise.php', $("#RegCountBDwiseForm").serializeArray()).done(function (result) {
                    $('#content').html(result);
		$('#CommonModal').modal('hide');

                });	

});
 
   });	
break;
case '#CollectionsSummaryForm' :
 $('#CommonModal').load('View/CollectionsSummaryForm.php',function(){
		$('#CommonModal').modal();
		 $('.dp3').datepicker();
		 
		$("#CollectionsSummary").submit(function( event ) {
event.preventDefault();
 AjaxFun('Controller/CollectionSummary.php', $("#CollectionsSummary").serializeArray()).done(function (result) {
                    $('#content').html(result);
		$('#CommonModal').modal('hide');

                });	

});
 
   });	
break;

case '#RerintRegCard' :
 $('#CommonModal').load('View/RerintRegCardForm.php',function(){
		$('#CommonModal').modal();
		
   $("#ReprintCheckCheck").click( function(){
	   
     $('#InvoicePreview').html('<iframe src="View/PrintRegCard.php?RegNo='+$('#ReprintInvoiceNum').val()+'" width="500px" height="500px" scrolling="yes" >'+
'</iframe>');       
	
			 
				});
   });	

break;	

case '#RegsearchForm' :
$('#RegSearchFormDiv').show();
   $("#RegSearchFormSubmit").click( function(){
													  
		
			var RegSearchForm=$("#RegSearchForm").serializeArray();	
			
  $.ajax({
                    url: "Controller/RegSearch.php",
                    type: "POST",
                    data:RegSearchForm,

                    success: function (response) {
					 $('#content').html(response);
 $(document).on('click','#RegistrationSearch #PagiN_Reg .goto',function (event) {
             event.preventDefault();
				PaginationAndSearch(event,this,'Controller/RegSearch.php','#RegSearchForm')
				
          
            });


                    }
       });
});										  


break;	




}

 
  }); 
   
   
    $("body").on("click","#IncomeReportSerchFormOpen", function(){
													  
		$('#IncomeReportSerchFormDiv').modal();											  
													  
	});

    $("#IncomeReportSerchFormSave").click(function(){
												  
			var IncomeReportData=$("#IncomeReportSerchForm").serializeArray();	
		
  $.ajax({
                    url: "Controller/IncomeReport.php",
                    type: "POST",
                    data:IncomeReportData,

                    success: function (response) {
                    $('#content').html(response);
					
                    }
       });
  
  $('#IncomeReportSerchFormDiv').modal('hide');	
  
  
  });
	
	

	
 $(document).on('click', '#TableWizard #PagiN_Reg .goto', function (event) {
             event.preventDefault();
				PaginationAndSearch(event,this,'Controller/tableload.php','#SearchForm')
				
          
            });

 $(document).on('keypress', '#TableWizard #SearchForm input', function (event) {
    if (event.which == 13) {
					 event.preventDefault();											   
				PaginationAndSearch(event,this,'Controller/tableload.php','#SearchForm')
			
   }
});


///Load Table From Table Name
 $("body").on("click",".tname", function() {
										 
	var Table=$(this).attr('TableName');
  $.ajax({

                    url: "Controller/tableload.php",
                    type: "POST",
                    data:{Table:Table},

                    success: function (response) {
                  $('#content').html(response);
				  //run my table
                  		//EditTableCell();


                    }
                });		

});
//Load Table From Table Name End
///Load New Sys User Form
 $(document).on("click","#NewSysUserLink", function() {
$('#SysUserBody').show();
$('#NewSysUserResDiv').html('');
$('#NewSysUserFormDiv').modal();	
});
 $('#SysUserSave').click(function() {
var NewSysUserData=$("#NewSysUserForm").serializeArray();
  $.ajax({

                    url: "Controller/SysUserSave.php",
                    type: "POST",
                    data:NewSysUserData,

                    success: function (response) {
                  $('#NewSysUserResDiv').html(response);
				  
				  $('#SysUserBody').hide();
                 $('#NewSysUserForm')[0].reset();


                    }
                });		});

// $(document).ready end	
$(document).off('click','#DeleteRegistration');				 
   $("body").on("click","#DeleteRegistration", function(){
													  
		$('#DeleteRegistrationDiv').modal();
		$('#DeleteRegistrationResponse').empty();
		
		 $("#DeleteRegistrationCheck").unbind().click(function(){
															   
			var Registration=$("#DeleteRegistrationForm").serializeArray();	
  $.ajax({
                    url: "Controller/DeleteReg.php",
                    type: "POST",
                    data:Registration,

                    success: function (response) {
					
					
                    $('#DeleteRegistrationResponse').html(response);
					
					$('#DeleteRegistrationDiv').modal().css( {'top':80});
				
                    }
       });
});										  
	
/////////////////////
     $("#DeleteRegistrationDiv").off("click", "#DeleteRegPermanent");	
	 $("#DeleteRegistrationDiv").on('click',"#DeleteRegPermanent",function(){
  if(confirm('Do you want to delete?'))
		           {   
		 			var RegNo=$("#RegNo").html();	
  $.ajax({
                    url: "Controller/DeleteReg.php",
                    type: "POST",
                    data:{DeleteReg:'DeleteReg',RegNo:RegNo},

                    success: function (response) {
                    $('#DeleteRegistrationResponse').html(response);
				
                    }
       });
	   }
});	
//////////////////////												  
	});




////////////////////////////////////////
///////////////////////////////////////
$(document).off('click','.View');				 
$(document).on('click','.View',function(e){
e.preventDefault();
var SMID=$(this).attr('data');
 $.ajax({
                    url: "Controller/RegSearch.php",
                    type: "POST",
                    data:{SMID:SMID,ViewDetais:"ViewDetais"},

                    success: function (response) {
					 $('#ViewRegMainDiv').html(response);
					$('#ViewRegMainDiv').modal().delay( 800 );
                  
                    }
       });
	   
});
/////////////////////////////////////
$(document).off('click','#DeletePayment');				 
   $(document).on("click","#DeletePayment", function(){
					$('#DeletePaymentResponse').empty();
		$('#DeletePaymentDiv').modal();
		 $("#DeletePaymentCheck").unbind().click(function(){
			var Registration=$("#DeletePaymentForm").serializeArray();	
  $.ajax({
                    url: "Controller/DeletePayment.php",
                    type: "POST",
                    data:Registration,

                    success: function (response) {
                    $('#DeletePaymentResponse').html(response);
					$('#DeletePaymentDiv').modal().css( {'top':80});
				
                    }
       });
});	
     $("#DeletePaymentDiv").off("click", "#DeletePaymentPermanent");	
	 $("#DeletePaymentDiv").on('click',"#DeletePaymentPermanent",function(){
  if(confirm('Do you want to delete this payment?'))
		           {   
				   
				   	var RegNo=$("#RegNoDel").html();	
		 			var PM_Receipt_No=$("#PM_Receipt_No").text();	
		 			var PM_Amount=$("#PM_Amount").text();	
		 			var PM_Amount=$("#PM_Amount").text();
		 			var excessPayment=$("#excessPayment").text();	
		 			var Currency_rate=$("#Currency_rate").val();	
				   
  if(excessPayment>0) {
  if(confirm('There is an excess payment, Do you want to prcceed?'))
		           {
					
				   }
				   else
				   {
					return false;   
				   }
					   }

				   

  $.ajax({
                    url: "Controller/DeletePayment.php",
                    type: "POST",
                    data:{DeletePayment:'DeletePayment',PM_Receipt_No:PM_Receipt_No,PM_Amount:PM_Amount,excessPayment:excessPayment,RegNo:RegNo,Currency_rate:Currency_rate},

                    success: function (response) {
                    $('#DeletePaymentResponse').html(response);
				
                    }
       });
	   }
});	
//////////////////////												  
	});		


/*
 
 // All JS for Batch Edit Start
 
 */
 
///Load New Edit Batch Form
 $(document).on("click","#EditBatchLink", function() {
$('#CheckBatchResDiv').html('');												   
$('#EditBatchFormDiv').modal();	
 $('#CheckBatchForm').submit(function(e) {
 e.preventDefault();
var CheckBatchForm=$("#CheckBatchForm").serializeArray();
  $.ajax({

                    url: "Controller/Editbatchform.php",
                    type: "POST",
                    data:CheckBatchForm,

                    success: function (response) {
                    $('#CheckBatchResDiv').html('');
                    $('#CheckBatchResDiv').append(response);
                   $('#EditBatchFormDiv').modal().css( {'top':80});

			        //$('#EditBatchFormDiv').modal().css( {'margin-top': function () { return -($(this).height() / 2); }});

				     $('.dp3').datepicker();

                    $("#EdBM_Commence_Date").change(function() {
						if($('#EdC_Intake').val()!='Yes')	{							   
						var m_names = {
                    "01": "JAN",
                    "02": "FEB",
                    "03": "MAR",
                    "04": "APR",
                    "05": "MAY",
                    "06": "JUN",
                    "07": "JUL",
                    "08": "AUG",
                    "09": "SEP",
                    "10": "OCT",
                    "11": "NOV",
                    "12": "DEC"
                };		
				var BM_Commence_Date = $('#EdBM_Commence_Date').val();
                    var parts = BM_Commence_Date.split("-");
                    var part2 = m_names[parts[1]] + '/' + parts[0];
                   
                   
                    $('#EdBM_Target_Exam').val(part2);
					
				var Duration=$("#EdDuration").val();
						}
              });
					
	

                    }
                });	
  

});
 
 
  $(document).on('click','#batchMasterUpdate',function() {
										
var batchMasterForm=$("#EditbatchMasterForm").serializeArray();
$.ajax({

                    url: "Controller/Editbatchform.php",
                    type: "POST",
                    data:batchMasterForm,

                    success: function (response) {
                  //$('#CheckBatchResDiv').html('');
				 
                  $('#CheckBatchResDiv').html(response);

                   

                    }
                });	
					
                });					 
					 
});
 /*
 // All JS for Batch Edit  End
 */
 
 /*
 // All JS for Student Edit Start 
 */

$(document).on("click","#EditStudentLink", function() {
$('#CheckStudentResDiv').html('');													
$('#EditStudentFormDiv').modal();	
 $('#StudentCheck').click(function() {
							
var CheckStudentForm=$("#CheckStudentForm").serializeArray();
  $.ajax({

                    url: "Controller/EditStudentform.php",
                    type: "POST",
                    data:CheckStudentForm,

                    success: function (response) {
							  

                    $('#CheckStudentResDiv').html('');													
                    $('#CheckStudentResDiv').append(response);
					 $('.dp3').datepicker();
				   $('#EditStudentFormDiv').modal().css( {'top':80});
 
				  //run my table
                    }
                });	
  

});
});

  $(document).on('click','#StudentMasterUpdate',function() {
										
var StudentMasterForm=$("#EditStudentMasterForm").serializeArray();
$.ajax({

                    url: "Controller/EditStudentform.php",
                    type: "POST",
                    data:StudentMasterForm,

                    success: function (response) {
						
                  //$('#CheckBatchResDiv').html('');
                  $('#CheckStudentResDiv').html(response);
				  //run my table


                    }
                });	
					
                });					 

});
//end
