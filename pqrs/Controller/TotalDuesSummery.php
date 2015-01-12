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
$DateTable=" `student_installments`.`SI_Due_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 

	foreach($_POST['SelectedBranch'] as $key => $BranchName)
		{
$DataBase = $DBprefix. strtolower($key).$DBsuffix;
$esoftConfig->exec("USE $DataBase ");
	 
	 
$SqlMain = "

SELECT SUM(`SI_Ins_Amount`-`SI_Paid_Amount`) AS `C`,IF( SUBSTRING_INDEX( `RG_Fee_Structure`, '|', 1 ) = `RG_Fee_Structure` , 'LKR', SUBSTRING_INDEX( `RG_Fee_Structure`, '|', 1 ) ) AS `Currency` FROM $DataBase.`student_installments`
LEFT JOIN $DataBase.`registrations` ON `student_installments`.`SI_Reg_No`=$DataBase.`registrations`.`RG_Reg_NO`
LEFT JOIN `registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN `batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN `course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" AND $DataBase.`student_installments`.`SI_Ins_Amount`- $DataBase.`student_installments`.`SI_Paid_Amount` > 0 GROUP BY `Currency` ";
 $SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;

		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);

		foreach($results as $row)
			{
			empty($row['C']) ? $row['C']='0.00':'' ;
			//$arraychart[] = '["' . $BranchName . '",' . $row['C'] . ']';
			$TotalCount[$row['Currency']][]=$row['C'];
			
						$ResultTable.= '<tr>
    <td>' . $BranchName.'-'.$row['Currency'] . '</td>
    <td><div class="text-right" >'.number_format($row['C'],2).'</div></td>
    <td class="CountCommon_Save"  show="modal" rgst="1" date1="1" date2="0" report="TotalDuesDetail" SelectedBranch="'.$BranchName.'---'.$key.'" format="ViewBreakupSummery" >View Break up</td>
    <td class="CountCommon_Save"  show="modal" rgst="1" date1="1" date2="0" report="TotalDuesDetail" SelectedBranch="'.$BranchName.'---'.$key.'" format="ViewBreakupDetail" >View Breakup Detail</td>
  </tr>';

}


$results=null;
$key='';
$BranchName='';
// Branches Loop End
}
foreach($TotalCount as $Cur => $arr){
	$TotalTable.= '<tr class="ash strong">
    <td>Total '.$Cur.'</td>
	<td><div class="text-right" >'.number_format(array_sum($arr),2).'</div></td>
    <td></td>
    <td></td>
  </tr>';
} 



	echo '<div class="row">
<div class="col-md-6" >
<h4>Due payment summery Report</h4>

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
    <td><div class="text-right" >Total Dues</div></td>
    <td></td>
    <td></td>
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