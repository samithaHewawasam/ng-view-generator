<?php 
    $BindData=null;
	$SearchDesTD=null;
	$FirstDatePart=null;
	$SecondDatePart=null;
    $DivisionPart=null;
	$CoursPart=null;
	$BatchPart=null;
	$IntakePart=null;
    $DateRangtwo=null;
    $DateRangone=null;
	$RGStatusPart=null;
	$BatchStatusPart=null;
	$VerStatusPart=null;
	$Where=' WHERE 1 ';
	$Date1=null;
	$Date2=null;
	$DateRange=null;
    $SqlTail=null;
	// //////
	// Advanc Search Query Building Start
	$RgStatus=@$_POST['RgStatus'];
	if ($RgStatus!=0){
	if (!empty($_POST['RegStatus']))
		{
		$RegStatus = $_POST['RegStatus'];
		$BindData['RegStatus'] = $RegStatus;
		$RGStatusPart = " AND `registrations`.`RG_Status`=:RegStatus ";
		$SearchDesTD.= '<tr>
    <td>Reg Status</td>
    <td> ' . $RegStatus . '</td>
  </tr>';
		}
	  else
		{
		$RGStatusPart = '';
		}
		}
///////////////////////////////////////////////////////////////////
	$Date1=@$_POST['Date1'];
	if ($Date1==1){

	if (!empty($_POST['CC_Start_Date']))
		{
		$DateRangone=1;
		$DateArray=explode('to',$_POST['CC_Start_Date']);
		$CC_Start_Date = @$DateArray[0];
		$CC_End_Date =  @$DateArray[1];;

		// $BindData[]=('CC_Start_Date'=>$CC_Start_Date,'CC_End_Date'=>$CC_End_Date)
if($CC_End_Date && $CC_Start_Date){
		 $BindData['CC_Start_Date'] = $CC_Start_Date;
		$BindData['CC_End_Date'] = $CC_End_Date;

        $DateRange='Date of '.$CC_Start_Date;
		$FirstDatePart = " AND $DateTable BETWEEN :CC_Start_Date AND :CC_End_Date";
		$SearchDesTD.= '<tr>
    <td>Date Range1</td>
    <td>Between ' . $CC_Start_Date . ' And ' . $CC_End_Date . '</td>
  </tr>';
}
elseif($CC_Start_Date)
		{ 
$BindData['CC_Start_Date'] = $CC_Start_Date;
		$DateRange='Date of '.$CC_Start_Date;
		$FirstDatePart = " AND $DateTable=:CC_Start_Date";
		$SearchDesTD.= '<tr>
    <td>Date</td>
    <td>' . $CC_Start_Date . '</td>
  </tr>';		}

		}

	  else
		{
		$FirstDatePart = '';
		}
}

// 1nd Date Range query part end

	$Date2=@$_POST['Date1'];
	if ($Date2==1){
	if (!empty($_POST['CC_End_Date']))
		{
		$DateRangtwo=1;
		$DateArray2=explode('to',$_POST['CC_End_Date']);
		$CC_Start_Date2 = @$DateArray2[0];
		$CC_End_Date2 =  @$DateArray2[1];

if($CC_End_Date2 && $CC_Start_Date2){
		$BindData['CC_Start_Date2']=$CC_Start_Date2;
		$BindData['CC_End_Date2']=$CC_End_Date2;
		$SecondDatePart = " AND $DateTable BETWEEN :CC_Start_Date2 AND :CC_End_Date2";


		$SearchDesTD.= '<tr>
    <td>Date Range2</td>
    <td>Between ' . $CC_Start_Date2 . ' And ' . $CC_End_Date2 . '</td>
  </tr>';
  
}
}
	  else
		{
		$SecondDatePart = '';
		}
}
// 2nd Date Range query part end

	
	if (!empty($_POST['D_Code']) && $_POST['D_Code']!='All')
		{
		$D_Code = $_POST['D_Code'];
		$BindData['D_Code'] = $D_Code;
		$DivisionPart = " AND `registration_type`.`D_Code`=:D_Code";
		$SearchDesTD.= '<tr>
    <td>Division</td>
    <td> ' . $D_Code . '</td>
  </tr>';
		}
	elseif ($_POST['C_Code']=='All' && $_POST['D_Code']=='All' && @$_SESSION['Divisions']!='All')
		{
		$D_Code = @$_SESSION['Divisions'];
		$DivisionPart = " AND `registration_type`.`D_Code` IN ('".str_replace(',',"','",$D_Code)."')";
		$SearchDesTD.= '<tr>
    <td>Division</td>
    <td> ' . $D_Code . '</td>
  </tr>';
		}	  else
		{
		$SubJoin1 = '';
		}
		
	if(!empty($_SESSION['Courses']) && (@$_SESSION['Courses']!='All' ) && $_POST['C_Code']=='All')
		{
		 @$CourseArray=explode(',',$_SESSION['Courses']);
		
		for($i=0;$i<count($CourseArray);$i++){
    $CourseBind[] = ':list' . $i;
    $BindData[':list' . $i] = $CourseArray[$i];
}
		$CoursPart = " AND `course`.`C_Code` IN(".implode(',', $CourseBind).")";
		$SearchDesTD.= '<tr>
    <td>Course</td>
    <td> ' . @$_SESSION['Courses'] . '</td>
  </tr>';
		}elseif(!empty($_POST['C_Code']) && $_POST['C_Code']!='All')
		{
		$C_Code = $_POST['C_Code'];
		$BindData['C_Code'] = $C_Code;
		$CoursPart = " AND `course`.`C_Code`=:C_Code";
		$SearchDesTD.= '<tr>
    <td>Course</td>
    <td> ' . $C_Code . '</td>
  </tr>';
		}
	  else
		{
		$SubJoin2 = '';
		}
		
    if (!empty($_POST['BM_Batch_Code']) && $_POST['BM_Batch_Code']!='All')
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
		
	if (!empty($_POST['Intakes']) && $_POST['Intakes']!='All')
		{
		$Intake = $_POST['Intakes'];
		$BindData['Intake'] = $Intake;
		$SearchDesTD.= '<tr>
    <td>Intake</td>
    <td> ' . $Intake . '</td>
  </tr>';
				$IntakePart = " AND `batch_master`.`BM_Target_Exam`=:Intake ";

		}
	  else
		{
		$IntakePart = '';
		}
	if (!empty($_POST['FormName']) && $_POST['FormName']=='StudentVerifyList')
		{
		$VerStatus = $_POST['VerStatus'];
		$SearchDesTD.= '<tr>
    <td>Verify Status</td>
    <td> ' . $VerStatus . '</td>
  </tr>';
  		if($VerStatus=='All')
		{
		$VerStatusPart='';
		}
		elseif($VerStatus=='Non')
		{
	  //  $BindData['VerStatus'] = 'Verified';
	 $VerStatusPart = " AND `student_verify`.`Status` NOT LIKE 'Verified' ";
		}else
		{
	    $BindData['VerStatus'] = $VerStatus;
	$VerStatusPart = " AND `student_verify`.`Status`=:VerStatus ";
		}

		}
	  else
		{
		$VerStatusPart = '';
		}
?>