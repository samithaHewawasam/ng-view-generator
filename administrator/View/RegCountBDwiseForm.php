<div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Registration count Batch/Division wise</h3>
    </div>
    <div class="modal-body" >
    <form method="post"  id="RegCountBDwiseForm">
    <input type="hidden"value="RegCountBDwiseForm" name="RegCountBDwiseForm"> 

    <div class="input-prepend"><h4></h4></div>
     
   <div class="control-group">
    <div class="controls form-inline">
        <label>
<input type="checkbox" name="Block" value="ThisBlock" />This Block Onlly</label>
    </div>
  </div>  


    <div class="control-group">
    <div class="controls form-inline">
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2  " id="Start_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="Start_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>

    </div>
          <label for="BM_Commence_Date" class="control-label">:Start Date</label>

    </div>
  </div>
    
      <div class="control-group">
      <div class="controls form-inline">
        <div class="input-append date dp3" data-date-format="yyyy-mm-dd">
    <input class="span2  " id="End_Date" size="16" type="text" placeholder="yyyy-mm-dd" name="End_Date" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
      <label for="BM_Commence_Date" class="control-label">:End Date</label>

    </div>
      </div>
     
   <div class="control-group">
    <div class="controls form-inline">
        
<select name="ReporteType" >
<option value="Division">Division Wise</option>
<option value="Batch">Batch Wise</option>
<option value="Course">Course Wise</option>
<option value="RG_Reg_Type">Reg Type Wise</option>
</select>
    </div>
  </div>  
    <div >
<!-- Indicates a successful or positive action -->
<input type="submit" id="RegCountBDwiseFormSave" name="RegCountBDwiseFormSave" class="btn btn-medium btn-primary" value="Generate Report" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
</div>
 
  

</form>
</div>
</div>