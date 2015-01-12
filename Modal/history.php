<?php
session_start();
header("Content-type: application/json");
include("../Modal/dbLayer.php");
$Operator  = $_SESSION['Sys_U_Name'];
$getHistoryLog = $helper->getHistoryLog();

$getNewRegPercentage = $helper->getHistoryLog();

echo json_encode($getNewRegPercentage);
?>     
        	
