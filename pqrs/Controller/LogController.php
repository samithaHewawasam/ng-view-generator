<?php 
if(empty($_SESSION['Sys_U_Name'])){

echo '<div class="alert alert-warning alert-dismissable">
  <strong>Warning!</strong> Please Login again!.
</div>';
exit;

}

?>