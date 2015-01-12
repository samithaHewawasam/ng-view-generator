<?php session_start();
 include("LogController.php");
$editable='';
$editable2='';
$tag='span';
 if((@$_SESSION["Sys_U_Username"])=='asitha'){
$editable=' editcode';
$editable2=' editcodetarget';
$tag='a';

}

 $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 30);
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
$DBprefix='`esoftcar_' ;//use back tic (`)
$DBsuffix='`' ;
$data=null;
$subsql='';
$table='';
$link='';
$Query=null;	
$Data=null;	
/////////
if (empty($_POST['BranchCode']) && !empty($_POST['SelectedBranch']) && $_SESSION['bset']==1){
$key=key($_POST['SelectedBranch']);
$_POST['BranchCode']=$_POST['SelectedBranch'][$key].'---'.$_SESSION['Sys_U_Branches'];
}
if(!empty($_POST['BranchCode']))
{

$bA=explode('---',$_POST['BranchCode']);
$myReport = "temp/IncomeReport".time().".txt";
$DataBase=$DBprefix.strtolower($bA[1]).$DBsuffix;
//var_dump($_POST);
	echo '<script>
           $(document).ready(function () { 
		   
		   $(".editcode").editable({
           url: "Controller/Batch_Code_Update.php",
           type: "text",
           title: "Enter Updates",
		   ajaxOptions: {
        dataType: "json"
    },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.status === false) {
            return response.Msg;
        }
    }        
		   
    });

		   $(".editcodetarget").editable({
           url: "Controller/Batch_Code_Update.php",
           type: "text",
           title: "Enter Updates",
		     params: function(params) {
                var line = $(this).closest("tr").find(".editcode").text();
                var data = {};
                data["pk"] = params.pk;
                data["value"] = params.value;
                data["lineId"] = line;
                return data;
            },
		   ajaxOptions: {
        dataType: "json"
    },
     success: function(response, newValue) {
        if(!response) {
            return "Unknown error!";
        }          
        
        if(response.status === false) {
             return response.Msg;
        }
    }        
		   
    });
	
		   		$(".editbatch").unbind().click(function (event) { 
				$("#ajaxModal").modal();
						   var data_save = $("#SearchFormQuery").serializeArray();
					
						 data_save.push({
                        name: "BatchCode",
                        value: $(this).attr("data")
                    },{
                        name: "BatchAction",
                        value: "Edit"
                    });					
								 AjaxFun("Controller/newbatchform.php",data_save ).done(function (result) {
								 $("#ajaxModal").modal("hide");
                    $("#GenModalBody").html(result);$("#GenModal").modal();
					
			 });
																		});	
		  
			    $("#NewBatch").unbind().click(function () {
				
				if($("#CourseList").val()!="All"){
				$("#ajaxModal").modal();
				 var data_save = $("#SearchFormQuery").serializeArray();
				 data_save.push({
                        name: "LoadData",
                        value: $("#CourseSelect").val()
                    },{
                        name: "BatchAction",
                        value: "New"
                    });
        AjaxFun("Controller/newbatchform.php",data_save).done(function (result) {
          $("#ajaxModal").modal("hide");
            $("#GenModalBody").html(result);$("#GenModal").modal();
        });
}
else
{ alert("Please Select a Course !")}

    });
			
			
		    });
			</script>

 <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
   <h3>Batches List</h3>
    </div>
	<div class="modal-body" >

     <div class="form-group">
     <div class="row">

	 <div class="col-sm-4" ><button class="btn btn-success" id="NewBatch"   type="button" >New Batch</button> 
     </div>
     </div>
     </div>

	';
if(!empty($_POST['Query'])){
$subSql=base64_decode($_POST['Query']);
$BindData=unserialize(base64_decode($_POST['Data']));
$Query=$_POST['Query'];
$Data=$_POST['Data'];

}else
{

$DateTable=" `batch_master`.`BM_Commence_Date` ";
include('SearchPostPart.php');
$FirstRangeWhere = $Where . $RGStatusPart.$FirstDatePart.$DivisionPart.$BatchPart.$CoursPart.$IntakePart.'  GROUP BY `batch_master`.`BM_Batch_Code`  ORDER BY `batch_master`.`BM_Commence_Date` DESC'; 
$subSql=" LEFT JOIN $DataBase.`course` ON `batch_master`.`BM_Course_Code`=`course`.`C_Code`
LEFT JOIN $DataBase.`course_type` ON `course`.`C_Code` = `course_type`.`CT_Course_Code`
LEFT JOIN $DataBase.`registration_type` ON `course_type`.`CT_Type_Code` = `registration_type`.`RT_Code`".$FirstRangeWhere;

$Query=base64_encode($subSql);
$Data=base64_encode(serialize($BindData));

}	
	
	//------Pagination-------//


 $per_page = 20; // Number of items to show per page
 $per_page_array=array(10,20,30,40);
 $start=0;  // Current start position 
 
if(!empty($_POST['PageF'])){
$start=$_POST['PageF'];
$per_page=$_POST['per_pageF'];
}
if(!empty($_POST['per_page'])){
$per_page=$_POST['per_page'];
}
 if(isset($_POST['Page'])){
$per_page=$_POST['per_page'];
$start=$_POST['Page'];
}

$showeachside = 20 ;//  Number of items to show either side of selected page
//Get Num Of Rows
$str="SELECT `BM_ID` FROM $DataBase.`batch_master` $subSql";
 $stmt=$esoftConfig->prepare($str);
 $stmt->execute($BindData);
 $count=$stmt->rowCount();
//Get Num Of Rows End
    $max_pages = ceil($count / $per_page); // Number of pages
    $cur = ceil($start / $per_page)+1; // Current page number

//------Pagination----End---//
 $sql="SELECT *,(SELECT COUNT(`Default_Batch`) FROM $DataBase.`registrations` WHERE `Default_Batch`=`BM_Batch_Code`) As `Count` FROM $DataBase.`batch_master`  $subSql LIMIT $start, $per_page";
 $STH=$esoftConfig->prepare($sql);
 $STH->execute($BindData);
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
 echo '<form id="SearchFormQuery">

<input type="hidden" value="'.$_POST['BranchCode'].'"  name="BranchCode" />
<input name="bset" id="bset" value="'.$_SESSION['bset'].'" type="hidden">
<input name="Query" value="'.$Query.'" type="hidden">
<input name="Data" value="'.$Data.'" type="hidden">
<input name="PageF" value="'.$start.'" type="hidden">
<input name="per_pageF" value="'.$per_page.'" type="hidden">
</form>';
if($STH->rowCount()){
echo '
<table class="table" >
  <tr class="danger">
    <td>Branch Code</td>
    <td>Course Code</td>
    <td>Batch Code</td>
    <td>Commence Date</td>
    <td>End Date</td>
    <td>Target Exam</td>
    <td>Ins Days</td>
    <td>BM_Statuse</td>
    <td>Stu Count</td>
    <td>Publish</td>
    <td>Actions</td>
  </tr>';
foreach($result as $row){
  echo '<tr>
    <td>'.$row['BM_Branch_Code'].'</td>
    <td>'.$row['BM_Course_Code'].'</td>
    <td ><'.$tag.' href="#" class="'.$editable.'"  data-pk="'.$randomString.base64_encode('batch_master+++BM_Batch_Code+++BM_Batch_Code+++'.$row['BM_Batch_Code'].'+++'.$bA[1]).'"  >'.$row['BM_Batch_Code'].'</'.$tag.'></td>
    <td>'.$row['BM_Commence_Date'].'</td>
    <td>'.$row['BM_End_Date'].'</td>
    <td><'.$tag.' href="#ewwe" class="'.$editable2.'"  data-pk="'.$randomString.base64_encode('batch_master+++BM_Target_Exam+++BM_Batch_Code+++'.$row['BM_Batch_Code'].'+++'.$bA[1]).'"  >'.$row['BM_Target_Exam'].'</'.$tag.'></td>
    <td>'.$row['BM_Ins_Days'].'</td>
    <td>'.$row['BM_Status'].'</td>
    <td>'.$row['Count'].'</td>
    <td>'.($row['BM_Published']==1? '<font color="#00CC00">Yes</font>':'<font color="#990000">No</font>').'</td>
	<td class="editbatch" data="'.$row['BM_Batch_Code'].'" >Edit</td>
  </tr>';

}
echo '</table>
';
?>

<table id="PagiN_Trn" width="499" border="0" align="center" cellpadding="0" cellspacing="0" class="PHPBODY">
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
<a class="goto" page="<?php print("#$next");?>"  >&lt;&lt;</a> 
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
<a class="goto" page="<?php print("#".max(0,$start+$per_page))  ?>" >&gt;&gt;</a> 
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
&nbsp;<a class="goto <?php print($class);?>" page="<?php print("#$y");?>"  ><?php print($pg);?></a>&nbsp;
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


<?php	}
   echo ' </div>';
   }

?>
