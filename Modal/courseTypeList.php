<?php
$branch = $_SESSION['branchCode'];
$CourseTypeList = $helper->CourseTypeList(substr($branch, 0, 3));

 echo "<select id='CouserFinder' name='CT_Course_Code'>";
 echo "<option value=' '>Select Your Course</option>";

foreach($CourseTypeList  as $key => $value){


echo "<option data-ins-method=".$value->C_Ins_Method." value=".$value->C_Code.">".$value->C_Code."</option>";

}
echo "</select>";

?>

