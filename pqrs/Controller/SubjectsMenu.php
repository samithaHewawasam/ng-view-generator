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

if(!empty($_POST['C_Code']) && $_POST['C_Code']!='All'){
$C_Code=$_POST['C_Code'];
$BatchSubSql=" AND `course`.`C_Code` ='".$_POST['C_Code']."'";
 $sql="SELECT DISTINCT (`S_CODE`) FROM `subjects`
INNER JOIN `course` ON `subjects`.`C_CODE` = `course`.`C_Code` 
WHERE 1 $BatchSubSql $I_Status ORDER BY `S_CODE` ";
}
elseif(empty($_POST['S_CODE'])){
$sql="SELECT DISTINCT (`S_CODE`) FROM `subjects` ";
}
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$count1=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $row){
//echo '<option value="'.$row['Intake'].'">'.$row['Intake'].'</option>';
$SubjectArray[$row['S_CODE']]='';
}





//$results = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
//echo '<option value="" selected="selected">ALL</option>';
if($count1){


$SubjectArray=array('All'=>'s')+$SubjectArray;

}
else
{
$SubjectArray= array('n'=>'No subjects');
}
echo json_encode($SubjectArray);

?>
