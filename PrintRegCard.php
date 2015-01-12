<?php session_start();
include("../library/fpdf/fpdf.php");
include("../Modal/SysSettings.php");
include("../Modal/config.php");
$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
if(!empty($_GET['RegNo']))
{
$RegNo=$_GET['RegNo'];
//Find Registration Details
$sqlRegDetails="SELECT  `registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`registrations`.`RG_Stu_ID`,`registrations`.`RG_Final_Fee`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name`,`course_type`.`CT_Course_Code` FROM `registrations` INNER JOIN `student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID` INNER JOIN `course_type` ON `registrations`.`RG_Reg_Type`=`course_type`.`CT_Type_Code`  WHERE `RG_Reg_NO`='$RegNo'";
$sthRegDetails=$esoftConfig->prepare($sqlRegDetails);
$sthRegDetails->execute();
if($sthRegDetails->rowCount()){

$RegDetailsArray=$sthRegDetails->fetchAll(PDO::FETCH_ASSOC);
//Make Subject Array
$sqlSubject="SELECT `SS_Subject` FROM `student_subjects` WHERE `SS_REG_NO`='$RegNo'";
$sthSubject=$esoftConfig->prepare($sqlSubject);
$sthSubject->execute();
$subjectsArray=$sthSubject->fetchAll(PDO::FETCH_NUM);
//Make Installment Array
$sqlInstallment="SELECT `SI_Ins_NO`,`SI_Due_Date`,`SI_Ins_Amount` FROM `student_installments` WHERE `SI_Reg_No`='$RegNo'";
$sthInstallment=$esoftConfig->prepare($sqlInstallment);
$sthInstallment->execute();
$InstallmentArray=$sthInstallment->fetchAll(PDO::FETCH_NUM);

//var_dump($RegDetailsArray);
//exit;


$Course=$RegDetailsArray[0]['CT_Course_Code'];
$Batch=$RegDetailsArray[0]['Default_Batch'];
$RegNo=$RegDetailsArray[0]['RG_Reg_NO'];
$Name1=$RegDetailsArray[0]['SM_Title'].' '.$RegDetailsArray[0]['SM_First_Name'];
$Name2=$RegDetailsArray[0]['SM_Last_Name'];
$NIC=$RegDetailsArray[0]['RG_Stu_ID'];
$CourseFee=$RegDetailsArray[0]['RG_Final_Fee'];

//include("../library/php/fpdf/fpdf.php");
$pdf = new FPDF('L','mm',array(235,105));
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(0);
$pdf->AddPage();
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetFont('Arial','',11);
$pdf->SetXY(20,9);
//1st row
$pdf->Cell(40,5, $BranchName,0,0,'L');
$pdf->SetXY(3, 21); 
//2nd row
//$pdf->Cell(24,5, $Course,0,0,'L');
$pdf->Cell(24,5, $Batch,0,0,'L');
$pdf->SetXY(34, 25); 
$pdf->Cell(24,5, $RegNo,0,0,'R');
//3rd row with two name rows
$pdf->SetXY(20,34);
$pdf->Cell(55,5, $Name1,0,0,'L');
$pdf->SetXY(20,41);
$pdf->Cell(55,5, $Name2,0,0,'L');
$pdf->SetXY(20,52);
//4th row for NIC
$pdf->Cell(30,5, $NIC,0,0,'L');
$pdf->SetXY(24,61);
//5th row for Course fee
$pdf->Cell(40,5, $CourseFee,0,0,'L');
//6th row for Subjects..
$pdf->SetFont('Arial','',9);
$pdf->SetXY(6,77);

    // Data
	array_unshift($subjectsArray,'reinex');
	unset($subjectsArray[0]);
	$count=count($subjectsArray);
	($count>12)?$count=12 : $count;
	$h=77;
    for($i=1;$i<$count;$i++)
    {  
	 
            $pdf->Cell(24,5,substr($subjectsArray[$i][0],0,13),0);
			  if($i % 3 ==0) {
			  //$pdf->Ln();
			  $pdf->SetXY(6,$h+=9);

			  }
       
}


	//array_unshift($InstallmentArray,'reinex');
	//unset($InstallmentArray[0]);
	 $count2=count($InstallmentArray);
	($count2>30)?$count2=30 : $count2;
	$h2=74;$h3=5;
    for($i=0;$i<$count2;$i++)
    {  
			  if($i>6) {$pdf->SetXY(177,$h3+=3.5);}else{$pdf->SetXY(89,$h2+=3.5);}
			  
        $pdf->Cell(9,4,$InstallmentArray[$i][0],0,0,'C');
        $pdf->Cell(29,4,$InstallmentArray[$i][1],0,0,'C');
        $pdf->Cell(20,4,$InstallmentArray[$i][2],0,0,'R');
}

$pdf->Output();
}
else
{
echo '<h3>Can\'nt Find Registration</h3>';

}
}
?>
