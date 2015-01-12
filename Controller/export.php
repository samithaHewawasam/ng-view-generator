<?php
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-type: application/json");
header("Content-Disposition: attachment; filename=results.json");
include("../Modal/dbLayer.php"); // Holds all of our database connection information

$result = $helper->doManualSync(); 
$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($result, JSON_PRETTY_PRINT));
fclose($fp);

?>
