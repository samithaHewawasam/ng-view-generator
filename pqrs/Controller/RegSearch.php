<?php session_start();
 include("LogController.php");
 include("../Modal/GenaralFunc.php");
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;//use back tic (`)
$DataBase='';
$SMDataBase='';
$RegBranch='';
$HostType=Htype(DATABASE);
$SearchType=null;
//echo var_dump($_POST);exit;
if(!empty($_POST['SearchInput']))
{
$SearchType=$_POST['SearchType'];
$SearchInput=trim($_POST['SearchInput']);
if($_POST['SearchType']=='RegNo'){
$SearchFrom='Registration NO';
if($HostType=='Local'){  
$RegBranch=str_replace('/','-',trim($_SESSION['branchCode']));
}
else{
$RegBranch=substr($SearchInput,0,3);
}
if(!is_numeric($RegBranch)){
$RegBranch=strtolower($RegBranch);
 $DataBase=$DBprefix.$RegBranch.$DBsuffix;
}
else
{
$DataBase='';
echo '<div class="alert"><h4>Warning!</h4>Please Enter Registration Number with Correct Branch Code.</div>';
exit;
}
//------Pagination-------//


 $per_page = 20; // Number of items to show per page
 $per_page_array=array(10,20,30,40);
 $start=0;  // Current start position 
if(!empty($_POST['per_page'])){
$per_page=$_POST['per_page'];
}
 if(!empty($_POST['Page'])){
$per_page=$_POST['per_page'];
$start=$_POST['Page'];
}

$showeachside = 10 ;//  Number of items to show either side of selected page
//Get Num Of Rows
 $str="SELECT `RG_Reg_NO` FROM $DataBase.`registrations` WHERE `RG_Reg_NO` LIKE ?";
 $stmt=$esoftConfig->prepare($str);
 $stmt->execute(array('%'.$SearchInput.'%'));
 $count=$stmt->rowCount();
//Get Num Of Rows End
    $max_pages = ceil($count / $per_page); // Number of pages
    $cur = ceil($start / $per_page)+1; // Current page number

//------Pagination----End---//

$sql="SELECT * FROM $DataBase.`registrations` WHERE `RG_Reg_NO` LIKE ? ORDER BY `registrations`.`RG_ID` DESC LIMIT $start, $per_page";
 $STH=$esoftConfig->prepare($sql);
 $STH->execute(array('%'.$SearchInput.'%'));
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
 $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);

echo '<script>
$(document).ready(function () {
 $(".Status").editable({
           url: "Controller/Common_Update.php",
           name: "SV_Status",
           type: "select",
           title: "Select Status",
		   		   ajaxOptions: {
        dataType: "json"
    },
  
		    source: [
{value: "Active", text: "Active"},{value: "Inactive", text: "Inactive"},{value: "suspend", text: "suspend"}],
		   
     success: function(response, newValue) {
	 var toReturn; 
	          $.each(response,function( index,value ) {
			  
			  if(value.status!="true"){
			  toReturn=value.Msg+value.status;
			 return false;
			  }
			  })
return toReturn;
    }  
    });
	});
	</script>';
echo '<h3>Search from <font color="#CC99FF">'.$SearchFrom.'</font></h3>';
echo '
<input type="hidden" value="'.$RegBranch.'"  id="DBcode" />
<table class="table" >
  <tr class="danger">
    <td>Student ID</td>
    <td>Registration NO</td>
    <td>Registration Type</td>
    <td>Final Fee</td>
    <td>Total Paid</td>
    <td>Status</td>
    <td>Operator</td>
    <td>Reg Date</td>
    <td>Actions</td>
  </tr>';
foreach($result as $row){
  echo '<tr>
    <td>'.$row['RG_Stu_ID'].'</td>
    <td>'.$row['RG_Reg_NO'].'</td>
    <td>'.$row['RG_Reg_Type'].'</td>
    <td>'.$row['RG_Final_Fee'].'</td>
    <td>'.$row['RG_Total_Paid'].'</td>
    <td ><span class="Status" data-value="'.$row['RG_Status'].'" data-pk="'.$randomString.base64_encode('registrations+++RG_Status+++RG_Reg_NO+++'.$row['RG_Reg_NO'].'+++'.$RegBranch).'" >'.$row['RG_Status'].'</td>
    <td>'.$row['RG_Operator'].'</td>
    <td>'.$row['RG_Date'].'</td>
	<td class="View" data="'.$row['RG_Stu_ID'].'" reg_no="'.$row['RG_Reg_NO'].'">View</td>
  </tr>';

}
echo '</table>
';
?>

<table id="PagiN_Reg" width="499" border="0" align="center" cellpadding="0" cellspacing="0" class="PHPBODY">
<tr>
  <td width="99" align="center" valign="middle"><?php echo '<select class="per_page input-mini" title="Select page size">';
				$selected='';
				foreach($per_page_array as $val2){
				
				echo 	'<option ';
				if($per_page==$val2){ echo $selected='selected="selected"';}
				echo ' value="'.$val2.'">'.$val2.'</option>';
					
					}
				
				echo '</select>' ?></td> 
<td width="99" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php
if(($start-$per_page) >= 0)
{
    $next = $start-$per_page;
?>
<a class="goto" page="<?php print("#$next");?>" from="<?php echo $SearchType ?>" >&lt;&lt;</a> 
<?php
}
?></td>
<td width="201" align="center" valign="middle" class="selected">
Page <?php print($cur);?> of <?php print($max_pages);?><br>
( <?php print($count);?> records )</td>
<td width="100" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php 
if($start+$per_page<$count)
{
?>
<a class="goto" page="<?php print("#".max(0,$start+$per_page))  ?>" from="<?php echo $SearchType ?>">&gt;&gt;</a> 
<?php
}
?></td>
</tr>
<tr><td colspan="4" align="center" valign="middle">&nbsp;</td></tr>
<tr> 
<td align="center" valign="middle" class="selected">&nbsp;</td>
<td colspan="3" align="center" valign="middle" class="selected"><?php 
$eitherside = ($showeachside * $per_page);
if($start+1 > $eitherside){print (" .... ");}
$pg=1;

for($y=0;$y<$count;$y+=$per_page)
{
    $class=($y==$start)?"badge badge-important":"";
    if(($y > ($start - $eitherside)) && ($y < ($start + $eitherside)))
    {
?>
&nbsp;<a class="goto <?php print($class);?>" page="<?php print("#$y");?>" from="<?php echo $SearchType ?>" ><?php print($pg);?></a>&nbsp;
<?php
    }
    $pg++;
}
if(($start+$eitherside)<$count){print (" .... ");};
?></td>
</tr>
<tr>
<td colspan="4" align="center"></td>
</tr>
</table>


<?php
}
else
{
echo '<div class="alert alert-info">
    <h4>Attention !</h4>Can\'nt Find Results For this Registration No  or part.
    </div>
';
}
}
elseif($_POST['SearchType']=='SM_ID' || $_POST['SearchType']=='SM_Full_Name')
{
$RegBranch='centralserver';
if($HostType=='Local'){  
$RegBranch=str_replace('/','-',$_SESSION['branchCode']);

}
 $SMDataBase=$DBprefix.strtolower($RegBranch).$DBsuffix;

if($_POST['SearchType']=='SM_ID')
{
$SearchFrom='Student ID';
$wherecol='WHERE `SM_ID` LIKE ?' ;
$data=array('%'.$SearchInput.'%');
}
else
{
$SearchFrom='Student Name';
$wherecol='WHERE `SM_First_Name` LIKE ? OR `SM_Last_Name` LIKE ?' ;
$data=array('%'.$SearchInput.'%','%'.$SearchInput.'%');
}

//------Pagination-------//


 $per_page = 20; // Number of items to show per page
 $per_page_array=array(10,20,30,40);
 $start=0;  // Current start position 
if(!empty($_POST['per_page'])){
$per_page=$_POST['per_page'];
}
 if(!empty($_POST['Page'])){
$start=$_POST['Page'];
}

$showeachside = 10 ;//  Number of items to show either side of selected page

//Get Num Of Rows
  $str="SELECT `SM_ID` FROM $SMDataBase.`student_master` $wherecol ";
 $stmt=$esoftConfig->prepare($str);
 $stmt->execute($data);
 $count=$stmt->rowCount();
//Get Num Of Rows End
    $max_pages = ceil($count / $per_page); // Number of pages
    $cur = ceil($start / $per_page)+1; // Current page number

//------Pagination----End---//



$sql="SELECT * FROM $SMDataBase.`student_master` $wherecol ORDER BY `student_master`.`SM_ID` DESC LIMIT $start, $per_page";
 $STH=$esoftConfig->prepare($sql);
 $STH->execute($data);
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
echo '<h3>Search from <font color="#CC99FF">'.$SearchFrom.'</font></h3>
<input type="hidden" value="'.$RegBranch.'"  id="DBcode" />
<table class="table" >
  <tr class="success">
    <td>Student ID</td>
    <td>Title</td>
    <td>Initials</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Gender</td>
    <td>Date of Birth</td>
    <td>Tel Residance</td>
    <td>Actions</td>
  </tr>';
foreach($result as $row){

  echo '<tr>
    <td>'.$row['SM_ID'].'</td>
    <td>'.$row['SM_Title'].'</td>
    <td>'.$row['SM_Initials'].'</td>
    <td>'.$row['SM_First_Name'].'</td>
    <td>'.$row['SM_Last_Name'].'</td>
    <td>'.$row['SM_Gender'].'</td>
    <td>'.$row['SM_Date_of_Birth'].'</td>
    <td>'.$row['SM_Tel_Residance'].'</td>
	<td class="View" data="'.$row['SM_ID'].'" >View</td>
  </tr>';

}
echo '</table>
';
?>
<table id="PagiN_Reg" width="499" border="0" align="center" cellpadding="0" cellspacing="0" class="PHPBODY">
<tr>
  <td width="99" align="center" valign="middle"><?php echo '<select class="per_page input-mini" title="Select page size">';
				$selected='';
				foreach($per_page_array as $val2){
				
				echo 	'<option ';
				if($per_page==$val2){ echo $selected='selected="selected"';}
				echo ' value="'.$val2.'">'.$val2.'</option>';
					
					}
				
				echo '</select>' ?></td> 
<td width="99" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php
if(($start-$per_page) >= 0)
{
    $next = $start-$per_page;
?>
<a class="goto" page="<?php print("#$next");?>" from="<?php echo $SearchType ?>">&lt;&lt;</a> 
<?php
}
?></td>
<td width="201" align="center" valign="middle" class="selected">
Page <?php print($cur);?> of <?php print($max_pages);?><br>
( <?php print($count);?> records )</td>
<td width="100" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php 
if($start+$per_page<$count)
{
?>
<a class="goto" page="<?php print("#".max(0,$start+$per_page)) ?>">&gt;&gt;</a> 
<?php
}
?></td>
</tr>
<tr><td colspan="4" align="center" valign="middle">&nbsp;</td></tr>
<tr> 
<td align="center" valign="middle" class="selected">&nbsp;</td>
<td colspan="3" align="center" valign="middle" class="selected"><?php 
$eitherside = ($showeachside * $per_page);
if($start+1 > $eitherside){print (" .... ");}
$pg=1;

for($y=0;$y<$count;$y+=$per_page)
{
    $class=($y==$start)?"badge badge-important":"";
    if(($y > ($start - $eitherside)) && ($y < ($start + $eitherside)))
    {
?>
&nbsp;<a class="goto <?php print($class);?>" page="<?php print("#$y");?>" from="<?php echo $SearchType ?>"><?php print($pg);?></a>&nbsp;
<?php
    }
    $pg++;
}
if(($start+$eitherside)<$count){print (" .... ");};
?></td>
</tr>
<tr>
<td colspan="4" align="center"></td>
</tr>
</table>
<?php
}
else
{
echo '<div class="alert alert-info">
    <h4>Attention !</h4>Can\'nt Find Results For this ID Number,Student Name  or part on student marster central database.
    </div>
';

}


}
}


//Registration view part
if(!empty($_POST['ViewDetais']))
{
$tt=null;
echo '  <style type="text/css">
  .tabs-left, .tabs-right {
    border-bottom: none;
    padding-top: 2px;
}
.tabs-left {
    border-right: 1px solid #ddd;
}
.tabs-right {
    border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
    float: none;
    margin-bottom: 2px;
}
.tabs-left>li {
    margin-right: -1px;
}
.tabs-right>li {
    margin-left: -1px;
}
.tabs-left>li.active>a, .tabs-left>li.active>a:hover, .tabs-left>li.active>a:focus {
    border-bottom-color: #ddd;
    border-right-color: transparent;
}
.tabs-right>li.active>a, .tabs-right>li.active>a:hover, .tabs-right>li.active>a:focus {
    border-bottom: 1px solid #ddd;
    border-left-color: transparent;
}
.tabs-left>li>a {
    border-radius: 4px 0 0 4px;
    margin-right: 0;
    display:block;
}
.tabs-right>li>a {
    border-radius: 0 4px 4px 0;
    margin-right: 0;
}
.tabbable>.tab-content {overflow-x:scroll;}
  
  </style>';
 $ThisReg=null;
if(!empty($_POST['ThisReg']))
{
 $ThisReg=$_POST['ThisReg'];
} 
$Class2=null; 
$Num=null;
$SMID=$_POST['SMID'];
 $DBcode=$_POST['DBcode'];
 $RegBranch=strtolower($DBcode);
 $DataBase=$DBprefix.$RegBranch.$DBsuffix;

if($HostType=='Local'){  
 $sql2="SELECT * FROM `registrations` WHERE `RG_Stu_ID` LIKE ?";
  $STH2=$esoftConfig->prepare($sql2);
 $STH2->execute(array($SMID));
 $result2[0] = 'hello world';
 $rowcount=$STH2->rowCount();

}
else
{
$Db=$DBprefix.'centralserver'.$DBsuffix;
 $sql2="SELECT * FROM $Db.`registration_index` WHERE `SM_ID` LIKE ?";
  $STH2=$esoftConfig->prepare($sql2);
 $STH2->execute(array($SMID));
 $result2 = $STH2->fetchAll(PDO::FETCH_ASSOC);
 $rowcount=$STH2->rowCount();
}

//Registration Index Look Up
 
 if($rowcount){
 $i=0;
  echo '
	<div class="row">
 <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Registration Details</h3>
    </div>
	
	<div class="col-md-2">
  <ul class="nav nav-tabs tabs-left">';
foreach($result2 as $row2){
// $i++;
 if($HostType=='Local'){  
 $DataBase='';
 //$RegBranch=str_replace('/','-',$_SESSION['branchCode']);
}
else
{
 $DataBase=$DBprefix.strtolower(substr($row2['SM_Branch_Code'],0,3)).$DBsuffix;
 }
 $sql="SELECT * FROM $DataBase.`registrations` WHERE `RG_Stu_ID` LIKE ?";
 $STH=$esoftConfig->prepare($sql);
 $STH->execute(array('%'.$SMID.'%'));
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);





foreach($result as $row){

 $i++;
$Registrations[$i]=$row['RG_Reg_NO'];
$RGtable[$i]='<div class="span9"> <table class="table table-striped" >
  <tr >
    <td class="span3">Registration NO</td>
    <td class="span5">'.$row['RG_Reg_NO'].'</td>
  </tr>
  <tr>
    <td>Student ID</td>
    <td>'.$row['RG_Stu_ID'].'</td>
  </tr>
  <tr>
    <td>Registration Type</td>
    <td>'.$row['RG_Reg_Type'].'</td>
  </tr>
  <tr>
    <td>Default Batch</td>
    <td>'.$row['Default_Batch'].'</td>
  </tr>
  <tr>
    <td>Fee Structure</td>
    <td>'.$row['RG_Fee_Structure'].'</td>
  </tr>
  <tr>
    <td>Discount Plan</td>
    <td>'.$row['RG_Discount_Plan'].'</td>
  </tr>
  <tr>
    <td>Total Fee</td>
    <td>'.$row['RG_Total_Fee'].'</td>
  </tr>
  <tr>
    <td> Final Fee</td>
    <td>'.$row['RG_Final_Fee'].'</td>
  </tr>
  <tr>
    <td> Reg Fee</td>
    <td>'.$row['RG_Reg_Fee'].'</td>
  </tr>
  <tr>
    <td> Total Paid</td>
    <td>'.$row['RG_Total_Paid'].'</td>
  </tr>
  <tr>
    <td> Full Payment Discount</td>
    <td>'.$row['RG_FullPay_Dis_Amount'].'</td>
  </tr>
  <tr>
    <td>Normal Discount </td>
    <td>'.$row['RG_Dis_Amount'].'</td>
  </tr>
  <tr>
    <td>Discount Comment</td>
    <td>'.$row['RG_Dis_Comment'].'</td>
  </tr>
  <tr>
    <td>Coupon Code</td>
    <td>'.$row['couponCode'].'</td>
  </tr>
  <tr>
    <td> Status</td>
    <td>'.$row['RG_Status'].'</td>
  </tr>
  <tr>
    <td> Operator</td>
    <td>'.$row['RG_Operator'].'</td>
  </tr>
  <tr>
    <td> Date</td>
    <td>'.$row['RG_Date'].'</td>
  </tr>
  <tr>
    <td>Special Note</td>
    <td>'.$row['RG_Special_Note'].'</td>
  </tr>
</table></div>';

if($row['RG_Reg_NO']==$ThisReg){
$Class=' active';
$Class2=' active';
$F=true;
$Num=$i;
}
else
{
$Class=null;


}
if(!isset($F)){
//$Class=($i == 1 ? ' class="active"' : null);
}
echo '<li class="'.$Class.'" ><a href="#tab'.$i.'" data-toggle="tab">'.$row['RG_Reg_NO'].'</a></li>';
}
}

echo '</ul></div>';



echo '<div class="col-md-10">
<div class="tab-content">';
if(!empty($Registrations)){
foreach($Registrations as $key => $value){
 if($HostType=='Local'){  
 $DataBase='';
 //$RegBranch=str_replace('/','-',$_SESSION['branchCode']);
}
else
{
 $DataBase=$DBprefix.strtolower(substr($value,0,3)).$DBsuffix;
 }
$OPtable='';
$PMtable='';
$SItable='';
$SStable='';
$SMtable='';
$sql2="SELECT * FROM $DataBase.`payments_master` WHERE `RG_Reg_No` = ?";
$tt.=$sql2;
 $STH=$esoftConfig->prepare($sql2);
 $STH->execute(array($value));
 $result2 = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
$PMtable.='<table class="table" >
  <tr class="info">
    <td >Receipt No</td>
    <td>Date</td>
    <td>Currency</td>
    <td>Currency_rate</td>
    <td>Amount</td>
    <td>Excess Payment</td>
    <td>Type</td>
    <td>Cheque NO</td>
    <td>Cheque Bank</td>
    <td>Cheque DueDate</td>
    <td>Card Holder</td>
    <td>Card Type</td>
    <td>Card NO</td>
    <td>Operator</td>
  </tr>';
foreach($result2 as $row2){

$PMtable.='<tr>
    <td width="130px">'.$row2['PM_Receipt_No'].'</td>
    <td>'.$row2['PM_Date'].'</td>
    <td>'.$row2['Currency'].'</td>
    <td>'.$row2['Currency_rate'].'</td>
    <td>'.$row2['PM_Amount'].'</td>
    <td>'.$row2['excessPayment'].'</td>
    <td>'.$row2['PM_Type'].'</td>
    <td>'.$row2['PM_Cheque_NO'].'</td>
    <td>'.$row2['PM_Cheque_Bank'].'</td>
    <td>'.$row2['PM_Cheque_Due_Date'].'</td>
    <td>'.$row2['PM_Card_Holder_Name'].'</td>
    <td>'.$row2['PM_Card_Type'].'</td>
    <td>'.$row2['PM_Card_NO'].'</td>
    <td>'.$row2['PM_Operator'].'</td>
  </tr>';
  
}
$PMtable.='</table>';
}
///////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
$sql3="SELECT * FROM $DataBase.`student_installments` WHERE `SI_Reg_No` = ?";
 $STH=$esoftConfig->prepare($sql3);
 $STH->execute(array($value));
 $result3 = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
$SItable.='<table class="table" >
  <tr  class="danger">
    <td> Ins NO</td>
    <td> Ins Amount</td>
    <td> Due Date</td>
    <td> Paid Amount</td>
    <td> Paid Date</td>
  </tr>';
foreach($result3 as $row3){

$SItable.='<tr>
    <td>'.$row3['SI_Ins_NO'].'</td>
    <td>'.$row3['SI_Ins_Amount'].'</td>
    <td>'.$row3['SI_Due_Date'].'</td>
    <td>'.$row3['SI_Paid_Amount'].'</td>
    <td>'.$row3['SI_Paid_Date'].'</td>
  </tr>';
  
}
$SItable.='</table>';
}
///////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
$sql4="SELECT * FROM $DataBase.`student_subjects` WHERE `SS_REG_NO` = ?";
 $STH=$esoftConfig->prepare($sql4);
 $STH->execute(array($value));
 $result4 = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
$SStable.='<table class="table" >
  <tr  class="warning">
    <td>Reg. NO</td>
    <td>Batch_No</td>
    <td>Subject</td>
    <td>Status</td>
  </tr>';
foreach($result4 as $row4){

$SStable.='<tr>
    <td>'.$row4['SS_REG_NO'].'</td>
    <td>'.$row4['SS_Batch_No'].'</td>
    <td>'.$row4['SS_Subject'].'</td>
    <td>'.$row4['SS_Status'].'</td>
  </tr>';
  
}
$SStable.='</table>';
}
///////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
$sql5="SELECT * FROM $DataBase.`student_master` WHERE `SM_ID` = ? LIMIT 1";
 $STH=$esoftConfig->prepare($sql5);
 $STH->execute(array($SMID));
 $result5 = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){

foreach($result5 as $row5){

$SMtable.='<div class="span9"> <table class="table table-striped" >
  <tr >
    <td class="span3">ID Type</td>
    <td class="span5">'.$row5['SM_ID_Type'].'</td>
  </tr>
  <tr>
    <td class="span3">Student ID</td>
    <td class="span5">'.$row5['SM_ID'].'</td>
  </tr>
  <tr>
    <td class="span3">Title</td>
    <td class="span5">'.$row5['SM_Title'].'</td>
  </tr>
  <tr>
    <td class="span3">Initials</td>
    <td class="span5">'.$row5['SM_Initials'].'</td>
  </tr>
  <tr>
    <td class="span3">First Name</td>
    <td class="span5">'.$row5['SM_First_Name'].'</td>
  </tr>
  <tr>
    <td class="span3">Last Name</td>
    <td class="span5">'.$row5['SM_Last_Name'].'</td>
  </tr>
  <tr>
    <td class="span3">Full Name</td>
    <td class="span5">'.$row5['SM_Full_Name'].'</td>
  </tr>
  <tr>
    <td class="span3">Gender</td>
    <td class="span5">'.$row5['SM_Gender'].'</td>
  </tr>
  <tr>
    <td class="span3">Date of Birth</td>
    <td class="span5">'.$row5['SM_Date_of_Birth'].'</td>
  </tr>
  <tr>
    <td class="span3">House NO</td>
    <td class="span5">'.$row5['SM_House_NO'].'</td>
  </tr>
  <tr>
    <td class="span3">Lane</td>
    <td class="span5">'.$row5['SM_Lane'].'</td>
  </tr>
  <tr>
    <td class="span3">Town</td>
    <td class="span5">'.$row5['SM_Town'].'</td>
  </tr>
  <tr>
    <td class="span3">City</td>
    <td class="span5">'.$row5['SM_City'].'</td>
  </tr>
  <tr>
    <td class="span3">Country</td>
    <td class="span5">'.$row5['SM_Country'].'</td>
  </tr>
  <tr>
    <td class="span3">Postal Code</td>
    <td class="span5">'.$row5['SM_Postal_Code'].'</td>
  </tr>
  <tr>
    <td class="span3">Tel Residance</td>
    <td class="span5">'.$row5['SM_Tel_Residance'].'</td>
  </tr>
  <tr>
    <td class="span3">Tell Work</td>
    <td class="span5">'.$row5['SM_Tell_Work'].'</td>
  </tr>
  <tr>
    <td class="span3">Tell Mobile</td>
    <td class="span5">'.$row5['SM_Tell_Mobile'].'</td>
  </tr>
  <tr>
    <td class="span3">Mail Personal</td>
    <td class="span5">'.$row5['SM_Mail_Personal'].'</td>
  </tr>
  <tr>
    <td class="span3">Mail Work</td>
    <td class="span5">'.$row5['SM_Mail_Work'].'</td>
  </tr>
  <tr>
    <td class="span3">Parent ID</td>
    <td class="span5">'.$row5['SM_Use_Parent_ID'].'</td>
  </tr>
  <tr>
    <td class="span3">Parent Name</td>
    <td class="span5">'.$row5['SM_Parent_Name'].'</td>
  </tr>
  <tr>
    <td class="span3">Parent Phone</td>
    <td class="span5">'.$row5['SM_Parent_Phone'].'</td>
  </tr>
  <tr>
    <td class="span3">Status</td>
    <td class="span5">'.$row5['SM_Status'].'</td>
  </tr>
  <tr>
    <td class="span3">Operator</td>
    <td class="span5">'.$row5['SM_Operator'].'</td>
  </tr>
  <tr>
    <td class="span3">Reg Date</td>
    <td class="span5">'.$row5['SM_Reg_Date'].'</td>
  </tr>
</table></div>';
  
}
}
///////////////////////////////////////////////////////////////////
$sql6="SELECT * FROM $DataBase.`Other_payments` WHERE `RG_Reg_No` = ?";
$tt.=$sql6;
 $STH=$esoftConfig->prepare($sql6);
 $STH->execute(array($value));
 $result6 = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
$OPtable.='<table class="table" >
  <tr class="success">
    <td >Receipt No</td>
    <td>Date</td>
    <td>Currency</td>
    <td>Currency rate</td>
    <td>Amount</td>
    <td>Excess Payment</td>
    <td>Type</td>
    <td>Cheque NO</td>
    <td>Cheque Bank</td>
    <td>Cheque DueDate</td>
    <td>Card Holder</td>
    <td>Card Type</td>
    <td>Card NO</td>
    <td>Operator</td>
  </tr>';
foreach($result6 as $row6){

$OPtable.='<tr>
    <td width="130px">'.$row6['OP_Receipt_No'].'</td>
    <td>'.$row6['OP_Date'].'</td>
    <td>'.$row6['Currency'].'</td>
    <td>'.$row6['Currency_rate'].'</td>
    <td>'.$row6['OP_Amount'].'</td>
    <td>'.$row6['Comment'].'</td>
    <td>'.$row6['OP_Type'].'</td>
    <td>'.$row6['OP_Cheque_NO'].'</td>
    <td>'.$row6['OP_Cheque_Bank'].'</td>
    <td>'.$row6['OP_Cheque_Due_Date'].'</td>
    <td>'.$row6['OP_Card_Holder_Name'].'</td>
    <td>'.$row6['OP_Card_Type'].'</td>
    <td>'.$row6['OP_Card_NO'].'</td>
    <td>'.$row6['OP_Operator'].'</td>
  </tr>';
  
}
$OPtable.='</table>';
}

//////////////////////////////////////////////////////////////////



echo '
<div class="tab-pane'.($key == $Num ? $Class2 : '').'" hj="'.$Num.'" id="tab'.$key.'">
<address>
  Student Name : <strong><font color="#6699FF">'.@$row5['SM_Title'].' '.@$row5['SM_Full_Name'].'</font></strong><br>
  Student ID : <strong><font color="#6699FF">'.@$row5['SM_ID'].'</font></strong><br>
  Mobile No : <strong><font color="#6699FF">'.@$row5['SM_Tell_Mobile'].'</font></strong><br>
</address>   
<div class="tabbable"> 
        
        
  <ul class="nav nav-tabs">
    <li class="active"><a href="#RGtab'.$key.'" data-toggle="tab">Registratons</a></li>
    <li ><a href="#SMtab'.$key.'" data-toggle="tab">Student Master</a></li>
    <li><a href="#SStab'.$key.'" data-toggle="tab">Student Subjects</a></li>
    <li><a href="#SItab'.$key.'" data-toggle="tab">Student Instalment</a></li>
	 <li ><a href="#PMtab'.$key.'" data-toggle="tab">Payment Master</a></li>
	 <li ><a href="#OPtab'.$key.'" data-toggle="tab">Other Payments</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="RGtab'.$key.'">
      '.$RGtable[$key].'
    </div>
	    <div class="tab-pane" id="SMtab'.$key.'">
     '.$SMtable.'
    </div>
	<div class="tab-pane" id="SStab'.$key.'">
     '.$SStable.'
    </div>
    <div class="tab-pane" id="SItab'.$key.'">
     '.$SItable.'
    </div>
    <div class="tab-pane" id="PMtab'.$key.'">
     '.$PMtable.'
    </div>
    <div class="tab-pane" id="OPtab'.$key.'">
     '.$OPtable.'
    </div>
  </div>
</div>
</div>';
//main for each
}
//echo $tt;
echo '</div>';
}
else
{
echo '
	<div class="modal-body" ><div class="alert alert-block"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4>Attention !</h4>No Results found on Branch Databases for this ID number.
    </div></div>
';
}
echo '</div></div>

';
}
else
{
echo '
	<div class="modal-body" ><div class="alert alert-block"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h4>Attention !</h4>No Results found on registration index for this ID number.
    </div></div>
';
}





}

?>


 

