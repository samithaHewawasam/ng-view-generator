<?php
error_reporting(0);
$SI_Reg_No ="";

if(isset($_GET['SI_Reg_No'])){$SI_Reg_No = $_GET['SI_Reg_No'];}

include("../Modal/dbLayer.php");

$responseSubjects = $helper->studentSubjectsDelete($SI_Reg_No);
$responseInstallments = $helper->studentInstallmentsDelete($SI_Reg_No);


if($responseSubjects){
$sql="DELETE FROM `student_subjects` WHERE `student_subjects`.`SS_REG_NO` = '$SI_Reg_No';";
$helper->getLog("sync_log", $sql);
}


if($responseInstallments){
$sql="DELETE FROM `student_installments` WHERE `student_installments`.`SI_Reg_No` = '$SI_Reg_No';";
$helper->getLog("sync_log", $sql);
}

?>
