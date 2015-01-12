<?php
header("Content-type: application/json");

$SM_ID ="";

if(isset($_GET['SM_ID'])){$SM_ID = $_GET['SM_ID'];} 

include("../Modal/dbLayer.php");

$afterPaymentsUserDetails = $helper->afterPaymentsUserDetails($SM_ID);

echo json_encode($afterPaymentsUserDetails[0]);
?>

