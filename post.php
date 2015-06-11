<?php
#USE autoloder
function __autoload($classname)
{
    $filename = "class/" . $classname . ".php";
    include_once($filename);
}

#define varibles
$database = '';

include("Modal/dbLayer.php");

$esoftConfig = new PDO('mysql:host=127.0.0.1;port=3307;dbname='. substr(DATABASE, 0, 12),"esoftmetro", "esoftmetro2014", array(
    PDO::ATTR_PERSISTENT => true
));
   
$esoftConfig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$getQueryArray = $resultQuery[0];
$getQueryArray['database'] = DATABASE;

$helper = new getWrapper($esoftConfig);

$getReturnArray = $helper->MySqlWrapper($getQueryArray);

#Select sub branch data
$getReturnArray['sub_office_data'] = $helper->getSelected($getQueryArray['database']);

if (empty($_POST['returnSyncID'])) {
    $jsonResponse = new returnJson($getReturnArray);
    echo $jsonResponse->render();
} else {
    $jsonResponse2 = new returnJson($helper->getUpdated($getQueryArray['database'], $getQueryArray['returnSyncID']));
    echo $jsonResponse2->render();
}


?>
