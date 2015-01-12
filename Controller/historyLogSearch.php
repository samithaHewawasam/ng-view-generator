<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<?php

$search='';

if(isset($_GET['search'])){$search = $_GET['search'];}
include("../Modal/dbLayer.php");

$stmts = $esoftConfig->prepare("SELECT * FROM history_log WHERE `log` LIKE ?");
$stmts->execute(array('%'.$search.'%'));
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
  

