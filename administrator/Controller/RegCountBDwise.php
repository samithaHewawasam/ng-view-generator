<?php session_start();
if(!empty($_POST['RegCountBDwiseForm']))
{
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
if(empty($_POST['Start_Date'])){
	echo ' <div class="alert alert-block">
    <h4>Warning!</h4>
  Please select a Date
    </div>';

exit;
}
$Reporttxt=null;
$header=null;
$count=null;
$data=null;
$subsql='';
$table='';
$link='';
$i=1;
$column=null;
$where="WHERE 1";
$Block='Entire  Branch';

///////
if(!empty($_POST['Block'])){
$where=" WHERE `RG_Branch_Code` LIKE '".$_SESSION['branchCode']."'";
$Block=$_SESSION['branchCode'];
}
/////////
if(!empty($_POST['Start_Date'])){
$data=array($_POST['Start_Date']);
$subsql='AND registrations.RG_Date=?';
$DateRange=' on '.$_POST['Start_Date'];

}
///////////
if(!empty($_POST['Start_Date'])and!empty($_POST['End_Date'])){
$data=array($_POST['Start_Date'],$_POST['End_Date']);
$subsql='AND registrations.RG_Date BETWEEN ? AND ?';
$DateRange=' From: '.$_POST['Start_Date'].'  To:'.$_POST['End_Date'];
}

if($_POST['ReporteType']=='Division'){
$sql=" SELECT
COUNT(`registrations`.`RG_Reg_NO`) AS C,
`registration_type`.`D_Code` AS Name FROM
registrations 
LEFT JOIN registration_type ON registrations.RG_Reg_Type=registration_type.RT_Code
$where $subsql GROUP BY `registration_type`.`D_Code`
";
$header='<h4>Division wise Registration count</h4>';
$Reporttxt='RegCountDivisionWise';
$column='Division';

}
elseif($_POST['ReporteType']=='Batch')
{
$sql=" SELECT
COUNT(`registrations`.`RG_Reg_NO`) AS C,
`registrations`.`Default_Batch` AS Name FROM
registrations 
$where $subsql GROUP BY `registrations`.`Default_Batch`
";
$header='<h4>Batch wise Registration count</h4>';
$Reporttxt='RegCountBatchWise';
$column='Batch';
}
elseif($_POST['ReporteType']=='Course')
{
$sql=" SELECT
COUNT(`registrations`.`RG_Reg_NO`) AS C,
`course`.`C_Code` AS Name FROM
registrations 
LEFT JOIN registration_type ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code`
LEFT JOIN `course_type` ON `registrations`.`RG_Reg_Type`=`course_type`.`CT_Type_Code` 
LEFT JOIN `course` ON `course_type`.`CT_Course_Code`=`course`.`C_Code`
$where $subsql GROUP BY `course`.`C_Code`
";
$header='<h4>Course wise Registration count</h4>';
$Reporttxt='RegCountCourseWise';
$column='Course';
}
elseif($_POST['ReporteType']=='RG_Reg_Type')
{
$sql=" SELECT
COUNT(`registrations`.`RG_Reg_NO`) AS C,
`registrations`.`RG_Reg_Type` AS Name FROM
registrations 
$where $subsql GROUP BY `registrations`.`RG_Reg_Type`
";
$header='<h4>Registration Type  wise Registration count</h4>';
$Reporttxt='RegCountRegTypeWise';
$column='Registration Type';
}

$myReport = "temp/".$Reporttxt.time().".txt";

$sth = $esoftConfig->prepare($sql);
$sth->execute($data);
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);

$link='<a href="Controller/GeneratePdf.php?File='.$myReport.'" target="_blank">Generate pdf<img src="library/img/PDF.png" ></a><br />
';
$table.='<h4>Esoft Computer Studies [Pvt] Ltd.</h4><hr/>'.$DateRange.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'Records From: '.$Block.'
<hr/>'.$header.'
<div class="row-fluid">
<div class="span5">
<table class="table table-hover">
  <tr>
    <td>No</td>
    <td>'.$column.'</td>
    <td align="right"><div  class="text-right" >No of Reg.</div></td>
  </tr>';
foreach($results as $row)
			{
	$TotalArray[]=$row['C'];		
$Today =date('Y-m-d');
  $table.='<tr>
    <td>'.$i++.'</td>
    <td>'.$row['Name'].'</td>
    <td align="right"><div  class="text-right" >'.$row['C'].'</div></td>
  </tr>';

}
  $table.='<tr>
    <td></td>
    <td><strong>Total</strong></td>
    <td align="right" class="topborder bottomborder"><strong><div  class="text-right" >'.array_sum($TotalArray).'</div></strong></td>
  </tr>';

$table.='</div></div></table>';
}
if($count!=0){
echo $link.$table;

		
$fh = fopen($myReport, 'w');
fwrite($fh, $table);
fclose($fh);
}
else
{

	echo ' <div class="alert alert-block">
    <h4>Warning!</h4>
  No Records according to your requirement.
    </div>';


}

?>
