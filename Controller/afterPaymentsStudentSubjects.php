<?php
header("Content-type: application/json");

$SS_REG_NO ="";

if(isset($_GET['SS_REG_NO'])){$SS_REG_NO = $_GET['SS_REG_NO'];} 

include("../Modal/dbLayer.php");


$afterPaymentsStudentSubjects = $helper->afterPaymentsStudentSubjects($SS_REG_NO);
echo json_encode($afterPaymentsStudentSubjects[0]);
?>

