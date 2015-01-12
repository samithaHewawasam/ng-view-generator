<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<?php

$date='';
$operator='';
$branch='';
$action='';
$params='';
$where='';

if(isset($_GET['date'])){$date = $_GET['date'];}
if(isset($_GET['operator'])){$operator = $_GET['operator'];}
if(isset($_GET['branch'])){$branch = $_GET['branch'];}
if(isset($_GET['action'])){$action = $_GET['action'];}

include("../Modal/dbLayer.php");

if($date){

   $where[]  = "date = ?";
   $params[] = $date;

}

if($operator){

   $where[]  = "operator = ?";
   $params[] = $operator;
}

if($branch){

   $where[]  = "branch = ?";
   $params[] = $branch;

}

if($action){

   $where[]  = "action = ?";
   $params[] = $action;

}

$sql = 'SELECT `log` FROM `history_log` WHERE ';
if (count($where)) $sql.= " ".implode(" AND ", $where);

$stmts = $esoftConfig->prepare($sql);
$stmts->execute($params);
$rows = $stmts->fetchALL(PDO::FETCH_ASSOC);
$count = $stmts->rowCount();
foreach($rows as $value):

?>

    <div style='margin: 40px;' class="alert alert-success">

<?php echo $value['log']; ?>
    </div>

<?php endforeach ?>

<?php

if($count == false){
echo "<div style='margin: 40px;' class='alert alert-error'>";
echo "There are no history for your request";
echo "</div>";
}

?>
  
  
        
