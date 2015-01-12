 <?php
session_start();
include("../Modal/dbLayer.php");

$SM_Branch_Code   = $_SESSION['branchCode'];
$SM_Operator      = $_SESSION['Sys_U_Name'];
$RG_Status	  = "";
$RG_Reg_NO	  ='';

if(isset($_GET['RG_Status'])){$RG_Status  = $_GET['RG_Status'];} 
if(isset($_GET['RG_Reg_NO'])){$RG_Reg_NO  = $_GET['RG_Reg_NO'];} 

$arguments = array(
    
    array(
        
        'query' => "UPDATE `registrations` SET `RG_Status` = ? WHERE `RG_Reg_NO` =?",
        
        'bind' => array(
            $RG_Status,
            $RG_Reg_NO
        )
        
    ),
    array(
        'query' => "INSERT INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
        'bind' => array(
            "$RG_Reg_NO status has been changed as $RG_Status by the $SM_Operator in $SM_Branch_Code @ " . getDateNow(),
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
