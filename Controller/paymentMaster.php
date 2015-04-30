 <?php
session_start();
$PM_Receipt_No         = "";
$RG_Reg_N0             = "";
$RG_Date               = "";
$PM_Amount             = "";
$PM_Amount_credit      = "";
$PM_Amount_Cash        = "";
$PM_Amount_Cheque      = "";
$PM_Type               = "";
$PM_Cheque_NO          = "";
$PM_Cheque_Bank        = "";
$PM_Cheque_Due_Date    = "";
$PM_Card_Holder_Name   = "";
$PM_Card_Type          = "";
$PM_Card_NO            = "";
$RG_Branch_Code        = "";
$registerUserForPrint  = "";
$PM_Operator           = "";
$selectedBatchForPrint = "";
$PM_Amount_Final       = "";
$excessPayment         = "";
$amount                = '';
$currency              = '';
$currencyRate          = '';


include("../Modal/dbLayer.php");

if (isset($_GET['selectedBatchForPrint'])) {
    $selectedBatchForPrint = $_GET['selectedBatchForPrint'];
}

if (isset($_GET['PM_Receipt_No']) && strlen($_GET['PM_Receipt_No']) == 18) {
    $PM_Receipt_No = $_GET['PM_Receipt_No'];
    
} else {
    
    echo json_encode(array(
        "commitCode" => false,
        "errorInfo" => 'There is an error in receipt no'
    ));
    
    exit();
    
}

$responseRegistration = $helper->DbcheckUserReg($_GET['RG_Reg_N0']);

if (isset($_GET['RG_Reg_N0']) && $responseRegistration) {
    
    $RG_Reg_N0 = strtoupper($_GET['RG_Reg_N0']);
    
} else {
    
    echo json_encode(array(
        "commitCode" => false,
        "errorInfo" => 'invalid registration number'
    ));
    
    exit();
    
}

if (isset($_GET['RG_Date'])) {
    $RG_Date = $_GET['RG_Date'];
}
if (isset($_GET['PM_Amount'])) {
    $PM_Amount = $_GET['PM_Amount'];
}
if (isset($_GET['PM_Amount_Final'])) {
    $PM_Amount_Final = $_GET['PM_Amount_Final'];
}
if (isset($_GET['PM_Amount_credit'])) {
    $PM_Amount_credit = $_GET['PM_Amount_credit'];
}
if (isset($_GET['PM_Amount_Cash'])) {
    $PM_Amount_Cash = $_GET['PM_Amount_Cash'];
}
if (isset($_GET['PM_Amount_Cheque'])) {
    $PM_Amount_Cheque = $_GET['PM_Amount_Cheque'];
}
if (isset($_GET['excessPayment'])) {
    $excessPayment = $_GET['excessPayment'];
}
if (isset($_GET['PM_Type'])) {
    $PM_Type = $_GET['PM_Type'];
}
if (isset($_GET['PM_Cheque_NO'])) {
    $PM_Cheque_NO = $_GET['PM_Cheque_NO'];
}
if (isset($_GET['PM_Cheque_Bank'])) {
    $PM_Cheque_Bank = $_GET['PM_Cheque_Bank'];
}
if (isset($_GET['PM_Cheque_Due_Date'])) {
    $PM_Cheque_Due_Date = $_GET['PM_Cheque_Due_Date'];
}
if (isset($_GET['PM_Card_Holder_Name'])) {
    $PM_Card_Holder_Name = $_GET['PM_Card_Holder_Name'];
}
if (isset($_GET['PM_Card_Type'])) {
    $PM_Card_Type = $_GET['PM_Card_Type'];
}
if (isset($_GET['PM_Card_NO'])) {
    $PM_Card_NO = $_GET['PM_Card_NO'];
}
$PM_Operator = $_SESSION['Sys_U_Name'];
if (isset($_GET['RG_Branch_Code'])) {
    $RG_Branch_Code = $_GET['RG_Branch_Code'];
}
if (isset($_GET['registerUserForPrint'])) {
    $registerUserForPrint = $_GET['registerUserForPrint'];
}
if (isset($_GET['currency'])) {
    $currency = $_GET['currency'];
}
if (isset($_GET['currencyRate'])) {
    
    $currencyRate = $_GET['currencyRate'];
    
}



$_SESSION['RG_Reg_N0']             = $RG_Reg_N0;
$_SESSION['RG_Date']               = $RG_Date;
$_SESSION['PM_Amount']             = $PM_Amount;
$_SESSION['PM_Type']               = $PM_Type;
$_SESSION['PM_Cheque_NO']          = $PM_Cheque_NO;
$_SESSION['PM_Cheque_Bank']        = $PM_Cheque_Bank;
$_SESSION['PM_Cheque_Due_Date']    = $PM_Cheque_Due_Date;
$_SESSION['PM_Card_Holder_Name']   = $PM_Card_Holder_Name;
$_SESSION['PM_Card_Type']          = $PM_Card_Type;
$_SESSION['PM_Card_NO']            = $PM_Card_NO;
$_SESSION['RG_Branch_Code']        = $RG_Branch_Code;
$_SESSION['registerUserForPrint']  = $registerUserForPrint;
$_SESSION['selectedBatchForPrint'] = $selectedBatchForPrint;
$_SESSION['currency']              = substr($currency, 3);


/*

get the last invoice number

*/

$RG_Reg_NO           = $RG_Reg_N0;
$lastTotalPaidAmount = $helper->getLastTotalPaid($RG_Reg_NO);


$getLastInvoiceNumber = $helper->getLastInvoiceNumber($RG_Branch_Code, $RG_Date);

$getNumber = explode('-', $getLastInvoiceNumber[0]);

$getbySlash = explode('/', $getNumber[1]);

$newInvoiceNumber       = $getbySlash[0] + 1;
$formattedInvoiceNumber = sprintf('%04d', $newInvoiceNumber);
list($yy, $mm, $dd) = split('[-]', $RG_Date);
$dateForInvoice = $mm . "/" . $yy;

$InvoiceNumber             = $RG_Branch_Code . "-" . $formattedInvoiceNumber . "/" . $dateForInvoice;
$_SESSION['PM_Receipt_No'] = $InvoiceNumber;

if ($PM_Type == "Cash") {
    
    /* SET current paying amount*/
    
    $amount = $PM_Amount_Cash * $currencyRate;
    
    /* SET session for print*/
    
    $_SESSION['PM_Amount'] = $PM_Amount_Cash;
    
    /* SET totalPaid for cash payments*/
    
    $nextTotalPaidUpdate = $lastTotalPaidAmount[0] + $PM_Amount_Cash * $currencyRate;
    
    $arguments = array(
        array(
            'query' => "INSERT IGNORE INTO `payments_master` (`PM_Receipt_No` , `RG_Reg_No` , `PM_Date` ,`Currency`, `Currency_rate`, `PM_Amount` , `excessPayment` , `PM_Type` ,`PM_Operator` )
VALUES (?,?,?,?,?,?,?,?,?)",
            'bind' => array(
                $InvoiceNumber,
                $RG_Reg_N0,
                $RG_Date,
                $currency,
                $currencyRate,
                $PM_Amount_Cash,
                $excessPayment,
                $PM_Type,
                $PM_Operator
            )
        ),
        array(
            'query' => "UPDATE `registrations` SET `RG_Total_Paid`=? WHERE `RG_Reg_NO`=?",
            'bind' => array(
                $nextTotalPaidUpdate,
                $RG_Reg_N0
            )
        ),
        array(
            'query' => "INSERT IGNORE INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
            'bind' => array(
                "$InvoiceNumber receipt has been added by the $PM_Operator in $RG_Branch_Code @ " . getDateNow(),
                getDateOnly(),
                $PM_Operator,
                $RG_Branch_Code,
                'Cash Type Payment Added'
            )
            
        )
    );
    
    
}

if ($PM_Type == "Credit Card") {
    
    
    /* SET current paying amount*/
    
    $amount = $PM_Amount_credit * $currencyRate;
    
    /* SET session for print*/
    
    $_SESSION['PM_Amount'] = $PM_Amount_credit;
    
    /* SET totalPaid for cash payments*/
    
    $nextTotalPaidUpdate = $lastTotalPaidAmount[0] + $PM_Amount_credit * $currencyRate;
    
    
    $arguments = array(
        array(
            'query' => "INSERT IGNORE INTO `payments_master`(`PM_Receipt_No`, `RG_Reg_No`, `PM_Date`, `Currency`, `Currency_rate`,`PM_Amount`, `excessPayment`, `PM_Type`, `PM_Card_Holder_Name`, `PM_Card_Type`, `PM_Card_NO`, `PM_Operator`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)",
            'bind' => array(
                $InvoiceNumber,
                $RG_Reg_N0,
                $RG_Date,
                $currency,
                $currencyRate,
                $PM_Amount_credit,
                $excessPayment,
                $PM_Type,
                $PM_Card_Holder_Name,
                $PM_Card_Type,
                $PM_Card_NO,
                $PM_Operator
            )
        ),
        array(
            'query' => "UPDATE `registrations` SET `RG_Total_Paid`=? WHERE `RG_Reg_NO`=?",
            'bind' => array(
                $nextTotalPaidUpdate,
                $RG_Reg_N0
            )
        ),
        array(
            'query' => "INSERT IGNORE INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
            'bind' => array(
                "$InvoiceNumber receipt has been added by the $PM_Operator in $RG_Branch_Code @ " . getDateNow(),
                getDateOnly(),
                $PM_Operator,
                $RG_Branch_Code,
                'Credit Card Payment Added'
            )
            
        )
    );
    
    
}

if ($PM_Type == "Cheque") {
    
    
    /* SET current paying amount*/
    
    $amount = $PM_Amount_Cheque * $currencyRate;
    
    /* SET session for print*/
    
    $_SESSION['PM_Amount'] = $PM_Amount_Cheque;
    
    /* SET totalPaid for cash payments*/
    
    $nextTotalPaidUpdate = $lastTotalPaidAmount[0] + $PM_Amount_Cheque * $currencyRate;
    
    
    
    $arguments = array(
        array(
            'query' => "INSERT IGNORE INTO `payments_master`(`PM_Receipt_No`, `RG_Reg_No`, `PM_Date`, `Currency`, `Currency_rate`, `PM_Amount`, `excessPayment`, `PM_Type`, `PM_Cheque_NO`, `PM_Cheque_Bank`, `PM_Cheque_Due_Date`, `PM_Operator`)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?)",
            'bind' => array(
                $InvoiceNumber,
                $RG_Reg_N0,
                $RG_Date,
                $currency,
                $currencyRate,
                $PM_Amount_Cheque,
                $excessPayment,
                $PM_Type,
                $PM_Cheque_NO,
                $PM_Cheque_Bank,
                $PM_Cheque_Due_Date,
                $PM_Operator
            )
        ),
        
        array(
            'query' => "UPDATE `registrations` SET `RG_Total_Paid`=? WHERE `RG_Reg_NO`=?",
            'bind' => array(
                $nextTotalPaidUpdate,
                $RG_Reg_N0
            )
        ),
        array(
            'query' => "INSERT IGNORE INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
            'bind' => array(
                "$InvoiceNumber receipt has been added by the $PM_Operator in $RG_Branch_Code @ " . getDateNow(),
                getDateOnly(),
                $PM_Operator,
                $RG_Branch_Code,
                'Cheque Payment Added'
            )
            
        )
    );
    
}



$sql = "SELECT *, (`SI_Ins_Amount` - `SI_Paid_Amount`) as owed FROM `student_installments` WHERE (`SI_Ins_Amount` - `SI_Paid_Amount`) != 0 AND `SI_Reg_No` =? ORDER BY `SI_Ins_NO` ASC";
$dbh = $esoftConfig->prepare($sql);
$dbh->execute(array(
    $RG_Reg_NO
));
$rows = $dbh->fetchALL(PDO::FETCH_ASSOC);

foreach ($rows as $r) {
    
    
    // There's money left
    if ($r['owed'] - $amount < 0) {
        $paying = $r['owed'] + $r['SI_Paid_Amount'];
        
        $amount -= $r['owed'];
        
    } else {
        // No money left
        $paying = $r['SI_Paid_Amount'] + $amount;
        $amount -= $paying;
    }
    
    // If there's money left
    if ($paying > 0) {
        
        array_push($arguments, array(
            'query' => "UPDATE `student_installments` SET `SI_Paid_Amount` = ?, `SI_Paid_Date` = ? WHERE `SI_Ins_NO` = ? AND `SI_Reg_No` =?",
            'bind' => array(
                $paying,
                $RG_Date,
                $r['SI_Ins_NO'],
                $RG_Reg_NO
            )
        ));
        
    }
}


$response           = $helper->MySqlWrapper($arguments);
$response['string'] = "pqrs/StudentPdf.php?reg=9jv4kxpKCUupDPxWbSqC" . base64_encode($RG_Reg_N0);

echo json_encode($response);

/*error capturing*/

$errorCapture = array(
    array(
        'error' => "INSERT INTO `error_log`(`error`, `method`, `operator`, `branch`) VALUES (?,?,?,?)",
        'bind' => array(
            $response['errorInfo'],
            'payment_master',
            $RG_Operator,
            $RG_Branch_Code
        )
    )
);


$helper->errorCapture($errorCapture);


?> 
