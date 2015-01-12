<?php session_start();
 include("LogController.php");
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$data=null;
$subsql='';
$table='';
$link='';
$arraytypes=array('Cash','Credit Card','Cheque');
/////////
$bA=explode('---',$_POST['BranchCode']);
$myReport = "temp/IncomeReport".time().".txt";
$DataBase=$DBprefix.strtolower($bA[1]).$DBsuffix;
//var_dump($_POST);
	echo '
 <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Income Report</h3>
    </div>
	<div class="modal-body" >';

 
	$SqlSetOne = '';
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	$SearchDesTD = '';
$DateTable=" `payments_master`.`PM_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 
	
 $SqlMain="
SELECT
payments_master.PM_Receipt_No,
payments_master.RG_Reg_No,
payments_master.PM_Date,
payments_master.Currency,
payments_master.Currency_rate,
payments_master.PM_Type,
payments_master.PM_Amount,
payments_master.PM_Operator,
student_master.SM_Initials,
student_master.SM_ID,
student_master.SM_Last_Name,
registrations.RG_Total_Paid,
registrations. RG_Reg_Type,
registrations.RG_Date
FROM
$DataBase.payments_master
LEFT JOIN $DataBase.`registrations` ON `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO`
LEFT JOIN $DataBase.`student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" GROUP BY `payments_master`.`PM_Receipt_No` ORDER BY `payments_master`.`PM_Type`,`payments_master`.`PM_Operator`,`payments_master`.`PM_Date`";
$SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;
//$esoftConfig->exec("USE $DataBase ");
$sth = $esoftConfig->prepare($SqlSetOne);
$sth->execute($BindData);
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
if($count!=0){
if($count<2000){
foreach($results as $row)
			{
$Today =date('d-m-Y');
$arraytotalsum[$row['Currency']][]=$row['PM_Amount'];
$PM_Operatorcheck='';
$typecheck='';
$arrayPM_Operator[]=$row['PM_Operator'];
$arrayset[$row['Currency']][$row['PM_Type']][$row['PM_Operator']][][$row['PM_Operator']]=array($row['SM_Initials'].' '.$row['SM_Last_Name'],$row['RG_Reg_Type'],$row['PM_Receipt_No'],$row['PM_Amount'],$row['PM_Date'],$row['RG_Reg_No'],$row['RG_Date'],$row['SM_ID']);			
}


//$link='<a href="View/generatepdf.php" target="_blank">Generate pdf<img src="Library/img/PDF.png" ></a>';
$link='<a href="Controller/GeneratePdf.php?File='.$myReport.'" target="_blank">Generate pdf<img src="Library/img/PDF.png" ></a><br />
';
$table.= '
<br>
<div align="left" class="divcon" >
<h4>Cash Collection Report '.$bA[0].'</h4><br/>'.$DateRange.'<br />
<input id="DBcode" type="hidden" value="'.$bA[1].'"></input>';
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
	
echo $link.'<div class="row">
<div class="col-md-6" >

<table class="table" >
  <tr class="warning">
    <td colspan="2">Search Parameeters</td>
  </tr>
  <tr class="warning">
    <td>Name</td>
    <td>Values</td>
  </tr>';
	if (empty($SearchDesTD))
		{
		echo ' <tr>
    <td>Any</td>
    <td>All(without any filtering)</td>
  </tr>';
		}
	  else
		{
		echo $SearchDesTD;
		}

	echo '</table>
	  </div>
	  </div>
';
echo ''.$table.'';
echo '</div>';
		
//$myReport = "myReport.txt";

}
else
{
	echo ' <div class="alert alert-warning">
    <h4>Warning!</h4>
   <h3>Your Search Range exceed 2000 rows,For detailed report please narrow your search range!</h3>.
    </div>';
}
echo '</div>';


}
else
{

echo '<div class="modal-body" ><div class="alert alert-block"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4>Warning!</h4>
    No Records according to your requirements
    </div></div>';
}

/*-------------------------------------------------------
-------------------- Other Payments --------------------
-------------------------------------------------------*/
echo '<div class="alert alert-success"><h3>Other Payments</h3></div><hr/>';
    $sth=null;
	$results=null;
	$SqlSetOne = '';
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$arraychart = '';
	$SearchDesTD = '';
$tableotherpay=null;	
$arraytotalsum=null;
$PM_Operatorcheck=null;
$typecheck=null;
$arrayPM_Operator=null;
$arrayset=null;			
$sumOperator=null;
$sum=null;

$DateTable=" `other_payments`.`OP_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart; 
	
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
LEFT JOIN $DataBase.`registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN $DataBase.`batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` 
LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`";
$SqlTail=" GROUP BY `other_payments`.`OP_Receipt_No` ORDER BY `other_payments`.`OP_Type`,`other_payments`.`OP_Operator`,`other_payments`.`OP_Date`";
 $SqlSetOne = $SqlMain.$FirstRangeWhere.$SqlTail;
//$esoftConfig->exec("USE $DataBase ");
$sth = $esoftConfig->prepare($SqlSetOne);
$sth->execute($BindData);
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
if($count!=0){
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
$link='<a href="Controller/GeneratePdf.php?File='.$myReport.'" target="_blank">Generate pdf<img src="Library/img/PDF.png" ></a><br />
';
$tableotherpay.= '
<br>
<div align="left" class="divcon" >
<h4>Other Payment Collection Report '.$bA[0].'</h4><br/>
<input id="DBcode" type="hidden" value="'.$bA[1].'"></input>';
foreach($arrayset as $Cur =>$arraysetsub ){
$tableotherpay.='<h3>'.$Cur.'</h3>';
$tableotherpay.='# - Today Registrations.
<table cellspacing="0"  cellpadding="1"  class="table table-hover">
        
            <tr> <th class="topborder bottomborder"  width="7px"></th>
                <th class="topborder bottomborder" align="left" width="70px">Date</th>
                <th class="topborder bottomborder" align="left"width="95px">Reg. No.</th>
                <th class="topborder bottomborder" align="left"  width="150px" >Student Name</th>

                <th class="topborder bottomborder" align="left" width="120px">Course/Batch</th>
			   <th class="topborder bottomborder" align="left" width="130px">Comment</th>
			   <th class="topborder bottomborder" align="left" width="130px">ReciptNo</th>
                <th class="topborder bottomborder"  align="right"width="80px" ><div  class="text-right" >Paid Amout</div></th>
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
}
$tableotherpay.='</div>';
	
echo $link.'<div class="modal-body">

';
echo ''.$tableotherpay.'';
echo '</div>';
		
//$myReport = "myReport.txt";

}
else
{
	echo ' <div class="alert alert-warning">
    <h4>Warning!</h4>
   <h3>Your Search Range exceed 2000 rows,For detailed report please narrow your search range!</h3>.
    </div>';
}
echo '</div>';


}
else
{

echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4>Warning!</h4>
    No Other Payments
    </div>';
}
$fh = fopen($myReport, 'w');
fwrite($fh, $table.$tableotherpay);
fclose($fh);
?>
