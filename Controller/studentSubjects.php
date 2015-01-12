<?php
error_reporting(0);
$SS_REG_NO ="";
$SS_Batch_No ="";
$SS_Subject ="";

if(isset($_GET['SS_REG_NO'])){$SS_REG_NO = $_GET['SS_REG_NO'];}
if(isset($_GET['SS_Batch_No'])){$SS_Batch_No = $_GET['SS_Batch_No'];} 
if(isset($_GET['SS_Subject'])){$SS_Subject = $_GET['SS_Subject'];} 

include("../Modal/dbLayer.php");

$helper->putStudentSubjects("student_subjects",$SS_REG_NO,$SS_Batch_No,$SS_Subject);

$sql="INSERT IGNORE INTO `student_subjects` (`SS_REG_NO`,`SS_Batch_No`,`SS_Subject`) VALUES ('$SS_REG_NO','$SS_Batch_No','$SS_Subject');";
$helper->getLog("sync_log", $sql);

?>

