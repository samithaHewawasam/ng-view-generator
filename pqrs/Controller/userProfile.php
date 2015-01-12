<?php session_start();
 include("LogController.php");
 include '../../Modal/config.php';
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
 $msg=null;
 $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);
 ?>
 <script type="text/javascript">
 $(document).ready(function () {
$('#changepassword').click(function (e) {
$('#CommonModalBody').html(loderimg);

				 AjaxFun('Controller/userProfile.php',{changepassword:'changepasswordForm'} ).done(function (result) {
                    $('#CommonModalBody').html(result);$('#CommonModal').modal();
			 });	
			 
			  });
///////////////////////////////////////////			  
$('#ChangePasswordForm').submit(function (e) {
e.preventDefault();
var t=$(this);
if(t.myValidation()){
$('#CommonModalBody').html(loderimg);

var data_save = t.serializeArray();
data_save.push({name: "changepassword",value: 'changepasswordSave'});
				 AjaxFun('Controller/userProfile.php',data_save ).done(function (result) {
                    $('#CommonModalBody').html(result);$('#CommonModal').modal();
			 });	
}			 
			  });
///////////////////////////////////////////////////////
 $('.editu').editable({
           url: 'Controller/CommonUpdate.php',
           type: 'text',
           title: 'Enter Updates',
		   
    });
 });

 </script>
 
<?php
if(!empty($_POST['changepassword'])){
$changepassword=$_POST['changepassword'];
if($changepassword=='changepasswordForm'){
?>

<?php
}
else
{
$Oldpassword=$_POST['Oldpassword'];
$Oldpasswordmd5=md5($Oldpassword);
$Newpassword=$_POST['Newpassword'];
$ReNewpassword=$_POST['ReNewpassword'];
if($Newpassword!=$ReNewpassword){
$msg='<font  color="#FF0000"  >Your new password and re enterd new password dosen\'t match.</font>';
}
elseif($Oldpasswordmd5!=$_SESSION['PP'])
{
$msg= '<font color="#FF0000"  >Your old password is incorrect.</font>';
}
else
{
$sql = "UPDATE `system_users` SET `Sys_U_Password` =?  WHERE `Sys_U_Username` =? LIMIT 1";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array(md5($Newpassword),$_SESSION['Sys_U_Username']));
if($stmt->rowCount()){
$msg= '<font color="#00CC00"  >Your password successfully changed.</font>';
$_SESSION['PP']=md5($Newpassword);

}
else{
$msg= '<font color="#FF0000"  >Your password saving unsuccessfull! somthing worng.</font>';
}

}


}

?>
<div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Change Password</h3>
    </div><br /><p align="center"><?php echo $msg ?></p>
<form class="form-horizontal" id="ChangePasswordForm" role="form">
   <div class="form-group">
      <label f class="col-sm-2 control-label">Old Password</label>
      <div class="col-sm-3">
         <input type="password" class="form-control required" name="Oldpassword" autocomplete="off"  >
      </div>
   </div>
   <div class="form-group">
      <label  class="col-sm-2 control-label">New Password</label>
      <div class="col-sm-3">
         <input type="password" class="form-control required" name="Newpassword"  >
      </div>
   </div>
   <div class="form-group">
      <label   class="col-sm-2 control-label">Renew Password</label>
      <div class="col-sm-3">
         <input type="password" class="form-control required" name="ReNewpassword"  >
      </div>
   </div>
   <div class="form-group">
      <label for="Sys_U_mail" class="col-sm-2 control-label"></label>
      <div class="col-sm-3">
       <button class="btn btn-primary"  type="submit">Change Password</button>
      </div>
   </div>


</form>   

<?php
exit;
}
$sql = "SELECT * FROM `system_users` WHERE `Sys_U_Username` =? LIMIT 1";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($_SESSION['Sys_U_Username']));
$authentication  = $stmt->fetchALL(PDO::FETCH_ASSOC);

if($stmt->rowCount()){
$_SESSION['PP']=$authentication[0]["Sys_U_Password"];
?>  
  
<div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Profile Details</h3>
    </div><br />
<form class="form-horizontal" role="form">
   <div class="form-group">
      <label for="Sys_U_Branch" class="col-sm-2 control-label">Branch</label>
      <div class="col-sm-3">
         
             <a href="#" id="Sys_U_Branch" ><?php echo $authentication[0]["Sys_U_Branch"] ?></a>
      </div>
   </div>
   <div class="form-group">
      <label for="Sys_U_Name" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-3">
          <?php echo  '<a href="#" class="editu" id="Sys_U_Name"  data-name="text-t" data-pk="'.$randomString.base64_encode('system_users+++Sys_U_Name+++Sys_U_Username+++0').'" >'.$authentication[0]["Sys_U_Name"].'</a>'; ?>

      </div>
   </div>
   <div class="form-group">
      <label for="Sys_U_Designaion" class="col-sm-2 control-label">Designaion</label>
      <div class="col-sm-3">
                       <?php echo  '<a href="#" class="editu" id="Sys_U_Designaion"  data-name="text-t" data-pk="'.$randomString.base64_encode('system_users+++Sys_U_Designaion+++Sys_U_Username+++0').'" >'.$authentication[0]["Sys_U_Designaion"].'</a>'; ?>

      </div>
   </div>
   <div class="form-group">
      <label for="Sys_U_mail" class="col-sm-2 control-label">E-mail</label>
      <div class="col-sm-3">
                       <?php echo  '<a href="#" class="editu" id="Sys_U_mail"  data-name="text-t" data-pk="'.$randomString.base64_encode('system_users+++Sys_U_mail+++Sys_U_Username+++0').'" >'.$authentication[0]["Sys_U_mail"].'</a>'; ?>
      </div>
   </div>
   <div class="form-group">
      <label for="Sys_U_Username" class="col-sm-2 control-label">Username</label>
      <div class="col-sm-3">
             <a href="#" id="Sys_U_Username" ><?php echo $authentication[0]["Sys_U_Username"] ?></a>
      </div>
   </div>
   <div class="form-group">
      <label for="Sys_U_Password" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-3">
        <a href="#change" id="changepassword" name="changepassword" >Change Password</a>
      </div>
   </div>
</form>   
                    	
  <?php 
  }
  ?>                                  
                   
	
					
