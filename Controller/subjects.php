<?php
header("Content-type: application/json");

$C_Code ='';

if(isset($_GET['CT_Course_Code'])){$C_Code = $_GET['CT_Course_Code'];} 

include("../Modal/dbLayer.php");

$subjectsSet = $helper->subjectsSet($C_Code);
echo json_encode($subjectsSet);


?>
