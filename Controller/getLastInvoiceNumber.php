<?php 
error_reporting(0);
header("Content-type: application/json");
include("../Modal/dbLayer.php");

$RG_Branch_Code= "";
$RG_Date="";
if(isset($_GET['RG_Date'])){$RG_Date = $_GET['RG_Date'];}
if(isset($_GET['RG_Branch_Code'])){$RG_Branch_Code = $_GET['RG_Branch_Code'];}

$getLastInvoiceNumber =$helper->getLastInvoiceNumber($_GET['RG_Branch_Code'], $RG_Date);

$getNumber = explode('-',$getLastInvoiceNumber[0]);

$getbySlash = explode('/',$getNumber[1]);

$newInvoiceNumber       = $getbySlash[0] + 1;
$formattedInvoiceNumber = sprintf('%04d', $newInvoiceNumber);

list($yy, $mm, $dd) = split('[-]', $RG_Date);
$dateForInvoice = $mm."/".$yy;
$InvoiceNumber = $RG_Branch_Code."-".$formattedInvoiceNumber."/".$dateForInvoice;
$InvoiceNumberArray = array("InvoiceNumber" => $InvoiceNumber);
echo json_encode($InvoiceNumberArray);
?>
