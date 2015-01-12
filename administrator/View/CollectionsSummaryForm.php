<div class="modal-body" style="width:90%">

    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>Collection Summary</h3>
    </div>
    <div class="modal-body" >
    <form method="post"  id="CollectionsSummary">
    <input type="hidden"value="CollectionsSummary" name="CollectionsSummary"> 

    <div class="input-prepend"><h4></h4></div>
     


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