<?php

$CT_Type_Code ="";
$BM_Course_Code ="";


if(isset($_GET['CT_Type_Code'])){$CT_Type_Code = $_GET['CT_Type_Code'];}
if(isset($_GET['CT_Course_Code'])){$BM_Course_Code = $_GET['CT_Course_Code'];} 
 

include("../Modal/dbLayer.php");
$batchMasterSet = $helper->batchMasterSet($BM_Course_Code);
$CTNoOfSubjects = $helper->CTNoOfSubjects($CT_Type_Code,$BM_Course_Code);

 echo "<select id='alreadyBatchSorting' name='BM_Course_Code'>";
 echo "<option>Select Your Batch</option>";

$null = NULL;

foreach($batchMasterSet  as $key => $value){
       
echo "<option data-schedules= '".$value->schedules."' data-Commence-Date=".$value->BM_Commence_Date." data-End-Date=".$value->BM_End_Date." data-Ins-Days=".$value->BM_Ins_Days." value=".$value->Bm_Batch_Code.">".$value->Bm_Batch_Code."</option>";

}
echo "</select>"; 
echo "<input type='hidden' value=".$CTNoOfSubjects[0]." name='CT_No_Of_SubjectsCount' id='CT_No_Of_SubjectsCount'>";
?>

