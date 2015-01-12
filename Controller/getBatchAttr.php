<?php
header("Content-type: application/json");
error_reporting(0);

$BM_Course_Code ="";

if(isset($_GET['BM_Course_Code'])){$BM_Course_Code = $_GET['BM_Course_Code'];}

include("../Modal/dbLayer.php");

$batch = $helper->getBatchAttr($BM_Course_Code);

echo json_encode($batch[0]);

?>


