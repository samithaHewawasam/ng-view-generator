<?php session_start();
include("../library/fpdf/fpdf.php");
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
$AmountinEnglish =  convert_number_to_words($_SESSION['PM_Amount']) .' only'; 

//$pdf = new PDF();
// Column headings
$pdf = new FPDF('L','mm',array(127,105));

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,10, '',0,1,'L');
$pdf->Cell(2,8, '',0,0,'L');
$pdf->Cell(30,8, $_SESSION['RG_Branch_Code'],0,0,'L');
$pdf->Cell(26,8, '',0,0,'L');
$pdf->Cell(40,8, $_SESSION['PM_Receipt_No'],0,1,'L');
$pdf->Cell(1,8, '',0,0,'L');
$pdf->Cell(30,11, $_SESSION['RG_Date'],0,0,'L');
$pdf->Cell(26,8, '',0,0,'L');
$pdf->Cell(40,11, $_SESSION['RG_Reg_N0'],0,1,'L');
//$pdf->Cell(100,4, '',0,1,'L');
$pdf->Cell(10,13, '',0,0,'L');
$pdf->Cell(100,13, $_SESSION['registerUserForPrint'],0,1,'L' ); 
$pdf->Cell(1,8, '',0,0,'L'); 
$pdf->Cell(100,8, strtoupper($AmountinEnglish),0,1,'L');
$pdf->Cell(14,10, '',0,0,'L'); 
$pdf->Cell(60,10, $_SESSION['selectedBatchForPrint'],0,1,'L');
$pdf->Cell(20,9, '',0,0,'L'); 
$pdf->Cell(60,9, $_SESSION['PM_Type'],0,1,'L');
$pdf->Cell(100,4, '',0,1,'L');
$pdf->Cell(1,12, '',0,0,'L'); 
$pdf->Cell(60,12, $_SESSION['Sys_U_Name'],0,0,'L');
$pdf->Cell(1,12, '',0,0,'L');
$pdf->Cell(30,12,number_format($_SESSION['PM_Amount'],2)."/=",0,1,'L');
$pdf->Output();



?>
