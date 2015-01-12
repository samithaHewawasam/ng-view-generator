<?php session_start();
//$_POST['RegNo']='PAN/A-001170';
//$_POST['RegNo']='PAN/A-001190';
//$_POST['RegNo']='PAN/A-001003';
include('../../Modal/config.php');
include('../../Modal/SysSettings.php');
$D=explode('_',DATABASE);
$Bran=strtoupper(substr($D[1],0,3));

function SyncInsert($con,$query,$BindData){
$SyncSql='INSERT INTO `sync_log` (`query`,`data`) VALUES (?,?)';

$sthSync = $con->prepare($SyncSql);
$sthSync->execute(array($query,serialize($BindData)));
return $Syncresult=$sthSync->rowCount();
}

$esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
$Today=date('Y-m-d');

if(!empty($_POST['RegNo']))
{
$TimesAmp=time();
$BindData=null;
$RegNo=trim($_POST['RegNo']);



if(is_numeric($RegNo)){
$RegNo=$Bran.'/A-'.sprintf('%06d', $RegNo);
}
elseif(is_numeric(substr($RegNo,2,1)))
{
$RegNo=$Bran.'/'. $RegNo;

}
else
{
$RegNo= $RegNo;

}
$DataBase='';
$DueDate=0;
$UpToDateDue=0;
$DueGap=0;
$TotalPaid='';
$RG_Final_Fee='';
$TotalDue='';
$Batch='';
$Course='';
$Name='';
$TableOne='<h3>No Data To Display</h3>';
$TableTwo='';
$Status='';
$AttendanceMark=null;

	$SqlSetOne= "SELECT `registrations`.`Default_Batch`,`registrations`.`RG_Status`,`registrations`.`RG_Reg_Type`,`registrations`.`RG_Final_Fee`,`registrations`.`RG_Total_Paid`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name` ,`course_type`.`CT_Course_Code`,`batch_master`.`BM_Status` FROM $DataBase`registrations`
	LEFT JOIN `student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
	LEFT JOIN `course_type` ON `registrations`.`RG_Reg_Type`=`course_type`.`CT_Type_Code` 
	LEFT JOIN `course` ON `course_type`.`CT_Course_Code`=`course`.`C_Code`
	LEFT JOIN `batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code`
	 WHERE `RG_Reg_NO`='$RegNo' ";
		


$SqlSetTwo= "SELECT SUM(`SI_Ins_Amount`-`SI_Paid_Amount`) AS `C`,MIN(`student_installments`.`SI_Due_Date`) AS `D` FROM $DataBase`student_installments`
	 WHERE `SI_REG_NO`='$RegNo' AND `SI_Due_Date`<'$Today' AND (`SI_Ins_Amount`-`SI_Paid_Amount`)>0  GROUP BY `student_installments`.`SI_REG_NO`";

		
		
		$sth = $esoftConfig->prepare($SqlSetOne);
		$sth->execute($BindData);
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		$countone=$sth->rowCount();

		$sth2 = $esoftConfig->prepare($SqlSetTwo);
		$sth2->execute($BindData);
		$results2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
		$counttwo=$sth2->rowCount();
if($counttwo){

$DueDate=$results2[0]['D'];
$DueGap=floor(($TimesAmp-strtotime($results2[0]['D']))/86400);
$UpToDateDue=$results2[0]['C'];
}
if($countone){
$AttendanceMark=true;
$SM_ID=$results[0]['SM_ID'];
$RG_Status=$results[0]['RG_Status'];
$TotalPaid=$results[0]['RG_Total_Paid'];
$RG_Final_Fee=$results[0]['RG_Final_Fee'];
$TotalDue=sprintf('%0.2f',($RG_Final_Fee-$TotalPaid));
$Batch=$results[0]['Default_Batch'];
$Course=$results[0]['CT_Course_Code'];
$Name=$results[0]['SM_Title'].''.$results[0]['SM_First_Name'].' '.$results[0]['SM_Last_Name'];
$BM_Status=$results[0]['BM_Status'];
$RG_Reg_Type=$results[0]['RG_Reg_Type'];
$FirstCode=strtoupper(substr($RG_Reg_Type,0,3));


$SqlSetThree= "SELECT `registrations`.`Default_Batch`,`registrations`.`RG_Reg_Type`,`registrations`.`RG_Final_Fee`,`registrations`.`RG_Total_Paid`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name` FROM $DataBase`registrations`
	INNER JOIN `student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID` AND `registrations`.`RG_Reg_NO` NOT LIKE '$RegNo'
	WHERE `RG_Stu_ID`='$SM_ID'";

		$sth3 = $esoftConfig->prepare($SqlSetThree);
		$sth3->execute($BindData);
		$results3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
		$countThree=$sth3->rowCount();
if($countThree){

$TableTwo.= '<h5>Other Registrations</h5>
<table class="table datatable" >
  <tr class="success" >
    <td>Reg Type</td>
    <td>Default Batch</td>
    <td>Course Fee</td>
    <td>Total Paid</td>
    <td>Total Due</td>
  </tr>';

foreach($results3 as $row){
$SM_ID3=$row['SM_ID'];
$TotalPaid3=$row['RG_Total_Paid'];
$RG_Final_Fee3=$row['RG_Final_Fee'];
$TotalDue3=sprintf('%0.2f',($RG_Final_Fee3-$TotalPaid3));
$Batch3=$row['Default_Batch'];
$Course3=$row['RG_Reg_Type'];
$Name3=$row['SM_Title'].''.$row['SM_First_Name'].' '.$row['SM_Last_Name'];


 $TableTwo.=' <tr>
    <td>'.$Course3.'</td>
    <td>'.$Batch3.'</td>
    <td>'.$RG_Final_Fee3.'</td>
    <td>'.$TotalPaid3.'</td>
    <td>'.$TotalDue3.'</td>
  </tr>';


}
$TableTwo.='</table>';




}
    /*  if($FirstCode!='LMU' &&  $FirstCode!='HND'){
	 $EndMessage= '
	 <div align="center" style="background-color:#CC9999;padding:5px;"><h2> Invalid Registration Card!</h2></div>
	 ';
	 $Status='Blocked';
    $AttendanceMark=false;

       }
      else*/if($RG_Status=='suspend')
	  {
	 $EndMessage= '
	 <div align="center" style="background-color:#000000;padding:5px;color:#FFFFFF"><h3>Your registration has been suspended!</h3><h5> Please contact front office for more information</h5> 
	<button class="btn btn-large btn-danger" type="button" id="DisAllowReg" data-toggle="modal">Disallow Attendance(* btn)</button></div> <div align="center"></div>
	 ';
	 $Status='Blocked';
    $AttendanceMark=false;
	  
	  }
	  elseif($RG_Status=='Inactive')
	  {
	 $EndMessage= '
	 <div align="center" style="background-color:#CC9999;padding:5px;"><h5>Please Activate Your Registration.. ('.$DueGap.' days)</h5><h2> Inactive Registration!</h2> 
	<button class="btn btn-large btn-danger" type="button" id="DisAllowReg" data-toggle="modal">Disallow Attendance(* btn)</button></div> <div align="center"></div>
	 ';
	 $Status='Blocked';
    $AttendanceMark=false;
	  
	  }
	  elseif($BM_Status=='Completed' or $BM_Status=='Inactive')
	  {
	 $EndMessage= '
	 <div align="center" style="background-color:#CC9999;padding:5px;"><h5>Please contact course co-ordinator</h5><h2> '.$BM_Status.' Batch!</h2> 
	<button class="btn btn-large btn-danger" type="button" id="DisAllowReg" data-toggle="modal">Disallow Attendance(* btn)</button></div> <div align="center"></div>
	 ';
	 $Status='Blocked';
    $AttendanceMark=false;
	  
	  }
	  elseif($DueGap>1 and $DueGap<=6 ){
	  	 $EndMessage= '
	  <div align="center" style="background-color:#FF9900;padding:5px;"><h5>Your payment is delayed for <font size="+2">'.$DueGap.'</font> Day(s)</h5><h2>Thank You!</h2></div>
	  ';

	  }
	  elseif($DueGap>6 )
	  {
	 $EndMessage= '
	 <div align="center" style="background-color:#FF0000;padding:5px;"><h5>Your Payment is too delayed (<font size="+2">'.$DueGap.'</font> days)</h5><h2> Blocked!</h2><button class="btn btn-large btn-success" type="button" id="AllowReg" ThisReg="'.$RegNo.'" data-toggle="modal">Allow Attendance(+ btn)</button>
	<button class="btn btn-large btn-danger" type="button" id="DisAllowReg" data-toggle="modal">Dis Allow Attendance(* btn)</button></div> <div align="center"></div>
	 ';
	 $Status='Blocked';
    $AttendanceMark=false;
	  
	  }
	  else
	  {
 $SqlSetFour= "SELECT (`SI_Ins_Amount`-`SI_Paid_Amount`) AS `C`,MIN(`student_installments`.`SI_Due_Date`) AS `D` FROM $DataBase`student_installments` WHERE `SI_REG_NO`='$RegNo'  AND (`SI_Ins_Amount`-`SI_Paid_Amount`)>0  GROUP BY `student_installments`.`SI_REG_NO`";
		$sth4 = $esoftConfig->prepare($SqlSetFour);
		$sth4->execute($BindData);
		$results4 = $sth4->fetchAll(PDO::FETCH_ASSOC);
		$countFour=$sth4->rowCount();
if($countFour){

$NextDueDate=$results4[0]['D'];
$NextDueGap=floor((strtotime($results4[0]['D'])-$TimesAmp)/86400);
$NextUpToDateDue=$results4[0]['C'];

	 $EndMessage= '
	  <div align="center" style="background-color:#00CC00;padding:5px;"><h5> Your Next Payment <font size="+2">'.$NextUpToDateDue.'</font> Rs. on <font size="+2">'.$NextDueDate.'</font> --<font size="+2">'.$NextDueGap.' days</font>-- </h5><h2> Thank You! </h2></div>
	 ';
	  

}
else
{
	 $EndMessage= '
	  <div align="center" style="background-color:#00CC00;padding:5px;">
<h5>You have already completed your payments..</h5><h1>Thank You!</h1></div>
	 ';

}

	  }

//$RegNO=$row['C'];
//var_dump($results);
 $TableOne='<table border="0">
  <tr>
    <td>Reg. NO</td>
    <td>&nbsp;</td>
    <td><font id="RegNO"><strong>'.$RegNo.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Name</td>
    <td>&nbsp;</td>
    <td><font id="Name"><strong>'.$Name.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Course</td>
    <td>&nbsp;</td>
    <td><font id="Course"><strong>'.$Course.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Batch</td>
    <td>&nbsp;</td>
    <td><font id="Batch"><strong>'.$Batch.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Course Fee</td>
    <td>&nbsp;</td>
    <td><font id="TotalPaid"><strong>'.$RG_Final_Fee.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Total Paid</td>
    <td>&nbsp;</td>
    <td><font id="TotalPaid"><strong>'.$TotalPaid.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Total Due</td>
    <td>&nbsp;</td>
    <td><font size="+1" color="#0000FF" ><strong>'.$TotalDue.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Up to Date Due</td>
    <td>&nbsp;</td>
    <td><font size="+1" color="#0000FF" ><strong>'.$UpToDateDue.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Due Date</td>
    <td>&nbsp;</td>
    <td><font size="+1" color="#0000FF" ><strong>'.$DueDate.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Due Gap</td>
    <td>&nbsp;</td>
    <td><font size="+1" color="#0000FF"><strong>'.$DueGap.'</strong></font></td>
    <td>&nbsp;</td>
  </tr>


</table>
 '.$EndMessage.'
';



}


if($AttendanceMark)
{
  $esoftConfig->beginTransaction();
$BindData=array($RegNo,$BranchCode,$Today);
$sql="INSERT IGNORE INTO `student_attendance`( `Reg_No`,`Terminal`, `Date`, `Time`) VALUES (?,?,?,CURTIME())";
	$sth=$esoftConfig->prepare($sql);
	$sth->execute($BindData);
	if($sth->rowCount() && SyncInsert($esoftConfig,$sql,$BindData)){
	$esoftConfig->commit();	
	}else
	{
    $esoftConfig->rollback();
 	};

}



echo json_encode(array('Tableone'=>$TableOne,'TableTwo'=>$TableTwo,'Status'=>$Status));
}

if(!empty($_POST['ReAttendance']))
{
  $esoftConfig->beginTransaction();
$RegNo=$_POST['ReAttendance'];
$BindData=array($RegNo,$BranchCode,$Today);
$sql="INSERT IGNORE INTO `student_attendance`( `Reg_No`,`Terminal`, `Date`, `Time`) VALUES (?,?,?,CURTIME())";
	$sth=$esoftConfig->prepare($sql);
	$sth->execute($BindData);
	if($sth->rowCount() && SyncInsert($esoftConfig,$sql,$BindData)){
	$esoftConfig->commit();	
	}else
	{
    $esoftConfig->rollback();
 	};

}
?>
