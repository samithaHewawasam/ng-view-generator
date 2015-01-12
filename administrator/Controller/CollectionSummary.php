<?php session_start();


if(!empty($_POST['CollectionsSummary']))
{
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
if(empty($_POST['Start_Date'])){
echo '<h3>Please select a Date</h3>';
exit;
}

$data=null;
$subsql='';
$table='';
$link='';
//$where=" WHERE `PM_Receipt_No` LIKE '%".$_SESSION['branchCode']."%'";
$where=" WHERE 1";
$arraytypes=array('Cash','Credit Card','Cheque');
/////////
if(!empty($_POST['Start_Date'])){
$data=array($_POST['Start_Date']);
$subsql='AND payments_master.PM_Date=?';
$DateRange=' of '.$_POST['Start_Date'];

}
///////////
if(!empty($_POST['Start_Date'])and!empty($_POST['End_Date'])){
$data=array($_POST['Start_Date'],$_POST['End_Date']);
$subsql='AND payments_master.PM_Date BETWEEN ? AND ?';
$DateRange=' between '.$_POST['Start_Date'].' and '.$_POST['End_Date'];
}

 $sql="
SELECT
SUM(`payments_master`.`PM_Amount`) AS S,
`registrations`.`RG_Reg_Type`,
`registration_type`.`D_Code`
FROM
payments_master 
LEFT JOIN `registrations` ON `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO`
LEFT JOIN `registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` $where $subsql GROUP BY `registrations`.`RG_Reg_Type
";

$sth = $esoftConfig->prepare($sql);
$sth->execute($data);
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row)
{
$TotalSum[]=$row['S'];
$divisionSum[$row['D_Code']]=$row['S'];
$arrayset[$row['D_Code']][$row['RG_Reg_Type']][]=$row['S'];

}
$myReport = "temp/CollectionSummery".time().".txt";

$link='<a href="Controller/GeneratePdf.php?File='.$myReport.'" target="_blank">Generate pdf<img src="library/img/PDF.png" ></a><br />
';
$table.='<h4>Esoft Computer Studies [Pvt] Ltd.</h4><hr/>Cash Collection Summery Report  '.$DateRange.'
<hr/>';
$table.= '
<br>
<div align="left" class="span7" >
<table cellspacing="0"  cellpadding="1"  class="table table-hover">
  <tr>
    <td>Division</td>
    <td>Reg-Type</td>
    <td align="right"><div class="text-right" >Collection Amount</div></td>
  </tr>';
if($count!=0){

foreach($arrayset as $Divition =>$Reg_TypeArray)
			{
			
$table.='<tr class="info">
    <td colspan="3"><strong>'.$Divition.'</strong></td>
  </tr>';
foreach($Reg_TypeArray as $Reg_Type=>$val)
			{
  $table.='<tr>
    <td></td>
    <td>'.$Reg_Type.'</td>
    <td align="right"><div class="text-right" >'.number_format($val[0],2).'</div></td>
  </tr>';
  }
$table.='<tr><td colspan="2"  align="right" ><strong><div class="text-right" >Total of '.$Divition.'</div></strong></td><td align="right"><div class="text-right" ><strong>'.number_format(array_sum($divisionSum),2).'</strong></div></td></tr>';			
}
$table.='<tr><td colspan="2"><strong>Grand Total</strong></td><td align="right"><div class="text-right" ><strong>'.number_format(array_sum($TotalSum),2).'</strong></div></td></tr>';			
$table.= '</table> </div>';
}
else
{

echo '<h3>No Records according to your requirement</h3>';
}
echo $link.$table;

$fh = fopen($myReport, 'w');
fwrite($fh, $table);
fclose($fh);
}

?>
