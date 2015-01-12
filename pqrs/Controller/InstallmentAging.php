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
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart." AND `batch_master`.`BM_Status`='Active' "; 

	foreach($_POST['SelectedBranch'] as $key => $BranchName)
		{
$DataBase = $DBprefix. strtolower($key).$DBsuffix;
$esoftConfig->exec("USE $DataBase ");

/////////////////////////////////////////
$SqlMain="SELECT
  (SELECT if(RG_Final_Fee <= RG_Total_Paid,'ok','no')
   FROM `registrations` T
   WHERE RG_Reg_No = `registrations`.RG_Reg_NO) tp,
  (SELECT if(`SI_Paid_Amount`>0,'ok','no') AS `T`
   FROM `student_installments`
   WHERE SI_Reg_No = `registrations`.RG_Reg_NO
     AND SI_Ins_NO =1 ) AS `First` ,
  (SELECT if(`SI_Paid_Amount`>0,'ok','no') AS `T`
   FROM `student_installments`
   WHERE SI_Reg_No = `registrations`.RG_Reg_NO
     AND SI_Ins_NO =2 ) AS `Second` ,
  (SELECT if(`SI_Paid_Amount`>0,'ok','no') AS `T`
   FROM `student_installments`
   WHERE SI_Reg_No = `registrations`.RG_Reg_NO
     AND SI_Ins_NO =3 ) AS `Third` ,
  (SELECT if(`SI_Paid_Amount`>0 ,'ok','no') AS `T`
   FROM `student_installments`
   WHERE SI_Reg_No = `registrations`.RG_Reg_NO
     AND SI_Ins_NO =4 ) AS `Fourth` ,
  (SELECT if(`SI_Paid_Amount`>0,'ok','no') AS `T`
   FROM `student_installments`
   WHERE SI_Reg_No = `registrations`.RG_Reg_NO
     AND SI_Ins_NO =5 ) AS `Fifth` ,
                                                      Rg_Reg_No tc
FROM `registrations` 
LEFT JOIN `registration_type` ON `registrations`.`RG_Reg_Type` = `registration_type`.`RT_Code`
LEFT JOIN `batch_master` ON `registrations`.`Default_Batch` = `batch_master`.`BM_Batch_Code`
LEFT JOIN `course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`   
";


  /////////////////////////////////////////
/*
$SqlMain2 = "
SELECT DISTINCT `registrations`.`RG_Reg_NO`  FROM $DataBase.`registrations`
LEFT JOIN `registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN `batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN `course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`
";
$SqlTail2=" AND `batch_master`.`BM_Status`='Active' AND `registrations`.`RG_Final_Fee`<= .`registrations`.`RG_Total_Paid` GROUP BY `registrations`.`RG_Reg_NO` ";
 $SqlSetOne2 = $SqlMain2.$FirstRangeWhere.$SqlTail2;
		$sth2 = $esoftConfig->prepare($SqlSetOne2);
		$sth2->execute($BindData);
		(int)$TpC=$sth2->rowCount();
		
////////////////////////////////////////////////////	 
	 
$SqlMain = "

SELECT MAX(`payments_master`.`PM_Date`) AS `D`, (`registrations`.`RG_Final_Fee`- `registrations`.`RG_Total_Paid`) AS `TotalDue`,`payments_master`.`Currency`  AS `Currency` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`payments_master` ON `registrations`.`RG_Reg_NO`=`payments_master`.`RG_Reg_No`
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" AND `registrations`.`RG_Final_Fee`>`registrations`.`RG_Total_Paid` AND `batch_master`.`BM_Status`='Active' GROUP BY `payments_master`.`RG_Reg_No`";
*/
$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;


		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
				(int)$TotalReg=$sth->rowCount();

$ColA=0;
$ArrayA=array();
$ColB=0;
$ArrayB=array();
$ColC=0;
$ArrayC=array();
$ColD=0;
$ArrayD=array();
$ColE=0;
$ArrayE=array();
$ColF=0;
$ArrayF=array();
$ColG=0;
$ArrayG=array();
		foreach($results as $row)
			{

if(($row['tp'])=='ok'){
$ColA++;
$ArrayA[]=$row['tc'];
}
elseif(!empty($row['Fifth']) && $row['Fifth']=='ok'){
$ColF++;
$ArrayF[]=$row['tc'];

}
elseif(!empty($row['Fourth']) && $row['Fourth']=='ok'){
$ColE++;
$ArrayE[]=$row['tc'];

}
elseif(!empty($row['Third']) && $row['Third']=='ok'){
$ColD++;
$ArrayD[]=$row['tc'];

}
elseif(!empty($row['Second']) && $row['Second']=='ok'){
$ColC++;
$ArrayC[]=$row['tc'];

}
elseif(!empty($row['First']) && $row['First']=='ok'){
$ColB++;
$ArrayB[]=$row['tc'];

}
else{
$ColG++;
$ArrayG[]=$row['tc'];

}



/*
else

			empty($row['C']) ? $row['C']='0.00':'' ;
			//$arraychart[] = '["' . $BranchName . '",' . $row['C'] . ']';
			
		$DueAge=floor(($Today-strtotime($row['D']))/86400);

if($DueAge >=0 && $DueAge <= 30){
$Col1++;
}
elseif($DueAge >30 && $DueAge <= 45){
$Col2++;
}		
elseif($DueAge >45 && $DueAge <= 60){
$Col3++;
}		
elseif($DueAge >60){
$Col4++;
}		
*/						

}
$ResultTable.= '<tr>
    <td>' . $BranchName. '</td>
    <td align="right"><a href="#" class="customreport" page="TotalDuesDetailAgingReport.php?Aging=P" RegNo="'.implode(',',$ArrayA).'" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="TotalDuesDetail"  format="ViewBreakupDetail">'.$ColA.' </a></td>
    <td align="right"><a href="#" class="customreport" page="TotalDuesDetailAgingReport.php?Aging=F" RegNo="'.implode(',',$ArrayB).'" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="TotalDuesDetail"  format="ViewBreakupDetail">'.$ColB.' </a></td>
    <td align="right"><a href="#" class="customreport" page="TotalDuesDetailAgingReport.php?Aging=1" RegNo="'.implode(',',$ArrayC).'" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="TotalDuesDetail"  format="ViewBreakupDetail">'.$ColC.' </a></td>
    <td align="right"><a href="#" class="customreport" page="TotalDuesDetailAgingReport.php?Aging=2" RegNo="'.implode(',',$ArrayD).'" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="TotalDuesDetail"  format="ViewBreakupDetail">'.$ColD.' </a></td>
    <td align="right"><a href="#" class="customreport" page="TotalDuesDetailAgingReport.php?Aging=3" RegNo="'.implode(',',$ArrayE).'" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="TotalDuesDetail"  format="ViewBreakupDetail">'.$ColE.'</a></td>
    <td align="right"><a href="#" class="customreport" page="TotalDuesDetailAgingReport.php?Aging=4" RegNo="'.implode(',',$ArrayF).'" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="TotalDuesDetail"  format="ViewBreakupDetail">'.$ColF.'</a></td>
    <td align="right"><a href="#" class="customreport" page="TotalDuesDetailAgingReport.php?Aging=4" RegNo="'.implode(',',$ArrayG).'" SelectedBranch="'.$BranchName.'---'.$key.'" show="modal" rgst="1" date1="0" date2="0" report="TotalDuesDetail"  format="ViewBreakupDetail">'.$ColG.'</a></td>
    <td align="right">'.($TotalReg).'</td>
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
<h4>Installments Analysis Summary Report</h4>

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
		echo $SearchDesTD.'<tr>
    <td>Batch Status</td>
    <td>Active</td>
  </tr>';
		}

	echo '</table>

<table class="table" ><tr class="ash">
    <td>Branch Name</td>
    <td align="right">Fully Paid</td>
    <td align="right">First</td>
    <td align="right">Second</td>
    <td align="right">Third</td>
    <td align="right">Fourth</td>
    <td align="right">Fifth</td>
    <td align="right">No Payment</td>
    <td align="right">Total</td>
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