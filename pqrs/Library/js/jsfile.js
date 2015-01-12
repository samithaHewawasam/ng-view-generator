$(document).ready(function () {
 
  // $('#CC_Start_Date').daterangepicker({ startDate: '2014-03-05', endDate: '2014-03-06' });}
 //$('#CC_Start_Date').data('daterangepicker').setOptions(optionSet2, cb);				  
$('#CC_Start_Date').daterangepicker({format: 'YYYY-MM-DD',separator: ' to ',ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Year This Month': [moment().startOf('month').subtract('years', 1), moment().endOf('month').subtract('years', 1)],
                       'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                       'Last Year Last Month': [moment().subtract('month', 1).startOf('month').subtract('years', 1), moment().subtract('month', 1).endOf('month').subtract('years', 1)],
                       'This Year': [moment().startOf('year'), moment()],
                       'Last Year': [moment().startOf('year').subtract('years', 1), moment().subtract('years', 1)]
                    }});	
$('#CC_End_Date').daterangepicker({format: 'YYYY-MM-DD',separator: ' to ',ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Year This Month': [moment().startOf('month').subtract('years', 1), moment().endOf('month').subtract('years', 1)],
                       'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                       'Last Year Last Month': [moment().subtract('month', 1).startOf('month').subtract('years', 1), moment().subtract('month', 1).endOf('month').subtract('years', 1)],
                       'This Year': [moment().startOf('year'), moment()],
                       'Last Year': [moment().startOf('year').subtract('years', 1), moment().subtract('years', 1)]
					   }});	
	// $('#date2').daterangepicker();	
 
	
	
//-----------------	mouseover


  //-----------------tooltip
	 $("#daterange").tooltip({
		title : "Date Range Area"
	});
	 
 	$("#left_arrow").click(function(e){ 
		e.stopPropagation();	
		$('#side_panel').show();
			
  	}); 
 	$("#right_arrow").click(function(e){
		e.stopPropagation();
		$('#side_branch').show();
  	}); 
 	$("#FormHide,#content").click(function(e){
								 
		$('#side_panel').hide();
		$('#side_branch').hide();
	
  	}); 
	 
 });//end line

 