<?php session_start();
$SM_Branch_Code = $_SESSION['branchCode'];
$SM_Operator  = $_SESSION['Sys_U_Name'];
$Today=date('Y-m-d');
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
include("../Modal/arrays.php");
if(!empty($_POST['DeleteRegistrationCheck'])){
$str='SELECT `registrations`.RG_Reg_NO,`registrations`.RG_Stu_ID,`student_master`.SM_Title,`student_master`.SM_Initials,`student_master`.SM_Last_Name,`student_master`.SM_Tell_Mobile FROM `registrations` LEFT JOIN `student_master` ON `student_master`.SM_ID=`registrations`.RG_Stu_ID WHERE `registrations`.RG_Reg_NO=?';
$sth = $esoftConfig->prepare($str);
$sth->execute(array($_POST['RegID']));
if($sth->rowCount()){
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $row){
$RG_Reg_NO=$row['RG_Reg_NO'];
$RG_Stu_ID=$row['RG_Stu_ID'];
$SM_Full_Name=$row['SM_Title'].' '.$row['SM_Initials'].' '.$row['SM_Last_Name'];
$SM_Tell_Mobile=$row['SM_Tell_Mobile'];
		
echo '  <address>
  <strong>Reg. No</strong><br>
 <strong> <font color="#6699FF" id="RegNo">'.$RG_Reg_NO.'</font></strong>
</address>

<address>
  <strong>ID Number</strong><br>
 <strong> <font color="#6699FF" id="RegNo2">'.$RG_Stu_ID.'</font></strong>
</address>

<address>
  <strong>Full Name</strong><br>
  <strong><font color="#6699FF" id="RegNo3">'.$SM_Full_Name.'</font></strong>
</address>

<address>
  <strong>Mobile No</strong><br>
 <strong> <font color="#6699FF" id="RegNo4">'.$SM_Tell_Mobile.'</font></strong>
</address>
 <button id="DeleteRegPermanent" class="btn btn-medium btn-danger" type="button">  Delete Registration
    </button>
';	
		
		}

}
else
{
 echo '<h4>Can\'t Find Registration</h4>';
 
 
 }

}
if(!empty($_POST['DeleteReg'])){
$esoftConfig->beginTransaction();

$DeleteReg=$_POST['DeleteReg'];
$RegNo=$_POST['RegNo'];

$str='DELETE FROM `registrations` WHERE `registrations`.RG_Reg_NO=?';
$sth = $esoftConfig->prepare($str);
$data=array($RegNo);
$sth->execute($data);
$c=$sth->rowCount();


//history log 
$log = "$RegNo has been deleted by the $SM_Operator in $SM_Branch_Code @ ".$Today;
$action = 'Delete Registration';
$comment ='';
$histroyLogArray=array($log, $Today, $SM_Operator, $SM_Branch_Code, $action, $comment);
//Sync Query


if($c && SyncInsert($esoftConfig,$str,$data) && HistoryLogInsert($esoftConfig,$histroyLogArray)){

$esoftConfig->commit();

 echo '<h4> Registration Deleted Successfuly</h4><p> Number of Affected Rows   '.$c.'</p>';
}
else
{
echo '<h4> Registration Deleting Fail</h4>';
   $esoftConfig->rollback();
exit;
}
}
?>
