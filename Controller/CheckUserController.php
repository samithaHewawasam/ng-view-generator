<?php
// begin the session
session_start();
header("Content-type: application/json");
$SM_Branch_Code   = $_SESSION['branchCode'];
$SM_Operator      = $_SESSION['Sys_U_Name'];
$SM_ID = "";
$gotUser = "";
$checkUser = "";

if(isset($_GET['SM_ID'])){$SM_ID  = $_GET['SM_ID'];} 

include("../Modal/dbLayer.php");

$gotUser = $helper->CheckStudentID("student_master", $SM_ID);

$checkUser = $helper->DbcheckUser("student_master", $SM_ID);




if($checkUser){

echo json_encode($gotUser[0]);

exit();

}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://192.163.199.218/checkUser.php");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($ch, CURLOPT_POST, 1);
// in real life you should use something like:
curl_setopt($ch, CURLOPT_POSTFIELDS, 
http_build_query(array('SM_ID' => $SM_ID)));
// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
curl_close ($ch);

//decode server data

$dataFromServer = json_decode($server_output, true);

if($dataFromServer['checkUserServer']){

echo json_encode($dataFromServer['gotUser'][0]);

$data = $dataFromServer['gotUser'][0];


$bind = array(
    $data['SM_ID'],
    $data['SM_ID_Type'],
    $SM_Branch_Code,
    (empty($data['SM_Title'])) ? '' : $data['SM_Title'],
    (empty($data['SM_Initials'])) ? '' : $data['SM_Initials'],
    (empty($data['SM_First_Name'])) ? '' : $data['SM_First_Name'],
    (empty($data['SM_Last_Name'])) ? '' : $data['SM_Last_Name'],
    (empty($data['SM_Full_Name'])) ? '' : $data['SM_Full_Name'],
    (empty($data['SM_Gender'])) ? '' : $data['SM_Gender'],
    (empty($data['SM_Date_of_Birth'])) ? '' : $data['SM_Date_of_Birth'],
    (empty($data['SM_House_NO'])) ? '' : $data['SM_House_NO'],
    (empty($data['SM_Lane'])) ? '' : $data['SM_Lane'],
    (empty($data['SM_Town'])) ? '' : $data['SM_Town'],
    (empty($data['SM_City'])) ? '' : $data['SM_City'],
    (empty($data['SM_Country'])) ? '' : $data['SM_Country'],
    (empty($data['SM_Postal_Code'])) ? '' : $data['SM_Postal_Code'],
    (empty($data['SM_Tel_Residance'])) ? '' : $data['SM_Tel_Residance'],
    (empty($data['SM_Tell_Work'])) ? '' : $data['SM_Tell_Work'],
    (empty($data['$SM_Tell_Mobile'])) ? '' : $data['$SM_Tell_Mobile'] ,
    (empty($data['SM_Mail_Personal'])) ? '' : $data['SM_Mail_Personal'],
    (empty($data['SM_Mail_Work'])) ? '' : $data['SM_Mail_Work'],
    (empty($data['SM_Use_Parent_ID'])) ? '' : $data['SM_Use_Parent_ID'],
    (empty($data['SM_Parent_Name'])) ? '' : $data['SM_Parent_Name'],
    (empty($data['$SM_Parent_Phone'])) ? '' : $data['SM_Parent_Phone'],
    "Active",
    $SM_Operator,
    (empty($data['SM_Reg_Date'])) ? '' : $data['SM_Reg_Date']
);


$arguments = array(
    array(
        'query' => "INSERT INTO student_master (SM_ID,SM_ID_Type,SM_Branch_Code,SM_Title,SM_Initials,SM_First_Name,SM_Last_Name,SM_Full_Name,SM_Gender,SM_Date_of_Birth,SM_House_NO,SM_Lane,SM_Town,SM_City,SM_Country,SM_Postal_Code,SM_Tel_Residance,SM_Tell_Work,SM_Tell_Mobile,SM_Mail_Personal,SM_Mail_Work,SM_Use_Parent_ID,SM_Parent_Name,SM_Parent_Phone,SM_Status,SM_Operator,SM_Reg_Date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        'bind' => $bind
    ),
    array(
       'query' => "INSERT INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`) VALUES (?,?,?,?,?)",
       'bind'  => array("$SM_ID new user full info has been added by the $SM_Operator in $SM_Branch_Code @ ".getDateNow(), getDateOnly(), $SM_Operator, $SM_Branch_Code, 'Full info added')

    )
);

$response = $helper->MySqlWrapper($arguments);

exit();

}

if(!$checkUser && !$dataFromServer->checkUserServer){

$arraySET = array("Id" => $SM_ID);
echo json_encode($arraySET);

}



?>


             
  
  
      
