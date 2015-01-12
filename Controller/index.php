<?php
session_start();
error_reporting(0);
$user = null;
$pass = null;

include("Modal/dbLayer.php");

if(isset($_POST["user"])){$user = $_POST["user"];}
if(isset($_POST["pass"])){$pass = md5($_POST["pass"]);}

$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;

$sql = "SELECT * FROM `system_users` WHERE `Sys_U_Username` =? AND `Sys_U_Password` =?";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($_SESSION['user'],$_SESSION['pass']));
$authentication  = $stmt->fetchALL(PDO::FETCH_ASSOC);
$_SESSION['branchCode'] = $authentication[0]["Sys_U_Branch"];
$_SESSION['Sys_U_Name'] = $authentication[0]["Sys_U_Name"];

if (is_null($_SESSION["user"])){

include_once("login.php"); 

}else{

if($authentication[0]["Sys_U_Username"] == $_SESSION['user'] && $authentication[0]["Sys_U_Password"] == $_SESSION['pass']){



include_once("view/checkUser.php"); 

}else{

echo "Incorrect Login information. Please check your credentials and try again.<br>";
echo "<a href='https://localhost'>Click here to getting redirected to the log in page</a>";
}

}


?>


