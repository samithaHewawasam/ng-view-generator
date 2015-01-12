<?php 
function SelectOptions($copyResult,$valueKey,$contentKey,$Selected=''){
$str='';
 foreach($copyResult as $row){
				$Selected==$key ? $select='selected="selected"':$select='';
				$str.= "<option ".$select." value='".$row[$valueKey]."' >".$row[$contentKey]."</option>\r\n";
			}
return $str;
}
include("../../Modal/dbLayer.php");

?>
    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 class="muted" >Registration Count Report Form<small> (Insert your Requirement)</small></h3>
    </div>
    <div class="modal-body" >
    <form method="post"  id="RegistrationCountForm">
    <input type="hidden"value="RegistrationCountReport_Form" name="RegistrationCountReport_Form"> 

    <div class="input-prepend"><h4></h4></div>
     
   


    <div class="control-group">
    <label for="RB_OwnerShip" class="control-label">	
    Ownership:
    </label>
    <div class="controls">
    <select class="input-medium" id="RB_OwnerShip" name="B_OwnerShip">

                <option value="Franchise">
                  Franchise
                </option>

                <option value="Esoft">
                  Esoft
                </option>
                 <option selected="selected" value="">
                  All
                </option>
              </select>
    </div>
    </div>
    <div class="checkbox">
    <label>
   <!--   <input id="CheckAll"  type="checkbox" > Check/Uncheck All-->
    </label>
  </div>
      <div class="row-fluid">

      <div class="control-group">
    <label for="SM_ID_Type" class="control-label">	
    Branches :
    </label>
    <div class="controls" id="BranchList">
   
</div>
    </div>
        </div>  

   <br />
     <div class="row-fluid">
     
     <div class="span4">
       <label for="CC_Start_Date" class="control-label">Start Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 " id="CC_Start_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="CC_Start_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
     
     <div class="span4">
       <label for="CC_End_Date" class="control-label">End Date</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8" id="CC_End_Date" size="16" type="text"   placeholder="yyyy-mm-dd" name="CC_End_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
     
  </div>
     
         <div class="control-group">
    <label for="D_Code" class="control-label">	
    Division:
    </label>
    <div class="controls">
    <select class="input-medium" id="D_Code" name="D_Code">
<option value="" selected="selected">ALL</option>
<?php 
$sql="SELECT * FROM `division`";
$sth = $esoftConfig->prepare($sql);
$sth->execute();
$count=$sth->rowCount();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
echo SelectOptions($results,'D_Code','D_Code','NOT');


?>
              </select>
    </div>
    </div>

     <div class="control-group">
    <label for="C_Code" class="control-label">	
    Courses:
    </label>
    <div class="controls" id="CourseSelect">

              
    </div>
    </div>
    
    <div >
     <div class="control-group">
    <label for="IntakeSelect" class="control-label">	
    Intakes:
    </label>
    <div class="controls" id="IntakeSelect">

              
    </div>
    </div>
    
    <div >
<!-- Indicates a successful or positive action -->
<input type="button" id="RegistrationCountForm_Save" class="btn btn-medium btn-primary" value="Generate Report" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
</div>
 
  

</form>
</div>
