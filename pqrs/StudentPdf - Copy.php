<?php session_start();
 include("Controller/LogController.php");

	include ("../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
	$ResultTable='';
	$DataBase='';
	$DBprefix='`esoftcar_' ;//use back tic (`)
    $DBsuffix='`' ;//use back tic (`)
if(!empty($_GET['string']))	
{	
$String64=base64_decode($_GET['string']);		
$_POST=unserialize($String64);		

$bA=explode('---',$_POST['BranchCode']);
$_POST['SelectedBranch'][$bA[1]]=$bA[0];
$RegBranch=substr($bA[1],0,-2);
$DataBase = $DBprefix. strtolower($bA[1]).$DBsuffix;

$DateTable=" `registrations`.`RG_Date` ";
include('Controller/SearchPostPart.php');
 $FirstRangeWhere = $Where.$RGStatusPart.$DivisionPart.$BatchPart. $BatchStatusPart.$CoursPart.$IntakePart; 
 
}
elseif(!empty($_GET['reg'])){
$reg=base64_decode(substr($_GET['reg'],20));
$RegBranch=substr($reg,0,3);
$FirstRangeWhere="WHERE `registrations`.`RG_Reg_NO`=?";
$DataBase = $DBprefix. strtolower($RegBranch).$DBsuffix;
$BindData=array($reg);
 if (strpos(DATABASE,'-')) {
 $DataBase='`'.DATABASE.'`';
} 


}
else
{
exit;
}

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
require_once("Library/php/fpdf/fpdf.php");
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
//$header = array('Ins.No', 'Amount', 'Due Date', 'Paid Amount', 'Paid Date', 'New Amount', 'New Date');

$header = array('Ins.No', 'Amount', 'Due Date');
    // Column widths
//$w = array(11, 23, 30, 23,30,23,30);
    $w = array(11, 23, 30, 23);
    // Header
	$this->SetXY(20, 102);
    for($i=0;$i<count($header);$i++){
        $this->Cell($w[$i],5,$header[$i],1,0,'C');
		}
    $this->Ln();
	$h=103;
    // Data
		$CC=count($data);

	$this->SetFont('Arial','',8);
	if($CC){
    foreach($data as $key=>$row)
    {   $this->SetXY(20, ($h+=4));
        $this->Cell($w[0],4,$row['SI_Ins_NO'],'1');
        $this->Cell($w[1],4,$row['SI_Ins_Amount'],'1',0,'R');
        $this->Cell($w[2],4,($row['SI_Due_Date']),'1',0,'C');
       // $this->Cell($w[3],4,($row['SI_Paid_Amount']),'1',0,'R');
       // $this->Cell($w[4],4,($row['SI_Paid_Date']=='0000-00-00'?'':$row['SI_Paid_Date']),'1',0,'C');
        //$this->Cell($w[5],4,(''),'1',0,'R');
       // $this->Cell($w[6],4,(''),'1',0,'C');
        $this->Ln();
    }
	}
	if(1==2){
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
	}
    // Closing line
	//$this->SetXY(20, ($h+=6));
    //$this->Cell(array_sum($w),0,'','T');
}

}

// Instanciation of inherited class
$stmt=$esoftConfig->prepare("SELECT * FROM `branches` WHERE `B_CODE`=? ");
$stmt->execute(array($RegBranch));
$branchResult=$stmt->fetchAll(PDO::FETCH_ASSOC);
$Address=null;
$Tel=null;
$mail=null;
$web=null;
if(count($branchResult)){
$Address=(!empty($branchResult[0]['B_Address'])?$branchResult[0]['B_Address']:'');	
$Tel=(!empty($branchResult[0]['B_Tel'])?"TP : ".$branchResult[0]['B_Tel']:'');
$mail=(!empty($branchResult[0]['B_Email'])? "Email : ".$branchResult[0]['B_Email']:'');	
$web=(!empty($branchResult[0]['B_Address'])?' '.' web : www.esoft.lk':'');	
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(0);


	$insSqlMain="SELECT * FROM $DataBase.`student_installments` WHERE SI_Reg_No=?";

 $SqlMain = "SELECT `registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`registrations`.`RG_Final_Fee`,`registrations`.`RG_Total_Paid`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`student_master`.`SM_Date_of_Birth`,`student_master`.`SM_Tell_Mobile`,`student_master`.`SM_Tel_Residance`,`student_master`.`SM_Mail_Personal`,`student_master`.`SM_Parent_Phone`,`student_master`.`SM_House_NO`,`student_master`.`SM_Lane`,`student_master`.`SM_Town`,`student_master`.`SM_City`,`batch_master`.`BM_Course_Code`,`batch_master`.`BM_End_Date`,(SELECT MAX(PM_Date) 
   FROM $DataBase.`payments_master`
   WHERE RG_Reg_NO = `registrations`.RG_Reg_NO) AS MaxPDate FROM $DataBase.`registrations`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
		$stmt=$esoftConfig->prepare($SqlMain.$FirstRangeWhere);
		
		$stmt->execute($BindData);
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row){

$StudentAddress=$row['SM_House_NO'].(!empty($row['SM_Lane'])? ', '.$row['SM_Lane']:'').(!empty($row['SM_Town'])? ', '.$row['SM_Town']:'').(!empty($row['SM_City'])? ', '.$row['SM_City']:'');

$tel=$row['SM_Tell_Mobile'].(!empty($row['SM_Tel_Residance'])? ' / '.$row['SM_Tel_Residance']:'');

$pdf->AddPage();
$pdf->SetFont('Arial','',8);
//$pdf->Text(20, 20, "[MR. Harindu Upendra] 's registration verification who is doing [HND-BM] under the [COL/A-000923] Registration Number ");
$pdf->Image('Library/img/logo.png',10,5,30,14);
$pdf->Text(50, 9, $Address);
$pdf->Text(50, 13, $Tel);
$pdf->Text(50, 17, $mail.$web);
$pdf->Line(5, 20, 205, 20);

$pdf->SetFont('Arial','B',12);
$pdf->SetXY(70, 23);

$pdf->MultiCell(70, 4, "Student Installments Agreement ",'B','C');
$pdf->SetFont('Arial','B',10);
//$pdf->Write(5,"[MR. Harindu Upendra] 's registration verification who is doing [HND-BM] under the [COL/A-000923] Registration Number ");
//$pdf->Line(20, 28, 100, 28);
$pdf->Text(20, 35, "Reg. No");
$pdf->Text(60, 35, ": ". $row['RG_Reg_NO']);
$pdf->Text(20, 40, "Course");
$pdf->Text(60, 40, ": ". $row['BM_Course_Code']);
$pdf->Text(20, 45, "Title");
$pdf->Text(60, 45, ": ". $row['SM_Title']);
$pdf->Text(20, 50, "First Name");
$pdf->Text(60, 50, ": ". $row['SM_First_Name']);
$pdf->Text(20, 55, "Last Name");
$pdf->Text(60, 55, ": ". $row['SM_Last_Name']);
$pdf->SetXY(110, 45);
$pdf->MultiCell(55, 4, "Certificates will be issued under this name.");
$pdf->Image('Library/img/bracket.png',105,42,5,15);

$pdf->Text(20, 60, "Birth day");
$pdf->Text(60, 60, ": ". $row['SM_Date_of_Birth']);
$pdf->Text(20, 65, "ID No");
$pdf->Text(60, 65, ": ". $row['SM_ID']);
$pdf->Text(20, 70, "Address");
$pdf->Text(60, 70,  ": ". $StudentAddress);
$pdf->Text(20, 75, "Mobile No");
$pdf->Text(60, 75, ": ". $tel);
$pdf->Text(20, 80, "Email");
$pdf->Text(60, 80, ": ". $row['SM_Mail_Personal']);

$pdf->Text(20, 85, "Batch No");
$pdf->Text(60, 85, ": ". $row['Default_Batch']." [ Completion Date :".$row['BM_End_Date']."]");
$pdf->Text(20, 90, "Final fee");
$pdf->Text(60, 90, ": ". number_format($row['RG_Final_Fee'],2));
$pdf->Text(20, 95, "Total paid");
$pdf->Text(60, 95, ": ". number_format($row['RG_Total_Paid'],2)." as at ".$row['MaxPDate']);
$pdf->Text(20, 100, "Installments Plan");


		$insstmt=$esoftConfig->prepare($insSqlMain);
		$insstmt->execute(array($row['RG_Reg_NO']));
		$insresults=$insstmt->fetchAll(PDO::FETCH_ASSOC);
				
$pdf->ImprovedTable($insresults);

$pdf->SetFont('Arial','',10);

$pdf->SetXY(20, 225);

$pdf->MultiCell(170, 5, "I hereby declare that the above particulars provided by me are accurate to the best of my knowledge. I also agree that the above payment plan has been discussed and agreed, and I will adhere to do it.");
$pdf->Text(73, 245, "-------------------");
$pdf->Text(70, 250, "Student Signature");
$pdf->Text(130, 245, "-------------------");
$pdf->Text(137, 250, "Date");
$pdf->SetFont('Arial','I',10);

$pdf->Text(20, 258, "office use only.");
$pdf->Line(15, 259, 195, 259);
$pdf->Line(15, 259, 15, 283);
$pdf->Line(15, 283, 195, 283);
$pdf->Line(195, 259, 195, 283);
$pdf->SetFont('Arial','',10);

$pdf->Text(20, 275, "-------------------");
$pdf->Text(20, 280, "Authorized by");
$pdf->Text(94, 275, "-------------------");
$pdf->Text(94, 280, "Verified by");
$pdf->Text(165, 275, "-------------------");
$pdf->Text(173, 280, "Date");

}



$pdf->Output();
?>
