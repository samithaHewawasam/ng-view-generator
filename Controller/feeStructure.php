<?php

// begin the session
session_start();

$FS_Reg_Type ="";

if(isset($_GET['FS_Reg_Type'])){$FS_Reg_Type = $_GET['FS_Reg_Type'];} 

include("../Modal/dbLayer.php");

$feeStructure = $helper->feeStructure($FS_Reg_Type);

 echo "<select id='fsCourseSet' name='FS_Code' title='Please select a course'>";
 echo "<option value=' '>Select Your Fee Structure</option>";
foreach($feeStructure as $key => $value){


echo "<option data-installmentsCount=".$value['FS_No_of_Installments']." value=".$value["FS_Code"].">".$value["FS_Code"]."</option>";

}
echo "</select>";

?>


