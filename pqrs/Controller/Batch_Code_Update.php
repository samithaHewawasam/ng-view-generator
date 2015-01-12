<?php session_start();
if(!empty($_POST['value'])){
 include '../../Modal/config.php';
// $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
 if (!strpos(DATABASE,'-')) {
 $HostType='Online';
} 
else
{
$HostType='Local';
}
$pk=base64_decode(substr($_POST['pk'],30));
$value=trim($_POST['value']);
$Array=explode('+++',$pk);
$Table=$Array[0];
$TableCol=$Array[1];
$TablePKCol=$Array[2];
$TablePK=$Array[3];
$DBprefix='esoftcar_' ;//use back tic (`)
$DBsuffix='' ;
$DataBase=$DBprefix.strtolower($Array[4]).$DBsuffix;
$esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".$DataBase,USERNAME,PASSWORD);
 $SM_Branch_Code = strtoupper($Array[4]);
$SM_Operator    = $_SESSION['Sys_U_Name'];



if(!empty($_POST['lineId'])){
$TablePK=$_POST['lineId'];
}
$SM_Operator='';
$SM_Branch_Code='';

$Q = "UPDATE `$Table` SET `$TableCol` =?  WHERE `$TablePKCol` =? LIMIT 1";
$B=array($value,$TablePK);
	$Msg= "$TableCol column ($TablePK) has been updated as $value, by the $SM_Operator in $SM_Branch_Code @ " .date('Y-m-d');
	$Act='New Batch Creation';



$arguments = array(
    
    array(
        
        'query' => $Q,
        
        'bind' => $B
        
    ),
    array(
        'query' => "INSERT INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
        'bind' => array(
           $Msg,
           date('H:i:s'),
            $SM_Operator,
            $SM_Branch_Code,
            $Act
        )
        
    )
);

if($TableCol=='BM_Batch_Code'){
$S="UPDATE `registrations` SET `Default_Batch`=? WHERE `Default_Batch` LIKE ?";
$dataArray=array($value,$TablePK);
$a=array('query' => $S,'bind' => $dataArray);
array_push($arguments,$a) ;

$S="UPDATE `student_subjects` SET `SS_Batch_No` = ? WHERE `SS_Batch_No` LIKE ?";
$dataArray=array($value,$TablePK);
$a=array('query' => $S,'bind' => $dataArray);
array_push($arguments,$a) ;


}

$count=true;

  $esoftConfig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $esoftConfig->beginTransaction();


foreach($arguments as $property){
if($HostType=='Online'){
 $stmt=$esoftConfig->prepare("INSERT INTO `esoftcar_centralserver`.`get_sync` (`query`,`Data`) VALUES (?,?)");
 $stmt->execute(array($property['query'],serialize($property['bind'])));
 $count = $stmt->rowCount();
}

if($count){
  try {
//===================//
if($HostType=='Online'){
$id = $esoftConfig->lastInsertId();
 $sql="SELECT `Sync_ID` FROM `esoftcar_centralserver`.`get_sync` WHERE  `id`='$id'";
 $STH=$esoftConfig->prepare($sql);
 $STH->execute();
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
$Sync_ID=$result[0]['Sync_ID'];
}

//===================//
 $stmt=$esoftConfig->prepare($property['query']);
 $stmt->execute($property['bind']);
 $response=array('status'=>true,'ErrorCode'=>false);

//======for sync log ======/
  try {

if($HostType=='Online'){
$SyncQuery="INSERT INTO `get_sync` (`query`,`Data`,`Sync_ID`) VALUES (?,?,?)";
$syncArray=array($property['query'],serialize($property['bind']),$Sync_ID);
}
else
{
$SyncQuery='INSERT INTO `sync_log` (`query`,`data`) VALUES (?,?)';
$syncArray=array($property['query'],serialize($property['bind']));

}

 $stmt=$esoftConfig->prepare($SyncQuery);
 
 $stmt->execute($syncArray);
 $response=array('status'=>true,'ErrorCode'=>false);


    } catch (PDOException $e) {
		$response=array('status'=>false,'ErrorCode'=>$e->getCode(),'Msg'=>$e->getMessage());
        $esoftConfig->rollback();
		break;
    }
//======for sync log  END======/


    } catch (PDOException $e) {
		$response=array('status'=>false,'ErrorCode'=>$e->getCode(),'Msg'=>$e->getMessage());
        $esoftConfig->rollback();
		break;
    }
	
}	
}
if(!$response['ErrorCode']){
$esoftConfig->commit();	
}


echo json_encode($response);









/////////////////////////////////////////////////////////////////////
}
?>