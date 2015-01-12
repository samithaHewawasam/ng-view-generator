<?php  session_start();
 include("LogController.php");
if (!empty($_POST['BranchSelect']) and $_POST['BranchSelect']!='All'){
$_POST['SelectedBranch']=null;
$_POST['SelectedBranch'][$_POST['BranchSelect']]=$_POST['BranchSelect'];
}
if (!empty($_POST['SelectedBranch']))
	{
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);

	echo '<div class="modal-body" >';
	

	
	
/*
##############################################################################################
#
# Building Query For Advanced Search
# 
# 
##############################################################################################

*/  $DBprefix='`esoftcar_' ;//use back tic (`)
    $DBsuffix='`' ;
    $Today=time();
	$DataBase = '';
	$SqlSetOne = '';
	$BindData = null;
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	//$Where = " WHERE 1 AND registrations.`RG_Final_Fee`-registrations.`RG_Total_Paid` > 0 AND `RG_Status`='Active'";
	$table='';
	$SearchDesTD = '';
	
if(!empty($_POST['BranchCode']))
{
$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);

$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = $DBprefix.strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
$DataBase2=$DBprefix.strtolower($bA[1]).$DBsuffix;
//$esoftConfig->query("USE $DataBase2");
}
	
$DateTable=" `registrations`.`RG_Date` ";
include('SearchPostPart.php');

	foreach($_POST['SelectedBranch'] as $key => $BranchName)
		{
  			$table.= '<tr>
    <td>' . $BranchName . '</td>
    <td class="CountCommon_Save" show="modal" rgst="1" report="BatchWiseStuDetails" selectedbranch="' . $BranchName . '---' . $key . '" format="ViewBreakupSummery"> View </td>
    <td></td>
  </tr>';

// Branches Loop End
}


	echo '<div class="row">

<div class="col-md-6" >
<h4>Summery Report</h4>

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
    <td><div class="text-right" ></div></td>
    <td></td>
  </tr>';
	echo $table;
	echo '</tr><tr class="ash strong">
    <td></td>
	<td><div class="text-right" ></div></td>
    <td></td>
  </tr></table>
 </div>
      <div class="col-md-4">
  </div>

';
	
	





/////////////


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