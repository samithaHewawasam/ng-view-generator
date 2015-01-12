
<?php

$FS_Code ="";

if(isset($_GET['FS_Code'])){$FS_Code = $_GET['FS_Code'];} 

include("../Modal/dbLayer.php");

$registrationfee = $helper->registrationfee($FS_Code);


echo "<input type='text' id='RG_Reg_Fee' class='form-control' name='RG_Reg_Fee' value=".$registrationfee[0].">";

?>
