 <?php session_start();

if (empty($_POST['BatchAction'])) {
    exit;
}
$BM_Course_Code   = "";
$BM_Batch_Code    = "";
$BM_Commence_Date = "";
$BM_End_Date      = "";
$BM_Target_Exam   = "";
$BM_Status        = "";
$BM_Intake        = "";
$BM_Ins_Days      = "";
$BM_Batch_Count   = "";
$BM_Description   = "";
$BM_Published   = 0;


if (isset($_POST['BM_Course_Code'])) {
    $BM_Course_Code = $_POST['BM_Course_Code'];
}
if (isset($_POST['BM_Batch_Count'])) {
    $BM_Batch_Count = $_POST['BM_Batch_Count'];
}
if (isset($_POST['BM_Batch_Code'])) {
    $BM_Batch_Code = $_POST['BM_Batch_Code'] . $BM_Batch_Count;
}
if (isset($_POST['BM_Commence_Date'])) {
    $BM_Commence_Date = $_POST['BM_Commence_Date'];
}
if (isset($_POST['BM_End_Date'])) {
    $BM_End_Date = $_POST['BM_End_Date'];
}
if (isset($_POST['BM_Target_Exam'])) {
    $BM_Target_Exam = $_POST['BM_Target_Exam'];
}
if (isset($_POST['BM_Status'])) {
    $BM_Status = $_POST['BM_Status'];
}
if (isset($_POST['BM_Intake'])) {
    $BM_Intake = $_POST['BM_Intake'];
}
if (isset($_POST['BM_Ins_Days'])) {
    $BM_Ins_Days = filter_var($_POST['BM_Ins_Days'], FILTER_SANITIZE_NUMBER_INT);
}
if (isset($_POST['BM_Status'])) {
    $BM_Status = $_POST['BM_Status'];
}
if (isset($_POST['BM_Published'])) {
    $BM_Published = $_POST['BM_Published'];
}
if (isset($_POST['BM_Description'])) {
    $BM_Description = $_POST['BM_Description'];
}
 include("../../Modal/config.php");
$DBprefix='esoftcar_' ;//use back tic (`)
$DBsuffix='' ;
 if (!strpos(DATABASE,'-')) {
 $HostType='Online';
} 
else
{
$HostType='Local';
}

/////////
$bA=explode('---',$_POST['BranchCode']);
$DataBase=$DBprefix.strtolower($bA[1]).$DBsuffix;
$esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".$DataBase,USERNAME,PASSWORD);
$BM_Branch_Code = strtoupper(str_replace('-','/',$bA[1]));
$SM_Operator    = $_SESSION['Sys_U_Name'];


if($_POST['BatchAction']=='Edit'){
$Q="UPDATE `batch_master` SET `BM_Commence_Date`=?,`BM_End_Date`=?,`BM_Ins_Days`=?,`BM_Status`=?,`BM_Target_Exam`=?,`BM_Published`=?,`BM_Description`=? WHERE `BM_Batch_Code`=? ";
$B=array(

            $BM_Commence_Date,
            $BM_End_Date,
            $BM_Ins_Days,
            $BM_Status,
            $BM_Target_Exam,
			$BM_Published,
			$BM_Description,
			$BM_Batch_Code
        );
	$Msg= "$BM_Batch_Code new batch has been edited by the $SM_Operator in $BM_Branch_Code @ " .date('Y-m-d');
	$Act='Batch Edit';

}
else
{

$Q="INSERT  IGNORE INTO `batch_master` (BM_Branch_Code,BM_Course_Code,BM_Batch_Code,BM_Commence_Date,BM_End_Date,BM_Target_Exam,BM_Ins_Days,BM_Status,BM_Intake,BM_Published,BM_Description) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$B=array(
            $BM_Branch_Code,
            $BM_Course_Code,
            $BM_Batch_Code,
            $BM_Commence_Date,
            $BM_End_Date,
            $BM_Target_Exam,
            $BM_Ins_Days,
            $BM_Status,
            $BM_Intake,
			$BM_Published,
			$BM_Description
        );
	$Msg= "$BM_Batch_Code new batch has been added by the $SM_Operator in $BM_Branch_Code @ " .date('Y-m-d');
	$Act='New Batch Creation';
}

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
            $BM_Branch_Code,
            $Act
        )
        
    )
);

if($_POST['BatchAction']!='Edit'){
$IntakeBind=array($BM_Target_Exam,$BM_Course_Code,'Active');
$a=array('query' => 'INSERT IGNORE INTO `intakes` (`Intake`, `C_Code`, `I_Status`) VALUES ( ?, ?, ?)','bind' => $IntakeBind);
array_push($arguments,$a) ;
 $stmt=$esoftConfig->prepare("INSERT IGNORE INTO `esoftcar_centralserver`.`intakes` (`Intake`, `C_Code`, `I_Status`) VALUES ( ?, ?, ?)");
 $stmt->execute($IntakeBind);

}

$sqlQ="INSERT INTO `batch_schedule` (`batch`, `dayName`, `startTime`, `endTime`) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE `startTime`=?,`endTime`=?";
$sqlD="DELETE FROM `batch_schedule` WHERE  `batch`=? AND `dayName`=?";
  $weekdays=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
   foreach($weekdays as $val){ 
if(!empty($_POST['DayName'][$val])){
$StartTime=(empty($_POST['StartTime'][$val]) ? '00:00:00':date("H:i", strtotime($_POST['StartTime'][$val])));
$EndTime=(empty($_POST['EndTime'][$val]) ? '00:00:00':date("H:i", strtotime($_POST['EndTime'][$val])));
$dataArray=array($BM_Batch_Code,$val,$StartTime,$EndTime,$StartTime,$EndTime);
$a=array('query' => $sqlQ,'bind' => $dataArray);
array_push($arguments,$a) ;
}

if(empty($_POST['DayName'][$val])&& !empty($_POST['DayNameOld'][$val])){

$dataArray=array($BM_Batch_Code,$val);
$a=array('query' => $sqlD,'bind' => $dataArray);
array_push($arguments,$a) ;
}

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
		$response=array('status'=>$e->getMessage(),'ErrorCode'=>$e->getCode());
        $esoftConfig->rollback();
		break;
    }
//======for sync log  END======/


    } catch (PDOException $e) {
		$response=array('status'=>$e->getMessage(),'ErrorCode'=>$e->getCode());
        $esoftConfig->rollback();
		break;
    }
	
}	
}
if(!$response['ErrorCode']){
$esoftConfig->commit();	
}
echo json_encode($response);


//
//
//
//
//
//
//


/*error capturing

$errorCapture = array(
    array(
        'error' => "INSERT INTO `error_log`(`error`, `method`, `operator`, `branch`) VALUES (?,?,?,?)",
        'bind' => array(
            $response['errorInfo'],
            'Batchmaster',
            $SM_Operator,
            $SM_Branch_Code,
        )
    )
);


$helper->errorCapture($errorCapture);
*/

?> 
