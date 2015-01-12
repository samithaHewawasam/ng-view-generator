<?php
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
	
	
		
		
/*
   $Styles='<style type="text/css">
.
@media print {
    p {page-break-after: always;}
}
</style>';
	
	require_once("../Library/php/dompdf/dompdf_config.inc.php");

 // if ( get_magic_quotes_gpc() ){
    $content = '<h1>hellow world</h1><p>1</p><h1>hellow world</h1><p>1</p><h1>hellow world</h1><p>1</p>';
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($Styles.$content);
  $dompdf->set_paper('a4','portrait');
  $dompdf->render();

  $dompdf->stream("test.pdf", array("Attachment" => false));

  exit(0);
//}
*/
require_once("../Library/php/fpdf/fpdf.php");
//$pdf = new FPDF('P','mm','A4');
class PDF extends FPDF
{
// Page header

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function ImprovedTable( $data)
{
$header = array('Ins.No', 'Amount', 'Due Date', 'Paid Amount', 'Paid Date', 'New Amount', 'New Date');
    // Column widths
    $w = array(11, 23, 30, 23,30,23,30);
    // Header
	$this->SetXY(20, 88);
    for($i=0;$i<count($header);$i++){
        $this->Cell($w[$i],5,$header[$i],1,0,'C');
		}
    $this->Ln();
	$h=89;
    // Data
	$this->SetFont('Arial','',8);
    foreach($data as $key=>$row)
    {   $this->SetXY(20, ($h+=4));
        $this->Cell($w[0],4,$row['SI_Ins_NO'],'1');
        $this->Cell($w[1],4,$row['SI_Ins_Amount'],'1',0,'R');
        $this->Cell($w[2],4,($row['SI_Due_Date']),'1',0,'C');
        $this->Cell($w[3],4,($row['SI_Paid_Amount']),'1',0,'R');
        $this->Cell($w[4],4,($row['SI_Paid_Date']=='0000-00-00'?'':$row['SI_Paid_Date']),'1',0,'C');
        $this->Cell($w[5],4,(''),'1',0,'R');
        $this->Cell($w[6],4,(''),'1',0,'C');
        $this->Ln();
    }
	$CC=count($data);
	if($CC>=25){$c=(31-$CC);}else{$c=4;}
	//echo $c.'<br />';
	    for($i=0;$i<$c;$i++){
      $this->SetXY(20, ($h+=4));
        $this->Cell($w[0],4,'','1');
        $this->Cell($w[1],4,'','1',0,'R');
        $this->Cell($w[2],4,'','1',0,'C');
        $this->Cell($w[3],4,'','1',0,'R');
        $this->Cell($w[4],4,'','1',0,'C');
        $this->Cell($w[5],4,'','1',0,'R');
        $this->Cell($w[6],4,'','1',0,'C');
        $this->Ln();
    }
    // Closing line
	//$this->SetXY(20, ($h+=6));
    //$this->Cell(array_sum($w),0,'','T');
}

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(0);
$DataBase='esoftcar_col';
$esoftConfig->query(' USE esoftcar_col');
$BigSql="SELECT r.Rg_Reg_No REG,BM_Course_Code COURSE,Sm_Full_Name NAME,SM_Tel_Residance LAND,SM_Tell_Mobile MOBILE ,(SELECT (SUM(SI_Ins_Amount)- SUM(SI_Paid_Amount)) S FROM student_installments WHERE Si_Reg_No = r.Rg_Reg_No HAVING S > 0 ) D,(SELECT (SUM(SI_Ins_Amount)- SUM(SI_Paid_Amount)) S FROM student_installments WHERE Si_Reg_No = r.Rg_Reg_No AND SI_Due_Date <= CURDATE() HAVING S > 0 ) U,(SELECT MAX(PM_Date) FROM `payments_master` WHERE `payments_master`.RG_Reg_No = r.Rg_Reg_No) P FROM `registrations` r LEFT JOIN `batch_master` ON r.`Default_Batch` = `batch_master`.`BM_Batch_Code` LEFT JOIN `student_master` ON `student_master`.`SM_ID` = r.`RG_Stu_ID` WHERE (BM_Course_Code LIKE '%HND-BM%'OR BM_Course_Code LIKE '%HND-COM%' OR BM_Course_Code LIKE '%LMU%' OR BM_Course_Code LIKE '%BIT-PLUS%' ) AND RG_Status = 'Active' AND Bm_Status = 'Active' HAVING D IS NOT NULL AND P NOT BETWEEN '2014-06-01' AND '2014-07-01' ";

		$Bigstmt=$esoftConfig->prepare($BigSql);
		
		$Bigstmt->execute();
		$Bigresults=$Bigstmt->fetchAll(PDO::FETCH_ASSOC);
foreach($Bigresults as $BigRow){

	$insSqlMain="SELECT * FROM $DataBase.`student_installments` WHERE SI_Reg_No=?";

 $SqlMain = "SELECT `registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`registrations`.`RG_Final_Fee`,`registrations`.`RG_Total_Paid`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`student_master`.`SM_Date_of_Birth`,`student_master`.`SM_Tell_Mobile`,`student_master`.`SM_Tel_Residance`,`student_master`.`SM_Mail_Personal`,`student_master`.`SM_Parent_Phone`,`student_master`.`SM_House_NO`,`student_master`.`SM_Lane`,`student_master`.`SM_Town`,`student_master`.`SM_City`,`batch_master`.`BM_Course_Code` FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code` WHERE `registrations`.`RG_Reg_NO`='".$BigRow['REG']."' ";

		$stmt=$esoftConfig->prepare($SqlMain);
		
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		

foreach($results as $row){

$StudentAddress=$row['SM_House_NO'].(!empty($row['SM_Lane'])? ', '.$row['SM_Lane']:'').(!empty($row['SM_Town'])? ', '.$row['SM_Town']:'').(!empty($row['SM_City'])? ', '.$row['SM_City']:'');

$tel=$row['SM_Tell_Mobile'].(!empty($row['SM_Tel_Residance'])? ' / '.$row['SM_Tel_Residance']:'');

$pdf->AddPage();
$pdf->SetFont('Arial','',14);
//$pdf->Text(20, 20, "[MR. Harindu Upendra] 's registration verification who is doing [HND-BM] under the [COL/A-000923] Registration Number ");
$pdf->SetXY(20, 10);
$pdf->MultiCell(170, 5, $row['SM_Title']." ".$row['SM_First_Name']." ".$row['SM_Last_Name']."'s registration verification who is doing ".$row['BM_Course_Code']." under the ".$row['RG_Reg_NO']." Registration Number ",'B');
//$pdf->Write(5,"[MR. Harindu Upendra] 's registration verification who is doing [HND-BM] under the [COL/A-000923] Registration Number ");
//$pdf->Line(20, 28, 100, 28);
$pdf->SetFont('Arial','B',11);
$pdf->Text(20, 30, "Title");
$pdf->Text(60, 30, ": ". $row['SM_Title']);
$pdf->Text(20, 35, "First Name");
$pdf->Text(60, 35, ": ". $row['SM_First_Name']);
$pdf->Text(20, 40, "Last Name");
$pdf->Text(60, 40, ": ". $row['SM_Last_Name']);
$pdf->Text(20, 45, "Birth day");
$pdf->Text(60, 45, ": ". $row['SM_Date_of_Birth']);
$pdf->Text(20, 50, "ID No");
$pdf->Text(60, 50, ": ". $row['SM_ID']);
$pdf->Text(20, 55, "Address");
$pdf->Text(60, 55,  ": ". $StudentAddress);
$pdf->Text(20, 60, "Mobile No");
$pdf->Text(60, 60, ": ". $tel);
$pdf->Text(20, 65, "Email");
$pdf->Text(60, 65, ": ". $row['SM_Mail_Personal']);

$pdf->Text(20, 70, "Batch No");
$pdf->Text(60, 70, ": ". $row['Default_Batch']);
$pdf->Text(20, 75, "Final fee");
$pdf->Text(60, 75, ": ". $row['RG_Final_Fee']);
$pdf->Text(20, 80, "Total paid");
$pdf->Text(60, 80, ": ". $row['RG_Total_Paid']);
$pdf->Text(20, 87, "Installments Plan");


		$insstmt=$esoftConfig->prepare($insSqlMain);
		$insstmt->execute(array($row['RG_Reg_NO']));
		$insresults=$insstmt->fetchAll(PDO::FETCH_ASSOC);
$pdf->ImprovedTable($insresults);

$pdf->SetFont('Arial','',11);

$pdf->SetXY(20, 225);

$pdf->MultiCell(170, 5, "I hereby declare that the above particulars provided by me are accurate to the best of my knowledge. Yours Truly");
$pdf->Text(73, 245, "-------------------");
$pdf->Text(70, 250, "Student Signature");
$pdf->Text(130, 245, "-------------------");
$pdf->Text(137, 250, "Date");
$pdf->SetFont('Arial','I',11);

$pdf->Text(20, 258, "office use only.");
$pdf->Line(15, 259, 195, 259);
$pdf->Line(15, 259, 15, 283);
$pdf->Line(15, 283, 195, 283);
$pdf->Line(195, 259, 195, 283);
$pdf->SetFont('Arial','',11);

$pdf->Text(20, 275, "-------------------");
$pdf->Text(20, 280, "Authorized by");
$pdf->Text(94, 275, "-------------------");
$pdf->Text(94, 280, "Verified by by");
$pdf->Text(165, 275, "-------------------");
$pdf->Text(173, 280, "Date");

}

}

$pdf->Output();

?>
