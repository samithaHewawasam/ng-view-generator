<?php


$RG_Reg_NO="";
$RG_Stu_ID="";
$regAll="";

if(isset($_GET['regSearch'])){$RG_Reg_NO = $_GET['regSearch'];}
if(isset($_GET['regSearch'])){$RG_Stu_ID = $_GET['regSearch'];}

include("../Modal/dbLayer.php");

$getUserRegistration = $helper->getUserRegistration($RG_Reg_NO,$RG_Stu_ID);

if(count($getUserRegistration) >= 1){
echo "There are ".count($getUserRegistration)." registrations avalible for given ID<br>";

echo "<br>";
foreach($getUserRegistration as $key => $value){
$key = $key + 1;

$regAll .="<tr><td>".$value['RG_Reg_NO']."</td></span><td><textarea name='RG_Special_Note'  class='RG_Special_Note'>".$value['RG_Special_Note']."</textarea></td><td><select class='RG_Status' style='width:100px' name='RG_Status' value=".$value['RG_Status']."><option value='Active'>Active</option><option value='Inactive'>Inactive</option></select></td><td><a class='btn editRegEach' data-toggle='modal' ><i class='icon-edit'></i> <strong>Edit</strong</a></td></tr>";

}
echo "<table class='table' id='registrationEditViewSet'>";
echo $regAll;
echo "</table>";
}else{

echo "There are no registrations avalible for given ID<br>";
}

?>
