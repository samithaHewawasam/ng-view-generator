<?php
session_start();
include("../Modal/dbLayer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" content="1024px, initial-scale=1.0" name="viewport">
  <link href="../library/css/bootstrap.min.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="../library/css/bootstrap-select.min.css" media="all" rel=
  "stylesheet" type="text/css">
  <link href="../library/css/datepicker.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="../library/css/style.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="../library/css/bootstrap-modal.css" rel="stylesheet">

  <link href="../library/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="../library/css/font-awesome.min.css" rel="stylesheet">

  <script src="../library/js/jquery.js"></script>
  <script src="../library/js/bootstrap.min.js"></script>
  <script src="../library/js/bootstrap-select.min.js"></script>
  <script src="../library/js/cardcheck.js" type="text/javascript"></script>
  <script src="../library/js/bootstrap-datepicker.js"></script>
  <script src="../library/js/bootstrap-modal.js"></script>
  <script src="../library/js/bootstrap-modalmanager.js"></script>
  <script src="../library/js/jquery.validate.min.js"></script>
  <script src="../library/js/additional-methods.js"></script>
  
<script src="../js/eSoft.js"></script>


<script>
$(document).ready(function(){

$(".shouldClose").click(function(){

    location.reload();


 $("#mainAlert").hide();
$("#SM_ID_KEEP").val("");
$("#RG_Reg_NO").val("");
$("#RG_Stu_ID").val("");
$('#CouserFinder').prop('selectedIndex',0); 
$('#RegType').remove();
$("#BatchNumber").val("");
$('#IntakeSelect').prop('selectedIndex',0);
$("#BM_Ins_Days").val("");
$("#BM_Commence_Date").val(""); 
$("#BM_End_Date").val(""); 
$('#alreadyBatchSorting').remove();
$("#subjectsTableFirstTr").nextAll().remove(); 
$("#selectedSubjectsSession").nextAll().remove();
$("#installmentsViewFirstTr").nextAll().remove();
$("#CT_No_Of_SubjectsCount").val("");
$('#fsCourseSet').remove();
$("#installmentsCount").val("");    
$('#discountPlan').remove();
$("#RG_Dis_Comment").val("");  
$("#RG_Reg_Fee").val(""); 
$("#FS_Price").val(""); 
$("#DP_Rate_Input").val(""); 
$("#DP_Type").val(""); 
$("#RG_discountRate_hidden").val(""); 
$("#RG_Total_Fee").val("");
$("#RG_FullPay_Dis_Amount_Select").prop('selectedIndex',0);
$("#RG_Total_Fee_Final").val(""); 
$("#RG_FullPay_Dis_Amount_hidden").val("");
$("#RG_Total_Paid").val("");
 $(".fullPayNo").prop('checked', true);
 $(".fullPayYes").prop('disabled', false);
 $(".fullPayYes").prop('checked', false);
 $("#PM_Amount").val(""); 
 $("#PM_Amount_Cash").val(""); 
  $("#putInvoiceNumber").val("");  
  $("#PM_Amount_credit").val("");
$( "input[name*='PM_Card_Holder_Name']" ).val("");
$(".oneNo,.twoNo,.threeNo,.fourNo").val(""); 
  $("#PM_Amount_Cheque").val(""); 
$( "input[name*='PM_Cheque_NO']" ).val(""); 
$( "input[name*='PM_Cheque_Bank']" ).val("");
$( "input[name*='PM_Cheque_Due_Date']" ).val(""); 
$( "#QuickregisterUserForPrint" ).val(""); 
$("#QuickbalanceDuePayment" ).val("");
 $("#QuickuptoDateDue" ).val("");
 $("#QuickpaymentArea > input").val("");
 $("#QuickputInvoiceNumber").val(""); 
$( "input[name*='regSearch']" ).val(""); 
$( "#regEditAlert" ).empty();
 $("#billingform").find("input[type=text], textarea").val("");
 $("#regNoPayments").val($( "#RG_Branch_Code_Session" ).val()+'-');
 $("#afterPaymentsInstallmentControls").empty();
  });
});
</script>

<script>

//remove existing data start
function removeExistingDataFull(){

$("#subjectsTableFirstTr").nextAll().remove();
$("#selectedSubjectsSession").nextAll().remove(); 
$("#installmentsViewFirstTr").nextAll().remove();
$('#CourseSet').prop('selectedIndex',0);
$('#alreadyBatchSorting').prop('selectedIndex',0);
$("#CT_No_Of_SubjectsCount").val("");
$('#fsCourseSet').prop('selectedIndex',0); 
$("#installmentsCount").val("");    
$('#discountPlan').prop('selectedIndex',0);
$("#RG_Dis_Comment").val("");  
$("#RG_Reg_Fee").val(""); 
$("#FS_Price").val(""); 
$("#DP_Rate_Input").val(""); 
$("#DP_Type").val(""); 
$("#RG_discountRate_hidden").val(""); 
$("#RG_Total_Fee").val("");
$("#RG_FullPay_Dis_Amount_Select").prop('selectedIndex',0);
$("#RG_Total_Fee_Final").val(""); 
$("#RG_FullPay_Dis_Amount_hidden").val("");

}

//remove existing data end
</script>
  <title>ESOFT Computer Studies PVT LTD</title>
</head>



</head>

<body>


<input type="hidden" value="<?php echo $_SESSION['branchCode']; ?>" id="RG_Branch_Code_Session" >
<input type="hidden" value="<?php echo $_SESSION['Sys_U_Name']; ?>" id="RG_Operator_Session" >
    <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle=
        "collapse"><span class="icon-bar"></span> <span class=
        "icon-bar"></span> <span class="icon-bar"></span></a> <a class="brand"
        href="/">ESOFT</a>

        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class="divider-vertical"></li>
<li><a data-toggle="modal"  href="#registrationEditModal"><em class="icon-edit icon-white"></em>
Edit Registration</a>
</li>
<li>

<li  class="dropdown">
    <a class="dropdown-toggle" id='notification' data-toggle="dropdown" href="#">
   <ul >
    <li class="notification-container">
        <em class="icon-globe icon-white"></em><span class="notification-counter"></span></li></ul>
    </a>

    <ul id='notificationList' class="dropdown-menu">

   </ul>

</li>
          </ul>

          <div class="pull-right">
            <ul class="nav pull-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href=
                "#">Hey <?php echo $_SESSION['Sys_U_Name']." "."@"." ".$_SESSION['branchCode'];?> <strong class="caret"></strong></a>

                <ul class="dropdown-menu">
                  <li class="divider"></li>

                  <li>
                    <a href="logout.php" id="logoutId"><em class="icon-off"></em>
                    Logout</a>
                  </li>
                <li class="divider"></li>
                 <li>
                    <a data-toggle="modal" href="#synchronizeView" ><em class="icon-off"></em>
                    synchronise</a>
                  </li>
                <li class="divider"></li>
 		<li>
                  <a data-toggle="modal" href="#updateingSystemFilesCheckModal" id='updateingSystem' ><em class="icon-retweet"> Update</em></a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  


      <div class="alert alert-success" id="mainAlert" >
       <button type="button" class="closeAlert" data-dismiss="alert">&times;</button>
    <strong>Hey!&nbsp;,</strong><span id="mainAlertInfo">,&nbsp; </span><span id="mainAlertInfoSelected" ></span>
    </div>
<!--Installment edit start-->
<div id="regEditInsEditModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close insCheck" data-dismiss="modal" aria-hidden="true">×</button>
<h3 >Edit Installments</h3>
</div>
<div class="modal-body">

<div id="installmentSetFromReg"></div>

<div class="alert-error fade in hide" id="insEditErrorDiv">
            <strong>Ooops!</strong><span id="insEditError"></span>
          </div>

   <form class="form-horizontal span6" id="regEditInsForm">
    <fieldset> 

<div class="control-group"><label class="control-label">Ins No</label>
<div class="controls"><input type="text" class="InsNoEditClass" placeholder="INS NO"/></div>
 </div>

<div class="control-group"><label class="control-label">Amount</label>
<div class="controls"><input type="text" class="InsAmountEditClass" placeholder="Amount"/></div>
 </div>

<div class="control-group"><label class="control-label">Due Date</label>
<div class="controls">
 <!--date--><div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2 InsDueDateEditClass"  size="16" type="text" name="PM_Date" value="" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div><!--/date-->
</div>
</div>
    </form>

</div>
<div class="modal-footer">
<p>
<button class="btn btn-small btn-warning" id="insEditRawAdd" type="button">Add New Installments</button>
<button class="btn btn-small btn-primary" id="insEditDataUpdate" type="button">Update</button>
</p>

</div>
</div>
<!--Installment edit end-->

 <!--loginAuthentication modal hide-->
    <div id="loginAuthentication" class="modal hide fade" tabindex="-1" data-width="300">
    <div class="modal-body">
<button type="button" class="close authCloseSpecial"  data-dismiss="modal" aria-hidden="true">×</button>
    <div class="container">

       <form id="loginAuthenticationSpecialDiscountForm">
	<pre id="adminAuthSpecial">Administrator Authentication </pre>

    <div class="control-group">
    <label class="control-label"  for="inputEmail">User Name</label>
    <div class="controls">
    <input type="text" name="userNameSpecial" autocomplete="off" id="loginAuthenticationSpecialDiscountUser" placeholder="esoft">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    <input type="password" name="passWordSpecial" autocomplete="off" id="loginAuthenticationSpecialDiscountPass" placeholder="123">
    </div>
    </div>

   <div class="control-group">
    <label class="control-label" for="inputPassword">Discount</label>
    <div class="controls">
	<label class="control-label" for="Percentage"><input type="radio" name="discount_from_admin_type"  id="discount_from_admin_percentage"> Percentage</label>
	<label class="control-label" for="Percentage"><input type="radio" name="discount_from_admin_type"  id="discount_from_admin_value"> Value</label>
    <div class="controls"><input type="text" name="discount_from_admin" autocomplete="off" id="discount_from_admin">
<input type="hidden" name="discount_from_admin_hidden" autocomplete="off" id="discount_from_admin_hidden">
</div>
    </div>
    </div>

    <div class="control-group">
    <div class="controls">
    
    <button type="submit" name="loginAuthentication" id="letMeOkThisDiscount" class="btn">Let me ok this discount</button>
    </div>
    </div>
    </form>

  </div> <!-- /container -->

  </div>                            
    </div>
<!-- /special -->

     <div id="registrationFullModal" class="modal hide fade" tabindex="-1" data-width="960" style="position:relative;top:25px;">
    <div class="modal-header">
    <button type="button" class="close shouldClose"  data-dismiss="modal"  aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
     <div class="registrationData">
<form class="form-horizontal" id="registrations">
     <div class="topDate" style="right:10px;top:20px">

      <div class="control-group">
  <label for="SM_Date_of_Birth" class="control-label"></label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" size="16" type="text" id="RG_Date" name="RG_Date" value="" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>
     
</div>
<h3 id="esoftRegistration">Edit Registration @ ESOFT</h3><hr>
<div class="registerUserName"></div>
    <div class="row">
    <div class="span8">
    <form action="billing" method="post" class="form-horizontal" id="billingform" accept-charset="utf-8">
   
    <div class="control-group">
    <label for="idNumber" class="control-label">	
    Reg No:
    </label>
    <div class="controls"><input type="text" id="RG_Reg_NO" class="form-control" name="RG_Reg_NO" placeholder="COL/A-4526" value="<?php echo $_SESSION['branchCode']; ?>">
    </div>
    </div>
   
    
    <div class="control-group">
    <label for="idNumber" class="control-label">	
    ID Number:
    </label>
    <div class="controls"><input type="text" id="RG_Stu_ID" class="form-control" name="RG_Stu_ID" title='please enter your id' autofocus required autocomplete="off" maxlength="10" readonly>
	<input type="text" style="display:none;" id="getUserSet" class='registerUserForPrint' class="span6" readonly>
    </div>
    </div>
     
    
     <div class="control-group">
    <label for="idNumber" class="control-label">	
    Find your Course:?
    </label>
    
         <?php 
    echo "<div class='controls'>";
    include('../Modal/courseTypeList.php');
   echo  "</div>";
    	
    	echo "</div>";
       
 
?>

<div class="control-group" id="regTypeSet">
    <label for="idNumber" class="control-label">	
    Find your Reg Type?:
    </label>
    
<div class='controls' id="RegTypeSelectList">
<select title="please select your Reg Type" name="CT_Type_Code" id="RegType">
<option value=" ">Select Your Reg Type</option></select>
</div>
</div>


    <div class="control-group" style="display:none" id="nextCourse">
    <label for="idNumber" class="control-label">	
    Find your next Course?:
    </label>
    
<div class='controls' id="CourseSetControls" >

</div>
</div>


     
 
    
     <div class="control-group">
    <label for="idNumber" class="control-label">	
    Already batches?:
    </label>
    <div class="controls" id='batchMasterSet'>

    <select name="BM_Course_Code" id="alreadyBatchSorting"><option>Select Your Batch</option></select>
   </div>
    </div>
 
     <div class="control-group">
    <label for="idNumber" class="control-label">	
    Please Select Your Subjects:
    </label>
    <div class="controls" id="SubjectSet">
    
  <table class='table' id='subjectsTable'>
<tr id="subjectsTableFirstTr">
<th></th>
<th>Subject Code</th>
<th>Subject</th>
</tr>

</table>
   
    </div>
    </div>
   
   
     <div class="control-group">
    <label for="idNumber" class="control-label">	
    Selected Subjects List:
    </label>
    <div class="controls">
    
       <table class="table" id="selectesSubjectsRecodes">
         <tr id="selectedSubjectsSession">
<th>Registration type</th>
<th>Course Type</th>
<th>Subject Code</th>
<th>Batch</th>
</tr>
     
    </table>
   
    </div>
    </div>
   
   
     <ul class="hGroup">
    <li>
    <div class="control-group">
    <label for="SM_ID_Type" class="control-label">	
    Fee Structure:
    </label>
    <div class="controls" id="RG_Fee_Structure">

    </div>
    </div>

   <div class="control-group">
    <label for="SM_ID_Type" class="control-label">	
    Coupon Code:
    </label>
    <div class="controls" >
<input type='text' id="couponCode" class='form-control' name='couponCode' value="" >
    </div>
    </div>
   
    <div class="control-group">
    <label for="SM_ID_Type" class="control-label">	
    Discount Plan:
    </label>
    <div class="controls" id="discountPlanSet">
   
    </div>
    </div>

    <div class="control-group">
    <label for="SM_ID_Type" class="control-label">	
    Discount Comment:
    </label>
    <div class="controls" id="discountComment">
   <textarea id="RG_Dis_Comment" class="form-control" name="RG_Dis_Comment" raw="6"></textarea>
    </div>
    </div>

     <div class="control-group">
    <label class="control-label" for="SM_ID_Type">Registration Fee:</label>

    <div class="controls" id="RG_Reg_Fee_Input">
      <div class="input-prepend">
        <span class="add-on accsepttingCurrency">LKR</span> <input class='form-control' id='RG_Reg_Fee' name='RG_Reg_Fee' readonly type='text' value=""> 
      </div>
    </div>
  </div>
    
      <div class="control-group">
    <label class="control-label" for="SM_ID_Type">Gross Fee</label>

    <div class="controls" id="Gross_Fee_Input">
      <div class="input-prepend">
        <span class="add-on accsepttingCurrency">LKR</span> <input class='form-control' id='FS_Price' name='FS_Price' readonly type='text' value="">
      </div>
    </div>
  </div>

      <div class="control-group">
    <label class="control-label" for="SM_ID_Type">Discount:</label> <a class="hide" data-toggle="modal" href="#loginAuthentication" id="loginAuthenticationButton" name="loginAuthenticationButton">Login Authentication</a>

    <div class="controls" id="DP_Rate">
<div class="input-prepend"><span class="add-on accsepttingCurrency">LKR</span> 
      <input class='form-control' id='DP_Rate_Input' name='DP_Rate' readonly type='text' value=""> 
</div>
<input class='form-control' id='DP_Type' name='DP_Type' type='hidden' value="">

      
        <input id="RG_discountRate_hidden" type="hidden" value="">

    </div>
  </div>
    
     <div class="control-group">
    <label class="control-label" for="idNumber">Net Course Fee:</label>

    <div class="controls">
      <div class="input-prepend">
        <span class="add-on accsepttingCurrency">LKR</span><input class="form-control" id="RG_Total_Fee" name="RG_Total_Fee" readonly type="text">
      </div>
    </div>
  </div>
    
      <div class="control-group">
    <label  class="control-label" >	
    Can you able to pay in full ?:
    </label>
    <div class="controls">
     <label class="checkbox">Yes:<input class="fullPay fullPayYes" type="radio" name="fullPay"> 
    </label><label  class="control-label">No: <input type="radio" class="fullPay fullPayNo" name="fullPay" checked>
    </label>
    </div>
    </div>
   




 <div id="fullPayInput" style="display:none; margin:0 0 30px 0">
 <div class="control-group input-prepend input-append">
 <label  class="control-label" >	
    Discount:
    </label>
    <div class="controls" id="FinalDiscountSelector"><select class="input-large" id="RG_FullPay_Dis_Amount_Select" name="RG_FullPay_Dis_Amount">


               <option value="">
                  Select Final Discount
                </option>
                <option value="5">
                  5%
                </option>

                <option value="10">
                  10%
                </option>

              </select></div>
<input type="hidden" id="RG_FullPay_Dis_Amount_hidden" class="form-control" name="RG_FullPay_Dis_Amount" value="" >
    </div>
 
 
        <div class="control-group input-prepend input-append">
       <label  class="control-label" >	
    Final Payment:
    </label>
    <div class="controls">
    <div class="input-prepend"><span class="add-on accsepttingCurrency">LKR</span><input class="span2" id="RG_Total_Fee_Final" name="RG_Total_Fee_Final" type="text" readonly></div>
<input class="span2" id="RG_Total_Paid" name="RG_Total_Paid" type="hidden">
    <span class="add-on">/=</span>
    </div>
    </div>




</div>

    
     <div id="Installments">

       <div class="control-group">
    <label for="idNumber" class="control-label">	
    Installments:
    </label>
    <div class="controls" id="InstallmentSet">
     <table class='table' id='installmentsView'>
    <tr id="installmentsViewFirstTr">
	<th>Installment No</th>
	<th>Amount</th>
	<th>Due Date</th>
        <th>Paid Amount</th>
	<th>Delete</th>
        <th>Edit</th>
   </tr>
     </table>

    </div>
    </div>

  
    </div>
<div class="center text-center">
<div class="controls">
<a data-toggle="modal" id="editRegFullNow" class="btn btn-large btn-block btn-primary" ><em class="icon-fire icon-white"></em>Update the registration</a>
</div>
</div>
</div>
</form>
</div>
</div>
    
<!--Edit Registration start -->
<div id="registrationEditModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close shouldClose" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Edit Registration</h3>
</div>


<div class="modal-body">


    <form class="form-search" id="regEditSearchForm">
    <input type="text" name="regSearch" placeholder="ID or Registration Number">
    <button type="submit" class="btn" id="regEditSearch">Search</button>
    </form>
<p><h4 id="regEditAlert"></h4></p>
</div>
<div class="modal-footer">
<button class="btn shouldClose" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
<!--Edit Registration end -->


</div></div>
</body></html>
