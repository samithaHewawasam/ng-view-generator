<?php include('../../Modal/SysSettings.php'); 

//echo var_dump($_POST);

if(!empty($_POST['SysSaveCheck']))

{
//$BranchCode=$_POST['BranchCode'];
//$SubOfficeCode=$_POST['SubOfficeCode'];
////$OfficeAddress=$_POST['OfficeAddress'];
//$OfficeTelephone=$_POST['OfficeTelephone'];
//$StartedDate=$_POST['StartedDate'];

$myFile = "../../Modal/SysSettings.php";
$fh = fopen($myFile, 'w') or die("can't open file");

$stringData=  "<?php \n";
foreach($_POST as $key => $value)
{
$stringData.='$'.$key."='".addslashes($value)."';\n";
}
$stringData.="?>"; 
fwrite($fh, $stringData);

fclose($fh);

echo '<h4 class="text-center">System Settings Saved Successfuly</h4>';
}
?>
                    	
                                    
                   
	
					
