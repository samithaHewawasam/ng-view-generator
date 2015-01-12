<?php  session_start();
	include ("../../Modal/config.php");
$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
 if (!strpos(DATABASE,'-')) {
$HostType='Online';
}
else
{
$HostType='Local';
}
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$i=0;
$ResultsFull=array();
$Database=null;
if(empty($_POST['SelectedBranch'])){
if(!empty($_SESSION['Sys_U_Branches'])){
$BranchesArray=explode(',',$_SESSION['Sys_U_Branches']);
}
else
{
$D=explode('_',DATABASE);
$Code=strtolower(str_replace('/','-',$D[1]));
$BranchesArray=explode(',',$Code);
}
$BranchesArray=array_combine($BranchesArray,$BranchesArray);


}
else
{
$BranchesArray=$_POST['SelectedBranch'];
}
if(@$_SESSION['Courses']!='All' && $HostType=='Online'){
$Courses=$_SESSION['Courses'];
$courseArray=array_flip(explode(',',$Courses));
}
else
{
foreach($BranchesArray as  $key=>$val){
$Database = $DBprefix.(strtolower($key)).$DBsuffix;

if(!empty($_POST['D_Code']) && $_POST['D_Code']!='All'){
$D_Code=$_POST['D_Code'];
$sql="SELECT `course`.`C_Code` FROM $Database.`course` INNER JOIN $Database.`course_type` ON `course`.`C_Code`=`course_type`.`CT_Course_Code` 
INNER JOIN $Database.`registration_type` ON `course_type`.`CT_Type_Code`=`registration_type`.`RT_Code` WHERE `C_Status`='Active'  AND `registration_type`.`D_Code`='$D_Code'    ORDER BY `course`.`C_Name`";
}
elseif(@($_SESSION['Divisions'])!='All'){
$D_Code=$_SESSION['Divisions'];
$sql="SELECT `course`.`C_Code` FROM $Database.`course` INNER JOIN $Database.`course_type` ON `course`.`C_Code`=`course_type`.`CT_Course_Code`
INNER JOIN $Database.`registration_type` ON `course_type`.`CT_Type_Code`=`registration_type`.`RT_Code` WHERE `C_Status`='Active'  AND `registration_type`.`D_Code` IN ('".str_replace(',',"','",$D_Code)."')    ORDER BY `course`.`C_Name`";
}

else
{
$sql="SELECT `course`.`C_Code` FROM $Database.`course` WHERE `C_Status`='Active' ORDER BY `C_Name`";
}
//$esoftConfig->exec("USE $Database ");
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
$count=$sth->rowCount();
//$results = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
foreach($results as $row){
$courseArray[$row['C_Code']]='';
}
}
}
//$courseU=(array_unique($courseArray));
if($count){
ksort($courseArray);
// var_dump($courseU);
if($count>1){
$courseArray=array('All'=>'s')+$courseArray;
}


}
else
{
$courseArray= array('n'=>'No Courses');
}
echo json_encode($courseArray);

?>
