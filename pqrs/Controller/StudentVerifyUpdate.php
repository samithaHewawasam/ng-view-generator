<?php session_start();
 include '../../Modal/config.php';
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);

if(!empty($_POST['NIC'])){
$NICArray=$_POST['NIC'];
$NIC=implode("','",array_flip($NICArray));
$DBbranch=strtolower($_POST['DBcode']);
$Branch=strtoupper(str_replace('-','/',$_POST['DBcode']));
$value="Verified";
}
elseif(!empty($_POST['pk'])){
$pk=base64_decode(substr($_POST['pk'],30));
$value=trim($_POST['value']);
$Array=explode('+++',$pk);
$Table=$Array[0];
$TableCol=$Array[1];
$TablePKCol=$Array[2];
$TablePK=$Array[3];
$Branch=strtoupper(str_replace('-','/',$Array[5]));
$DBbranch=strtolower($Array[5]);
$NIC=$Array[6];
$NICArray[$NIC]=$Array[4];
}

$sqls="SELECT `SM_ID`,`SM_Title`,`SM_First_Name`,`SM_Last_Name`,`SM_Gender`,`SM_Date_of_Birth` FROM `esoftcar_".$DBbranch."`.`student_master` WHERE  `SM_ID` IN ('".$NIC."')";
 $STH=$esoftConfig->prepare($sqls);
 $STH->execute();
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
 if($result){
 
 
 		foreach($result as $row)
			{

 $SM_ID=$row['SM_ID'];
 $SM_Title=$row['SM_Title'];
 $SM_First_Name=$row['SM_First_Name'];
 $SM_Last_Name=$row['SM_Last_Name'];
 $SM_Gender=$row['SM_Gender'];
 $SM_Date_of_Birth=$row['SM_Date_of_Birth'];
if(empty($SM_Title) && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>'Title is empty of student ID '.$SM_ID.' ');
}
elseif(empty($SM_First_Name) && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>'First Name is empty of student ID '.$SM_ID.' ');
}
elseif(strlen($SM_First_Name)>20  && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>"First Name's length is grater than 20 chars of student ID " .$SM_ID.' ');
}
elseif(empty($SM_Last_Name) && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>'Last Name is empty of student ID '.$SM_ID.' ');
}
elseif(strlen($SM_Last_Name)>30  && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>"Last Name's length is grater than 30 chars of student ID " .$SM_ID.' ');
}
elseif(empty($SM_Gender) && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>'Gender is empty of student ID '.$SM_ID.' ');
}
elseif(empty($SM_Date_of_Birth) && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>'DOB is empty of student ID '.$SM_ID.' ');
}
elseif($SM_Date_of_Birth=='0000-00-00' && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>'DOB can not be 0000-00-00 of student ID '.$SM_ID.' ');
}
elseif(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$SM_Date_of_Birth) && $value=="Verified"){
$Responce[$SM_ID]=array('status'=>'false','Msg'=>"DOB should be in correct format(YYYY-MM-DD) of student ID " .$SM_ID.' ');
}
else
{
$sql="INSERT INTO `esoftcar_centralserver`.`student_verify` (`Branch`, `Reg_No`, `Status`, `Date`, `Operator`) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE `Branch`=?,`Status`=?,`Date`=?,`Operator`=?";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($Branch,$NICArray[$SM_ID],$value,date('Y-m-d'),$_SESSION['Sys_U_Username'],$Branch,$value,date('Y-m-d'),$_SESSION['Sys_U_Username']));

if($stmt->rowCount()){
$Responce[$SM_ID]=array('status'=>'true','Msg'=>"Student Verifycation successfully changed of student ID " .$SM_ID.' ');

}
else{
$Responce[$SM_ID]=array('status'=>'false','Msg'=>"Student Verifycation updatng fail of student ID " .$SM_ID.' ');
}


}
}
}
else
{
$Responce[$NIC]=array('status'=>'false','Msg'=>"No Student Marster record for student ID " .$NIC.' ');
}






 echo json_encode($Responce);



?>