<?php
session_start();
if ($_SESSION['loggedIn'] != "true") {
	 header("Location: login.php");
}else{
include("view/checkUser.php");
}

?>


