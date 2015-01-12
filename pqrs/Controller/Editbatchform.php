 <?php session_start();
$SM_Branch_Code = $_SESSION['branchCode'];
$SM_Operator  = $_SESSION['Sys_U_Name'];
$Today=date('Y-m-d');
 include("../../Modal/config.php");
 $esoftConfig=new PDO("mysql:host=127.0.0.1;dbname=".DATABASE,USERNAME,PASSWORD);
include("../Modal/arrays.php");
if(!empty($_POST['BatchCode']))
{
 $BatchCode=trim($_POST['BatchCode']);
$str="SELECT `batch_master`.*,`course`.C_Intake,`course`.Duration  FROM `batch_master` LEFT JOIN `course` ON `batch_master`. BM_Course_Code=`course`.C_Code WHERE `BM_Batch_Code` LIKE ? LIMIT 1";
 $STH=$esoftConfig->prepare($str);
 $STH->execute(array('%'.$BatchCode.'%'));
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);
if($STH->rowCount()){
		foreach($result as $row){
 $BM_Batch_Code=$row['BM_Batch_Code'];			
 $BM_Commence_Date=$row['BM_Commence_Date'];
 $BM_End_Date=$row['BM_End_Date'];			
 $BM_Target_Exam=$row['BM_Target_Exam'];			
 $BM_Ins_Days=$row['BM_Ins_Days'];			
 $C_Intake=$row['C_Intake'];			
 $Duration=$row['Duration'];			
 $BM_Status=$row['BM_Status'];			
		

	 ?>
  <script>
           $(document).ready(function () {           
					  $("#EdBM_Commence_Date").change(function() { alert();
						if($('#EdC_Intake').val()!='Yes')	{							   
						var m_names = {
                    "01": "JAN",
                    "02": "FEB",
                    "03": "MAR",
                    "04": "APR",
                    "05": "MAY",
                    "06": "JUN",
                    "07": "JUL",
                    "08": "AUG",
                    "09": "SEP",
                    "10": "OCT",
                    "11": "NOV",
                    "12": "DEC"
                };		
				var BM_Commence_Date = $('#EdBM_Commence_Date').val();
                    var parts = BM_Commence_Date.split("-");
                    var part2 = m_names[parts[1]] + '/' + parts[0];
                   
                   
                    $('#EdBM_Target_Exam').val(part2);
					
				var Duration=$("#EdDuration").val();
						}
              });
			  });
  </script>   
    <div class="well col-md-5 ">
    <form  method="post" id="EditbatchMasterForm">
    <input  value="UpdateBatchMaster" name="UpdateBatchMaster" type="hidden"> 
    <input id="EdC_Intake" value="<?php echo $C_Intake ?>" name="C_Intake" type="hidden"> 
    <input id="EdDuration" value="<?php echo $Duration ?>" name="Duration" type="hidden"> 
     
   
    <div class="form-group">
    <label for="BatchNumber" >	
   Batch Number:
    </label>
    <input class="form-control" readonly="" id="EdBatchNumber" value="<?php echo $BM_Batch_Code ?>" name="BM_Batch_Code" type="text">
    </div>
	<div class="form-group">
    <label for="BM_Target_Exam" >	
   Target Exam:
    </label>
    <input class="form-control" id="EdBM_Target_Exam" name="BM_Target_Exam" value="<?php echo $BM_Target_Exam ?>" readonly="" type="text">
	 </div> 
    <div class="form-group">
  <label for="BM_Ins_Days" >Instalment Days:</label>
    <input class="form-control" id="EdBM_Ins_Days" size="6" value="<?php echo $BM_Ins_Days ?>" name="BM_Ins_Days" type="text">
  </div>
    <div class="row-fluid">
     
     <div class="form-group">
       <label for="BM_Commence_Date" >Commence Date:</label>
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="form-control BM_Changes " id="EdBM_Commence_Date" size="16" value="<?php echo $BM_Commence_Date ?>" name="BM_Commence_Date" readonly="" type="text">
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
     </div>
     
     <div class="form-group">
       <label for="BM_End_Date" >End Date</label>
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="form-control" id="EdBM_End_Date" size="16"  value="<?php echo $BM_End_Date ?>" name="BM_End_Date" readonly="" type="text">
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
     </div>
     
  </div>
  
  <div class="form-group">
    <label for="BM_Status" >	
   Batch Status:
    </label>
    <select class="form-control" name="BM_Status" >
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    <option value="Completed">Completed</option>
    <option value="<?php echo $BM_Status ?>" selected="selected"><?php echo $BM_Status ?></option>
    </select>
    </div>
<!-- Indicates a successful or positive action -->
<input id="batchMasterUpdate" class="btn btn-medium btn-primary" value="Update Batch" type="button">

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
</form>
<br />
<br />
<br />
<br />

</div>

<?php }
}
else{
echo '<h3>No Records Found</h3>';

}
 } 
 
 if(!empty($_POST['UpdateBatchMaster']))
{
//var_dump($_POST);
$BM_Batch_Code="";
$BM_Commence_Date="";
$BM_End_Date="";
$BM_Target_Exam="";
$BM_Status="";
$BM_Ins_Days="";
if(isset($_POST['BM_Batch_Code'])){$BM_Batch_Code = $_POST['BM_Batch_Code'];}
if(isset($_POST['BM_Commence_Date'])){$BM_Commence_Date = $_POST['BM_Commence_Date'];}
if(isset($_POST['BM_End_Date'])){$BM_End_Date = $_POST['BM_End_Date'];}
if(isset($_POST['BM_Target_Exam'])){$BM_Target_Exam = $_POST['BM_Target_Exam'];}
if(isset($_POST['BM_Status'])){$BM_Status = $_POST['BM_Status'];}
if(isset($_POST['BM_Ins_Days'])){$BM_Ins_Days = $_POST['BM_Ins_Days'];} 


$data=array($BM_Commence_Date,$BM_End_Date,$BM_Ins_Days,$BM_Status,$BM_Target_Exam,$BM_Batch_Code);
$sql='UPDATE `batch_master` SET `BM_Commence_Date`=?,`BM_End_Date`=?,`BM_Ins_Days`=?,`BM_Status`=?,`BM_Target_Exam`=? WHERE `BM_Batch_Code`=?';
$esoftConfig->beginTransaction();
$sth = $esoftConfig->prepare($sql);

//history log 
$log = "$BM_Batch_Code has been edited by the $SM_Operator in $SM_Branch_Code @ ".$Today;
$action = 'Edit Batch';
$comment ='';
$histroyLogArray=array($log, $Today, $SM_Operator, $SM_Branch_Code, $action, $comment);
//Sync Query


if($sth->execute($data) && SyncInsert($esoftConfig,$sql,$data) && HistoryLogInsert($esoftConfig,$histroyLogArray)){
$esoftConfig->commit();
echo '<h3>Batch Updated Successfully</h3>';

}
else
{
$esoftConfig->rollback();
echo '<h3>Batch Updating Fail</h3>';
}
}
 
 
 ?>