<?php

$id="";

if(isset($_GET['id'])){$id = $_GET['id'];}

echo $id;

include("../Modal/dbLayer.php");

$helper->UpdateSeenHistoryLog($id);

?>
