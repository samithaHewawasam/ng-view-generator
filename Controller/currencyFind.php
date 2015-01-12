<?php 

$RG_Reg_NO="";

if(isset($_GET['RG_Reg_NO'])){$RG_Reg_NO = $_GET['RG_Reg_NO'];}

include("../Modal/dbLayer.php");

$response = $helper->currencyFind($RG_Reg_NO);

echo json_encode($response[0]);

?>
