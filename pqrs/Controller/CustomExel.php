<?php session_start();
 include("LogController.php");
if (empty($_POST['BranchCode']) && !empty($_POST['SelectedBranch']) && $_SESSION['bset']==1){
$key=key($_POST['SelectedBranch']);
$_POST['BranchCode']=$_POST['SelectedBranch'][$key].'---'.$_SESSION['Sys_U_Branches'];
}
$_POST['BranchCode']='Colombo---col';
if(!empty($_POST['BranchCode']))
{
	echo ' <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Batch Wise Student Details</h3>
    </div>
	<div class="modal-body" >';
	
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
	$SqlSetOne = '';
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	//$Where = " WHERE 1 AND registrations.`RG_Final_Fee`-registrations.`RG_Total_Paid` > 0 AND `RG_Status`='Active'";
	$Where = "WHERE 1 ";
	$SearchDesTD = '';
	$Orderby=' ORDER BY `Default_Batch`';
    $myReport = "temp/123.xlsx";

$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);

$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
$DataBase2=$DBprefix.strtolower($bA[1]).$DBsuffix;
//$esoftConfig->query("USE $DataBase2");

//$DateTable=" `registrations`.`RG_Date` ";
//include('SearchPostPart.php');

//$FirstRangeWhere = $Where.$RGStatusPart.$DivisionPart.$BatchPart. $BatchStatusPart.$CoursPart.$IntakePart; 
$SqlMain = "SELECT MONTHNAME(`payments_master`.`PM_Date`) AS `Month` , `course`.`C_Code` AS `Course` , payments_master.Currency,   SUM(`payments_master`.`PM_Amount`) AS `C` FROM $DataBase.`payments_master` 
LEFT JOIN $DataBase.`registrations` ON `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code` 
WHERE `payments_master`.`PM_Date` BETWEEN '2014-01-01' AND CURDATE() ";
$SqlTail=" GROUP BY `Course`,`Month` ";
   $SqlSetOne = $SqlMain.$SqlTail;

		// echo $SqlSetOne.'<br /><br />';
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute();
		$count = $sth->rowCount();
		
if($count<1000)	{	
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		foreach($results as $row)
			{
$Arr[$row['Course']][$row['Month']]=$row['C'];
//$ArrSum[$row['Month']][$row['Currency']][]=$row['C'];

}



$arrayforexel[0]=array('Course','January','February','March','April','May','June','July',);	
 $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);

$ResultTable.='
<input id="DBcode" type="hidden" value="'.$bA[1].'"></input>
<table class="table" ><tr class="ash">
    <td>No</td>
    <td>Stu ID</td>
    <td>Reg No</td>
    <td>Student Name</td>
    <td>Student Address</td>
    <td>Tell(TM/TR/TP)</td>
    <td>Student E-mail</td>
    <td>Batch</td>
    <td>Reg Status</td>
    <td></td>
  </tr>';
  $i=1;
		foreach($Arr as $key => $SubArr)
			{
		$tel='';
$arrayforexel[$i]=array($key,
isset($SubArr['January'])? ($SubArr['January']):'0',
isset($SubArr['February'])? ($SubArr['February']):'0',
isset($SubArr['March'])? ($SubArr['March']):'0',
isset($SubArr['April'])? ($SubArr['April']):'0',
isset($SubArr['May'])? ($SubArr['May']):'0',
isset($SubArr['June'])? ($SubArr['June']):'0',
isset($SubArr['July'])? ($SubArr['July']):'0',
);	
$i++;
/*
$ResultTable.=  '<tr >
    <td>'.$i++.'</td>
    <td>'.$row['SM_ID'].'</td>
    <td  ><a  class="View"  href="#view" data="'.$row['SM_ID'].'" >'.$row['RG_Reg_NO'].'</a></td>
    <td>'.$StudentName.'</td>
    <td>'.$StudentAddress.'</td>
    <td>'.$tel.'</td>
    <td>'.$row['SM_Mail_Personal'].'</td>
    <td>'.$row['Default_Batch'].'</td>
    <td ><span class="Status"   data-value="'.$row['RG_Status'].'" data-pk="'.$randomString.base64_encode('registrations+++RG_Status+++RG_Reg_NO+++'.$row['RG_Reg_NO'].'+++'.$bA[1]).'" >'.$row['RG_Status'].'</td>
    <td></td>
  </tr>';
  
  */
}

$ResultTable.='
	<tr class="ash strong">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

	
  </tr></table>';
// Branches Loop End
require_once '../Library/php/E/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();
$objWorksheet->fromArray($arrayforexel);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save($myReport);
	echo '
<div class="row">	
<div class="col-md-12">
<h4>Student Detail Report</h4>
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
<a href="Controller/'.$myReport.'">Export to Exel</a><br /><br />
<a target="_blank" href="StudentPdf.php?string='.base64_encode(serialize($_POST)).'">Export to Pdf</a>
	  </div>
	  </div>
';
	

echo $ResultTable;
}
else
{
	echo ' <div class="alert alert-warning">
    <h4>Warning!</h4>
   <h3>Your Search Range exceed 1000 rows please narrow your search range!</h3>.
    </div>';
}
echo '</div>';

}
?>

