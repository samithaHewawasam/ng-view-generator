<?php
error_reporting(0);
// begin the session
$SI_Reg_No =""; 
$SI_Ins_NO =""; 
$SI_Ins_Amount =""; 
$SI_Due_Date =""; 
$SI_Paid_Amount =""; 
$SI_Paid_Date ="";

if(isset($_GET['SI_Reg_No'])){$SI_Reg_No = $_GET['SI_Reg_No'];}
if(isset($_GET['SI_Ins_NO'])){$SI_Ins_NO = $_GET['SI_Ins_NO'];}
if(isset($_GET['SI_Ins_Amount'])){$SI_Ins_Amount = $_GET['SI_Ins_Amount'];}
if(isset($_GET['SI_Due_Date'])){$SI_Due_Date = $_GET['SI_Due_Date'];}
if(isset($_GET['SI_Paid_Amount'])){$SI_Paid_Amount = $_GET['SI_Paid_Amount'];}
if(isset($_GET['SI_Paid_Date'])){$SI_Paid_Date = $_GET['SI_Paid_Date'];}
include("../Modal/dbLayer.php");

$helper->studentInstallments($SI_Reg_No, $SI_Ins_NO, $SI_Ins_Amount, $SI_Due_Date, $SI_Paid_Amount, $SI_Paid_Date);

$sql="REPLACE INTO `student_installments` (`SI_Reg_No`,`SI_Ins_NO`,`SI_Ins_Amount`,`SI_Due_Date`,`SI_Paid_Amount`,`SI_Paid_Date`) VALUES ('$SI_Reg_No','$SI_Ins_NO','$SI_Ins_Amount','$SI_Due_Date','$SI_Paid_Amount','$SI_Paid_Date');";
$helper->getLog("sync_log", $sql);

?>
