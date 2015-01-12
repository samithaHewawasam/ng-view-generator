<?php session_start();


if(!empty($_POST['IncomeReportSerchForm']))
{
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
if(empty($_POST['Start_Date'])){
echo '<h3>Please select a Date</h3>';
exit;
}
$head='<hr/><div class="alert alert-warning"><h3>No Records</h3></div>';
$tableCpayhead=null;
$tableotherpay=null;
$data=null;
$subsql='';
$subsqlOther='';
$table='';
$link='';
$countOP=null;
$count=null;
$myReport = "temp/DayEndCollection".time().".txt";
$where=" WHERE `PM_Receipt_No` LIKE '%".$_SESSION['branchCode']."%'";
$whereOther=" WHERE `OP_Receipt_No` LIKE '%".$_SESSION['branchCode']."%'";
//$where=" WHERE 1";
$arraytypes=array('Cash','Credit Card','Cheque');
/////////
if(!empty($_POST['Start_Date'])){
$data=array($_POST['Start_Date']);
$subsql='AND payments_master.PM_Date=?';
$subsqlOther='AND other_payments.OP_Date=?';
$DateRange=' of '.$_POST['Start_Date'];

}
///////////
if(!empty($_POST['Start_Date'])and!empty($_POST['End_Date'])){
$data=array($_POST['Start_Date'],$_POST['End_Date']);
$subsql='AND payments_master.PM_Date BETWEEN ? AND ?';
$subsqlOther='AND other_payments.OP_Date BETWEEN ? AND ?';
$DateRange=' between '.$_POST['Start_Date'].' and '.$_POST['End_Date'];
}
$tableCpayhead= '<h3>Cash Collection Report '.$DateRange.'</h3><br>';
if($_POST['ReportMode']=='Course_Income' || $_POST['ReportMode']=='Both'){
/*-------------------------------------------------------
-------------------- Course Payments --------------------
-------------------------------------------------------*/
$sql="
SELECT
payments_master.PM_Receipt_No,
payments_master.RG_Reg_No,
payments_master.PM_Date,
payments_master.PM_Type,
payments_master.Currency,
payments_master.Currency_rate,
payments_master.PM_Amount,
payments_master.PM_Operator,
student_master.SM_ID,
student_master.SM_Initials,
student_master.SM_Last_Name,
registrations.RG_Total_Paid,
registrations. RG_Reg_Type,
registrations.RG_Date
FROM
payments_master 
LEFT JOIN registrations ON payments_master.RG_Reg_No=registrations.RG_Reg_NO
LEFT JOIN student_master ON registrations.RG_Stu_ID=student_master.SM_ID $where $subsql ORDER BY payments_master.PM_Type,payments_master.PM_Operator
";

$sth = $esoftConfig->prepare($sql);
$sth->execute($data);
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row)
			{
$Today =date('Y-m-d');
$arraytotalsum[$row['Currency']][]=$row['PM_Amount'];
$PM_Operatorcheck='';
$typecheck='';
$arrayPM_Operator[]=$row['PM_Operator'];
$arrayset[$row['Currency']][$row['PM_Type']][$row['PM_Operator']][][$row['PM_Operator']]=array($row['SM_Initials'].' '.$row['SM_Last_Name'],$row['RG_Reg_Type'],$row['PM_Receipt_No'],$row['PM_Amount'],$row['PM_Date'],$row['RG_Reg_No'],$row['RG_Date'],$row['SM_ID']);			
}

if($count!=0){
$head=null;
//$link='<a href="View/generatepdf.php" target="_blank">Generate pdf<img src="library/img/PDF.png" ></a>';
$link='<a href="Controller/GeneratePdf.php?File='.$myReport.'" target="_blank">Generate pdf<img src="library/img/PDF.png" ></a><br />';

$table.= '<hr/><div class="alert alert-info"><h3>Course Payments</h3></div>
<br>
<div align="left" class="divcon" >
<input id="DBcode" type="hidden" value=""></input>';
foreach($arrayset as $Cur =>$arraysetsub ){
$table.='<h3>'.$Cur.'</h3>';
$table.='# - Today Registrations.
<table cellspacing="0"  cellpadding="1"  class="table table-hover">
        
            <tr> <th class="topborder bottomborder"  width="7px"></th>
                <th class="topborder bottomborder" align="left" width="70px">Date</th>
                <th class="topborder bottomborder" align="left"width="95px">Reg. No.</th>
                <th class="topborder bottomborder" align="left"  width="150px" >Student Name</th>

                <th class="topborder bottomborder" align="left" width="120px">Course/Batch</th>
			   <th class="topborder bottomborder" align="left" width="130px">ReciptNo</th>
                <th class="topborder bottomborder"  align="right"width="80px" ><div  class="text-right" >Paid Amout</div></th>
				<th class="topborder bottomborder" width="20px"></th>
            </tr>
';
foreach($arraysetsub as $type =>$subarry){
	$table.='<tr class="success">
	<td> </td>
    <td colspan="7"><strong>'.$type.' Payments</strong></td>
  </tr>'; 

foreach($subarry as $PM_Operator=>$subarryfinal)

			{   

			foreach($subarryfinal as $subarrykey => $value)
			{
$value=$value[$PM_Operator];
			
if($PM_Operator.$type!=$PM_Operatorcheck){
	$table.='<tr class="info">
	<td> </td>
    <td colspan="7"><strong>'.$PM_Operator.'</strong></td>
  </tr>'; }	
  $PM_Operatorcheck=$PM_Operator.$type;  

if($Today==$value[6]){$TodayReg='#';}else{$TodayReg='';};  
$sum[$Cur][$type][]=$value[3];
$table.=' <tr  > <td  align="left">'.$TodayReg.'</td>
                <td  align="left" >'.$value[4].'</td>
                <td  align="left"><a  class="View"  href="#view" data="'.$value[7].'" >'.$value[5].'</a></td>
                <td  align="left">'.$value[0].'</td>
                <td  align="left">'.$value[1].'</td>
                <td  align="left">'.$value[2].'</td>
                <td  align="right" ><div class="text-right" >'.$value[3].'</div></td>
	           <td> </td>

            </tr>';


$sumOperator[$Cur][$type][$PM_Operator][]=$value[3];

 


}
$table.= '<tr  align="right" >
          <td></td>
        <td></td>
		 <td></td>
		 <td></td>
		 <td colspan="2"  align="right" ><div  class="text-right text-info" >'.$PM_Operator.' '.$type.' Total '.$Cur.'</div></td>
		 	 <td class="text-info"><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($sumOperator[$Cur][$type][$PM_Operator])).'</strong> </div></td> <td ></td>
  </tr>';

}

$table.= '<tr  align="right" >
    <td colspan="5"></td>
	

		 <td class="text-success topborder"  ><div  class="text-right" >'.$type.' Total '.$Cur.'</div></td>
		 	 <td class="text-success topborder" ><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($sum[$Cur][$type])).'</strong> </div></td><td ></td>
  </tr>';

}
$table.= '  <tr  align="right"> 
 <td colspan="5" ></td>
  

		 <td class="topborder" > <strong>Grand Total '.$Cur.'</strong></td>
		 	 <td class="topborder" ><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($arraytotalsum[$Cur])).'</strong> </div></td><td ></td>

  </tr>

    </table>';
}
$table.='</div>';
	
		
	
}
}
if($_POST['ReportMode']=='Other_Income' || $_POST['ReportMode']=='Both'){

/*-------------------------------------------------------
-------------------- Other Payments --------------------
-------------------------------------------------------*/
	
$head= '';
    $tableotherpay=null;
    $sth=null;
	$DataBase=null;
	$results=null;
	$SqlSetOne = '';
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	$SearchDesTD = '';
$arraytotalsum=array();
$PM_Operatorcheck=null;
$typecheck=null;
$sumOperator=null;
$sum=null;
$arrayPM_Operator=array();
$arrayset=array();			
 $SqlMain="
SELECT
`other_payments`.`OP_Receipt_No` AS `PM_Receipt_No`,
`other_payments`.`RG_Reg_No`,
`other_payments`.`OP_Date`  AS `PM_Date`,
`other_payments`.`Currency`,
`other_payments`.`Currency_rate`,
`other_payments`.`OP_Type` AS `PM_Type`,
`other_payments`.`OP_Amount` AS `PM_Amount`,
`other_payments`.`OP_Operator` AS `PM_Operator`,
`other_payments`.`Comment`,
`student_master`.`SM_Initials`,
`student_master`.`SM_ID`,
`student_master`.`SM_Last_Name`,
`registrations`.`RG_Total_Paid`,
`registrations`.`RG_Reg_Type`,
`registrations`.`RG_Date`
FROM
$DataBase.`other_payments`
LEFT JOIN $DataBase.`registrations` ON `other_payments`.`RG_Reg_No`=`registrations`.`RG_Reg_NO`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
";
$SqlTail=" GROUP BY `other_payments`.`OP_Receipt_No` ORDER BY `other_payments`.`OP_Type`,`other_payments`.`OP_Operator`,`other_payments`.`OP_Date`";
 $SqlSetOne = $SqlMain.$whereOther.$subsqlOther.$SqlTail;
//$esoftConfig->exec("USE $DataBase ");
$sth = $esoftConfig->prepare($SqlSetOne);
$sth->execute($data);
$countOP=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
if($countOP!=0){
if($count<2000){
foreach($results as $row)
			{
$Today =date('d-m-Y');
$arraytotalsum[$row['Currency']][]=$row['PM_Amount'];
$PM_Operatorcheck='';
$typecheck='';
$arrayPM_Operator[]=$row['PM_Operator'];
$arrayset[$row['Currency']][$row['PM_Type']][$row['PM_Operator']][][$row['PM_Operator']]=array($row['SM_Initials'].' '.$row['SM_Last_Name'],$row['RG_Reg_Type'],$row['PM_Receipt_No'],$row['PM_Amount'],$row['PM_Date'],$row['RG_Reg_No'],$row['RG_Date'],$row['SM_ID'],$row['Comment']);			
}
//$myReport = "temp/IncomeReport".time().".txt";

//$link='<a href="View/generatepdf.php" target="_blank">Generate pdf<img src="Library/img/PDF.png" ></a>';
$tableotherpay.= '<hr/><div class="alert alert-success"><h3>Other Payments</h3></div>
<br>
<div align="left" class="divcon" >
';
foreach($arrayset as $Cur =>$arraysetsub ){
$tableotherpay.='<h3>'.$Cur.'</h3>';
$tableotherpay.='# - Today Registrations.
<table cellspacing="0"  cellpadding="1"  class="table table-hover">
        
            <tr> <th class="topborder bottomborder"  width="7px"></th>
                <th class="topborder bottomborder" align="left"  >Date</th>
                <th class="topborder bottomborder" align="left" >Reg. No.</th>
                <th class="topborder bottomborder" align="left"   >Student Name</th>

                <th class="topborder bottomborder" align="left"  >Course/Batch</th>
			   <th class="topborder bottomborder" align="left"  >Comment</th>
			   <th class="topborder bottomborder" align="left"  >ReciptNo</th>
                <th class="topborder bottomborder"  align="right" ><div  class="text-right" >Paid Amout</div></th>
				<th class="topborder bottomborder" width="20px"></th>
            </tr>
';
foreach($arraysetsub as $type =>$subarry){
	$tableotherpay.='<tr class="success">
	<td> </td>
    <td colspan="8"><strong>'.$type.' Payments</strong></td>
  </tr>'; 

foreach($subarry as $PM_Operator=>$subarryfinal)

			{   

			foreach($subarryfinal as $subarrykey => $value)
			{
$value=$value[$PM_Operator];
			
if($PM_Operator.$type!=$PM_Operatorcheck){
	$tableotherpay.='<tr class="info">
	<td> </td>
    <td colspan="8"><strong>'.$PM_Operator.'</strong></td>
  </tr>'; }	
  $PM_Operatorcheck=$PM_Operator.$type;  

if($Today==$value[6]){$TodayReg='#';}else{$TodayReg='';};  
$sum[$Cur][$type][]=$value[3];
$tableotherpay.=' <tr  > <td  align="left">'.$TodayReg.'</td>
                <td  align="left" >'.$value[4].'</td>
                <td  align="left"><a  class="View"  href="#view" data="'.$value[7].'" >'.$value[5].'</a></td>
                <td  align="left">'.$value[0].'</td>
                <td  align="left">'.$value[1].'</td>
                <td  align="left">'.$value[8].'</td>
                <td  align="left">'.$value[2].'</td>
                <td  align="right" ><div class="text-right" >'.$value[3].'</div></td>
	           <td> </td>

            </tr>';


$sumOperator[$Cur][$type][$PM_Operator][]=$value[3];

 


}
$tableotherpay.= '<tr  align="right" >
          <td></td>
        <td></td>
		 <td></td>
		 <td></td>
		 <td colspan="3"  align="right" ><div  class="text-right text-info" >'.$PM_Operator.' '.$type.' Total '.$Cur.'</div></td>
		 	 <td class="text-info"><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($sumOperator[$Cur][$type][$PM_Operator])).'</strong> </div></td> <td ></td>
  </tr>';

}

$tableotherpay.= '<tr  align="right" >
    <td colspan="6"></td>
	

		 <td class="text-success topborder"  ><div  class="text-right" >'.$type.' Total '.$Cur.'</div></td>
		 	 <td class="text-success topborder" ><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($sum[$Cur][$type])).'</strong> </div></td><td ></td>
  </tr>';

}
$tableotherpay.= '  <tr  align="right"> 
 <td colspan="6" ></td>
  

		 <td class="topborder" > <strong>Grand Total '.$Cur.'</strong></td>
		 	 <td class="topborder" ><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($arraytotalsum[$Cur])).'</strong> </div></td><td ></td>

  </tr>

    </table>';

	
	
	
	echo '</div>';
}
}
}
}

echo $head.$link.$tableCpayhead.$table.$tableotherpay;

		
//$myReport = "myReport.txt";
$fh = fopen($myReport, 'w');
fwrite($fh, $tableCpayhead.$table.$tableotherpay);
fclose($fh);


}

?>
