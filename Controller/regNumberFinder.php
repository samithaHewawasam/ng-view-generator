<?php 

$RG_Reg_NO="";

if(isset($_GET['RG_Reg_NO'])){$RG_Reg_NO = $_GET['RG_Reg_NO'];}

include("../Modal/dbLayer.php");

$response = $helper->DbcheckUserReg($RG_Reg_NO);

if($response){

echo " .Duplicate Registration No found in existing data";

}else{

echo " .This Registration No doesn t exist";

}

?>
