<?php session_start();
 include("LogController.php");
if(!empty($_GET['SelectedBranch']))
{
	echo ' <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Batch Wise Student Details</h3>
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
    
*/  
    $re='';
    $DBprefix='`esoftcar_' ;//use back tic (`)
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

//$_GET['SelectedBranch']=array();
//$bA=explode('---',$_GET['BranchCode']);

///$_GET['SelectedBranch'][$bA[1]]=$bA[0];

//$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
//$DataBase2=$DBprefix.strtolower($bA[1]).$DBsuffix;
//$esoftConfig->query("USE $DataBase2");
	foreach($_GET['SelectedBranch'] as $key => $BranchName)
		{
$bA[0]=	$BranchName;	
$bA[1]=	$key;
 $myReport = "temp/StuDetails-JAVA-IZ0-851-".$bA[0].".xlsx";

$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;
$DateTable=" `registrations`.`RG_Date` ";
include('SearchPostPart.php');
$CoursPart=" AND `course`.`C_Code` IN('JAVA-IZ0-851')";
$DivisionPart=null;
$BatchPart=null;
$BatchStatusPart=null;
$FirstRangeWhere = $Where.$RGStatusPart.$DivisionPart.$BatchPart. $BatchStatusPart.$CoursPart.$IntakePart; 
$SqlMain = "SELECT `course`.`C_Code`,`registrations`.`RG_Final_Fee`,`registrations`.`RG_Total_Paid`,`registrations`.`RG_Reg_NO`,`registrations`.`RG_Reg_Type`,`registrations`.`RG_Date`,`registrations`.`RG_Status`,`registrations`.`Default_Batch`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`student_master`.`SM_Tell_Mobile`,`student_master`.`SM_Tel_Residance` ,`student_master`.`SM_Mail_Personal`,`student_master`.`SM_Parent_Phone`,`student_master`.`SM_House_NO`,`student_master`.`SM_Gender`,`student_master`.`SM_Date_of_Birth` ,`student_master`.`SM_Mail_Personal` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" ";
   $SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;

		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$count = $sth->rowCount();
		
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);






$arrayforexel=array();
$arrayfor=array('Stu ID','Reg No','Name','Mobile No','Land No','Parent No','E-mail');	
/*$ResultTable.='
<input id="DBcode" type="hidden" value="'.$bA[1].'"></input>
<table class="table" ><tr class="ash">
    <td>No</td>
    <td>Branch</td>
    <td>Stu ID</td>
    <td>Reg No</td>
    <td>Reg Type</td>
    <td>Reg Date</td>
    <td>Title</td>
    <td>SM_First_Name</td>
    <td>SM_Last_Name</td>
    <td>Gender</td>
    <td>DOB</td>
    <td>Final Fee</td>
    <td>Total Paid</td>
    <td></td>
  </tr>';
*/  
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
$StudentAddress=$row['SM_House_NO'];

$arrayforexel[$row['Default_Batch']][]=array($row['SM_ID'],$row['RG_Reg_NO'],$StudentName,$row['SM_Tell_Mobile'],$row['SM_Tel_Residance'],$row['SM_Parent_Phone'],$row['SM_Mail_Personal']);			
/*$ResultTable.=  '<tr >
    <td>'.$i++.'</td>
    <td>'.$bA[0].'</td>
    <td>'.$row['SM_ID'].'</td>
    <td  ><a  class="View"  href="#view" data="'.$row['SM_ID'].'" >'.$row['RG_Reg_NO'].'</a></td>
    <td>'.$row['RG_Reg_Type'].'</td>
    <td>'.$row['RG_Date'].'</td>
    <td>'.$row['SM_Title'].'</td>
    <td>'.$row['SM_First_Name'].'</td>
    <td>'.$row['SM_Last_Name'].'</td>
    <td>'.$row['SM_Gender'].'</td>
    <td>'.$row['SM_Date_of_Birth'].'</td>
    <td>'.$row['RG_Final_Fee'].'</td>
    <td>'.$row['RG_Total_Paid'].'</td>
    <td></td>
  </tr>';
*/}

/*$ResultTable.='
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
    <td></td>
    <td></td>

	
  </tr></table>';*/
// Branches Loop End

require_once '../Library/php/E/PHPExcel.php';
$objPHPExcel = new PHPExcel();

$objWorksheet = $objPHPExcel->getActiveSheet();
$objPHPExcel->removeSheetByIndex(0);
foreach($arrayforexel as $course => $Arr){
 $newsheet = $objPHPExcel->createSheet();
//$objWorkSheet->setTitle("course");
array_unshift($Arr,$arrayfor);
$newsheet->fromArray($Arr)->setTitle($course);
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save($myReport);
$re.='<a href="'.$myReport.'">'.$bA[0].' Export to Exel</a><br />
<br />
';
}

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
'.$re.'
	  </div>
	  </div>
';
	

echo $ResultTable;
echo '</div>';

}
?>

