<?php  session_start();
 include("LogController.php");
if (!empty($_POST['BranchSelect']) and $_POST['BranchSelect']!='All'){
$_POST['SelectedBranch']=null;
$_POST['SelectedBranch'][$_POST['BranchSelect']]=$_POST['BranchSelect'];
}
if (!empty($_POST['BranchCode']))
	{
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);

$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = '`esoftcar_' . strtolower($bA[1]).$DBsuffix;
//$DataBase = '';

	echo '
 <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Registration Count Break Up</h3>
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
	$DataBase = '';
	$table = '';
	$DateRangOneSql = '';
	$arraychart = '';
	$SearchDesTD = '';
$DateTable=" `registrations`.`RG_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 
	if ($DateRangone and  $DateRangtwo)
		{
}

else
{
	foreach($_POST['SelectedBranch'] as $key => $BranchName)
		{
		$DataBase = $DBprefix. strtolower($key).$DBsuffix;
        //$esoftConfig->exec("USE $DataBase");
	$SqlMain = "SELECT `registration_type`.`D_Code` AS `Division` ,`course`.`C_Code` AS `Course` ,`registrations`.`Default_Batch` AS `Batch`,COUNT(Distinct `RG_ID`) AS `C` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`
	";
$SqlTail=" GROUP BY `Division`,`Course`,`Batch` WITH ROLLUP";	
$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;

		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);



$newd=null;


		foreach($results as $row)
			{
		if($newd!=$row['Division']){
		$table.= '<tr class="info">
    <td><div >' .$row['Division']. '</div></td>
    <td></td>
    <td></td>
  </tr>';
		}	
			if($row['Batch']!=null){
			
		    $newd=$row['Division'];
			$T=$row['Batch'];
			
	$table.= '<tr >
    <td><div class="text-right">' .$T. '</div></td>
    <td><div class="text-right" >' . $row['C'] . '</div></td>
    <td></td>
  </tr>';

			}
			elseif($row['Batch']==null and $row['Course']!=null){
			
			$T='Total of '. $row['Course'];
			$arraychart[] = '["' .  $row['Course'] . '",' . $row['C'] . ']';
			$TotalCount[]=$row['C'];
							$table.= '<tr class="strong">
    <td><div class="text-success text-right">' .$T. '</div></td>
    <td><div class="text-success text-right" >' . $row['C'] . '</div></td>
    <td></td>
  </tr>';
			}
			elseif($row['Course']==null and $row['Division']!=null){
			$T='Total of '.$row['Division'] ;
			
						$table.= '<tr class="strong">
    <td><div class="text-info text-right">' .$T. '</div></td>
    <td><div class="text-info text-right" >' . $row['C'] . '</div></td>
    <td></td>
  </tr>';

			}
						elseif($row['Division']==null){
			$T='Grand Total ' ;
			
						$table.= '<tr class="ash strong" >
    <td><div class=" text-center">' .$T. '</div></td>
    <td><div class="text-right" >' . $row['C'] . '</div></td>
    <td></td>
  </tr>';

			}

			}
			

// Branches Loop End
}


	echo '<div class="row">
<div class="col-md-5" >
<h4>Registrations Break Up Report</h4>

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
    <td><div class="text-right" >Num of Reg.</div></td>
    <td></td>
  </tr>';
	echo $table;
	echo '</table>
 </div>
      <div class="col-md-7">
	 <h4>Piechart Analyze</h4>
	 <div id="drawChartModal" style="width: 100%; height: 600px; position: relative;" ChartName="PieChart"  >
<span class="Chartdata hide">
[["Branch", "Count"],' . @implode(',', $arraychart) . ' ]
</span>
<span class="Options hide">
{"title": "Course Wise Registration Count as a Percentage","pieHole": "0.4" ,"is3D": "true"}
</span>
</div>
	   </div>
  </div>

';
	
	




}
echo '</div>';

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