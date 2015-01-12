<?php  session_start();
 include("LogController.php");
if (empty($_POST['BranchCode']) && !empty($_POST['SelectedBranch']) && $_SESSION['bset']==1){
$key=key($_POST['SelectedBranch']);
$_POST['BranchCode']=$_POST['SelectedBranch'][$key].'---'.$_SESSION['Sys_U_Branches'];
}
if (!empty($_POST['SelectedBranch']) || !empty($_POST['BranchCode']))
	{
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
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	$SearchDesTD = '';
if(!empty($_POST['BranchCode']))
{
$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);
$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = $DBprefix . strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
//$esoftConfig->query("USE $DataBase2");
}
	echo ' <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Subject  Wise Student Count -<font color="#0066FF" >'.$bA[0].'</font></h3>
    </div>';
	echo '<div class="modal-body" >';
	
		
	
	
	
	
$DateTable=" `registrations`.`RG_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 

	$SqlMain = "
	SELECT 	`SS_Subject`,`SS_Batch_No`,`SS_REG_NO`,`batch_master`.`BM_Course_Code` AS `CourseName` FROM $DataBase.`student_subjects` 
LEFT JOIN $DataBase.`registrations` ON `student_subjects`.`SS_REG_NO`=`registrations`.`RG_Reg_NO` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
	$SqlTail=' ORDER BY `Default_Batch`';
 $SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;
      //$esoftConfig->exec("USE $DataBase");

		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);





		foreach($results as $row)
			{
			empty($row['SS_Subject']) ? $row['SS_Subject']='0.00':'' ;
			
			$TotalCount[$row['SS_REG_NO']]=$row['SS_Subject'];
			//$CourseCount[$row['CourseName']][]=$row['SS_Subject'];
			$BatchCount[$row['SS_Subject']][$row['SS_REG_NO']][]=$row['SS_Subject'];
			$arrayTable[$row['CourseName']][$row['SS_Subject']][$row['SS_Batch_No']][]=$row['SS_Subject'];
			
			}
			

// Branches Loop End



	echo '
<div class="row">	
<div class="span12">
<h4>Subject Wise Head Count</h4>
	 <div id="ChartDiv" ChartName="PieChart" ChartData=\'\' options=\'{
        "title": "Branch Wise Registration Count as a Percentage","pieHole": "0.4" }\' ></div>

	   </div>
	 </div>   
	<div class="row">
<div class="col-md-5" >

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

<table class="table" ><tr class="ash">
    <td>Batch Name</td>
    <td><div class="text-right" >Student Count</div></td>
    <td></td>
  </tr>';
	foreach($arrayTable as $course => $arraytwo ){
	echo  '<tr class="success">
    <td>' . $course . '</td>
    <td></td>
    <td ></td>
  </tr>';
  	foreach($arraytwo as $batch => $arraythree ){
	echo  '<tr class="info">
    <td>' . $batch . '</td>
    <td></td>
    <td ></td>
  </tr>';
	foreach($arraythree as $subject => $due ){
	echo  '<tr>
    <td>' . $subject . '</td>
    <td><div class="text-right" >'.count($arraythree[$subject]).'</div></td>
    <td ></td>
  </tr>';	
	}
	echo  '<tr>
    <td><div class="text-right text-info" >' . $batch . ' Total</div> </td>
    <td><div class="text-right text-info" >'.count($BatchCount[$batch]).'</div></td>
    <td ></td>
  </tr>';	

	}


	}
	echo '</tr><tr class="ash strong">
    <td>Total</td>
	<td><div class="text-right" >'.count($TotalCount).'</div></td>
    <td></td>
  </tr></table>
 </div>
      
  </div>

';
	
	





}
  else
	{
	echo ' <div class="alert alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Warning!</h4>
   Please select at least one branch.
    </div>';
	}
	echo '</div>';

?>