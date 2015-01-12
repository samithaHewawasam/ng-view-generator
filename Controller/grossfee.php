<?php

$FS_Code ="";

if(isset($_GET['FS_Code'])){$FS_Code = $_GET['FS_Code'];} 

include("../Modal/dbLayer.php");

$grossFee = $helper->grossFee($FS_Code);

echo "<input type='text' id='FS_Price' class='form-control' name='FS_Price' value=".$grossFee[0]." >";
?>
