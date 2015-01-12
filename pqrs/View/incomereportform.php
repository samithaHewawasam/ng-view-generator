
    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 class="muted" >Income Report Form<small> (Insert your Requirement)</small></h3>
    </div>
    <div class="modal-body" >
    <form method="post" id="IncomeReportForm">
    <input type="hidden"value="IncomeReportSerchForm" name="IncomeReportSerchForm"> 

     <div class="control-group">
    <label for="B_OwnerShip" class="control-label">	
    Ownership:
    </label>
    <div class="controls">
    <select class="input-medium" id="B_OwnerShip" name="B_OwnerShip">

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
   <!--   <input id="INCheckAll"  type="checkbox" > Check/Uncheck All-->
    </label>
  </div>
   <div class="row-fluid">

      <div class="control-group">
    <label for="IR_BranchList" class="control-label">	
    Branches :
    </label>
    <div class="controls" id="IR_BranchList">
   
</div>
    </div>
        </div>

<br />
<div class="row-fluid">
     
     <div class="span4">
       <label for="RG_Start_Date" class="control-label">Start Date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8 " id="IR_Start_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="Start_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
     
     <div class="span4">
       <label for="IR_End_Date" class="control-label">End Date</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span8" id="IR_End_Date" size="16" type="text"   placeholder="yyyy-mm-dd" name="End_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
     </div>
     
  </div>
  
   <br />
  
    <div class="controls">
 <!-- Indicates a successful or positive action -->
<input type="button" id="IncomeReportForm_Save" class="btn btn-medium btn-primary" value="Generate Report" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
</div>
 
  

</form>
<br />
<br />
<br />
<br />
<br />
<br />
<br />

</div>
