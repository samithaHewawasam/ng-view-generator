<?php
$RG_Reg_NO="";
$RG_Total_Paid="";

if(isset($_GET['RG_Reg_N0'])){$RG_Reg_NO = $_GET['RG_Reg_N0'];}
if(isset($_GET['RG_Total_Paid'])){$RG_Total_Paid = $_GET['RG_Total_Paid'];}
include("../Modal/dbLayer.php");

//installment update 
$amount = $RG_Total_Paid;

$dbuF = $esoftConfig->prepare("UPDATE `student_installments` SET `SI_Paid_Amount` = 0 WHERE `SI_Reg_No` =?");
$dbuF->execute(array($RG_Reg_NO));

$sql = "SELECT *, (`SI_Ins_Amount` - `SI_Paid_Amount`) as owed FROM `student_installments` WHERE (`SI_Ins_Amount` - `SI_Paid_Amount`) != 0 AND `SI_Reg_No` =? ORDER BY `SI_Ins_NO` ASC";
$dbh = $esoftConfig->prepare($sql);
$dbh->execute(array($RG_Reg_NO));
$rows = $dbh->fetchALL(PDO::FETCH_ASSOC);


foreach($rows as $r) {


    // There's money left
    if($r['owed'] - $amount < 0) {
        $paying = $r['owed'] + $r['SI_Paid_Amount'];

        $amount -= $r['owed'];

    } else {
        // No money left
        $paying = $r['SI_Paid_Amount'] + $amount;
        $amount -= $paying;
    }

    // If there's money left
    if($paying > 0) { 
$dbu = $esoftConfig->prepare("UPDATE `student_installments` SET `SI_Paid_Amount` = '".$paying."' WHERE `SI_Ins_NO` = '".$r['SI_Ins_NO']."' AND `SI_Reg_No` =?");
$dbu->execute(array($RG_Reg_NO));

$sqlS = "UPDATE `student_installments` SET `SI_Paid_Amount` = 0 WHERE `SI_Reg_No` ='$RG_Reg_NO';";

$sqlS .="UPDATE `student_installments` SET `SI_Paid_Amount` = '".$paying."' WHERE `SI_Ins_NO` = '".$r['SI_Ins_NO']."' AND `SI_Reg_No` ='$RG_Reg_NO';";
$helper->getLog("sync_log", $sqlS);
   }
}

?>
