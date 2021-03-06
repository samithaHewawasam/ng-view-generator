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
<link href="../library/css/style2.css" rel="stylesheet">
    <script src="../library/js/backstretch.js"></script>
    <script src="../library/js/typica-login.js"></script>
     <script src="../library/js/moment.js"></script>
    <script src="../library/js/core-home.js"></script>

  
<script src="../js/eSoft.js"></script>
<?php
include("Modal/dbLayer.php");

?>

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
 $(".fullPayNo").prop('checked', true);
 $(".fullPayYes").prop('checked', false);

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
      <div class="container" style="width:100%;padding:5px 10px">
        <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle=
        "collapse"><span class="icon-bar"></span> <span class=
        "icon-bar"></span> <span class="icon-bar"></span></a> <a class="brand"
        href="/">ESOFT</a>

        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class="divider-vertical"></li>
 <li class="dropdown">
<a class="dropdown-toggle"
data-toggle="dropdown"
href="#">
Registrations
<b class="caret"></b>
</a>
<ul class="dropdown-menu">
<li><a data-toggle="modal" class="getLastRegId" onClick="removeExistingDataFull()" href="#registrationFullModal"><em class="icon-user icon-white"></em>
User Registration</a>
              
            </li>

<li><a data-toggle="modal"  href="#HistoryLogFormModal"><em class="icon-edit icon-white"></em>
History Log</a>
</li>
<li><a data-toggle="modal"  href="#registrationStatusChange"><em class="icon-edit icon-white"></em>
Registration Status Change</a></li>
</ul>
</li>
<li>

    <li><a data-toggle="modal" id="QuickPayment" href="#QuickInitialsPayments"><em class="icon-fire icon-white"></em>
Quick Pay</a></li>
 <li><a data-toggle="modal" href="#afterPaymentFullModal"><em class="icon-fire icon-white"></em>
Detail Pay</a></li>
 <li><a  href="other_payments"><em class="icon-fire icon-white"></em>
Other payments</a></li>


<li><a data-toggle="modal" href="/administrator" target="_blank"><em class="icon-fire icon-white"></em>
Admin</a>
              
 </li>

<li><a data-toggle="modal" href="/edit" target="_blank"><em class="icon-fire icon-white"></em>
Edit</a>
              
 </li>
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
                  <li>
                    <a href="/Controller/export.php">Export a CSV</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <header class="hero hero-moment">

		<div class="hero-circle">
<span id='datelogged' class='Three-Dee'></span>
			<div class="hero-face">
				<div class="hero-hour" id="hour" style="transform: rotate(102.967deg);"></div>
				<div class="hero-minute" id="minute" style="transform: rotate(155.6deg);"></div>
				<div class="hero-second" id="second" style="transform: rotate(336deg);"></div>
			</div>
		</div>


</header>
<input type='hidden' value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" id='getLocalhost'>

      <div class="alert alert-success" id="mainAlert" >
       <button type="button" class="closeAlert" data-dismiss="alert">&times;</button>
    <strong>Hey!&nbsp;,</strong><span id="mainAlertInfo">,&nbsp; </span><span id="mainAlertInfoSelected" ></span>
    </div>
  
    <!--<div id="loader" style="display:none;position:absolute;top:150px;left:40%;z-index:10000;"><img src="../images/loader.gif"></div>-->
<div id="alertForNextStep" ></div>
    <div id="searchNowForm">
   <div class="center text-center" >
   
   
    <h2>Enter the student ID number </h2>

    <form action="" method="post" id="CheckUserForm">
      <div class="input-prepend">
        <span class="add-on"><em class="icon-user"></em></span> <input id="SM_ID_KEEP"
        name="SM_ID" placeholder="902456478v" type="text" autofocus required>
      </div><br>
      <a class="btn btn-large btn-success" id="CheckUserFormSubmit" data-original-title="Note:" href="#"  data-toggle="popover"  title="" data-content="Add your NIC,POSTAL ID,PASSPORT ID here">Search Now!</a> 
    </form>
    
        <div class="alert alert-error" style="display:none;">
 <strong>Warning!</strong><br><span id="errorDiv"></span>
    </div>
    
    <div class="alert alert-success" style="display:none;">

 <div class="center text-center" id="registrationType" >
         <form class="form-inline">
    <button  class="btn btn-large btn-success" data-toggle="modal" href="#QuickReg" type="button">Quick Registration</button><span style="font-size:24px;margin:0 20px 0 20px">or</span>
     <button  class="btn btn-large btn-success" data-toggle="modal" href="#FullReg" type="button">Full Registration</button>
 
    </form>
    
   </div>

    </div>


     </div>
         
  </div>
  

  
    <div id="FullReg" class="modal hide fade" tabindex="-1" data-width="760">
    <div class="modal-header">
    <button type="button" class="close shouldClose"  data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
<div id="fullRegistration">
     
      <h3>Full Registration</h3><hr>

    <div class="row"><!--row start-->
    <div class="span8"><!--span start-->
    <form   class="form-horizontal" id="student_master" accept-charset="utf-8"><!--Student form start-->
 
 <div class="control-group">
  <label for="date" class="control-label">Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" name="SM_Reg_Date" id="SM_Reg_DateF" size="16" type="text" value="12-02-2013" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>

  
    <div class="control-group">
    <label for="SM_ID_Type" class="control-label">	
    ID Type:
    </label>
    <div class="controls">
    <select class="input-medium" id="SM_ID_Type" name="SM_ID_Type">

                <option value="NIC">
                  NIC
                </option>

                <option value="Postal_ID">
                  Postal ID
                </option>

                <option value="Passpord_Number">
                  Passpord Number
                </option>
              </select>
    </div>
    </div>
   
    <div class="control-group">
    <label for="idNumber" class="control-label">	
    ID Number:
    </label>
    <div class="controls"><input type="text" id="idNumber" class="gotIdFromSearch" class="form-control" style="text-transform:uppercase" name="SM_ID" placeholder="902456478v" >
    </div>
    </div>
    
    <div class="control-group">
    <label for="SM_Title" class="control-label">	
     Title:
    </label>
    <div class="controls"><select class="input-mini" id="SM_Title" name="SM_Title">

                <option value="Rev">
                  Rev
                </option>

                <option value="Dr">
                  Dr
                </option>

                <option value="Mr">
                  Mr
                </option>

                <option value="Mrs">
                  Mrs
                </option>

                <option value="Miss">
                  Miss
                </option>
              </select>
    </div>
    </div>
     

  <div class="control-group">
   <label for="SM_First_Name" class="control-label">First Name:</label>
    <div class="controls">
      <input type="text" class="form-control" autocomplete="off"  maxlength="20" title="20 Characters Only" id="SM_First_Name" name="SM_First_Name" placeholder="First Name" required>

    </div>
  </div>
 <div class="control-group">
  <label for="SM_Last_Name" class="control-label">Last Name:</label>
    <div class="controls">
      <input type="text" class="form-control" autocomplete="off"  maxlength="30" title="30 Characters Only" id="SM_Last_Name" name="SM_Last_Name" placeholder="Last Name" required>

  </div></div>

 <div class="control-group">
  <label for="SM_Gender" class="control-label"> Gender:</label>
    <div class="controls">
      <select class="selectpicker input-small" id="SM_GenderFull" name="SM_Gender">
                <option value="">
                  
                </option>
                <option value="male">
                  Male
                </option>

               <option value="female">
                 Female
                </option>
              </select>
    </div>
  </div>



 <div class="control-group">
  <label for="SM_Date_of_Birth" class="control-label">Date Of Birth:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" name="SM_Date_of_Birth" id="SM_Date_of_Birth" size="16" type="text" value="12-02-2013" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>



<h3>ADDRESS</h3><hr>
 <div class="control-group">
  <label for="SM_Address_1" class="control-label">House No:</label>
    <div class="controls">
      <input type="text" class="form-control input-small" autocomplete="off" id="SM_House_NO" name="SM_House_NO" placeholder="211/A">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Address_2" class="control-label">Lane:</label>
    <div class="controls">
      <input type="text" class="form-control" autocomplete="off" id="SM_Address_2" name="SM_Lane" placeholder="1st Lane">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Address_3" class="control-label">Town:</label>
    <div class="controls">
      <input type="text" class="form-control" autocomplete="off" id="SM_Address_3" name="SM_Town" placeholder="Bambalapitiya">
    </div>
  </div>

<div class="control-group">
 <label for="SM_City" class="control-label">City:</label>
    <div class="controls">
      <input type="text" class="form-control" autocomplete="off" id="SM_City" name="SM_City" placeholder="Colombo">
    </div>
  </div>

	<div class="control-group">
<label for="country" class="control-label">	
Country
</label>
<div class="controls">
<select name="SM_Country" id="SM_Country">
<option selected="selected" value="Srilanka">Srilanka</option>
<option value="AR">Argentina</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BR">Brazil</option>
<option value="BG">Bulgaria</option>
<option value="CA">Canada</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CO">Colombia</option>
<option value="CR">Costa Rica</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DO">Dominican Republic</option>
<option value="EG">Egypt</option>
<option value="EE">Estonia</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="HK">Hong Kong S.A.R., China</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="KZ">Kazakhstan</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Laos</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MK">Macedonia</option>
<option value="MY">Malaysia</option>
<option value="MT">Malta</option>
<option value="MX">Mexico</option>
<option value="MD">Moldova</option>
<option value="MC">Monaco</option>
<option value="ME">Montenegro</option>
<option value="MA">Morocco</option>
<option value="NL">Netherlands</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="KP">North Korea</option>
<option value="NO">Norway</option>
<option value="PK">Pakistan</option>
<option value="PS">Palestinian Territory</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RO">Romania</option>
<option value="RU">Russia</option>
<option value="SA">Saudi Arabia</option>
<option value="RS">Serbia</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="ZA">South Africa</option>
<option value="KR">South Korea</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="TW">Taiwan</option>
<option value="TH">Thailand</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option value="US">USA</option>
<option value="UZ">Uzbekistan</option>
<option value="VN">Vietnam</option>
</select>
</div>
</div>
 

<div class="control-group">
 <label for="SM_Postal_Code" class="control-label">Postal Code:</label>
    <div class="controls">
      <input type="text" class="form-control input-small" autocomplete="off" id="SM_Postal_Code" name="SM_Postal_Code" placeholder="11126">
    </div>
  </div>
     
<h3>CONTACT DETAILS</h3><hr>

<div class="control-group">
 <label for="SM_Tel_Residance" class="control-label">Phone Home:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_Tel_Residance" autocomplete="off" maxlength='10' name="SM_Tel_Residance" placeholder="Phone Home">
    </div>
  </div>
<div class="control-group">
 <label for="SM_Tell_Work" class="control-label">Phone Work:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_Tell_Work" autocomplete="off"  maxlength='10' name="SM_Tell_Work" placeholder="Phone Work">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Tell_Mobile" class="control-label">Mobile:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_Tell_Mobile" autocomplete="off" maxlength="10"  name="SM_Tell_Mobile" placeholder="Mobile" >
    </div>
  </div>

 <div class="control-group">
  <label for="SM_Gender" class="control-label"> How did you know about us?</label>
    <div class="controls">
      <select class="selectpicker" id="SM_Source" name="SM_Source">
              <option value="">
                 Please select the source
                </option>
                <option value="News Paper Ad">
                  News Paper Ad
                </option>
               <option value="Press Article">
                 Press Article
                </option>
               <option value="Seminar/Event">
                 Seminar/Event
                </option>
               <option value="Exhibition">
                 Exhibition
                </option>
               <option value="School Presentation">
                 School Presentation
                </option>
               <option value="Invitation">
                 Invitation
                </option>
               <option value="World of mouth">
                 Word of mouth
                </option>
               <option value="Telemarketing">
                 Telemarketing
                </option>
               <option value="Referral Scheme">
                 Referral Scheme
                </option>
               <option value="Agent">
                 Agent
                </option>
               <option value="Web/E-mail">
                 Web/E-mail
                </option>
                <option value="Facebook">
                Facebook
                </option>
                <option value="From Friend">
                From Friend
                </option>
              </select>
    </div>
  </div>

<div class="control-group">
 <label for="SM_Mail_Personal" class="control-label">E-Mail Personal:</label>
    <div class="controls">
      <input type="text" class="form-control" id="lastName" autocomplete="off" name="SM_Mail_Personal"  placeholder="E-Mail Personal">
    </div>
  </div>
<div class="control-group">
 <label for="SM_Mail_Work" class="control-label">E-Mail Work:</label>
    <div class="controls">
      <input type="text" class="form-control" id="lastName" autocomplete="off" name="SM_Mail_Work"  placeholder="E-Mail Work">
    </div>
  </div>

<h3>PARENT DETAILS</h3><hr>

<div class="control-group">
 <label for="SM_Use_Parent_ID" class="control-label">Parent ID:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_Use_Parent_ID" autocomplete="off" name="SM_Use_Parent_ID"  placeholder="Parent ID">
    </div>
  </div>

<div class="control-group">
 <label for="SM_Parent_Name" class="control-label">Name:</label>
    <div class="controls">
      <input type="text" class="form-control" id="lastName" autocomplete="off" name="SM_Parent_Name"  placeholder="Name">
    </div>
  </div>
<div class="control-group">
 <label for="SM_Parent_Phone" class="control-label">Phone:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_Parent_Phone" autocomplete="off" maxlength="10"  name="SM_Parent_Phone"   placeholder="Phone">
    </div>
  </div>

<div class="centerButton">
<!-- Indicates a successful or positive action -->
<input type="submit" id="StudentMasterSubmit" class="btn btn-large btn-primary" value="submit" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-large">Clear</button>
</div>
      </form>
 
    </div> <!-- .span8 -->
    </div>
 
</div></div></div>


 <!--///////Quick Registration////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->



 <!--Quick Registration modal hide-->
    <div id="QuickReg" class="modal hide fade" tabindex="-1" data-width="760" style="height:1000px;">
    <div class="modal-header">
    <button type="button" class="close shouldClose" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
<div id="quickRegistration">
    <h3>Quick Registration</h3><hr>

    <div class="row"><!--row start-->
    <div class="span8"><!--span start-->
    <form  class="form-horizontal" id="quickRegistrationform" accept-charset="utf-8"><!--Student form start-->

    <div class="control-group">
  <label for="date" class="control-label">Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" name="SM_Reg_Date" id="SM_Reg_DateQ" size="16" type="text" value="12-02-2013" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>
    <div class="control-group">
    <label for="SM_ID_Type" class="control-label">	
    ID Type:
    </label>
    <div class="controls">
    <select class="input-medium" id="SM_ID_Typeq" name="SM_ID_Type">

                <option value="NIC">
                  NIC
                </option>

                <option value="Postal_ID">
                  Postal ID
                </option>

                <option value="Passpord_Number">
                  Passpord Number
                </option>
              </select>
    </div>
    </div>
   
    <div class="control-group">
    <label for="idNumber" class="control-label">	
    ID Number:
    </label>
    <div class="controls"><input type="text" class="gotIdFromSearch" autocomplete="off" id="idNumberq" class="form-control" name="SM_ID" placeholder="902456478v" maxlength='10' style="text-transform:uppercase">
    </div>
    </div>
    
    <div class="control-group">
    <label for="SM_Title" class="control-label">	
     Title:
    </label>
    <div class="controls"><select class="input-mini" id="SM_Title"  name="SM_Title">

                <option value="Rev">
                  Rev
                </option>

                <option value="Dr">
                  Dr
                </option>

                <option value="Mr">
                  Mr
                </option>

                <option value="Mrs">
                  Mrs
                </option>

                <option value="Miss">
                  Miss
                </option>
              </select>
    </div>
    </div>
           
  
  <div class="control-group">
   <label for="SM_First_Name" class="control-label">First Name:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_First_Name" maxlength="20" title="20 Characters Only" autocomplete="off" name="SM_First_Name" placeholder="First Name" required>
    </div>
  </div>
 <div class="control-group">
  <label for="SM_Last_Name" class="control-label">Last Name:</label>
    <div class="controls">
      <input type="text" class="form-control" id="lastName" maxlength="30" title="30 Characters Only" name="SM_Last_Name" autocomplete="off" placeholder="Last Name" required>
    </div>
  </div>

 <div class="control-group">
  <label for="SM_Gender" class="control-label"> Gender:</label>
    <div class="controls">
      <select class="selectpicker input-small" id="SM_Gender" name="SM_Gender">

                <option value="">
                  
                </option>
                <option value="male">
                  Male
                </option>

               <option value="female">
                 Female
                </option>
              </select>
    </div>
  </div>


 <div class="control-group">
  <label for="SM_Date_of_Birth" class="control-label">Date Of Birth:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" size="16" name="SM_Date_of_Birth" type="text" value="" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>


<div class="control-group">
 <label for="SM_Tell_Mobile" class="control-label">Mobile:</label>
    <div class="controls">
      <input type="text" class="form-control" id="SM_Tell_Mobileq" maxlength="10"  autocomplete="off" title="it should be valid mobile number" name="SM_Tell_Mobile" placeholder="Mobile" style="text-transform:uppercase">
    </div>
  </div>

 <div class="control-group">
  <label for="SM_Gender" class="control-label"> How did you know about us?</label>
    <div class="controls">
      <select class="selectpicker" id="SM_Source" name="SM_Source">
                <option value="">
                  Please select the source
                </option>
                <option value="News Paper Ad">
                  News Paper Ad
                </option>
               <option value="Press Article">
                 Press Article
                </option>
               <option value="Seminar/Event">
                 Seminar/Event
                </option>
               <option value="Exhibition">
                 Exhibition
                </option>
               <option value="School Presentation">
                 School Presentation
                </option>
               <option value="Invitation">
                 Invitation
                </option>
               <option value="World of mouth">
                 Word of mouth
                </option>
               <option value="Telemarketing">
                 Telemarketing
                </option>
               <option value="Referral Scheme">
                 Referral Scheme
                </option>
               <option value="Agent">
                 Agent
                </option>
               <option value="Web/E-mail">
                 Web/E-mail
                </option>
                <option value="Facebook">
                Facebook
                </option>
                <option value="From Friend">
                From Friend
                </option>
              </select>
    </div>
  </div>


<div class="centerButton">
<!-- Indicates a successful or positive action -->
<input type="submit" id="quickRegistrationformSubmit" autocomplete="off" class="btn btn-large btn-primary" value="submit" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-large">Clear</button>
</div>
      </form>
 
    </div> <!-- .span8 -->
    </div>
 
</div>


						</div>                            
                    </div>


 <!--2nd form////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  
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
<h3 id="esoftRegistration">Registrations @ ESOFT</h3><hr>
<div class="registerUserName"></div>
    <div class="row">
    <div class="span8">
    <form action="billing" method="post" class="form-horizontal" id="billingform" accept-charset="utf-8">
   
    <div class="control-group">
    <label for="idNumber" class="control-label">	
    Reg No:
    </label>
    <div class="controls"><input type="text" id="RG_Reg_NO" class="form-control" name="RG_Reg_NO" placeholder="COL/A-4526" value="<?php echo $_SESSION['branchCode']; ?>" style="text-transform:uppercase">
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
    include('Modal/courseTypeList.php');
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
    
  <!--    <div class="control-group" id='NewBatchAdd'>
    <label for="idNumber" class="control-label">	
    I need a batch?:
    </label>
    <div class="controls">
  <button id="batchMasterOpen" class="btn btn-medium btn-success" type="button" >
       Create it! 
    </button>
   </div>
    </div>-->
    
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
    <div class="controls" id='SelectedSubjectSet'>
    
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
    <label class="control-label" for="SM_ID_Type">Coupon Code:</label>

    <div class="controls">
      <input class='form-control' id="couponCode" name='couponCode' type='text' value="">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="SM_ID_Type">Discount Plan:</label>

    <div class="controls" id="discountPlanSet"></div>
  </div>

  <div class="control-group">
    <label class="control-label" for="SM_ID_Type">Discount Comment:</label>

    <div class="controls" id="discountComment">
      <textarea class="form-control" id="RG_Dis_Comment" name="RG_Dis_Comment">
</textarea>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="SM_ID_Type">Registration Fee:</label>

    <div class="controls" id="RG_Reg_Fee_Input">
      <div class="input-prepend">
        <span class="add-on accsepttingCurrency">LKR</span> <input class='form-control' id='RG_Reg_Fee' name='RG_Reg_Fee' readonly type='text' value=""> Without Registration Fee ? <input class='form-control' id='RG_Reg_Fee_zero' name='RG_Reg_Fee_zero' type='radio' value="Zero">
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
    <label class="control-label">Can you able to pay in full ?:</label>

    <div class="controls">
      <label class="checkbox">Yes:<input class="fullPay fullPayYes" name="fullPay" type="radio"></label> <label class="control-label">No: <input checked class="fullPay fullPayNo" name="fullPay" type="radio"></label>
    </div>
  </div>
   




 <div id="fullPayInput" style="display:none; margin:0 0 30px 0">
 <div class="control-group">
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
   </tr>
     </table>

    </div>
    </div>

  
    </div>
<div class="center text-center">
<div class="controls">
<a data-toggle="modal" id="registerUserSubmit" class="btn btn-large btn-block btn-primary" ><em class="icon-fire icon-white"></em>Register Now!</a>
</div>
</div>
</div>
</form>
</div>
</div>
     <div class="modal hide fade" data-width="960" id="initialsPayments"
    tabindex="-1">
        <div class="modal-header">
            <button class="close shouldClose" data-dismiss="modal" 
            type="button">×</button>

            <h3>Payments</h3>
        </div>

        <div class="modal-body">
            <form id="initialsPaymentsData" name="initialsPaymentsData">
                <input id="RG_Branch_Code_nintial_payment" name=
                "RG_Branch_Code" type="hidden" value=
                "<?php echo $_SESSION['branchCode']; ?>" style="text-transform:uppercase"> <input id=
                "selectedBatchForPrint" name="selectedBatchForPrint" type=
                "hidden" value=""> <input id="RG_Date_initial_payments" name=
                "RG_Date" type="hidden" value=""> <input id=
                "registerUserForPrint" name="registerUserForPrint" type=
                "hidden" value=""> <input id="RG_Reg_N0_Payments" name=
                "RG_Reg_N0" type="hidden" value="">

                <div class="modal hide fade" data-width="960" id="printPdf">
                    <div class="modal-header">
                        <button class="close printModalClose" style="position:absolute !important;top:0 !important;right:0 !important"data-dismiss="modal" type=
                        "button">×</button>
                    </div>
<div class='modal-body' ><iframe id="modal-body-print" src="" style="border:0px #FFFFFF none;" name="myiFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="600px" width="800px"></iframe></div>
               <span class="printInfo">Print this receipt ==></span> </div>

                <div class="InvoiceNumber">
                    <div class="control-group">
                        <label class="control-label" for=
                        "SM_Date_of_Birth">Invoice Number:</label>

                        <div class="controls">
                            <input class="span3" id="putInvoiceNumber" name=
                            "PM_Receipt_No" readonly type="text" value="">
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">How much ?</label>

                    <div class="input-prepend input-append">
                        <span class="add-on accsepttingCurrency">LKR</span> <input class="span2" id=
                        "PM_Amount" name="PM_Amount" readonly type="text">
                    </div>
                </div>

                <p class="lead">Select your payment plan</p>

                <div style="margin:0 0 30px 0">
                    <div class="btn-group" data-toggle="buttons-radio" id=
                    "tab">
                        <a class="btn btn-info cash" data-toggle="tab" href=
                        "#cash">Cash</a> <a class="btn btn-info creditCard"
                        data-toggle="tab" href="#creditCard">Credit Card &amp;
                        Debit Card</a> <a class="btn btn-info cheque"
                        data-toggle="tab" href="#cheque">Cheques</a>
                        <input class="span6" id="PM_Type" name="PM_Type" type=
                        "hidden">
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="well well-small" id="paymentArea">
                        <div class="container">
                            <div class="span6">
                                <div class="area">
                                    <div class="tab-content">
                                        <div class="tab-pane hide" id=
                                        "creditCard">
                                            <form class=
                                            "form-horizontal span6">
                                                <fieldset>
                                                    <div class="control-group">
                                                        <label class=
                                                        "control-label">How
                                                        much ?</label>

                                                        <div class=
                                                        "input-prepend input-append">
                                                   <span class=
                                                    "add-on accsepttingCurrency  payingCurrency">LKR</span>
<div class="btn-group currencySet"></div>
                                                            <input class=
                                                            "span6 getPayment" id=
                                                            "PM_Amount_credit"
                                                            name=
                                                            "PM_Amount_credit"
                                                            type="text">
                                                            <span class=
                                                            "add-on">/=</span>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class=
                                                        "control-label">Card
                                                        Holder Name</label>

                                                        <div class="controls">
                                                            <input class=
                                                            "input-block-level"
                                                            name=
                                                            "PM_Card_Holder_Name"
                                                            pattern="\w+ \w+.*"
                                                            required="" title=
                                                            "Fill your first and last name"
                                                            type="text">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class=
                                                        "control-label">Card
                                                        Number</label>

                                                        <div class="controls">
                                                            <div class=
                                                            "row-fluid">
                                                                <div class=
                                                                "span3">
                                                                    <input autocomplete="off"
                                                                    class=
                                                                    "input-block-level oneNo"
                                                                    id=
                                                                    "credit-card"
                                                                    maxlength=
                                                                    "4"
                                                                    pattern="\d{4}"
                                                                    required=""
                                                                    title=
                                                                    "First four digits"
                                                                    type=
                                                                    "text">
                                                                </div>

                                                                <div class=
                                                                "span3">
                                                                    <input autocomplete="off"
                                                                    class=
                                                                    "input-block-level twoNo"
                                                                    maxlength=
                                                                    "4"
                                                                    pattern="\d{4}"
                                                                    required=""
                                                                    title=
                                                                    "Second four digits"
                                                                    type=
                                                                    "text">
                                                                </div>

                                                                <div class=
                                                                "span3">
                                                                    <input autocomplete="off"
                                                                    class=
                                                                    "input-block-level threeNo"
                                                                    maxlength=
                                                                    "4"
                                                                    pattern="\d{4}"
                                                                    required=""
                                                                    title=
                                                                    "Third four digits"
                                                                    type=
                                                                    "text">
                                                                </div>

                                                                <div class=
                                                                "span3">
                                                                    <input autocomplete="off"
                                                                    class=
                                                                    "input-block-level fourNo"
                                                                    maxlength=
                                                                    "4"
                                                                    pattern="\d{4}"
                                                                    required=""
                                                                    title=
                                                                    "Fourth four digits"
                                                                    type=
                                                                    "text">
                                                                    <input id=
                                                                    "hiddenCreditCardNumer"
                                                                    name=
                                                                    "PM_Card_NO"
                                                                    type=
                                                                    "hidden"
                                                                    value="">
                                                                    <input id=
                                                                    "hiddenCreditCardType"
                                                                    name=
                                                                    "PM_Card_Type"
                                                                    type=
                                                                    "hidden"
                                                                    value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Card Images Output -->

                                                    <div class="control-group">
                                                        <label class=
                                                        "control-label">Accepted
                                                        Cards</label>

                                                        <div class="controls">
                                                            <div class=
                                                            "pull-left" id=
                                                            "accepted-cards-images">
                                                            <!-- Icons Automatically Inserted Here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>

                                        <div class="tab-pane hide" id="cash">
                                            <div class="control-group">
                                                <label class=
                                                "control-label">How much
                                                ?</label>

                                                <div class=
                                                "input-prepend input-append">
                                                    <span class=
                                                    "add-on accsepttingCurrency  payingCurrency">LKR</span>
<div class="btn-group currencySet"></div>
                                                    <input class="span6 getPayment" id=
                                                    "PM_Amount_Cash" name=
                                                    "PM_Amount_Cash" type=
                                                    "text"> <span class=
                                                    "add-on">/=</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane hide" id="cheque">
                                            <div class="control-group">
                                                <label class=
                                                "control-label">How much
                                                ?</label>

                                                <div class=
                                                "input-prepend input-append">
                                                                       <span class=
                                                    "add-on accsepttingCurrency  payingCurrency">LKR</span>
<div class="btn-group currencySet"></div>
                                                    <input class="span6 getPayment" id=
                                                    "PM_Amount_Cheque" name=
                                                    "PM_Amount_Cheque" type=
                                                    "text"> <span class=
                                                    "add-on">/=</span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label>Add your Cheque
                                                Number</label>

                                                <div class="controls">
                                                    <div class="span5">
                                                        <input autocomplete=
                                                        "off" class=
                                                        "input-block-level"
                                                        maxlength="30" name=
                                                        "PM_Cheque_NO" pattern=
                                                        "\d{306}" required
                                                        title="six digits"
                                                        type="text">
                                                    </div>
                                                </div>
                                                <!-- Script to control the card input -->
                                                <script type="text/javascript">

                                                // Make sure that this code goes within a doc ready
                                                $(document).ready(function() {

                                                // Step #1: Cache Selectors
                                                var creditCard = $("#credit-card"),
                                                cardGrandParent = creditCard.parent().parent();

                                                // Step #2: Setup Callbacks on Events
                                                creditCard.on("cc:onReset cc:onGuess", function() {

                                                cardGrandParent.removeClass().addClass("control-group");

                                                }).on("cc:onInvalid", function() {

                                                cardGrandParent.removeClass().addClass("control-group error");
                                                $("#credit-card-type-text").text("");

                                                }).on("cc:onValid", function(event, card, niceName) {

                                                cardGrandParent.removeClass().addClass("control-group success");

                                                }).on("cc:onCardChange", function(event, card, niceName) {

                                                $("#credit-card-type-text").text(niceName);
                                                $("#hiddenCreditCardType").val(niceName);
                                                // Step #3: Initialize the cardcheck plugin
                                                }).cardcheck({ iconLocation: "#accepted-cards-images" });

                                                });
                                                </script>
                                            </div><br>
                                            <br>

                                            <div class="control-group">
                                                <label class=
                                                "control-label">Cheque issue
                                                banks name</label>

                                                <div class=
                                                "input-prepend input-append">
                                                    <input class="form-control"
                                                    name="PM_Cheque_Bank" type=
                                                    "text">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label"
                                                for="SM_Date_of_Birth">Cheque
                                                due date:</label>

                                                <div class="controls">
                                                    <div class=
                                                    "input-append date dp3"
                                                    data-date-format=
                                                    "yyyy-mm-dd">
                                                        <input class="span7"
                                                        name=
                                                        "PM_Cheque_Due_Date"
                                                        readonly size="16"
                                                        type="text" value=
                                                        ""><span class=
                                                        "add-on icon-th" style=
                                                        "font-style: italic"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<input type="hidden" id="excesspaymentId" name="excessPayment">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

<div class="modal-footer hide payNow">
    <button class="btn" data-dismiss="modal" onClick="reloadPage()" type="button">Close</button>
<input class="btn btn-primary" id="initialsPaymentsDataSubmit" type="submit" value="Pay Now & Get the Print Preview">
</div>
        </div>
    </div><!--Sign Up modal hide end-->
    <!--Branch Master-->
    <!--Sign Up modal hide-->
    <!--BratchMaster-->

    <div class="modal hide fade" data-width="600" id="batchMaster"></div>
    <!--Sign Up modal hide end-->


 <!--Payment form////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  
      <div id="afterPaymentFullModal" class="modal hide fade" tabindex="-1" data-width="960">
    <div class="modal-header">
    <button type="button" class="close shouldClose"  data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
     <div class="paymentData">
     
     
     
     <div class="topDate">
      <div class="control-group">
  <label for="PaymentDate" class="control-label">Payment date:</label>
    <!--controls--><div class="controls">
      
        <!--date--><div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" id="PM_Date_After_Full" size="16" type="text" name="PM_Date" value="" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div><!--/date-->
    </div> <!--/controls-->
  </div>
     
</div>

     
</div>

<h3>Payments</h3><hr>

    <div class="row">
    <div class="span8">
    <form action="billing" method="post" class="form-horizontal" id="billingform" accept-charset="utf-8">
   
    <div class="control-group">
    <label for="idNumber" class="control-label">	
    Reg No:
    </label>
    <div class="controls"><input type="text" id="regNoPayments" class="form-control" style="text-transform:uppercase" name="RG_Reg_N0" value="<?php echo $_SESSION['branchCode']."-"; ?>" >
    </div>
    </div>
   
    
    <div class="control-group" id="idNumberPayments">
    <label for="idNumber" class="control-label">	
    ID Number:
    </label>
    <div class="controls"><input type="text" id="idNumberPayment" class="form-control" name="SM_ID" placeholder="902456478v" readonly>
    </div>
    </div>
    
       <div class="control-group">
    <label for="idNumber" class="control-label">	
    Full Name:
    </label>
    <div class="controls"><input type="text" id="fullNamePayment" class="form-control span5" name="PM_Stu_Name" placeholder="Mr: Roopasignha Aranchige Indiak Prashad" readonly>
    </div>
    </div>

  <div class="control-group">
    <label for="idNumber" class="control-label">	
    Address:
    </label>
    <div class="controls"><textarea class="form-control" raw="8" id="addressPayment" name="PM_Stu_Address" readonly></textarea>
    </div>
    </div>

<div class="control-group">
    <label for="idNumber" class="control-label">	
    Registration Type:
    </label>
    <div class="controls"><input type="text" id="RG_Type_Payment" class="form-control" name="PM_Course_Code" placeholder="BCS-S1" readonly>
    </div>
    </div>


<div class="control-group">
    <label for="idNumber" class="control-label">	
    Batch No:
    </label>
    <div class="controls"><input type="text" id="batchNumerPayment" class="form-control" name="PM_Batch_No" placeholder="BCS" readonly>
    </div>
    </div>

    
     <div class="control-group"><label class="control-label">Course Fee</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency">LKR</span>
    <input class="span2" id="courseFeePayment" name="PM_Amount" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>
    
        <div class="control-group"><label class="control-label">Total Paid</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency">LKR</span>
    <input class="span2" id="totalPaidPayment" name="PM_Amount_Total_Paid" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>
    
    <div class="control-group"><label class="control-label">Balance Due</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency">LKR</span>
    <input class="span2" id="balanceDuePayment" name="Balance_Due" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>
    
    
     <div class="control-group"><label class="control-label">Upto date due</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency">LKR</span>
    <input class="span2" id="uptoDateDue" name="Upto_Date_New" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>
    

    <div class="control-group alert alert-block"><label class="control-label">Today Payment</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency"></span>
    <input class="span2" id="totalPayment" name="PM_Amount_Total" type="text" >
    <span class="add-on">/=</span>
    </div></div></div>
    
    
     <div class="paymentInstallments">
      <div class="control-group">
    <label for="idNumber" class="control-label">	
    Installments:
    </label>
    <div class="controls" id="afterPaymentsInstallmentControls">
    </div>
    </div>
 </div>
    <div class="control-group"> <div class="controls">
    <a data-toggle="modal" id="afterPayNowSubmit" class="btn btn-large btn-block btn-primary" href="#initialsPayments" ><em class="icon-fire icon-white"></em>Pay Now!</a> </div>
    </div>



 <!--loginAuthentication modal hide-->
    <div id="loginAuthentication" class="modal hide fade" tabindex="-1" data-width="300">
    <div class="modal-body">
<button type="button" class="close authCloseSpecial"  data-dismiss="modal" aria-hidden="true">×</button>
    <div class="container">

       <form class="form-horizontal" id="loginAuthenticationSpecialDiscountForm">
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
</div></div>

<!-- quick payments -->

   
    <div id="QuickInitialsPayments" class="modal hide fade" tabindex="-1" data-width="960">
    <div class="modal-header">
    <button type="button" class="close shouldClose"  data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Quick Payments</h3>
    </div>
    <div class="modal-body">
    <form id="QuickinitialsPaymentsData">


<div class="control-group">
    <label for="QuickRegNo" class="control-label">	
    Reg No:
    </label>
    <div class="controls"><input type="text" id="QuickregNoPayments" class="form-control" name="RG_Reg_N0" style="text-transform:uppercase" value="<?php echo $_SESSION['branchCode']."-"; ?>" >	
      <label for="QuickRegNo" class="control-label">	
    Name:
    </label>
   <input type="text" value="" id="QuickregisterUserForPrint" name="registerUserForPrint" class="span4" readonly>
      <input type="hidden" id="excesspaymentQuickId" name="excessPayment" class="span4" />
    </div>
	
    </div>

 <div class="control-group" id="QuickbalanceDueDiv"><label class="control-label">Balance Due</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency">LKR</span>
    <input class="span2" id="QuickbalanceDuePayment" name="Balance_Due" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>
    
    
     <div class="control-group" id="quickuptoDateDueDiv"><label class="control-label">Upto date due</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency">LKR</span>
    <input class="span2" id="QuickuptoDateDue" name="Upto_Date_New" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>


<input type="hidden" value="<?php echo $_SESSION['branchCode']; ?>" style="text-transform:uppercase" id="QuickRG_Branch_Code_nintial_payment" name="RG_Branch_Code"> 
<input type="hidden" value="" id="QuickselectedBatchForPrint" name="selectedBatchForPrint"> 


   <div id="QuickprintPdf" class="modal hide fade" data-width="960">
 <div class="modal-header">
                        <button class="close printModalClose" style="position:absolute !important;top:0 !important;right:0 !important"data-dismiss="modal" type=
                        "button">×</button>
                    </div>
<div class='modal-body' ><iframe id="modal-body-printq" src="" style="border:0px #FFFFFF none;" name="myiFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="600px" width="800px"></iframe></div>
               <span class="printInfo">Print this receipt ==></span> </div>

   <div class="InvoiceNumber">
      <div class="control-group">
  <label for="SM_Date_of_Birth" class="control-label">Invoice Number:</label>
    <div class="controls">
      
       
    <input class="span3" id="QuickputInvoiceNumber" type="text" name="PM_Receipt_No" value="" readonly>
    </div>
    </div>
  </div>
      <div class="topDate" style="right: 245px !important;">
      <div class="control-group">
  <label for="PaymentDate" class="control-label">Payment date:</label>
    <!--controls--><div class="controls">
      
        <!--date--><div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2" id="QuickPM_Date_After_Full" size="16" type="text" name="RG_Date" value="" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div><!--/date-->
    </div> <!--/controls-->
  </div>
     
</div>
<div id="quickPaymentsInstallmentControls"></div>


    <p class="lead">Select your payment plan</p>
     <div style="margin:0 0 30px 0">
<div id="tab" class="btn-group" data-toggle="buttons-radio">
<a href="#Quickcash" class="btn btn-info Quickcash" data-toggle="tab">Cash</a>
<a href="#QuickcreditCard" class="btn btn-info QuickcreditCard" data-toggle="tab">Credit Card & Debit Card</a>
<a href="#Quickcheque" class="btn btn-info Quickcheque" data-toggle="tab">Cheques</a>
 <input class="span6" name="PM_Type" id="QuickPM_Type" type="hidden">
</div>
 </div>
    <div class="row-fluid">
      <div class="well well-small" id="QuickpaymentArea">
    
    <div class="container">
        	
                    <div class="span6">
                    	<div class="area">
                    	
                    	
<div class="tab-content">
<div class="tab-pane hide" id="QuickcreditCard">


 <form class="form-horizontal span6">
    <fieldset>
   
    <div class="control-group"><label class="control-label">How much ?</label>

    <div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency payingCurrency">LKR</span>
<div class="btn-group currencySet"></div>
    <input class="span6 getPayment" id="QuickPM_Amount_credit" name="PM_Amount_credit" type="text">
    <span class="add-on">/=</span>
    </div></div>
   
    <div class="control-group">
    <label class="control-label">Card Holder Name</label>
    <div class="controls">
    <input type="text" class="input-block-level" name="PM_Card_Holder_Name" pattern="\w+ \w+.*" title="Fill your first and last name" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label">Card Number</label>
    <div class="controls">
    <div class="row-fluid">
    <div class="span3">
    <input type="text" id="Quickcredit-card"  class="input-block-level QuickoneNo" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" required>
    </div>
    <div class="span3">
    <input type="text" class="input-block-level QuicktwoNo" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required>
    </div>
    <div class="span3">
    <input type="text" class="input-block-level QuickthreeNo" autocomplete="off"  maxlength="4" pattern="\d{4}" title="Third four digits" required>
    </div>
    <div class="span3">
    <input type="text" class="input-block-level QuickfourNo" autocomplete="off"  maxlength="4" pattern="\d{4}" title="Fourth four digits" required>
<input type="hidden" id="QuickhiddenCreditCardNumer" name="PM_Card_NO" value="">
<input type="hidden" id="QuickhiddenCreditCardType" name="PM_Card_Type" value="">
    </div>
    </div>
    </div>
    </div>
    
    <!-- Card Images Output -->
<div class="control-group">
    <label class="control-label">Accepted Cards</label>
    <div class="controls">
        <div class="pull-left" id="Quickaccepted-cards-images">
            <!-- Icons Automatically Inserted Here -->
        </div>
    </div>
</div>
    </fieldset>
    </form>



</div>
<div class="tab-pane hide" id="Quickcash">
 <div class="control-group"><label class="control-label">How much ?</label>

    <div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency payingCurrency">LKR</span>
<div class="btn-group currencySet"></div>
    <input class="span6 getPayment" name="PM_Amount_Cash" id="QuickPM_Amount_Cash" type="text">
    <span class="add-on">/=</span>
    </div></div>


</div>
<div class="tab-pane hide" id="Quickcheque">

 <div class="control-group"><label class="control-label">How much ?</label>

    <div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency payingCurrency">LKR</span>
<div class="btn-group currencySet"></div>
    <input class="span6 getPayment" name="PM_Amount_Cheque" id="QuickPM_Amount_Cheque" type="text">
    <span class="add-on">/=</span>
    </div></div>

<div class="control-group">
    <label>Add your Cheque Number</label>
    <div class="controls">
 <div class="span5">
    <input type="text" name="PM_Cheque_NO" class="input-block-level" autocomplete="off" maxlength="30" pattern="\d{30}" title="six digits" required>
    </div>


</div>


<!-- Script to control the card input -->
<script type="text/javascript">

// Make sure that this code goes within a doc ready
$(document).ready(function() {
    
    // Step #1: Cache Selectors
    var creditCard = $("#Quickcredit-card"),
        cardGrandParent = creditCard.parent().parent();
    
    // Step #2: Setup Callbacks on Events
    creditCard.on("cc:onReset cc:onGuess", function() {

        cardGrandParent.removeClass().addClass("control-group");

    }).on("cc:onInvalid", function() {

        cardGrandParent.removeClass().addClass("control-group error");
        $("#Quickcredit-card-type-text").text("");

    }).on("cc:onValid", function(event, card, niceName) {

        cardGrandParent.removeClass().addClass("control-group success");

    }).on("cc:onCardChange", function(event, card, niceName) {

        $("#Quickcredit-card-type-text").text(niceName);
 $("#QuickhiddenCreditCardType").val(niceName);
    // Step #3: Initialize the cardcheck plugin
    }).cardcheck({ iconLocation: "#Quickaccepted-cards-images" });

});
</script>




</div><br><br>

<div class="control-group"><label class="control-label">Cheque issue banks name</label>

    <div class="input-prepend input-append">
     
    <input class="form-control" name="PM_Cheque_Bank" type="text">
   
    </div></div>


 <div class="control-group">
  <label for="Cheque" class="control-label">Cheque due date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span7" size="16" name="PM_Cheque_Due_Date" type="text" value="" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>


</div>
                    	
                <br/><br/><br/>    	
                            
			</div>  

		<div class="modal-footer hide QuickpayNow">
    <button type="button" data-dismiss="modal"  class="btn shouldClose">Close</button>
    <input type="submit" id="QuickinitialsPaymentsDataSubmit" class="btn btn-primary" value="Pay Now & Get the Print Preview" />
    </div></form>	                          
                    </div>
                </div>

            	
            </div>
        </div>

    </div>
    </div>
    </div>



    </form>
    </div>
<!--/quick payments-->

 <!--logout thanks-->
    <div id="logoutThanks" class="modal hide fade" tabindex="-1" data-width="200">

    <div class="modal-body">
<h2>Thank you!</h2>
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


<!--history log start-->
<div id="HistoryLogFormModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close shouldClose" data-dismiss="modal" aria-hidden="true">×</button>
<h3 >History Log Viewer</h3>
</div>
<div class="modal-body">

    <form class="form-horizontal span6" id="freeSearch">
    <div class="control-group"><div class="controls">
    <div class="input-append">
    <input class="span2" name='search' type="text">
    <button class="btn" type="button" id="freeSearchButton">Search!</button>
    </div></div>
 </div>
    </form>
<hr>
   <form class="form-horizontal span6" id="HistoryLogForm">
    <fieldset> 
<center><h5>Or (  Use Bellow Parameters  )</h5></center>
<div class="control-group"><label class="control-label">Date</label>
<div class="controls"> <!--date--><div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2"  size="16" type="text" name="date" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div><!--/date--></div></div>

<div class="control-group"><label class="control-label">Operator</label>
<div class="controls"><select name="operator" id="operator">
 <option value="<?php echo $_SESSION['Sys_U_Name']; ?>"><?php echo $_SESSION['Sys_U_Name']; ?></option></select></div>
 </div>

<div class="control-group"><label class="control-label">Branch</label>
<div class="controls"><select name="branch" id="branch">
 <option value="<?php echo $_SESSION['branchCode']; ?>"><?php echo $_SESSION['branchCode']; ?></option></select></div></div>

<div class="control-group"><label class="control-label">Action</label>
<div class="controls">
 <select name="action" id="action">
<option value="Full info added">Full info added</option>
<option value="Full info Failed">Full info Failed</option>
<option value="Quick info added">Quick info added</option>
<option value="Quick info Failed">Quick info Failed</option>
<option value="New User Registration">New User Registration</option> 
<option value="Edit User Registration">Edit User Registration</option>
<option value="Cash Type Payment Added">Cash Type Payment Added</option>
<option value="Credit Card Type Payment Added">Credit Card Type Payment Added</option>
<option value="Cheque Type Payment Added">Cheque Type Payment Added</option>
<option value="Total Paid Update">Total Paid Update</option>
<option value="Payment delete on behalf of Total Paid Update">Payment delete on behalf of Total Paid Update</option>
<option value="Payment delete on behalf of Installment Update">Payment delete on behalf of Installment Update</option>
<option value="Payment delete">Payment delete</option>
<option value="Edit User Registration">Edit User Registration</option>
<option value="New Batch Creation">New Batch Creation</option>
<option value="Registration Comment Edit">Registration Comment Edit</option>
<option value="Delete Registration">Delete Registration</option>
<option value="User logged">User logged</option>
<option value="User logged out">User logged out</option>
</select>
</div>
</div>
<div class="modal-footer">
<p>
<div class="control-group"><div class="controls">
<button class="btn btn-small " id="historyView" type="button">View</button>
</div></div>
</p>

    </form>

</div> 

</div>
</div>


<!--registration card print-->

<div id="registrationCardView" class="modal hide fade  shouldClose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<button class="btn btn-small shouldClose" data-dismiss="modal" aria-hidden="true" type="button">Close</button>
<div class="modal-header">

<iframe id="modal-body-print-regCard" src="" style="border:0px #FFFFFF none;" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="400px" width="1000px"></iframe>
</div>
</div>

<!--/>



<!--history log end-->

<div id="HistoryLogViewModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<button class="btn btn-small" data-dismiss="modal" aria-hidden="true" type="button">Close</button>
<div class="modal-header">
</div></div>


<div id="updateingSystemFilesCheckModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<button class="close" data-dismiss="modal" aria-hidden="true" type="button">x</button>
<div class="modal-header">
<span id='updateingSystemFiles'><input type='button' id='updateingSystemFilesCheck' class='btn' value='Update' /></span>
</div></div>


<div id="synchronizeView" class="modal hide fade" tabindex="-1" role="dialog" data-width='150px' aria-labelledby="ModalLabel" aria-hidden="true">
<button class="btn btn-small shouldClose" data-dismiss="modal" aria-hidden="true" type="button">x</button>
<div class="modal-header syncResponse">
 <button type="button" class="btn btn-labeled btn-info" id="syncMenuClick">
                <span class="btn-label"><i class="glyphicon glyphicon-refresh"></i></span>synchronize</button>

</div></div>

<!--currency-->

<div id="currencyModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<button class="close" data-dismiss="modal" aria-hidden="true" type="button">x</button>
<div class="modal-header">
<form class="form-horizontal">

<div class="control-group">
<div class="controls">
<div class="input-prepend input-append">
    <span class="add-on accsepttingCurrency"></span>
    <input class="span2" id="AmountPaying" type="text" readyonly'>
    </div>
</div>
</div>

<div class="control-group">
<div class="controls">
<div class="input-prepend input-append">
    <span class="add-on payingCurrency"></span>
    <input class="span2" id="AmountAccspting" type="text" readonly>
    </div>
</div>
</div>

 <div class="control-group">
<div class="controls">
<div class="input-prepend input-append">
   <input class="span2" id="currencyJsonCallBack" value='1' type="text" >
    </div>
</div>
</div>
   <p>
<button class="btn btn-small btn-primary" id='currencyConvercationUpdate' type="button">Update</button>
<button class="btn btn-small" type="button" id='currencySee' >See Rates</button>
</p> 
</form>
</div>
</div>

<!--currency end-->

<div id="registrationStatusChange" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<button class="btn btn-small close shouldClose" data-dismiss="modal" aria-hidden="true" type="button">x</button>
<div class="modal-header">
<h3>Active/Inactive Registrations</h3><br><br>
<form id='regStatusChanged' class="form-horizontal span6" >
    <div class="control-group"><div class="controls">
    <div class="input-append">
<input type='text' value='COL/A-' name='regNo' id='regNoStatus'><span id='nowStatus'></span><br><br>
<select id='regStatus'>
<option value='Active'>Active</option><option value='Inactive'>Inactive</option>
</select><br><br>
<button class="btn" type="button" id="toInactiveActive">Update!</button><br><br>
   </div></div>
</form>

</div></div>

</body></html>
