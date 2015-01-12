<?php


$CT_Type_Code ="";

if(isset($_GET['RT_Code'])){$CT_Type_Code = $_GET['RT_Code'];} 

include("../Modal/dbLayer.php");
$courseType = $helper->courseType($CT_Type_Code);
 echo "<select id='CourseSet' name='CT_Course_Code'>";

foreach($courseType  as $key => $value){

       
echo "<option value=".$value->CT_Course_Code.">".$value->CT_Course_Code."</option>";

}
echo "</select>";

?>

