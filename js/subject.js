$(document).ready(function () {
$(document).ajaxStart(function () {
        $("#loader").show();
    });

$(document).ready(function() {
  $.ajaxSetup({ cache: false });
});
    
//main varibles 

var dueDateValue = $("#RG_Date").val();
var regTypeValue = $('#CouserFinder option:selected').val();

//remove existing data start
function removeExistingDataFull(){
$('#RegType').prop('selectedIndex',0);
$("#nextCourse").hide(); 
$('#alreadyBatchSorting').prop('selectedIndex',0);
$("#subjectsTableFirstTr").nextAll().remove();
$("#selectedSubjectsSession").nextAll().remove(); 
$("#installmentsViewFirstTr").nextAll().remove();
$("#RG_Dis_Comment").val("");  
$("#RG_Reg_Fee").val(""); 
$("#FS_Price").val(""); 
$("#DP_Rate_Input").val(""); 
$("#DP_Type").val(""); 
$("#RG_discountRate_hidden").val(""); 
$("#RG_Total_Fee").val("");
$("#RG_FullPay_Dis_Amount_Select").prop('selectedIndex',0);
$("#RG_Total_Fee_Final").val(""); 
$("#RG_FullPay_Dis_Amount_hidden").val("");


}

//remove existing data end


function esoftAjax(url, data, response) {

    $.ajax({

        url: url,
        type: "GET",
        data: data,
        success: function (response) {

            return response;
        }
    });
}

//esoftAjax(url, data, response);



    $(document).ajaxStop(function () {
        $("#loader").hide();
    });


});
