<?php

$DT_Reg_Type =" ";

if(isset($_GET['DT_Reg_Type'])){$DT_Reg_Type = $_GET['DT_Reg_Type'];} 
include("../Modal/dbLayer.php");

$discountPlan = $helper->discountPlan($DT_Reg_Type);

 echo "<select id='discountPlan' name='DP_Code'>";
 echo "<option value=''>Select Your Discount Plan</option>";
foreach($discountPlan as $key => $value){


echo "<option value=".$value.">".$value."</option>";

}
echo "<option value='special'>SPECIAL</option>";
echo "</select>";


?>
