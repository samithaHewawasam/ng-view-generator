<?php
header("Content-type: application/json");
$RG_Reg_NO="";

if(isset($_GET['RG_Reg_NO'])){$RG_Reg_NO = $_GET['RG_Reg_NO'];}

include("../Modal/dbLayer.php");

$getUserRegistration = $helper->getUserRegistrationFull($RG_Reg_NO);
$getUserSubjectsFull = $helper->getUserSubjectsFull($RG_Reg_NO);

$getCourseCode = $helper->getCourseCode($getUserRegistration[0]->RG_Reg_Type);
echo json_encode(array("regInfo" => $getUserRegistration,"regSub" => $getUserSubjectsFull,"regCourse" => $getCourseCode), true);

?>
