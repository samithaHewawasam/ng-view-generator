<?php session_start();
if(!empty($_POST['pk'])){
 include '../../Modal/config.php';
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
$pk=base64_decode(substr($_POST['pk'],30));
$value=trim($_POST['value']);
$Array=explode('+++',$pk);
$Table=$Array[0];
$TableCol=$Array[1];
$TablePKCol=$Array[2];
$TablePK=$Array[3];


if(!empty($_POST['name']) && $_POST['name']=='SV_Status'){
$Branch=strtoupper(str_replace('-','/',$Array[5]));

 $sqls="SELECT `SM_Title`,`SM_First_Name`,`SM_Last_Name`,`SM_Gender`,`SM_Date_of_Birth` FROM `esoftcar_".$Array[5]."`.`student_master` WHERE  `SM_ID`='".$Array[6]."' LIMIT 1";
 $STH=$esoftConfig->prepare($sqls);
 $STH->execute();
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
 if($result){
 $SM_Title=$result[0]['SM_Title'];
 $SM_First_Name=$result[0]['SM_First_Name'];
 $SM_Last_Name=$result[0]['SM_Last_Name'];
 $SM_Gender=$result[0]['SM_Gender'];
 $SM_Date_of_Birth=$result[0]['SM_Date_of_Birth'];
if(empty($SM_Title)){
$Responce=array('status'=>'false','Msg'=>'Title is empty of student ID '.$Array[6].' ');
}
elseif(empty($SM_First_Name)){
$Responce=array('status'=>'false','Msg'=>'First Name is empty of student ID '.$Array[6].' ');
}
elseif(strlen($SM_First_Name)>20){
$Responce=array('status'=>'false','Msg'=>"First Name's length is grater than 20 chars of student ID " .$Array[6].' ');
}
elseif(empty($SM_Last_Name)){
$Responce=array('status'=>'false','Msg'=>'Last Name is empty of student ID '.$Array[6].' ');
}
elseif(strlen($SM_Last_Name)>20){
$Responce=array('status'=>'false','Msg'=>"Last Name's length is grater than 20 chars of student ID " .$Array[6].' ');
}
elseif(empty($SM_Gender)){
$Responce=array('status'=>'false','Msg'=>'Gender is empty of student ID '.$Array[6].' ');
}
elseif(empty($SM_Date_of_Birth)){
$Responce=array('status'=>'false','Msg'=>'DOB is empty of student ID '.$Array[6].' ');
}
elseif(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$SM_Date_of_Birth)){
$Responce=array('status'=>'false','Msg'=>"DOB should be in correct format(YYYY-MM-DD) of student ID " .$Array[6].' ');
}
else
{
$sql="INSERT INTO `esoftcar_centralserver`.`student_verify` (`Branch`, `Reg_No`, `Status`, `Date`, `Operator`) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE `Branch`=?,`Status`=?,`Date`=?,`Operator`=?";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($Branch,$Array[4],$value,date('Y-m-d'),$_SESSION['Sys_U_Username'],$Branch,$value,date('Y-m-d'),$_SESSION['Sys_U_Username']));

if($stmt->rowCount()){
$Responce=array('status'=>'true','Msg'=>"Student Verifycation successfully changed of student ID" .$Array[5].' ');

}
else{
$Responce=array('status'=>'false','Msg'=>"Student Verifycation updatng fail of student ID" .$Array[5].' ');
}

 echo json_encode($Responce);

}
}
else
{
$Responce=array('status'=>'false','Msg'=>"No Student Marster record for student ID " .$Array[6].' ');
}






 echo json_encode($Responce);







exit;
}
else
{
if($Table=='system_users'){
$TablePK=$_SESSION['Sys_U_Username'];
}



$sql = "UPDATE `$Table` SET `$TableCol` =?  WHERE `$TablePKCol` =? LIMIT 1";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($value,$TablePK));

}
if($stmt->rowCount()){
$msg= '<font color="#00CC00"  >Your data successfully changed.</font>';

}
else{
$msg= '<font color="#FF0000"  >Your data saving unsuccessfull! somthing worng.</font>';
}
echo $msg;
}
?>