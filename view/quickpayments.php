<!-- quick payments -->

   
    <div id="QuickInitialsPayments" class="modal hide fade" tabindex="-1" data-width="960">
    <div class="modal-header">
    <button type="button" class="close" onclick="reloadPage()" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Quick Payments</h3>
    </div>
    <div class="modal-body">
    <form id="QuickinitialsPaymentsData">


<div class="control-group">
    <label for="QuickRegNo" class="control-label">	
    Reg No:
    </label>
    <div class="controls"><input type="text" id="QuickregNoPayments" class="form-control" name="RG_Reg_N0" value="<?php echo $_SESSION['branchCode']."-"; ?>" >
    </div>
    </div>

 <div class="control-group" id="QuickbalanceDueDiv"><label class="control-label">Balance Due</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on">Rs</span>
    <input class="span2" id="QuickbalanceDuePayment" name="Balance_Due" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>
    
    
     <div class="control-group" id="quickuptoDateDueDiv"><label class="control-label">Upto date due</label>

    <div class="controls"><div class="input-prepend input-append">
    <span class="add-on">Rs</span>
    <input class="span2" id="QuickuptoDateDue" name="Upto_Date_New" type="text" readonly>
    <span class="add-on">/=</span>
    </div></div></div>


<input type="hidden" value="<?php echo $_SESSION['branchCode']; ?>" id="QuickRG_Branch_Code_nintial_payment" name="RG_Branch_Code"> 
<input type="hidden" value="" id="QuickselectedBatchForPrint" name="selectedBatchForPrint"> 
<input type="hidden" value="" id="QuickRG_Date_initial_payments" name="RG_Date" >
<input type="hidden" value="" id="QuickregisterUserForPrint" name="registerUserForPrint" >
<input type="hidden" id="QuickRG_Reg_N0_Payments" name="RG_Reg_N0"  value="">
   <div id="QuickprintPdf" class="modal hide fade" data-width="960">
<div class="modal-header">
<button class="close"  aria-hidden="true" data-dismiss="modal" type="button">×</button>
</div>
<input class="btn btn-large btn-block btn-primary" type="button" onClick="window.open('../Controller/print.php');" id="QuickprintPreviewofThisInvoice" value="" name="invoiceNumberForPrint">
</div>

   <div class="InvoiceNumber">
      <div class="control-group">
  <label for="SM_Date_of_Birth" class="control-label">Invoice Number:</label>
    <div class="controls">
      
       
    <input class="span3" id="QuickputInvoiceNumber" type="text" name="PM_Receipt_No" value="" readonly>
    </div>
    </div>
  </div>
      <div class="topDate" style="right: 245px !important;">
      <div class="control-group">
  <label for="PaymentDate" class="control-label">Payment date:</label>
    <!--controls--><div class="controls">
      
        <!--date--><div class="input-append date dp3" data-date-format="dd-mm-yyyy">
    <input class="span2" id="QuickPM_Date_After_Full" size="16" type="text" name="PM_Date" value="12-02-2013" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div><!--/date-->
    </div> <!--/controls-->
  </div>
     
</div>
<div id="quickPaymentsInstallmentControls"></div>


    <p class="lead">Select your payment plan</p>
     <div style="margin:0 0 30px 0">
<div id="tab" class="btn-group" data-toggle="buttons-radio">
<a href="#Quickcash" class="btn btn-info Quickcash" data-toggle="tab">Cash</a>
<a href="#QuickcreditCard" class="btn btn-info QuickcreditCard" data-toggle="tab">Credit Card & Debit Card</a>
<a href="#Quickcheque" class="btn btn-info Quickcheque" data-toggle="tab">Cheques</a>
 <input class="span6" name="PM_Type" id="QuickPM_Type" type="hidden">
</div>
 </div>
    <div class="row-fluid">
      <div class="well well-small" id="QuickpaymentArea">
    
    <div class="container">
        	
                    <div class="span6">
                    	<div class="area">
                    	
                    	
<div class="tab-content">
<div class="tab-pane hide" id="QuickcreditCard">


 <form class="form-horizontal span6">
    <fieldset>
   
    <div class="control-group"><label class="control-label">How much ?</label>

    <div class="input-prepend input-append">
    <span class="add-on">Rs</span>
    <input class="span6" id="QuickPM_Amount_credit" name="PM_Amount_credit" type="text">
    <span class="add-on">/=</span>
    </div></div>
   
    <div class="control-group">
    <label class="control-label">Card Holder Name</label>
    <div class="controls">
    <input type="text" class="input-block-level" name="PM_Card_Holder_Name" pattern="\w+ \w+.*" title="Fill your first and last name" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label">Card Number</label>
    <div class="controls">
    <div class="row-fluid">
    <div class="span3">
    <input type="text" id="Quickcredit-card"  class="input-block-level QuickoneNo" autocomplete="off" maxlength="4" pattern="\d{4}" title="First four digits" required>
    </div>
    <div class="span3">
    <input type="text" class="input-block-level QuicktwoNo" autocomplete="off" maxlength="4" pattern="\d{4}" title="Second four digits" required>
    </div>
    <div class="span3">
    <input type="text" class="input-block-level QuickthreeNo" autocomplete="off"  maxlength="4" pattern="\d{4}" title="Third four digits" required>
    </div>
    <div class="span3">
    <input type="text" class="input-block-level QuickfourNo" autocomplete="off"  maxlength="4" pattern="\d{4}" title="Fourth four digits" required>
<input type="hidden" id="QuickhiddenCreditCardNumer" name="PM_Card_NO" value="">
<input type="hidden" id="QuickhiddenCreditCardType" name="PM_Card_Type" value="">
    </div>
    </div>
    </div>
    </div>
    
    <!-- Card Images Output -->
<div class="control-group">
    <label class="control-label">Accepted Cards</label>
    <div class="controls">
        <div class="pull-left" id="Quickaccepted-cards-images">
            <!-- Icons Automatically Inserted Here -->
        </div>
    </div>
</div>
    </fieldset>
    </form>



</div>
<div class="tab-pane hide" id="Quickcash">
 <div class="control-group"><label class="control-label">How much ?</label>

    <div class="input-prepend input-append">
    <span class="add-on">Rs</span>
    <input class="span6" name="PM_Amount_Cash" id="QuickPM_Amount_Cash" type="text">
    <span class="add-on">/=</span>
    </div></div>


</div>
<div class="tab-pane hide" id="Quickcheque">

 <div class="control-group"><label class="control-label">How much ?</label>

    <div class="input-prepend input-append">
    <span class="add-on">Rs</span>
    <input class="span6" name="PM_Amount_Cheque" id="QuickPM_Amount_Cheque" type="text">
    <span class="add-on">/=</span>
    </div></div>

<div class="control-group">
    <label>Add your Cheque Number</label>
    <div class="controls">
 <div class="span5">
    <input type="text" name="PM_Cheque_NO" class="input-block-level" autocomplete="off" maxlength="6" pattern="\d{6}" title="six digits" required>
    </div>


</div>


<!-- Script to control the card input -->
<script type="text/javascript">

// Make sure that this code goes within a doc ready
$(document).ready(function() {
    
    // Step #1: Cache Selectors
    var creditCard = $("#Quickcredit-card"),
        cardGrandParent = creditCard.parent().parent();
    
    // Step #2: Setup Callbacks on Events
    creditCard.on("cc:onReset cc:onGuess", function() {

        cardGrandParent.removeClass().addClass("control-group");

    }).on("cc:onInvalid", function() {

        cardGrandParent.removeClass().addClass("control-group error");
        $("#Quickcredit-card-type-text").text("");

    }).on("cc:onValid", function(event, card, niceName) {

        cardGrandParent.removeClass().addClass("control-group success");

    }).on("cc:onCardChange", function(event, card, niceName) {

        $("#Quickcredit-card-type-text").text(niceName);
 $("#QuickhiddenCreditCardType").val(niceName);
    // Step #3: Initialize the cardcheck plugin
    }).cardcheck({ iconLocation: "#Quickaccepted-cards-images" });

});
</script>




</div><br><br>

<div class="control-group"><label class="control-label">Cheque issue banks name</label>

    <div class="input-prepend input-append">
     
    <input class="form-control" name="PM_Cheque_Bank" type="text">
   
    </div></div>


 <div class="control-group">
  <label for="Cheque" class="control-label">Cheque due date:</label>
    <div class="controls">
      
        <div class="input-append date dp3" data-date-format="dd-mm-yyyy">
    <input class="span7" size="16" name="PM_Cheque_Due_Date" type="text" value="" readonly><span class="add-on"><i class="icon-th"></i></span>
    </div>
    </div>
  </div>


</div>
                    	
                    	
                            
					<div class="modal-footer hide QuickpayNow">
    <button type="button" data-dismiss="modal" onclick="reloadPage()" class="btn">Close</button>
    <input type="submit" id="QuickinitialsPaymentsDataSubmit" class="btn btn-primary" value="Print Preview" />
    </div></form>	</div>                            
                    </div>
                </div>
            	
            </div>
        </div>

    </div>
    </div>
    </div>



    </form>
    </div>
<!--/quick payments-->
