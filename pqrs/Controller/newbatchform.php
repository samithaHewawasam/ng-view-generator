<?php   session_start();
 include("LogController.php");
// need 
if(!empty($_POST['BatchAction']))
{
$head='Creat a new batch...';
$BM_Status="Active";
$BM_Batch_Code=null;
$BM_Commence_Date=null;
$BM_End_Date=null;
$BM_Target_Exam=null;
$BM_Ins_Days=null;
$BM_Description=null;
$BM_Published=null;
$course=null;
$BType=null;
$C_Ins_Method=null;
$schedulearray=array();
$LecForm=null;
$SomDiv=array('PRIMARY','JOBORI','O/L-A/L','BUSINESS-DIV');
$BITOdd=array('BIT-SEM1','BIT-SEM3','BIT-SEM5');
$BITEven=array('BIT-SEM2','BIT-SEM4','BIT-SEM6');
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
 $BranchCode=@$_POST['BranchCode'];
 
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$bA=explode('---',$BranchCode);
$DataBase=$DBprefix.strtolower($bA[1]).$DBsuffix;

 $BatchAction=@$_POST['BatchAction'];
 $course=@$_POST['LoadData'];
 $commentdateclass='BM_Changes';	
//$msg1='<font color="#49AD4A" >Please select a intake to create a Batch Code</font>';
//$msg2='<font color="#49AD4A" >Please select a Commence Date to create a Batch Code.</font>';
$msg1=null;
$msg2=null;
if(!empty($_POST['BatchCode']))
{
 $BatchCode=trim($_POST['BatchCode']);
 $head='Edit '.$BatchCode.' batch here';

$str="SELECT `batch_master`.*  FROM $DataBase.`batch_master` WHERE `BM_Batch_Code` LIKE ? LIMIT 1";
 $STH=$esoftConfig->prepare($str);
 $STH->execute(array('%'.$BatchCode.'%'));
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
		foreach($result as $row){
 $BM_Batch_Code=$row['BM_Batch_Code'];			
 $BM_Commence_Date=$row['BM_Commence_Date'];
 $BM_End_Date=$row['BM_End_Date'];			
 $BM_Target_Exam=$row['BM_Target_Exam'];			
 $BM_Ins_Days=$row['BM_Ins_Days'];			
 $BM_Status=$row['BM_Status'];	
 $course=$row['BM_Course_Code'];
 $BM_Description=$row['BM_Description'];
 $BM_Published=$row['BM_Published'];
 $commentdateclass='';	
 $msg1=null;	
 $msg2=null;	
}
}


$str="SELECT *  FROM $DataBase.`batch_schedule` WHERE `batch` = ? ";
 $STH=$esoftConfig->prepare($str);
 $STH->execute(array($BatchCode));
 $resultschedule = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
		foreach($resultschedule as $row){
 $schedulearray[$row['dayName']]=array($row['startTime'],$row['endTime']);	
}
}
}
////////////////////////////////////////////////////////////
//                   Lecture Allowcation Form         //
///////////////////////////////////////////////////////////
$LecturesSql="SELECT `D_Code` FROM $DataBase.`division` ";
$STH=$esoftConfig->prepare($LecturesSql);
 $STH->execute();
 $Lecresult = $STH->fetchAll(PDO::FETCH_ASSOC);
 $LecSelect='<select name=\"BM_Status\" class=\"form-control\" >';
		foreach($Lecresult as $row){
     $LecSelect.='<option value=\"'.$row['D_Code'].'\">'.$row['D_Code'].'<\/option>';
		}
       $LecSelect.= '<\/select>';
$LecturesSql="SELECT `S_CODE` FROM $DataBase.`subjects` WHERE S_Status='Active' AND C_CODE=?";
$STH=$esoftConfig->prepare($LecturesSql);
 $STH->execute(array($course));
 $Lecresult = $STH->fetchAll(PDO::FETCH_ASSOC);
 $SubSelect='<select name=\"BM_Status\" class=\"form-control\" >';
		foreach($Lecresult as $row){
     $SubSelect.='<option value=\"'.$row['D_Code'].'\">'.$row['D_Code'].'<\/option>';
		}
       $SubSelect.= '<\/select>';
	   
////////////////////////////////////////////////////////////
//                  Intake Story        //
///////////////////////////////////////////////////////////
$str="SELECT `C_Intake`,`C_Name`,`C_Type`,`Duration`,`D_Code`,`C_Ins_Method` FROM $DataBase.`course`
LEFT JOIN $DataBase.`course_type` ON `course`.`C_Code`=`course_type`.`CT_Course_Code`
LEFT JOIN $DataBase.`registration_type` ON `course_type`.`CT_Type_Code`=`registration_type`.`RT_Code` WHERE `C_Code` =? LIMIT 1";
 $STH=$esoftConfig->prepare($str);
 $STH->execute(array($course));
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $row){
 $intakestatus=$row['C_Intake'];			
 $C_Name=$row['C_Name'];
 $C_Type=$row['C_Type'];			
 $Duration=$row['Duration'];			
 $D_Code=$row['D_Code'];	
 $C_Ins_Method=$row['C_Ins_Method'];			
}


if(in_array($D_Code,$SomDiv)){
$BType='One';
}
elseif($D_Code=='BCS'){
$BType='Two';
}
elseif(in_array($course,$BITOdd)){
$BType='Three';
}
elseif(in_array($course,$BITEven)){
$BType='Four';
}
elseif($D_Code=='HND'){
$BType='Five';
}
elseif($D_Code=='LMU'){
$BType='Six';
}
elseif($D_Code=='UOM'){
$BType='Seven';
}

	 ?>  

	 <script>
	 
           $(document).ready(function () {           
			     //$('.dp3').daterangepicker({singleDatePicker : true,format: 'YYYY-MM-DD', startDate:  moment().format('YYYY-MM-DD')});	
				 ////////////////////////////All javascript for Batch Master Form
  //$('.dp3').datepicker();
  $('#dp4').datetimepicker({
                    pickTime: false,
					format:'YYYY-MM-DD',
					useCurrent: false
                });
  $('#dp3').datetimepicker({
                    pickTime: false,
					format:'YYYY-MM-DD',
					useCurrent: false
                });
  $("#dp3").on("dp.change",function (e) {
              commenceDateGetCode($(this));
            });
	  $('.tp3').datetimepicker({
                    pickDate: false,
					useCurrent: false
                });

    var BatchPartint = '';
    var BatchNumber = '';
    var BatchPart = '';
    var BatchSearch = '';
            $(document).off('change',".BM_Changes");
            $(document).on('change',".BM_Changes",function() {commenceDateGetCode($(this));});
//Add Duration to Commence Date And Set is to End Date START..

		function commenceDateGetCode(ob) { 
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
                
				var BM_Course_Code = $('#BM_Course_Code').val();
///////////////////////////////////////////////////////////////
if(ob.attr('id')!='IntakeSelectBatch'){
				var Duration=$("#Duration").val();
				
				if(!isNaN(Duration) && Duration>0){
					Duration= parseInt(Duration);
				var BM_Commence =$("#BM_Commence_Date").val();
				
				  var dt = new Date(BM_Commence);
				  var d=new Date(new Date(dt).setMonth(dt.getMonth()+Duration));
				  // if There is Date.js this is better.
				  //var d = new Date(dt).add(Duration).month();
                  //var BM_End_Date=d.toString('yyyy-MM-dd');
				  var m = d.getDate();
                  var n = d.getMonth() + 1; //Months are zero based
                  var curr_year = d.getFullYear();
                  curr_month=(n < 10) ? ("0" + n) : n;
				  curr_date=(m < 10) ? ("0" + m) : m;
				$("#BM_End_Date").val(curr_year+'-'+curr_month+'-'+curr_date);
				}
}

//////////////////////////////////////////////////////////////////
 var BType = $('#BType').val();	
				if (ob.attr('id')=='IntakeSelectBatch') {
                    var BatchPartint = $('#IntakeSelectBatch').val();
                    var BatchPart = BM_Course_Code + '-' + BatchPartint;
                    
                    
                    ///////
                    if ($('#C_Type').val() == 'EXAM') {
                        BatchNumber = BM_Course_Code + '-' + BatchPartint + '-';
						BatchSearch = BatchPart;
                    } else {
                        BatchNumber = BM_Course_Code + '-';
						BatchSearch = BM_Course_Code;
                    }
                    ////
                } else {
				
				
                    var BM_Commence_Date = $('#BM_Commence_Date').val();
                   
					 var parts = BM_Commence_Date.split("-");
							var part2=$('#IntakeSelectBatch').val();
						
						if(BType=='One'){	
					 if(parts[1]==12){
					 var part2 = m_names['12'] + '/' + parts[0];
					 }
					 else if(parts[1]<=3 && parts[1]>=1){
					 var part2 = m_names['12'] + '/' + (parts[0]-1);
					 
					 }
					 else if(parts[1]<=7 && parts[1]>=4){
					 var part2 = m_names['04'] + '/' + (parts[0]);
					 
					 }
					 else if(parts[1]<=11 && parts[1]>=8){
					 var part2 = m_names['08'] + '/' + (parts[0]);
					  
					 }
					 $('#BM_Target_Exam').val(part2);
					 }
					 else if(BType=='Two')
					 {
					 var mar=( curr_month-3)
					 var sep=( curr_month-9)
					 
					/* if(dt.getFullYear()==curr_year){

					 if(mar>sep){
					 var mon='09'
					 }else
					 {
					 var mon='03'
					 }
					 }
					 else
					 {
					 if(mar<sep){
					 var mon='09'
					 }else
					 {
					 var mon='03'
					 }
					 }
					*/
					 if(parts[1]<=3 && parts[1]>=1){
					 var mon ='09';
					 }
					 else if(parts[1]<=9 && parts[1]>=4){
					var mon ='03';
					 }
					 else if(parts[1]<=12 && parts[1]>=10){
					var mon ='09';
					 }
					var part2=m_names[mon]+'/'+curr_year;
										var sel=$("#IntakeSelectBatch option[value='"+part2+"']");
					if(sel.length>0){
					sel.prop('selected', true);
					 }
					 else
					 {
					$("#IntakeSelectBatch").append('<option selected="selected" value="'+part2+'">'+part2+'</option>');
					 }
					 
					 				$("#BM_End_Date").val(curr_year+'-'+mon+'-'+(mon=='03' ? '31':'30'));

}
					 else if(BType=='Three')
					 {
					
					var part2=m_names['02']+'/'+(dt.getFullYear()+1);
										var sel=$("#IntakeSelectBatch option[value='"+part2+"']");
					if(sel.length>0){
					sel.prop('selected', true);
					 }
					 else
					 {
					$("#IntakeSelectBatch").append('<option selected="selected" value="'+part2+'">'+part2+'</option>');
					 }
					 
					 			//	$("#BM_End_Date").val(curr_year+'-'+mon+'-'+(mon=='03' ? '31':'30'));

}                   // var part2 = m_names[parts[1]] + '/' + parts[0];
					 else if(BType=='Four')
					 {
					
					var part2=m_names['08']+'/'+(dt.getFullYear()+1);
										var sel=$("#IntakeSelectBatch option[value='"+part2+"']");
					if(sel.length>0){
					sel.prop('selected', true);
					 }
					 else
					 {
					$("#IntakeSelectBatch").append('<option selected="selected" value="'+part2+'">'+part2+'</option>');
					 }
					 
					 			//	$("#BM_End_Date").val(curr_year+'-'+mon+'-'+(mon=='03' ? '31':'30'));

}                   // var part2 = m_names[parts[1]] + '/' + parts[0];
					 else if(BType=='Five'){	
                      if(parts[1]<=5 && parts[1]>=1){
					 var part2 = m_names['01'] + '/' + (parts[0]-1);
					 
					 }
					 else if(parts[1]<=8 && parts[1]>=6){
					 var part2 = m_names['06'] + '/' + (parts[0]);
					 
					 }
					 else if(parts[1]<=12 && parts[1]>=9){
					 var part2 = m_names['09'] + '/' + (parts[0]);
					  
					 }
					
					
										var sel=$("#IntakeSelectBatch option[value='"+part2+"']");
					if(sel.length>0){
					sel.prop('selected', true);
					 }
					 else
					 {
					$("#IntakeSelectBatch").append('<option selected="selected" value="'+part2+'">'+part2+'</option>');
					 }
					
					 }
					 else if(BType=='Six'){	
					  var year =dt.getFullYear();
            					 if(parts[1]==12){
								 var year =dt.getFullYear()+1;
					 var mon ='02';
					 }
            					else if(parts[1]<=5 && parts[1]>=1){
					 var mon ='02';
					 }
					 else if(parts[1]<=11 && parts[1]>=6){
					var mon ='09';
					 }

					

					
					var part2=m_names[mon]+'/'+year;
					
					
										var sel=$("#IntakeSelectBatch option[value='"+part2+"']");
					if(sel.length>0){
					sel.prop('selected', true);
					 }
					 else
					 {
					$("#IntakeSelectBatch").append('<option selected="selected" value="'+part2+'">'+part2+'</option>');
					 }
					
					 }
					 else if(BType=='Seven'){	
					 
                      if(parts[1]<=2 && parts[1]>=1){
					 var mon ='02';
					 }
					 else if(parts[1]<=8 && parts[1]>=3){
					var mon ='08';
					 }
					 else if(parts[1]<=12 && parts[1]>=9){
					var mon ='02';
					 }

					

					
					var part2=m_names[mon]+'/'+curr_year;
					
					
										var sel=$("#IntakeSelectBatch option[value='"+part2+"']");
					if(sel.length>0){
					sel.prop('selected', true);
					 }
					 else
					 {
					$("#IntakeSelectBatch").append('<option selected="selected" value="'+part2+'">'+part2+'</option>');
					 }
					
					 }
					 else
					 {
						 
				 $('#BM_Target_Exam').val(m_names[parts[1]] + '/' + parts[0]);
					 }
				    BatchPart = BM_Course_Code + '-' + part2;
                    
                   
                    ///////
                    if ($('#C_Type').val() == 'EXAM') {
                        BatchNumber = BM_Course_Code + '-' + part2 + '-';
						BatchSearch = BatchPart;
                    } else {
                        BatchNumber = BM_Course_Code + '-';
						BatchSearch = BM_Course_Code;
                    }
                    ////
                
				}
                if($('#BatchAction').val()!='Edit'){
				$.ajax({
                    url: "Controller/BatchNumber.php",
                    type: "POST",
                    data: {
                        LoadCount: BatchSearch,BranchCode:$('#BranchCode').val()
                    },
                    success: function(response) {
                        //$('#BatchNumber').val(BM_Course_Code+'-'+response);
                        $('#BatchNumber').val(BatchNumber);
                        $('#BM_Batch_Count').val(response);
                    }
                });
				}
         
			

			 };
//Add Duration to Commence Date And Set is to End Date END...
   


//batchMasterSave start
$("#batchMasterForm").on("click", "#batchMasterSave", function (event) {

    event.preventDefault();
var Duration=$("#Duration").val();
				var BM_Commence =new Date($("#BM_Commence_Date").val());
				var BM_End_Date =new Date($("#BM_End_Date").val());
				var BM_Ins_Days =$("#BM_Ins_Days").val();
				var BM_Commence_PlusIns = BM_Commence.setTime( BM_Commence.getTime() + (BM_Ins_Days * 86400000) );

	if($("#batchMasterForm").myValidation()){

//commence date validation

if(isNaN(BM_Ins_Days) || BM_Ins_Days==''){
alert('installment days not valid');
return false;

	}
else if(BM_Commence_PlusIns>BM_End_Date.getTime())
{
alert('End date must be grater than commence date and  atleast have one installment gap!');	
return false;
}
 var checked = $("#scheduleTanle input:checked").length > 0;
    if (!checked){
        alert("Please select at least one date");
        return false;
    }


//commence date validation end


    var data = $("#batchMasterForm").serializeArray();
   $("#ajaxModal").modal();
    $.ajax({

        url: "Controller/batchMaster.php",
        type: "POST",
		dataType:"json",
        data: data,
        success: function (response) {
		$("#ajaxModal").modal("hide");
          if(!response.ErrorCode) {
		  $('#batchmodalbody').html('<h3>Batch Saved Successfully!</h3>')
		  		   var data_save = $("#SearchFormQuery").serializeArray();
				   if($("#bset").val()==1){var Div='#content'}else{var Div='#CommonModalBody'}
	ReloadTable('Controller/BatchList.php',data_save,false,Div);			

		  }else
		  {
		  if(response.ErrorCode==23000){
		  $('#batchmodalbody').html('<h3>Batch Saving fail!</h3><p>Duplicate Batch Code, Please re check your batches</p>')
		  
		  }
		  else
		  {
		  $('#batchmodalbody').html('<h3>Batch Saving fail!</h3><p>Unknown Reason</p>')
		  }
		  }
      

        }



    });
	}
});

//batchMasterSave end

$('.LecAllow').click(function(){
	var LecForm="";
LecForm += "<form class=\"form-horizontal\" role=\"form\">";
LecForm += "  <div class=\"form-group\">";
LecForm += "    <label for=\"inputEmail3\" class=\"col-sm-3 control-label\">Masters List<\/label>";
LecForm += "    <div class=\"col-sm-8\">";
LecForm += "<?php echo $LecSelect?>";
LecForm += "    <\/div>";
LecForm += "  <\/div>";
LecForm += "  <div class=\"form-group\">";
LecForm += "    <label for=\"inputPassword3\" class=\"col-sm-3 control-label\">Subject List<\/label>";
LecForm += "    <div class=\"col-sm-8\">";
LecForm += " <?php echo $SubSelect?>";
LecForm += "    <\/div>";
LecForm += "  <\/div>";
LecForm += "  <div class=\"form-group\">";
LecForm += "    <label for=\"inputPassword3\" class=\"col-sm-3 control-label\">In Time<\/label>";
LecForm += "    <div class=\"col-sm-8\">";
LecForm += "      <input type=\"text\" class=\"form-control tp3\" id=\"inputPassword3\" placeholder=\"Password\">";
LecForm += "    <\/div>";
LecForm += "  <\/div>";
LecForm += "  <div class=\"form-group\">";
LecForm += "    <label for=\"inputPassword3\" class=\"col-sm-3 control-label\">Out Time<\/label>";
LecForm += "    <div class=\"col-sm-8\">";
LecForm += "      <input type=\"text\" class=\"form-control tp3\" id=\"inputPassword3\" placeholder=\"Password\">";
LecForm += "    <\/div>";
LecForm += "  <\/div>";
LecForm += "  <div class=\"form-group\">";
LecForm += "    <div class=\"col-sm-offset-2 col-sm-10\">";
LecForm += "      <button type=\"submit\" class=\"btn btn-success \">Sign in<\/button>";
LecForm += "    <\/div>";
LecForm += "  <\/div>";
LecForm += "<\/form>";

	$('#CommonModalLastBody').html(LecForm);
	$('#CommonModalLast').modal();
		  $('.tp3').datetimepicker({
                    pickDate: false,
					useCurrent: false
                });

	});


			  });
  </script> 

    <div style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3><?php echo $head ?></h3>
    </div>
    <div class="modal-body" id="batchmodalbody" >
    <form action="#" method="post" role="form" id="batchMasterForm">
    <input type="hidden" id="BatchAction" value="<?php echo $BatchAction ?>" name="BatchAction"> 
    <input type="hidden" id="BM_Course_Code" value="<?php echo $course ?>" name="BM_Course_Code"> 
    <input type="hidden" id="C_Type" value="<?php echo $C_Type ?>" name="C_Type"> 
    <input type="hidden" id="Duration" value="<?php echo $Duration ?>" name="Duration"> 
    <input type="hidden" id="BranchCode" value="<?php echo $BranchCode ?>" name="BranchCode"> 
    <input type="hidden" id="BType" value="<?php echo $BType ?>" name="BType"> 
    <input type="hidden" id="intakestatus" value="<?php echo $intakestatus ?>" name="intakestatus"> 

    <div class="input-prepend"><h4><?php echo $C_Name ?></h4></div>
     
   
   <div class="form-group">
    <label for="BatchNumber" class="control-label">	
   Batch Number:
    </label>
    <div class="row">
    <div class="col-sm-7">
    <input  class="form-control required" readonly="readonly"  type="text" id="BatchNumber" value="<?php echo $BM_Batch_Code ?>" name="BM_Batch_Code">
        </div>
        <?php if($BM_Batch_Code==null){ echo ' <div class="col-sm-3">
    <input  class="form-control required"   type="text" id="BM_Batch_Count" value="" name="BM_Batch_Count">
    </div>';
		
		}
		 ?>
   
    </div>
    </div>
     <?php 
		
	if($intakestatus=='Yes' && $BM_Batch_Code==null && !in_array($D_Code,$SomDiv))	{
$commentdateclass='';	
 $msg2=null;	
$str2="SELECT Intake FROM intakes WHERE C_Code=? AND I_Status='Active'";
 $wheredata2=array($course);
 $STH=$esoftConfig->prepare($str2);
 $STH->execute($wheredata2);
 $result2 = $STH->fetchAll(PDO::FETCH_ASSOC);
 $selectMenu='<select name="BM_Target_Exam" id="IntakeSelectBatch" class="form-control BM_Changes required" ><option value="" >--Select--</option>';
			foreach($result2 as $row)
{

$selectMenu.='<option value="'.$row['Intake'].'" >'.$row['Intake'].'</option>';
}
 $selectMenu.='</select>';
	
      

echo '
		<div class="form-group" >
    <label for="IntakeSelectBatch" >	
   Intake:
    </label>
<div class="row" >
<div class="col-sm-5" >
   '. $selectMenu.'
    </div>'.$msg1.'
    </div>
    </div>
		
		';

	}
	else
	{
	
	
	 echo '
	<div class="form-group">
    <label for="BM_Target_Exam">	
   Target Exam:
    </label>
<div class="row" >
	<div class="col-sm-6">
    <input  type="text"  class="form-control required" id="BM_Target_Exam" value="'.$BM_Target_Exam.'" name="BM_Target_Exam" readonly>
    </div>
    </div>
    </div>
	';
	
	}
	
	?>
     
     <div class="form-group">
       <label for="BM_Commence_Date" class="control-label">Commence Date:</label>
     <div class="row">
        <div class="col-sm-6" >

   <div class='input-group date' id="dp3" >
                        <input class="<?php echo $commentdateclass ?> form-control  required" readonly="readonly" id="BM_Commence_Date" value="<?php echo $BM_Commence_Date ?>" size="16" type="text" placeholder="yyyy-mm-dd" name="BM_Commence_Date" >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
    </div><?php echo $msg2 ?>
    </div>
     </div>
     
     <div class="form-group">
       <label for="BM_End_Date" class="control-label">End Date</label>
     <div class="row">
        <div class="col-sm-6" >

    <div class='input-group date' id="dp4">
    <input class="form-control required" id="BM_End_Date" size="16" type="text" value="<?php echo $BM_End_Date ?>"   placeholder="yyyy-mm-dd" name="BM_End_Date" readonly>  
     <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
    </div>
     </div>
     </div>
     
    <div class="form-group">
  <label for="BM_Ins_Days" class="control-label">Instalment Days:</label>
      
        <div class="row">
        <div class="col-sm-4">
        <?php if($C_Ins_Method=='Mon'){
    echo '<input class="form-control required " readonly="readonly" id="BM_Ins_Days" size="6" type="text" value="25"  name="BM_Ins_Days"  >(25th on every month)';
		}else{
   echo ' <input class="form-control required " id="BM_Ins_Days" size="6" type="text" value="'.$BM_Ins_Days.'"  name="BM_Ins_Days"  >';
  } ?>
    </div>
    </div>
  </div>
  
     <table width="400"  class="table"  id="scheduleTanle" >
  <tr>
    <td></td>
    <td>Days</td>
    <td>Starting Time</td>
    <td>End Time</td>
  </tr>
  <tr>
  <?php 
  $weekdays=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
   foreach($weekdays as $val){ 
    echo '<td><input type="checkbox" value="set" '.(isset($schedulearray[$val])? 'checked="checked"':"").' name="DayName['.$val.']"></td><td>
	'.(isset($schedulearray[$val])? '<input type="hidden" name="DayNameOld['.$val.']" value="set" />':"").'
	<label>'.$val.'</label> </td>
    <td><input class="form-control input-sm  tp3" id="BM_Ins_Days" size="6" type="text" value="'.(isset($schedulearray[$val][0]) && $schedulearray[$val][0]!='00:00:00'? date('h:i A ', strtotime($schedulearray[$val][0])):"").'" name="StartTime['.$val.']"  ></td>
    <td><input class="form-control input-sm tp3" id="BM_Ins_Days" size="6" type="text" value="'.(isset($schedulearray[$val][1])&& $schedulearray[$val][0]!='00:00:00'? date('h:i A ', strtotime($schedulearray[$val][1])):"").'"  name="EndTime['.$val.']"  ></td>
<td><a class="LecAllow">Add </a></td>  </tr>';
 } ?>
</table>
<br />
<br />
    <div class="form-group">
  <label for="BM_Ins_Days" class="control-label">Batch Status:</label>
      
        <div class="row">
        <div class="col-sm-4">
    <select name="BM_Status" class="form-control" >
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    <option value="Cancelled">Cancelled</option>
    <option value="Completed">Completed</option>
    <option value="<?php echo $BM_Status ?>" selected="selected"><?php echo $BM_Status ?></option>
    </select>
   
    </div>
    </div>
  </div>
  <div class="form-group">
  <label for="BM_Description" class="control-label">Batch Description(max legnth=30):</label>
      
        <div class="row">
        <div class="col-sm-4">
 <textarea cols="50" name="BM_Description" maxlength="30" ><?php echo $BM_Description ?></textarea>
   
    </div>
    </div>
  </div>
  <div class="form-group">
  <label for="BM_Description" class="control-label">Do you want to publish this batch on web?:</label>
      
        <div class="row">
        <div class="col-sm-4">
<div class="radio">
  <label>
<input name="BM_Published" type="radio" <?php echo $BM_Published=='1'? 'checked="checked"':'';  ?> value="1" /> 
   Yes
  </label>
</div> 
<div class="radio">
  <label>
<input name="BM_Published" type="radio"  value="0"  <?php echo $BM_Published !='1'? 'checked="checked"':'' ; ?> /> 
   No
  </label>
</div>  
    </div>
    </div>
  </div>
    <div >
    <input type="hidden" value="set" />
<!-- Indicates a successful or positive action -->
<input type="submit" id="batchMasterSave" class="btn btn-medium btn-primary" value="Save Batch" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>


</div>
 
  

</form>
</div>
</div>
                    	
                    	
                                    
                   
	
					
<?php } ?>
