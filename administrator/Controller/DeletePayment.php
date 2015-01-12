<?php session_start();
include("../../Modal/dbLayer.php");
include("../Modal/arrays.php");
$SM_Branch_Code = $_SESSION['branchCode'];
$SM_Operator  = $_SESSION['Sys_U_Name'];
$Today=date('Y-m-d');
if(!empty($_POST['DeletePaymentCheck'])){
$PaymentID=trim($_POST['PaymentID']);
$IDArray=explode('-',$PaymentID);
if(strlen($IDArray[0])==5){
$PayT=true;
echo '<font size="2" color="#3333FF">Course Payment</font>';
$str='SELECT `payments_master`.*,`student_master`.SM_ID,`student_master`.SM_Title,`student_master`.SM_Initials,`student_master`.SM_Last_Name,`student_master`.SM_Tell_Mobile FROM `payments_master` LEFT JOIN `registrations` ON `registrations`.RG_Reg_NO=`payments_master`.RG_Reg_No LEFT JOIN `student_master` ON  `student_master`.SM_ID=`registrations`.RG_Stu_ID  WHERE `payments_master`.PM_Receipt_No=?';

}
else
{
$PayT=false;
echo '<font size="2" color="#999933">Other Payment</font>';
$str='SELECT 
`other_payments`.`RG_Reg_No` ,
`other_payments`.`OP_Receipt_No` AS `PM_Receipt_No`,
`other_payments`.`OP_Date`  AS `PM_Date`,
`other_payments`.`OP_Amount` AS `PM_Amount`,
`other_payments`.`Comment`  AS `excessPayment`,
`other_payments`.`Currency`,
`other_payments`.`OP_Type` AS `PM_Type`,
`other_payments`.`Currency_rate`,
`student_master`.SM_ID,`student_master`.SM_Title,`student_master`.SM_Initials,`student_master`.SM_Last_Name,`student_master`.SM_Tell_Mobile FROM `other_payments` LEFT JOIN `registrations` ON `registrations`.RG_Reg_NO=`other_payments`.RG_Reg_No LEFT JOIN `student_master` ON  `student_master`.SM_ID=`registrations`.RG_Stu_ID  WHERE `other_payments`.OP_Receipt_No=?';


}$sth = $esoftConfig->prepare($str);
$sth->execute(array($_POST['PaymentID']));
if($sth->rowCount()){
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $row){
$RG_Reg_NO=$row['RG_Reg_No'];
$SM_ID=$row['SM_ID'];
$SM_Full_Name=$row['SM_Title'].' '.$row['SM_Initials'].' '.$row['SM_Last_Name'];
$SM_Tell_Mobile=$row['SM_Tell_Mobile'];
$PM_Receipt_No=$row['PM_Receipt_No'];
$PM_Date=$row['PM_Date'];
$PM_Amount=$row['PM_Amount'];
$excessPayment=$row['excessPayment'];
$Currency=$row['Currency'];
$PM_Type=$row['PM_Type'];
$Currency_rate=$row['Currency_rate'];
		
echo '   
<input type="hidden" id="Currency_rate" value="'.$Currency_rate.'" />

<address>
  <strong>Reg. No</strong>
 <strong> <font color="#6699FF" id="RegNoDel">'.$RG_Reg_NO.'</font></strong>
</address>

<address>
  <strong>ID Number</strong>
 <strong> <font color="#6699FF">'.$SM_ID.'</font></strong>
</address>

<address>
  <strong>Full Name</strong>
  <strong><font color="#6699FF" >'.$SM_Full_Name.'</font></strong>
</address>

<address>
  <strong>Mobile</strong>
 <strong> <font color="#6699FF">'.$SM_Tell_Mobile.'</font></strong>
</address>
<address>
  <strong>Receipt No</strong>
 <strong> <font color="#6699FF" id="PM_Receipt_No">'.$PM_Receipt_No.'</font></strong>
</address>

<address>
  <strong>Payment Date</strong>
 <strong> <font color="#6699FF" id="RegNo4">'.$PM_Date.'</font></strong>
</address>

<address>
  <strong>Payment Amount</strong>
 <strong> <font color="#6699FF" id="PM_Amount">'.$PM_Amount.'</font> <font color="#6699FF">'.$Currency.'</font></strong>
</address>';

if($PayT){
echo '<address>
  <strong>Excess Amount</strong>
 <strong> <font color="#6699FF" id="excessPayment">'.$excessPayment.'</font> <font color="#6699FF" >'.$Currency.'</font></strong>
</address>';
}
else
{
echo '<address>
  <strong>Comment</strong>
 <strong> <font color="#6699FF" >'.$excessPayment.'</font></strong>
</address>';
}
echo '<address>
  <strong>Payment Method</strong>
 <strong> <font color="#6699FF" id="RegNo4">'.$PM_Type.'</font></strong>
</address>

 <button id="DeletePaymentPermanent" class="btn btn-medium btn-danger" type="button">  Delete Payment
    </button>
';	
		
		}

}
else
{
 echo '<h4>Can\'t Find Payment</h4>';
 
 
 }

}
if(!empty($_POST['DeletePayment'])){

echo '';
$RegNo=$_POST['RegNo'];
$PM_Amount=$_POST['PM_Amount'];
$excessPayment=$_POST['excessPayment'];

$Currency_rate=$_POST['Currency_rate'];
$PM_Receipt_No=$_POST['PM_Receipt_No'];
$PM_Amount_For_Ins=$Currency_rate*($PM_Amount-$excessPayment);
//var_dump($RegNo);
/////////////////////////////////////
//initial payments student install ment updated
$esoftConfig->beginTransaction();
$IDArray=explode('-',$PM_Receipt_No);
if(strlen($IDArray[0])==5){

if($PM_Amount_For_Ins>0){

$sqlSI="SELECT SI_Ins_NO,SI_Ins_Amount,SI_Paid_Amount FROM student_installments WHERE SI_Reg_No=? AND SI_Paid_Amount !='0' ORDER BY `SI_Ins_NO` DESC ";
$sth = $esoftConfig->prepare($sqlSI);
$sth->execute(array($RegNo));
$result_SI = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result_SI as $row){
$SI_Ins_NO=$row['SI_Ins_NO'];
//$SI_ID=$row['SI_ID'];
$SI_Ins_Amount=$row['SI_Ins_Amount'];
$SI_Paid_Amount=$row['SI_Paid_Amount'];

if($SI_Paid_Amount >= $PM_Amount_For_Ins){
$balance=$SI_Paid_Amount-$PM_Amount_For_Ins;
$SI_Update[$SI_Ins_NO]=$balance;
//echo $SI_Ins_NO.$balance;
break;
}
if($SI_Paid_Amount < $PM_Amount_For_Ins){
$balance=$SI_Paid_Amount-$PM_Amount_For_Ins;
$PM_Amount_For_Ins=abs($balance);
$SI_Update[$SI_Ins_NO]=0;
}
}
$updateRegistration=0;
$updatestudentIns=0;
$DeletePM=0;
//var_dump($SI_Update);exit;

if(!empty($SI_Update) and count($SI_Update)>0){
foreach($SI_Update as $SI_Ins_NO => $value){

$UpdateSql="UPDATE student_installments SET SI_Paid_Amount=? WHERE `SI_Ins_NO`=? AND `SI_Reg_No`=?";
$sthUpdate = $esoftConfig->prepare($UpdateSql);
$insData=array($value,$SI_Ins_NO,$RegNo);
$sthUpdate->execute($insData);
$Updateresult=$sthUpdate->rowCount();

$log = "Update has been affceted to the user $RegNo around Rs: $value  by the $SM_Operator in $SM_Branch_Code @ ".$Today;
$action = 'Payment delete on behalf of Installment Update';
$comment ='';
$histroyLogArray=array($log, $Today, $SM_Operator, $SM_Branch_Code, $action, $comment);
if($Updateresult && SyncInsert($esoftConfig,$UpdateSql,$insData) && HistoryLogInsert($esoftConfig,$histroyLogArray)){

	$updatestudentIns=1;

}else{
    $esoftConfig->rollback();
	echo '<h4> Student Installment Updating Fail</h4>';
	exit;
	}

}

}
else
{
$updatestudentIns=1;
}
}
else
{
$updatestudentIns=1;
}
	
//Update Registration RG_Total_Paid Column
if($updatestudentIns )
{ 
if($_POST['PM_Amount']>0){
$TotalPaid=$helper->getLastTotalPaid($RegNo);

$PM_Amount =$TotalPaid[0]-($_POST['PM_Amount']*$Currency_rate);
$UpdateRegistrationStr='UPDATE `registrations` SET RG_Total_Paid=? WHERE RG_Reg_NO=?';
$sth = $esoftConfig->prepare($UpdateRegistrationStr);
$RegData=array($PM_Amount,$RegNo);
$sth->execute($RegData);
$c=$sth->rowCount();
//history log 
$log = "$RegNo\'s total paid updated by the $SM_Operator in $SM_Branch_Code @ ".$Today;
$action = 'Payment delete on behalf of Total Paid Update';
$comment ='';
$histroyLogArray=array($log, $Today, $SM_Operator, $SM_Branch_Code, $action, $comment);
//Sync Query

if($c  && SyncInsert($esoftConfig,$UpdateRegistrationStr,$RegData) && HistoryLogInsert($esoftConfig,$histroyLogArray)){

$updateRegistration=1;
}
else
{
    $esoftConfig->rollback();
	echo '<h4> Student Registration Updating Fail</h4>';
	exit;
}
}
else
{
$updateRegistration=1;
}
}
if($updateRegistration){

$DeleteRecordFromPMStr='DELETE FROM `payments_master` WHERE PM_Receipt_No=? LIMIT 1' ;
$sth = $esoftConfig->prepare($DeleteRecordFromPMStr);
$dataPM=array($PM_Receipt_No);
$sth->execute($dataPM);
$count=$sth->rowCount();
//history log 
$log = "$PM_Receipt_No\'s has been deleted by the $SM_Operator in $SM_Branch_Code @ ".$Today;
$action = 'Payment delete';
//Sync Query
$comment ='';
$histroyLogArray=array($log, $Today, $SM_Operator, $SM_Branch_Code, $action, $comment);

if($count && SyncInsert($esoftConfig,$DeleteRecordFromPMStr,$dataPM) && HistoryLogInsert($esoftConfig,$histroyLogArray)){

$esoftConfig->commit();
echo '<h4> Payment Deleted Successfully !</h4>';

}
else
{
$esoftConfig->rollback();
echo '<h4> Payment Master Deleting Fail</h4>';
exit;
}

}

//initial payments student install ment updated END

}
else
{

$DeleteRecordFromPMStr='DELETE FROM `other_payments` WHERE OP_Receipt_No=? LIMIT 1' ;
$sth = $esoftConfig->prepare($DeleteRecordFromPMStr);
$dataPM=array($PM_Receipt_No);
$sth->execute($dataPM);
$count=$sth->rowCount();
//history log 
$log = "$PM_Receipt_No\'s has been deleted by the $SM_Operator in $SM_Branch_Code @ ".$Today;
$action = 'Payment delete';
//Sync Query
$comment ='';
$histroyLogArray=array($log, $Today, $SM_Operator, $SM_Branch_Code, $action, $comment);
if($count && SyncInsert($esoftConfig,$DeleteRecordFromPMStr,$dataPM) && HistoryLogInsert($esoftConfig,$histroyLogArray)){

$esoftConfig->commit();
echo '<h4>Other Payment Deleted Successfully !</h4>';

}
else
{
$esoftConfig->rollback();
echo '<h4>Other Payment Master Deleting Fail</h4>';
exit;
}
}



}
?>
