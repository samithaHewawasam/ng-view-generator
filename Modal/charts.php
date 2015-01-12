<?php
include("dbLayer.php");
$gender = array_count_values($totalCount);

$object = new StdClass;

$array = array($gender["Female"],$gender["Male"]);


$object = new StdClass;


$object->Cols = $array;
echo json_encode($object);

?>
 