<?php session_start();
if(isset($_POST['pk']))
{
include('../../Modal/dbLayer.php');
$idfield=$_POST['pk'];
$value=trim($_POST['value']);
//$value=mysql_real_escape_string($value);

//$select_db=mysql_select_db('cashexpress');
//$a="title";
////////////////////////////////
$array = explode('+',$idfield);
                $table=($array[0]);
			    $column=($array[1]);
				$id=($array[2]);
			    $field=($array[3]);

////////////////////////////
$data=array($value,$id);
$sql="UPDATE `$table` SET `$field` =? WHERE `$column`=? ";
$strs=$esoftConfig->prepare($sql);
$strs->execute($data);
$count= $strs->rowCount();
	if(!$count)
{
echo 'Fail to update';
}
else
{
echo $value;
}
}

?>

 
