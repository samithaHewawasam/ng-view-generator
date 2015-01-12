<?php 

function Htype($Dbc){
 if (!strpos($Dbc,'-')) {
 $HostType='Online';
} 
else
{
$HostType='Local';
}
return $HostType;
}

?>