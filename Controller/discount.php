<?php
header("Content-type: application/json");
$DP_Code =" ";

if(isset($_GET['DP_Code'])){$DP_Code = $_GET['DP_Code'];} 
include("../Modal/dbLayer.php");

$discount= $helper->discount($DP_Code);

echo json_encode($discount[0]);

?>
