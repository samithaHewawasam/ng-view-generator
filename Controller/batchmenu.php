<?php session_start();
if(!empty($_POST['LoadCount']))
{
include("../Modal/dbLayer.php");

$LoadCount=$_POST['LoadCount'];
$sql="SELECT BM_Batch_Code FROM batch_master WHERE BM_Batch_Code LIKE ? ";
$sth = $esoftConfig->prepare($sql);
$sth->execute(array('%'.$LoadCount.'%'));
$count=$sth->rowCount();
if($count!=0){
$results = $sth->fetchAll();
		
			foreach($results as $row)
			{
 $COUNT[substr($row['BM_Batch_Code'], -3)]=$row['BM_Batch_Code'];
 
 }
 $value=max(array_keys($COUNT));
 $value=$value+1;
 echo $value=str_pad($value, 3, '0', STR_PAD_LEFT);
}
else
{
echo '001';
}

}


			
						 ?>

