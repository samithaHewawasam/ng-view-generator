/* ===========================================================
 * ===========================================================
 * ===========================================================
 * Pre Defined Functions Start....
 * ===========================================================
 * ===========================================================
 * ===========================================================*/
 
 var google=null;
 var loderimg='<h1 align="center"><img align="middle"  src="Library/img/loader.gif" ></h1>';
 function createOptions(data){
var html = '',selected;
	if(data.n){
        html += '<option value=""  >' + data.n + '</option>';
	
	}else{	
$.each(data, function( index, value ) {
		  
					  
	if(value=='s'){selected='selected="selected"'; }else{ selected='';}				  
        html += '<option value="' + index + '" '+selected+' >' + index + '</option>';
	
							}); 
}

	return html;
 }
 			function BatchLoad(Data){
				$('#BatchSelect').html('<option value="" >Loading...<option>');
				  AjaxFun('Controller/BatchMenu.php',Data,'json').done(function (result) {
               $('#BatchSelect').html(createOptions(result));
            });
			}
			function CourseLoad(Data,selectid){
				$(selectid).html('<option value="" >Loading...<option>');
		 AjaxFun('Controller/CourseMenu.php',Data,'json' ).done(function (result) {
                    $(selectid).html(createOptions(result));
			 });
			}
			function IntakeLoad(Data){
				$('#IntakeSelect').html('<option value="">Loading...<option>');
		 AjaxFun('Controller/IntakeMenu.php',Data,'json' ).done(function (result) {
                    $('#IntakeSelect').html(createOptions(result));
			 });
			}
			function DivisionLoad(Data){
				$('#DivisionSelect').html('<option>Loading...<option>');
		 AjaxFun('Controller/DivisionMenu.php',Data,'json' ).done(function (result) {
                    $('#DivisionSelect').html(createOptions(result));
			 });
			}
function AjaxFun(Url,Data,DataType) {
	if(!DataType){
DataType='html';
}
    return $.ajax({
		dataType: DataType,		  
        url: Url,
        type: "POST",
        data: Data
    });
}
//Google Chart    
// google.setOnLoadCallback(drawChart);

$.fn.OwnerShipChange = function (ResponseDiv) {
    $(this).change(function () {
        AjaxFun('Controller/BranchList.php', {
            OwnerShip: $(this).val()
        }).done(function (result) {

            $(ResponseDiv).html(result);
        });

    });
}


function CountCommonFromLoad() {
$('.link').click(function (e) {
 e.preventDefault();
var FormTopic,SubmitBtn,report,D1,D2,rgst,btnclass,FormName; 
rgst=1;
btnclass='#47A447';
$('#VerStatusDiv').hide();
$('#Batchdiv').show();
$('#Intaketatus').show();
var href=$(this).attr('href'); 
 href=href.substring(1);
       switch (href) {
        case 'TotalDues':
		$('#DateRangeTwo').hide();
		FormTopic='Total Dues Count Form';
		SubmitBtn='Total Dues Report';
		report='TotalDuesSummery';
		FormName='TotalDuesSummery';
		D1=1;
		D2=0;
		btnclass='#47A447';
		rgst=1;
		 break;
        case 'RegistrationCount':
		FormTopic='Registration Count Form'
		SubmitBtn='Registration Count Report'
		report='RegistrationCountSummery';
		FormName='RegistrationCountSummery';
		D1=1;
		D2=1;
		btnclass='#47A447';
		rgst=1;
		 break;
        case 'RegistrationCountCustom':
		FormTopic='Custom Registration Count Form'
		SubmitBtn='Custom Registration Count Report'
		report='RegistrationCountCustom';
		FormName='RegistrationCountCustom';
		D1=1;
		D2=1;
		btnclass='#47A447';
		rgst=1;
		 break;
        case 'Income':
		FormTopic='Income Summary Form'
		SubmitBtn='Income Summary Report'
		report='IncomeSummery';
		FormName='IncomeSummery';
		D1=1;
		D2=1;
		rgst=0;
		btnclass='#47A447';
		 break;
        case 'SubjectCount':
		FormTopic='Subject wise Count Form'
		SubmitBtn='Subject wise Count'
		report='CommonSummery';
		FormName='SubjectCountDetail';
		D1=0;
		D2=0;
		rgst=1;
		btnclass='#47A447';
		 break;
        case 'BatchWise':
		FormTopic='Batch Wise Student Details'
		SubmitBtn='Batch Wise Details'
		report='CommonSummery';
		FormName='BatchWiseStuDetails';
		D1=0;
		D2=0;
		rgst=1;
		btnclass='#47A447';
		 break;
        case 'AttendanceSummery':
		FormTopic='Attendance  Details'
		SubmitBtn='Attendance '
		report='CommonSummery';
		FormName='AttendanceSheet';
		D1=1;
		D2=0;
		rgst=1;
		btnclass='#47A447';
		 break;
        case 'BatchList':
		//$('#Intaketatus').hide();
		FormTopic='Batch  List'
		SubmitBtn='Batch List '
		report='CommonSummery';
		FormName='BatchList';
		D1=0;
		D2=0;
		rgst=0;
		btnclass='#47A447';
		$('#Batchdiv').hide();
		 break;
        case 'StudentCheckList':
		FormTopic='Student Check List'
		SubmitBtn='Student Check List'
		report='CommonSummery';
		FormName='StudentCheckList';
		D1=0;
		D2=0;
		rgst=1;
		btnclass='#47A447';
		 break;
        case 'BatchWiseFull':
		FormTopic='Batch Wise Student Full Details'
		SubmitBtn='Batch Wise Full Details'
		report='BatchWiseStuDetailsFull';
		FormName='BatchWiseStuDetailsFull';
		D1=0;
		D2=0;
		rgst=1;
		btnclass='#47A447';
		break;
        case 'StudentVerify':
		FormTopic='Student Verification'
		SubmitBtn='Student Verification Details'
		report='CommonSummery';
		FormName='StudentVerifyList';
		D1=1;
		D2=0;
		rgst=1;
		btnclass='#47A447';
       $('#VerStatusDiv').show();
		 break;
        case 'AgingReport':
		$('#DateRangeTwo').hide();
		FormTopic='Due Aging Report Form';
		SubmitBtn='Due Aging Report';
		report='AgingReport';
		FormName='AgingReport';
		D1=0;
		D2=0;
		btnclass='#47A447';
		rgst=1;
		 break;
        case 'AgingReportAttendance':
		$('#DateRangeTwo').hide();
		FormTopic='Attendance Aging Report Form';
		SubmitBtn='Attendance Aging Report';
		report='AgingReportAttendance';
		FormName='AgingReportAttendance';
		D1=0;
		D2=0;
		btnclass='#47A447';
		rgst=1;
		 break;
        case 'AgingReportPayment':
		$('#DateRangeTwo').hide();
		FormTopic='Payment Aging Report Form';
		SubmitBtn='Payment Aging Report';
		report='AgingReportPayments';
		FormName='AgingReportPayments';
		D1=0;
		D2=0;
		btnclass='#47A447';
		rgst=1;
		 break;
        case 'InstallmentAging':
		$('#DateRangeTwo').hide();
		FormTopic='Installment Analysis Report Form';
		SubmitBtn='Installment Analysis Report';
		report='InstallmentAging';
		FormName='InstallmentAging';
		D1=0;
		D2=0;
		btnclass='#47A447';
		rgst=1;
		 break;
	   }

        $('#CommonFormTopic').text(FormTopic);
		
       // $('#CountCommon_Form').val(href);
        $('#CountCommon_Form').find('.CountCommon_Save').text(SubmitBtn).attr('report',report).attr('FormName',FormName).attr('date1',D1).attr('date2',D2).attr('rgst',rgst).css('background-color',btnclass);
        if(D1){$('#FirstDRDiv').show();}else{$('#FirstDRDiv').hide();}
        if(D2){$('#SecondDRDiv').show();}else{$('#SecondDRDiv').hide();}
        if(rgst){$('#RgStatus').show();}else{$('#RgStatus').hide();}
        $('#side_panel').show();


		});

}
//----------------------
function PaginationAndSearch(url,dataform,DrawChart){
            
			 $(document).off('click','#PagiN_Trn .goto');
$(document).on('click','#PagiN_Trn .goto',function (event) {
 event.preventDefault();

	      var data_save = $(dataform).serializeArray();
				
                var page = $(this).attr('page');
                var bset = $('#bset').val();
				
                if (page) {
					
                    var per_page = $('.per_page').val();
					
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

                AjaxFun(url, data_save).done(function (result) {
						if(bset==1){
					$('#content').html(result);		
						}
						else
						{
                    $('#CommonModalBody').html(result);
                    //EditTableCell();
						}
					
if(DrawChart){
           drawChart(DrawChart);
}
				 });
 });
		
	}  
//----------------------
function ReloadTable(url,dataform,DrawChart,Div){
	if(!Div){var Div='#CommonModalBody';}

	 dataform.push({
                        name: 'Reload',
                        value: 'Reload'
                    });
       AjaxFun(url,dataform).done(function (results){ $(Div).html(results);
			if(DrawChart){ 
           drawChart(DrawChart);
}																						 
																									 });	
}
//----------------------
function CreateSheet(results,divID){
var result=$.parseJSON(results);
$(divID).html('');
		
		

var textboxvalue = result.form_date[0]; 
var textboxvalue2 =  result.form_date[result.form_date.length - 1];  
var d = new Date(textboxvalue);
var weekday=new Array(7);
weekday[0]="SUN";
weekday[1]="MON";
weekday[2]="TUE";
weekday[3]="WEN";
weekday[4]="THU";
weekday[5]="FRI";
weekday[6]="SAT";
weekday[7]="SUN";
weekday[8]="MON";
weekday[9]="TUE";
weekday[10]="WEN";
weekday[11]="THU";
weekday[12]="FRI";
weekday[13]="SAT";

 var s="<h4>Student Attendance Sheet.</h4><a href='"+result.reportlink+"'>Export to Exel</a><button class='close' aria-hidden='true' data-dismiss='modal' type='button'>X</button><table class='table table-hover' align='center'><tr> <th class='reg'>Reg No</th>";
 for(var i=0;i<7;i++){
s+="<th>"+weekday[d.getDay()+i] +"</th>";
 }
  s+='</tr>';                
	
		//alert(T);
			//$('#CommonModalBody').html(T);
if(result.fixed_arrays.length){
		$(result.fixed_arrays).each(function(indexreg,valuereg){
		//var s=null;									 
        var i=1;	
		s+='<tr><td>' +this.REG+'</td>';
		var D=this.DATE;
		var img

		$(result.form_date).each(function(index,value){

				if(D.indexOf(value)<0){
    img="<center style='background-color:#D8D8D8'><br> </center>";
	 
	 
	img="<center style='background-color:#E0ECF8'><span>"+value+"</span><span><br><img src='Library/img/blank.png'/></span></center>";
	 
	 
 				}else{
				
     img="<center style='background-color:#A9D0F5'><span>"+value+"</span><span><br><img src='Library/img/chk.png'/></span></center>";
				};
				

		if (i % 8 == 0){
		}
		if (i % 7 == 0){

		s+='<td id='+value+' class="date">'+img+'</td>'+'</tr><tr>'+'<td></td>';
		}
		else
		{
		s+='<td id='+value+' class="date">'+img+'</td>';
		}
		
		i=i+1;
		});
		
		s+='</tr>';
		
		//$('#detls').append(s);

		//$('#detls').append ('<tr><td>' +this.REG+'</td></tr>');

		});
				s+='</tr>';
				
	//$('#Tbody').append(s);
}
                s+=' </tr></table>';

	$(divID).html(s);


}
//---------------------
function CountCommonFromSubmit() {

    //Common Count Form Submit
    $(document).on("click", ".CountCommon_Save", function () {
//$('body').modalmanager('loading');

$('#ajaxModal').modal();
			//	$('body').modalmanager('loading');	
        var FormPage = $(this).attr('report');
		var divID='#CommonModalBody';
		var data_save=$('#CountCommon_Form').serializeArray();
		var modal=$(this).attr('show');
		var D1a=$(this).attr('date1');
		var D2a=$(this).attr('date2');
		var FormName=$(this).attr('FormName');
		var rgsta=$(this).attr('rgst');
		var bset=$(this).attr('bset');
					 data_save.push({
                        name: "Date1",
                        value: D1a
                    },{
                        name: "Date2",
                        value: D2a
                    },{
                        name: "RgStatus",
                        value: rgsta
                    },{
                        name: "FormName",
                        value: FormName
                    });
					 
					 
					 if($(this).attr('SelectedBranch')){

					 data_save.push({
                        name: "BranchCode",
                        value: $(this).attr('SelectedBranch')
                    });
					  data_save.push({
                        name: "View",
                        value: $(this).attr('format')
                    });
		//FormPage=href+'Detail';	
		
		}else
		{
		var BranchList =$('#side_branch_list').find('.BranchList').serializeArray();
		data_save = $.merge(BranchList, data_save);
		}
		
			if(FormName=='BatchList'){
				
	if($('#CourseSelect').val()=='All'){
	alert('Please select a Course for Batch Creation!');$('#ajaxModal').modal('hide');	return;
			}	
			}

if(bset==1 && FormPage=='CommonSummery'){
	FormPage=FormName;
divID='#content';
}


        AjaxFun('Controller/' + FormPage + '.php',data_save ).done(function (result) {
			//$('body').modalmanager('removeLoading');	
			
			$('#ajaxModal').modal('hide');

if(FormPage=='BatchList'){
	PaginationAndSearch('Controller/BatchList.php','#SearchFormQuery');			
			}

			var ChartDiv;
				if(FormPage=='AttendanceSheet'){
			CreateSheet(result,divID);
		    //$('#CommonModalBody').html(result);
			if(divID=='#CommonModalBody'){
			$('#CommonModal').modal();	
			}

			}
			else if(modal=='modal'){
		
				ChartDiv='drawChartModal';
				$('#CommonModalBody').html(result);
				$('#CommonModal').modal();
				
				}
			else{
				$('#content').html(result);
				ChartDiv='ChartDiv';
			}
           $('#side_panel').hide();
		$('#side_branch').hide();
		//$("#myTablex").tablesorter({ headers: { 5: { sorter: false },  6: { sorter: false } }});
		switch(FormPage){
			case 'IncomeSummery':
			case 'RegistrationCountSummery':
		var newTableObject = document.getElementById('myTablex')
		sorttable.makeSortable(newTableObject);
            drawChart(ChartDiv);
		}

        });
    });

}
//
function ShowReg() {
           $(document).on('click','.View',function () {
              // $('body').modalmanager('loading');
                var SMID = $(this).attr('data');
                AjaxFun('Controller/RegSearch.php', {
                    SMID: SMID,
                    DBcode: $('#DBcode').val(),
					ThisReg: $(this).text(),
                    ViewDetais: "ViewDetais"
                }).done(function (result) {
                    //$('#CommonModal').modal();
					
					//$('body').modalmanager('removeLoading');
					$('#RegLookBody').html(result);
                    $('#RegLook').modal('show');
					//$('#CommonModal').modal().css( {'top':80});
                });
            });
}
$.fn.myValidation = function() { 
   var check = new Array();
   var checkonof = new Array();
   var vali=null;
   var filter=null;
   var required=null;
   var input=null;
   var oneof=null
   $(this).find('.required').each(function(index) {

required=$(this).attr('needs');
 if(!required){
 required='NoNeeds'
 }
 var requiredArray=required.split('-');
 for (var i = 0; i < requiredArray.length; i++) {
    //Do something
    //Do something
 switch(requiredArray[i]){
 case 'Int':
 filter=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
 oneof=null
 break;

 case 'Email':
 filter=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
 oneof=null
 break;

 case 'Special':
 filter=$(this).attr("filter");
 filter = new RegExp(filter);
 oneof=null
break;
 case 'oneof':
oneof = 1;

break;
default:
 filter=/(?!^$)/
 oneof=null
break;	 
	 }


if(requiredArray[i]=='Denied'){
	 check[index] = 'no';
 $(this).css("backgroundColor", "#FDD0D0");

}
else if(oneof){
 var oneof=$(this).attr("oneof");
   $("input[oneof='one']").each(function(ind) {
 filter=/(?!^$)/;
if (!filter.test($(this).val())) {
                        checkonof[ind] = 'no';
                    } else {
                        checkonof[ind] = 'ok';
                       
                    }
					
						
					});
   if (checkonof.indexOf('ok') > -1) {
	            
				$(this).css("backgroundColor", "#FFFFFF");	
				check[index] = 'ok';
                  $(this).tooltip('destroy');  
                }
				else
				{
				        check[index] = 'no';
					    $(this).css("backgroundColor", "#FDD0D0");
						var msg=$(this).attr('title');
						$(this).tooltip({ title : msg})
				}					
					
}
else 
{
  if (!filter.test($(this).val())) {
                        $(this).css("backgroundColor", "#FDD0D0");
						var msg=$(this).attr('title');
						$(this).tooltip({ title : msg})
                        check[index] = 'no';
                    } else {
						$(this).tooltip('destroy');
                        check[index] = 'ok';
                        $(this).css("backgroundColor", "#FFFFFF");
                    }
}


}


                });
				
		
 
 
 
    if (check.indexOf('no') > -1) {
                    return false;
                }
				else
				{
				return true;
				}
  
}


/* ===========================================================
 * ===========================================================
 * ===========================================================
 * Document . Ready Start....
 * ===========================================================
 * ===========================================================
 * ===========================================================*/
 
$(document).ready(function () {
	var months = new Array(12);
months[0] = "January";
months[1] = "February";
months[2] = "March";
months[3] = "April";
months[4] = "May";
months[5] = "June";
months[6] = "July";
months[7] = "August";
months[8] = "September";
months[9] = "October";
months[10] = "November";
months[11] = "December";
var current_date = new Date();
month_value = current_date.getMonth();
         $.getJSON( "Controller/BranchRankings.php", function( rrr ) {
rrr.sort(function(a,b) { return  parseFloat(b.SUMMERY)-parseFloat(a.SUMMERY)  } );

				
var table='<div class="col-md-12"><h4>This month('+ months[month_value]+') Ranking Income wise</h4><table class="table"><tr class="success"><th>Branch</th><th>Rank</th></tr>';
I=0;
 $.each( rrr, function( key, val ) {
I++;							   
table+='<tr><td>'+val.BRANCH+'</td><td>'+I+'</td></tr>';
});
table+='</table></div>';
			  $('#Rank').html(table);						
           });							
					
							
$('.actions').click(function (e) {
var name=$(this).attr('name'); 
							  
	switch (name) {
        case 'EditAccount':
				 AjaxFun('Controller/userProfile.php' ).done(function (result) {
                    $('#CommonModalBody').html(result);$('#CommonModal').modal();
			 });	
		break;
	}
					  
							  
							  });	
							
            $(document).on('click', '#PdfGen', function (e) {
				function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 20; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}										 
              window.open('StudentPdf.php?reg='+makeid()+btoa($('#RegSearchInput').val()));
			});
			$(document).on('click', '.RegLook,#PagiN_Reg .goto', function (e) {
                e.preventDefault();
				
                var data_save = $('#RegSearchForm').serializeArray();
                var page = $(this).attr('page');
                var from = $(this).attr('from');

                if (from) {
				   data_save.push({
                        name: "SearchType",
                        value: from
                    });	
				}
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
                $('#content').html(loderimg);

                AjaxFun('Controller/RegSearch.php', data_save).done(function (result) {
                    $('#content').html(result);
                  

                });
            });							
							
ShowReg();							
	 $('#side_branch_list').load('Controller/BranchList.php',function () {
 $('#B_OwnerShip').OwnerShipChange('#CC_BranchList');
          var DataPost =$('#side_branch_list').find('.BranchList').serializeArray();
             DivisionLoad(DataPost);
			 CourseLoad(DataPost,'#CourseSelect');
		     BatchLoad(DataPost);
             IntakeLoad(DataPost);
$('#BM_Status').change(function () { 
var Data =$('#side_branch_list').find('.BranchList').serializeArray();
	Data.push({ name: "BM_Status", value: $(this).val()},{ name: "D_Code", value: $('#DivisionSelect').val()},{ name: "C_Code", value: $('#CourseSelect').val()});							 
BatchLoad(Data);
										   
										   });
$('#I_Status').change(function () { 
var Data =[{ name: "I_Status", value: $(this).val()}];
	Data.push({ name: "D_Code", value: $('#DivisionSelect').val()},{ name: "C_Code", value: $('#CourseSelect').val()});							 
IntakeLoad(Data);
										   
										   });
													
													
													});
							
							
            
	
CountCommonFromLoad();
CountCommonFromSubmit();

	    $('#side_branch_list').on('click', '#INCheckAll', function () {
        $('#side_branch_list').find('.BranchList').prop("checked", !$('.BranchList').prop("checked"));
        var DataPost =$('#side_branch_list').find('.BranchList').serialize();
				  DataPost=DataPost+'&D_Code='+$('#DivisionSelect').val();
				  CourseLoad(DataPost,'#CourseSelect');
		          BatchLoad(DataPost);
    });
    $('#side_branch_list').on('click', '.BranchList', function () {
        var DataPost =$('#side_branch_list').find('.BranchList').serialize();
		          DataPost=DataPost+'&D_Code='+$('#DivisionSelect').val();
				  CourseLoad(DataPost,'#CourseSelect');
		          BatchLoad(DataPost);

    });
    
//Division Change	
		$('#DivisionSelect').change(function () {
		  var DataPost =$('#side_branch_list').find('.BranchList').serialize();
		 DataPost=DataPost+'&D_Code='+$('#DivisionSelect').val();
		 CourseLoad(DataPost,'#CourseSelect');
		 BatchLoad(DataPost);
		 IntakeLoad(DataPost);
		});   
//Course Change	
		$('#CourseSelect').change(function () {
		  var DataPost =$('#side_branch_list').find('.BranchList').serialize();
		 DataPost=DataPost+'&D_Code='+$('#DivisionSelect').val()+'&C_Code='+$('#CourseSelect').val();
		 BatchLoad(DataPost);
		 IntakeLoad(DataPost);
		});   
		
		
 $(document).on('click', '.customreport', function (e) {
				var data_save=$('#CountCommon_Form').serializeArray();
				var page=$(this).attr('page')
						var D1a=$(this).attr('date1');
		var D2a=$(this).attr('date2');
		var FormName=$(this).attr('FormName');
		var rgsta=$(this).attr('rgst');
		var bset=$(this).attr('bset');
		var RegNo=$(this).attr('RegNo');
					 data_save.push({
                        name: "Date1",
                        value: D1a
                    },{
                        name: "Date2",
                        value: D2a
                    },{
                        name: "RgStatus",
                        value: rgsta
                    },{
                        name: "FormName",
                        value: FormName
                    },{
                        name: "RegNo",
                        value: RegNo
                    });
					 

				
				
						 if($(this).attr('SelectedBranch')){

					 data_save.push({
                        name: "BranchCode",
                        value: $(this).attr('SelectedBranch')
                    });
					  data_save.push({
                        name: "View",
                        value: $(this).attr('format')
                    });
		//FormPage=href+'Detail';	
		
		}else
		{
		var BranchList =$('#side_branch_list').find('.BranchList').serializeArray();
		data_save = $.merge(BranchList, data_save);
		}
			AjaxFun('Controller/'+page, data_save).done(function (result) {
                   $('#CommonModalBody').html(result);
				$('#CommonModal').modal();
                  

                });								
																});		

$('.clear').click( function(){ $(this).closest('div').find('input').val('')} )		
		
    // $(document).ready end		
});