<?php
header("Content-type: application/json");
$RG_Reg_NO ="";

if(isset($_GET['RG_Reg_NO'])){$RG_Reg_NO = $_GET['RG_Reg_NO'];} 

include("../Modal/dbLayer.php");
$getEditInstallment = $helper->getUserInstallmentFull($RG_Reg_NO);

echo json_encode($getEditInstallment);

?>
