 <?php
session_start();
  	$reg_n2='';
  	if (isset($_POST["reg_n"])){
	$reg_n2 = $_POST["reg_n"];
	}
   
  include("../Modal/config.php");

 $dbh=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD,array(
    PDO::ATTR_PERSISTENT => true));

     $stmt=$dbh->prepare("SELECT CONCAT(`SM_First_Name`,' ',`SM_Last_Name`) AS Name,`Default_Batch` AS Batch, `RG_Fee_Structure` AS FEE FROM `registrations` INNER JOIN `student_master` ON `student_master`.`SM_ID` = `registrations`.`RG_Stu_ID` WHERE `RG_Reg_NO` = ?");
     $stmt->execute(array($reg_n2));
       $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		echo json_encode($results[0]);
  
   ?>
