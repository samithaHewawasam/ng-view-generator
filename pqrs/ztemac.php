<?php session_start();


if(!empty($_POST["user"]) and !empty($_POST["pass"])){
 include '../Modal/config.php';
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);

$user = $_POST["user"];
$pass = md5($_POST["pass"]);
$sql = "SELECT * FROM `esoftcar_centralserver`.`system_users` WHERE `Sys_U_Username` =? AND `Sys_U_Password` =?";
$stmt = $esoftConfig->prepare($sql);
$stmt->execute(array($user,$pass));
$authentication  = $stmt->fetchALL(PDO::FETCH_ASSOC);
if($authentication[0]["Sys_U_Username"] == $user && $authentication[0]["Sys_U_Password"] ==  $pass){
$_SESSION['branchCode'] = $authentication[0]["Sys_U_Branch"];
$_SESSION['Sys_U_Name'] = $authentication[0]["Sys_U_Name"];
$_SESSION['Sys_U_Username'] = $authentication[0]["Sys_U_Username"];
$_SESSION['Sys_U_Level'] = $authentication[0]["Sys_U_Level"];
$_SESSION['Divisions'] = $authentication[0]["Divisions"];
$_SESSION['Courses'] = $authentication[0]["Courses"];
$_SESSION['Access'] = $authentication[0]["Access"];
$_SESSION['AccessKey'] = 789;
$_SESSION['Sys_U_Branches']=null;

$sql="SELECT `esoftcar_centralserver`.`LoginDateTime`  FROM `login_tracker` WHERE `Username`=? ORDER BY 	`LT_ID` DESC LIMIT 1 ";
$sth = $esoftConfig->prepare($sql);
$sth->execute($_SESSION['Sys_U_Username']);
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['Sys_U_Last'] =$results[0]['LoginDateTime'] ;

 if (!strpos(DATABASE,'-')) {
if($authentication[0]["Sys_U_Branches"]=='All'){
$sql="SELECT GROUP_CONCAT( `B_CODE` ) AS `Branch` FROM `esoftcar_centralserver`.`branches` WHERE `System`='Active' ";
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['Sys_U_Branches'] =$results[0]['Branch'] ;
}
else
{
$_SESSION['Sys_U_Branches'] =$authentication[0]["Sys_U_Branches"] ;
}
if(($_SESSION['Sys_U_Branches']!='All' && count(explode(',',$_SESSION['Sys_U_Branches'])) == 1)){
$_SESSION['bset']=1;
}
else
{
$_SESSION['bset']=0;
}
} 
 $stmt=$esoftConfig->prepare("INSERT INTO `login_tracker` ( `Branch`, `Username`,`IP`, `LoginDateTime`) VALUES (?,?,?,?)");
 $stmt->execute(array($_SESSION['branchCode'],$_SESSION['Sys_U_Username'],$_SERVER['REMOTE_ADDR'],date('Y-m-d H:i:s')));
  $_SESSION['LoginId'] = $esoftConfig->lastInsertId();



}
}

if (empty($_SESSION["Sys_U_Name"])or $_SESSION["Access"]!='MIS'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="Library/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="Library/js/jquery.min.js"></script>
<script type="text/javascript" src="Library/js/bootstrap.min.js"></script>

  <style type="text/css">
body { 
  background: url(Library/img/bg1.png) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.navbar{background-color:#FFFFFF;}

footer.white {
    background: none repeat scroll 0 0 #FFFFFF;
    height: 50px;
    padding-top: 20px;
    text-align: center;
}
    </style>
	   <title>ESOFT Computer Studies (PVT) LTD</title>
</head>

  <body>
<div class="navbar navbar-fixed-top" style="box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.1) ">
      <div class="navbar-inner">
        <div class="container">
          <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a href="http://www.esoft.lk" class="brand"><img  src="Library/img/logo.png" alt="esoft metro campus" /></a>
        </div>
      </div>
    </div>
    <div class="container">    
        <div id="loginbox" style="margin-top:150px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" style="box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.4);border-radius: 15px;" >
                  

                    <div style="padding-top:30px" class="panel-body" >
<h3 align="center">ESOFT MIS</h3><hr/>
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                          <div class="col-sm-8 col-sm-offset-2" >  
                        <form id="loginform" class="form-horizontal" action="ztemac.php"  method="post"  role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="user" value="" placeholder="username or email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group" >
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="pass" placeholder="password">
                                    </div>
                                    

                            


                                <div  class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls" align="center">
                                     
            <input type="submit" value="Login" id="btn-login"   class="btn btn-success" >
                                    </div>
                                </div>


                                    
                            </form>     

                        </div>                     

                        </div>                     
                    </div>  
        </div>
         
    </div>
    <footer class="white navbar-fixed-bottom">
      Need a help? Call Us : 0773785291</a>
    </footer>
  </body>
</html>

<?php
}else{
header('Location:./');

}




?>


