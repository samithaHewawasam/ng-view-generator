 <?php
session_start();
include("../Modal/dbLayer.php");

$SM_ID            = "";
$SM_ID_Type       = "";
$SM_Branch_Code   = $_SESSION['branchCode'];
$SM_Title         = "";
$SM_First_Name    = "";
$SM_Last_Name     = "";
$SM_Gender        = "";
$SM_Date_of_Birth = "";
$SM_Tell_Mobile   = "";
$SM_Source        = "";
$SM_Status        = "";
$SM_Operator      = $_SESSION['Sys_U_Name'];
$SM_Reg_Date      = "";

if (isset($_GET['SM_ID'])) {
    $SM_ID = $_GET['SM_ID'];
}
if (isset($_GET['SM_ID_Type'])) {
    $SM_ID_Type = $_GET['SM_ID_Type'];
}
if (isset($_GET['SM_Branch_Code'])) {
    $SM_Branch_Code = $_GET['SM_Branch_Code'];
}
if (isset($_GET['SM_Title'])) {
    $SM_Title = $_GET['SM_Title'];
}
if (isset($_GET['SM_First_Name'])) {
    $SM_First_Name = $_GET['SM_First_Name'];
}
if (isset($_GET['SM_Last_Name'])) {
    $SM_Last_Name = $_GET['SM_Last_Name'];
}
if (isset($_GET['SM_Gender'])) {
    $SM_Gender = $_GET['SM_Gender'];
}
if (isset($_GET['SM_Date_of_Birth'])) {
    $SM_Date_of_Birth = $_GET['SM_Date_of_Birth'];
}
if (isset($_GET['SM_Tell_Mobile'])) {
    $SM_Tell_Mobile = $_GET['SM_Tell_Mobile'];
}
if (isset($_GET['SM_Source'])) {
    $SM_Source = $_GET['SM_Source'];
}
if (isset($_GET['SM_Status'])) {
    $SM_Status = $_GET['SM_Status'];
}
if (isset($_GET['SM_Operator'])) {
    $SM_Operator = $_GET['SM_Operator'];
}
if (isset($_GET['SM_Reg_Date'])) {
    $SM_Reg_Date = $_GET['SM_Reg_Date'];
}


$bind = array(
    $SM_ID,
    $SM_ID_Type,
    $SM_Branch_Code,
    $SM_Title,
    $SM_First_Name,
    $SM_Last_Name,
    $SM_Gender,
    $SM_Date_of_Birth,
    $SM_Tell_Mobile,
    $SM_Status,
    $SM_Source,
    $SM_Operator,
    $SM_Reg_Date
);


$arguments = array(
    array(
        'query' => "INSERT INTO student_master(SM_ID,SM_ID_Type,SM_Branch_Code,SM_Title,SM_First_Name,SM_Last_Name,SM_Gender,SM_Date_of_Birth,SM_Tell_Mobile,SM_Status,SM_Source,SM_Operator,SM_Reg_Date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)",
        'bind' => $bind
    ),
    array(
       'query' => "INSERT INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
       'bind'  => array("$SM_ID new user quick info has been added by the $SM_Operator in $SM_Branch_Code @ ".getDateNow(), getDateOnly(), $SM_Operator, $SM_Branch_Code, 'Quick info added')

    )
);

$response = $helper->MySqlWrapper($arguments);

echo json_encode($response);

/*error capturing*/

$errorCapture = array(
    array(
        'error' => "INSERT INTO `error_log`(`error`, `method`, `operator`, `branch`) VALUES (?,?,?,?)",
        'bind' => array($response['errorInfo'],quickInfo,$SM_Operator,$SM_Branch_Code)
    )
);


$helper->errorCapture($errorCapture);

?> 
