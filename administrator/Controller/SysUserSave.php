<?php session_start();
//error_reporting(E_ALL);
///var_dump($_POST);exit;
if(!empty($_POST['NewSysUserCheck'])){

$SM_Branch_Code = $_SESSION['branchCode'];
$SM_Operator  = $_SESSION['Sys_U_Name'];
$Today=date('Y-m-d');
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
include("../Modal/arrays.php");
//include("../../library/php/password.php");
$Sys_U_Branch="";
$Sys_U_Name="";
$Sys_U_Designaion="";
$Sys_U_mail="";
$Sys_U_Username="";
$Sys_U_Password="";
$Sys_U_Level="";
$Sys_U_AccessLevel="";
$Sys_U_JoinedDate="";


if(!empty($_POST['Sys_U_Branch'])){$Sys_U_Branch = $_POST['Sys_U_Branch'];}
if(!empty($_POST['Sys_U_Name'])){$Sys_U_Name = $_POST['Sys_U_Name'];}
if(!empty($_POST['Sys_U_Designaion'])){$Sys_U_Designaion = $_POST['Sys_U_Designaion'];}
if(!empty($_POST['Sys_U_mail'])){$Sys_U_mail = $_POST['Sys_U_mail'];}
if(!empty($_POST['Sys_U_Username'])){$Sys_U_Username = $_POST['Sys_U_Username'];}
//if(!empty($_POST['Sys_U_Password'])){$Sys_U_Password = password_hash($_POST['Sys_U_Password'], PASSWORD_BCRYPT);}
if(!empty($_POST['Sys_U_Password'])){$Sys_U_Password = md5($_POST['Sys_U_Password']);}
if(!empty($_POST['Sys_U_Level'])){$Sys_U_Level = $_POST['Sys_U_Level'];}
if(!empty($_POST['Sys_U_AccessLevel'])){$Sys_U_AccessLevel = @implode(',',$_POST['Sys_U_AccessLevel']);}
if(!empty($_POST['Sys_U_JoinedDate'])){$Sys_U_JoinedDate = $_POST['Sys_U_JoinedDate'];}



//Normal core php

$str="INSERT INTO system_users (Sys_U_Branch,Sys_U_Name,Sys_U_Designaion,Sys_U_mail,Sys_U_Username,Sys_U_Password,Sys_U_Level,Sys_U_AccessLevel,Sys_U_JoinedDate) VALUES (?,?,?,?,?,?,?,?,?)";
$data=array($Sys_U_Branch,$Sys_U_Name,$Sys_U_Designaion,$Sys_U_mail,$Sys_U_Username,$Sys_U_Password,$Sys_U_Level,$Sys_U_AccessLevel,$Sys_U_JoinedDate);
//history log 
$log = "New System User $Sys_U_Username has been Created by the $SM_Operator in $SM_Branch_Code @ ".$Today;
$action = 'New System User';
$comment ='';
$histroyLogArray=array($log, $Today, $SM_Operator, $SM_Branch_Code, $action, $comment);
//Sync Query
$query="INSERT INTO system_users (Sys_U_Branch,Sys_U_Name,Sys_U_Designaion,Sys_U_mail,Sys_U_Username,Sys_U_Password,Sys_U_Level,Sys_U_AccessLevel,Sys_U_JoinedDate) VALUES ('$Sys_U_Branch','$Sys_U_Name','$Sys_U_Designaion','$Sys_U_mail','$Sys_U_Username','$Sys_U_Password','$Sys_U_Level','$Sys_U_AccessLevel','$Sys_U_JoinedDate')";
$esoftConfig->beginTransaction();
$STH=$esoftConfig->prepare($str);

if($STH->execute($data) && SyncInsert($esoftConfig,$str,$data) && HistoryLogInsert($esoftConfig,$histroyLogArray)){
$esoftConfig->commit();
echo '<h3>New User Registered Successfully</h3>';
}
else
{
$esoftConfig->rollback();
echo '<h3>New User Registration Fail</h3>';
}

// this is your class

/*
class dbLayer
{

//connection from here 
    private $done;
    function __construct(PDO $connection)
    {
        $this->done = $connection;
    }

////////////////////////////////////////////
//insert_new_user from here 
 public function insert_new_user($table,$Sys_U_Branch,$Sys_U_Name,$Sys_U_Designaion,$Sys_U_mail,$Sys_U_Username,$Sys_U_Password,$Sys_U_Level,$Sys_U_AccessLevel,$Sys_U_JoinedDate)
{
$sql = $this->done->prepare("INSERT INTO " . $table . "(Sys_U_Branch,Sys_U_Name,Sys_U_Designaion,Sys_U_mail,Sys_U_Username,Sys_U_Password,Sys_U_Level,Sys_U_AccessLevel,Sys_U_JoinedDate) VALUES (?,?,?,?,?,?,?,?,?)");

$Qresult=$sql->execute(array($Sys_U_Branch,$Sys_U_Name,$Sys_U_Designaion,$Sys_U_mail,$Sys_U_Username,$Sys_U_Password,$Sys_U_Level,$Sys_U_AccessLevel,$Sys_U_JoinedDate));
return $Qresult;
} 
////////////////////////////////////////////
}
//end class


$esoftConfig = new PDO('mysql:host=localhost;dbname=' . 'esoftcar_col-a', 'root', '', array(PDO::ATTR_PERSISTENT => true));


$helper  = new dbLayer($esoftConfig);
$result=$helper->insert_new_user("system_users", $Sys_U_Branch,$Sys_U_Name,$Sys_U_Designaion,$Sys_U_mail,$Sys_U_Username,$Sys_U_Password,$Sys_U_Level,$Sys_U_AccessLevel,$Sys_U_JoinedDate);

*/



}
 ?>