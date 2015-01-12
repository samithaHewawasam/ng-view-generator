<?php
session_start();
include 'dbLayer.php';



$date="";
$reg_n="";
$Receipt_No="";
$comment="";
$amount="";
$credit="";
$c_name="";
$c_no_a="";
$chk="";
$chk_no="";
$due_date="";
$bank="";
$typ="";
$cr_type="";
$cu="";
$rt="";

$operator=@$_SESSION['Sys_U_Name'];
$BranchCode=@$_SESSION['branchCode'];
//$BranchCode='COL/A';
//$operator="User";


if (isset($_POST["PM_Card_Type"])){
$cr_type = $_POST["PM_Card_Type"];
}


if (isset($_POST["curree"])){
$cu = $_POST["curree"];
}


if (isset($_POST["curree1"])){
$rt = $_POST["curree1"];
}

if (isset($_POST["date"])){
$date = $_POST["date"];
}
	
if (isset($_POST["reg_n"])){
$reg_n = $_POST["reg_n"];
}

if (isset($_POST["Receipt_No"])){
$Receipt_No = $_POST["Receipt_No"];
}

if (isset($_POST["comment"])){
$comment = $_POST["comment"];
}

if (isset($_POST["c_name"])){
$c_name = $_POST["c_name"];
}

if (isset($_POST["c_no"])){
$c_no = $_POST["c_no"];
}

if (isset($_POST["cashh"])){
$chk = $_POST["cashh"];
}


if (isset($_POST["p_type"])){
$typ = $_POST["p_type"];
}

if (isset($_POST["chk_no"])){
$chk_no = $_POST["chk_no"];
}

if (isset($_POST["due_date"])){
$due_date = $_POST["due_date"];
}

if (isset($_POST["bank"])){
$bank = $_POST["bank"];
}



if (isset($_POST["c_no1"])){
$cn1 = $_POST["c_no1"];
}
if (isset($_POST["c_no2"])){
$cn2 = $_POST["c_no2"];
}
if (isset($_POST["c_no3"])){
$cn3 = $_POST["c_no3"];
}

$c_no_a = $c_no . $cn1 . $cn2 . $cn3 ;


if($typ=="Cash")
{
	if (isset($_POST["cashh"])){
	$chk = $_POST["cashh"];
	}
}	

elseif($typ=="Credit_Card")
{
	if (isset($_POST["credit"])){
	$chk = $_POST["credit"];
	}
}	
else
{
	if (isset($_POST["chk"])){
	$chk = $_POST["chk"];
	}
}


//--------Assign sessions-----------

$_SESSION['date']             = $date;
$_SESSION['reg_n']			  = $reg_n;
//$_SESSION['Receipt_No']		  = $Receipt_No;
$_SESSION['comment']		  = $comment;
$_SESSION['c_name']			  = $c_name;
$_SESSION['c_no']			  = $c_no;
$_SESSION['p_type']			  = $typ;
$_SESSION['cashh']			  = $chk;
$_SESSION['p_type']			  = $typ;
$_SESSION['chk_no']			  = $chk_no;
$_SESSION['due_date']		  = $due_date;
$_SESSION['bank']			  = $bank;
$_SESSION['crdt_no']		  = $c_no_a;
$_SESSION['curency']		  = $cu;

//$_SESSION['OP_Receipt_No'] = $InvoiceNumber;

//---------Recipt Number Genarater--------------

$lastTotalPaidAmount = $helper->getLastTotalPaid($reg_n);
$getLastInvoiceNumber   = $helper->getLastInvoiceNumber($BranchCode);
$getNumber = explode('-',$getLastInvoiceNumber[0]);
$getbySlash = explode('/',$getNumber[0]);
$newInvoiceNumber       = $getbySlash[0] + 1;
$formattedInvoiceNumber = sprintf('%04d', $newInvoiceNumber);
//list($yy, $mm, $dd) = explode('-', $date);
$getDate= explode('-', $date);
$dateForInvoice = $getDate[1] . "/" . $getDate[0];
$InvoiceNumber = $formattedInvoiceNumber . "/" . $dateForInvoice . "-" . $BranchCode;
$_SESSION['OP_Receipt_No'] = $InvoiceNumber;

//-----------------------------------------

$newInvoiceNumber1       = $getbySlash[0];
$formattedInvoiceNumber1 = sprintf('%04d', $newInvoiceNumber1);

//list($yy, $mm, $dd) = explode('-', $date);
$getDate1= explode('-', $date);
$dateForInvoice1 = $getDate1[1] . "/" . $getDate1[0];
$InvoiceNumber1 = $formattedInvoiceNumber1 . "/" . $dateForInvoice1 . "-" . $BranchCode;

$_SESSION['OP_Receipt_No1'] = $InvoiceNumber1;

//-----------------------------------------

$sqlOtherPayments="INSERT INTO `other_payments` (`OP_Date`,`OP_Receipt_No`,`RG_Reg_No`,`Comment`, `Currency`, `Currency_rate`,  `OP_Amount`,`OP_Type`,`OP_Cheque_NO`,`OP_Cheque_Bank`,`OP_Cheque_Due_Date`,`OP_Card_Holder_Name`,`OP_Card_Type`,`OP_Card_NO`,`OP_Operator`)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$sqlOtherPaymentsValues = array($date, $InvoiceNumber, $reg_n, $comment, $cu, $rt, $chk, $typ, $chk_no, $bank, $due_date, $c_name, $cr_type, $c_no_a, $operator);

$sqlSync = array('query'=>'INSERT INTO `sync_log` (`query`,`data`) VALUES (?,?)','bind'=>array($sqlOtherPayments,serialize($sqlOtherPaymentsValues)));

$arguments = array(array('query'=>$sqlOtherPayments,'bind'=>$sqlOtherPaymentsValues),$sqlSync);

$response = $helper->MySqlWrapper($arguments);

echo json_encode($response);

?>
