 <?php
 
 $response = '';

include("../Modal/dbLayer.php");

class curl
{
    
    private $ch;
    public $serverReturn;
    public $url;
    public $data;
    
    public function __construct($url, $data)
    {
        $this->url  = $url;
        $this->data = $data;
    }
    
    public function sendCurl()
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
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
