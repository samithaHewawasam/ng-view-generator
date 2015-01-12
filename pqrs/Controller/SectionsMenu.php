<?php  session_start();
	include ("../../Modal/config.php");
	include("../Modal/GenaralFunc.php");
$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
$i=0;
$ResultsFull=array();
$BatchSubSql=null;
$Divisions=$_SESSION['Divisions'];
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$i=0;
$ResultsFull=array();
$Database=null;
if(empty($_POST['S_Status'])){
$I_Status="";
}
else
{
$I_Status=" AND `S_Status`='".$_POST['S_Status']."'";
}

if(!empty($_POST['S_CODE']) && $_POST['S_CODE']!='All'){
$S_CODE=$_POST['S_CODE'];
$BatchSubSql=" AND `subjects`.`S_CODE` ='".$_POST['S_CODE']."'";
$sql="SELECT DISTINCT (`Sec_CODE`) FROM `sections`
INNER JOIN `subjects` ON `sections`.`S_CODE` = `subjects`.`S_CODE` 
WHERE 1 $BatchSubSql $I_Status ";
}
else{
$sql="SELECT DISTINCT (`Sec_CODE`) FROM `sections` ";
}

//echo $sql;
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$count1=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $row){
//echo '<option value="'.$row['Intake'].'">'.$row['Intake'].'</option>';
$SectionsArray[$row['Sec_CODE']]='';
}





//$results = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
//echo '<option value="" selected="selected">ALL</option>';
if($count1){


$SectionsArray=array('All'=>'s')+$SectionsArray;

}
else
{
$SectionsArray= array('n'=>'No sections');
}
echo json_encode($SectionsArray);

?>
