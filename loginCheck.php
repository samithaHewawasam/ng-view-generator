<?php
// loginCheck.php

session_start(); // Start a new session
include("Modal/dbLayer.php"); // Holds all of our database connection information

// Get the data passed from the form
$username = $_POST['user'];
$password = $_POST['pass'];

// Do some basic sanitizing
$username = stripslashes($username);
$password = stripslashes($password);

$sql = "SELECT * FROM `system_users` WHERE `Sys_U_Username` =? AND `Sys_U_Password` =?";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($username,md5($password)));
$authentication  = $stmt->fetchALL(PDO::FETCH_ASSOC);
$_SESSION['branchCode'] = $authentication[0]["Sys_U_Branch"];
$_SESSION['Sys_U_Name'] = $authentication[0]["Sys_U_Name"];
$_SESSION['Sys_U_AccessLevel']=$authentication[0]["Sys_U_AccessLevel"];
$count = $stmt->rowCount();

if ($count == 1) {
	 $_SESSION['loggedIn'] = "true";
	 header("Location: /"); // This is wherever you want to redirect the user to
	//history log 

	$log = $_SESSION['Sys_U_Name']." has been logged successfully in ".$_SESSION['branchCode']. " @ ".getDateNow();
	$action = 'User logged';
	$comment ='';
	$date = getDateOnly();
	$helper->putHistoryLog($log, $date, $_SESSION['Sys_U_Name'], $_SESSION['branchCode'], $action, $comment);

} else {
	 $_SESSION['loggedIn'] = "false";
	 header("Location: login.php"); // Wherever you want the user to go when they fail the login
}

?>


