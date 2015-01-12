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
	include('../../Modal/SysSettings.php');
	include('arrays.php');

function CleanQuery($queryfrom,$queryto){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$queryto);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $queryfrom);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	return $result=curl_exec ($ch);
	curl_close ($ch);
	
	}
	
function Sys_ChangesLog($connone,$Data)
{
	 $sql='INSERT INTO `sys_changes`(`Name`, `Type`, `File_Path`, `Change_Log`, `Version`) VALUES (?,?,?,?,?)';
	 $newquery_HO=$connone->prepare($sql);
	 $newquery_HO->execute($Data);


}
////////////////////////////////////////////////////////////////////////////
///////////////////////////Run All query using sync log
///////////////////////////////////////////////////////////////////////////
function RUN_Sync_Querys($connone) {
$inserttolocal='';
$Nodatafromlocal='';
$LocalupdatedtoDone='';
$Nodatafromlocal='';
$resultupdate='';
$inserttolocalDefault='';
$remotelogupdate='';
$remotelogupdateDefault='';
$rootPath=$_SERVER['DOCUMENT_ROOT'];
$D=explode('_',DATABASE);
$Bran=strtoupper(str_replace('-','/',$D[1]));

/////////////////////
     //$target_url = 'http://192.163.197.178/accept.php';
        //This needs to be the full path to the file you want to send.
        /* curl will accept an array here too.
         * Many examples I found showed a url-encoded string instead.
         * Take note that the 'key' in the array will be the key that shows up in the
         * $_FILES array of the accept script. and the at sign '@' is required before the
         * file name.
         */
      
	   
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//////Insert Data to Local Server From Remote Host Default Database
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//var_dump($result[2]);exit;
 //$target_url='http://127.0.0.1/a/a/administrator/modal/CheckUpdates.php';
 //$target_url='https://esoftcareers.com/ziu/CheckUpdates.php';
 $target_url='http://192.163.199.218/ziu/CheckUpdates.php';
	$post = array('extra_info' => '123456','BranchCode' => $Bran,'file_contents'=>'No');
	
	$result=CleanQuery($post,$target_url);
	$result=json_decode($result,true);
	
	   if(is_array($result[0])){
	   			
				foreach($result[0] as $key=>$value){
     $update=null;
	 $File_Path=trim($value['File_Path']);
	  if(substr($File_Path,0,1)=='/')
	  {
		$slash=null;  
	  }
	  else
	  {
		$slash='/';   
	  }
	  $File_Path=$slash.$File_Path;
	 $Data=array($value['Name'],$value['Type'],$File_Path,$value['Change_Log'],$value['Version']);
	

		      $filename=$rootPath.$File_Path;
		      $content=$value['Script'];
			  $Change_Log=$value['Change_Log'];
			  
			   if($value['Type']=='Folder')
			  {
               if (!file_exists($filename)) {
    if(mkdir($filename, 0777, true)){ 
	$update='ok';  
			$inserttolocal.='Software Update Done!<br />'.$Change_Log;
			Sys_ChangesLog($connone,$Data); 			
	
	}else{
	$update=$Bran.'-DiCF';
	}
}
else
{
	$update=$Bran.'-DiAE';
}
			  }elseif($value['Type']=='Delete'){
			   if (file_exists($filename)) {
			  if(unlink($filename)){
			  $update='ok'; 
			  }else
			  {
			  $update=$Bran.'-UtDe';
			  }
			  
			  }
			  
			  }
			  else
			  {
			  $fh = fopen($filename, 'w');
              if(fwrite($fh, $content))
			  {
			 $update='ok';
			$inserttolocal.='Software Update Done!<br />'.$Change_Log;
			Sys_ChangesLog($connone,$Data); 			
			  }else
			  {
	$update=$Bran.'-FiWF';
			  }
			  fclose($fh);
			  }
	$remotelogupdateDefault[$key]=$update;

}

	}
    else
	{
	$inserttolocal.='<h4>There is no any System updates.</h4>';
	}	

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//////Insert Data to Local Server From Remote Host Branch Database
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
	
	if(is_array($remotelogupdateDefault) ){
			$posttoupadateremote = array('extra_info' => 'UpdateRemoteSyncLog','BranchCode' => $Bran,'file_contents_default'=>json_encode($remotelogupdateDefault));
//var_dump($remotelogupdate);

	$resultupdate.=CleanQuery($posttoupadateremote,$target_url);



}

//////////////////////////////////////
$finalesult='<div class="controls text-center">
       <div class="container-fluid"><img src="library/img/Download.png" width="150" height="150" /></div>
   <div class="container-fluid">
   '.$inserttolocal.$resultupdate.'
   </div>

  
</div>';

echo $finalesult;
	exit;

}




if(!empty($_POST['UpdateNoW'])){
	include ("../../Modal/config.php");
	$esoftConfig=new PDO("mysql:host=localhost;dbname=".DATABASE,USERNAME,PASSWORD);
	//$conntwo = new PDO("mysql:host=192.163.197.178;dbname=esoftcar_matara",'esoftcar_col', 'R@S0w2!d(M*;');
	RUN_Sync_Querys($esoftConfig);
	
	exit;
}

?>
