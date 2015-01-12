<?php 

include_once dirname(__FILE__) .'../Modal/dbLayer.php';

// need 
if(!empty($_POST['LoadData']))
{
 $course=$_POST['LoadData'];

$str="SELECT C_Intake,C_Name,C_Type,Duration FROM `course` WHERE `C_Code` =? LIMIT 1";
 $STH=$esoftConfig->prepare($str);
 $STH->execute(array($course));
 $result = $STH->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $row){
 $intakestatus=$row['C_Intake'];			
 $C_Name=$row['C_Name'];
 $C_Type=$row['C_Type'];			
 $Duration=$row['Duration'];			
}



		

	 ?>
     
    <div style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Create your batch here</h3>
    </div>
    <div class="modal-body" >
    <form action="#" method="post" id="batchMasterForm">
    <input type="hidden" id="BM_Course_Code" value="<?php echo $course ?>" name="BM_Course_Code"> 
    <input type="hidden" id="C_Type" value="<?php echo $C_Type ?>" name="C_Type"> 
    <input type="hidden" id="Duration" value="<?php echo $Duration ?>" name="Duration"> 

    <div class="input-prepend"><h4><?php echo $C_Name ?></h4></div>
     
   
   <div class="control-group">
    <label for="BatchNumber" class="control-label">	
   Batch Number:
    </label>
    <div class="controls">
    <input  class="span3 required" readonly="readonly"  type="text" id="BatchNumber" value="" name="BM_Batch_Code">
    <input  class="span1 required"   type="text" id="BM_Batch_Count" value="" name="BM_Batch_Count">
    </div>
    </div>
     <?php 
		
	if($intakestatus=='Yes')	{
$commentdateclass='';	

$str2="SELECT Intake FROM intakes WHERE C_Code=?";
 $wheredata2=array($course);
 $STH=$esoftConfig->prepare($str2);
 $STH->execute($wheredata2);
 $result2 = $STH->fetchAll(PDO::FETCH_ASSOC);
 $selectMenu='<select name="BM_Target_Exam" id="IntakeSelect" class="selectpicker BM_Changes required" ><option value="" >--Select--</option>';
			foreach($result2 as $row)
{

$selectMenu.='<option value="'.$row['Intake'].'" >'.$row['Intake'].'</option>';
}
 $selectMenu.='</select>';
	
      

echo '
		<div class="control-group">
    <label for="IntakeSelect" class="control-label">	
   Intake:
    </label>
    <div class="controls">
   '. $selectMenu.'
    </div>
    </div>
		

		';

	}
	else
	{
$commentdateclass='BM_Changes';	
	
	
	 echo '
	<div class="control-group">
    <label for="BM_Target_Exam" class="control-label">	
   Target Exam:
    </label>
    <div class="controls">
    <input  type="text"  class="required" id="BM_Target_Exam" name="BM_Target_Exam" readonly>
    </div>

	';
	
	}
	
	?>
    <div class="row-fluid">
     
     <div class="span4">
       <label for="BM_Commence_Date" class="control-label">Commence Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 <?php echo $commentdateclass ?> required" id="BM_Commence_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="BM_Commence_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
     
     <div class="span4">
       <label for="BM_End_Date" class="control-label">End Date</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 required" id="BM_End_Date" size="16" type="text"   placeholder="yyyy-mm-dd" name="BM_End_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
     
  </div> 
    <div class="control-group">
  <label for="BM_Ins_Days" class="control-label">Instalment Days:</label>
    <div class="controls">
      
        <div class="input-append">
    <input class="span2 required" id="BM_Ins_Days" size="6" type="text"  name="BM_Ins_Days" >
   
    </div>
    </div>
  </div>
 
    <div >
<!-- Indicates a successful or positive action -->
<input type="submit" id="batchMasterSave" class="btn btn-medium btn-primary" value="Save Batch" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
<br />
<br />
<br />
<br />
<br />
<br />
<br />

</div>
 
  

</form>
</div>
</div>
                    	
                    	
                                    
                   
	
					
<?php } ?>
