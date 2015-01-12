<?php session_start();
//$_POST['RegNo']='PAN/A-001170';
//$_POST['RegNo']='PAN/A-001190';
//$_POST['RegNo']='PAN/A-001003';
include('../../Modal/config.php');
include('../../Modal/SysSettings.php');

$D=explode('_',DATABASE);
$Bran=strtoupper(substr($D[1],0,3));

function SyncInsert($con,$query){
$SyncSql='INSERT INTO `sync_log` ( `Sync_query`, `Sync_Time`) VALUES ("'.$query.'",NOW())';
$sthSync = $con->prepare($SyncSql);
$sthSync->execute();
return $Syncresult=$sthSync->rowCount();
}
$esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
$Today=date('Y-m-d');

if(!empty($_POST['StudentID']))
{
$SM_ID=trim($_POST['StudentID']);
$DataBase='';
$TableOne='<h3>No Data To Display</h3>';
$TableTwo='';
$Status='';
$AttendanceMark=null;




$SqlSetThree= "SELECT `registrations`.`Default_Batch`,`registrations`.`RG_Reg_NO`,`registrations`.`RG_Reg_Type`,`registrations`.`RG_Final_Fee`,`registrations`.`RG_Total_Paid`,`student_master`.`SM_ID`,`student_master`.`SM_Title`,`student_master`.`SM_First_Name`,`student_master`.`SM_Last_Name` FROM $DataBase`registrations`
	INNER JOIN `student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
	WHERE `RG_Stu_ID`=?";

		$sth3 = $esoftConfig->prepare($SqlSetThree);
		$sth3->execute(array($SM_ID));
		$results3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
		$countThree=$sth3->rowCount();
if($countThree){

$TableTwo.= '<h5>Other Registrations</h5>
<table class="table datatable" >
  <tr class="success" >
    <td>Reg No</td>
    <td>Reg Type</td>
    <td>Default Batch</td>
    <td>Course Fee</td>
    <td>Total Paid</td>
    <td>Total Due</td>
    <td></td>
  </tr>';

foreach($results3 as $row){
$SM_ID3=$row['SM_ID'];
$RG_Reg_NO3=$row['RG_Reg_NO'];
$TotalPaid3=$row['RG_Total_Paid'];
$RG_Final_Fee3=$row['RG_Final_Fee'];
$TotalDue3=sprintf('%0.2f',($RG_Final_Fee3-$TotalPaid3));
$Batch3=$row['Default_Batch'];
$RG_Reg_Type3=$row['RG_Reg_Type'];
$RG_Reg_Type3=$row['RG_Reg_Type'];
$Name3=$row['SM_Title'].''.$row['SM_First_Name'].' '.$row['SM_Last_Name'];


 $TableTwo.=' <tr>
    <td>'.$RG_Reg_NO3.'</td>
    <td>'.$RG_Reg_Type3.'</td>
    <td>'.$Batch3.'</td>
    <td>'.$RG_Final_Fee3.'</td>
    <td>'.$TotalPaid3.'</td>
    <td>'.$TotalDue3.'</td>
    <td> <button class="btn btn-mini"  reg="'.$RG_Reg_NO3.'" type="button">check in</button></td>
  </tr>';


}
$TableTwo.='</table>';



echo $TableTwo;
}
else
{
echo '<h3>No Data To Display</h3>';
}
}
	  
?>