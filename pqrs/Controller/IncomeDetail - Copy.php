<?php session_start();

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

$DataBase=$DBprefix.strtolower($bA[1]).$DBsuffix;
//var_dump($_POST);
	echo '
 <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Income Report</h3>
    </div>
	<div class="modal-body" >';

///////////
/*
##############################################################################################
#
# Building Query For Advanced Search
# 
# 
##############################################################################################

*/  
	$SqlSetOne = '';
	$BindData = null;
	$ResultTable='';
	$arrayTable=array();
	$TotalCount=array();
	$DateRangOneSql = '';
	$arraychart = '';
	//$Where = " WHERE 1 AND registrations.`RG_Final_Fee`-registrations.`RG_Total_Paid` > 0 AND `RG_Status`='Active'";
	$Orderby=" GROUP BY `payments_master`.`PM_Receipt_No` ORDER BY `payments_master`.`PM_Type`,`payments_master`.`PM_Operator`,`payments_master`.`PM_Date`";
	$Where = "";
	$SearchDesTD = '';
	$DateRangone='';
	$DateRangtwo='';
	$DateRangthree='';
	$Groupby='';
	$DateRange='';
	if (!empty($_POST['CC_Start_Date']) and !empty($_POST['CC_End_Date']))
		{
		$DateRangone=1;
		$CC_Start_Date = $_POST['CC_Start_Date'];
		$CC_End_Date = $_POST['CC_End_Date'];
		$BindData['CC_Start_Date'] = $CC_Start_Date;
		$BindData['CC_End_Date'] = $CC_End_Date;
		$DateRange='Date range between '.$CC_Start_Date.' and '.$CC_End_Date;
		$DateRangOnePart = " AND `payments_master`.`PM_Date` BETWEEN :CC_Start_Date AND :CC_End_Date";
		$SearchDesTD.= '<tr>
    <td>Date Range1</td>
    <td>Between ' . $CC_Start_Date . ' And ' . $CC_End_Date . '</td>
  </tr>';
		}
	elseif (!empty($_POST['CC_Start_Date']))
		{
		$CC_Start_Date = $_POST['CC_Start_Date'];
		$BindData['CC_Start_Date'] = $CC_Start_Date;
		$DateRange='Date of '.$CC_Start_Date;
		$DateRangOnePart = " AND `payments_master`.`PM_Date`=:CC_Start_Date";
		$SearchDesTD.= '<tr>
    <td>Date</td>
    <td>' . $CC_Start_Date . '</td>
  </tr>';
		}
	  else
		{
		$DateRangOnePart = '';
		}


	
	
	
	if (!empty($_POST['D_Code']))
		{
		$D_Code = $_POST['D_Code'];
		$BindData['D_Code'] = $D_Code;
		$DivisionPart = " AND `registration_type`.`D_Code`=:D_Code";
		$SearchDesTD.= '<tr>
    <td>Division</td>
    <td> ' . $D_Code . '</td>
  </tr>';
		}
	  else
		{
		$DivisionPart = '';
		}
    if (!empty($_POST['BM_Batch_Code']))
		{
		$BM_Batch_Code = $_POST['BM_Batch_Code'];
		$BindData['BM_Batch_Code'] = $BM_Batch_Code;
		$BatchPart = " AND `registrations`.`Default_Batch`=:BM_Batch_Code";
		$SearchDesTD.= '<tr>
    <td>Default Batch</td>
    <td> ' . $BM_Batch_Code . '</td>
  </tr>';
		}
	  else
		{
		$BatchPart = '';
		}
	if (!empty($_POST['C_Code']))
		{
		$C_Code = $_POST['C_Code'];
		$BindData['C_Code'] = $C_Code;
		$CoursePart = " AND `course`.`C_Code`=:C_Code";
		$SearchDesTD.= '<tr>
    <td>Course</td>
    <td> ' . $C_Code . '</td>
  </tr>';
		}
	  else
		{
		$CoursePart = '';
		}

	if (!empty($_POST['Intake']))
		{
		$Intake = $_POST['Intake'];
		$BindData['Intake'] = $Intake;
		$SearchDesTD.= '<tr>
    <td>Intake</td>
    <td> ' . $Intake . '</td>
  </tr>';

			$IntakePart = " INNER JOIN `batch_master` ON `registrations`.`Default_Batch`=`batch_master`.`BM_Batch_Code` AND `batch_master`.`BM_Target_Exam`=:Intake ";

		}
	  else
		{
		$IntakePart = '';
		}

/*
##############################################################################################
#
# Building Query For Advanced Search 
#  2nd Date Range set query part 
# 
##############################################################################################

*/
	if (!empty($_POST['CC_Start_Date2']) and !empty($_POST['CC_End_Date2']))
		{
		$DateRangtwo=1;
		$CC_Start_Date2 = $_POST['CC_Start_Date2'];
		$CC_End_Date2 = $_POST['CC_End_Date2'];
		
		//$BindData['CC_Start_Date2']=$CC_Start_Date2;
		//$BindData['CC_End_Date2']=$CC_End_Date2;
		$DateRangtwoSubsql = " AND payments_master.`RG_Date` BETWEEN :CC_Start_Date2 AND :CC_End_Date2";
		
		$DateRangtwoSql = $IntakePart . $Where.$DivisionPart.$CoursePart.$BatchPart.$DateRangOnePart.$Orderby;


		$SearchDesTD.= '<tr>
    <td>Date Range 2</td>
    <td>Between ' . $CC_Start_Date2 . ' And ' . $CC_End_Date2 . '</td>
  </tr>';
		}
	  else
		{
		$DateRangtwoSql = '';
		}

// 2nd Date Range query part end

///////////
    $Where = " WHERE 1 ";
    $DateRangOneSql = $IntakePart . $Where.$DivisionPart.$CoursePart.$BatchPart.$DateRangOnePart.$Orderby ;

 $sql="
SELECT
payments_master.PM_Receipt_No,
payments_master.RG_Reg_No,
payments_master.PM_Date,
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
payments_master 
INNER JOIN `registrations` ON `payments_master`.`RG_Reg_No`=`registrations`.`RG_Reg_NO`
INNER JOIN `student_master` ON `registrations`.`RG_Stu_ID`=`student_master`.`SM_ID`
LEFT JOIN `registration_type` ON `registrations`.`RG_Reg_Type`=`registration_type`.`RT_Code` 
LEFT JOIN `course_type` ON `registrations`.`RG_Reg_Type`=`course_type`.`CT_Type_Code` 
LEFT JOIN `course` ON `course_type`.`CT_Course_Code`=`course`.`C_Code`
$DateRangOneSql 
";

$esoftConfig->query("USE $DataBase ");
$sth = $esoftConfig->prepare($sql);
$sth->execute($BindData);
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row)
			{
$Today =date('d-m-Y');
$arraytotalsum[]=$row['PM_Amount'];
$PM_Operatorcheck='';
$typecheck='';
$arrayPM_Operator[]=$row['PM_Operator'];
$arrayset[$row['PM_Type']][$row['PM_Operator']][][$row['PM_Operator']]=array($row['SM_Initials'].' '.$row['SM_Last_Name'],$row['RG_Reg_Type'],$row['PM_Receipt_No'],$row['PM_Amount'],$row['PM_Date'],$row['RG_Reg_No'],$row['RG_Date'],$row['SM_ID']);			
}
if($count!=0){
$myReport = "temp/IncomeReport".time().".txt";

//$link='<a href="View/generatepdf.php" target="_blank">Generate pdf<img src="library/img/PDF.png" ></a>';
$link='<a href="Controller/GeneratePdf.php?File='.$myReport.'" target="_blank">Generate pdf<img src="library/img/PDF.png" ></a><br />
';
$table.= '
<br>
<div align="left" class="divcon" >
<h4>Cash Collection Report '.$bA[0].'</h4><br/>'.$DateRange.'<br />
<input id="DBcode" type="hidden" value="'.$bA[1].'"></input>
# - Today Registrations.
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
foreach($arrayset as $type =>$subarry){
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
$sum[$type][]=$value[3];
$table.=' <tr  > <td  align="left">'.$TodayReg.'</td>
                <td  align="left" >'.$value[4].'</td>
                <td  align="left"><a  class="View"  href="#view" data="'.$value[7].'" >'.$value[5].'</a></td>
                <td  align="left">'.$value[0].'</td>
                <td  align="left">'.$value[1].'</td>
                <td  align="left">'.$value[2].'</td>
                <td  align="right" ><div class="text-right" >'.$value[3].'</div></td>
	           <td> </td>

            </tr>';


$sumOperator[$type][$PM_Operator][]=$value[3];

 


}
$table.= '<tr  align="right" >
          <td></td>
        <td></td>
		 <td></td>
		 <td></td>
		 <td colspan="2"  align="right" ><div  class="text-right text-info" >'.$PM_Operator.' '.$type.' Total</div></td>
		 	 <td class="text-info"><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($sumOperator[$type][$PM_Operator])).'</strong> </div></td> <td ></td>
  </tr>';

}

$table.= '<tr  align="right" >
    <td colspan="5"></td>
	

		 <td class="text-success topborder"  ><div  class="text-right" >'.$type.' Total</div></td>
		 	 <td class="text-success topborder" ><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($sum[$type])).'</strong> </div></td><td ></td>
  </tr>';

}
$table.= '  <tr  align="right"> 
 <td colspan="5" ></td>
  

		 <td class="topborder" > <strong>Grand Total</strong></td>
		 	 <td class="topborder" ><div  class="text-right" ><strong>'.sprintf('%0.2f', array_sum($arraytotalsum)).'</strong> </div></td><td ></td>

  </tr>

    </table></div>';
	
echo $link.'<div class="row-fluid">
<div class="span6" >

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
$fh = fopen($myReport, 'w');
fwrite($fh, $table);
fclose($fh);
}
else
{

echo '<div class="modal-body" ><div class="alert alert-block"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4>Warning!</h4>
    No Records according to your requirements
    </div></div>';
}

?>
