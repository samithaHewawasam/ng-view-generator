 <?php
 
 $response = '';

include("../Modal/dbLayer.php");

class curl
{
    
    private $ch;
    public $serverReturn;
    public $url;
    public $data;
    
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function sendCurl()
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://esoftholdings.com/updates/post.php');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverReturn = json_decode(curl_exec($ch), true);
		curl_close($ch);
		
			return $serverReturn;
        
        
    }
    
    
}

#Add database to the query array....

$getQueryArray = $resultQuery[0];
$getQueryArray['database'] = DATABASE;

#Set Server path and Data to curl object....

$curlObject = new curl($getQueryArray);

$response = $curlObject->sendCurl();

#Update local sync log status....

if($response['commitCode']){
	
  echo json_encode($helper->MySqlWrapperForSyncUnserialize(array(array('query' => "UPDATE `sync_log` SET `Sync_Status`=? WHERE `Sync_ID`=?", 'Data' => array(true,$response['Sync_ID'])))));
	
}
	
#get the response from 

if(!empty($response['sub_office_data'][0])){

$getLocalUpdateOnQuery = $helper->MySqlWrapperForSubOffice($response['sub_office_data'][0]);

$getLocalUpdateOnQuery['database'] = DATABASE;

$curlObject2 = new curl($getLocalUpdateOnQuery);

$curlObject2->sendCurl();

}

?> 
