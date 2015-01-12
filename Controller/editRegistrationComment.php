<?php
error_reporting(0);

$regEditComment		='';
$RG_Status		="";
$RG_Reg_NO		='';

if(isset($_GET['regEditComment'])){$regEditComment  = $_GET['regEditComment'];} 
if(isset($_GET['RG_Status'])){$RG_Status  = $_GET['RG_Status'];} 
if(isset($_GET['RG_Reg_NO'])){$RG_Reg_NO  = $_GET['RG_Reg_NO'];} 

include("../Modal/dbLayer.php");

$responce = $helper->updateRegEditComment($regEditComment,$RG_Status,$RG_Reg_NO);



?>
