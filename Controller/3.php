<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
  <meta charset="utf-8" content="1024px, initial-scale=1.0" name="viewport">
  <link href="library/css/bootstrap.min.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/bootstrap-select.min.css" media="all" rel=
  "stylesheet" type="text/css">
  <link href="library/css/datepicker.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/style.css" media="all" rel="stylesheet" type=
  "text/css">
  <link href="library/css/bootstrap-modal.css" rel="stylesheet">

  <link href="library/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel=
  "stylesheet">

      <!--tree menu goes here -->
         <style>
    .menu {
    /* dropdown in accordion */ }
    .menu .accordion-heading {
    position: relative; }
    .menu .accordion-heading .edit {
    position: absolute;
    top: 8px;
    right: 30px; }
    .menu .area {
    border-left: 4px solid #f38787; }
    .menu .equipamento {
    border-left: 4px solid #65c465; }
    .menu .ponto {
    border-left: 4px solid #98b3fa; }
    .menu .collapse.in {
    overflow: visible; }
    </style>
  
 <script src="library/js/jquery.js"></script>  
 <script src="library/js/bootstrap.min.js"></script>
  <script src="library/js/bootstrap-select.min.js"></script>
  <script src="library/js/bootstrap-datepicker.js"></script>
  <script src="library/js/bootstrap-modal.js"></script>
  <script src="library/js/bootstrap-modalmanager.js"></script>
    <script src="library/js/jquery.bootstrap.wizard.js"></script>

<script type="text/javascript">
function ViewRegistrations(){
$('.View').click(function(){
var SMID=$(this).attr('data');
 $.ajax({
                    url: "Controller/RegSearch.php",
                    type: "POST",
                    data:{SMID:SMID,ViewDetais:"ViewDetais"},

                    success: function (response) {
					 $('#ViewRegMainDiv').html(response);
					$('#ViewRegMainDiv').modal();

                    }
       });
	   
});

}
$(document).ready(function () {

   $("body").on("click","#RegSearchFormSubmit", function(){
													  
			var RegSearchForm=$("#RegSearchForm").serializeArray();	
			
  $.ajax({
                    url: "Controller/RegSearch.php",
                    type: "POST",
                    data:RegSearchForm,

                    success: function (response) {
					 $('#content').html(response);
					ViewRegistrations();
                    }
       });
});										  
	


//document . ready
});
</script>
</head>

<body>

 <!--Reg Search  Modal on this  Start-->
<div id="RegSearchFormDiv" >
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
<div id="content">

</div>


<!--System Settings  Modal on this  Start-->
<div id="ViewRegMainDiv" class="modal hide fade" data-width="1000">

                </div>
  <!--System Settings  Modal on this  End-->
 
</body>
</html>
