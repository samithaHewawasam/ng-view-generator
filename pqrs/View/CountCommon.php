<?php session_start();
if(empty($_SESSION["Sys_U_Name"])){
echo '<div class="modal-body" ><button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
<div class="alert alert-block">
    <h4>Warning!</h4>
   <h3>Please Log into System!</h3>
    </div>
    </div>
';
exit;
}

$Today=date('Y-m-d');
$Year=date('Y');
$date2 = new DateTime();
$date3 = new DateTime();
$date4 = new DateTime();
$thismonthfirst=date("Y-m-01");
$thismonthlast=$date2->modify("last day of this month")->format("Y-m-d");
$lastmonthfirst=$date3->modify("first day of previous month")->format("Y-m-d");
$lastmonthlast=$date4->modify("last day of previous month")->format("Y-m-d");

$thisfirstQfirst=$Year.'-01-01';
$thisfirstQlast=$Year.'-03-31';

$thisyearfirst=$Year.'-01-01';
$thisyearlast=$Year.'-12-31';

 include("../Modal/GenaralFunc.php");
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
 
$HostType=Htype();
$href=@$_GET['href'];

?>
        <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 class="muted" ><span id="CommonCountTopic">Common Report Form</span><small> (Insert your Requirement)</small></h3>
    </div>
    <div class="modal-body" >
    <form method="post" id="CountCommon_Form">
    <input type="hidden" value="" name="CountCommon_Form"> 


<br />
    <div class="controls" id="BranchListMain">

</div>
  <?php if($href=='BatchWise'){}
  elseif($href=='SubjectCount'){}
  else{
  
  ?>

     <div class="row-fluid">
     
     <div class="span4">
       <label for="CC_Start_Date" class="control-label">Rang1 Start Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 first" id="CC_Start_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="CC_Start_Date" value="<?php echo date('Y-m-01') ?>"  >
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
    
     </div>
     
     <div class="span4">
       <label for="CC_End_Date" class="control-label">Rang1 End Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 second" id="CC_End_Date" size="16" type="text" value="<?php echo date('Y-m-d') ?>"   placeholder="yyyy-mm-dd" name="CC_End_Date" >
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
 <div class="span4">   
       <label for="CC_End_Date" class="control-label">&nbsp;</label>
 <div class="controls">

  <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown">Quick Picker <span class="caret"></span></button>
                <ul class="QuickPicker dropdown-menu" >
                  <li  ><a href="#" first="" second="">Clear</a></li>
                  <li><a href="#" first="<?php echo date('Y-m-d') ?>" second="" >Today</a></li>
                  <li><a href="#" first="<?php echo $thismonthfirst ?>" second="<?php echo $thismonthlast ?>">This month</a></li>
                  <li><a href="#" first="<?php echo $lastmonthfirst ?>" second="<?php echo $lastmonthlast ?>">Last month</a></li>
                  <li><a href="#" first="<?php echo $Year.'-01-01' ?>" second="<?php echo $Year.'-03-31' ?>">First quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-04-01' ?>" second="<?php echo $Year.'-06-30' ?>">Second quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-07-01' ?>" second="<?php echo $Year.'-09-30' ?>">Third quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-10-01' ?>" second="<?php echo $Year.'-12-31' ?>">Last quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-01-01' ?>" second="<?php echo $Year.'-12-31' ?>">This Year</a></li>
                  <li><a href="#" first="<?php echo ($Year-1).'-01-01' ?>" second="<?php echo ($Year-1).'-12-31' ?>">Last Year</a></li>
                </ul>
              </div>
     </div>    
     </div>    
  </div>
     <div class="row-fluid">
     
     <div class="span4">
       <label for="CC_Start_Date2" class="control-label">Rang2 Start Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 first" id="CC_Start_Date2" size="16" type="text" placeholder="yyyy-mm-dd" name="CC_Start_Date2" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
    
     </div>
     
     <div class="span4">
       <label for="CC_End_Date2" class="control-label">Rang2 End Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 second" id="CC_End_Date2" size="16" type="text"   placeholder="yyyy-mm-dd" name="CC_End_Date2" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
 
 <div class="span4">   
       <label for="CC_End_Date" class="control-label">&nbsp;</label>
 <div class="controls">

  <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown">Quick Picker <span class="caret"></span></button>
                <ul class="dropdown-menu QuickPicker" >
                  <li  ><a href="#" first="" second="">Clear</a></li>
                  <li><a href="#" first="<?php echo date('Y-m-d') ?>" second="" >Today</a></li>
                  <li><a href="#" first="<?php echo $thismonthfirst ?>" second="<?php echo $thismonthlast ?>">This month</a></li>
                  <li><a href="#" first="<?php echo $lastmonthfirst ?>" second="<?php echo $lastmonthlast ?>">Last month</a></li>
                  <li><a href="#" first="<?php echo $Year.'-01-01' ?>" second="<?php echo $Year.'-03-31' ?>">First quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-04-01' ?>" second="<?php echo $Year.'-06-30' ?>">Second quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-07-01' ?>" second="<?php echo $Year.'-09-30' ?>">Third quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-10-01' ?>" second="<?php echo $Year.'-12-31' ?>">Last quarter</a></li>
                  <li><a href="#" first="<?php echo $Year.'-01-01' ?>" second="<?php echo $Year.'-12-31' ?>">This Year</a></li>
                  <li><a href="#" first="<?php echo ($Year-1).'-01-01' ?>" second="<?php echo ($Year-1).'-12-31' ?>">Last Year</a></li>
                </ul>
              </div>
     </div>    
     </div>    
  </div>
  <?php } ?>
         <div class="control-group">
    <label for="D_Code" class="control-label">	
    Division:
    </label>
    <div class="controls">
    <select class="input-medium" id="D_Code" name="D_Code">
<?php 
if(@$_SESSION['Divisions']=='All'){
echo '<option value="" selected="selected">ALL</option>';
$sql="SELECT * FROM `division` WHERE `D_Status`='Active'";
}
else
{
$d=explode(',',@$_SESSION['Divisions']);
$sql="SELECT * FROM `division` WHERE `D_Status`='Active' AND `D_Code` IN("."'" . implode("','",$d) . "'".") ";
if(count($d)>1){
echo '<option value="" selected="selected">dff</option>';
}

}
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
echo SelectOptions($results,'D_Code','D_Code');


?>
              </select>
    </div>
    </div>

     <div class="control-group">
    <label for="C_Code" class="control-label">	
    Courses:
    </label>
    <div class="controls" id="CourseSelect">

              
    </div>
    </div>
    
   
   <div class="control-group" >
    <label for="BatchSelect" class="control-label">	
    Batch:
    </label>
    <div class="controls" id="BatchSelect">

              
    </div>
    </div>
    
   
 <!--  <div class="control-group">
    <label for="IntakeSelect" class="control-label">	
    Intakes:
    </label>
    <div class="controls" id="IntakeSelect">

              
    </div>
    </div>-->
        <div >

 <?php 
 if($HostType!='Local'){
 
 if($href=='Income'){
echo '<input type="button"  report="IncomeSummery" format="ViewBreakupSummery"  class="btn btn-medium btn-warning CountCommon_Save" value="Generate Income Report" />';
}
elseif($href=='RegistrationCount'){
echo '<input type="button" report="RegistrationCountSummery" format="ViewBreakupSummery"  class="btn btn-medium btn-success CountCommon_Save" value="Generate Registration Count Report" />';

}
elseif($href=='SubjectCount')
{
echo '
<input type="button"  format="ViewBreakupDetail"  report="SubjectCountSummery"  class="btn btn-medium btn-info CountCommon_Save" value=" Generate Subject Count Summery Report" />';
}
elseif($href=='BatchWise')
{
echo '
<input type="button"  format="ViewBreakupDetail"  report="BatchWiseStuSummery"  class="btn btn-medium btn-info CountCommon_Save" value=" Generate Batch Wise Student Details" />';
}
else
{
echo '<input type="button"  report="TotalDuesSummery"   format="ViewBreakupSummery"  class="btn btn-medium btn-primary CountCommon_Save" value="Generate Due Summery Report" />';
}
 
 }
 else{

$dbcode=strtolower(str_replace('/','-',$_SESSION['branchCode']));
	
if($href=='Income'){
echo '<input type="button" SelectedBranch="'.$dbcode.'---'.$dbcode.'" report="IncomeDetail" format="ViewBreakupSummery"  class="btn btn-medium btn-warning CountCommon_Save" value="Generate Income Report" />';
}
elseif($href=='RegistrationCount'){
echo '<input type="button" SelectedBranch="'.$dbcode.'---'.$dbcode.'" report="RegistrationCountSummery" format="ViewBreakupSummery"  class="btn btn-medium btn-success CountCommon_Save" value="Generate Registration Count Report" />';

}
elseif($href=='SubjectCount')
{
echo '
<input type="button" SelectedBranch="'.$dbcode.'---'.$dbcode.'" format="ViewBreakupDetail"  report="SubjectCountDetail"  class="btn btn-medium btn-info CountCommon_Save" value=" Generate Student Count Summery Report" />';
}
elseif($href=='BatchWise')
{
echo '
<input type="button" SelectedBranch="'.$dbcode.'---'.$dbcode.'" format="ViewBreakupDetail"  report="BatchWiseStuDetails"  class="btn btn-medium btn-info CountCommon_Save" value=" Generate Batch Wise Student Details" />';
}
else
{
echo '<input type="button" SelectedBranch="'.$dbcode.'---'.$dbcode.'"  report="TotalDuesDetail"   format="ViewBreakupSummery"  class="btn btn-medium btn-primary CountCommon_Save" value="Generate Due Summery Report" />
<input type="button" SelectedBranch="'.$dbcode.'---'.$dbcode.'" format="ViewBreakupDetail"  report="TotalDuesDetail"  class="btn btn-medium btn-info CountCommon_Save" value=" Generate Due Detail Report" />';
}
}
?>
<button type="reset" class="btn btn-medium">Clear</button>
</div>

</form>
</div>
