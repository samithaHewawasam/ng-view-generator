<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" content="1024px, initial-scale=1.0" name="viewport">
  <link href="library/css/bootstrap.min.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/datepicker.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/style.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/animation.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/bootstrap-modal.css" rel="stylesheet">
  <link href="library/css/bootstrap-responsive.css" rel="stylesheet">

   <!--<script src=
  "http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
 <script src="library/js/jquery.js"></script>
  <script src="library/js/bootstrap.min.js"></script>
  <script src="library/js/bootstrap-datepicker.js"></script>
  <script src="library/js/bootstrap-modal.js"></script>
  <script src="library/js/bootstrap-modalmanager.js"></script>
  <script src="library/js/Attendance.js"></script>

  <title>ESoft Computer Studies</title>
  
  
</head>



<body>

<!--Nave Bar Start-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle=
        "collapse"><span class="icon-bar"></span> <span class=
        "icon-bar"></span> <span class="icon-bar"></span></a> <a class="brand"
        href="./">ESoft Attendance</a>


        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class="divider-vertical"></li>

            <li>
              <a href="Administrator"></a>
            </li>
          </ul>

          <div class="pull-right">
            <ul class="nav pull-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href=
                "#"><strong class="caret"></strong></a>

                <ul class="dropdown-menu">
                  <li>
                    <a id="FindReg"><em class="icon-cog"></em>
                    Find Registration</a>
                  </li>


                  <li class="divider"></li>

                  <li>
                    <a href="#" id="logout"><em class="icon-off"></em>
                    Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--Nave Bar End no errors-->

      <div class="container esoftWrap"><!--main wrap start--><br />

 <div id="searchNowForm">

   <div class="center text-center" >
        <form class="form-search" id="LookUpForm">
        <input id="RegID"  name="RegNo" placeholder="" type="text">
        <input type="submit" class="btn btn-medium btn-warning" id="LookUpFromSubmit"  value="Your Registration Number" />
    </form>
     </div>

 
       
    
  </div> 
  
  
  
  <div class="registrationData">

<hr>
           <div class="marquee">
		<p><a href="">You Are Welcome</a></p>
		<p><a href="">Esoft Computer Studies</a></p>
		<p><a href="">Test Play</a></p>
	</div>         
   <div class="container-fluid">
           <div class="row-fluid">
<div class="span4" align="center">
               
                                    
                                                    
        <img  id="ProfilePic" style="display:none" src="library/img/No_person.jpg"  width="200" />         
                 

                      
                  
</div>
<div class="span8" id="LookupResults">


</div>
</div>
                     
           <div class="row-fluid" id="OtherRegistrations">
           
           
          </div>               
          </div>               
</div> 
<hr>
<!--<audio preload="auto" id="player" controls="controls">  
   <source  src="library/SoundClips/alarm.ogg" />  
</audio> -->
 Press F2 to find registrations from student ID.

<hr>


<div id="FindRegFormDiv" class="modal hide fade" data-width="850">
 
     <div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Enter Student ID</h3>
    </div>
    <div class="modal-body" >
    <form method="post" class="form-inline" action="#dsd" id="CheckStudentForm">
     
   

<label for="" class="control-label">Student ID</label>

    <input class="span2"  name="StudentID" size="30" value="" type="text" >



<input type="submit" class="btn btn-medium btn-primary" value="Load Student Registrations" />

<button type="reset" class="btn btn-medium">Clear</button>
   
 
  

</form>
</div>
<div id="CheckStudentResDiv">

</div>


</div>


 
</div>


</div><!--main wrap end-->

</body>
</html>
