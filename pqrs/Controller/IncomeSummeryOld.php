<?php   session_start();
// var_dump($_POST);exit;
if (!empty($_POST['BranchSelect']) and $_POST['BranchSelect']!='All'){
$_POST['SelectedBranch']=null;
$_POST['SelectedBranch'][$_POST['BranchSelect']]=$_POST['BranchSelect'];
}
if (!empty($_POST['SelectedBranch']))
	{
    include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
   // $esoftConfig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // $esoftConfig->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$DBprefix='`esoftcar_' ;//use back tic (`)
    $DBsuffix='`' ;
    $TypesSum=array();
	$DataBase = null;
	$table = '';
	$arraychart = '';
	$Where = ' WHERE 1';
	$SearchDesTD = '';
	$arraytypes = array(
		'Cash',
		'Credit Card',
		'Cheque'
	);
$DateTable=" `payments_master`.`PM_Date` ";
include('SearchPostPart.php');
if ($DateRangone and  $DateRangtwo)
		{		

	foreach($_POST['SelectedBranch'] as $Branch => $BranchName)
		{
$DataBase=$DBprefix.(strtolower($Branch)).$DBsuffix;
//$esoftConfig->query(" USE $DataBase ");
	 $FirstRangeWhere = $Where . $FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 
	 $SecondRangeWhere = $Where . $SecondDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart;
 $SqlMain = "SELECT SUM(PM_Amount) FROM $DataBase.`payments_master`
LEFT JOIN $DataBase.`registrations` ON `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";

$SqlTail="";
      $FirstRangeSql= $SqlMain.$FirstRangeWhere.$SqlTail;
     $SecondRangeSql= $SqlMain.$SecondRangeWhere.$SqlTail;
$UnionFinal='SELECT ('.$FirstRangeSql.') AS RC1,( '.$SecondRangeSql.') AS RC2';
      
 //var_dump($BindData);
 
		$sth2 = $esoftConfig->prepare($UnionFinal);
		$sth2->execute($BindData);
		$results2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
		$count2 = $sth2->rowCount();
		if ($count2)
			{
			foreach($results2 as $row)
				{
				if(empty($row['RC1'])){
				$RC1='0.00';
				}
				else
				{
				$RC1=$row['RC1'];
				}
          if(empty($row['RC2'])){
				$RC2='0.00';
				}
				else
				{
				$RC2=$row['RC2'];
				}	
							//$TotalOfBranches[$BranchName . '---' . $Branch][] =array('RC1'=> $RC1,'RC2'=> $RC2);
							$arraychart[] = '["' . $BranchName . '",' . $RC1. ',' . $RC2 . ']';
							$TotalOfRang1[]=$RC1;
							$TotalOfRang2[]=$RC2;
                 $table.= '<tr><td>' . $BranchName . '</td><td><div class="text-right" >' . number_format($RC1,2) . '</div></td><td><div class="text-right" >' . number_format($RC2,2) . '</div></td><td><div class="text-right" >'. number_format(($RC1+$RC2) , 2).'</div></td></tr>';

				}
			}
		  else
			{
				//$TotalOfBranches[$BranchName . '---' . $Branch][] =array('RC1'=> '0.00','RC2'=> '0.00');
                 $table.= '<tr><td>' . $BranchName . '</td><td><div class="text-right" >0.00</div></td><td><div class="text-right" >0.00</div></td><td><div class="text-right" >0.00</div></td></tr>';
			}
			

//End Branch Loop Data Fetch
}


				
	echo '
     <div class="row">
<h4>Column Chart Analyze</h4>
	 
	 <div id="ChartDiv" ChartName="ColumnChart"  >
<span class="Chartdata hide">
[["Branch", "Range1", "Range2"],' . @implode(',', $arraychart) . ' ]
</span>
<span class="Options hide">
{ "title": "Branch Wise Collection Between two date range","vAxis": {"minValue": 0} }
</span>
</div>
	   </div>
	    </div>
     <div class="row">
	 	 <h4>All Island Cash Collection Report</h4>

     <div class="col-md-5">

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
    <td><div class="text-right" >Range1 Total</div></td>
    <td><div class="text-right" >Range2 Total</div></td>
    <td><div class="text-right" > Total </div></td>
  </tr></thead><tbody>';
	echo $table;
	
	$TotalOfRang1amount=array_sum($TotalOfRang1);
	$TotalOfRang2amount=array_sum($TotalOfRang2);
	echo '</tr></tbody><tr class="ash strong">
    <td>Total</td>
    <td ><div class="text-right" >'. number_format($TotalOfRang1amount , 2, '.', '').'</div></td>
    <td><div class="text-right" >'. number_format((float)$TotalOfRang2amount , 2, '.', '').'</div></td>
    <td><div class="text-right" >'. number_format((float)($TotalOfRang1amount+$TotalOfRang2amount) , 2, '.', '').'</div></td>
  </tr></table>
  </div>

';

//End Data Fetch if  $DateRangone and  $DateRangtwo true		
}
else
{
$DateTable=" `payments_master`.`PM_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where.$FirstDatePart.$DivisionPart.$BatchPart.$BatchStatusPart.$CoursPart.$IntakePart ;
$DateTable=" `other_payments`.`OP_Date` ";
include('SearchPostPart.php');
$FirstRangeWhereOther = $Where.$FirstDatePart.$DivisionPart.$BatchPart.$BatchStatusPart.$CoursPart.$IntakePart ;

foreach($_POST['SelectedBranch'] as $Branch => $BranchName)
		{
/*-------------------------------------------------------
-------------------- Course Payments --------------------
-------------------------------------------------------*/

$DataBase=$DBprefix.(strtolower($Branch)).$DBsuffix;
$SQLSYNC="SELECT `date` FROM $DataBase.`get_sync` WHERE `status`='1' ORDER BY `id` DESC LIMIT 1 ";
$sths = $esoftConfig->prepare($SQLSYNC);
$sths->execute();
$resultsSync = $sths->fetchAll(PDO::FETCH_ASSOC);
$LastSync[$Branch]=(isset($resultsSync[0]['date'])? $resultsSync[0]['date']:'No records');
$SqlMain = "SELECT `payments_master`.`PM_Type` AS T ,SUM(PM_Amount) AS A,`Currency` FROM $DataBase.`payments_master`
LEFT JOIN $DataBase.`registrations` ON `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" GROUP BY `Currency`,`PM_Type`";
       $FirstRangeSql= $SqlMain.$FirstRangeWhere.$SqlTail;
         // $esoftConfig->exec(" USE $DataBase ");
		$sth = $esoftConfig->prepare($FirstRangeSql);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		$count = $sth->rowCount();
		if ($count)
			{
			foreach($results as $row)
				{
				$TypesOfBranchesMain[$row['Currency']][$BranchName. '---' . $Branch][$row['T']] = $row['A'];
				$TotalOfBranchesMain[$row['Currency']][$BranchName. '---' . $Branch][] = $row['A'];
				$TotalOfBranchesTypes[$row['Currency']][$row['T']][] = $row['A'];
				$TotalOfAllIsland[$row['Currency']][] = $row['A'];
                
				// $table.='<tr><td>'.$Branch.'</td><td>'.$row['PM_Type'].'</td><td>'.$row['SUM(PM_Amount)'].'</td></tr>';

				}
			}
			else
			{
				$TypesOfBranchesMain['LKR'][$BranchName. '---' . $Branch]['Cash'] = '0';
				$TotalOfBranchesMain['LKR'][$BranchName. '---' . $Branch][] = '0';
				$TotalOfBranchesTypes['LKR']['Cash'][] = '0';
				$TotalOfAllIsland['LKR'][] ='0';
			}
		
/*-------------------------------------------------------
-------------------- Other Payments --------------------
-------------------------------------------------------*/
/*
$DataBase=$DBprefix.(strtolower($Branch)).$DBsuffix;
$SqlMain = "SELECT `other_payments`.`OP_Type` AS `TOP` ,SUM(`OP_Amount`) AS `AOP`,`Currency` FROM $DataBase.`other_payments`
LEFT JOIN $DataBase.`registrations` ON `other_payments`.`RG_Reg_No`=`registrations`.`RG_Reg_NO` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" GROUP BY `Currency`,`OP_Type`";
        $FirstRangeSqlOther= $SqlMain.$FirstRangeWhereOther.$SqlTail;
         // $esoftConfig->exec(" USE $DataBase ");
		$sth = $esoftConfig->prepare($FirstRangeSqlOther);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		$count2 = $sth->rowCount();
		if ($count2)
			{
			foreach($results as $row)
				{
				$TypesOfBranchesMain[$row['Currency']][$BranchName.'(Other)'. '---' . $Branch][$row['TOP']] = $row['AOP'];
				$TotalOfBranchesMain[$row['Currency']][$BranchName.'(Other)'. '---' . $Branch][] = $row['AOP'];
				$TotalOfBranchesTypes[$row['Currency']][$row['TOP']][] = $row['AOP'];
				$TotalOfAllIsland[$row['Currency']][] = $row['AOP'];
                
				// $table.='<tr><td>'.$Branch.'</td><td>'.$row['PM_Type'].'</td><td>'.$row['SUM(PM_Amount)'].'</td></tr>';

				}
			}
			else
			{
				//$TypesOfBranchesMain['LKR'][$BranchName.'(Other)'. '---' . $Branch]['Cash'] = '0';
				//$TotalOfBranchesMain['LKR'][$BranchName.'(Other)'. '---' . $Branch][] = '0';
				//$TotalOfBranchesTypes['LKR']['Cash'][] = '0';
				//$TotalOfAllIsland['LKR'][] ='0';
			}
			*/
/*-------------------------------------------------------
-------------------- Other Payments END --------------------
-------------------------------------------------------*/

//End Data Fetch if not $DateRangone and  $DateRangtwo true
}
//End Branch Loop Data Fetch

if($TypesOfBranchesMain){
	foreach($TypesOfBranchesMain as $cur => $TypesOfBranches)
		{
	foreach($TypesOfBranches as $b => $C)
		{
		$bA = explode('---', $b);
		$table.= '<tr><td>'. $bA[0] .'-'.$cur.'</td>';
		foreach($arraytypes as $Types)
			{
			if (array_key_exists($Types, $C))
				{
				$table.= '<td align="right">' . number_format($C[$Types],2) . '</td>';
				
           $TypesSum[$Types][] = $C[$Types];
				}
			  else
				{
				$table.= '<td align="right">0.00</td>';
				$TypesSum[$Types][] = 0;
				}
			}

		if (!empty($TotalOfBranchesMain[$cur][$b]))
			{
			$totalbranch=array_sum($TotalOfBranchesMain[$cur][$b]);
			$totalbranchfomated = number_format($totalbranch,2);
			$arraychart[] = '["' . $bA[0] . '",' . $totalbranch . ']';
			$table.= '<td class="ash strong" align="right">' . $totalbranchfomated . '</td>';
			}
		  else
			{
			$table.= '<td align="right">0.00</td>';
			$arraychart[] = '["' . $bA[0] . '",0.00]';
			}

		$table.= '<td SelectedBranch="'.$b.'" show="modal" date1="1" date2="1" report="IncomeDetail" format="ViewBreakupSummery" class="CountCommon_Save" >View</td><td SelectedBranch="'.$b.'" date1="1" date2="1" show="modal" report="IncomeBreakUp" format="ViewBreakupSummery" class="CountCommon_Save" >View</td>
<td>'.$LastSync[$bA[1]].'</td>		';
		
		}
		}


	echo '
     <div class="row">
     <div class="col-md-7">
	 <h4>All Island Cash Collection Report</h4>

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
    <th>Branch Name</th>
    <th><div class="text-right" >Cash Payments</div></th>
    <th><div class="text-right" >Card Payments</div></th>
    <th><div class="text-right" >Cheque Payments</div></th>
    <th><div class="text-right" >Total</div></th>
    <th class="sorttable_nosort">Detailed View</th>
    <th class="sorttable_nosort">Breakup View</th>
    <th class="sorttable_nosort">Last Sync</th>
  </tr>
 </thead>
 <tbody>

';
  
	echo $table;
	echo '</tr></tbody>';
	
	
	foreach($TotalOfBranchesTypes as $PCur => $Asum){
	echo '<tfoot><tr class="ash strong">
    <td>Total '.$PCur.'</td>';
			foreach($arraytypes as $Types)
			{
if (array_key_exists($Types, $Asum))
				{
    echo '<td align="right">' . number_format(array_sum($Asum[$Types]), 2) . '</td>';
}
else
{
    echo '<td align="right" >0.00</td>';
}
    }
    echo '<td align="right">' . number_format(array_sum($TotalOfAllIsland[$PCur]),2) . '</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>';
  }
  echo '</tfoot></table>
  </div>
     <div class="col-md-5"  style="overflow:hidden">
	 <h4>Piechart Analyze</h4>
	 <div id="ChartDiv" ChartName="PieChart">
<span class="Chartdata hide">[["Branch", "Amount"],' . implode(',', $arraychart) . ']</span>
<span class="Options hide">
{ "title": "Branch Wise Payment Collection as a Percentage","is3D": "true" }
</span>
</div>
	   </div>  
  </div>
  
 
';

}
else
{
	echo ' <div class="alert alert-warning">
    <h4>Warning!</h4>
   <h3>No Data to Display!</h3>.
    </div>';
	
	}
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

