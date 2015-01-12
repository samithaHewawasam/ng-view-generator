<?php include('../../Modal/SysSettings.php'); ?>
    <div class="modal-header" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3>System Settings</h3>
    </div>
    <div class="modal-body" id="SysSettingBody" >
<div class="row-fluid">
<div class="span12">

                        <div class=" span8" id="SysSettingBody">
                            <form action="#" id="SysSettingsForm" method="post"
                            name="SysSettingsForm">
                                <input name="SysSaveCheck" type="hidden" value=
                                "SysSaveCheck">
                                 
<div class="row-fluid">
<div class="span6">
                                <div class="control-group">
                                    <label class="control-label" for=
                                    "SubOfficCode">Branch Name:</label>

                                    <div class="controls">
                                        <input class="required span10" needs="ere" id=
                                        "BranchName" name="BranchName"
                                         type="text" value=
                                        "<?php echo $BranchName ?>">
                                    </div>
                                </div>
</div>
<div class="span6">
                                <div class="control-group">
                                    <label class="control-label" for=
                                    "SubOfficCode">Full Branch Code:</label>

                                    <div class="controls">
                                        <input class="required span10" id=
                                        "BranchCode" placeholder="COL/A" name="BranchCode"
                                         type="text" value=
                                        "<?php echo $BranchCode ?>">
                                    </div>
                                </div>
</div>
</div>

                                <div class="control-group">
                                    <label class="control-label" for=
                                    "OfficeAddress">Office Address:</label>

                                    <div class="controls">
                                        <input class="span8 required" id=
                                        "OfficeAddress" name="OfficeAddress"
                                       type="text" value=
                                        "<?php echo $OfficeAddress ?>">
                                    </div>
                                </div>
 <div class="row-fluid">

<div class="span6">
                                <div class="control-group">
                                    <label class="control-label" for=
                                    "BranchCode">Office Telephone:</label>

                                    <div class="controls">
                                        <input class="span9 required" id=
                                        "OfficeTelephone" name=
                                        "OfficeTelephone" required="Int"
                                        type="text" value=
                                        "<?php echo $OfficeTelephone ?>">
                                    </div>
                                </div>
                                
</div>
<div class="span6">

                                <div class="control-group">
                                    <label class="control-label" for=
                                    "BranchCode">Office Fax:</label>

                                    <div class="controls">
                                        <input class="span9" id=
                                        "OfficeFax" name=
                                        "OfficeFax" 
                                        type="text" value=
                                        "<?php echo $OfficeFax ?>">
                                    </div>
                                </div>
</div>
</div>
 <div class="row-fluid">

<div class="span6">
                                <div class="control-group">
                                    <label class="control-label" for=
                                    "BranchCode">Office Web Site:</label>

                                    <div class="controls">
                                        <input class="required span10" id=
                                        "OfficeWebSite" name=
                                        "OfficeWebSite"
                                        type="text" value=
                                        "<?php echo $OfficeWebSite ?>">
                                    </div>
                                </div>
                                
</div>
<div class="span6">

                                <div class="control-group">
                                    <label class="control-label" for=
                                    "BranchCode">Office Email:</label>

                                    <div class="controls">
                                        <input class="required span10"  id=
                                        "OfficeEmail" name=
                                        "OfficeEmail" needs="email" 
                                        type="text" value=
                                        "<?php echo $OfficeEmail ?>">
                                    </div>
                                </div>
</div>
</div>
                                <div class="control-group">
                                    <label class="control-label" for=
                                    "StartedDate">Started Date:</label>

                                    <div class="controls">
                                        <div class="input-append date dp3"
                                        data-date-format="yyyy-mm-dd">
                                            <input class="required span8" id= "StartedDate" name="StartedDate" placeholder="yyyy-mm-dd" readonly  size="16" type="text" value= "<?php echo $StartedDate ?>">
                                            <span class="add-on icon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                  <div class="control-group">
                                    <label class="control-label" for=
                                    "BranchCode">Print Header:</label>

                                    <div class="controls">
                                    <select class="span3 required" id= "PrintHeader" name= "PrintHeader" required="required"><option value="">--Select--</option><option value="Yes">Yes</option><option value="No">No</option><option selected value="<?php echo $PrintHeader ?>"><?php echo $PrintHeader ?></option></select>
                                        
                                    </div>
                                </div>
                                     
    <div >
    <br />
<br />

<!-- Indicates a successful or positive action -->
<input type="button" id="SysSettingsSave" class="btn btn-medium btn-primary" value="Save Settings" />

<!-- Contextual button for informational alert messages -->
<button type="reset" class="btn btn-medium">Clear</button>
</div>
                            </form>
                           <br />
<br />

                        </div>
                        </div>
                        </div>
                      </div>
                    	
                    	
                                    
                   
	
					
