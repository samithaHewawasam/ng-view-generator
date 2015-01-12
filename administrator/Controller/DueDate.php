<?php



include("../../Modal/dbLayer.php");

$sql="SELECT COUNT() FROM `registrations` WHERE `RG_Stu_ID` LIKE ?";
 $STH=$esoftConfig->prepare($sql);
 $STH->execute(array('%'.$SMID.'%'));
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);


var_dump($result);

?>
