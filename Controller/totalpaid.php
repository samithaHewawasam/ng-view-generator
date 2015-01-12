<?php
header("Content-type: application/json");
$RG_Reg_No ="";
//if(isset($_GET['RG_Reg_N0'])){$RG_Reg_N0 = $_GET['RG_Reg_N0'];} 
include("../Modal/dbLayer.php");
$sql = $esoftConfig->prepare("SELECT * FROM payments_master WHERE RG_Reg_No=?");
$sql->execute(array($RG_Reg_No));
$result =  $sql->fetchALL(PDO::FETCH_ASSOC);
echo json_encode($result);
?>

