<?php session_start();
if(!empty($_SESSION['LoginId'])){
 include '../Modal/config.php';
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
 $stmt=$esoftConfig->prepare("UPDATE `login_tracker` SET `LogoutDateTime`='".date('Y-m-d H:i:s')."' WHERE `LT_ID`='". $_SESSION['LoginId']."' LIMIT 1");
 $stmt->execute();
}
$_SESSION = array();
session_destroy();

header('Location: index.php');

?>

