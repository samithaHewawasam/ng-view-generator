<?php
$esoftConfig = "";
$commitCode="";
$result="";
//error_reporting(0);
//include_once dirname(__FILE__) . '/config.php';


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


/*wrapper for mysql*/

 public function MySqlWrapper(array $arguments)
{

           try {
            $this->done->beginTransaction();
            foreach($arguments as $key => $val){
            $sql = $this->done->prepare($val['query']);
			foreach ($val['bind'] as $key => &$val) {
            $sql->bindValue($key + 1, $val);
            };
            $this->result[] = $sql->execute();
            }

            $this->commitCode = $this->done->commit();			
		}			
        catch (PDOException $ex) {
           $this->errorInfo = "Ooops: ".$ex->getMessage();

           $this->roalBackCode = $this->done->rollBack();
          
        }

return array('result' => $this->result, 'errorInfo' => $this->errorInfo, 'commitCode' => $this->commitCode, 'roalBackCode' => $this->roalBackCode); 

}


//getLastInvoiceNumber from here 
 public function getLastInvoiceNumber($BranchCode)
{
$sql = $this->done->prepare("SELECT `OP_Receipt_No` FROM `other_payments` WHERE  OP_Receipt_No LIKE ? AND
  MONTH(OP_Date) = MONTH(CURDATE())
  AND YEAR(OP_Date) = YEAR(CURDATE())
ORDER BY `OP_Receipt_No` DESC LIMIT 1");
$sql->execute(array('%'.$BranchCode.'%'));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}

//getLastTotalPaid from here 
 public function getLastTotalPaid($reg_n)
{
$sql = $this->done->prepare("SELECT `RG_Total_Paid` FROM `registrations` WHERE RG_Reg_NO=?");
$sql->execute(array($reg_n));
return $sql->fetchALL(PDO::FETCH_COLUMN, 0);
}



}//end class
include("../Modal/config.php");

 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD,array(
    PDO::ATTR_PERSISTENT => true));


$esoftConfig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set Errorhandling to Exception


$helper     = new dbLayer($esoftConfig);





?>
