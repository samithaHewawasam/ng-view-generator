<?php session_start();



	/* * Copyright 2013 Esoft Computer System.
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
* http://www.apache.org/licenses/LICENSE-2.0
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
* Author: Esoft Computer System
* Email: info@esoft.lk
* Website: http://esoft.lk
* Date: 02/08/2013
* copyright Copyright (C) 2011 http://esoft.lk. All Rights Reserved.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
**/
////////////////////////////////////////////////////////////////////////////
///////////////////////////Create All query of rows which need to be sync using sync log
///////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
function Safe_Mode(){

}

////////////////////////////////////////////////////////////////////////////
if(!empty($_POST['extra_info'])){
include("../Modal/config.php");

$connone=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
/*define("DATABASE", "esoftcar_lakmal");
define("USERNAME", "esoftcar_samitha");
define("PASSWORD", "E[$5,,^GVZ+g");
*/
//$connone = new PDO("mysql:host=localhost;dbname=esoftcar_testing",'esoftcar_col', 'R@S0w2!d(M*;');
 



//$Sys_U_Branch=$_POST['Sys_U_Branch'];
//$sub_office=$_POST['sub_office'];
$BranchCode=$_POST['BranchCode'];
//$BranchCode=$Sys_U_Branch.'/'.$sub_office;
///get Local Update responce Start
if(($_POST['extra_info']=='UpdateRemoteSyncLog')){

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
////// Updates Remote Host Default Database Sync Log
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
$UpdateRemoteSyncLogDefault=json_decode($_POST['file_contents_default'], true);
if(is_array($UpdateRemoteSyncLogDefault)){
				foreach($UpdateRemoteSyncLogDefault as $key => $res){
if($res=='ok'){
$updatesync_HOD="UPDATE `sys_changes` SET Sync_To=CONCAT_WS(',',`Sync_To`,'".$BranchCode."'),Sync_BCount=(Sync_BCount+1) WHERE Sync_ID='".$key."' LIMIT 1";
}
else
{
$updatesync_HOD="UPDATE `sys_changes` SET `errors`=CONCAT_WS(',',`errors`,'".$res."') WHERE Sync_ID='".$key."' LIMIT 1";
}
 $newquery_HOD=$connone->prepare($updatesync_HOD);
		if($newquery_HOD->execute()){
	echo 'Remote Default Sync log Updatad Done</br>';
	}
}
}



///get Local Update responce End
exit;
}
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//////Get Updates From Remote Host Default Database
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
    $sql3="SELECT * FROM `sys_changes` WHERE `Status` = 'Active' AND  FIND_IN_SET('$BranchCode', `Sync_To`) = 0 AND (`Sync_For`='All' OR `Sync_For`='$BranchCode')";
	$SyncQuery_From_HODefault='';
     $STH=$connone->prepare($sql3);
     $STH->execute();
     $results = $STH->fetchAll(PDO::FETCH_ASSOC);
	 $count = $STH->rowCount();

	 if($count){
	foreach ($results as $row){
	
		
				$Sys_Updates_LIST[$row['Sync_ID']] = array('Date_Time'=>$row['Date_Time'],'Name'=>$row['Name'],'Type'=>$row['Type'],'File_Path'=>$row['File_Path'],'Script'=>$row['Script'],'Change_Log'=>$row['Change_Log'],'Version'=>$row['Version']);
}
}
else
{
		 $Sys_Updates_LIST='<h3>No data to Down Load From Head Office Default.</h3>';
}	

		echo json_encode(array($Sys_Updates_LIST));

}
else{

$to = "raasampath@gmail.com";
$subject = "Un Authorized Access to CheckUpdates.php";
$txt= "CheckUpdates.php is haveing a un Authorized Access From". "\r\n";
$txt.= 'REMOTE_ADDR = '.$_SERVER['REMOTE_ADDR']."\r\n";
//$txt.= 'HTTP_X_FORWARDED_FOR = '.$_SERVER['HTTP_X_FORWARDED_FOR']. "\r\n";
$headers = "From: webmaster@bluehost.com" . "\r\n" ;

mail($to,$subject,$txt,$headers);
}
/////////////////////////////////////////////////////////

?>