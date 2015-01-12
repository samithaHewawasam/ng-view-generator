 <?php
session_start();
$SM_Branch_Code = $_SESSION['branchCode'];
$SM_Operator    = $_SESSION['Sys_U_Name'];
if (empty($_GET['BM_Batch_Count'])) {
    exit;
}
$BM_Branch_Code   = $_SESSION['branchCode'];
$BM_Course_Code   = "";
$BM_Batch_Code    = "";
$BM_Commence_Date = "";
$BM_End_Date      = "";
$BM_Target_Exam   = "";
$BM_Status        = "";
$BM_Intake        = "";
$BM_Ins_Days      = "";
$BM_Batch_Count   = "";

if (isset($_GET['BM_Branch_Code'])) {
    $BM_Branch_Code = $_GET['BM_Branch_Code'];
}
if (isset($_GET['BM_Course_Code'])) {
    $BM_Course_Code = $_GET['BM_Course_Code'];
}
if (isset($_GET['BM_Batch_Code'])) {
    $BM_Batch_Code = $_GET['BM_Batch_Code'] . $_GET['BM_Batch_Count'];
}
if (isset($_GET['BM_Commence_Date'])) {
    $BM_Commence_Date = $_GET['BM_Commence_Date'];
}
if (isset($_GET['BM_End_Date'])) {
    $BM_End_Date = $_GET['BM_End_Date'];
}
if (isset($_GET['BM_Target_Exam'])) {
    $BM_Target_Exam = $_GET['BM_Target_Exam'];
}
if (isset($_GET['BM_Status'])) {
    $BM_Status = $_GET['BM_Status'];
}
if (isset($_GET['BM_Intake'])) {
    $BM_Intake = $_GET['BM_Intake'];
}
if (isset($_GET['BM_Ins_Days'])) {
    $BM_Ins_Days = $_GET['BM_Ins_Days'];
}

include("../Modal/dbLayer.php");

$arguments = array(
    
    array(
        
        'query' => "INSERT IGNORE INTO `batch_master` (BM_Branch_Code,BM_Course_Code,BM_Batch_Code,BM_Commence_Date,BM_End_Date,BM_Target_Exam,BM_Ins_Days,BM_Status,BM_Intake) VALUES (?,?,?,?,?,?,?,?,?)",
        
        'bind' => array(
            $BM_Branch_Code,
            $BM_Course_Code,
            $BM_Batch_Code,
            $BM_Commence_Date,
            $BM_End_Date,
            $BM_Target_Exam,
            $BM_Ins_Days,
            "Active",
            $BM_Intake
        )
        
    ),
    array(
        'query' => "INSERT INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
        'bind' => array(
            "$BM_Batch_Code new batch has been added by the $SM_Operator in $SM_Branch_Code @ " . getDateNow(),
            getDateOnly(),
            $SM_Operator,
            $SM_Branch_Code,
            'New Batch Creation'
        )
        
    )
);

$response = $helper->MySqlWrapper($arguments);

echo json_encode($response);

/*error capturing*/

$errorCapture = array(
    array(
        'error' => "INSERT INTO `error_log`(`error`, `method`, `operator`, `branch`) VALUES (?,?,?,?)",
        'bind' => array(
            $response['errorInfo'],
            'Batchmaster',
            $SM_Operator,
            $SM_Branch_Code,
        )
    )
);


$helper->errorCapture($errorCapture);

?> 
