<?php session_start();
 include("LogController.php");
if (empty($_POST['BranchCode']) && !empty($_POST['SelectedBranch']) && $_SESSION['bset']==1){
$key=key($_POST['SelectedBranch']);
$_POST['BranchCode']=$_POST['SelectedBranch'][$key].'---'.$_SESSION['Sys_U_Branches'];
}
if(!empty($_POST['BranchCode']))
{
 $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);
	
	echo ' <script>
 $(document).ready(function () {
 $("#VerifyAll").click(function(){
 if(confirm("Are you Sure? Do you want to verify all..")){
 var data_save=$("#VerifyForm").serializeArray();
  AjaxFun("Controller/StudentVerifyUpdate.php",data_save,"json").done(function (result) {
  $("#RegLookBody").html("");
   $("#RegLookBody").append("<h3>Verification Results</h3>");
          $.each(result,function( index,value ) {
		 if(value.status=="true"){
		 $("#"+index).text("Verified").removeClass("editable-empty").css( "color", "green" );
		 var htm="<div class=\"alert alert-success\">"+value.Msg+"</div>"
		 }
		 else
		 {
		 var htm="<div class=\"alert alert-danger\">"+value.Msg+"</div>"
		 }
$("#RegLookBody").append(htm);
});    
  $("#RegLook").modal();
            });
			}
 });
 $(".Status").editable({
           url: "Controller/StudentVerifyUpdate.php",
           name: "SV_Status",
           type: "select",
           title: "Enter Updates",
		   		   ajaxOptions: {
        dataType: "json"
    },
  
		    source: [
{value: "", text: ""},{value: "Verified", text: "Verified"}],
		   
     success: function(response, newValue) {
	 var toReturn; 
	          $.each(response,function( index,value ) {
			  
			  if(value.status=="false"){
			  toReturn=value.Msg;
			 return false;
			  }
			  })
return toReturn;
    }  
    });
$(".SM_First_Name").editable({
           url: "Controller/Student_Verify_Update.php",
           type: "text",
           title: "Enter Updates",
		   validate: function(value) {
           if($.trim(value).length > 20) return "Maximum length  is 20 characters";
        },
		   ajaxOptions: {
        dataType: "json"
    },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.status === false) {
             alert("Saving Fail")
        }
    }        
		   
    });
$(".SM_Last_Name").editable({
           url: "Controller/Student_Verify_Update.php",
           type: "text",
           title: "Enter Updates",
		   validate: function(value) {
           if($.trim(value).length > 30) return "Maximum length  is 30 characters";
        },
		   ajaxOptions: {
        dataType: "json"
    },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.ErrorCode == true) {
             alert("Saving Fail")
        }
    }        
		   
    }); 
	
 $(".SM_Title").editable({
           url: "Controller/Student_Verify_Update.php",
           name: "SV_Status",
           type: "select",
           title: "Enter Updates",
		    source: [
{value: "Rev.", text: "Rev."},{value: "Dr.", text: "Mr."},{value: "Mrs.", text: "Mrs."},{value: "Ms.", text: "Ms."}
],
		   ajaxOptions: {
        dataType: "json"
    },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.ErrorCode == true) {
             alert("Saving Fail")
        }
    }        
		   
    });
 $(".SM_Gender").editable({
           url: "Controller/Student_Verify_Update.php",
           name: "SV_Status",
           type: "select",
           title: "Enter Updates",
		    source: [
{value: "Male", text: "Male"},{value: "Female", text: "Female"}],
		   ajaxOptions: {
        dataType: "json"
    },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.ErrorCode == true) {
             alert("Saving Fail")
        }
    }        
		   
    });
 $(".SM_Date_of_Birth").editable({
           url: "Controller/Student_Verify_Update.php",
           name: "SV_Status",
           type: "text",
           title: "Enter DOB (YYYY-MM_DD Format)",
		   validate: function(value) {
		   var  filter=/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;

           if(!filter.test($.trim(value))){ return "Please enter valid date format YYYY-MM-DD";}
        },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.ErrorCode == true) {
             alert("Saving Fail")
        }
    }        
		   
    });
 $(".SM_Tell_Mobile").editable({
           url: "Controller/Student_Verify_Update.php",
           name: "SV_Status",
           type: "text",
           title: "Enter Mobile Number",
		   validate: function(value) {
		   var  filter=/^[0-9]{3}-[0-9]{7}$/;

           if(!filter.test($.trim(value))){ return "Please enter mobile number in 0XX-XXXXXXX format";}
        },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.ErrorCode == true) {
             alert("Saving Fail")
        }
    }        
		   
    });
	});

 </script> <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Student Verification Details</h3>
    </div>
	<div class="modal-body" >';
	
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
/*
##############################################################################################
#
# Building Query For Advanced Search
# 
# 
##############################################################################################

*/  $DBprefix='`esoftcar_' ;//use back tic (`)
    $DBsuffix='`' ;//use back tic (`)
    $Today=time();
	$DataBase = '';
	$SqlSetOne = '';
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	//$Where = " WHERE 1 AND registrations.`RG_Final_Fee`-registrations.`RG_Total_Paid` > 0 AND `RG_Status`='Active'";
	$Where = "WHERE 1 ";
	$SearchDesTD = '';
	$Orderby=' ORDER BY `Default_Batch`';
    $myReport = "temp/BatchWiseStuDetails".time().".xlsx";

$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);

$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
$DataBase2=$DBprefix.strtolower($bA[1]).$DBsuffix;
//$esoftConfig->query("USE $DataBase2");

$DateTable=" `registrations`.`RG_Date` ";
include('SearchPostPart.php');

$FirstRangeWhere = $Where.$FirstDatePart.$RGStatusPart.$VerStatusPart.$DivisionPart.$BatchPart. $BatchStatusPart.$CoursPart.$IntakePart; 
$SqlMain = "SELECT `registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`student_master`.`SM_Gender`,`student_master`.`SM_Date_of_Birth`,`student_master`.`SM_Tell_Mobile`,`student_master`.`SM_Tel_Residance` ,`student_master`.`SM_Mail_Personal`,`student_master`.`SM_Parent_Phone`,`student_master`.`SM_House_NO`,`student_master`.`SM_Lane`,`student_master`.`SM_Town`,`student_master`.`SM_City`,`student_verify`.`Status`,`student_verify`.`Reg_No` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN `esoftcar_centralserver`.`student_verify` ON `registrations`.`RG_Reg_NO`=`student_verify`.`Reg_No`
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" ";
  $SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;
		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$count = $sth->rowCount();
		
if($count<1000)	{	
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);







$arrayforexel[0]=array('No','Status','Stu ID','Reg No','Title','First Name(20)','Last Name(30)','Gender','DOB','Tell(TM/TR/TP)','Signature','Date');	
		
$ResultTable.='
 
<button  type="button" class="btn btn-success" id="VerifyAll" > Verify All</button>
<form id="VerifyForm">
<input id="DBcode" type="hidden" name="DBcode" value="'.$bA[1].'"></input>
<table class="table" ><tr class="ash">
    <td>No</td>
    <td>Status</td>
    <td>ID</td>
    <td>Reg No</td>
    <td>Title</td>
    <td>First Name(20)</td>
    <td>Last Name(30)</td>
    <td>Gender</td>
    <td>DOB</td>
    <td>Tell(TM/TR/TP)</td>
    <td></td>
  </tr>';
  $i=1;
		foreach($results as $row)
			{
		$tel='';
			if(!empty($row['SM_Tell_Mobile'])){
			$tel='TM: '.$row['SM_Tell_Mobile'];
			}
			elseif(!empty($row['SM_Tel_Residance']))
			{
			$tel='TR: '.$row['SM_Tel_Residance'];
			}
			elseif(!empty($row['SM_Parent_Phone']))
			{
			$tel='TP: '.$row['SM_Parent_Phone'];
			}
$StudentName=$row['SM_Title'].' '.$row['SM_First_Name'].' '.$row['SM_Last_Name'];
$StudentAddress=$row['SM_House_NO'].', '.$row['SM_Lane'].', '.$row['SM_Town'].', '.$row['SM_City'];
$arrayforexel[$i]=array($i,$row['Status'],$row['SM_ID'],$row['RG_Reg_NO'],$row['SM_Title'],$row['SM_First_Name'],$row['SM_Last_Name'],$row['SM_Gender'],$row['SM_Date_of_Birth'],$tel,'','');			
$ResultTable.=  '<tr >
    <td>'.$i++.'<input type="hidden" name="NIC['.$row['SM_ID'].']" value="'.$row['RG_Reg_NO'].'" /></td>
    <td><span class="Status" data-pk="'.$randomString.base64_encode('student_verify+++Status+++Reg_No+++'.$row['Reg_No'].'+++'.$row['RG_Reg_NO'].'+++'.$bA[1].'+++'.$row['SM_ID']).'" id="'.$row['SM_ID'].'" >'.$row['Status'].'</span></td>
    <td>'.$row['SM_ID'].'</td>
    <td  ><a  class="View"  href="#view" data="'.$row['SM_ID'].'" >'.$row['RG_Reg_NO'].'</a></td>
    <td><span class="SM_Title"  data-pk="'.$randomString.base64_encode('student_master+++SM_Title+++SM_ID+++'.$row['SM_ID'].'+++'.$bA[1]).'" >'.$row['SM_Title'].'</span></td>
    <td ><span class="SM_First_Name"  data-pk="'.$randomString.base64_encode('student_master+++SM_First_Name+++SM_ID+++'.$row['SM_ID'].'+++'.$bA[1]).'" >'.$row['SM_First_Name'].'</span></td>
    <td ><span class="SM_Last_Name" data-pk="'.$randomString.base64_encode('student_master+++SM_Last_Name+++SM_ID+++'.$row['SM_ID'].'+++'.$bA[1]).'" >'.$row['SM_Last_Name'].'</span></td>
    <td><span class="SM_Gender"  data-pk="'.$randomString.base64_encode('student_master+++SM_Gender+++SM_ID+++'.$row['SM_ID'].'+++'.$bA[1]).'" >'.$row['SM_Gender'].'</span></td>
    <td><span class="SM_Date_of_Birth"  data-pk="'.$randomString.base64_encode('student_master+++SM_Date_of_Birth+++SM_ID+++'.$row['SM_ID'].'+++'.$bA[1]).'" >'.$row['SM_Date_of_Birth'].'</span></td>
    <td><span class="SM_Tell_Mobile"  data-pk="'.$randomString.base64_encode('student_master+++SM_Tell_Mobile+++SM_ID+++'.$row['SM_ID'].'+++'.$bA[1]).'" >'.$row['SM_Tell_Mobile'].'</span></td>
    <td></td>
  </tr>';
}

$ResultTable.='
	<tr class="ash strong">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

	
  </tr></table></form>';
// Branches Loop End
require_once '../Library/php/E/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();
$objWorksheet->fromArray($arrayforexel);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save($myReport);
	echo '
<div class="row">	
<div class="col-md-12">
<h4>Student Detail Report</h4>
	 <div id="ChartDiv" ChartName="PieChart" ChartData=\'\' options=\'{
        "title": "Branch Wise Registration Count as a Percentage","pieHole": "0.4" }\' ></div>

	   </div>
	 </div>   
	<div class="row">
<div class="col-md-6" >

<table class="table" >
  <tr class="warning">
    <td colspan="2">Search Parameeters</td>
  </tr>
  <tr class="warning">
    <td>Name</td>
    <td>Values</td>
  </tr>';
	if (empty($SearchDesTD))
		{
		echo ' <tr>
    <td>Any</td>
    <td>All(without any filtering)</td>
  </tr>';
		}
	  else
		{
		echo $SearchDesTD;
		}

	echo '</table>
	  </div>
<div class="col-md-6" >
<a href="Controller/'.$myReport.'">Export to Exel</a>
	  </div>
	  </div>
';
	

echo $ResultTable;
}
else
{
	echo ' <div class="alert alert-warning">
    <h4>Warning!</h4>
   <h3>Your Search Range exceed 1000 rows please narrow your search range!</h3>.
    </div>';
}
echo '</div>';

}
?>

