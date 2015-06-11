 <?php


class getWrapper
{
    
    //connection from here 
    private $db;
    private $errorInfo;
    private $commitCode;
    private $errorCode;
    private $getSqlEach;
    private $getUpdate;
    private $session;
    
    function __construct(PDO $connection)
    {
        $this->db = $connection;
    }
            
    /*wrapper for mysql*/
    
    public function MySqlWrapper(array $arguments)
    {
        
        try {
        
        if(!empty($arguments['query'])){
                     
            $this->db->beginTransaction();
                                   
            $sqlSync = $this->db->prepare("INSERT IGNORE INTO `get_sync`(`query`, `Data`, `Sync_ID`, `status` ,`database`, `sub_office`) VALUES (?,?,?, true,?,?)");
            $sqlSync->execute(array(
                $arguments['query'],
                $arguments['data'],
                $arguments['Sync_ID'],
                $arguments['database'],
                $arguments['database']
            ));
           
            if ($sqlSync->rowCount() != 0) {

              $sql = $this->db->prepare($arguments['query']);
                $sql->execute(unserialize($arguments['data']));
               
            }
            
            $this->commitCode = $this->db->commit();
            
           } 
        }
        catch (PDOException $ex) {
            $this->errorInfo = $ex->getMessage();
            $this->db->rollBack();
  
        }
        
        return array(
            'errorInfo' => $this->errorInfo,
            'commitCode' => $this->commitCode,
            'Sync_ID' => $arguments['Sync_ID']
        );
        
    }
    
    /*wrapper for mysql*/
    
    public function getSelected($database)
    {
        
        
        $getSqlEach = $this->db->prepare("SELECT `query`,`Data`,`Sync_ID`,`database` FROM `get_sync` WHERE `database` != ? AND (NOT FIND_IN_SET( ?, `sub_office` ) ) ORDER BY `get_sync`.`date` ASC LIMIT 1");
        $getSqlEach->execute(array(
            $database,
            $database
        ));
        return $getSqlEach->fetchALL(PDO::FETCH_ASSOC);
        
        
    }
    
        public function getCertificateEligibleList()
    {
        
        
        $getSqlEach = $this->db->prepare("SELECT * FROM `student_master`");
        $getSqlEach->execute();
        return $getSqlEach->fetchALL(PDO::FETCH_ASSOC);
        
        
    }
    
    public function getUpdated($database, $Sync_ID)
    {
                     	      
        $getUpdate = $this->db->prepare("UPDATE `get_sync` SET `sub_office`= CONCAT(`sub_office`,',',?) WHERE `Sync_ID`=?");
        $getUpdate->execute(array(
            $database,
            $Sync_ID
        ));
        
    }
    
    
    
}



/*
 *Return data as json format
 */

class returnJson
{
    
    /**
     * Return data.
     *
     */
    protected $data;
    
    public function __construct($data)
    {
        
        $this->data = $data;
    }
    
    public function render()
    {
        return json_encode($this->data);
    }
    
}

?> 