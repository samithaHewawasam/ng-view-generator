 <?php
session_start();
/* begin the session */
include("../Modal/dbLayer.php");
error_reporting(0);
$RG_Branch_Code        = "";
$RG_Reg_NO             = "";
$RG_Stu_ID             = "";
$RG_Reg_Type           = "";
$RG_Fee_Structure      = "";
$RG_Discount_Plan      = "";
$RG_Total_Fee          = "";
$RG_Final_Fee          = "";
$RG_Reg_Fee            = "";
$RG_Total_Paid         = '';
$RG_FullPay_Dis_Amount = "";
$RG_Dis_Amount         = "";
$RG_Dis_Comment        = "";
$RG_Status             = "Active";
$RG_Operator           = NULL;
$RG_Date               = NULL;
$couponCode            = "";
$Default_Batch         = NULL;
$RegNumberTemp         = '';
$branch="";
$branch = $_SESSION['branchCode'];

if (isset($_GET['RG_Branch_Code']) && strlen($_GET['RG_Branch_Code']) == 5 && !empty($_GET['RG_Branch_Code'])) {
    $RG_Branch_Code = $_GET['RG_Branch_Code'];
}else{

echo json_encode(array("commitCode" => false, "errorInfo" => 'There is an error in branch code'));

exit();

}

if (!empty($_GET['RG_Reg_NO']) && strlen($_GET['RG_Reg_NO']) == 12 && !empty($_GET['RG_Reg_NO'])) {

$RegNumberTemp = $_GET['RG_Reg_NO'];

if($helper->DbcheckUserReg($RegNumberTemp)){

$getLastRegId =$helper->getLastRegId($branch);
$getId = explode("-", $getLastRegId[0]);
$newReg = $getId[1] + 1;
$RG_Reg_NO = $branch.'-'.sprintf('%06d', $newReg);


}else{

$RG_Reg_NO = $_GET['RG_Reg_NO'];

}


}else{

echo json_encode(array("commitCode" => false, "errorInfo" => 'you entered  invalid registration number'));

exit();
}


if (isset($_GET['RG_Stu_ID'])) {
    $RG_Stu_ID = $_GET['RG_Stu_ID'];
}
if (isset($_GET['RG_Reg_Type'])) {
    $RG_Reg_Type = $_GET['RG_Reg_Type'];
}
if (isset($_GET['RG_Fee_Structure'])) {
    $RG_Fee_Structure = $_GET['RG_Fee_Structure'];
}
if (isset($_GET['RG_Discount_Plan'])) {
    $RG_Discount_Plan = $_GET['RG_Discount_Plan'];
}
if (isset($_GET['RG_Total_Fee'])) {
    $RG_Total_Fee = $_GET['RG_Total_Fee'];
}
if (isset($_GET['RG_Final_Fee'])) {
    $RG_Final_Fee = $_GET['RG_Final_Fee'];
}
if (isset($_GET['RG_Total_Paid'])) {
    $RG_Total_Paid = $_GET['RG_Total_Paid'];
}
if (isset($_GET['RG_Reg_Fee'])) {
    $RG_Reg_Fee = $_GET['RG_Reg_Fee'];
}
if (isset($_GET['RG_FullPay_Dis_Amount'])) {
    $RG_FullPay_Dis_Amount = $_GET['RG_FullPay_Dis_Amount'];
}
if (isset($_GET['RG_Dis_Amount'])) {
    $RG_Dis_Amount = $_GET['RG_Dis_Amount'];
}
if (isset($_GET['RG_Dis_Comment'])) {
    $RG_Dis_Comment = $_GET['RG_Dis_Comment'];
}
if (isset($_GET['RG_Status'])) {
    $RG_Status = $_GET['RG_Status'];
}
if (isset($_GET['RG_Operator'])) {
    $RG_Operator = $_GET['RG_Operator'];
}
if (isset($_GET['RG_Date'])) {
    $RG_Date = $_GET['RG_Date'];
}
if (isset($_GET['couponCode'])) {
    $couponCode = $_GET['couponCode'];
}
if (isset($_GET['Default_Batch'])) {
    $Default_Batch = $_GET['Default_Batch'];
}


$values = array();

$bindIns        = explode(",", $_GET['installments']);
$getInstallment = array_chunk($bindIns, 3);


foreach ($getInstallment as $key => $array) {
    
    $values[] = "('" . $RG_Reg_NO . "',?,?,?)";
    
}



$bindSub     = explode(",", $_GET['subjects']);
$getSubjects = array_chunk($bindSub, 2);


foreach ($getSubjects as $key => $array) {
    
    $SubjectsValues[] = "('" . $RG_Reg_NO . "',?,?,'Active')";
    
}

$bind = array(
    strtoupper($RG_Branch_Code),
    strtoupper($RG_Reg_NO),
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
    $RG_Operator,
    $RG_Date,
    $couponCode,
    $Default_Batch
);

$arguments = array(
    array(
        'query' => "INSERT IGNORE INTO `registrations`(`RG_Branch_Code`, `RG_Reg_NO`, `RG_Stu_ID`, `RG_Reg_Type`, `RG_Fee_Structure`, `RG_Discount_Plan`, `RG_Total_Fee`, `RG_Final_Fee`, `RG_Reg_Fee`, `RG_Total_Paid`, `RG_FullPay_Dis_Amount`, `RG_Dis_Amount`, `RG_Dis_Comment`, `RG_Status`, `RG_Operator`, `RG_Date`, `couponCode`, `Default_Batch`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        'bind' => $bind
    ),
   
   array(
        'query' => "INSERT IGNORE INTO student_subjects (SS_REG_NO,SS_Batch_No,SS_Subject,SS_Status)  VALUES " . implode(',', $SubjectsValues),
        'bind' => $bindSub
    ),
    array(
        'query' => "INSERT IGNORE INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
        'bind' => array(
            "$RG_Reg_NO New Registration has been added by the $RG_Operator in $RG_Branch_Code @ " . getDateNow(),
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
        'query' => "INSERT IGNORE INTO student_installments (SI_Reg_No,SI_Ins_NO,SI_Ins_Amount,SI_Due_Date) VALUES " . implode(',', $values),
        'bind' => $bindIns
    );

array_push($arguments,$insArray1);

}

/*If course fee is 0 end*/

$response = $helper->MySqlWrapper($arguments);

$response['RG_Reg_NO'] = $RG_Reg_NO;


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
