<?php session_start();
 include '../Modal/config.php';
 if (!strpos(DATABASE,'-')) {
$HostType='Online';

if($_SESSION["Access"]!='MIS'){
header('Location: ztemac.php');
exit;
} 

}else
{

$HostType='Local';
}

if(!isset($_SESSION['Sys_U_Branches'])){
$D=explode('_',DATABASE);
$Code=strtolower(str_replace('/','-',$D[1]));
$_SESSION['Sys_U_Branches']=$Code;
}
if(empty($_SESSION["Sys_U_Name"])){
header('Location: ztemac.php');
exit;
} 


foreach (glob("Controller/temp/*") as $file) {
/*** if file is 24 hours (86400 seconds) old then delete it ***/
if (filemtime($file) < time() - 86400) {
    unlink($file);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>MIS Reports</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"> 
<link href="Library/css/bootstrap.min.css" rel="stylesheet">
<link href="Library/css/style.css?Zzz" rel="stylesheet" />
<link href="Library/css/daterangepicker-bs3.css" rel="stylesheet" />
<link href="Library/css/bootstrap-editable.css" rel="stylesheet" />
<link href="Library/css/Mycss.css?Zzz" rel="stylesheet" />
	 <link href="Library/css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type=
  "text/css">
<style type='text/css'>
body {
   font-family: Ubuntu, sans-serif;
}

</style>
<script type="text/javascript" src="Library/js/jquery.min.js"></script>
<script type="text/javascript" src="Library/js/bootstrap.min.js"></script>
<script src="Library/js/moment.min.js"></script>
<script src="Library/js/sorttable.js"></script>
<script src="Library/js/daterangepicker.js"></script>

   <script src="Library/js/bootstrap-datetimepicker.min.js"></script>
<script src="Library/js/newmis.js?Zzz"></script>

    <?php  
  $connected = @fsockopen("www.google.com",80 ); //website and port
    if ($connected){
       echo '  <script type="text/javascript" src="https://www.google.com/jsapi"></script>';
        fclose($connected);
    }


if((!empty($_SESSION['Sys_U_Branches']) && $_SESSION['Sys_U_Branches']!='All' && count(explode(',',$_SESSION['Sys_U_Branches'])) == 1) || $HostType!='Online'){
$OneBranch='bset="1"';
$_SESSION['bset']=1;
}
else
{
$OneBranch='bset="0"';
$_SESSION['bset']=0;
}


  ?>

<script src="Library/js/GoogleChart.js"></script>
<script src="Library/js/jsfile.js?Zzz"></script>
<script src="Library/js/bootstrap-editable.min.js"></script>



</head>

<body>






<span id="left_arrow" class="glyphicon glyphicon-chevron-right"></span>


<span id="right_arrow" class="glyphicon glyphicon-chevron-left"></span>

<nav class="navbar navbar-default" role="navigation" id="navbar" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a  class="navbar-brand" href="./"><font size="5" class="hc"><b>ESOFT MIS :</b> <?php echo $_SESSION['branchCode'] ?></font></a> 
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
     <?php  if (!strpos(DATABASE,'-')) {
 ?>             

            <li><a   target="_blank" href="../Exam"><font class="hc" size="4">Exam System</font></a></li>
           
     <?php } ?>     
          </ul>
      <!--<ul class="nav navbar-nav">
       
       <li class="dropdown">
          <a href="#" class="dropdown-toggle " data-toggle="dropdown"><font size="4" class="hc">Reports<span class="caret"></span></font></a>
          <ul class="dropdown-menu">
                  <li>
    <a class="link" href="#RegistrationCount"  >Registration Report</a>
                  </li>
                  <li>
    <a class="link" href="#Income">Income Report</a>
                  </li>
                  <li>
    <a class="link" href="#TotalDues" >Total Dues Look up</a>
                  </li>
                  <li>
    <a class="link" href="#SubjectCount" >Subject wise student count</a>
                  </li>
                  <li>
    <a class="link" href="#BatchWise" >Batch Wise Student Details</a>
                  </li>
                  <li>
    <a class="link" href="#AttendanceSummery" >Attendance Sheet</a>
                  </li>
                  <li>
    <a class="link" href="#BatchList" >Batch List </a>
                  </li>
          </ul>
        </li>
       </ul>
       -->
     
      
      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" id="RegSearchForm" role="search">
            <div class="form-group">
              <input type="text" class="form-control " id="RegSearchInput" name="SearchInput"  placeholder="Reg. Look Up">
            </div>
           <div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Search <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a  class="RegLook" href="#" from="SM_Full_Name" >From Student Name</a></li>
    <li><a class="RegLook" href="#"  from="RegNo" >From Student Reg No</a></li>
    <li><a class="RegLook" href="#"  from="SM_ID" >From Student ID</a></li>
    <li><a id="PdfGen" href="#"  >Genarate Pdf</a></li>

  </ul>
</div>
      	</form>
      
        <li><a href="#"><span class="glyphicon glyphicon-user hc"></span></a></li>
		<li ><a href="#"><font size="4" class="hc"><?php echo $_SESSION['Sys_U_Name'] ?></font></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog hc"></span></a>
          <ul class="dropdown-menu">
            <li><a class="actions" name="EditAccount" href="#">Edit Account</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->  
  </div><!-- /.container-fluid -->
</nav>

<div  id="MainWrapper" class="container">
<div class="row">

 
<div class="panels fnts" id="side_panel">
<ul class="nav">
       
       <li class="dropdown">
          <a href="#" class="dropdown-toggle " data-toggle="dropdown"><font  size="4">Reports<span class="caret"></span></font></a>
          <ul class="dropdown-menu">
                  <li>
    <a class="link" href="#RegistrationCount">Registration Report</a>
                  </li>
                  <li>
    <a class="link" href="#Income">Income Report</a>
                  </li>
                  <li>
    <a class="link" href="#TotalDues">Total Dues Look up</a>
                  </li>
                  <li>
    <a class="link" href="#SubjectCount">Subject wise student count</a>
                  </li>
                  <li>
    <a class="link" href="#BatchWise">Batch Wise Student Details</a>
                  </li>
<!--                  <li>
    <a class="link" href="#BatchWiseFull">Batch Wise Student Full Details</a>
                  </li>
-->                  <li>
    <a class="link" href="#AttendanceSummery">Attendance Sheet</a>
                  </li>
     <?php  if (!strpos(DATABASE,'-')) {
 ?>             
                  <li>
    <a class="link" href="#StudentVerify" >Student Verification </a>
                  </li>
                  <li>
    <a class="link" href="#BatchList" >Batch Creation </a> </li>
    
    
    <li> <a class="link" href="#StudentCheckList" >Student Check List</a></li>
    <?php } ?>           
                  <li>
    <a class="link" href="#AgingReport">Total Due Aging</a>
                  </li>
                  <li>
    <a class="link" href="#AgingReportAttendance">Attendance Aging</a>
                  </li>
                  <li>
    <a class="link" href="#AgingReportPayment">Last Payment Aging</a>
                  </li>
                  <li>
    <a class="link" href="#InstallmentAging">Installment Analysis</a>
                  </li>
                  <?php  if(@$_SESSION["Sys_U_Username"]=='asitha'){echo '<li>
    <a target="_blank" href="../deposit">Deposits</a>
                  </li>';}
				  ?>

          </ul>
        </li>
       </ul>

        <form class=""  id="CountCommon_Form">

 <div class="col-xs-11">
<div id="heading">
<p align="center"><font size="4" color="#000000"  id="CommonFormTopic">Income Summery Form</font></p>
</div>
	
	<div class="controls" id="FirstDRDiv">
    
    	<label class="control-label"><b>First Date Range</b></label>
<div class="input-group" >    <input class="form-control " id="CC_Start_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="CC_Start_Date" value="<?php echo date('Y-m-01').' to '.date('Y-m-d') ?>"  >   <span class="input-group-btn">
        <button class="btn btn-default clear"  type="button">Clear</button>
      </span>
	</div></div><br>

	<div class="controls" id="SecondDRDiv">
	<label class="control-label"><b>Second Date Range</b></label>
<div class="input-group" >     <input class="form-control" id="CC_End_Date" size="16" type="text"   placeholder="yyyy-mm-dd" name="CC_End_Date" > <span class="input-group-btn">
        <button class="btn btn-default clear"  type="button">Clear</button>
      </span>
	</div>
	</div>
    <br>
   
    
	<?php  if(@$_SESSION['Courses']=='All' || $HostType!='Online'){ ?>
    <div class="form-group">
    <label><b>Division</b></label>
    <select class="form-control" id="DivisionSelect" name="D_Code" >
    <option>No Results!</option>
    </select>
 	 </div>
  <?php } ?>  
    
    <div class="form-group">
    <label><b>Course</b></label>
    <select class="form-control" id="CourseSelect" name="C_Code" >
    <option>No Results!</option>
    </select>
 	 </div>
    
    
    <div class="form-group" id="Batchdiv">
        <label><b>Batch</b></label>

    <select id="BM_Status">
    <option selected="selected" value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    <option value="Completed">Completed</option>
    </select>
    <select class="form-control" id="BatchSelect" name="BM_Batch_Code" >
    <option>No Results!</option>
    </select>
 	 </div>
     
    <div class="form-group" id="Intaketatus" >
    <label><b>Intake</b></label>
        <select id="I_Status">
    <option selected="selected" value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    </select>
    <select class="form-control" id="IntakeSelect" name="Intakes" >
    <option>No Results!</option>
    </select>
 	 </div>
    
    <div class="form-group" id="RgStatus" style="display: none;">
    <label><b>Reg. Status</b></label>
    <select class="form-control" name="RegStatus" id="RegStatus" >
    <option value="">All</option>
    <option selected value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    <option value="suspend">suspend</option>
    </select>
 	</div>
    
    <div class="form-group" id="VerStatusDiv" style="display: none;">( Only For Managers )
    <label><b>Student Verify Status</b></label>
    <select class="form-control" name="VerStatus" id="VerStatus" >
    <option value="All">All</option>
    <option value="Verified">Verified</option>
    </select>
 	</div>
  
    <div class="form-group">
    <button type="button" class="btn btn-success CountCommon_Save" rgst="0" date1="1" date2="1"report="IncomeSummery" <?php echo $OneBranch ?>>Income Summery Report</button>
   </button>
	</div>
</div>
</form>

<!-- Branch Panal-->

</div>
<div  id="side_branch"  class="panels" >
<div class="col-xs-11 fnts" id="side_branch_list">
</div>
</div>
<!--Main container-->
<div id="content" style="height:100%; min-height:600px;">
<div class="row">
<div class="alert alert-info" role="alert"><h3 align="center">This is Local MIS</h3></div>
<div class="col-xs-5" id="Rank">
</div>
<div class="col-xs-7" id="nextv">
<!--<h3>Next Version of MIS</h3>
<img class="col-xs-12" src="Library/img/nextVersion.png">

<div class="row"><h4>For the Comments please contact Samitha (077-3785291)</h4></div>-->
</div>
<!--<div class="panel panel-default">
  <div class="panel-heading">Updates..</div>
  <div class="panel-body">
<h4>Now you can create batches on MIS </h4> <img src="Library/img/Capture.PNG">  </div>
</div>-->
</div>
</div>






<div class="modal fade" id="CommonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:95%;" >
    <div class="modal-content"  >
   
      <div class="modal-body" id="CommonModalBody"  >
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="RegLook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:95%;" >
    <div class="modal-content"  >
   
      <div class="modal-body" id="RegLookBody"  >
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="GenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content"  >
   
      <div class="modal-body" id="GenModalBody"  >
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="modal fade" id="CommonModalLast" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"  >
   
      <div class="modal-body" id="CommonModalLastBody"  >
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" data-backdrop="static"  aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:30%;" >
   
      <div class="modal-body"   >
<div class="progress progress-striped active">
  <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
    <span class="sr-only">100% Complete</span>
  </div>
</div>      </div>

  </div>
</div>

</body>
</html>
