<?php
session_start();
include("Modal/dbLayer.php");
$log = $_SESSION["user"]."successfully logged out From the system in ".$_SESSION['branchCode']." @ ".getDateNow();
$action = 'User Logged Out';
$comment ='';
$date = getDateOnly();
$helper->putHistoryLog($log, $date, $_SESSION["user"], $_SESSION['branchCode'], $action, $comment);
unset($_SESSION['user']);
header('Location: index.php');
?>
