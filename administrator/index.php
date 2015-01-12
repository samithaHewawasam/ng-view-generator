<?php session_start();
if(empty($_SESSION["Sys_U_Name"])){
header('Location: ../');
exit;
}
include('../Modal/SysSettings.php');
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

  <link href="../library/css/bootstrap-modal.css" rel="stylesheet">
  <link href="../library/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="library/css/bootstrap-editable.css" media="all" rel="stylesheet" type=
  "text/css">
    <link href="library/css/Mycss.css" media="all" rel="stylesheet" type=
  "text/css">
  <script src="../library/js/jquery.js"></script>
  <script src="../library/js/bootstrap.min.js"></script>
  <script src="../library/js/bootstrap-select.min.js"></script>
  <script src="../library/js/cardcheck.js" type="text/javascript"></script>
  <script src="../library/js/bootstrap-datepicker.js"></script>
  <script src="../library/js/bootstrap-modal.js"></script>
  <script src="../library/js/bootstrap-modalmanager.js"></script>
  <!-- <script src="library/js/jquery.jeditable.js"></script>-->
  <script src="library/js/admin.js"></script>
  <script src="library/js/bootstrap-editable.min.js"></script>

  <title>ESOFT Computer Studies PVT LTD</title>
</head>



<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle=
        "collapse"><span class="icon-bar"></span> <span class=
        "icon-bar"></span> <span class="icon-bar"></span></a> <a class="brand"
        href="./">ESOFT Administration</a>


        <div class="nav-collapse collapse">
          </ul>

          <div class="pull-right">
            <ul class="nav pull-right">
              <li class="dropdown">
                 <a class="dropdown-toggle" data-toggle="dropdown" href=
                "#">Hey <?php echo $_SESSION['Sys_U_Name']." "."@"." ".$_SESSION['branchCode'];?></a>

              </li>
               <li>
                    <a href="logout.php" id="logout"><em class="icon-off"></em>
                    Logout</a>
                  </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
 <div class="container">
      <div id="AdminMainMenu" class="navbar">
    
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="#">Dash Board</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Table Wizard <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                   <li class="dropdown-submenu">
                  <a href="#">Data Tables</a>
                  <ul class="dropdown-menu">
                          <li  class="nav-header" >List of Table</li>
                            <?php 
include('Modal/arrays.php');
$TableShow=array('batch_master','payments_master','other_payments','registrations','student_installments','student_master','student_subjects','system_users');
$TableShow=array_flip($TableShow);

				foreach($Table_List_Array as $key=> $Val)
{
if(array_key_exists($key,$TableShow)){
echo '<li><a class="tname" TableName="'.$key.'" href="#" >'.str_replace('_',' ',$key).'</a></li>';
}
}

				?>
       </ul>
                </li>          
   <li class="dropdown-submenu">
                  <a href="#">Default Tables</a>
                  <ul class="dropdown-menu">              
                
                <li  class="nav-header" >List of Table</li>
 <?php 
$TableShow=array('branches','course','course_type','discount_plan','discount_types','division','fee_installments','fee_structure','intakes','registration_type','subjects');
$TableShow=array_flip($TableShow);

				foreach($Table_List_Array as $key=> $Val)
{
if(array_key_exists($key,$TableShow)){
echo '<li><a class="tname" TableName="'.$key.'" href="#" >'.str_replace('_',' ',$key).'</a></li>';
}
}

 
 ?>  </ul>
                </li>
                        </ul>
                      </li>
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li  ><a href="../pqrs/">MIS Report</a></li>
                          <li ><a class="link" href="#RerintInvoice">Duplicate Invoice</a></li>
                          <li ><a class="link" href="#RerintRegCard">Duplicate Reg. Card</a></li>
                          <li id="IncomeReportSerchFormOpen" ><a href="#">Daily Income Report</a></li>
                         <li ><a class="link" href="#RegsearchForm">Registration Look Up</a></li>
                         <li ><a class="link" href="#RegCountBDwiseForm">Registration Count</a></li>
                         <li ><a class="link" href="#CollectionsSummaryForm">Collections Summary</a></li>
                        </ul>
                      </li>
                    </ul>
                   
                    <ul class="nav pull-right">
                       <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Edit Actions <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li ><a id="EditStudentLink" href="#">Edit Student Details</a></li>
                          
                        </ul>
                      </li>
                      <li class="divider-vertical"></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">New Actions <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li ><a id="NewSysUserLink" href="#">Create New System User</a></li>
                            <li ><a class="link" href="#SystemSettings">System Settings</a></li>
                            <li ><a class="link" href="#SystemUpdate">System Update</a></li>
                          
                        </ul>
                      </li>
					  <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Delete Actions <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li ><a id="DeleteRegistration" href="#">Delete Registration</a></li>
                          <li ><a id="DeletePayment" href="#">Delete Payment</a></li>
                          
                        </ul>
                      </li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            
    </div>
      </div>
    <div class="container-fluid">
       <div class="row-fluid">

    </div>  
    <div class="row-fluid">
               
                   
<div class="span12">
<div id="contenttwo">
<!--Reg Search  Modal on this  Start-->
<div id="RegSearchFormDiv" style="display:none" class="well" >
<form id="RegSearchForm">

<label class="control-label">Search Code</label>
<select name="SearchType" >
    <option value="SM_ID">Student ID</option>
    <option value="RegNo">Registration No</option>
    <option value="SM_Full_Name">Student Name</option>
    </select>
        <input class="span3"  name="SearchInput" value="" type="text"  />
<input type="button" id="RegSearchFormSubmit" class="btn btn-medium btn-primary" value="Search" />
<input type="reset" class="btn btn-medium" value="Clear" />

</form>
</div>
  <!--Reg Search  Modal on this  End-->


</div>
<div id="content">
<div align="center">
<iframe align="middle" width="70%" height="400px" src="https://www.esoftholdings.com/News/news.php" ></iframe>
</div>


</div>

    </div>
    </div></div>
</body></html>


<!--System Settings  Modal on this  Start-->
<div id="CommonModal" class="modal hide fade" >

</div>
  <!--System Settings  Modal on this  End-->



<!--System Settings  Modal on this  Start-->
<div id="ViewRegMainDiv" class="modal hide fade" data-width="1000">

                </div>
  <!--System Settings  Modal on this  End-->

 <!--Income Report Advance Search Modal on this  Start-->
<div id="IncomeReportSerchFormDiv" class="modal hide fade" data-width="600">
    <div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Income Report in a date range</h3>
    </div>
    <div class="modal-body" >
    <form method="post" action="#dsd" id="IncomeReportSerchForm">
    <input type="hidden"value="IncomeReportSerchForm" name="IncomeReportSerchForm"> 

    <div class="input-prepend"><h4></h4></div>
     
   


    <div class="control-group">
    <div class="controls form-inline">
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2  " id="Start_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="Start_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>

    </div>
          <label for="BM_Commence_Date" class="control-label">:Start Date</label>

    </div>
  </div>
  
      <div class="control-group">
      <div class="controls form-inline">
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2  " id="End_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="End_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
      <label for="BM_Commence_Date" class="control-label">:End Date</label>

    </div>
      </div>
     
  <div class="control-group">
    <div class="controls form-inline">
        <div >
<select name="ReportMode" >
    <option value="Course_Income">Course Income</option>
    <option value="Other_Income">Other Income</option>
    <option value="Both">Both</option>
    </select>
   

    </div>

    </div>
  </div>   
    <div >
<!-- Indicates a successful or positive action -->
<input type="button" id="IncomeReportSerchFormSave" class="btn btn-medium btn-primary" value="Generate Report" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
</div>
 
  

</form>
</div>
</div>
</div>
 <!--Income Report Advance Search Modal on this  End-->
 <!--New System User Form Modal on this  Start-->
<div id="NewSysUserFormDiv" class="modal hide fade" data-width="600">
    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>New System User</h3>
    </div>
<div id="NewSysUserResDiv" align="center" >
</div>
    <div class="modal-body" id="DeleteRegistrationResDiv" >
 <?php 
 if(in_array($_SESSION['Sys_U_AccessLevel'],array('Branch_Manager','Super_User'))){ 
 ?>   

    <form action="#" method="post" id="NewSysUserForm">
   <input type="hidden" name="NewSysUserCheck" value="NewSysUserCheck"  />
       <input  class="span3"  type="hidden" id="Sys_U_Branch" value="<?php echo @$_SESSION['branchCode'] ?>" name="Sys_U_Branch">

   <div class="control-group">
    <label for="Sys_U_Name" class="control-label">	
  Name:
    </label>
    <div class="controls">
    <input  class="span3"  type="text" id="Sys_U_Name" value="" name="Sys_U_Name">
    </div>
    </div>
		
 <div class="control-group">
    <label for="SubOfficCode" class="control-label">	
  User Designaion:
    </label>
    <div class="controls">
    <input  class="span3"  type="text" id="Sys_U_Designaion" value="" name="Sys_U_Designaion">
    </div>
    </div>
    
 <div class="control-group">
    <label for="OfficeAddress" class="control-label">	
   Email Address:
    </label>
    <div class="controls">
    <input  class="span3"  type="text" id="Sys_U_mail" value="" name="Sys_U_mail">
    </div>
    </div>
<div class="control-group">
    <label for="BranchCode" class="control-label">	
   Username:
    </label>
    <div class="controls">
    <input  class="span3"  type="text" id="Sys_U_Username" value="" name="Sys_U_Username">
    </div>
    </div>    

<div class="control-group">
    <label for="BranchCode" class="control-label">	
   Password:
    </label>
    <div class="controls">
    <input  class="span3"  type="password" id="Sys_U_Password" value="" name="Sys_U_Password">
    </div>
    </div>

<div class="control-group">
  <label class="checkbox">
<input type="radio" name="Sys_U_AccessLevel[]" value="Front_Office">
Front Office
</label>
  <label class="checkbox">
<input type="radio" name="Sys_U_AccessLevel[]" value="Front_Office_Supervisor">
Front Office Supervisor
</label>
  <label class="checkbox">
<input type="radio" name="Sys_U_AccessLevel[]" value="Coordinator">
Coordinator
</label>
  <label class="checkbox">
<input type="radio" name="Sys_U_AccessLevel[]" value="Division_Manager">
Divition Manager
</label>
  <label class="checkbox">
<input type="radio" name="Sys_U_AccessLevel[]" value="Branch_Manager">
Branch Manager
</label>
    </div>
  <div class="control-group">
  <label for="StartedDate" class="control-label">Joined Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2  " id="Sys_U_JoinedDate" size="16"  value="" type="text" placeholder="yyyy-mm-dd" name="Sys_U_JoinedDate" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>
     
     
     
    <div >
<!-- Indicates a successful or positive action -->
<input type="button" id="SysUserSave" class="btn btn-medium btn-primary" value="Save Settings" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
</div>
 
  

</form>

<?php 
}else
{
echo '<h4 align="center" >You don\'t have permission  to Creat new System User.</h4>';
}
?>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>
 <!--New System User Form Modal on this  End-->

 <!--Couurse Registration Delete Modal on this  Start-->
<div id="DeleteRegistrationDiv" class="modal hide fade" data-width="600">
    <div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">x</button>
    <h3>Delete Course Registration</h3>
    </div>
    <div class="modal-body" id="DeleteRegistrationResDiv" >
    <?php
 if(in_array($_SESSION['Sys_U_AccessLevel'],array('Branch_Manager','Super_User','Front_Office_Supervisor','Coordinator','Division_Manager'))){ 
	 ?>
    <form method="post" class="form-inline" action="#dsd" id="DeleteRegistrationForm">
     
   

<label for="BM_Commence_Date" class="control-label">Registration No</label>

    <input class="span2"  name="RegID"size="20" placeholder="COL/A-000179" type="text" >
    <input value="DeleteRegistrationCheck" name="DeleteRegistrationCheck" type="hidden" >



<input type="button" id="DeleteRegistrationCheck" class="btn btn-medium btn-primary" value="Check Registration" />

<button type="reset" class="btn btn-medium">Clear</button>
   
 
  

</form>
    <div id="DeleteRegistrationResponse" >
    </div>
<?php 
}else
{
echo '<h4 align="center" >You don\'t have permission  to Delete a Registration.</h4>';
}
?>
</div>
</div>
</div>
 <!---Couurse Registration Delete Modal on this  End-->
 
  <!--Payment Delete Modal on this  Start-->
<div id="DeletePaymentDiv" class="modal hide fade" data-width="600">
    <div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Delete Payment</h3>
    </div>
    <div class="modal-body" id="DeletePaymentResDiv" >
    <?php
 if(in_array($_SESSION['Sys_U_AccessLevel'],array('Branch_Manager','Super_User','Front_Office_Supervisor','Coordinator','Division_Manager'))){ 
	 ?>
    <form method="post" class="form-inline" action="#dsd" id="DeletePaymentForm">
     
   

<label for="BM_Commence_Date" class="control-label">Receipt No</label>

    <input class="span3"  name="PaymentID" size="15" placeholder="COL/B-0022/10/2013" type="text" >
    <input value="DeletePaymentCheck" name="DeletePaymentCheck" type="hidden" >



<input type="button" id="DeletePaymentCheck" class="btn btn-medium btn-primary" value="Check Payment" />

<button type="reset" class="btn btn-medium">Clear</button>
   
 
  

</form>
    <div id="DeletePaymentResponse" >
    </div>
<?php }else
{
echo '<h4 align="center" >You don\'t have permission  to Delete a Payment.</h4>';
}?>

</div>
</div>
</div>
 <!--Payment Delete Modal on this  End-->
 
 <!-- Batch Edit Form Modal on this  Start-->
 <div id="EditBatchFormDiv" class="modal hide fade" data-width="600">
 
     <div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Edit Created Batches</h3>
    </div>
    <div class="modal-body" >
    <form method="post" class="form-inline" action="#dsd" id="CheckBatchForm">
     
   

<label for="BM_Commence_Date" class="control-label">Batch Code</label>

    <input class="span2"  name="BatchCode"size="30" value="" type="text" >



<input type="submit" id="BatchCheck" class="btn btn-medium btn-primary" value="Load Batch" />

<button type="reset" class="btn btn-medium">Clear</button>
   
 
  

</form>
</div>
<div id="CheckBatchResDiv">

</div>


</div>


 
</div>
 <!--New Batch Edie Form Modal on this  End-->

 
  
<!--Edit Student Form Modal on this  Start-->
 <div id="EditStudentFormDiv" class="modal hide fade" data-width="850">
 
     <div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Edit Student Details</h3>
    </div>
    <div class="modal-body" >
    <form method="post" class="form-inline" action="#dsd" id="CheckStudentForm">
     
   

<label for="" class="control-label">Student ID</label>

    <input class="span2"  name="StudentCode"size="30" value="" type="text" >



<input type="button" id="StudentCheck" class="btn btn-medium btn-primary" value="Load Student Details" />

<button type="reset" class="btn btn-medium">Clear</button>
   
 
  

</form>
</div>
<div id="CheckStudentResDiv">

</div>


</div>


 
</div>
  <!--System Settings  Modal on this  End-->  <!--System Settings  Modal on this  Start-->
<div id="SystemSettingsFormDiv" class="modal hide fade" data-width="600">
</div>
  <!--System Settings  Modal on this  End-->