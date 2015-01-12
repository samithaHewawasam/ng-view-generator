<?php 
session_start();
error_reporting(0);
$branch="";
$branch = $_SESSION['branchCode'];
include("../Modal/dbLayer.php");
$getLastRegId =$helper->getLastRegId($branch);
$getId = explode("-", $getLastRegId[0]);
$newReg = $getId[1] + 1;
$formattedRG_ID = sprintf('%06d', $newReg);
echo $formattedRG_ID;
?>
