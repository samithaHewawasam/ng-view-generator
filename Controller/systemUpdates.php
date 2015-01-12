<?php
 
$response = '';

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
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $serverReturn = json_decode(curl_exec($ch), true);
		curl_close($ch);
		
			return $serverReturn;
        
        
    }
    
    
}

$files = array();

function listFolderFiles($dir, &$files){
    $ffs = scandir($dir);

    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff, $files);
            else array_push($files, array('file' => $dir.'/'.$ff, 'hash' => hash_file('md5', $dir.'/'.$ff)));
        }
      
    }
}
listFolderFiles('/var/www', $files);

$curlObject = new curl('https://esoftholdings.com/systemupdates/list.php', $files);

$response = $curlObject->sendCurl();

var_dump($serverReturn);
?> 
