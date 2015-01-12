<?php  session_start();
	include ("../../Modal/config.php");
	include("../Modal/GenaralFunc.php");
$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$i=0;
$ResultsFull=array();
$Database=null;
if(empty($_SESSION['Divisions'])){
$_SESSION['Divisions']='All';
}
$Divisions=$_SESSION['Divisions'];

if($Divisions=='All'){
$sql="SELECT `division`.`D_Code` FROM `division` WHERE `D_Status`='Active' ORDER BY `D_Code`";
}
else
{

$sql="SELECT `division`.`D_Code` FROM `division` WHERE `D_Status`='Active' AND `D_Code` IN ('".str_replace(',',"','",$Divisions)."') ORDER BY `D_Code`";
}




$sth = $esoftConfig->prepare($sql);
$sth->execute();
$count1=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
//$results = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
//echo '<option value="" selected="selected">ALL</option>';
if($count1){

foreach($results as $row){
//echo '<option value="'.$row['D_Code'].'">'.$row['D_Code'].'</option>';
$DivisionsArray[$row['D_Code']]='';

}
$count=count($DivisionsArray);
if($count>1){
$DivisionsArray=array('All'=>'s')+$DivisionsArray;
}
}
else
{

$DivisionsArray= array('n'=>'No Divisions');
}
echo json_encode($DivisionsArray);



?>
