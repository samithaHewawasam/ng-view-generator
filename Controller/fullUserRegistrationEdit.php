<?php
session_start(); /* begin the session */

error_reporting(0);
$RG_Branch_Code= "";
$RG_Reg_NO="";
$RG_Stu_ID="";
$RG_Reg_Type="";
$RG_Fee_Structure="";
$RG_Discount_Plan="";
$RG_Total_Fee="";
$RG_Final_Fee="";
$RG_Reg_Fee="";
$RG_Total_Paid= '';
$RG_FullPay_Dis_Amount="";
$RG_Dis_Amount="";
$RG_Dis_Comment="";
$RG_Status="Active";
$RG_Operator="";
$RG_Date="";
$couponCode="";
$Default_Batch='';
$RG_Reg_NO="";
$RG_Total_Paid="";

if(isset($_GET['RG_Branch_Code'])){$RG_Branch_Code = $_GET['RG_Branch_Code'];}
if(isset($_GET['RG_Reg_NO'])){$RG_Reg_NO = $_GET['RG_Reg_NO'];}
if(isset($_GET['RG_Stu_ID'])){$RG_Stu_ID = $_GET['RG_Stu_ID'];}
if(isset($_GET['RG_Reg_Type'])){$RG_Reg_Type = $_GET['RG_Reg_Type'];}
if(isset($_GET['RG_Fee_Structure'])){$RG_Fee_Structure = $_GET['RG_Fee_Structure'];}
if(isset($_GET['RG_Discount_Plan'])){$RG_Discount_Plan = $_GET['RG_Discount_Plan'];}
if(isset($_GET['RG_Total_Fee'])){$RG_Total_Fee = $_GET['RG_Total_Fee'];}
if(isset($_GET['RG_Final_Fee'])){$RG_Final_Fee = $_GET['RG_Final_Fee'];}
if(isset($_GET['RG_Total_Paid'])){$RG_Total_Paid = $_GET['RG_Total_Paid'];}
if(isset($_GET['RG_Reg_Fee'])){$RG_Reg_Fee = $_GET['RG_Reg_Fee'];}
if(isset($_GET['RG_FullPay_Dis_Amount'])){$RG_FullPay_Dis_Amount = $_GET['RG_FullPay_Dis_Amount'];}
if(isset($_GET['RG_Dis_Amount'])){$RG_Dis_Amount = $_GET['RG_Dis_Amount'];}
if(isset($_GET['RG_Dis_Comment'])){$RG_Dis_Comment = $_GET['RG_Dis_Comment'];}
if(isset($_GET['RG_Status'])){$RG_Status = $_GET['RG_Status'];}
if(isset($_GET['RG_Operator'])){$RG_Operator = $_GET['RG_Operator'];}
if(isset($_GET['RG_Date'])){$RG_Date = $_GET['RG_Date'];}
if(isset($_GET['couponCode'])){$couponCode = $_GET['couponCode'];}
if(isset($_GET['Default_Batch'])){$Default_Batch = $_GET['Default_Batch'];}
if(isset($_GET['RG_Total_Paid'])){$RG_Total_Paid = $_GET['RG_Total_Paid'];}

include("../Modal/dbLayer.php");
$values = array();

$bindIns        = explode(",", $_GET['installments']);


$getInstallment = array_chunk($bindIns, 4);


foreach ($getInstallment as $key => $array) {
    
    $values[] = "('" . $RG_Reg_NO . "',?,?,?,?)";
    
}



$bindSub     = explode(",", $_GET['subjects']);
$getSubjects = array_chunk($bindSub, 2);


foreach ($getSubjects as $key => $array) {
    
    $SubjectsValues[] = "('" . $RG_Reg_NO . "',?,?,'Active')";
    
}

$bind = array(
    $RG_Branch_Code,
    $RG_Stu_ID,
    $RG_Reg_Type,
    $RG_Fee_Structure,
    $RG_Discount_Plan,
    $RG_Total_Fee,
    $RG_Final_Fee,
    $RG_Reg_Fee,
    $RG_Total_Paid,
    $RG_FullPay_Dis_Amount,
    $RG_Dis_Amount,
    $RG_Dis_Comment,
    'Active',
    $RG_Date,
    $couponCode,
    $Default_Batch,
    $RG_Reg_NO
);


$arguments = array(
    array(
        'query' => "UPDATE `registrations` SET `RG_Branch_Code`=?,`RG_Stu_ID`=?,`RG_Reg_Type`=?,`RG_Fee_Structure`=?,`RG_Discount_Plan`=?,`RG_Total_Fee`=?,`RG_Final_Fee`=?,`RG_Reg_Fee`=?,`RG_Total_Paid`=?,`RG_FullPay_Dis_Amount`=?,`RG_Dis_Amount`=?,`RG_Dis_Comment`=?,`RG_Status`=?,`RG_Date`=?,`couponCode`=?,`Default_Batch`=? WHERE `RG_Reg_NO` = ?",
        'bind' => $bind
    ), 
    array(
        'query' => "DELETE FROM `student_installments` WHERE `SI_Reg_No` = ?",
        'bind' => array($RG_Reg_NO)
    ),
    array(
        'query' => "DELETE FROM `student_subjects` WHERE `SS_REG_NO` = ?",
        'bind' => array($RG_Reg_NO)
    ),
    array(
        'query' => "INSERT IGNORE INTO student_subjects (SS_REG_NO,SS_Batch_No,SS_Subject,SS_Status)  VALUES " . implode(',', $SubjectsValues),
        'bind' => $bindSub
    ),
    array(
        'query' => "INSERT IGNORE INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
        'bind' => array(
            "$RG_Reg_NO Registration has been edited by the $RG_Operator in $RG_Branch_Code @ " . getDateNow(),
            getDateOnly(),
            $RG_Operator,
            $RG_Branch_Code,
            'New User Registration'
        )
        
    )
);


/*If course fee is 0 start*/


if($RG_Final_Fee != 0){

$insArray1 = array(
        'query' => "INSERT IGNORE INTO student_installments (SI_Reg_No,SI_Ins_NO,SI_Ins_Amount,SI_Due_Date,SI_Paid_Amount) VALUES " . implode(',', $values),
        'bind' => $bindIns
    );

array_push($arguments,$insArray1);

}

$response = $helper->MySqlWrapper($arguments);

echo json_encode($response);

/*error capturing*/

$errorCapture = array(
    array(
        'error' => "INSERT INTO `error_log`(`error`, `method`, `operator`, `branch`) VALUES (?,?,?,?)",
        'bind' => array(
            $response['errorInfo'],
            'registrations',
            $RG_Operator,
            $RG_Branch_Code
        )
    )
);


$helper->errorCapture($errorCapture);


?>
