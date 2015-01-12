<?php  session_start();
	include ("../../Modal/config.php");
	include("../Modal/GenaralFunc.php");
$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
$i=0;
$ResultsFull=array();
$DataBase=null;
$Divisions=$_SESSION['Divisions'];
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$i=0;
$ResultsFull=array();
$Database=null;
if(empty($_POST['I_Status'])){
$I_Status=" AND `I_Status`='Active'";
}
else
{
$I_Status=" AND `I_Status`='".$_POST['I_Status']."'";
}

if(!empty($_POST['C_Code']) && $_POST['C_Code']!='All'){
$C_Code=$_POST['C_Code'];
$BatchSubSql=" AND `course`.`C_Code` ='".$_POST['C_Code']."'";
}
else{

if(!empty($_POST['D_Code'])  && $_POST['D_Code']!='All'){
$BatchSubSql=" AND `registration_type`.`D_Code` ='".$_POST['D_Code']."'";
}
elseif($Divisions=='All'){
$BatchSubSql=" ";
}
else
{
$BatchSubSql=" AND `registration_type`.`D_Code` IN('".str_replace(',',"','",$Divisions)."')";
}


}

$sql="SELECT DISTINCT (`Intake`) FROM `intakes`
INNER JOIN `course` ON `intakes`.`C_Code` = `course`.`C_Code` 
INNER JOIN `course_type` ON `course`.`C_Code`=`course_type`.`CT_Course_Code`
INNER JOIN `registration_type` ON `course_type`.`CT_Type_Code`=`registration_type`.`RT_Code` 
WHERE 1 $BatchSubSql $I_Status ORDER BY `Intake` ";


//echo $sql;
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$count1=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
//$results = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
//echo '<option value="" selected="selected">ALL</option>';
if($count1){
foreach($results as $row){
//echo '<option value="'.$row['Intake'].'">'.$row['Intake'].'</option>';
$IntakeArray[$row['Intake']]='';
}
$count=count($IntakeArray);
if($count>1){
}
$IntakeArray=array('All'=>'s')+$IntakeArray;

}
else
{
$IntakeArray= array('n'=>'No Intakes');
}
echo json_encode($IntakeArray);

?>
