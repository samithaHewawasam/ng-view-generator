<?php session_start();
 include("LogController.php");
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
  include("../Modal/GenaralFunc.php");
//$_SESSION['Sys_U_Branches']='COL';

$HostType=Htype(DATABASE);
$branches=null;
$BranchCheckBox=null;
$checkAll=null;


if(!empty($_POST['OwnerShip']) and $_POST['OwnerShip']!='All'){
$subsql= " AND `B_OwnerShip`='".$_POST['OwnerShip']."'";
}
else{
$subsql='';
}


if(@$_SESSION['Sys_U_Branches']=='All'){

$branches='';
}
else
{
$b=explode(',',@$_SESSION['Sys_U_Branches']);
$branches="AND B_CODE IN("."'" . implode("','",$b) . "'".")";
}
if($HostType=='Local'){
 $sql="SELECT * FROM `branches` WHERE `B_CODE` LIKE '" . substr($_SESSION['branchCode'], 0, 3) . "' LIMIT 1 ";
}
else
{
 $sql="SELECT * FROM `branches` WHERE `System`='Active' $branches $subsql ORDER BY `B_Branch_Name`";
}
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
$count = $sth->rowCount();
$firstcol=floor($count / 3);
$secondcol=$firstcol*2;
$Province=null;
$colour1='#009933';
$colour2='#3366FF';
$option=null;
if($count){
$rows = 2;  
//$count=$count+($count % $rows);

   // The number of columns you want.
     // Number of rows in each column

// Open the first div. PLEASE put the CSS in a .css file; inline used for brevity
$BranchCheckBox.= "<table><tr>";

// Main printing loop.
for($i = 0; $i < $count; $i++)
{
    // If we've reached our last row, move over to a new div
    if(!($i % $rows) && $i > 0)
    {
        $BranchCheckBox.= "</tr><tr>";
    }
$row=$results[$i];
if($row['B_OwnerShip']=='Franchise'){
$color=$colour1;
}
else
{
$color=$colour2;
}
    //echo $results[$i]['B_CODE'].$i.'<br />';  
$BranchCheckBox.= '<td ><i ><input class="BranchList"  name="SelectedBranch['.$row['B_CODE'].']" value="'.$row['B_Branch_Name'].'" type="checkbox" checked ></i>
';
$BranchCheckBox.= ' <font color="'.$color.'">'. $row['B_Branch_Name'].' </font>
    </td>';
	    // Add a cell and your content
}

// Close the last div
$BranchCheckBox.= "</tr></table>";

if(!empty($_POST['OwnerShip'])){

echo $BranchCheckBox;exit;

}




if((($HostType!='Local') and (count($b)>1)) or @$_SESSION['Sys_U_Branches']=='All'){

echo $checkAll='    <div id="BranchlistSub">
<div class="control-group">

    <div class="controls">    <label for="B_OwnerShip" class="control-label">	
    Ownership:
    </label>
    <select class="input-medium" id="B_OwnerShip" name="B_OwnerShip">

                <option value="Franchise">
                  Franchise
                </option>

                <option value="Esoft">
                  Esoft
                </option>
                 <option selected="selected" value="All">
                  All
                </option>
              </select>
    </div>
    </div>
';
     echo  ' 
   <div class="row-fluid">

      <div class="control-group">
    <label for="CC_BranchList" class="control-label">	
    Branches :
    </label>    <label>
    <input id="INCheckAll"  checked type="checkbox" > Check/Uncheck All
    </label>

    <div class="row-fluid" id="CC_BranchList">';
	echo $BranchCheckBox;
echo '</div>
    </div>
        </div></div>';
		


}
elseif(($HostType=='Local'))
{
$dbcode=strtolower(str_replace('/','-',$_SESSION['branchCode'])) ;
echo '<input name="SelectedBranch['.$dbcode.']" class="BranchList" value="'.$row['B_Branch_Name'].'" type="hidden" >';
}
else{
echo '<input name="SelectedBranch['.$_SESSION['Sys_U_Branches'].']" class="BranchList" value="'.$row['B_Branch_Name'].'" type="hidden" >';

}

}
else
{
$D=explode('_',DATABASE);
$Code=strtolower(str_replace('/','-',$D[1]));
echo '<input name="SelectedBranch['.$Code.']" class="BranchList" value="'.$D[1].'" type="hidden" >';
}

 ?>      
