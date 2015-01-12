<?php
// begin the session
session_start();
$SM_ID            = "";
$SM_ID_Type       = "";
$SM_Branch_Code   = $_SESSION['branchCode'];
$SM_Title         = "";
$SM_Initials      = "";
$SM_First_Name    = "";
$SM_Last_Name     = "";
$SM_Full_Name     = "";
$SM_Gender        = "";
$SM_Date_of_Birth = "";
$SM_House_NO      = "";
$SM_Lane          = "";
$SM_Town          = "";
$SM_City          = "";
$SM_Country       = "";
$SM_Postal_Code   = "";
$SM_Tel_Residance = "";
$SM_Tell_Work     = "";
$SM_Tell_Mobile   = "";
$SM_Mail_Personal = "";
$SM_Mail_Work     = "";
$SM_Use_Parent_ID = "";
$SM_Parent_Name   = "";
$SM_Parent_Phone  = "";
$SM_Operator      = $_SESSION['Sys_U_Name'];
$SM_Reg_Date      = "";

if (isset($_GET['SM_ID'])) {
    $SM_ID = $_GET['SM_ID'];
}
if (isset($_GET['SM_ID_Type'])) {
    $SM_ID_Type = $_GET['SM_ID_Type'];
}
if (isset($_GET['SM_Title'])) {
    $SM_Title = $_GET['SM_Title'];
}
if (isset($_GET['SM_Initials'])) {
    $SM_Initials = $_GET['SM_Initials'];
}
if (isset($_GET['SM_First_Name'])) {
    $SM_First_Name = $_GET['SM_First_Name'];
}
if (isset($_GET['SM_Last_Name'])) {
    $SM_Last_Name = $_GET['SM_Last_Name'];
}
if (isset($_GET['SM_Full_Name'])) {
    $SM_Full_Name = $_GET['SM_Full_Name'];
}
if (isset($_GET['SM_Gender'])) {
    $SM_Gender = $_GET['SM_Gender'];
}
if (isset($_GET['SM_Date_of_Birth'])) {
    $SM_Date_of_Birth = $_GET['SM_Date_of_Birth'];
}
if (isset($_GET['SM_House_NO'])) {
    $SM_House_NO = $_GET['SM_House_NO'];
}
if (isset($_GET['SM_Lane'])) {
    $SM_Lane = $_GET['SM_Lane'];
}
if (isset($_GET['SM_Town'])) {
    $SM_Town = $_GET['SM_Town'];
}
if (isset($_GET['SM_City'])) {
    $SM_City = $_GET['SM_City'];
}
if (isset($_GET['SM_Country'])) {
    $SM_Country = $_GET['SM_Country'];
}
if (isset($_GET['SM_Postal_Code'])) {
    $SM_Postal_Code = $_GET['SM_Postal_Code'];
}
if (isset($_GET['SM_Tel_Residance'])) {
    $SM_Tel_Residance = $_GET['SM_Tel_Residance'];
}
if (isset($_GET['SM_Tell_Work'])) {
    $SM_Tell_Work = $_GET['SM_Tell_Work'];
}
if (isset($_GET['SM_Tell_Mobile'])) {
    $SM_Tell_Mobile = $_GET['SM_Tell_Mobile'];
}
if (isset($_GET['SM_Mail_Personal'])) {
    $SM_Mail_Personal = $_GET['SM_Mail_Personal'];
}
if (isset($_GET['SM_Mail_Work'])) {
    $SM_Mail_Work = $_GET['SM_Mail_Work'];
}
if (isset($_GET['SM_Use_Parent_ID'])) {
    $SM_Use_Parent_ID = $_GET['SM_Use_Parent_ID'];
}
if (isset($_GET['SM_Parent_Name'])) {
    $SM_Parent_Name = $_GET['SM_Parent_Name'];
}
if (isset($_GET['SM_Parent_Phone'])) {
    $SM_Parent_Phone = $_GET['SM_Parent_Phone'];
}
if (isset($_GET['SM_Reg_Date'])) {
    $SM_Reg_Date = $_GET['SM_Reg_Date'];
}

include("../Modal/dbLayer.php");


$bind = array(
    $SM_ID,
    $SM_ID_Type,
    $SM_Branch_Code,
    $SM_Title,
    $SM_Initials,
    $SM_First_Name,
    $SM_Last_Name,
    $SM_Full_Name,
    $SM_Gender,
    $SM_Date_of_Birth,
    $SM_House_NO,
    $SM_Lane,
    $SM_Town,
    $SM_City,
    $SM_Country,
    $SM_Postal_Code,
    $SM_Tel_Residance,
    $SM_Tell_Work,
    $SM_Tell_Mobile,
    $SM_Mail_Personal,
    $SM_Mail_Work,
    $SM_Use_Parent_ID,
    $SM_Parent_Name,
    $SM_Parent_Phone,
    "Active",
    $SM_Operator,
    $SM_Reg_Date
);


$arguments = array(
    array(
        'query' => "INSERT INTO student_master (SM_ID,SM_ID_Type,SM_Branch_Code,SM_Title,SM_Initials,SM_First_Name,SM_Last_Name,SM_Full_Name,SM_Gender,SM_Date_of_Birth,SM_House_NO,SM_Lane,SM_Town,SM_City,SM_Country,SM_Postal_Code,SM_Tel_Residance,SM_Tell_Work,SM_Tell_Mobile,SM_Mail_Personal,SM_Mail_Work,SM_Use_Parent_ID,SM_Parent_Name,SM_Parent_Phone,SM_Status,SM_Operator,SM_Reg_Date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        'bind' => $bind
    ),
    array(
       'query' => "INSERT INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
       'bind'  => array("$SM_ID new user full info has been added by the $SM_Operator in $SM_Branch_Code @ ".getDateNow(), getDateOnly(), $SM_Operator, $SM_Branch_Code, 'Full info added')

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
            'fullInfo',
            $SM_Operator,
            $SM_Branch_Code
        )
    )
);


$helper->errorCapture($errorCapture);

?>   
