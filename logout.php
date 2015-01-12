<?php
session_start();
include("Modal/dbLayer.php"); // Holds all of our database connection information
	//history log 

	$log = $_SESSION['Sys_U_Name']." has been logged out successfully in ".$_SESSION['branchCode']. " @ ".getDateNow();
	$action = 'User logged out';
	$comment ='';
	$date = getDateOnly();
	$helper->putHistoryLog($log, $date, $_SESSION['Sys_U_Name'], $_SESSION['branchCode'], $action, $comment);

session_destroy();
unset($_SESSION['Sys_U_Name']);
header("location:login.php");
#this comment making using an android teamviewer 
?>
