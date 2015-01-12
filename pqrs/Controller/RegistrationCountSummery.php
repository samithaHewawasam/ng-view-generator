<?php  session_start();
 include("LogController.php");
if (!empty($_POST['BranchSelect']) and $_POST['BranchSelect']!='All'){
$_POST['SelectedBranch']=null;
$_POST['SelectedBranch'][$_POST['BranchSelect']]=$_POST['BranchSelect'];
}
if (!empty($_POST['SelectedBranch']))
	{
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
/*
##############################################################################################
#
# Building Query For Advanced Search
# 
# 
##############################################################################################

*/  $DBprefix='`esoftcar_' ;//use back tic (`)
    $DBsuffix='`' ;//use back tic (`)
	$DataBase = '';
	$SqlSetOne = '';
	$BindData = null;
	$table = '';
	$DateRangOneSql = '';
	$arraychart = '';
	$Where = ' WHERE 1';
	$SearchDesTD = '';
	$DateRangone='';
	$DateRangtwo='';
	$DateRangthree='';
	$TotalCount=array();
	
$DateTable=" `registrations`.`RG_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 
$ScondRangeWhere = $Where . $RGStatusPart.$SecondDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 
	if ($DateRangone and  $DateRangtwo)
		{
	// Branches Loop
	foreach($_POST['SelectedBranch'] as $key => $BranchName)
		{
		$DataBase = $DBprefix. strtolower($key).$DBsuffix;
        //$esoftConfig->exec("USE $DataBase");
	$SqlMain = "SELECT COUNT(Distinct RG_ID) AS `C` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`
";
$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;
$SqlSetTwo = $SqlMain.$ScondRangeWhere.$SqlTail;
    $UnionFinal='SELECT ('.$SqlSetOne.') AS RC1,( '.$SqlSetTwo.') AS RC2';


		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($UnionFinal);
		$sth->execute($BindData);
		$count=$sth->rowCount();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
   if($count) { 

	foreach($results as $row)
			{
			$arraychart[] = '["' . $BranchName . '",' . $row['RC1']. ',' . $row['RC2'] . ']';
			$TotalCount1[]=$row['RC1'];
			$TotalCount2[]=$row['RC2'];

			$table.= '<tr>
    <td>' . $BranchName . '</td>
    <td><div class="text-right" >' . $row['RC1'] . '</div></td>
    <td><div class="text-right" >' . $row['RC2'] . '</div></td>
    <td></td>
  </tr>';
			}

		// Branches Loop End

	
}
else
{
			$arraychart[] = '["' . $BranchName . '",0,0]';
			$TotalCount1[]=0;
			$TotalCount2[]=0;

			$table.= '<tr>
    <td>' . $BranchName . '</td>
    <td><div class="text-right" >0</div></td>
    <td><div class="text-right" >0</div></td>
    <td></td>
  </tr>';}

}
echo '<div class="row">
<h4>Column Chart Analyze</h4>
	 <div id="ChartDiv" ChartName="ColumnChart"  >
<span class="Chartdata hide">
[["Branch", "Range1", "Range2"],' . @implode(',', $arraychart) . ' ]
</span>
<span class="Options hide">
{"title": "Branch Wise Registration Count Between two date range","vAxis": {"minValue": 0} }
</span>
</div>
	   </div>
	   </div>
<div class="row">
<h4>All Island Registrations Summery Report</h4>

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
      <div class="col-md-6">
	  
<table class="table tablesorter" id="myTablex"  >
<thead>
	 <tr class="ash">
    <td>Branch Name</td>
    <td><div class="text-right" >Range 1 Count</div></td>
    <td><div class="text-right" >Range 2 Count</div></td>
    <td></td>
  </tr></thead><tbody>';
	echo $table;
	echo '</tr></tbody><tr class="ash strong">
    <td>Total</td>
    <td><div class="text-right" >'.array_sum($TotalCount1).'</div></td>
    <td><div class="text-right" >'.array_sum($TotalCount2).'</div></td>
    <td></td>
  </tr></table>
  
  </div>

';
	





}
elseif($DateRangone and  $DateRangthree)
{


}
else
{
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart;
 
	foreach($_POST['SelectedBranch'] as $key => $BranchName)
		{
		
		
		$DataBase = $DBprefix. strtolower($key).$DBsuffix;
        //$esoftConfig->exec("USE $DataBase");
	$SqlMain = "SELECT COUNT(Distinct RG_ID) AS `C` FROM $DataBase.`registrations` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`
 ";
	
 $SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;

		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);






		foreach($results as $row)
			{
			$arraychart[] = '["' . $BranchName . '",' . $row['C'] . ']';
			$TotalCount[]=$row['C'];
			$table.= '<tr>
    <td>' . $BranchName . '</td>
    <td><div class="text-right" >' . $row['C'] . '</div></td>
    <td class="CountCommon_Save" show="modal" rgst="1" date1="1" date2="1" report="RegistrationCountDetail" selectedbranch="'.$BranchName.'---'.$key.'" format="ViewBreakupSummery">View Breakup</td>
  </tr>';
			}
			

// Branches Loop End
}


	echo '<div class="row">
<div class="col-md-4" >
<h4>All Island Registrations Summery Report</h4>

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

<table class="table tablesorter" id="myTablex"  >
<thead>
<tr class="ash">
    <td>Branch Name</td>
    <td><div class="text-right" >Num of Registrations</div></td>
    <td class="sorttable_nosort" ></td>
  </tr></thead><tbody>';
	echo $table;
	echo '</tr></tbody><tr class="ash strong">
    <td>Total</td>
	<td><div class="text-right" >'.array_sum($TotalCount).'</div></td>
    <td></td>
  </tr></table>
 </div>
      <div class="col-md-8">
	 <h4>Piechart Analyze</h4>
	 <div id="ChartDiv"  style="width:100%; height:600px" ChartName="PieChart">
<span class="Chartdata hide">
[["Branch", "Count"],' . @implode(',', $arraychart) . ' ]
</span>
<span class="Options hide">
{ "title": "Branch Wise Registration Count as a Percentage","pieHole": "0.4" ,"is3D": "true"}
</span>
</div>

	   </div>
  </div>

';
	
	




}
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