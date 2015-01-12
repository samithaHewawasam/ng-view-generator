<?php
header("Content-type: application/json");
$FS_Code ="";

if(isset($_GET['FS_Code'])){$FS_Code = $_GET['FS_Code'];} 

include("../Modal/dbLayer.php");

$grossFee = $helper->grossFee($FS_Code);
$registrationfee = $helper->registrationfee($FS_Code);
$installment = $helper->installment($FS_Code);

if($installment[0]["FI_Type"] == "Value"){

$firstIns = array_shift(array_values($installment));
$firstinsTotal = $firstIns["FI_Ins_Amount"] + $registrationfee[0];
$firstinsTotalreplacements = array("FI_Ins_NO" => 1, "FI_Ins_Amount" => number_format($firstinsTotal, 2, '.', ''));
$arrayreplacements = array(0 => $firstinsTotalreplacements);
$installmentFinal = array_replace($installment, $arrayreplacements);

$netCourseFee = number_format($grossFee[0] + $registrationfee[0], 2, '.','');
$grossFeeRegFee = array("netFee" => $netCourseFee, "grossFee" => $grossFee[0], "regFee" => $registrationfee[0], "installment" => $installmentFinal); 
echo json_encode($grossFeeRegFee);

}
else{

$firstIns = array_shift(array_values($installment));
$firstInsPercentage = $firstIns["FI_Ins_Amount"]/100;
$firstinsTotal =  $firstInsPercentage * $grossFee[0]  + $registrationfee[0];
$firstinsTotalreplacements = array("FI_Ins_NO" => 1, "FI_Ins_Amount" => number_format($firstinsTotal, 2, '.', ''));

$courseFee = $grossFee[0];

$installmentFixed = array_map(function($value) use ($courseFee)
{
   return array("FI_Ins_NO" => $value["FI_Ins_NO"], "FI_Ins_Amount" => number_format($value["FI_Ins_Amount"]/100  * $courseFee, 2, '.', ''));
}, $installment);

$arrayreplacements = array(0 => $firstinsTotalreplacements);
$installmentFinal = array_replace($installmentFixed, $arrayreplacements);
$netCourseFee = $grossFee[0] + $registrationfee[0];
$grossFeeRegFee = array("netFee" => $netCourseFee, "grossFee" => $grossFee[0], "regFee" => $registrationfee[0], "installment" => $installmentFinal); 
echo json_encode($grossFeeRegFee);


}
?>
