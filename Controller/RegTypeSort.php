<?php

$CT_Course_Code="";

if(isset($_GET['CT_Course_Code'])){$CT_Course_Code = $_GET['CT_Course_Code'];} 

include("../Modal/dbLayer.php");
$RegTypeSort = $helper->RegTypeSort($CT_Course_Code);

 echo "<select id='RegType' name='CT_Type_Code' title='please select your Reg Type'>";
 echo "<option value=' '>Select Your Reg Type</option>";

foreach($RegTypeSort  as $key => $value){

       
echo "<option value=".$value->CT_Type_Code.">".$value->CT_Type_Code."</option>";

}
echo "</select>";


?>

