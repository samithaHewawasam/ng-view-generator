<?php session_start();
 include("LogController.php");
if (empty($_POST['BranchCode']) && !empty($_POST['SelectedBranch']) && $_SESSION['bset']==1){
$key=key($_POST['SelectedBranch']);
$_POST['BranchCode']=$_POST['SelectedBranch'][$key].'---'.$_SESSION['Sys_U_Branches'];
}
if(!empty($_POST['BranchCode']))
{
	echo ' <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Student Check List Details</h3>
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
    $myReport = "temp/StudentCheckList".time().".xlsx";

$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);

$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
$DataBase2=$DBprefix.strtolower($bA[1]).$DBsuffix;
//$esoftConfig->query("USE $DataBase2");

$DateTable=" `registrations`.`RG_Date` ";
include('SearchPostPart.php');

$FirstRangeWhere = $Where.$RGStatusPart.$DivisionPart.$BatchPart. $BatchStatusPart.$CoursPart.$IntakePart; 
$SqlMain = "SELECT `registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`registrations`.`RG_Final_Fee`,`registrations`.`RG_Total_Paid`,`registrations`.`RG_Date`,`registrations`.`RG_Status`, SUM(`other_payments`.`Currency_rate`*`other_payments`.`OP_Amount`) AS `SumOther`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`student_master`.`SM_Tell_Mobile`,`student_master`.`SM_Tel_Residance` ,`student_master`.`SM_Parent_Phone` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN $DataBase.`other_payments` ON `registrations`.`RG_Reg_NO`=`other_payments`.`RG_Reg_No` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" GROUP BY `registrations`.`RG_Reg_NO`";
   $SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;

		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$count = $sth->rowCount();
		
if($count<1000)	{	
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);







$arrayforexel[0]=array('No','Stu ID','Reg No','Batch','Student Name','Tell(TM/TR/TP)','Final Fee','Total Paid','Total Due','Other Payments','Reg Date','Reg Status');
 $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);
	echo '<script>
$(document).ready(function () {
 $(".Status").editable({
           url: "Controller/Common_Update.php",
           name: "SV_Status",
           type: "select",
           title: "Select Status",
		   		   ajaxOptions: {
        dataType: "json"
    },
  
		    source: [
{value: "Active", text: "Active"},{value: "Inactive", text: "Inactive"},{value: "suspend", text: "suspend"}],
		   
     success: function(response, newValue) {
	 var toReturn; 
	          $.each(response,function( index,value ) {
			  
			  if(value.status!="true"){
			  toReturn=value.Msg+value.status;
			 return false;
			  }
			  })
return toReturn;
    }  
    });
	});
	</script>';
		
	
$ResultTable.='
<input id="DBcode" type="hidden" value="'.$bA[1].'"></input>
<table class="table table-hover" ><tr class="ash">
    <td>No</td>
    <td>Stu ID</td>
    <td>Reg No</td>
    <td>Batch</td>
    <td>Student Name</td>
    <td>Tell(TM/TR/TP)</td>
    <td align="right">Final Fee</td>
    <td align="right">Total Paid</td>
    <td align="right">Total Due</td>
    <td align="right">Other Pay.</td>
    <td>Reg Date</td>
    <td>Reg Status</td>
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
$Balance=number_format(($row['RG_Final_Fee']-$row['RG_Total_Paid']),2);
$StudentName=$row['SM_Title'].' '.$row['SM_First_Name'].' '.$row['SM_Last_Name'];
$arrayforexel[$i]=array($i,$row['SM_ID'],$row['RG_Reg_NO'],$row['Default_Batch'],$StudentName,$tel,$row['RG_Final_Fee'],$row['RG_Total_Paid'],$Balance,$row['SumOther'],$row['RG_Date'],$row['RG_Status']);			
$ResultTable.=  '<tr >
    <td>'.$i++.'</td>
    <td>'.$row['SM_ID'].'</td>
    <td  ><a  class="View"  href="#view" data="'.$row['SM_ID'].'" >'.$row['RG_Reg_NO'].'</a></td>
    <td>'.$row['Default_Batch'].'</td>
    <td>'.$StudentName.'</td>
    <td>'.$tel.'</td>
    <td align="right">'.$row['RG_Final_Fee'].'</td>
    <td align="right">'.$row['RG_Total_Paid'].'</td>
    <td align="right">'.$Balance.'</td>
    <td align="right">'.$row['SumOther'].'</td>
    <td>'.$row['RG_Date'].'</td>
    <td ><span class="Status"   data-value="'.$row['RG_Status'].'" data-pk="'.$randomString.base64_encode('registrations+++RG_Status+++RG_Reg_NO+++'.$row['RG_Reg_NO'].'+++'.$bA[1]).'" >'.$row['RG_Status'].'</td>
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
    <td></td>
    <td></td>

	
  </tr></table>';
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

