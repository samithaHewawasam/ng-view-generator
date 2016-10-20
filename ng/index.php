 <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$esoftConfig = "";
$tb = "master_students";
    
class dbLayer
{

    //connection from here
    private $done;
    public $error = array();
    public $errorInfo;
    public $commitCode;
    public $roalBackCode;
    public $result;
    private $tb = "master_students";


    function __construct(PDO $connection)
    {
        $this->done = $connection;
    }

    public function getUserRegistrationFull()
    {

        $sql = $this->done->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'britishway' AND TABLE_NAME = '".$this->tb."'");
        $sql->execute();
        return $sql->fetchALL(PDO::FETCH_OBJ);

    }

} 

$esoftConfig = new PDO('mysql:host=localhost;dbname=britishway', "root", "891600909v", array(
    PDO::ATTR_PERSISTENT => true
));

$esoftConfig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$helper           = new dbLayer($esoftConfig);
$resultQuery      = $helper->getUserRegistrationFull();

$form = "<form name=".$tb."_form novalidate>";

foreach($resultQuery as $obj){


$form .= '<div class="form-group col-lg-12 col-xs-12" ng-class="{ \'has-error\': '.$tb.'_form.'.$obj->COLUMN_NAME.'.$invalid &&!'.$tb.'_form.'.$obj->COLUMN_NAME.'.$pristine}">';
$form .=  '<label>'.$obj->COLUMN_NAME.'</label>';
$form .=  '<input type="text" class="form-control"  name='.$obj->COLUMN_NAME.' ng-model="'.$tb.'.'.$obj->COLUMN_NAME.'" ng-required="true">';
$form .=  '</div>';

}

$form .= '<div class="form-group col-lg-12">';
$form .= '<a href="javascript:void(0)" ng-disabled="'.$tb.'_form.$invalid" class="btn create-btn" ng-click="save'.$tb.'('.$tb.')">Create</a>';
$form .= '</div>';

$form .= "</form>";
echo $form;

echo mkdir($tb, 0777);
echo file_put_contents($tb."/".$tb.".html",$form);

?>

