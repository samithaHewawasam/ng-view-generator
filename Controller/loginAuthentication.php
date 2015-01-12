<?php
error_reporting(0);
// begin the session
session_start();


$user = null;
$pass = null;
include("../Modal/dbLayer.php");

if(isset($_POST["userNameSpecial"])){$user = $_POST["userNameSpecial"];}
if(isset($_POST["passWordSpecial"])){$pass = md5($_POST["passWordSpecial"]);}


$sql = "SELECT * FROM `system_users` WHERE `Sys_U_Username` =? AND `Sys_U_Password` =? AND `Sys_U_Level` != 'Front_Office'";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($user,$pass));
$count = $stmt->rowCount();

if ($count){

echo $count;


}

?>
