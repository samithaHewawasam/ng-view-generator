<?php session_start();
//include("../Modal/dbLayer.php");
//var_dump($_POST);
include("../Modal/dbLayer.php");


if(!empty($_POST['DeletePaymentCheck'])){
$str='SELECT `payments_master`.*,`student_master`.SM_ID,`student_master`.SM_Full_Name,`student_master`.SM_Tell_Mobile FROM `payments_master` INNER JOIN `registrations` ON `registrations`.RG_Reg_NO=`payments_master`.RG_Reg_No INNER JOIN `student_master` ON  `student_master`.SM_ID=`registrations`.RG_Stu_ID  WHERE `payments_master`.PM_Receipt_No=?';
$sth = $esoftConfig->prepare($str);
$sth->execute(array($_POST['PaymentID']));
if($sth->rowCount()){
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $row){
$RG_Reg_NO=$row['RG_Reg_No'];
$SM_ID=$row['SM_ID'];
$SM_Full_Name=$row['SM_Full_Name'];
$SM_Tell_Mobile=$row['SM_Tell_Mobile'];
$PM_Receipt_No=$row['PM_Receipt_No'];
$PM_Date=$row['PM_Date'];
$PM_Amount=$row['PM_Amount'];
$PM_Type=$row['PM_Type'];
		
echo '    <div id="DeletePaymentResponse" ><address>
  <strong>Reg. No</strong>
 <strong> <font color="#6699FF" id="RegNo">'.$RG_Reg_NO.'</font></strong>
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
 <strong> <font color="#6699FF" id="PM_Amount">'.$PM_Amount.'</font></strong>
</address>

<address>
  <strong>Payment Method</strong>
 <strong> <font color="#6699FF" id="RegNo4">'.$PM_Type.'</font></strong>
</address>

 <button id="DeletePaymentPermanent" class="btn btn-medium btn-danger" type="button">  Delete Payment
    </button>
</div>';	
		
		}

}
else
{
 echo '<div id="DeletePaymentResponse" ><h4>Can\'t Find Payment</h4></div>';
 
 
 }

}
if(!empty($_POST['DeletePayment'])){

echo '<div id="DeletePaymentResponse" >';
$RegNo=$_POST['RegNo'];
$PM_Amount=$_POST['PM_Amount'];
$PM_Receipt_No=$_POST['PM_Receipt_No'];
/////////////////////////////////////
//initial payments student install ment updated
if($PM_Amount>0){
$sqlSI="SELECT SI_ID,SI_Ins_NO,SI_Ins_Amount,SI_Paid_Amount FROM student_installments WHERE SI_Reg_No=? AND SI_Paid_Amount !='0' ORDER BY `SI_Ins_NO` DESC ";
$sth = $esoftConfig->prepare($sqlSI);
$sth->execute(array($RegNo));
$result_SI = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result_SI as $row){
$SI_Ins_NO=$row['SI_Ins_NO'];
$SI_ID=$row['SI_ID'];
$SI_Ins_Amount=$row['SI_Ins_Amount'];
$SI_Paid_Amount=$row['SI_Paid_Amount'];

if($SI_Paid_Amount>$PM_Amount){
$balance=$SI_Paid_Amount-$PM_Amount;
$SI_Update[$SI_ID]=$balance;
//echo $SI_Ins_NO.$balance;
break;
}
if($SI_Paid_Amount<=$PM_Amount){
$balance=$SI_Paid_Amount-$PM_Amount;
$PM_Amount=abs($balance);
$SI_Update[$SI_ID]=0;
}
}

if(count($SI_Update)>0){
foreach($SI_Update as $key => $value){

$UpdateSql="UPDATE student_installments SET SI_Paid_Amount=? WHERE SI_ID=?";
$sthUpdate = $esoftConfig->prepare($UpdateSql);
$sthUpdate->execute(array($value,$key));
$Updateresult=$sthUpdate->rowCount();
//Sync Query
$sql="UPDATE student_installments SET SI_Paid_Amount='$value' WHERE SI_ID='$key'";
$helper->getLog("sync_log", $sql);

}	
//Update Registration RG_Total_Paid Column
if($Updateresult==0)
{ echo '<h4>'.$result.' Student Installment Updating Fail</h4>';
}
else
{
$PM_Amount =$_POST['PM_Amount'];
$UpdateRegistrationStr='UPDATE `registrations` SET RG_Total_Paid=(RG_Total_Paid - ?) WHERE RG_Reg_NO=?';
$sth = $esoftConfig->prepare($UpdateRegistrationStr);
$sth->execute(array($PM_Amount,$RegNo));
$c=$sth->rowCount();


if($c){
$sql="UPDATE `registrations` SET RG_Total_Paid=(RG_Total_Paid - '$PM_Amount') WHERE RG_Reg_NO='$PM_Amount'";
$helper->getLog("sync_log", $sql);

$DeleteRecordFromPMStr='DELETE FROM `payments_master` WHERE PM_Receipt_No=? LIMIT 1' ;
$sth = $esoftConfig->prepare($DeleteRecordFromPMStr);
$sth->execute(array($PM_Receipt_No));
$count=$sth->rowCount();
if($count){
//Sync Query
$sql="DELETE FROM `payments_master` WHERE PM_Receipt_No='$PM_Receipt_No' LIMIT 1";
$helper->getLog("sync_log", $sql);

 echo '<h4> Payment Deleted Successfuly</h4>';
}
else
{
echo '<h4> Payment Master Deleting Fail</h4>';
}

}
else
{
echo '<h4> Registration Total Paid Update Fail</h4>';
}

//Update Registration RG_Total_Paid Column End
}

}
}
//initial payments student install ment updated END

echo '</div>';
}

?>
