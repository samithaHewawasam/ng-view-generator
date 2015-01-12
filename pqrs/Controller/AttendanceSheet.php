<?php  session_start();
 include("LogController.php");
	$DBprefix='`esoftcar_' ;//use back tic (`)
    $DBsuffix='`' ;
    $Today=time();
	$DataBase = '';
	$BindData = null;

		$t_date="";
		$f_date="";
		$course="";
		$batch="";
		$reg="";
		$fixedArray = array();
if (empty($_POST['BranchCode']) && !empty($_POST['SelectedBranch']) && $_SESSION['bset']==1){
$key=key($_POST['SelectedBranch']);
$_POST['BranchCode']=$_POST['SelectedBranch'][$key].'---'.$_SESSION['Sys_U_Branches'];
}

if(!empty($_POST['BranchCode']))
{
$_POST['SelectedBranch']=array();
$bA=explode('---',$_POST['BranchCode']);

$_POST['SelectedBranch'][$bA[1]]=$bA[0];

$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;
//$DataBase = '';
}
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
$DateTable=" `student_attendance`.`Date` ";
include('SearchPostPart.php');

	
	$SqlMain="SELECT `student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,Reg_No, GROUP_CONCAT(Date) AS dates FROM $DataBase.`student_attendance` 
LEFT JOIN $DataBase.`registrations` ON `student_attendance`.`Reg_No`=$DataBase.`registrations`.`RG_Reg_NO`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=$DataBase.`student_master`.`SM_ID`
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";

$SqlTail=" GROUP BY `student_attendance`.`Reg_No` ORDER BY `student_attendance`.`Date` ";
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 
$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;
		 
		$esoftConfig -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt=$esoftConfig->prepare($SqlSetOne);
		
		$stmt->execute($BindData);
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
		$getDateSet = array();
		$begin = new DateTime( $CC_Start_Date  );
		$end = new DateTime( $CC_End_Date );
		$end = $end->modify( '+1 day' );
		
		$interval = new DateInterval('P1D');
		$daterange = new DatePeriod($begin, $interval ,$end);
		
		foreach($daterange as $date){
		
			$getDateSet[]=$date->format("Y-m-d");
			
		}
		
/*$Table="<table class='table table-hover' align='center'><tr> <th class='reg'>Reg No</th>";
 for($i=0;$i<7;$i++){
$Table.="<th>tttttt</th>";
 }
  $Table.='</tr>';  */		

		$ExelArray[0]=array('Student Name'=>'Student Name','Register No.'=>'Register No.')+$getDateSet;
		
$i=1;
				foreach($results as $value){
				
	 $StuName=$value['SM_Title'].$value['SM_First_Name'].$value['SM_Last_Name'];	
	$RegArray=explode(',',$value['dates']);
	$emptyDateSet=array_fill_keys($getDateSet,'');
	
		//////////////////////////////////////////////////////////////////////////////////
/*	$N=1;
			$Table.='<tr><td>'.$value['Reg_No'].'</td>';

	foreach($getDateSet as $Datea){
					if(in_array($Datea,$RegArray)){
     $img="<center style='background-color:#A9D0F5'><span>".$Datea."</span><span><br><img src='Library/img/chk.png'/></span></center>";
 				}else{
	$img="<center style='background-color:#E0ECF8'><span>".$Datea."</span><span><br><img src='Library/img/blank.png'/></span></center>";
				};
				

		if ($N % 7 == 0){

		$Table.='<td  class="date">'.$img.'</td></tr><tr> <td></td>';
		}
		else
		{
		$Table.='<td  class="date">'.$img.'</td>';
		}
		
		$N=$N+1;
		
	}
	
				$Table.='</tr>'; */

	/////////////////////////////////////////////////////////////////////////////////

	foreach($RegArray as $AttendDate){
	if(array_key_exists($AttendDate,$emptyDateSet)){
	$emptyDateSet[$AttendDate]='1';
	}
	else
	{
	$emptyDateSet[$AttendDate]='0';
	}
	}
		
		$ExelArray[$i++]=array($StuName,$value['Reg_No'])+$emptyDateSet;
		
		$fixedArray[]=array('REG' => $value['Reg_No'], 'DATE' => $RegArray );
		}
		
 // $Table.=' </tr></table>';		
		
	//echo $Table;	
	//var_dump($ExelArray);
	
$arrayforexel=$ExelArray;		
$myReport = "temp/StuAttendanceSheet".time().".xlsx";
require_once '../Library/php/E/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();
$objWorksheet->getStyle('C1:T1')->getAlignment()->setTextRotation(90);

$objWorksheet->fromArray($arrayforexel);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save($myReport);


		echo json_encode( array('reportlink'=>'Controller/'.$myReport,'form_date' => $getDateSet, 'fixed_arrays' => $fixedArray));

		
?>
