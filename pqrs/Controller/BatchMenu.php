<?php  session_start();
	include ("../../Modal/config.php");
	include("../Modal/GenaralFunc.php");
$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
 if (!strpos(DATABASE,'-')) {
$HostType='Online';
}
else
{
$HostType='Local';
}

$i=0;
$sql=null;
$ResultsFull=array();
$Database=null;
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$i=0;
$ResultsFull=array();
$DataBase=null;
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
//==========//
if(empty($_POST['BM_Status'])){
$BM_Status=" `BM_Status`='Active'";
}
else
{
$BM_Status=" `BM_Status`='".$_POST['BM_Status']."'";
}
//==========//
//var_dump($BranchesArray);
foreach($BranchesArray as $key=>$val){
$DataBase=$DBprefix.(strtolower($key)).$DBsuffix;

$C_Code=@$_POST['C_Code'];
if(@$_SESSION['Courses']!='All' && $HostType=='Online' && ($C_Code=='All' || $C_Code=='') ){
$Courses=@$_SESSION['Courses'];
$courseArray=(explode(',',$Courses));
$sql="SELECT `BM_Batch_Code` FROM $DataBase.`batch_master` WHERE 1 AND `BM_Course_Code` IN ('".implode("','",$courseArray)."') AND $BM_Status ORDER BY `BM_Batch_Code`";
}
elseif(!empty($C_Code) && $C_Code!='All'){
$sql="SELECT `BM_Batch_Code` FROM $DataBase.`batch_master` WHERE 1 AND `BM_Course_Code`='$C_Code' AND $BM_Status ORDER BY `BM_Batch_Code`";
}
elseif(!empty($_POST['D_Code']) && $_POST['D_Code']!='All'){
$D_Code=$_POST['D_Code'];
$sql="SELECT `BM_Batch_Code` FROM $DataBase.`batch_master` 
INNER JOIN $DataBase.`course_type` ON `batch_master`.`BM_Course_Code`=`course_type`.`CT_Course_Code` 
INNER JOIN $DataBase.`registration_type` ON `course_type`.`CT_Type_Code`=`registration_type`.`RT_Code`
WHERE 1 AND $BM_Status   AND `registration_type`.`D_Code`='$D_Code' ORDER BY `BM_Batch_Code`";
}
elseif((@$_SESSION['Divisions'])!='All'){
$D_Code=$_SESSION['Divisions'];
$sql="SELECT `BM_Batch_Code` FROM $DataBase.`batch_master` 
INNER JOIN $DataBase.`course_type` ON `batch_master`.`BM_Course_Code`=`course_type`.`CT_Course_Code` 
INNER JOIN $DataBase.`registration_type` ON `course_type`.`CT_Type_Code`=`registration_type`.`RT_Code`
WHERE 1 AND  $BM_Status AND `registration_type`.`D_Code` IN ('".str_replace(',',"','",$D_Code)."') ORDER BY `BM_Batch_Code`  ";
}

else
{
$sql="SELECT `BM_Batch_Code` FROM $DataBase.`batch_master` WHERE $BM_Status ORDER BY `BM_Batch_Code`";
}
//$esoftConfig->exec("USE $DataBase ");
$sth = $esoftConfig->prepare($sql);
$sth->execute();
 $count=$sth->rowCount();
if($count){

$results = $sth->fetchAll(PDO::FETCH_ASSOC);

//$results = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
foreach($results as $row){
$BatchArray[$row['BM_Batch_Code']]='';
}
}
@ksort($BatchArray);
}
$count=count($BatchArray);
if($count){
$BatchArray=array('All'=>'s')+$BatchArray;
/*
echo ' <select class="span4"  name="BM_Batch_Code"><option value="" selected="selected">ALL</option>';
foreach($BatchU as $BM_Batch_Code){
echo '<option value="'.$BM_Batch_Code.'">'.$BM_Batch_Code.'</option>';
}
echo '</select>';
*/
// var_dump($BatchU);
 json_encode($BatchArray);

}
else
{
$BatchArray= array('n'=>'No Batches');
}
echo json_encode($BatchArray);

?>
