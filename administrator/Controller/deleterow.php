<?php session_start();
if(isset($_POST['deletedata']))
{
include('../../Modal/config.php');
$idfield=trim($_POST['deletedata']);

////////////////////////////////
$array = explode('+',$idfield);
                $table=($array[0]);
			    $column=($array[1]);
				$id=($array[2]);

////////////////////////////
$esoftConfig =new PDO("mysql:host=$host;dbname=$db",$username, $password);
$sql="DELETE FROM $table WHERE $column=$id";

$strs=$esoftConfig->prepare($sql);
$strs->execute();
$count= $strs->rowCount();
	if($count)
{
echo $id;
}
else
{
echo 'Fail to Delete';
}
}

?>

 
