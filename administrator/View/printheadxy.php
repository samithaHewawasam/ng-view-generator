<?php session_start();
//$_POST['PM_Receipt_No']='PAN/A-1445/12/2013';
if(!empty($_GET['PM_Receipt_No']))
{
$PM_Receipt_No=trim($_GET['PM_Receipt_No']);

include("../../library/fpdf/fpdf.php");
include("../../Modal/SysSettings.php");
include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
///function to convert numbers
function convert_number_to_words($number) {
   
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' ';
    $dictionary  = array(
        0                   => '',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
    return $string;
}
//Find Registration Details
$IDArray=explode('-',$PM_Receipt_No);
if(strlen($IDArray[0])==5){
$P='PM';

$sqlRegDetails="SELECT  `payments_master`.`PM_Amount`,`payments_master`.`PM_Type`,`payments_master`.`PM_Date`,`payments_master`.`RG_Reg_No`,`registrations`.`Default_Batch`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name` FROM
`payments_master` INNER JOIN `registrations` ON `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO`
 INNER JOIN `student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`  WHERE `PM_Receipt_No`='$PM_Receipt_No'";
 }
else
{
$P='OP';

$sqlRegDetails="SELECT  
`other_payments`.`OP_Receipt_No` AS `PM_Receipt_No`,
`other_payments`.`OP_Date`  AS `PM_Date`,
`other_payments`.`OP_Amount` AS `PM_Amount`,
`other_payments`.`Currency`,
`other_payments`.`Comment`,
`other_payments`.`OP_Type` AS `PM_Type`,
`other_payments`.`Currency_rate`,
`other_payments`.`RG_Reg_No` ,
`registrations`.`Default_Batch`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name` FROM
`other_payments` 
LEFT JOIN `registrations` ON `other_payments`.`RG_Reg_No`=`registrations`.`RG_Reg_NO`
LEFT JOIN `student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`  WHERE `OP_Receipt_No`='$PM_Receipt_No'";

}

$sthRegDetails=$esoftConfig->prepare($sqlRegDetails);
$sthRegDetails->execute();
$RegDetailsArray=$sthRegDetails->fetchAll(PDO::FETCH_ASSOC);
if($sthRegDetails->rowCount()){
//var_dump($RegDetailsArray);

$PM_Amount=$RegDetailsArray[0]['PM_Amount'];
$AmountinEnglish =   strtoupper(convert_number_to_words($PM_Amount) .' only'); 
$Comment=null;
if($P=='OP'){
$Comment='('.$RegDetailsArray[0]['Comment'].')';
}
$PM_Type=$RegDetailsArray[0]['PM_Type'];
$PM_Date=$RegDetailsArray[0]['PM_Date'];
$Batch=$RegDetailsArray[0]['Default_Batch'];
$RegNo=$RegDetailsArray[0]['RG_Reg_No'];
$Name1=$RegDetailsArray[0]['SM_Title'].' '.$RegDetailsArray[0]['SM_First_Name'].' '.$RegDetailsArray[0]['SM_Last_Name'];

$pdf = new FPDF('L','mm',array(127,105));
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(0);
$pdf->AddPage();
$pdf->SetAutoPageBreak(false, 0);
if($PrintHeader=='Yes'){
$pdf->SetFont('Arial','',11);
$pdf->SetXY(37,0);
$pdf->Cell(50,4, $BranchName,0,0,'L');
$pdf->SetFont('Arial','',9);
$pdf->SetXY(37,6);
$pdf->Cell(90,4, $OfficeAddress,0,0,'L');
$pdf->SetXY(37,10);
if(!empty($OfficeFax)){$OfficeFax=' Fax:'.$OfficeFax;}
$pdf->Cell(100,4,'Tel:'.$OfficeTelephone.$OfficeFax,0,0,'L');
$pdf->SetXY(37,14);
$pdf->Cell(100,4,  $OfficeEmail.' '.' '.$OfficeWebSite,0,0,'L');
}
$pdf->SetFont('Arial','',10);
$pdf->SetXY(15,22);
$pdf->Cell(30,5, $_SESSION['branchCode'],0,0,'L');
$pdf->SetXY(73,22);
$pdf->Cell(40,5, $PM_Receipt_No,0,0,'L');
$pdf->SetXY(13,31);
$pdf->Cell(30,5, $PM_Date,0,0,'L');
$pdf->SetXY(69,31);
$pdf->Cell(40,5, $RegNo,0,0,'L');
$pdf->SetXY(10,44);
$pdf->Cell(100,5, $Name1,0,0,'L' ); 
$pdf->SetXY(5,55);
$pdf->Cell(100,5,$AmountinEnglish,0,0,'L');
$pdf->SetXY(26,62);
$pdf->Cell(60,5, $Batch,0,0,'L');
$pdf->SetXY(30,74);
$pdf->Cell(60,5, $PM_Type,0,0,'L');
$pdf->SetXY(40,74);
$pdf->Cell(60,5, $Comment,0,0,'L');
$pdf->SetXY(1,95);
$pdf->Cell(60,4, $_SESSION['Sys_U_Name'],0,0,'L');
$pdf->SetXY(70,91);
$pdf->Cell(30,5, $PM_Amount."/=",0,0,'L');
$pdf->Output();
}
else
{
echo 'Can\'t Find Invoice';

}

}
?>
