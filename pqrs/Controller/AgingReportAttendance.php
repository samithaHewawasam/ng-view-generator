<?php session_start();
 include("LogController.php");
if (!empty($_POST['BranchSelect']) and $_POST['BranchSelect']!='All'){
$_POST['SelectedBranch']=null;
$_POST['SelectedBranch'][$_POST['BranchSelect']]=$_POST['BranchSelect'];
}

if (!empty($_POST['SelectedBranch']))
	{
    include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
	$DataBase = '';
	$ResultTable = '';
	$DateRangOneSql = '';
	$arraychart = '';
    $TotalCount=array();
	$TotalTable=null;
    $Today=time();
$DateTable=" `student_installments`.`SI_Due_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 

	foreach($_POST['SelectedBranch'] as $key => $BranchName)
		{
$DataBase = $DBprefix. strtolower($key).$DBsuffix;
$esoftConfig->exec("USE $DataBase ");
	 
	 
$SqlMain = "

SELECT `student_attendance`.`Reg_No`,MAX(`student_attendance`.`Date`) AS `MaxDate` FROM $DataBase.`student_attendance` 
LEFT JOIN $DataBase.`registrations` ON `student_attendance`.`Reg_No`=$DataBase.`registrations`.`RG_Reg_NO`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=$DataBase.`student_master`.`SM_ID`
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" GROUP BY `student_attendance`.`Reg_No` ";
$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;


		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($results);
$Col1=0;
$Col2=0;
$Col3=0;
$Col4=0;
		foreach($results as $row)
			{
			
			//$arraychart[] = '["' . $BranchName . '",' . $row['C'] . ']';
			
			$DueAge=floor(($Today-strtotime($row['MaxDate']))/86400);
if($DueAge >0 && $DueAge <= 15){
$Col1++;
}
elseif($DueAge >15 && $DueAge <= 30){
$Col2++;
}				
elseif($DueAge >30){
$Col3++;
}		
						

}
$ResultTable.= '<tr>
    <td>' . $BranchName. '</td>

    <td><a href="#" class="customreport" page="AttendanceDetailAgingReport.php?Aging=1" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="AttendanceDetailAgingReport"  format="ViewBreakupDetail">'.$Col1.' </a></td>
    <td><a href="#" class="customreport" page="AttendanceDetailAgingReport.php?Aging=2" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="AttendanceDetailAgingReport"  format="ViewBreakupDetail">'.$Col2.'</a></td>
    <td><a href="#" class="customreport" page="AttendanceDetailAgingReport.php?Aging=3" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="AttendanceDetailAgingReport"  format="ViewBreakupDetail">'.$Col3.'</a></td>
    <td>'.($Col1+$Col2+$Col3).'</td>
  </tr>';

$results=null;
$key='';
$BranchName='';
// Branches Loop End
}
/*foreach($TotalCount as $Cur => $arr){
	$TotalTable.= '<tr class="ash strong">
    <td>Total '.$Cur.'</td>
    <td></td>
	<td><div class="text-right" >'.number_format(array_sum($arr),2).'</div></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>';
  
  
} 
*/


	echo '<div class="row">
<div class="col-md-6" >
<h4> Attendance Aging Report</h4>

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

<table class="table" ><tr class="ash">
    <td>Branch Name</td>
    <td>0-15</td>
    <td>16-30</td>
    <td>Above 30</td>
    <td>Total</td>
  </tr>';
	echo $ResultTable;
  echo $TotalTable; 
  echo '</table>
 </div>
      <div class="col-md-6">
	 <h4></h4>
	 <div id="ChartDiv"  style="width:100%; height:600px" ChartName="PieChart">
<span class="Chartdata hide">
</span>
<span class="Options hide">
</span>
</div>


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

?>