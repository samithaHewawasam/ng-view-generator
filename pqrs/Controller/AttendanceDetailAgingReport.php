<?php session_start();
 include("LogController.php");
if (!empty($_POST['BranchSelect']) and $_POST['BranchSelect']!='All'){
$_POST['SelectedBranch']=null;
$_POST['SelectedBranch'][$_POST['BranchSelect']]=$_POST['BranchSelect'];
}
$Totalpaid=null;
if(!empty($_GET['Aging'])){

switch($_GET['Aging']){

case 1:
$having=' HAVING `E` BETWEEN 0 AND 15';
break;
case 2:
$having=' HAVING `E` BETWEEN 16 AND 30';
break;
case 3:
$having=' HAVING `E` > 30';
break;
default :
$having='';

}




}
if (!empty($_POST['SelectedBranch']) ||!empty($_POST['BranchCode']))
	{
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
	echo ' <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Aging Report Attendance</h3>
    </div>
	<div class="modal-body" >';
	

	
	
/*
##############################################################################################
#
# Building Query For Advanced Search
# 
# 
##############################################################################################

*/  
    $DBprefix='`esoftcar_' ;//use back tic (`)
    $DBsuffix='`' ;
    $Today=time();
	$DataBase = '';
	$BindData = null;
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	$SearchDesTD = '';
	$myReport='#';
if(!empty($_POST['BranchCode']))
{
$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);

$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
$esoftConfig->exec("USE $DataBase");
}
	
$DateTable=" `student_installments`.`SI_Due_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 




	

	$SqlMain = "SELECT DATEDIFF(CURDATE(),MAX(`student_attendance`.`Date`)) AS `E`,MAX(`student_attendance`.`Date`) AS `D`,`registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`student_master`.`SM_ID` ,`student_master`.`SM_Title`,`student_master`.`SM_Initials` ,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`student_master`.`SM_Tell_Mobile`,`student_master`.`SM_Tel_Residance`,`student_master`.`SM_Mail_Personal`,`student_master`.`SM_Parent_Phone`,`batch_master`.`BM_Course_Code` AS `CT_Course_Code` FROM $DataBase.`student_attendance`
LEFT JOIN $DataBase.`registrations` ON `student_attendance`.`Reg_No`=$DataBase.`registrations`.`RG_Reg_NO`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";

$SqlTail="   GROUP BY `registrations`.`RG_Reg_NO`";
$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail.$having;
	
		// echo $SqlSetOne.'<br /><br />';
		
		$sth2 = $esoftConfig->prepare($SqlSetOne);
		$sth2->execute($BindData);
		$results = $sth2->fetchAll(PDO::FETCH_ASSOC);
		$count = $sth2->rowCount();
$NewCur=null;
$i=1;
$arrayforexel[''][0]=array('Reg No','Stu ID','Student Name','Tell(TM/TR/TP)','Student E-mail','Batch','Last Atten.','Absent Age');	

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
$DueAge=floor(($Today-strtotime($row['D']))/86400);

$arrayforexel[''][$i]=array($row['RG_Reg_NO'],$row['SM_ID'],$StudentName,$tel,$row['SM_Mail_Personal'],$row['Default_Batch'],$row['D'],$DueAge);	
		
  $i++;

}

if($count){
$i=1;
$t=0;
		foreach($arrayforexel as $Cur => $rowArray)
			{

		
$ResultTable.='<h3>'.$Cur.'</h3><table class="table" >';
		foreach($rowArray as $k=> $roww)
			{
		
$class=($k==0)?'class="ash"':'';			
$ResultTable.=  '<tr '.$class.'>
    <td>'.$t++.'</td>
    <td><a  class="View"  href="#view" data="'.$roww[1].'" >'.$roww[0].'</a></td>
    <td>'.$roww[2].'</td>
    <td>'.$roww[3].'</td>
    <td>'.$roww[4].'</td>
    <td>'.$roww[5].'</td>
	<td>'.$roww[6].'</td>
	<td>'.$roww[7].'</td>
    <td></td>
  </tr>';
  $i++;	
}

$ResultTable.='</tr>
	<tr class="ash strong">
	<td></td>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Total</td>
    <td></td>

	
  </tr></table>';
  
 }
// Branches Loop End
$myReport = "temp/TotalDuesDetail".time().".xlsx";

require_once '../Library/php/E/PHPExcel.php';
$objPHPExcel = new PHPExcel();
//$objWorkSheet = $objPHPExcel->getActiveSheet();
$y=-1;
foreach($arrayforexel as $val =>$arrayC){
$objWorkSheet = $objPHPExcel->createSheet($y++);
$objPHPExcel->setActiveSheetIndex($y);
$objWorkSheet->fromArray($arrayC);
$objWorkSheet->setTitle($val.' Dues');
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save($myReport);
}
	echo '
<div class="row">	
<div class="col-md-12">
<h4>Student Detail Report - '.$bA[0].'</h4>
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
	echo ' <div class="alert alert-block">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4>Warning!</h4>
   Please select at least one branch.
    </div>';
	}
	echo '</div>';

?>