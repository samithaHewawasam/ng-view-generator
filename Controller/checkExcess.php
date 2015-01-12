<?php

include("../Modal/dbLayer.php");
//select excess payment 
if($_GET['RG_Reg_NO']){
$sql = "SELECT *, (`RG_Final_Fee` - `RG_Total_Paid` ) as toPay FROM `registrations` WHERE `RG_Reg_NO`=?";
$dbh = $esoftConfig->prepare($sql);
$dbh->execute(array($_GET['RG_Reg_NO']));
$a = $dbh->fetchALL(PDO::FETCH_ASSOC);
echo $a[0]['toPay'];
}
?>


