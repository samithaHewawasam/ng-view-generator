<?php session_start();
include '../Modal/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Other Payments</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

	<!--link rel="stylesheet/less" href="Library/less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="Library/less/responsive.less" type="text/css" /-->
	<!--script src="Library/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
<link href="Library/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="Library/css/style.css" rel="stylesheet" type="text/css">
<link href="Library/css/datepicker.css" rel="stylesheet" type="text/css">
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="Library/js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->

<!-- <link rel="shortcut icon" href="Library/img/favicon.png">-->
<script type="text/javascript" src="Library/js/jquery.min.js"></script>
<script type="text/javascript" src="Library/js/bootstrap.min.js"></script>
<script type="text/javascript" src="Library/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="Library/js/scriptt.js"></script> <!-- Costermize scripts use for payment type & clear textboxes -->
<script type="text/javascript" src="cardcheck.js"></script>
     
     <script>
 $(document).ready(function () {
$('#t').click(function(event) {

 $('#bbb').html('<iframe src="printheadxy.php" width="500px" height="500px" scrolling="no" >'+
'</iframe>');  

});
});

</script>

</head>

<body>
   <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> 
<button class="btn btn-lg" id="t" >
  tttt
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" id="bbb">
      <iframe src="printheadxy.php" width="500px" height="500px" scrolling="no" ></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>


