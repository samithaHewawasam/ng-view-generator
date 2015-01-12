<?php session_start();
 include("LogController.php");
if (!empty($_POST['BranchSelect']) and $_POST['BranchSelect']!='All'){
$_POST['SelectedBranch']=null;
$_POST['SelectedBranch'][$_POST['BranchSelect']]=$_POST['BranchSelect'];
}
$Totalpaid=null;
$Nopaid=null;
if(!empty($_POST['RegNo'])){
$RegStr=explode(',',$_POST['RegNo']);
//$RegStr=implode("','",$RegStr);
}
if(!empty($_GET['Aging'])){

switch($_GET['Aging']){
case 'F':
$having=" HAVING `P`='1970-01-01'";
$Nopaid=true;
break;
case 'P':
$having='';
$Totalpaid=true;
break;
case 1:
$having=' HAVING `P` BETWEEN 0 AND 30';
break;
case 2:
$having=' HAVING `P` BETWEEN 31 AND 45';
break;
case 3:
$having=' HAVING `P` BETWEEN 46 AND 60';
break;
case 4:
$having=' HAVING `P` > 60';
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
   <h3>Due Report</h3>
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

// AND `student_installments`.`SI_Due_Date` < CURDATE()


	

	$SqlMain = "SELECT SUM(`SI_Ins_Amount`-`SI_Paid_Amount`) AS `C`,MIN(`student_installments`.`SI_Due_Date`) AS `D`,(DATEDIFF(CURDATE(),(SELECT MAX(`payments_master`.`PM_Date`)  FROM `payments_master` WHERE `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO`))) As `P`,`registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`student_master`.`SM_ID` ,`student_master`.`SM_Title`,`student_master`.`SM_Initials` ,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`student_master`.`SM_Tell_Mobile`,`student_master`.`SM_Tel_Residance`,`student_master`.`SM_Mail_Personal`,`student_master`.`SM_Parent_Phone`,`batch_master`.`BM_Course_Code` AS `CT_Course_Code`,IF( SUBSTRING_INDEX( `RG_Fee_Structure`, '|', 1 ) = `RG_Fee_Structure` , 'LKR', SUBSTRING_INDEX( `RG_Fee_Structure`, '|', 1 ) ) AS `Currency` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`student_installments` ON `registrations`.`RG_Reg_NO`=`student_installments`.`SI_Reg_No`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
";

$z=0;
foreach($RegStr as $v){
$NewCur=null;
$z++;
 //$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail.$having;
  $SqlSetOne = $SqlMain." WHERE 1 AND `registrations`.`RG_Reg_NO` ='".$v."' AND `student_installments`.`SI_Due_Date` <= CURDATE()";	
		// echo $SqlSetOne.'<br /><br />';
		
		$sth2 = $esoftConfig->prepare($SqlSetOne);
		$sth2->execute($BindData);
		$results = $sth2->fetchAll(PDO::FETCH_ASSOC);
		$count = $sth2->rowCount();

		foreach($results as $row)
			
			{	$TotalCount[$row['Currency']][]=$row['C'];
 			empty($row['C']) ? $row['C']='0.00':'sfdse' ;
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
	if($row['Currency']!=$NewCur){
$arrayforexel[$row['Currency']][0]=array('Reg No','Stu ID','Student Name','Tell(TM/TR/TP)','Student E-mail','Batch','Upto date Due','Last Pay Age','Last Pay');	
$i=1;
	}
	
	
$NewCur=$row['Currency'];		
$StudentName=$row['SM_Title'].' '.$row['SM_First_Name'].' '.$row['SM_Last_Name'];
$DueAge=floor(($Today-strtotime($row['D']))/86400);
        $LastPay= date('Y-m-d', strtotime(date('Y-m-d'). ' - '.$row['P'].' days'));

$arrayforexel[$row['Currency']][$z]=array($row['RG_Reg_NO'],$row['SM_ID'],$StudentName,$tel,$row['SM_Mail_Personal'],$row['Default_Batch'],$row['C'],$row['P'],$LastPay);	
		
  $z++;

}
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
	<td align="right">'.$roww[6].'</td>
    <td align="right">'.$roww[7].'</td>
    <td><div class="text-right" >'.($roww[8]=='1970-01-01'?'':$roww[8] ).'</div></td>
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
    
    <td>Total</td>
	<td align="right"><div class="text-right" >'.sprintf('%0.2f', array_sum($TotalCount[$Cur])).'</div></td>
    <td></td>
    <td></td>
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
<h4>Due Payments Detail Report - '.$bA[0].'</h4>
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
		echo $SearchDesTD.'<tr>
    <td>Batch Status</td>
    <td>Active</td>
  </tr>';
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