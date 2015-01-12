<?php
$a = session_id();
if(empty($a)) session_start();
$id = $_COOKIE["PHPSESSID"];
$operator = $_SESSION['Sys_U_Name'];
$getCentralQuery="";
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}


$randKeySet = "";
$randKeySet = random_string(100);

include("../Modal/dbLayer.php");
$syncData = ""; 

foreach($resultQuery as $value) {
  $syncData .= base64_decode($value['Sync_query']);
  $putStatus= $esoftConfig->prepare("UPDATE `sync_log` SET `randKey` = ? WHERE `Sync_ID`=?");
  $putStatus->execute(array($randKeySet,$value['Sync_ID']));    
 }

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://esoftcareers.com/ccc.php");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($ch, CURLOPT_POST, 1);
// in real life you should use something like:
curl_setopt($ch, CURLOPT_POSTFIELDS, 
http_build_query(array('PHPSESSID' => $id ,'query' => $syncData,'operator' => $operator,'randKey' => $randKeySet,'database' => DATABASE)));
// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
curl_close ($ch);

var_dump($server_output);

?>
