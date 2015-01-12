<?php session_start();
/*** cycle through all files in the directory ***/
foreach (glob("temp/*") as $file) {
/*** if file is 24 hours (86400 seconds) old then delete it ***/
if (filemtime($file) < time() - 86400) {
    unlink($file);
    }
}

 include("../../Modal/config.php");
 
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
include('../Modal/arrays.php');


//var_dump($_POST);
 if(!empty($_POST['Table']))
 {
 echo '<div id="TableWizard">';
 
  $TableHeader=null;
 $DataBase=null;
 $SearchInput=null;
 $TableSearch=null;
 $subsql=null;
 $Data=null;
$Table=$_POST['Table'];
if(!empty($_POST['SearchInput'])){
foreach($_POST['SearchInput'] as $col => $value){

if(!empty($value)){
$subsql.=" AND `$col` LIKE ?";
$Data[]='%'.trim($value).'%';
}
}
}

$AI_Col=$Table_List_Array[$Table]['Primary'];
$Table_Column_Names=$Table_List_Array[$Table]['Columns'];
$AI_Col_HO=$AI_Col;


//------Pagination-------//

 $per_page = 20; // Number of items to show per page
 $per_page_array=array(10,20,30,40);
 $start=0;  // Current start position 

 if(!empty($_POST['Page'])){
 
$per_page=$_POST['per_page'];
$start=$_POST['Page'];
}

$showeachside = 10 ;//  Number of items to show either side of selected page

//Get Num Of Rows
 $str="SELECT `$AI_Col` FROM $DataBase`$Table` WHERE 1  $subsql";
 $stmt=$esoftConfig->prepare($str);
 $stmt->execute($Data);
 $count=$stmt->rowCount();
//Get Num Of Rows End
    $max_pages = ceil($count / $per_page); // Number of pages
    $cur = ceil($start / $per_page)+1; // Current page number

//------Pagination----End---//







foreach($Table_Column_Names as $Val)
{
$TableHeader.='<td>'.str_replace('_',' ',$Val).'</td>';
 $inputvalue=null;
if(!empty($_POST['SearchInput'][$Val])){
$inputvalue=$_POST['SearchInput'][$Val];
}

$TableSearch.='<td><input class="input-small" value="'.$inputvalue.'" type="text" name="SearchInput['.$Val.']"  /></td>';
}

echo '<h4>'.strtoupper($Table).' </h4><form id="SearchForm"><input type="hidden" name="Table" value="'.$Table.'" />
<table class="table table-striped table-hover" ><tbody>
		<tr class="cthead" ><td></td>'.$TableHeader.'</tr><tr ><td></td>'.$TableSearch.'</tr>';
		
	
	                     $str="SELECT * FROM $Table WHERE 1 $subsql ORDER BY $AI_Col DESC LIMIT $start, $per_page";
						 $stmt=$esoftConfig->prepare($str);
						 $stmt->execute($Data);
	while (($row = $stmt->fetch(PDO::FETCH_ASSOC)))
{
echo '<tr id="'.$row[$AI_Col_HO].'"  ><td class="delete" ></td>';
foreach($Table_Column_Names as $Val)
{
echo '<td><a  class="edit"  data-pk="'.$Table.'+'.$AI_Col_HO.'+'.$row[$AI_Col_HO].'+'.$Val.'">'.$row[$Val].'<a/></td>';

}
echo '</tr>';

}
	echo '<tr class="cthead"><td></td>'.$TableHeader.'</tr></tbody>';
//////////////////////////////	
echo '</table></form>';
?>
<table id="PagiN_Reg" width="499" border="0" align="center" cellpadding="0" cellspacing="0" class="PHPBODY">
<tr>
  <td width="99" align="center" valign="middle"><?php echo '<select class="per_page input-mini" title="Select page size">';
				$selected='';
				foreach($per_page_array as $val2){
				
				echo 	'<option ';
				if($per_page==$val2){ echo $selected='selected="selected"';}
				echo ' value="'.$val2.'">'.$val2.'</option>';
					
					}
				
				echo '</select>' ?></td> 
<td width="99" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php
if(($start-$per_page) >= 0)
{
    $next = $start-$per_page;
?>
<a class="goto" href="<?php print("#$next");?>">&lt;&lt;</a> 
<?php
}
?></td>
<td width="201" align="center" valign="middle" class="selected">
Page <?php print($cur);?> of <?php print($max_pages);?><br>
( <?php print($count);?> records )</td>
<td width="100" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php 
if($start+$per_page<$count)
{
?>
<a class="goto" href="<?php print("#".max(0,$start+$per_page)) ?>">&gt;&gt;</a> 
<?php
}
?></td>
</tr>
<tr><td colspan="4" align="center" valign="middle">&nbsp;</td></tr>
<tr> 
<td align="center" valign="middle" class="selected">&nbsp;</td>
<td colspan="3" align="center" valign="middle" class="selected"><?php 
$eitherside = ($showeachside * $per_page);
if($start+1 > $eitherside){print (" .... ");}
$pg=1;

for($y=0;$y<$count;$y+=$per_page)
{
    $class=($y==$start)?"badge badge-important":"";
    if(($y > ($start - $eitherside)) && ($y < ($start + $eitherside)))
    {
?>
&nbsp;<a class="goto <?php print($class);?>" href="<?php print("#$y");?>"><?php print($pg);?></a>&nbsp;
<?php
    }
    $pg++;
}
if(($start+$eitherside)<$count){print (" .... ");};
?></td>
</tr>
<tr>
<td colspan="4" align="center"></td>
</tr>
</table>

<?php
echo '</div>';
}
else
{

echo '<h2>Please Slect a Table</h2>';
}
?>

