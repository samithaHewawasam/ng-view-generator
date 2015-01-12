<?php
error_reporting(0);
$esoftConfig = "";

include_once dirname(__FILE__) . '/config.php';

function getDateNow(){

return date("l jS \of F Y h:i:s A");

}

function getDateOnly(){

return date("Y-m-d");

}



class dbLayer
{

//connection from here 
    private $done;
    public $error = array();
    public $errorInfo; 
    public $commitCode;
    public $roalBackCode;
    public $result; 

    function __construct(PDO $connection)
    {
        $this->done = $connection;
    }



//Checking User from here 
 public function DbcheckUser($table, $SM_ID)
{
$sql = $this->done->prepare("SELECT * FROM " . $table . " WHERE SM_ID=?");
$sql->execute(array($SM_ID));
return $sql->rowCount();
}


//CheckStudentID User from here 
     public function CheckStudentID($table, $SM_ID)
{
$sql = $this->done->prepare("SELECT * FROM " . $table . " WHERE SM_ID=?");
$sql->execute(array($SM_ID));
return $sql->fetchALL(PDO::FETCH_OBJ);
}

 public function getAIFromStudentMaster()
{
$sql = $this->done->prepare("SELECT `SM_NO` FROM `student_master` ORDER BY SM_NO DESC LIMIT 1");
$sql->execute();
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);

}

 public function insertServerUser($sql)
{
$this->done->exec($sql);

}




//Checking User from here 
 public function DbcheckUserReg($RG_Reg_NO)
{
$sql = $this->done->prepare("SELECT * FROM `registrations` WHERE RG_Reg_NO=?");
$sql->execute(array($RG_Reg_NO));
return $sql->rowCount();
}


// history log from here 
public function putHistoryLog($log, $date, $operator, $branch, $action, $comment)
{
$sql = $this->done->prepare("INSERT INTO `history_log` (`log`, `date`, `operator`, `branch`, `action`, `comment`) VALUES (?,?,?,?,?,?)");
$sql->execute(array($log, $date, $operator, $branch, $action, $comment));
}

//genderCount User from here 
     public function genderCount($table)
{
$sql = $this->done->prepare("SELECT SM_Gender FROM " . $table);
$sql->execute();
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}

//regType  from here 
  public function regType()
{
$sql = $this->done->prepare("SELECT `RT_Code`,`D_Code` FROM `registration_type` WHERE RT_Status=?  ORDER BY `RT_Code` ASC");
$sql->execute(array("Active"));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}

//"SELECT `C_Code` from `course` WHERE C_Status = ? and FIND_IN_SET(?, Branch) ORDER BY `C_Code` ASC"
//CourseTypeList  from here 
  public function CourseTypeList($branch)
{
$sql = $this->done->prepare("SELECT `C_Code`,`C_Ins_Method` from `course` WHERE (Branch = FIND_IN_SET('COL/A', Branch) OR Branch = FIND_IN_SET('COL/A', Branch)) AND C_Status = 'Active' ORDER BY `C_Code` ASC");
$sql->execute(array($branch,"ALL","Active"));
return $sql->fetchALL(PDO::FETCH_OBJ);
}

//CourseTypeList  from here 
  public function RegTypeSort($CT_Course_Code)
{
$sql = $this->done->prepare("SELECT `CT_Type_Code` FROM `course_type` WHERE CT_Course_Code=?");
$sql->execute(array($CT_Course_Code));
return $sql->fetchALL(PDO::FETCH_OBJ);
}



//CourseType from here 
  public function courseType($CT_Type_Code)
{
$sql = $this->done->prepare("SELECT `CT_Course_Code` FROM `course_type` WHERE CT_Type_Code=?");
$sql->execute(array($CT_Type_Code));
return $sql->fetchALL(PDO::FETCH_OBJ);
}

//CT_No_Of_Subjects from here 
  public function CTNoOfSubjects($CT_Type_Code,$BM_Course_Code)
{
$sql = $this->done->prepare("SELECT `CT_No_Of_Subjects` FROM `course_type` WHERE CT_Type_Code=? AND CT_Course_Code=?");
$sql->execute(array($CT_Type_Code,$BM_Course_Code));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}

//SubjectsSet from here 
  public function subjectsSet($C_Code)
{
$sql = $this->done->prepare("SELECT `S_Code`,`S_Name`,`C_Code`,`S_Status` FROM `subjects` WHERE C_Code=?");
$sql->execute(array($C_Code));
return $sql->fetchALL(PDO::FETCH_ASSOC);
}

//batchMasterSet from here 
  public function batchMasterSet($BM_Course_Code)
{
$sql = $this->done->prepare("SELECT `Bm_Batch_Code`,`BM_Commence_Date`,`BM_End_Date`,`BM_Ins_Days` FROM `batch_master` WHERE BM_Course_Code=? AND BM_Status=?");
$sql->execute(array($BM_Course_Code,"Active"));
return $sql->fetchALL(PDO::FETCH_OBJ);
}


//feeStructure from here 
 public function feeStructure($FS_Reg_Type)
{
$sql = $this->done->prepare("SELECT `FS_Code`,`FS_No_of_Installments` FROM `fee_structure` WHERE FS_Reg_Type=? AND FS_Status=?");
$sql->execute(array($FS_Reg_Type,"Active"));
return $sql->fetchALL(PDO::FETCH_ASSOC);
}

//registrationfee from here 
 public function registrationfee($FS_Code)
{
$sql = $this->done->prepare("SELECT `FS_Registration_Fee` FROM `fee_structure` WHERE FS_Code=?");
$sql->execute(array($FS_Code));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}
//installment from here 
 public function installment($FS_Stru_Code)
{
$sql = $this->done->prepare("SELECT * FROM `fee_installments`  WHERE FI_Stru_Code=? ORDER BY FI_Ins_NO ASC");
$sql->execute(array($FS_Stru_Code));
return $sql->fetchALL(PDO::FETCH_ASSOC);
}

//grossFee from here 
 public function grossFee($FS_Code)
{
$sql = $this->done->prepare("SELECT `FS_Price` FROM `fee_structure` WHERE FS_Code=?");
$sql->execute(array($FS_Code));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}
// discountPlan from here 
 public function discountPlan($DT_Reg_Type)
{
$sql = $this->done->prepare("SELECT `DT_Dis_Plan` FROM `discount_types` WHERE DT_Reg_Types=? AND DT_Status=?");
$sql->execute(array($DT_Reg_Type,"Active"));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}


// discount from here 
 public function discount($DP_Code)
{
$sql = $this->done->prepare("SELECT `DP_Rate`,`DP_Type` FROM `discount_plan` WHERE DP_Code=? AND DP_Status=?");
$sql->execute(array($DP_Code,"Active"));
return $sql->fetchALL(PDO::FETCH_ASSOC);
}

//getLastRegId from here 
 public function getLastRegId($branch)
{
$sql = $this->done->prepare("SELECT `RG_Reg_NO` FROM `registrations` WHERE RG_Branch_Code=? AND `RG_Reg_NO` LIKE ? ORDER BY `RG_Reg_NO` DESC LIMIT 1");
$sql->execute(array($branch,'%'.$branch.'%'));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}

//getLastTotalPaid from here 
 public function getLastTotalPaid($RG_Reg_NO)
{
$sql = $this->done->prepare("SELECT `RG_Total_Paid` FROM `registrations` WHERE RG_Reg_NO=?");
$sql->execute(array($RG_Reg_NO));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}


//Total Paid Update from here 
 public function updateLastTotalPaid($nextTotalPaidUpdate, $RG_Reg_NO)
{
$sql = $this->done->prepare("UPDATE `registrations` SET `RG_Total_Paid`=? WHERE `RG_Reg_NO`=?");
$sql->execute(array($nextTotalPaidUpdate, $RG_Reg_NO));
}

//getLastTotalPaidInstallment from here 
 public function getLastInstallmentPaidAmount($RG_Reg_NO)
{
$sql = $this->done->prepare("SELECT `SI_Ins_NO`,`SI_Ins_Amount`,`SI_Paid_Amount` FROM `student_installments` WHERE SI_Reg_No=? ORDER BY `SI_Ins_NO` ASC");
$sql->execute(array($RG_Reg_NO));
return $sql->fetchALL(PDO::FETCH_OBJ);
}


//updateInstallmentPaidAmount  from here 
 public function updateInstallmentPaidAmount($amount, $RG_Reg_N0, $insNO)
{
$sql = $this->done->prepare("UPDATE `student_installments` SET `SI_Paid_Amount`=? WHERE `SI_Reg_No`=? AND SI_Ins_NO=?");
$sql->execute(array($amount, $RG_Reg_N0, $insNO));
}

/*wrapper for mysql*/

 public function MySqlWrapper(array $arguments)
{

           try {
            
            $this->done->beginTransaction();
            foreach($arguments as $key => $val){
            $sql = $this->done->prepare($val['query']);

            $sqlSync = $this->done->prepare("INSERT INTO `sync_log`( `query`, `data`) VALUES (?,?)");
            $sqlSync->execute(array($val['query'],serialize($val['bind'])));
                
            foreach ($val['bind'] as $key => &$val) {
            $sql->bindValue($key + 1, $val);
            };
            $result[] = $sql->execute();
            }

            $commitCode = $this->done->commit();
            
        }
        catch (PDOException $ex) {
           $errorInfo = "Ooops: ".$ex->getMessage();

           $roalBackCode = $this->done->rollBack();
          
        }

return array('result' => $result, 'errorInfo' => $errorInfo, 'commitCode' => $commitCode, 'roalBackCode' => $roalBackCode); 

}

/*wrapper for mysql*/

 public function MySqlWrapperForSync(array $arguments)
{

           try {
            
            $this->done->beginTransaction();
            foreach($arguments as $key => $val){
            $sql = $this->done->prepare($val['query']);
            
            foreach ($val['bind'] as $key => &$val) {
            $sql->bindValue($key + 1, $val);
            };
            $result[] = $sql->execute();
            }

            $commitCode = $this->done->commit();
            
        }
        catch (PDOException $ex) {
           $errorInfo = "Ooops: ".$ex->getMessage();

           $roalBackCode = $this->done->rollBack();
          
        }

return array('result' => $result, 'errorInfo' => $errorInfo, 'commitCode' => $commitCode, 'roalBackCode' => $roalBackCode); 

}

public function UpdateWrapperForSync(array $array)
{

           try {
            
            $this->done->beginTransaction();
  
            $sql = $this->done->prepare("UPDATE `sync_log` SET `Sync_Status`=? WHERE `Sync_ID`=?");
 
            $result[] = $sql->execute($array);
       
            $commitCode = $this->done->commit();
            
        }
        catch (PDOException $ex) {
           $errorInfo = "Ooops: ".$ex->getMessage();

           $roalBackCode = $this->done->rollBack();
          
        }

return array('result' => $result, 'errorInfo' => $errorInfo, 'commitCode' => $commitCode, 'roalBackCode' => $roalBackCode); 

}


/*error capture*/

 public function errorCapture(array $errorCapture)
{
       try {
 
            foreach($errorCapture as $key => $val){
            $sql = $this->done->prepare($val['error']);
            $sql->execute($val['bind']);
            }

        }
        catch (PDOException $ex) {
           "Ooops: ".$ex->getMessage();
          
        }
 
}




//update Reg_NO from here 
 public function updateRegNo($RG_Reg_NO_Full,$RG_ID)
{
$sql = $this->done->prepare("UPDATE `registrations` SET `RG_Reg_NO`=? WHERE `RG_ID`=?");
$sql->execute(array($RG_Reg_NO_Full,$RG_ID));
}

// afterPayments from here 
 public function getDataForAfterPayments($RG_Reg_NO)
{
$sql = $this->done->prepare("SELECT * FROM `registrations` WHERE RG_Reg_NO=?");
$sql->execute(array($RG_Reg_NO));
return $sql->fetchALL(PDO::FETCH_OBJ);
}

// afterPaymentsUserDetails from here 
 public function afterPaymentsUserDetails($SM_ID)
{
$sql = $this->done->prepare("SELECT * FROM `student_master` WHERE SM_ID=?");
$sql->execute(array($SM_ID));
return $sql->fetchALL(PDO::FETCH_OBJ);
}

// afterPaymentsStudentSubjects from here 
 public function afterPaymentsStudentSubjects($SS_REG_NO)
{
$sql = $this->done->prepare("SELECT * FROM `student_subjects` WHERE SS_REG_NO=? ORDER BY `SS_Batch_No` DESC LIMIT 1");
$sql->execute(array($SS_REG_NO));
return $sql->fetchALL(PDO::FETCH_OBJ);
}

// afterPaymentsInstallment from here 
 public function afterPaymentsInstallment($SI_Reg_No)
{
$sql = $this->done->prepare("SELECT * FROM `student_installments` WHERE SI_Reg_No=? ORDER BY `SI_Ins_No` ASC");
$sql->execute(array($SI_Reg_No));
return $sql->fetchALL(PDO::FETCH_ASSOC);
}

//getLastInvoiceNumber from here 
 public function getLastInvoiceNumber($branch)
{
$sql = $this->done->prepare("SELECT `PM_Receipt_No` FROM `payments_master` WHERE  PM_Receipt_No LIKE ? AND
  MONTH(PM_Date) = MONTH(CURDATE())
  AND YEAR(PM_Date) = YEAR(CURDATE())
ORDER BY `PM_Receipt_No` DESC LIMIT 1");
$sql->execute(array('%'.$branch.'%'));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}

    //sync log generatting from here 
    public function getLog($table, $Sync_query)
    {
        
        try {
            
            // First of all, let's begin a transaction
            $this->done->beginTransaction();
            $sql = $this->done->prepare("INSERT INTO " . $table . "(Sync_query,Sync_Time) VALUES (?,NOW())");
            $sql->execute(array(
                $Sync_query
            ));
            // i.e. no query has failed, and we can commit the transaction
            $this->done->commit();
            return $sql->rowCount();
            
        }
        catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            $this->done->rollback();
              
        }
        
    }


//updateInstallmentPaidAmount  from here 
 public function updateRegEditComment($regEditComment,$RG_Status,$RG_Reg_NO)
{
$sql = $this->done->prepare("UPDATE `registrations` SET `RG_Special_Note` = ? ,`RG_Status` = ? WHERE `RG_Reg_NO` =?");

$sql->execute(array($regEditComment,$RG_Status,$RG_Reg_NO));
return $sql->rowCount();
}

// studentInstallments from delete 
 public function studentInstallmentsDelete($RG_Reg_NO)
{

$sql = $this->done->prepare("DELETE FROM `student_installments` WHERE `SI_Reg_No` = ?");
$sql->execute(array($RG_Reg_NO));
return $sql->rowCount();

}

//sync log query generatting from here 
 public function getLogQuery()
{
$sql = $this->done->prepare("SELECT * FROM `sync_log` WHERE Sync_Status IS NULL ORDER BY `Sync_Time` ASC LIMIT 1");
$sql->execute();
return $sql->fetchALL(PDO::FETCH_ASSOC);

}

//sync log query generatting from here 
 public function getSubBranch()
{
$sql = $this->done->prepare("SELECT * FROM `sync_db`");
$sql->execute();
return $sql->fetchALL(PDO::FETCH_OBJ);

}

/*wrapper for mysql*/
 
 public function MySqlWrapperForSyncUnserialize(array $arguments)
{
 
           try {
            
            $this->done->beginTransaction();
            foreach($arguments as $val){
            $sql = $this->done->prepare($val['query']);
 
            $result[] = $sql->execute($val['Data']);
            }
 
            $commitCode = $this->done->commit();
            
        }
        catch (PDOException $ex) {
           $errorInfo = "Ooops: ".$ex->getMessage();
 
           $roalBackCode = $this->done->rollBack();
          
        }
 
return array('result' => $result, 'errorInfo' => $errorInfo, 'commitCode' => $commitCode, 'roalBackCode' => $roalBackCode); 
 
}

 public function MySqlWrapperForSubOffice(array $arguments)
{

           try {
            
            $this->done->beginTransaction();

            $sql = $this->done->prepare($arguments['query']);
            $sql->execute(unserialize($arguments['Data']));
           $commitCode = $this->done->commit();
            
        }
        catch (PDOException $ex) {
           $errorInfo = "Ooops: ".$ex->getMessage();

           $roalBackCode = $this->done->rollBack();
          
        }

return array('returnSyncID' => $arguments['Sync_ID'], 'errorInfo' => $errorInfo, 'commitCode' => $commitCode, 'roalBackCode' => $roalBackCode); 

}

//update success sync db from here 
 public function updatedbStatus($status,$LocalDbName)
{
$sql = $this->done->prepare("UPDATE `sync_db` SET `status`=? WHERE `db`=?");
$sql->execute(array($status,$LocalDbName));
}

 public function getUserRegistration($RG_Reg_NO,$RG_Stu_ID)
{
$sql = $this->done->prepare("SELECT * FROM `registrations` WHERE RG_Reg_NO=? OR RG_Stu_ID=?");
$sql->execute(array($RG_Reg_NO,$RG_Stu_ID));
return $sql->fetchALL(PDO::FETCH_ASSOC);

}


//find the data accoding to the registration number 
 public function getUserRegistrationFull($RG_Reg_NO)
{

$sql = $this->done->prepare("SELECT * FROM `registrations` WHERE `RG_Reg_NO` = ?");
$sql->execute(array($RG_Reg_NO));
return $sql->fetchALL(PDO::FETCH_OBJ);

}

//CourseTypeList  from here 
  public function getCourseCode($CT_Type_Code)
{
$sql = $this->done->prepare("SELECT * FROM `course_type` WHERE CT_Type_Code=?");
$sql->execute(array($CT_Type_Code));
return $sql->fetchALL(PDO::FETCH_OBJ);
}

//batch data attr 
  public function getBatchAttr($BM_Course_Code)
{
$sql = $this->done->prepare("SELECT * FROM `batch_master` WHERE `BM_Batch_Code`=?");
$sql->execute(array($BM_Course_Code));
return $sql->fetchALL(PDO::FETCH_OBJ);
}


//get subjects

 public function getUserSubjectsFull($RG_Reg_NO)
{
$sql = $this->done->prepare("SELECT * FROM `student_subjects` WHERE `SS_REG_NO` = ?");
$sql->execute(array($RG_Reg_NO));
return $sql->fetchALL(PDO::FETCH_OBJ);

}

//get installment

 public function getUserInstallmentFull($RG_Reg_NO)
{

$sql = $this->done->prepare("SELECT * FROM `student_installments` WHERE `SI_Reg_No` = ? ORDER BY `SI_Ins_NO` ASC");
$sql->execute(array($RG_Reg_NO));
return $sql->fetchALL(PDO::FETCH_OBJ);

}



//get history log 

public function getHistoryLog()
{

$sql = $this->done->prepare("SELECT *,`log` as `Logs` FROM `history_log` WHERE `seen` !=1");
$sql->execute();
return $sql->fetchALL(PDO::FETCH_OBJ);
}

public function UpdateSeenHistoryLog($id)
{

$sql = $this->done->prepare("UPDATE `history_log` SET `seen` = '1' WHERE `id` =?");
$sql->execute(array($id));
return $sql->rowCount();

}
public function getHistoryLogCountNewRgistrations($operator)
{

$sql = $this->done->prepare("SELECT COUNT( `log` ) AS `New Registrations` FROM `history_log` WHERE ACTION = 'New User Registration' AND operator=?");
$sql->execute(array($operator));
return $sql->fetchALL(PDO::FETCH_OBJ);

}

//Checking User from here 
 public function currencyFind($RG_Reg_NO)
{
$sql = $this->done->prepare("SELECT RG_Fee_Structure FROM `registrations` WHERE RG_Reg_NO = ? ");
$sql->execute(array($RG_Reg_NO));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}

}//end class

$esoftConfig = new PDO('mysql:host=localhost;dbname=' . DATABASE, USERNAME, PASSWORD, array(
    PDO::ATTR_PERSISTENT => true
));

$esoftConfig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set Errorhandling to Exception


$helper     = new dbLayer($esoftConfig);



$resultQuery = $helper->getLogQuery();


$totalCount = $helper->genderCount("student_master");

$registrationType = $helper->regType();


?>
