$(document).ready(function () {


function doSync() {
			    //sync part
        $.ajax({

            url: "../Controller/post.php",
            dataType:'JSON',

			complete: function(res) {
                   
			setTimeout(doSync,1000); 
   			}
        });
}


 doSync();


//To active inactive start

$('#toInactiveActive').click(function (event) {

    $.ajax({

        url: "../Controller/active.php",
        type: 'GET',
        data: {
            'RG_Reg_NO': $('#regNoStatus').val(),
            'RG_Status': $('#regStatus').val()
        },

        dataType: 'JSON',

        success: function (res) {
     
      if(res.commitCode){

                $('#mainAlert').show(function(){
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
                $("#mainAlertInfo").text("Student status has been  saved successfully");

		});

		}else{

                $('#mainAlert').show(function(){
                $('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
                $("#mainAlertInfo").text("Student status  has been  saved unsuccessfully");

		});
              }

        }

    });

});

//end






        function getClosestNum(num, ar) {
            var i = 0,
                closest, closestDiff, currentDiff;
            if (ar.length) {
                closest = ar[0];
                for (i; i < ar.length; i++) {
                    closestDiff = Math.abs(num - closest);
                    currentDiff = Math.abs(num - ar[i]);
                    if (currentDiff < closestDiff) {
                        closest = ar[i];
                    }
                    closestDiff = null;
                    currentDiff = null;
                }
                //returns first element that is closest to number
                return closest;
            }
            //no length
            return false;
        }












//functions

// 1) currency set start

var getAccseptingCurrency = function(feeStructure){


if (feeStructure.indexOf('|') != -1) {

   $('.accsepttingCurrency').text(feeStructure.substr(0, feeStructure.indexOf('|')));

} else {

 $('.accsepttingCurrency').text('LKR');

}


};

$('.currencySet').load( "../view/currency.html",function(){

$(document).on('click', '.detect-currency', function (event) {

      $('.payingCurrency').text($(this).attr('data-currency')); 


      $.ajax({

          url: "http://esoftholdings.com/rates.json?jsonCallback?",
          type: "GET",
          jsonpCallback: 'jsonCallback',
          contentType: "application/json",
          dataType: 'JSONP',
          success: function (response) {

              var rateCurrency = $.trim($.trim($('.accsepttingCurrency').text().substr(0,3)) + $.trim($('.payingCurrency').text().substr(0,3)));




              $('#currencyJsonCallBack').val(response[rateCurrency]);

          }

      });


  });

});


$(document).on('keyup', '#AmountPaying', function (event) {

var getValue = $(this).val() / $('#currencyJsonCallBack').val(); 

$('#AmountAccspting').val(getValue.toFixed(2));


});

$(document).on('click', '#currencyConvercationUpdate', function (event) {


$($('#tab .active').attr('href')).find('.getPayment').val($('#AmountAccspting').val());

$('#currencyModal').modal('hide');

$("#AmountPaying").val(' ');
$("#AmountAccspting").val(' ');

});



// currency set end

  


//functions end









//Full Registration form start...........
  $(document).on('click', '#StudentMasterSubmit', function (event) {
   event.preventDefault();

     var data = $("#student_master").serialize();

     $.ajax({

         url: "../Controller/fullRegistration.php",
         type: "GET",
         data: data,
	 async: false,   
         dataType: 'json',
         success: function (response) {

		if(response.commitCode){
                $("#searchNowForm").hide();
                $(".alert-success").hide();
                $("#QuickReg").modal('hide');
                $('#mainAlert').show(function(){
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
                $("#mainAlertInfo").text("Student info has been  saved successfully");
                $(".getLastRegId").click();
		});

		}else{

                $('#mainAlert').show(function(){
                $('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
                $("#mainAlertInfo").text("Student  info  has been  saved unsuccessfully.Maybe this user already been registered");

		});
              }
            }


     });
            return false; 

 });
 //Full registration form end...........


//sync manuval 

$(document).ready(function(){

$('#syncMenuClick').click(function(){

        $.ajax({

            url: "../Controller/post.php",

	    success: function(res) {
	    $('.syncResponse').html(res);
            }
        });


});


});

//sync manual

//sync start 

function doSync() {
			    //sync part
        $.ajax({

            url: "../Controller/post.php",
            dataType:'JSON',

			complete: function(res) {
                   
			setTimeout(doSync,4000); 
   			}
        });
}


//sync end

//doSync();

$.fn.myValid = function() { 
  var check = new Array();
   $(this).find('.required').each(function(index) {
    if ($(this).val() === '') {
                        $(this).css("backgroundColor", "#FDD0D0");
                        check[index] = 'no';
                    } else {
                        check[index] = 'ok';
                        $(this).css("backgroundColor", "#FFFFFF");
                    }
					
	 

                });
				
	  if (check.indexOf('no') > -1) {
                    return false;
                }
				else
				{
				return true;
				}

}

$(document).off('click','.closeAlert');
$(document).on('click','.closeAlert',function(){

$("#mainAlert").fadeOut();

});
	
$('#SM_ID_KEEP').popover({ trigger: 'manual' }).focus(function(e){ 
$("#CheckUserFormSubmit").popover('show');
e.preventDefault(); 
});

$('#SM_ID_KEEP').keyup(function(){
$("#CheckUserFormSubmit").popover('hide');
});



function notification(){
$.ajax({

        url: "../Modal/history.php",
        async: false,   
	success: function(notification) {

         var CountSize = notification.filter(function(value) {
             return value !== undefined;
         }).length;

 $('.notification-counter').text(CountSize);


  for(norty of notification){

      $('#notificationList').prepend("<li class='divider'></li><li class='comment more' data-notification="+norty.id+">"+norty.Logs+"</li>");
      }

//read more start


	var ellipsestext = "";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();
		var n=content.indexOf("@");
		if(content.length > content.substr(0, n).length) {

			var c = content.substr(0, content.substr(0, n).length);
			var h = ' @ ' + content.substr(content.indexOf("@") + 1);

			var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span style="font-size:12px;color:#999999;">' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink"> '+moretext+'</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		

   $.ajax({

        url: "../Controller/updateHistorySeen.php",
        type: "GET",
        async: false,   
        data: "id=" + $(this).closest('li').attr('data-notification'),
        success: function (response) {
	
	}

});
return false;
});

//readmore end

   }
});

}
notification();
			
							
       $(document).ajaxStart(function () {
    $("#loader").hide();




});

//updateingSystemFiles start

$(document).off("click", "#updateingSystemFilesCheck");	
$(document).on("click", "#updateingSystemFilesCheck", function() {

$.ajax({

        url: "update.php",
	beforeSend:function(){

	$('#updateingSystemFiles').html("<div class='progress progress-striped active'><div class='bar' style='width: 40%;'></div></div>");
	},
        async: false,
	success: function(res) {
       if(res){
	$('#updateingSystemFiles').html(res);
		
	}
   	}
        });

 });

//updateingSystemFiles end

//history log view

$(document).off("click", "#historyView");	
$(document).on("click", "#historyView", function() {

$.ajax({

        url: "../Controller/historyLogView.php",
        type:'GET',
        data:$('#HistoryLogForm').serialize(),
	success: function(res) {
       if(res){
	$('#HistoryLogViewModal').html(res).modal('show');
		
	}
   	}
        });

 });

$(document).off("click", "#freeSearchButton");	
$(document).on("click", "#freeSearchButton", function() {

$.ajax({

        url: "../Controller/historyLogSearch.php",
        type:'GET',
        data:$('#freeSearch').serialize(),
	success: function(res) {
       if(res){
	$('#HistoryLogViewModal').html(res).modal('show');
		
	}
   	}
        });

 });

        $(document).ready(function () {
            $.ajaxSetup({
                cache: false
            });
        });


        $('.dp3').datepicker("setDate", new Date());


//global varibles 


var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
var excessAmount;
var goExcessReg = true;
var selectedBatchcDate;
var selectedBatcheDate;
var selectedBatchInsDays;
var regFinalAmount='';
var regTotalPaidAmount='';
var getFetchBatch='';

function beforeRegCheck(){


var totalInsAmount=0;
$("#registerUserSubmit").click(function () {
    var totalArray = [];
    for (var i = 1; i <= insEndCount; i++) {
        var totalCount = $("." + i + INS).text();
        totalArray.push(totalCount);


    }


    for (var ii = 0; ii <= totalArray.length; i++) {

        totalInsAmount += roleBackArray[ii] << 0;
    }
alert(totalInsAmount);
});

var totalPaybleAmount;
var totalDis = $("#DP_Rate_Input").val();
var netFeeFinal = $("#RG_Total_Fee").val();

if ($('.fullPayYes').is(':checked')) {

    totalPaybleAmount = $("#RG_Total_Fee_Final").val();

} else {

    totalPaybleAmount = parseInt(netFeeFinal, 10) - parseInt(totalDis, 10);
}



}



var regTypeValue = $('#RegType option:selected').val();
var dueDate = $("#RG_Date").val();
var dd = dueDate.substr(0, 2);
var mm = dueDate.substr(3, 2);
var yy = dueDate.substr(6, 4);
var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');





    //ins check start
function incheckFunction(){


//paid column update 

var paidAmount = $('#RG_Total_Paid').val();

$('#installmentsView .info').each(function (index) {

    var amount = parseFloat($(this).closest("tr").find("td:nth-child(2)").text());

    //if money left
     if (amount < paidAmount) {
        paying = amount;
        paidAmount -= amount;
    //there no money left
    } else {
        paying = paidAmount;
        paidAmount -= paying;
    }

$(this).closest("tr").find("td:nth-child(4)").text(paying);   
});

//end

var insAmountTotal = [];
var insCountEdit = $("#installmentsView tr:last").find("td:first-child").text();

for (var i = 1; i <= insCountEdit; i++) {
	var insAmountOneByOne = $("#installmentsView ." + i + "INS").text();
	insAmountTotal.push(insAmountOneByOne);

}


var insEditBacktotal = 0;
for (i = 0; i < insAmountTotal.length; i++) {
	insEditBacktotal += insAmountTotal[i] << 0;

}
regFinalAmount = parseFloat($("#RG_Total_Fee").val());
var excessIns = insEditBacktotal - parseFloat(regFinalAmount);


if (insEditBacktotal != regFinalAmount) {

	$("#insEditErrorDiv").show(function() {
		$("#insEditErrorDiv").removeClass('alert-info').addClass('alert-error');
		$("#insEditErrorDiv").html(" Ooops!.Unmached installment amounts.It should be around over Rs:" + excessIns.toFixed(2));
                   $("#mainAlert").removeClass('alert-success');
                   $("#mainAlert").addClass('alert-error');
                $('#mainAlertInfoSelected').html(" Ooops!.Unmached installment amounts.It should be around over Rs:" + excessIns.toFixed(2));
            $("#editRegFullNow").hide();
	});

} else {

	$("#insEditErrorDiv").show(function() {
                   $("#mainAlert").removeClass('alert-error');
                   $("#mainAlert").addClass('alert-success');
                   $('#mainAlertInfoSelected').html(" It seems everything is ok ");
		$("#insEditErrorDiv").removeClass('alert-error').addClass('alert-info');
		$("#insEditErrorDiv").html("Hooray.Installment amounts has been matched");
               $("#editRegFullNow").show();
	});
}

}


//ins check end

function installmentEditing() {

    $(document).off('click');
    $(document).on('click',".editIns",function () {

regFinalAmount = parseFloat($("#RG_Total_Fee").val());

$("#regEditInsEditModal").modal('show');

var selectedInsNumber = $(this).closest("tr").find("td:first-child").text();
var selectedInsAmount = $(this).closest("tr").find("td:nth-child(2)").text();
var selectedInsDueDate = $(this).closest("tr").find("td:nth-child(3)").text();

$(".InsNoEditClass").val(selectedInsNumber);
$(".InsAmountEditClass").val(selectedInsAmount);
$(".InsDueDateEditClass").val(selectedInsDueDate);

     incheckFunction();
    });


//installment edit data update start
var editedInsNumber, editedInsAmount, editedInsDueDate;

$("#insEditDataUpdate").on('click', function () {

    editedInsNumber = $(".InsNoEditClass").val();
    editedInsAmount = $(".InsAmountEditClass").val();
    editedInsDueDate = $(".InsDueDateEditClass").val();

    //set values
    $("." + editedInsNumber + "INSNO").closest("tr").find("td:first-child").text(editedInsNumber);
    $("." + editedInsNumber + "INSNO").closest("tr").find("td:nth-child(2)").text(parseFloat(editedInsAmount).toFixed(2));
    $("." + editedInsNumber + "INSNO").closest("tr").find("td:nth-child(3)").text(editedInsDueDate);

 incheckFunction();
});

//installment edit data update end

//add new installment start 
$("#insEditRawAdd").off('click');
$("#insEditRawAdd").on('click', function () {
 
    //get ins count
    var insCountEditNew = [];
    $("#installmentsView tr td:first-child").each(function (index) {

        insCountEditNew.push($(this).text());

    });

    var newInsNumber = Math.max.apply(Math, insCountEditNew) + 1;

    $(".InsNoEditClass").val(newInsNumber);

    var addNewInsAmount = $(".InsAmountEditClass").val();
    var addNewInsDueDate = $(".InsDueDateEditClass").val();

    $("#installmentsView:last-child").append("<tr class='info'><td class=" + newInsNumber + "INSNO>" + newInsNumber + "</td><td class=" + newInsNumber + "INS>" + addNewInsAmount + "</td><td class=" + newInsNumber + "DUE>" + addNewInsDueDate + "</td><td class=" + newInsNumber + "PAID></td><td><button type='button'  class='btn btn-small btn-danger deleteIns'>Delete</button></td><td><button type='button'  class='btn btn-small btn-info editIns'>Edit</button></td></tr>");


 

incheckFunction();

 


});




//add new installment end

  }// installmentEditing(regFinalAmount) function call end

////////////////////ins edit end/////////////////


//delete ins recode start

        function deleteIns() {

            $(document).off('click',".deleteIns");
            $(document).on('click',".deleteIns", function () {

                var deleteConfirm = confirm("Are you really want to delete this installment?");

                if (deleteConfirm === false) {

                    return;

                }
 
                $(this).closest("tr").remove();

                $("#installmentsView tr td:first-child").each(function (index) {

                    $(this).html(parseInt(index, 10) + 1);

                });
           incheckFunction();




            });

        }


        //delete ins recode end


$("#SM_Tell_Mobileq,#SM_Tell_Mobile,#SM_Tell_Work,#SM_Tel_Residance,#SM_Parent_Phone").keydown(function(event) {

if(  $(this).val().length == 3 )
       {
            event.target.value = event.target.value + "-";
       }


});


        function getClosestNum(num, ar) {
            var i = 0,
                closest, closestDiff, currentDiff;
            if (ar.length) {
                closest = ar[0];
                for (i; i < ar.length; i++) {
                    closestDiff = Math.abs(num - closest);
                    currentDiff = Math.abs(num - ar[i]);
                    if (currentDiff < closestDiff) {
                        closest = ar[i];
                    }
                    closestDiff = null;
                    currentDiff = null;
                }
                
                return closest;
            }
            
            return false;
        }

var moveDateForSchedules = function(i,date,schedules){

    var newDueDate = new Date(date);
if(schedules == ''){

    var dd = newDueDate.getDate();
    var mm = newDueDate.getMonth() + 1;
    var yy = newDueDate.getFullYear();

             if (mm < 10) {
                 mm = '0' + mm;
             }
             if (dd < 10) {
                 dd = '0' + dd;
             }

          return $('td.' + i + 'DUE').text(yy+'-'+mm+'-'+dd);

}else{


     var name = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
     var schedulesArray = schedules.split(',');
     var schedulesIntArray = [];
     var s = [];
     var finalDate = null;

     for (var a = 0; a < schedulesArray.length; a++) {

      var getDiff = null;

      var getNextDueDateForSchedules = new Date(date);
      var weekday = getNextDueDateForSchedules.getDay();

     if (weekday > name.indexOf(schedulesArray[a])) {

         getDiff = ( 7 + name.indexOf(schedulesArray[a])) - weekday;

         var setDueDate = getNextDueDateForSchedules.setDate(getNextDueDateForSchedules.getDate() + getDiff);
         var getSchedulesTimeObject = new Date(setDueDate);        
	 var getschedulesTime = getSchedulesTimeObject.getTime();
         schedulesIntArray.push(getschedulesTime);
         s.push(getSchedulesTimeObject);

     } else {

        var getNextDueDateForSchedules = new Date(date);
        var weekday = getNextDueDateForSchedules.getDay();

        getDiff =  name.indexOf(schedulesArray[a]) - weekday;

         var setDueDate = getNextDueDateForSchedules.setDate(getNextDueDateForSchedules.getDate() + getDiff);
         var getSchedulesTimeObject = new Date(setDueDate);
	 var getschedulesTime = getSchedulesTimeObject.getTime();
         schedulesIntArray.push(getschedulesTime);
         s.push(getSchedulesTimeObject);

     }



}

   var getDueDateTimes = newDueDate.getTime();
   finalDate = getClosestNum(getDueDateTimes, schedulesIntArray);
    var getFinalDate = new Date(finalDate);
    var dd = getFinalDate.getDate();
    var mm = getFinalDate.getMonth() + 1;
    var yy = getFinalDate.getFullYear();

             if (mm < 10) {
                 mm = '0' + mm;
             }
             if (dd < 10) {
                 dd = '0' + dd;
             }
            
         return $('td.' + i + 'DUE').text(yy+'-'+mm+'-'+dd);


}

};


var insEndCount;

//due date and installment roalback function start 

function dueDateAndInsRoalBack() {
    //From course Type
    var insMethod = $('#CouserFinder option:selected').attr('data-ins-method');
    var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');
    var schedules = $("#alreadyBatchSorting option:selected").attr('data-schedules');

    var insDaysSet = 0;
    //From Batch
    var cDate = $('#alreadyBatchSorting option:selected').attr('data-Commence-Date');
    var commenceDate = new Date(parseInt(cDate, 10));
    var cyy = commenceDate.getFullYear();
    var cmm = commenceDate.getMonth();
    var cdd = commenceDate.getDate();

    var eDate = $('#alreadyBatchSorting option:selected').attr('data-End-Date');

    var endDate = new Date(parseInt(eDate, 10));
    var eyy = endDate.getFullYear();
    var emm = endDate.getMonth();
    var edd = endDate.getDate();

    //from date layout
    var dDate = $("#RG_Date").val();
    var dueDate = new Date(dDate);
    var dd = dueDate.getDate();
    var mm = dueDate.getMonth() + 1;
    var yy = dueDate.getFullYear();


    function daysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }

    //date calculation


    if (insMethod == "Mon") {

        var commencingObjects = new Date(cDate);
        var getendDate = new Date(eDate).getTime();

        for (var i = 1; i <= insCount; i++) {
            if (dueDate.getTime() >= commencingObjects.getTime()) {

                if (i == 1) {

                    if (mm < 10) {
                        mm = '0' + mm;
                    }
                    if (dd < 10) {
                        dd = '0' + dd;
                    }

                    $('td.' + i + 'DUE').text(yy + '-' + mm + '-' + dd);

                } else {


                    var setDueDate = dueDate.setDate(25);

                    var getNextDueDate = new Date(setDueDate);
                    var ddddd = getNextDueDate.getDate();
                    var getNextMonth = getNextDueDate.setMonth(getNextDueDate.getMonth() + (i - 1));
                    var getNextMonthObj = new Date(getNextMonth);
                    var mmmmm = getNextMonthObj.getMonth() + 1;
                    var yyyyy = getNextMonthObj.getFullYear();

                    if (mmmmm < 10) {
                        mmmmm = '0' + mmmmm;
                    }
                    if (ddddd < 10) {
                        ddddd = '0' + ddddd;
                    }


                    $('td.' + i + 'DUE').text(yyyyy + '-' + mmmmm + '-' + ddddd);




                }
            } else {

                if (i == 1) {

                    if (mm < 10) {
                        mm = '0' + mm;
                    }
                    if (dd < 10) {
                        dd = '0' + dd;
                    }


                    $('td.' + i + 'DUE').text(yy + '-' + mm + '-' + dd);
                } else {

                    //dueDate Calculations start

                    var commenceDateobj = new Date(cDate);
                    var setDueDate = commenceDateobj.setDate(25);
                    var getNextDueDate = new Date(setDueDate);
                    var dddd = getNextDueDate.getDate();

                    if (commenceDateobj.getDate() >= 25) {

                        var getNextMonth = getNextDueDate.setMonth(getNextDueDate.getMonth() + (i - 1));

                    } else {

                        var getNextMonth = getNextDueDate.setMonth(getNextDueDate.getMonth() + (i - 2));

                    }

                    var getNextMonthObj = new Date(getNextMonth);
                    var mmmm = getNextMonthObj.getMonth() + 1;
                    var yyyy = getNextMonthObj.getFullYear();

                    //dueDate Calculation end

                    if (mmmm < 10) {
                        mmmm = '0' + mmmm;
                    }
                    if (dddd < 10) {
                        dddd = '0' + dddd;
                    }

                    $('td.' + i + 'DUE').text(yyyy + '-' + mmmm + '-' + dddd);
                }
            }
        }



    } else {



        var arrayCe = [];
        var arrayIe = [];
        var arrayeD = [];
        var arrayeB = [];

        $(".selectedBatch").each(function (index) {
            var cDate = $(this).attr('data-Commence-Date');
            insDaysSet = $(this).attr('data-ins-days');
            var eDate = $(this).attr('data-end-date');
            var getBatch = $(this).text();

            var commenceDate = new Date(cDate).getTime();
            var endDate = new Date(eDate).getTime();

            arrayCe[index] = commenceDate;
            arrayIe[index] = insDaysSet;
            arrayeD[index] = endDate;
            arrayeB[index] = getBatch;


        });


        cDateMin = Math.min.apply(Math, arrayCe);
        var cI = arrayCe.indexOf(cDateMin);
        var getinsDays = arrayIe[cI];
        var getendDate = arrayeD[cI];
        getFetchBatch = arrayeB[cI];

        if (dueDate.getTime() >= cDateMin) {

            for (var i = 1; i <= insCount; i++) {

                if (mm < 10) {
                    mm = '0' + mm;
                }
                if (dd < 10) {
                    dd = '0' + dd;
                }

                if (i == 1) {

                    $('td.' + i + 'DUE').text(yy + '-' + mm + '-' + dd);

                } else {

                    dueDate = new Date(dueDate);
                    dueDate.setDate(dueDate.getDate() + parseInt(insDaysSet, 10));

                    moveDateForSchedules(i, dueDate, schedules);

                }

            }


        } else {

            var bigCDate = new Date(cDateMin);
            var bCyy = bigCDate.getFullYear();
            var bCmm = bigCDate.getMonth() + 1;
            var bCdd = bigCDate.getDate();



            for (var i = 1; i <= insCount; i++) {

                if (i == 1) {

                    if (mm < 10) {
                        mm = '0' + mm;
                    }
                    if (dd < 10) {
                        dd = '0' + dd;
                    }

                    $('td.' + i + 'DUE').text(yy + '-' + mm + '-' + dd);


                } else {



                    cDateMin = new Date(cDateMin);
                    cDateMin.setDate(cDateMin.getDate() + parseInt(insDaysSet, 10));



                    moveDateForSchedules(i, cDateMin, schedules);


                }



            }




        }

    }
    var arrayDueDate = [];
    $("#installmentsView td:nth-child(3)").each(function (index) {

        var dueDate = $(this).text();
        console.log(dueDate);
        var putDueDate = new Date(dueDate).getTime();
        arrayDueDate[index] = putDueDate;
    });


    console.log(arrayDueDate);

    var value = getClosestNum(getendDate, arrayDueDate);

    console.log(getendDate);

    insEndCount = arrayDueDate.indexOf(value) + 1;
console.log(value);
console.log(insEndCount);
    var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');
    var INS = "INS";
    var roalBackSize = insCount - insEndCount;

    var roleBackArray = [];
    for (var i = insEndCount + 1; i <= insCount; i++) {
        var insRoleback = $("." + i + INS).text();
        roleBackArray.push(insRoleback);


    }

    var roleBacktotal = 0;
    for (var i = 0; i < roleBackArray.length; i++) {
        roleBacktotal += roleBackArray[i] << 0;
    }



    var getInsAlready = $("." + insEndCount + INS).text();

    $("." + insEndCount + INS).text((parseFloat(getInsAlready) + parseFloat(roleBacktotal)).toFixed(2));


    $("#installmentsView td:nth-child(1)").each(function (index) {
        var ins = $(this).text();
        if (ins > insEndCount) {

            $(this).closest("tr").remove();

        }
    });

}
//due date and installment roalback function end




function checkIdNumber(IdNumber){

$.ajax({

        url: "../Controller/CheckUserController.php",
        type: "GET",
        data: "SM_ID=" + IdNumber,
        success: function (response) {
            if (typeof response.SM_Title != 'undefined') {
				
		$("#mainAlert").show(function(){

$("#mainAlertInfo").text(response.SM_Title + " " + response.SM_Initials + " " + response.SM_First_Name + " " + response.SM_Last_Name);
$("#RG_Stu_ID").val(IdNumber);
});
                

            } else {

                $("#mainAlertInfo").val("Name not provide");


            }
        }



    });





}


//talling amount when enter by type start 



//talling amount when enter by type end

//////////////////////////////////end function based  codes



//batchMasterSave start






 //Quick Registration form start...........
    $("#quickRegistrationformSubmit").click(function (event) {


  $('#quickRegistrationform').validate({ // initialize the plugin
        rules: {
            SM_ID: {
                required: true,
                maxlength: 10
            },
            SM_First_Name: {
                required: true,
                maxlength: 20
            },
             SM_Last_Name: {
                required: true,
                maxlength: 30
            },
            SM_Tell_Mobile: {
                required: true,
                maxlength: 11
            }
        },
        submitHandler: function (form) { 

  var data = $("#quickRegistrationform").serialize();

        $.ajax({

            url: "../Controller/quickRegistration.php",
            type: "GET",
            async: false,
            data: data,
	    dataType: 'json',
            success: function (response) {

		if(response.commitCode){
                $("#searchNowForm").hide();
                $(".alert-success").hide();
                $("#QuickReg").modal('hide');
                $('#mainAlert').show(function(){
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
                $("#mainAlertInfo").text("Student info has been  saved successfully");
                $(".getLastRegId").click();
		});

		}else{

                $('#mainAlert').show(function(){
                $('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
                $("#mainAlertInfo").text(response.errorInfo);



		});
                  }
            }



        });
            
            return false; 
        }
    });

    });

 //Quick registration form end...........



//CheckUser form start...........
 $("#CheckUserFormSubmit").click(function (event) {

if($("#SM_ID_KEEP").val() == ""){

alert("Why you are trying to search empty things ? may i exit ?");
return true;
}
 
     event.preventDefault();
     var dataId = $("#CheckUserForm").serialize();
     var thisBranch = $('#RG_Branch_Code_Session').val();

     $.ajax({

         url: "../Controller/CheckUserController.php",
         type: "GET",
         data: dataId,
         beforeSend: function(){
         $("#mainAlert").show();

         $("#mainAlertInfo").html("Wait,We are searching you.....");

         },
         success: function (response) {
					 
		if (typeof response.SM_Title != 'undefined') {

                 $(".alert-error").show();
                 
//first name or lastname doesn't with sever data

if(response.SM_First_Name.length == 0 || response.SM_Last_Name.length == 0){

                 $("#errorDiv").html("<span id='nameForLater'>"+response.SM_Title + " " + response.SM_Full_Name + "</span>" + " has been registered @" + response.SM_Branch_Code + " via " + response.SM_Operator);

                 $("#RG_Reg_NO").val(response.SM_Branch_Code || thisBranch + "-");
                 $("#RG_Stu_ID").val($("#SM_ID_KEEP").val());
					
                 $(".alert-success").hide();

}else{

                 $("#errorDiv").html("<span id='nameForLater'>"+response.SM_Title + response.SM_Initials + " " + response.SM_First_Name + " " + response.SM_Last_Name + "</span>" + " has already been registered @" + response.SM_Branch_Code + " via " + response.SM_Operator);

                 $("#RG_Reg_NO").val(response.SM_Branch_Code || thisBranch + "-");
                 $("#RG_Stu_ID").val($("#SM_ID_KEEP").val());
					$("#mainAlert").hide();
                 $(".alert-success").hide();


}


             } else {

                 $(".gotIdFromSearch").val($("#SM_ID_KEEP").val());

			var thisInputNumber = $('#SM_ID_KEEP').val();
                 $(".alert-success").show(function () {
				$('#mainAlertInfo').text("Please register the user "+ thisInputNumber);

                     $(".alert-error").hide();
		     
                 });


             }
					
			 

         }



     });

 });
 //CheckUser registration form end...........

//find dublicate entry for the registeration number start


$(document).off('keyup', '#RG_Reg_NO');
$(document).on('keyup', '#RG_Reg_NO', function (event) {

 	 $.ajax({

                url: "../Controller/regNumberFinder.php",
                type: "GET",
                data: "RG_Reg_NO=" + $(this).val(),
                async: false,
                success: function (response) {

		$('#mainAlert').show(function(){
		
		if(response == ' .Duplicate Registration No found in existing data'){
		$('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
		$('#mainAlertInfoSelected').html(response);
                $('#CouserFinder').prop('disabled', 'disabled');
		}else{
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
		 $('#mainAlertInfoSelected').html(response);
                $('#CouserFinder').prop('disabled', false);
		}
		
                

		});

		}

});

});

//find dublicate entry for the registeration number end

//registration type finder 
$(document).off('change', '#CouserFinder');
$(document).on('change', '#CouserFinder', function (event) {
removeExistingDataFull();

 $(".fullPayNo").prop('checked', true);
 $(".fullPayYes").prop('checked', false);

$("#Installments").show();
$("#fullPayInput").hide();

    var getIdNumber = $('#RG_Stu_ID').val().length;
	
	if(getIdNumber == 0) {
		
		alert("Please enter an ID Number");
		$('#CouserFinder').prop('selectedIndex',0);
         return;
		 
	}

        var data = $('#CouserFinder option:selected').val();

$('#mainAlertInfoSelected').text(" You just selected " + data + " course ");

        $.ajax({

                url: "../Controller/RegTypeSort.php",
                type: "GET",
                data: "CT_Course_Code=" + data,
                async: false,
                success: function (response) {
                    $("#RegTypeSelectList").html(response);



  ///registration type select
  $(document).off('change', '#RegType');
  $(document).on('change', '#RegType', function(event) {
      $("#subjectsTableFirstTr").nextAll().remove();
      var data = $('#RegType option:selected').val();
removeExistingDataFull();
//fee structure form start 

$('#mainAlertInfoSelected').text(" You just selected " + data + " registration type ");

 $.ajax({

     url: "../Controller/feeStructure.php",
     type: "GET",
     data: "FS_Reg_Type=" + data,
     success: function(response) {


         $("#RG_Fee_Structure").html(response);

     },
     complete: function() {
         //Installment plan  form start...........
         $(document).off('change', '#fsCourseSet');
         $(document).on('change', '#fsCourseSet', function(event) {



var getSubjectTr = $("#selectesSubjectsRecodes tr").length - 1 ;

if(getSubjectTr == 0 ){
	alert("You haven't Selected Subjects");
	$('#fsCourseSet').prop('selectedIndex',0);
	return;
}

var getFsCourseSelected = $("#fsCourseSet option:selected").val() ;

getAccseptingCurrency(getFsCourseSelected);

if(getFsCourseSelected == 0 ){
	alert("Select Your Fee Structure");
	return;
}
             //discount plan  form start...........
              		$("#installmentsViewFirstTr").nextAll().remove();
			$("#DP_Rate_Input").val(""); 
			$("#RG_Total_Fee").val("");
			$("#RG_Dis_Comment").val(""); 
			$("#RG_Total_Fee_Final").val("");  

                        var data = $('#fsCourseSet option:selected').val();

$('#mainAlertInfoSelected').text(" You just selected " + data + " course ");

 //registration fee start
 $.ajax({

     url: "../Controller/regFeeAndgrossFee.php",
     type: "GET",
     data: "FS_Code=" + data,
     success: function(response) {


         $("#RG_Reg_Fee").val(response.regFee);
         //Gross fee start
         $("#FS_Price").val(response.grossFee);
         //Gross  fee end
         //net fee
         $("#RG_Total_Fee").val(response.netFee);

         var INSNO = "INSNO";
         var INS = "INS";
         var DUE = 'DUE';
	 
         var size = response.installment.filter(function(value) {
             return value !== undefined;
         }).length;
         for (var i = 0; i < size; i++) {
             $("#installmentsView tr:last").after("<tr class='info dueDateTr' data-index=" + (i + 1) + "><td class=" + (i + 1) + INSNO + ">" + response.installment[i].FI_Ins_NO + "</td><td class=" + (i + 1) + INS + ">" + response.installment[i].FI_Ins_Amount + "</td><td class="+ (i + 1) + DUE + "></td></tr>");

         }



//registration fee zero start

   $(document).off('change', '#RG_Reg_Fee_zero');
    $(document).on('change', '#RG_Reg_Fee_zero', function(event) {

var r=confirm("Are you sure ?!");
if (r==true)
  {

 $("#RG_Reg_Fee").val("0.00");
 $("#RG_Total_Fee").val((response.netFee - response.regFee).toFixed(2));

 $(".1INS").text(parseFloat(($(".1INS").text() - response.regFee)).toFixed(2));
  
  }
else
  {
 
  }

});

//registration fee zero end

         var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

         //installmentDueDateCalculation(dd, insCount, mm, yy);

 dueDateAndInsRoalBack();


     }



 });

 //registration fee end

var DT_Reg_Type = $("#RegType option:selected").val();
             $.ajax({

                 url: "../Controller/discountplan.php",
                 type: "GET",
                 data: "DT_Reg_Type=" + DT_Reg_Type,
                 success: function(response) {
                     $("#discountPlanSet").html(response);

                     $(document).off('change', '#discountPlan');
                     $(document).on('change', '#discountPlan', function(event) {

                         $("#installmentsViewFirstTr").nextAll().remove();

                         $("#DP_Rate_Input").val("");
                         $("#RG_Total_Fee").val("");
                         $("#RG_Dis_Comment").val("");
                         $("#RG_Total_Fee_Final").val("");
                         var data = $('#fsCourseSet option:selected').val();
			
                         //registration fee start
                         $.ajax({

                             url: "../Controller/regFeeAndgrossFee.php",
                             type: "GET",
                             data: "FS_Code=" + data,
                             success: function(response) {

                                 $("#RG_Reg_Fee").val(response.regFee);
                                 //Gross fee start
                                 $("#FS_Price").val(response.grossFee);
                                 //Gross  fee end
                                 //net fee
                                 $("#RG_Total_Fee").val(response.netFee);

                                 var INSNO = "INSNO";
                                 var INS = "INS";
                                 var DUE = "DUE";
                                 var size = response.installment.filter(function(value) {
                                     return value !== undefined;
                                 }).length;
                                 for (var i = 0; i < size; i++) {
                                     $("#installmentsView tr:last").after("<tr class='info' data-index=" + (i + 1) + "><td class=" + (i + 1) + INSNO + ">" + response.installment[i].FI_Ins_NO + "</td><td class=" + (i + 1) + INS + ">" + response.installment[i].FI_Ins_Amount + "</td><td class=" + (i + 1) + DUE + "></td></tr>");

                                 }




                                 var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

                                 dueDateAndInsRoalBack();



//discount form start...........
                    var data = $('#discountPlan option:selected').val();
$("#mainAlertInfoSelected").html(" You just selected " +data+	" discount Plan.We just updated installments");
if(data != "special"){
                    $.ajax({

                        url: "../Controller/discount.php",
                        type: "GET",
                        data: "DP_Code=" + data,
                        success: function (response) {

                            var regFee = parseInt($("#RG_Reg_Fee").val());
                            var grossFee = parseInt($("#FS_Price").val());

                           if(!response){
                             alert("There are no discount changes for given plan");

                           }else{
				
			  if (response.DP_Type == "Percentage") {
                                var discountRate =  response.DP_Rate / 100;
                                var dicountForGrossFee = grossFee * discountRate;
                               $("#RG_discountRate_hidden,#DP_Rate_Input").val(dicountForGrossFee.toFixed(2));
                                var deduct = grossFee - dicountForGrossFee;

                                var total = deduct + regFee;
 				$("#RG_Total_Fee").val(total.toFixed(2));
                            } else {

                                var discountRate = response.DP_Rate;
                                $("#RG_discountRate_hidden,#DP_Rate_Input").val(discountRate);
                                var deduct = grossFee - discountRate;

                                var total = deduct + regFee;
				$("#RG_Total_Fee").val(total.toFixed(2));
var dicountForGrossFee =  parseInt($("#RG_discountRate_hidden").val(), 10);

                            }


    //var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

                            var i = parseInt(insEndCount, 10) + 1;
                            while (i--) {

                                if (i == 0) {
                                    break;

                                } else {
                                    var amountByLast = parseInt($('td.' + i + 'INS').text(), 10);
                                    if (dicountForGrossFee >= amountByLast) {
       var dicountForGrossFee = dicountForGrossFee - amountByLast;

                                        $('td.' + i + 'INS').closest("tr").remove();
					
					$('td.' + i + 'INS').text(dicountForGrossFee.toFixed(2));
                                    } else {

 var dicountForGrossFee = amountByLast - dicountForGrossFee;


                                        $('td.' + i + 'INS').text(dicountForGrossFee.toFixed(2));
                                        break;
                                    }
                                }
                            }



}
                            
}//success response end

});//discount form end...........
  }else{
$("#RG_Dis_Comment").addClass("errorInput");
$("#RG_Dis_Comment").val("Please enter a comment!");
	 
$("#RG_Dis_Comment").keyup(function(){

$(this).removeClass('errorInput');

});

//esc start

$('#loginAuthentication').modal({ backdrop: 'static', keyboard: false }) 

//esc end
$('.authCloseSpecial').off('click');
$('.authCloseSpecial').on('click',function(){
$('#discountPlan').prop('selectedIndex',0);
$("#RG_Dis_Comment").removeClass('errorInput');
$("#RG_Dis_Comment").val(" ");
});

$("#letMeOkThisDiscount").off('click');
$("#letMeOkThisDiscount").on('click',function(event){
event.preventDefault();

$("#installmentsViewFirstTr").nextAll().remove();


     var username = $("#loginAuthenticationSpecialDiscountUser").val();
     var password = $("#loginAuthenticationSpecialDiscountPass").val();

     //special validation start
     if (username.length <= 2) {
         alert("Please enter valid username");
         return;
     }

     if (password.length <= 2) {
         alert("Please enter valid password");
         return;
     }

     if ($("#discount_from_admin").val().length == 0) {
         alert("Please enter valid discount");
         return;
     }
     //special validation end

  $.ajax({

            url: "../Controller/loginAuthentication.php",
            type: "post",
	    async: false,
	    data: "userNameSpecial=" + username + "&passWordSpecial=" + password,
            success: function (response) {


if(response == false){
alert("try again");
return;

}
if(response){

if ($('#discount_from_admin_percentage').is(':checked')) {
	$("#installmentsViewFirstTr").nextAll().remove();
	var courseFeeForspecialdis = $("#FS_Price").val();
	var percentageSpecial = parseFloat($("#discount_from_admin").val() / 100);
	var dispercetageValue = courseFeeForspecialdis * percentageSpecial;
	$("#discount_from_admin_hidden").val(dispercetageValue);
	specialDicount = parseInt($("#discount_from_admin_hidden").val(), 10);
	var gorssFeeyet = parseInt($("#FS_Price").val(), 10);
	var regFeeyet = parseInt($("#RG_Reg_Fee").val(), 10);
	var netTotalFinal = (gorssFeeyet - specialDicount) + regFeeyet;
	$("#RG_Total_Fee").val(netTotalFinal.toFixed(2));
}
if ($('#discount_from_admin_value').is(':checked')) {
	$("#installmentsViewFirstTr").nextAll().remove();
	var disValueValue = parseFloat($("#discount_from_admin").val());
	$("#discount_from_admin_hidden").val(disValueValue);
	specialDicount = parseInt($("#discount_from_admin_hidden").val(), 10);
	var gorssFeeyetV = parseInt($("#FS_Price").val(), 10);
	var regFeeyetV = parseInt($("#RG_Reg_Fee").val(), 10);
	var netTotalFinalV = (gorssFeeyetV - specialDicount) + regFeeyetV;
	$("#RG_Total_Fee").val(netTotalFinalV.toFixed(2));
}
	$("#loginAuthentication").modal('hide');

var specialDicount = parseFloat($("#discount_from_admin_hidden").val());

 $("#DP_Rate_Input").val(specialDicount.toFixed(2));

$("#installmentsViewFirstTr").nextAll().remove();

// special discount calculate start


 var data = $('#fsCourseSet option:selected').val();
                         $.ajax({

                             url: "../Controller/regFeeAndgrossFee.php",
                             type: "GET",
                             data: "FS_Code=" + data,
                             success: function(response) {

                                 var INSNO = "INSNO";
                                 var INS = "INS";
                                 var DUE = "DUE";
                                 var size = response.installment.filter(function(value) {
                                     return value !== undefined;
                                 }).length;
                                 for (var i = 0; i < size; i++) {
                                     $("#installmentsView tr:last").after("<tr class='info' data-index=" + (i + 1) + "><td class=" + (i + 1) + INSNO + ">" + response.installment[i].FI_Ins_NO + "</td><td class=" + (i + 1) + INS + ">" + response.installment[i].FI_Ins_Amount + "</td><td class=" + (i + 1) + DUE + "></td></tr>");

                                 }

                                 var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

                                 dueDateAndInsRoalBack();


var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');


                            var specialDicount = parseFloat($("#DP_Rate_Input").val());
                            var i = parseInt(insCount, 10) + 1;

                            while (i--) {

                                if (i === 0) {
                                    break;

                                } else {
                                    var amountByLast = parseInt($('td.' + i + 'INS').text());

                    if(specialDicount >= amountByLast) {

       var specialDicount = specialDicount - amountByLast;

                                        $('td.' + i + 'INS').closest("tr").remove();
					
					$('td.' + i + 'INS').text(specialDicount.toFixed(2));
                                    } else {
 var specialDicount = amountByLast - specialDicount;
                                        $('td.' + i + 'INS').text(specialDicount.toFixed(2));
                                        break;
                                    }
                                }
                            }



/// special discount calculate end


}

});   



	}

}



        });




});



} //special else end
                           }

                         });

                         //registration fee end
                     });

                 }

             });

             //discount plan   form end...........
         }); //Installment plan end
     }

 });

//fee structure form end 

//hidden course finder start
$.ajax({
    url: "../Controller/courseFinder.php",
    type: "GET",
    data: "RT_Code=" + data,
    success: function(response) {
        $("#CourseSetControls").html(response);
var CT_Course_Code = $('#CourseSet option:selected').val();

        if ($("#CourseSet option").length > 1) {
          $("#CourseSet").prepend("<option value='Please select the course'>Please select the course</option>");
		  $("#CourseSet").val("Please select the course");
            $("#nextCourse").show('fast', function() {


                $(document).off('change', '#CourseSet');
                $(document).on('change', '#CourseSet', function(event) {



                    event.stopPropagation();
                    $("#subjectsTableFirstTr").nextAll().remove();
                    if ($("#CourseSet option").length == 1) {
                        $("#selectedSubjectsSession").nextAll().remove();
                    }




                    var CT_Course_Code = $('#CourseSet option:selected').val();
                    var CT_Type_Code = $('#RegType option:selected').val();
                    $("#batchMasterOpen").attr('data', CT_Course_Code);
                    //batch sorting start
                    $.ajax({
                        url: "../Controller/batchSorting.php",
                        type: "GET",
                        data: "CT_Type_Code=" + CT_Type_Code + "&CT_Course_Code=" + CT_Course_Code,
                        success: function(response) {
 $("#batchMasterSet").html(response);
                            var shouldChecked = $("#CT_No_Of_SubjectsCount").val();

var CT_Course_Code = $('#CourseSet option:selected').val();

$.ajax({

    url: "../Controller/subjects.php",
    type: "GET",
    data: "CT_Course_Code=" + CT_Course_Code,
    success: function(response) {


        var size = response.filter(function(value) {
            return value !== undefined
        }).length;
        for (var i = 0; i < size; i++) {
            $("#subjectsTable tr:last").after("<tr class='info' data-index=" + CT_Course_Code + (i + 1) + "><td><input type='checkbox' class='selectedSubjects' name='selectedSubjects' /></td><td class='selectedSCode'>" + response[i].S_Code + "</td><td class='selectedSName'>" + response[i].S_Name + "</td></tr>");

        }


        if (shouldChecked == 0) {
            $(".selectedSubjects:checkbox").prop('checked', true).attr("disabled", true);

        }


    }
});



                            if ($("#CourseSet option").length >= 2 && shouldChecked == 0) {
                                $(".selectedSubjects:checkbox").prop('checked', true).attr("disabled", true);
                            }
                            if (shouldChecked == 0) {
                                $(".selectedSubjects:checkbox").prop('checked', true).attr("disabled", true);
                                $("#batchMasterSet").off('change', '#alreadyBatchSorting');
                                $("#batchMasterSet").on('change', '#alreadyBatchSorting', function(event) {
																								   
																								   
                                    if ($("#nextCourse").is(":visible")) {
                                        
                                    }else{
									
									$("#selectedSubjectsSession").nextAll().remove();
									
									}
                                    var selectedReg = $('#RegType').val();
                                    var selectedCouse = $('#CourseSet option:selected').val();
                                    var selectedBatch = $('#alreadyBatchSorting option:selected').val();
									
	$('#mainAlertInfoSelected').text(" You just selected " + selectedBatch + " batch ");
									
var selectedBatchcDate = $('#alreadyBatchSorting option:selected').attr('data-commence-date');
var selectedBatcheDate = $('#alreadyBatchSorting option:selected').attr('data-end-date');
var selectedBatchInsDays = $('#alreadyBatchSorting option:selected').attr('data-ins-days');

                                    $(".selectedSubjects:checkbox").each(function(event) {
 var selectedSCode = $(this).closest("tr").find(".selectedSCode").text();
                                        $("#selectesSubjectsRecodes tr:last").after("<tr class='success' id=" + selectedCouse + selectedSCode + "><td>" + selectedReg + "</td><td>" + selectedCouse + "</td><td>" + selectedSCode + "</td><td class='selectedBatch' data-ins-days=" + selectedBatchInsDays + " data-end-date=" + selectedBatcheDate + " data-commence-date=" + selectedBatchcDate + ">" + selectedBatch + "</td></tr>");
                                    });
                                });
                            } else {
                                $("#batchMasterSet").off('change', '#alreadyBatchSorting');
                                $("#batchMasterSet").on('change', '#alreadyBatchSorting', function(event) {
                                    var selectedBatch = $('#alreadyBatchSorting option:selected').val();
									
		$('#mainAlertInfoSelected').text(" You just selected " + selectedBatch + " batch ");	
                                });
								
			
								
                                $("#subjectsTable").off('change', '.selectedSubjects');
                                $("#subjectsTable").on('change', '.selectedSubjects', function(event) {
																							   
																							   
                                    event.preventDefault();
                                    var selectedReg = $('#CouserFinder option:selected').val();
                                    var selectedCouse = $('#CourseSet option:selected').val();
                                    var selectedBatch = $('#alreadyBatchSorting option:selected').val();
									
	
									
var selectedBatchcDate = $('#alreadyBatchSorting option:selected').attr('data-commence-date');
var selectedBatcheDate = $('#alreadyBatchSorting option:selected').attr('data-end-date');
var selectedBatchInsDays = $('#alreadyBatchSorting option:selected').attr('data-ins-days');

                                    if (selectedBatch != "Select Your Batch") {
                                        var shouldChecked = $("#CT_No_Of_SubjectsCount").val();
                                        var bol = $(".selectedSubjects:checkbox:checked").length >= shouldChecked;
                                        $(".selectedSubjects:checkbox").not(":checked").attr("disabled", bol);
                                        if ($(this).is(":checked")) {
                                            var indexChecked = $(this).closest("tr").attr("data-index");
                                            var selectedSCode = $(this).closest("tr").find(".selectedSCode").text();
											
		$('#mainAlertInfoSelected').text(" You just selected " + selectedSCode + " subject ");									
											
                                            $("#selectesSubjectsRecodes tr:last").after("<tr class='success' id=" + selectedCouse + selectedSCode + " data-index=" + indexChecked + "><td>" + selectedReg + "</td><td>" + selectedCouse + "</td><td>" + selectedSCode + "</td><td class='selectedBatch' data-ins-days=" + selectedBatchInsDays + " data-end-date=" + selectedBatcheDate + " data-commence-date=" + selectedBatchcDate + ">" + selectedBatch + "</td></tr>");
                                            $('[id]').each(function(i) {
                                                var ids = $('[id="' + this.id + '"]');
                                                if (ids.length > 1) {
                                                    $('[id="' + this.id + '"]:gt(0)').remove();
                                                }
                                            });
                                        } else {
                                            var indexAdded = $(this).closest("tr").attr("data-index");
                                            var findRow = $("#selectesSubjectsRecodes tr[data-index='" + indexAdded + "']");
                                            findRow.remove();
                                        }
                                    } else {
                                        alert("Warning!: Select Your Batch");
                                        $(this).prop('checked', false);
                                    }
                                });
                            }



                        },
                        dataType: 'html'
                    });
                    //batchsorting end





                });//course set change event end
            }); 
        }
else{


		    $("#nextCourse").hide();
                    event.stopPropagation();
                    $("#subjectsTableFirstTr").nextAll().remove();
                    if ($("#CourseSet option").length == 1) {
                        $("#selectedSubjectsSession").nextAll().remove();
                    }
                    var CT_Course_Code = $('#CourseSet option:selected').val();
                    var CT_Type_Code = $('#RegType option:selected').val();
                    $("#batchMasterOpen").attr('data', CT_Course_Code);
                    //batch sorting start
                    $.ajax({
                        url: "../Controller/batchSorting.php",
                        type: "GET",
                        data: "CT_Type_Code=" + CT_Type_Code + "&CT_Course_Code=" + CT_Course_Code,
                        success: function(response) {
$("#batchMasterSet").html(response);




var CT_Course_Code = $('#CourseSet option:selected').val();

$.ajax({

    url: "../Controller/subjects.php",
    type: "GET",
    data: "CT_Course_Code=" + CT_Course_Code,
    success: function(response) {


        var size = response.filter(function(value) {
            return value !== undefined;
        }).length;
        for (var i = 0; i < size; i++) {
            $("#subjectsTable tr:last").after("<tr class='info' data-index=" + CT_Course_Code + (i + 1) + "><td><input type='checkbox' class='selectedSubjects' name='selectedSubjects' /></td><td class='selectedSCode'>" + response[i].S_Code + "</td><td class='selectedSName'>" + response[i].S_Name + "</td></tr>");

        }


        if (shouldChecked == 0) {
            $(".selectedSubjects:checkbox").prop('checked', true).attr("disabled", true);

        }


    }
});





                            var shouldChecked = $("#CT_No_Of_SubjectsCount").val();
                            if ($("#CourseSet option").length >= 2 && shouldChecked == 0) {
                                $(".selectedSubjects:checkbox").prop('checked', true).attr("disabled", true);
                            }
                            if (shouldChecked == 0) {
                                $(".selectedSubjects:checkbox").prop('checked', true).attr("disabled", true);
                                $("#batchMasterSet").off('change', '#alreadyBatchSorting');
                                $("#batchMasterSet").on('change', '#alreadyBatchSorting', function(event) {
																								   
																								   
                                    if ($("#CourseSet option").length <= 2) {
                                        $("#selectedSubjectsSession").nextAll().remove();
                                    }
                                    var selectedReg = $('#CouserFinder option:selected').val();
                                    var selectedCouse = $('#CourseSet option:selected').val();
                                    var selectedBatch = $('#alreadyBatchSorting option:selected').val();
									
	$('#mainAlertInfoSelected').text(" You just selected " + selectedBatch + " batch ");
	
var selectedBatchcDate = $('#alreadyBatchSorting option:selected').attr('data-commence-date');
var selectedBatcheDate = $('#alreadyBatchSorting option:selected').attr('data-end-date');
var selectedBatchInsDays = $('#alreadyBatchSorting option:selected').attr('data-ins-days');
                                    $(".selectedSubjects:checkbox").each(function(event) {
var selectedSCode = $(this).closest("tr").find(".selectedSCode").text();
                                        $("#selectesSubjectsRecodes tr:last").after("<tr class='success' id=" + selectedCouse + selectedSCode + "><td>" + selectedReg + "</td><td>" + selectedCouse + "</td><td>" + selectedSCode + "</td><td class='selectedBatch' data-ins-days=" + selectedBatchInsDays + " data-end-date=" + selectedBatcheDate + " data-commence-date=" + selectedBatchcDate + ">" + selectedBatch + "</td></tr>");
                                    });
                                });
                            } else {
                                $("#batchMasterSet").off('change', '#alreadyBatchSorting');
                                $("#batchMasterSet").on('change', '#alreadyBatchSorting', function(event) {
                                   var selectedBatch = $('#alreadyBatchSorting option:selected').val();
								   
			$('#mainAlertInfoSelected').text(" You just selected " + selectedBatch + " batch ");  
                                });
								
		
		
                                $("#subjectsTable").off('change', '.selectedSubjects');
                                $("#subjectsTable").on('change', '.selectedSubjects', function(event) {
                                    event.preventDefault();
									
									
                                    var selectedReg = $('#CouserFinder option:selected').val();
                                    var selectedCouse = $('#CourseSet option:selected').val();
                                    var selectedBatch = $('#alreadyBatchSorting option:selected').val();

$('#mainAlertInfoSelected').text(" You just selected " + selectedBatch + " batch ");

var selectedBatchcDate = $('#alreadyBatchSorting option:selected').attr('data-commence-date');
var selectedBatcheDate = $('#alreadyBatchSorting option:selected').attr('data-end-date');
var selectedBatchInsDays = $('#alreadyBatchSorting option:selected').attr('data-ins-days');

                                    if (selectedBatch != "Select Your Batch") {
                                        var shouldChecked = $("#CT_No_Of_SubjectsCount").val();
                                        var bol = $(".selectedSubjects:checkbox:checked").length >= shouldChecked;
                                        $(".selectedSubjects:checkbox").not(":checked").attr("disabled", bol);
                                        if ($(this).is(":checked")) {
                                            var indexChecked = $(this).closest("tr").attr("data-index");
                                            var selectedSCode = $(this).closest("tr").find(".selectedSCode").text();
											
		$('#mainAlertInfoSelected').text(" You just selected " + selectedSCode + " subject ");					
		
                                            $("#selectesSubjectsRecodes tr:last").after("<tr class='success' id=" + selectedCouse + selectedSCode + " data-index=" + indexChecked + "><td>" + selectedReg + "</td><td>" + selectedCouse + "</td><td>" + selectedSCode + "</td><td class='selectedBatch' data-ins-days=" + selectedBatchInsDays + " data-end-date=" + selectedBatcheDate + " data-commence-date=" + selectedBatchcDate + ">" + selectedBatch + "</td></tr>");
                                            $('[id]').each(function(i) {
                                                var ids = $('[id="' + this.id + '"]');
                                                if (ids.length > 1) {
                                                    $('[id="' + this.id + '"]:gt(0)').remove();
                                                }
                                            });
                                        } else {
                                            var indexAdded = $(this).closest("tr").attr("data-index");
                                            var findRow = $("#selectesSubjectsRecodes tr[data-index='" + indexAdded + "']");
                                            findRow.remove();
                                        }
                                    } else {
                                        alert("Warning!: Select Your Batch");
                                        $(this).prop('checked', false);
                                    }
                                });
                            }

                        },
                        dataType: 'html'
                    });
                    //batchsorting end


}
    } // course finder success end
}); //hidden course finder end








  });





                  

}

});
});




$("#FinalDiscountSelector").off('change', '#RG_FullPay_Dis_Amount_Select');
$("#FinalDiscountSelector").on('change', '#RG_FullPay_Dis_Amount_Select', function (event) {
    var dataPercentage = $('#RG_FullPay_Dis_Amount_Select option:selected').val();
    var RG_Reg_Fee = parseInt($("#RG_Reg_Fee").val(), 10);
    var RG_Final_Fee = parseInt($('#RG_Total_Fee').val(), 10);
    var withoutRegFee = RG_Final_Fee - RG_Reg_Fee;

    var discountForFinal = dataPercentage / 100;
    var finalAmount = withoutRegFee * discountForFinal;
    $('#RG_FullPay_Dis_Amount_hidden').val(finalAmount);
    var lastAmountLast = withoutRegFee - finalAmount + RG_Reg_Fee;

    $("#RG_Total_Fee_Final").val(lastAmountLast.toFixed(2));
    var RG_Final_Fee = $("#RG_Total_Fee_Final").val();


    $("#installmentsViewFirstTr").nextAll().remove();

    var data = $('#fsCourseSet option:selected').val();

    $.ajax({

        url: "../Controller/regFeeAndgrossFee.php",
        type: "GET",
        data: "FS_Code=" + data,
        success: function (response) {


            var INSNO = "INSNO";
            var INS = "INS";
            var DUE = "DUE";
            var size = response.installment.filter(function (value) {
                return value !== undefined
            }).length;
            for (var i = 0; i < size; i++) {
                $("#installmentsView tr:last").after("<tr class='info' data-index=" + (i + 1) + "><td class=" + (i + 1) + INSNO + ">" + response.installment[i].FI_Ins_NO + "</td><td class=" + (i + 1) + INS + ">" + response.installment[i].FI_Ins_Amount + "</td><td class=" + (i + 1) + DUE + "></td></tr>");

            }

            var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

             dueDateAndInsRoalBack();
console.log(insEndCount);

var freeStructureDisplanDiscount = parseInt($("#DP_Rate_Input").val(), 10);

if(isNaN(freeStructureDisplanDiscount)){

var lastDiscount = finalAmount;

}else{

var lastDiscount = finalAmount + freeStructureDisplanDiscount;
}
      

            var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

console.log(insEndCount);
            var i = parseInt(insEndCount) + 1;

            while (i--) {

                if (i == 0) {
                    break;

                } else {

                    var amountByLastLast = parseFloat($('td.' + i + 'INS').text(), 10);
console.log(amountByLastLast);
console.log(lastDiscount);

                    if (lastDiscount >= amountByLastLast) {
                        var lastDiscount = lastDiscount - amountByLastLast;
                        $('td.' + i + 'INS').closest("tr").remove();

                        $('td.' + i + 'INS').text(lastDiscount.toFixed(2));
                    } else {
                        var lastDiscount = amountByLastLast - lastDiscount;

                        $('td.' + i + 'INS').text(lastDiscount.toFixed(2));
                        break;
                    }
                }
            }



        }

    });




});




//wait i need your Id number start 

    $("#searchNow").click(function (event) {

    $("#searchNowForm").fadeOut();
    $("#registrationType").show();
});

$('.fullPayYes').click(function () {

    var r = confirm("are you going to pay in full ? ");
    if (r == true) {
        $(".fullPayNo").prop('checked', false);
        $(this).prop('checked', true);
        $("#fullPayInput").show();
        $("#Installments").hide();


    }
else{

 $(".fullPayNo").prop('checked', true);

}
});

//wait i need your Id number end



//getLastRegId start
 $(".getLastRegId").on('click',function (event) {
 var getIdFromCheckForm = $("#SM_ID_KEEP").val();
 checkIdNumber(getIdFromCheckForm);
  $.ajax({

            url: "../Controller/getLastRegId.php",
            type: "GET",
            success: function (response) {
                var RG_Branch_Code = $('#RG_Branch_Code_Session').val();
                $("#RG_Reg_NO").val(RG_Branch_Code+'-'+response);
            }



        });
});

//getLastRegId end


//User Registration form start...........

$("#registerUserSubmit").click(function (event) {


var nullVlue = $("#CouserFinder").val();


var disPlanCheck = $('#discountPlan option:selected').val();
var getFsCourseSelected = $("#fsCourseSet option:selected").val();
if(disPlanCheck == "special"){
	  
	 $("#RG_Dis_Comment").addClass("errorInput");
        var disCommentRestriced = $("#RG_Dis_Comment").val();


	 if(disCommentRestriced == "Please enter a comment!"){
        alert("Please enter a comment!");
         return;
			 
	}
	 
}

		if(getFsCourseSelected == " " ){
                alert("Please select a Fee Structure");
 		return;

		}


	
	var getEmptyId = $("#RG_Stu_ID").val();
	
		if(getEmptyId == 0) {
		
		alert("Please enter an ID Number");
         return;
	}
	
	var getEmptyCourse = $("#CouserFinder option:selected").val();
		if(getEmptyCourse == " ") {
		
		alert("Please select a course");
         return;
	}

          var RegTypenullVlue = $("#RegType").val();

		if(RegTypenullVlue == " " ){

                alert("Please select a registration type");
 		return;

		}

	var getEmptyCourse = $("#CouserFinder").val();

		if(getEmptyCourse == " ") {
		
		alert("Please select a course");
         return;
	}

if(nullVlue != " "){

    var RG_Date = $('#RG_Date').val();
    var RG_Date = $('#PM_Date_After_Full').val();
    var RG_Branch_Code = $('#RG_Branch_Code_Session').val();

    var selectedBatchForPrint = $('#alreadyBatchSorting option:selected').val();
    $('#selectedBatchForPrint').val(selectedBatchForPrint);

    var registerUserForPrint = $("#mainAlertInfo").text();
    $("#registerUserForPrint").val(registerUserForPrint);

    //getLastInvoiceNumber start
    $.ajax({

        url: "../Controller/getLastInvoiceNumber.php",
        type: "GET",
        data: "RG_Branch_Code=" + RG_Branch_Code + "&RG_Date=" + RG_Date,
        success: function (response) {
            $('#putInvoiceNumber').val(response.InvoiceNumber);

        }



    });

    //getLastInvoiceNumber




    if ($('.fullPayYes').is(':checked')) {

        var RG_Final_Fee = parseFloat($("#RG_Total_Fee_Final").val());
     
     //set max attr for the cash and credit 

     $("#PM_Amount_Cash").attr("max", RG_Final_Fee);


        $("#PM_Amount").val(RG_Final_Fee.toFixed(2)).prop('disabled', true);
    } else {

        $("#PM_Amount").val(parseFloat($(".1INS").text())).prop('disabled', true);
        var RG_Final_Fee = $('#RG_Total_Fee').val();

    //set max attr for the cash and credit 

     $("#PM_Amount_Cash").attr("max", parseFloat($(".1INS").text()));

    }


    var RG_Branch_Code = $('#RG_Branch_Code_Session').val();
    var RG_Reg_NO = $("#RG_Reg_NO").val();
    var RG_Stu_ID = $("#RG_Stu_ID").val();
    var RG_Reg_Type = $('#RegType').val();
    var RG_Fee_Structure = $('#fsCourseSet').val();
    var couponCode = $('#couponCode').val();
    var RG_Discount_Plan = $('#discountPlan option:selected').val();
    var RG_Total_Fee = $('#FS_Price').val();
    var RG_Reg_Fee = $('#RG_Reg_Fee').val();
    var RG_FullPay_Dis_Amount = $('#RG_FullPay_Dis_Amount_hidden').val();
    var RG_Dis_Amount = $('#DP_Rate_Input').val();
    var RG_Dis_Comment = $('#RG_Dis_Comment').val();
    var RG_Operator = $('#RG_Operator_Session').val();
    var RG_Date = $('#RG_Date').val();
    var RG_Total_Paid = $('#RG_Total_Paid').val();
    var SI_Reg_No = $("#RG_Reg_NO").val();
    var updateInsCount = $("#installmentsView tr:last td:first-child").text();
    var SI_Paid_Amount = "NULL";
    var SI_Paid_Date = $('#RG_Date').val();
    var studentRegisterArray=[];
    var getfullRegData='';

studentRegisterArray.push({ name: "RG_Branch_Code", value: RG_Branch_Code });
studentRegisterArray.push({ name: "RG_Reg_NO", value: RG_Reg_NO });
studentRegisterArray.push({ name: "RG_Stu_ID", value: RG_Stu_ID });
studentRegisterArray.push({ name: "RG_Reg_Type", value: RG_Reg_Type });
studentRegisterArray.push({ name: "RG_Fee_Structure", value: RG_Fee_Structure });
studentRegisterArray.push({ name: "RG_Discount_Plan", value: RG_Discount_Plan });
studentRegisterArray.push({ name: "RG_Total_Fee", value: RG_Total_Fee });
studentRegisterArray.push({ name: "RG_Final_Fee", value: RG_Final_Fee });
studentRegisterArray.push({ name: "RG_Reg_Fee", value: RG_Reg_Fee });
studentRegisterArray.push({ name: "RG_Total_Paid", value: RG_Total_Paid });
studentRegisterArray.push({ name: "RG_FullPay_Dis_Amount", value: RG_FullPay_Dis_Amount });
studentRegisterArray.push({ name: "RG_Dis_Amount", value: RG_Dis_Amount });
studentRegisterArray.push({ name: "RG_Dis_Comment", value: RG_Dis_Comment });
studentRegisterArray.push({ name: "RG_Operator", value: RG_Operator });
studentRegisterArray.push({ name: "RG_Date", value: RG_Date });
studentRegisterArray.push({ name: "couponCode", value: couponCode });
studentRegisterArray.push({ name: "Default_Batch", value: $('#alreadyBatchSorting option:selected').val() });

               var studentInstallmentsArray=[];
               var getInsTotal = 0;
            for (var i = 1; i <= updateInsCount; i++) {

                var SI_Ins_Amount = $("#installmentsView").find('td.' + i + 'INS').text();
		var SI_Paid_Amount = $("#installmentsView").find('td.' + i + 'PAID').text();
                var SI_Due_Date = $("#installmentsView").find('td.' + i + 'DUE').text();
               studentInstallmentsArray.push(i, SI_Ins_Amount , SI_Due_Date);
      
             getInsTotal += parseFloat(SI_Ins_Amount);

            }


          if(RG_Final_Fee != getInsTotal){
   
           alert("There is a problem with installment calculations");

         return true;
         }

	 studentRegisterArray.push({ name : "installments", value: studentInstallmentsArray });
		
            var studentSubjectsArray=[];
            var selectesSubjectsRecodes = $("#selectesSubjectsRecodes").find("tr").length;
            var realSubjectsSet = selectesSubjectsRecodes - 1;
            for (var i = 1; i <= realSubjectsSet; i++) {
                var countSet = i + 1;
                var SS_Subject = $("#selectesSubjectsRecodes tr:nth-child(" + countSet + ") td:nth-child(3)").text();
                var SS_Batch_No = $("#selectesSubjectsRecodes tr:nth-child(" + countSet + ") td:last").text();

 studentSubjectsArray.push(SS_Batch_No,SS_Subject);
    

            }

            studentRegisterArray.push({ name : "subjects", value: studentSubjectsArray });

    

    $.ajax({

        url: "../Controller/fullUserRegistration.php",
        type: "GET",
        async: false,
        beforeSend: function () {
         
     //saving........

   $("#mainAlertInfoSelected").html(" Your registration data is being saving...Please wait.<br><div class='progress progress-striped active'><div class='bar' style='width: 40%;'></div></div>");

        },
        data:studentRegisterArray,
        dataType:'JSON',
        success: function (response) {

// new registration no if it doesn't changed

$("#RG_Reg_NO").val(response.RG_Reg_NO);


/////error hadling //////

         if(!response.commitCode){
		$('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
		$('#mainAlertInfoSelected').html("<br/> ERROR: "+response.errorInfo);
		$("#initialsPayments").modal("hide");
		}else{
                $("#initialsPayments").modal();
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
		 $('#mainAlertInfoSelected').html(" This Registration successfully saved");
               
		}


}





    });

} //if CouserFinder not set end
else{

alert("you have missed smoething!");
}

});
//User registration form end...........


//afterPayments start

$("#regNoPayments").on('keyup', function (event) {

//reg number finder start

 	 $.ajax({

                url: "../Controller/currencyFind.php",
                type: "GET",
                data: "RG_Reg_NO=" + $(this).val(),
                async: false,
                dataType: 'JSON',
                success: function (response) {

// currency set start

if (response.indexOf('|') != -1) {


   $('.accsepttingCurrency').text(response.substr(0, response.indexOf('|')));

} else {

   $('.accsepttingCurrency').text('LKR');

}


// currency set end

		}

});

//reg number finder end

//reg number finder start

 	 $.ajax({

                url: "../Controller/regNumberFinder.php",
                type: "GET",
                data: "RG_Reg_NO=" + $(this).val(),
                async: false,
                success: function (response) {

		$('#mainAlert').show(function(){
		
		if(response == ' .Duplicate Registration No found in existing data'){
		$('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
		$('#mainAlertInfoSelected').html(" This registration exists");

		}else{
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
		 $('#mainAlertInfoSelected').html(" This registration  doen't exists");

		}
		
                

		});

		}

});

//reg number finder end

 if ($(this).val().length < 12) {

                    $("#idNumberPayment").val(" ");
                    $("#RG_Type_Payment").val(" ");
                    $("#courseFeePayment").val(" ");
                    $("#totalPaidPayment").val(" ");
                    $("#balanceDuePayment").val(" ");
                    $("#fullNamePayment").val(" ");
                    $("#addressPayment").val(" ");
                    $("#idNumberPayment").val(" ");
                     $("#totalPayment").val(" ");
                    $("#uptoDateDue").val(" ");
   $("#batchNumerPayment").val(" ");


 $("#afterPaymentsInstallment tr:first-child").nextAll().remove();
$("#mainAlert").show(function(){
                $('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
 $("#mainAlertInfo").html(" Wrong registration number");

});

}
 if ($(this).val().length > 11) {

        var data = $("#regNoPayments").val();
        $.ajax({

            url: "../Controller/afterPayments.php",
            type: "GET",
            data: "RG_Reg_NO=" + data,
            success: function (response) {

                if (!response) {
                    $("#idNumberPayment").val("Data not provide");
                    $("#RG_Type_Payment").val("Data not provide");
                    $("#courseFeePayment").val("Data not provide");
                    $("#totalPaidPayment").val("Data not provide");
                    $("#balanceDuePayment").val("Data not provide");

                } else {

                    $("#idNumberPayment").val(response.RG_Stu_ID);
                    $("#RG_Type_Payment").val(response.RG_Reg_Type);
                    $("#courseFeePayment").val(response.RG_Final_Fee);
                    $("#totalPaidPayment").val(response.RG_Total_Paid);

                    $("#balanceDuePayment").val((response.RG_Final_Fee - response.RG_Total_Paid).toFixed(2));



                }

                var SM_ID = $("#idNumberPayment").val();
                
                    $.ajax({

                        url: "../Controller/afterPaymentsUserDetails.php",
                        type: "GET",
                        data: "SM_ID=" + SM_ID,
                        success: function (response) {
                            if (!response) {

                                $("#fullNamePayment").val("Data Not Provided");
                                $("#addressPayment").val("Data Not Provided");
                                $("#idNumberPayment").val("Data Not Provided");

                            } else {

                                $("#fullNamePayment").val(response.SM_First_Name + " " + response.SM_Last_Name);
                                $("#addressPayment").val(response.SM_House_NO + "," + response.SM_Lane + "," + response.SM_Town + "," + response.SM_City + "," + response.SM_Country);
	$("#mainAlert").show(function(){
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
 $("#mainAlertInfo").html(response.SM_First_Name + " " + response.SM_Last_Name);

    });

                            }

                        }

                    });

                //subjects 

                $.ajax({

                    url: "../Controller/afterPaymentsStudentSubjects.php",
                    type: "GET",
                    data: "SS_REG_NO=" + data,
                    success: function (response) {

                        if (response) {
                            $("#batchNumerPayment").val(response.SS_Batch_No);

                        } else {

                            $("#batchNumerPayment").val("Data Not Provided");

                        }


                    }



                });



                //afterPaymentsInstallment 

                $.ajax({

                    url: "../Controller/afterPaymentsInstallment.php",
                    type: "GET",
                    data: "SI_Reg_No=" + data,
                    success: function (response) {

                        $("#afterPaymentsInstallmentControls").html(response);

var lastInsBy = $("#afterPaymentsInstallment tr:last td:first-child").text();
var PM_Date_After_Full = $("#PM_Date_After_Full").val();
var getTodayTime = new Date(PM_Date_After_Full).getTime();

var i = parseInt(lastInsBy, 10) + 1;
var totleUpto = [];
var paidUpto = [];
 								 while (i--) {

                                if (i == 0) {
                                    break;

                                } else {
                                    
				var dueDatelastInsBy = $("#" + i + "INSDUEDATE").text();
				
								
var DatePay = new Date(dueDatelastInsBy).getTime();

if(getTodayTime >= DatePay){

var getUptoInsAmount = $("." + i + "INSAMOUNT").text();
var getPaidAmountUpTo = $("#" + i + "INSPAIDAMOUNT").text();

totleUpto.push(getUptoInsAmount);
paidUpto.push(getPaidAmountUpTo);
	}else{
		
	$("#uptoDateDue").val("You don't have any updo Date Due");	
		
		}
                                }
                            }
							
							
//totle updatodate Dues							
var totalUpdateDateDues = 0;
for (var i = 0; i < totleUpto.length; i++) {
    totalUpdateDateDues += totleUpto[i] << 0;
}

//totle updatodate Dues							
var paidUpToTotal = 0;
for (var i = 0; i < paidUpto.length; i++) {
    paidUpToTotal += paidUpto[i] << 0;
}

$("#uptoDateDue").val((totalUpdateDateDues - paidUpToTotal).toFixed(2));



                    }

                });
            }



        });

}

});


//afterPayments end





$(document).on('click', '.cash', function (e) {

    $("#PM_Type").val("Cash");
    $(".payNow").show();
});
$('.creditCard').on('click', function (e) {
    $("#PM_Type").val("Credit Card");
    $(".payNow").show();
});
$('.cheque').on('click', function (e) {
    $("#PM_Type").val("Cheque");
    $(".payNow").show();
});


 $('.oneNo').keyup(function() {
     if(this.value.length == $(this).attr('maxlength')) {
         $('.twoNo').focus();
     }
 });

 $('.twoNo').keyup(function() {
     if(this.value.length == $(this).attr('maxlength')) {
         $('.threeNo').focus();
     }
 });

 $('.threeNo').keyup(function() {
     if(this.value.length == $(this).attr('maxlength')) {
         $('.fourNo').focus();
     }
 });

//initialsPaymentsData
$(document).off('click', "#initialsPaymentsDataSubmit");
$(document).on('click', "#initialsPaymentsDataSubmit", function (event) {


    var oneNo = $(".oneNo").val();
    var twoNo = $(".twoNo").val();
    var threeNo = $(".threeNo").val();
    var fourNo = $(".fourNo").val();
    var RG_Reg_NO = $("#RG_Reg_NO").val();
    $("#RG_Reg_N0_Payments").val(RG_Reg_NO);
    var WholeCardNumber = oneNo + twoNo + threeNo + fourNo;
    $("#hiddenCreditCardNumer").val(WholeCardNumber);
    event.preventDefault();


    var RG_Date = $('#RG_Date').val();
    $('#RG_Date_initial_payments').val(RG_Date);

   
    var RG_Reg_N0 = $("#RG_Reg_NO").val();
    var PM_Operator = $('#RG_Operator_Session').val();

    var PM_Amount = $("#PM_Amount").val();


    var currency = $('.payingCurrency').text();
    var currencyRate = $('#currencyJsonCallBack').val();

    var a = +$("#PM_Amount_Cash").val()*currencyRate;
    var b = +$("#PM_Amount_credit").val()*currencyRate;
    var c = +$("#PM_Amount_Cheque").val()*currencyRate;
    var threeTypeAmountReg = a + b + c;

//excess start
        

  $.ajax({

            url: "../Controller/checkExcess.php",
            type: "GET",
            data: "RG_Reg_NO=" + RG_Reg_NO,
	    async: false,
            success: function (res) {
		excessAmount = threeTypeAmountReg - res;


if(excessAmount == 0){

goExcessReg =true;

}
			if(excessAmount <= 0){

			excessAmount = 0;

			}

			if(excessAmount != 0){
			
			goExcessReg = confirm("There is " + excessAmount + " an excess amount, Is this OK? ");
    			
			}


		}

	});


if (goExcessReg == true) {
$("#excesspaymentId").val(excessAmount);


 var data = $("#initialsPaymentsData").serializeArray();
    data.push({
        name: "excessPayment",
        value: excessAmount
    });

data.push({

name: "currency",
value: currency

});

data.push({

name: "currencyRate",
value: currencyRate

});

//excess end
//payment master start
    $.ajax({

        url: "../Controller/paymentMaster.php",
        type: "GET",
        data: data,
        dataType: 'JSON',
       success: function (response) {

            if (!response.commitCode) {

             $('#mainAlert').removeClass('alert alert-success');
                $('#mainAlert').addClass('alert alert-error');
                $("#mainAlertInfoSelected").html(" Your payment has been saved unsuccessfully!.Try again");

            } else {


           $("#currencyJsonCallBack").val(1);

                $('#mainAlert').removeClass('alert alert-error');
                $('#mainAlert').addClass('alert alert-success');
                $("#mainAlertInfoSelected").html(" Your payment has been saved successfully!.<span style='color:fuchsia'>Wait,Payment receipt is being loading...</span>");

                $('#printPdf').modal();

                $("#modal-body-print").attr("src", "../Controller/print.php");
               
                    $("#mainAlertInfoSelected").html(", Please print <i class='icon-print'></i> this receipt");


                $('.printModalClose').on('click', function () {
                    $("#paymentArea input[type=text]").val(" ");
                    $("#modal-body-print").removeAttr("src");
                    $("#mainAlertInfoSelected").html(",Everything's Okay! <i class='icon-ok'></i> .Thank you!");
                    $('#mainAlertInfoSelected').after().html("<a class='btn btn-small btn-block btn-warnning' target='_blank' href="+response.string+"><em class='icon-fire icon-white'></em>Get the PDf</a>"); 

                });

              

            }

        }
    });
//payment master end
}//excecc true

});



//afterPayNowSubmit
$(document).off('click', "#afterPayNowSubmit");
$(document).on('click', "#afterPayNowSubmit", function (event) {

$('#regNoPayments').keypress(function(){
if($("#regNoPayments").val().length == 12){
$(this).removeClass("errorInput");
}
});


if($("#regNoPayments").val().length < 12){

$("#regNoPayments").addClass("errorInput");
$('#initialsPayments').modal('hide');
alert("Please add correct registration number");
return;
}


$('#totalPayment').keypress(function(){

$(this).removeClass("errorInput");
});

if($("#totalPayment").val() == 0){

$("#totalPayment").addClass("errorInput");
$('#initialsPayments').modal('hide');
alert("Please add your today payment");
return;
}



var oneNo = $(".oneNo").val();
var twoNo = $(".twoNo").val();
var threeNo = $(".threeNo").val();
var fourNo = $(".fourNo").val();
var RG_Reg_NO = $("#regNoPayments").val();
$("#RG_Reg_N0_Payments").val(RG_Reg_NO);

var WholeCardNumber = oneNo + twoNo + threeNo + fourNo;
$("#hiddenCreditCardNumer").val(WholeCardNumber);
event.preventDefault();

var totalPayment = parseFloat($("#totalPayment").val());
$("#PM_Amount").val(totalPayment);

var PaymentUser = $("#fullNamePayment").val();

$("#registerUserForPrint").val(PaymentUser);

var getUserBatch = $("#batchNumerPayment").val();

$("#selectedBatchForPrint").val(getUserBatch);

var RG_Date = $('#PM_Date_After_Full').val();
var RG_Branch_Code = $('#RG_Branch_Code_Session').val();


//getLastInvoiceNumber start
$.ajax({

    url: "../Controller/getLastInvoiceNumber.php",
    type: "GET",
    data: "RG_Branch_Code=" + RG_Branch_Code + "&RG_Date=" + RG_Date,
    success: function (response) {
        $('#putInvoiceNumber').val(response.InvoiceNumber);

    }



});

//getLastInvoiceNumber

$(document).off('click', "#initialsPaymentsDataSubmit");
$(document).on('click', "#initialsPaymentsDataSubmit", function (event) {

    var oneNo = $(".oneNo").val();
    var twoNo = $(".twoNo").val();
    var threeNo = $(".threeNo").val();
    var fourNo = $(".fourNo").val();
    var RG_Reg_NO = $("#regNoPayments").val();
    $("#RG_Reg_N0_Payments").val(RG_Reg_NO);
    var WholeCardNumber = oneNo + twoNo + threeNo + fourNo;
    $("#hiddenCreditCardNumer").val(WholeCardNumber);
    event.preventDefault();


    var RG_Date = $('#PM_Date_After_Full').val();
    $('#RG_Date_initial_payments').val(RG_Date);


    //var RG_Reg_N0 = $("#RG_Reg_NO").val();
    var PM_Operator = $('#RG_Operator_Session').val();
    var PM_Amount = $("#PM_Amount").val();

    var currency = $('.payingCurrency').text();
    var currencyRate = $('#currencyJsonCallBack').val();

    var af = +$("#PM_Amount_Cash").val()*currencyRate;
    var bf = +$("#PM_Amount_credit").val()*currencyRate;
    var cf = +$("#PM_Amount_Cheque").val()*currencyRate;
    var threeTypeAmountAft = af + bf + cf;




//validation part start

if(threeTypeAmountAft ==0){

alert("you haven't add the amounts");

return;
}


//validation part end

    $.ajax({

        url: "../Controller/checkExcess.php",
        type: "GET",
        data: "RG_Reg_NO=" + RG_Reg_NO,
        async: false,
        success: function (res) {
            excessAmount = threeTypeAmountAft - res;

if(excessAmount == 0){

goExcessReg =true;

}
            if (excessAmount <= 0) {

                excessAmount = 0;

            }

            if (excessAmount !== 0) {

                goExcessReg = confirm("There is " + excessAmount + " an excess amount, Is this OK? ");

            }


        }

    });

    if (goExcessReg === true) {
        $("#excesspaymentId").val(excessAmount);


        var data = $("#initialsPaymentsData").serializeArray();

        data.push({
            name: "excessPayment",
            value: excessAmount
        });

data.push({

name: "currency",
value: currency

});

data.push({

name: "currencyRate",
value: currencyRate

});



//payment master start

    $.ajax({

        url: "../Controller/paymentMaster.php",
        type: "GET",
        data: data,
        dataType: 'JSON',
        beforeSend: function () {

            //saving........
	


            $("#mainAlertInfoSelected").html(" Your payment data is being saving...Please wait.<br><div class='progress progress-striped active'><div class='bar' style='width: 40%;'></div></div>");

        },
        success: function (response) {

            if (!response.commitCode) {


                $('#mainAlert').removeClass('alert alert-success');
                $('#mainAlert').addClass('alert alert-error');
                $("#mainAlertInfoSelected").html(" Your payment has been saved unsuccessfully!.Try again");

            } else {

$("#currencyJsonCallBack").val(1);

                $('#mainAlert').removeClass('alert alert-error');
                $('#mainAlert').addClass('alert alert-success');
                $("#mainAlertInfoSelected").html(" Your payment has been saved successfully!.<span style='color:fuchsia'>Wait,Payment receipt is being loading...</span>");

                $('#printPdf').modal();

                $("#modal-body-print").attr("src", "../Controller/print.php");

                    $("#mainAlertInfoSelected").html(", Please print <i class='icon-print'></i> this receipt");


                $('.printModalClose').on('click', function () {
                    $("#paymentArea input[type=text]").val(" ");
                    $("#modal-body-print").removeAttr("src");
                    $("#mainAlertInfoSelected").html(",Everything's Okay! <i class='icon-ok'></i> .Thank you!");

                });

            }

        }
    });

//payment master end



    }
});


});

//quick payments start 

$("#QuickPayment").click(function (event) {

    event.preventDefault();

    var RG_Date = $('#QuickPM_Date_After_Full').val();
    var RG_Branch_Code = $('#QuickRG_Branch_Code_nintial_payment').val();

    //getLastInvoiceNumber start
    $.ajax({

        url: "../Controller/getLastInvoiceNumber.php",
        type: "GET",
        data: "RG_Branch_Code=" + RG_Branch_Code + "&RG_Date=" + RG_Date,
        success: function (response) {
            $('#QuickputInvoiceNumber').val(response.InvoiceNumber);

        }



    });


//reg no or id number serch 

$("#QuickregNoPayments").keyup(function (event) {

     if ($(this).val().length > 11) {




//reg number finder start

 	 $.ajax({

                url: "../Controller/currencyFind.php",
                type: "GET",
                data: "RG_Reg_NO=" + $(this).val(),
                async: false,
                dataType: 'JSON',
                success: function (response) {

// currency set start

if (response.indexOf('|') != -1) {


   $('.accsepttingCurrency').text(response.substr(0, response.indexOf('|')));

} else {

   $('.accsepttingCurrency').text('LKR');

}


// currency set end

		}

});

//reg number finder end
























        var data = $(this).val();
        $.ajax({

            url: "../Controller/afterPayments.php",
            type: "GET",
            data: "RG_Reg_NO=" + data,
            success: function (response) {
				
                if (!response) {
					
                    $("#QuickbalanceDuePayment").val("Data not provide");
                    $("#QuickuptoDateDue").val("Data not provide");

                } else {

                    $("#QuickbalanceDuePayment").val((response.RG_Final_Fee - response.RG_Total_Paid).toFixed(2));
                

                }


if(response){
                    $.ajax({

                        url: "../Controller/afterPaymentsUserDetails.php",
                        type: "GET",
                        data: "SM_ID=" + response.RG_Stu_ID,
                        success: function (response) {
                            if (response) {

                                $("#QuickregisterUserForPrint").val(response.SM_Title + " " +response.SM_First_Name + " " + response.SM_Last_Name);
                           
$("#mainAlert").show(function(){
 $("#mainAlertInfo").html(response.SM_Title + " " +response.SM_First_Name + " " + response.SM_Last_Name);

    });


   
                            }

                        }

                    });

                //subjects 

                $.ajax({

                    url: "../Controller/afterPaymentsStudentSubjects.php",
                    type: "GET",
                    data: "SS_REG_NO=" + response.RG_Reg_NO,
                    success: function (response) {

                        if (response) {
                            $("#QuickselectedBatchForPrint").val(response.SS_Batch_No);

                    }

                   }

                });

}
//quick installment



 $.ajax({

     url: "../Controller/afterPaymentsInstallment.php",
     type: "GET",
     data: "SI_Reg_No=" + data,
     success: function (response) {

         $("#quickPaymentsInstallmentControls").html(response);

         var lastInsBy = $("#afterPaymentsInstallment tr:last td:first-child").text();
var PM_Date_After_Full = $("#PM_Date_After_Full").val();
var getTodayTime = new Date(PM_Date_After_Full).getTime();

var i = parseInt(lastInsBy, 10) + 1;
var totleUpto = [];
var paidUpto = [];
 								 while (i--) {

                                if (i == 0) {
                                    break;

                                } else {
                                    
				var dueDatelastInsBy = $("#" + i + "INSDUEDATE").text();
				
								
var DatePay = new Date(dueDatelastInsBy).getTime();

if(getTodayTime >= DatePay){

var getUptoInsAmount = $("." + i + "INSAMOUNT").text();
var getPaidAmountUpTo = $("#" + i + "INSPAIDAMOUNT").text();

totleUpto.push(getUptoInsAmount);
paidUpto.push(getPaidAmountUpTo);
	}else{
		
	$("#QuickuptoDateDue").val("You don't have any updo Date Due");	
		
		}
                                }
                            }
							
							
//totle updatodate Dues							
var totalUpdateDateDues = 0;
for (var i = 0; i < totleUpto.length; i++) {
    totalUpdateDateDues += totleUpto[i] << 0;
}

//totle updatodate Dues							
var paidUpToTotal = 0;
for (var i = 0; i < paidUpto.length; i++) {
    paidUpToTotal += paidUpto[i] << 0;
}

$("#QuickuptoDateDue").val((totalUpdateDateDues - paidUpToTotal).toFixed(2));


     }

 });
//quick installment end

$('.Quickcash').on('click', function (e) {

    $("#QuickPM_Type").val('Cash');
    $(".QuickpayNow").show();
});
$('.QuickcreditCard').on('click', function (e) {
    $("#QuickPM_Type").val('Credit Card');
    $(".QuickpayNow").show();
});
$('.Quickcheque').on('click', function (e) {
    $("#QuickPM_Type").val('Cheque');
    $(".QuickpayNow").show();
});


 $('.QuickoneNo').keyup(function() {
     if(this.value.length == $(this).attr('maxlength')) {
         $('.QuicktwoNo').focus();
     }
 });

 $('.QuicktwoNo').keyup(function() {
     if(this.value.length == $(this).attr('maxlength')) {
         $('.QuickthreeNo').focus();
     }
 });

 $('.QuickthreeNo').keyup(function() {
     if(this.value.length == $(this).attr('maxlength')) {
         $('.QuickfourNo').focus();
     }
 });

}

});
}

//quick payment send
$(document).off('click', "#QuickinitialsPaymentsDataSubmit");
$(document).on('click', "#QuickinitialsPaymentsDataSubmit", function (event) {


    var oneNo = $(".QuickoneNo").val();
    var twoNo = $(".QuicktwoNo").val();
    var threeNo = $(".QuickthreeNo").val();
    var fourNo = $(".QuickfourNo").val();
    var WholeCardNumber = oneNo + twoNo + threeNo + fourNo;
    var QuickregNoPayments = $("#QuickregNoPayments").val();


    $("#QuickhiddenCreditCardNumer").val(WholeCardNumber);
    event.preventDefault();


    var RG_Date = $('#QuickPM_Date_After_Full').val();


    var data = $("#QuickinitialsPaymentsData").serializeArray();

    var PM_Operator = $('#QuickRG_Operator_Session').val();
    var PM_Amount = $("#QuickbalanceDuePayment").val();


    var currency = $('.payingCurrency').text();
    var currencyRate = $('#currencyJsonCallBack').val();

var QuickPM_Amount_Cash = +$("#QuickPM_Amount_Cash").val();
var QuickPM_Amount_credit = +$("#QuickPM_Amount_credit").val();
var QuickPM_Amount_Cheque = +$("#QuickPM_Amount_Cheque").val();

	
  $.ajax({

            url: "../Controller/checkExcess.php",
            type: "GET",
            data: "RG_Reg_NO=" + $('#QuickregNoPayments').val(),
	    async: false,
            success: function (res) {

                   $("#currencyJsonCallBack").val(1);


		excessAmount = (QuickPM_Amount_Cash + QuickPM_Amount_credit + QuickPM_Amount_Cheque) - res;

		if(excessAmount == 0){

		goExcessReg =true;

		}
			if(excessAmount <= 0){

			excessAmount = 0;

			}

			if(excessAmount != 0){
			
			goExcessReg = confirm("There is " + excessAmount + " an excess amount, Is this OK? ");
    			
			}


		}

	});

                if (goExcessReg === true) {
                    $("#excesspaymentQuickId").val(excessAmount);

    data.push({
        name: "excessPayment",
        value: excessAmount
    });

data.push({

name: "currency",
value: currency

});

data.push({

name: "currencyRate",
value: currencyRate

});

                    //quick payment master start

    $.ajax({

        url: "../Controller/paymentMaster.php",
        type: "GET",
        data: data,
        dataType: 'JSON',
        beforeSend: function () {

            //saving........


            $("#mainAlertInfoSelected").html(" Your payment data is being saving...Please wait.<br><div class='progress progress-striped active'><div class='bar' style='width: 40%;'></div></div>");

        },
        success: function (response) {

$('#mainAlert').show(function(){

            if (!response.commitCode) {

      
                $('#mainAlert').removeClass('alert alert-success');
                $('#mainAlert').addClass('alert alert-error');
                $("#mainAlertInfoSelected").html(response.errorInfo);

            } else {

           $("#currencyJsonCallBack").val(1);

                $('#mainAlert').removeClass('alert alert-error');
                $('#mainAlert').addClass('alert alert-success');
                $("#mainAlertInfoSelected").html(" Your payment has been saved successfully!.<span style='color:fuchsia'>Wait,Payment receipt is being loading...</span>");

                $("#QuickprintPdf").modal();

                $("#modal-body-printq").attr("src", "../Controller/print.php");
                $("#modal-body-print").ready(function () {
                    $("#mainAlertInfoSelected").html(", Please print <i class='icon-print'></i> this receipt");
                });

                $('.printModalClose').on('click', function () {
                    $("#paymentArea input[type=text]").val(" ");
                    $("#modal-body-printq").removeAttr("src");
                    $("#mainAlertInfoSelected").html(",Everything's Okay! <i class='icon-ok'></i> .Thank you!");

                });


            }
});

        }
    });


		//quick payment master end

                }//go excess end

     
});
//quick payment end

 });
//reg number or id number search end


 });
    //getLastInvoiceNumber
//quick paymnets end 

//checked yesterday backup is done

 $(document).off('click', '#yesIsynced');
 $(document).on('click', '#yesIsynced', function (event) {
	
	event.preventDefault();

$("#syncedStuts").html("");
    $.ajax({

            url: "../syncdb.php",
            async: false,
            success: function (response) {
            $("#syncedStuts").append(response);
            $("#syncMe").show();

}//yes ajax


});
	
	    //Synchronizing Content start..............
 $(document).off('click', '#syncMe');
    $(document).on('click', '#syncMe', function (event) {

        event.preventDefault();

        $.ajax({

            url: "../sync.php",
            async: false,
            success: function (response) {
		$("#syncedStuts").html("");
                $("#SyncDone").html(response);
            }



        });

    });

    //Synchronizing Content end...........

});


//Edit Registration start 


 $(document).off('click', '#regEditSearch');
 $(document).on('click', '#regEditSearch', function (event) {
        
        event.preventDefault();
 var RegEditData = $("#regEditSearchForm").serialize();
        $.ajax({

            url: "../Controller/editRegistration.php",
            type: "GET",
            async: false,  
            data: RegEditData,
            success: function (response) {

 	$("#regEditAlert").html(response);

            },
      complete:function(res){

$(document).off('click', '.editRegEach');
$(document).on('click', '.editRegEach', function (event) {

$("#registrationFullModal").modal('show');

event.preventDefault();

$.ajax({

            url: "../Controller/editRegistrationComment.php",
            async: false, 
            type: "GET",
	    beforeSend: function () {

            //updating...
$("#mainAlert").show();
            $("#mainAlertInfoSelected").html("Data is being updating ...Please wait.<br><div class='progress progress-striped active'><div class='bar' style='width: 40%;'></div></div>");

        },
            data: "RG_Reg_NO="+$(this).closest('tr').find('td:first-child').text()+"&regEditComment="+$(this).closest('tr').find('.RG_Special_Note').val()+"&RG_Status="+$(this).closest('tr').find('.RG_Status').val()

});

event.preventDefault();

deleteIns();

      var editRegEachData = $(this).closest('tr').find('td:first-child').text();
        $.ajax({

            url: "../Controller/editRegistrationFull.php",
            type: "GET",
            async: false,
            data: "RG_Reg_NO="+editRegEachData,
            success: function (response) {
 		$("#RG_Date").val(response['regInfo'][0].RG_Date);
		$("#RG_Reg_NO").val(response['regInfo'][0].RG_Reg_NO);
		$("#RG_Stu_ID").val(response['regInfo'][0].RG_Stu_ID);
		$("#CouserFinder").val(response['regCourse'][0].CT_Course_Code);

checkIdNumber(response['regInfo'][0].RG_Stu_ID);
$("#mainAlertInfoSelected").html(" ");
////////set fullPayYes Now Start////////////////////

if(parseFloat(response['regInfo'][0].RG_Final_Fee) <= parseFloat(response['regInfo'][0].RG_Total_Paid)){

  //$("#fullPayInput").show();
  //$("#Installments").hide();
 //$(".fullPayYes").prop('checked', true);
 //$(".fullPayNo").prop('disabled', true);

var percentageFull = (parseFloat(response['regInfo'][0].RG_Final_Fee) + parseFloat(response['regInfo'][0].RG_FullPay_Dis_Amount)).toFixed(2) /parseFloat(response['regInfo'][0].RG_FullPay_Dis_Amount); 

$("#RG_FullPay_Dis_Amount_Select").val(percentageFull);

$("#RG_Total_Fee_Final").val(response['regInfo'][0].RG_Final_Fee);
}else{

 //$(".fullPayNo").prop('checked', true);

//$(".fullPayYes").click(function(){

//$("#Installments").hide();
//$("#fullPayInput").show();
//});

var percentageFull = (parseFloat(response['regInfo'][0].RG_Final_Fee) + parseFloat(response['regInfo'][0].RG_FullPay_Dis_Amount)).toFixed(2) /parseFloat(response['regInfo'][0].RG_FullPay_Dis_Amount); 

$("#RG_FullPay_Dis_Amount_Select").val(percentageFull);

$("#RG_Total_Fee_Final").val(response['regInfo'][0].RG_Final_Fee);

}

//////////////Set FullPay Yes No End /////////////// 

	deleteIns();	

	$("#RegTypeSelectList").html("<select name='CT_Type_Code' id='RegType'><option value"+response['regInfo'][0].RG_Reg_Type+">"+ response['regInfo'][0].RG_Reg_Type+"</option></select>");
        
 //edit batch sorting start 

        $.ajax({

            url: "../Controller/batchSorting.php",
            type: "GET",
	    async: false,
            data: "CT_Type_Code="+response['regInfo'][0].RG_Reg_Type+"&CT_Course_Code="+response['regCourse'][0].CT_Course_Code,
	    success:function(res){
            $("#batchMasterSet").html(res);
	$("#alreadyBatchSorting").val(response['regSub'][0].SS_Batch_No);
 $("#CT_No_Of_SubjectsCount").val(response['regCourse'][0].CT_No_Of_Subjects);



            }

});
//edit batch sorting end 




//subjects start

$.ajax({

    url: "../Controller/subjects.php",
    type: "GET",
    data: "CT_Course_Code=" + response['regCourse'][0].CT_Course_Code,
    success: function(subjects) {


        var size = subjects.filter(function(value) {
            return value !== undefined
        }).length;
        for (var i = 0; i < size; i++) {
            $("#subjectsTable tr:last").after("<tr class='info' data-index=" + subjects[i].S_Code + "><td><input type='checkbox' class='selectedSubjects' name='selectedSubjects' /></td><td class='selectedSCode'>" + subjects[i].S_Code + "</td><td class='selectedSName'>" + subjects[i].S_Name + "</td></tr>");

        }

//keep subjects checked if it selected previous start

var findRow = [];
$(".success").each(function(){

findRow.push($(this).closest("tr").attr("data-index"));

});


$(".info").each(function(){

var getPos = findRow.indexOf($(this).closest("tr").attr("data-index"));

$("#subjectsTable tr[data-index='" + findRow[getPos] + "']").find('.selectedSubjects').prop('checked', true);

});


//keep subjects checked if it selected previous end



//select subjects start

$("#subjectsTable").off('change', '.selectedSubjects');
$("#subjectsTable").on('change', '.selectedSubjects', function (event) {
    event.preventDefault();


    var selectedReg = $('#CouserFinder option:selected').val();
    var selectedCouse = $('#CouserFinder').val();
    var selectedBatch = $('#alreadyBatchSorting option:selected').val();

    $('#mainAlertInfoSelected').text(" You just selected " + selectedBatch + " batch ");

    var selectedBatchcDate = $('#alreadyBatchSorting option:selected').attr('data-commence-date');
    var selectedBatcheDate = $('#alreadyBatchSorting option:selected').attr('data-end-date');
    var selectedBatchInsDays = $('#alreadyBatchSorting option:selected').attr('data-ins-days');

    
        
        if ($(this).is(":checked")) {
            var indexChecked = $(this).closest("tr").attr("data-index");
            var selectedSCode = $(this).closest("tr").find(".selectedSCode").text();

            $('#mainAlertInfoSelected').text(" You just selected " + selectedSCode + " subject ");

            $("#selectesSubjectsRecodes tr:last").after("<tr class='success' id=" + selectedCouse + selectedSCode + " data-index=" + indexChecked + "><td>" + selectedReg + "</td><td>" + selectedCouse + "</td><td>" + selectedSCode + "</td><td class='selectedBatch' data-ins-days=" + selectedBatchInsDays + " data-end-date=" + selectedBatcheDate + " data-commence-date=" + selectedBatchcDate + ">" + selectedBatch + "</td></tr>");
            $('[id]').each(function (i) {
                var ids = $('[id="' + this.id + '"]');
                if (ids.length > 1) {
                    $('[id="' + this.id + '"]:gt(0)').remove();
                }
            });
        } else {
            var indexAdded = $(this).closest("tr").attr("data-index");
            var findRow = $("#selectesSubjectsRecodes tr[data-index='" + indexAdded + "']");
            findRow.remove();
        }
   
});

//select subjects end

    }
});


for(var i=0 ; i < response['regSub'].length; i++ ){



$("#selectesSubjectsRecodes tr:last").after("<tr class='success' data-index=" + response['regSub'][i]['SS_Subject'] + "  id=" + response['regCourse'][0].CT_Course_Code + response['regSub'][i]['SS_Subject'] + "><td>" + response['regInfo'][0].RG_Reg_Type + "</td><td>" + response['regInfo'][0].RG_Reg_Type + "</td><td>" + response['regSub'][i]['SS_Subject'] + "</td><td data-commence-date='' data-end-date='' data-ins-days='' class='selectedBatch'>" + response['regSub'][i]['SS_Batch_No'] + "</td></tr>");

}

//subjects end


$(".selectedBatch").each(function(index){

    var $that = $(this);
    var batchCode = $that.text();

//edit batch attr start 

        $.ajax({

            url: "../Controller/getBatchAttr.php",
            type: "GET",
            async: false, 
            data: {BM_Course_Code: batchCode},
	    success:function(resBatch){


$that.attr("data-commence-date",resBatch.BM_Commence_Date);
$that.attr("data-end-date",resBatch.BM_End_Date);
$that.attr("data-ins-days",resBatch.BM_Ins_Days);



            }

});
//edit batch attr end 

});

//fee structure start 

$.ajax({

     url: "../Controller/feeStructure.php",
     type: "GET",
     async: false,
     data: "FS_Reg_Type=" + response['regInfo'][0].RG_Reg_Type,
     success: function(resp) {

        $("#RG_Fee_Structure").html(resp);

        $("#fsCourseSet").val(response['regInfo'][0].RG_Fee_Structure);


         getAccseptingCurrency(response['regInfo'][0].RG_Fee_Structure);


     }

});


//fee structure end


//discount plan start

                $.ajax({

                 url: "../Controller/discountplan.php",
                 type: "GET",
                 async: false,
                 data: "DT_Reg_Type=" + response['regInfo'][0].RG_Reg_Type,
                 success: function(respo) {
                $("#discountPlanSet").html(respo);
               $("#discountPlan").val(response['regInfo'][0].RG_Discount_Plan);
		}
		

});

//discount plan,Reg Fee,Gross fee end

//discount comment start 

$("#RG_Dis_Comment").val(response['regInfo'][0].RG_Dis_Comment);
$("#RG_Reg_Fee").val(response['regInfo'][0].RG_Reg_Fee);
$("#FS_Price").val(response['regInfo'][0].FS_Price);
$("#FS_Price").val(response['regInfo'][0].RG_Total_Fee);
$("#DP_Rate_Input").val(response['regInfo'][0].RG_Dis_Amount); 
$("#RG_Total_Fee").val((parseFloat(response['regInfo'][0].RG_Final_Fee) + parseFloat(response['regInfo'][0].RG_FullPay_Dis_Amount)).toFixed(2));
$("#RG_Total_Paid").val(response['regInfo'][0].RG_Total_Paid); 
regTotalPaidAmount = response['regInfo'][0].RG_Total_Paid;

//discount plan,Reg Fee,Gross fee end 




deleteIns();



//////////////////////////////////////////////////discount plane select start/////////////////////

                     $(document).off('change', '#discountPlan');
                     $(document).on('change', '#discountPlan', function (event) {


                         $("#installmentsViewFirstTr").nextAll().remove();

                         $("#DP_Rate_Input").val("");
                         $("#RG_Total_Fee").val("");
                         $("#RG_Dis_Comment").val("");
                         $("#RG_Total_Fee_Final").val("");
                         var data = $('#fsCourseSet option:selected').val();

                         //registration fee start
                         $.ajax({

                             url: "../Controller/regFeeAndgrossFee.php",
                             type: "GET",
                             data: "FS_Code=" + data,
                             success: function (response) {

                                 $("#RG_Reg_Fee").val(response.regFee);
                                 //Gross fee start
                                 $("#FS_Price").val(response.grossFee);
                                 //Gross  fee end
                                 //net fee
                                 $("#RG_Total_Fee").val(response.netFee);

                                 var INSNO = "INSNO";
                                 var INS = "INS";
                                 var DUE = "DUE";
				 var PAID = "PAID";
                                 var size = response.installment.filter(function (value) {
                                     return value !== undefined;
                                 }).length;
                                 for (var i = 0; i < size; i++) {
                                     $("#installmentsView tr:last").after("<tr class='info' data-index=" + (i + 1) + "><td class=" + (i + 1) + INSNO + ">" + response.installment[i].FI_Ins_NO + "</td><td class=" + (i + 1) + INS + ">" + response.installment[i].FI_Ins_Amount + "</td><td class=" + (i + 1) + DUE + "></td><td class=" + (i + 1) + PAID + "></td><td><button type='button'  class='btn btn-small btn-danger deleteIns'>Delete</button></td><td><button type='button'  class='btn btn-small btn-info editIns'>Edit</button></td></tr>");

                                 }




                                 var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

                                 dueDateAndInsRoalBack();



                                 //discount form start...........
                                 var data = $('#discountPlan option:selected').val();
$("#mainAlertInfoSelected").html(" You just selected " +data+	" discount Plan.We just updated installments");

                                 if (data != "special") {
                                     $.ajax({

                                         url: "../Controller/discount.php",
                                         type: "GET",
                                         data: "DP_Code=" + data,
                                         success: function (response) {

                                             var regFee = parseInt($("#RG_Reg_Fee").val(), 10);
                                             var grossFee = parseInt($("#FS_Price").val(), 10);

                                             if (!response) {
                                                 alert("There are no discount changes for given plan");

                                             } else {

                                                 if (response.DP_Type == "Percentage") {
                                                     var discountRate = response.DP_Rate / 100;
                                                     var dicountForGrossFee = grossFee * discountRate;
                                                     $("#RG_discountRate_hidden,#DP_Rate_Input").val(dicountForGrossFee.toFixed(2));
                                                     var deduct = grossFee - dicountForGrossFee;

                                                     var total = deduct + regFee;
                                                     $("#RG_Total_Fee").val(total.toFixed(2));
                                                 } else {

                                                     var discountRate = response.DP_Rate;
                                                     $("#RG_discountRate_hidden,#DP_Rate_Input").val(discountRate);
                                                     var deduct = grossFee - discountRate;

                                                     var total = deduct + regFee;
                                                     $("#RG_Total_Fee").val(total.toFixed(2));
                                                     var dicountForGrossFee = parseInt($("#RG_discountRate_hidden").val(), 10);

                                                 }


                                                 //var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

                                                 var i = parseInt(insEndCount, 10) + 1;
                                                 while (i--) {

                                                     if (i == 0) {
                                                         break;

                                                     } else {
                                                         var amountByLast = parseInt($('td.' + i + 'INS').text(), 10);
                                                         if (dicountForGrossFee >= amountByLast) {
                                                             var dicountForGrossFee = dicountForGrossFee - amountByLast;

                                                             $('td.' + i + 'INS').closest("tr").remove();

                                                             $('td.' + i + 'INS').text(dicountForGrossFee.toFixed(2));
                                                         } else {

                                                             var dicountForGrossFee = amountByLast - dicountForGrossFee;


                                                             $('td.' + i + 'INS').text(dicountForGrossFee.toFixed(2));
                                                             break;
                                                         }
                                                     }
                                                 }



                                             }

                                         } //success response end

                                     }); //discount form end...........
                                 } else {
                                    

                                     $("#loginAuthentication").modal();

				     $("#letMeOkThisDiscount").off('click');
                                     $("#letMeOkThisDiscount").on('click',function (event) {
          event.preventDefault();

     var username = $("#loginAuthenticationSpecialDiscountUser").val();
     var password = $("#loginAuthenticationSpecialDiscountPass").val();

     //special validation start
     if (username.length <= 2) {
         alert("Please enter valid username");
         return;
     }

     if (password.length <= 2) {
         alert("Please enter valid password");
         return;
     }


     if ($("#discount_from_admin").val().length == 0) {
         alert("Please enter valid discount");
         return;
     }
     //special validation end
                                         $.ajax({

                                             url: "../Controller/loginAuthentication.php",
                                             type: "post",
					     async:false,
                                             data: "userNameSpecial=" + username + "&passWordSpecial=" + password,
                                             success: function (response) {
						
						if(response == false){
						alert("Try again");
						return;
						}
                                                 if (response) {
$("#RG_Dis_Comment").addClass("errorInput");
$("#RG_Dis_Comment").val("Please enter a comment!");
$("#installmentsViewFirstTr").nextAll().remove();
if ($('#discount_from_admin_percentage').is(':checked')) {
	$("#installmentsViewFirstTr").nextAll().remove();
	var courseFeeForspecialdis = $("#FS_Price").val();
	var percentageSpecial = parseFloat($("#discount_from_admin").val() / 100);
	var dispercetageValue = courseFeeForspecialdis * percentageSpecial;
	$("#discount_from_admin_hidden").val(dispercetageValue);
	specialDicount = parseInt($("#discount_from_admin_hidden").val(), 10);
	var gorssFeeyet = parseInt($("#FS_Price").val(), 10);
	var regFeeyet = parseInt($("#RG_Reg_Fee").val(), 10);
	var netTotalFinal = (gorssFeeyet - specialDicount) + regFeeyet;
	$("#RG_Total_Fee").val(netTotalFinal.toFixed(2));
}
if ($('#discount_from_admin_value').is(':checked')) {
	$("#installmentsViewFirstTr").nextAll().remove();
	var disValueValue = parseFloat($("#discount_from_admin").val());
	$("#discount_from_admin_hidden").val(disValueValue);
	specialDicount = parseInt($("#discount_from_admin_hidden").val(), 10);
	var gorssFeeyetV = parseInt($("#FS_Price").val(), 10);
	var regFeeyetV = parseInt($("#RG_Reg_Fee").val(), 10);
	var netTotalFinalV = (gorssFeeyetV - specialDicount) + regFeeyetV;
	$("#RG_Total_Fee").val(netTotalFinalV.toFixed(2));
}
                    $("#loginAuthentication").modal('hide');

                                                     var specialDicount = parseFloat($("#discount_from_admin_hidden").val());

                                                     $("#DP_Rate_Input").val(specialDicount.toFixed(2));

                                                     $("#installmentsViewFirstTr").nextAll().remove();

                                                     // special discount calculate start


                                                     var data = $('#fsCourseSet option:selected').val();
                                                     $.ajax({

                                                         url: "../Controller/regFeeAndgrossFee.php",
                                                         type: "GET",
                                                         data: "FS_Code=" + data,
                                                         success: function (response) {

                                                             var INSNO = "INSNO";
                                                             var INS = "INS";
                                                             var DUE = "DUE";
							     var PAID = "PAID";
                                                             var size = response.installment.filter(function (value) {
                                                                 return value !== undefined;
                                                             }).length;
                                                             for (var i = 0; i < size; i++) {
                                                                 $("#installmentsView tr:last").after("<tr class='info' data-index=" + (i + 1) + "><td class=" + (i + 1) + INSNO + ">" + response.installment[i].FI_Ins_NO + "</td><td class=" + (i + 1) + INS + ">" + response.installment[i].FI_Ins_Amount + "</td><td class=" + (i + 1) + DUE + "></td><td class=" + (i + 1) + PAID + "></td><td><button type='button'  class='btn btn-small btn-danger deleteIns'>Delete</button></td><td><button type='button'  class='btn btn-small btn-info editIns'>Edit</button></td></tr>");

                                                             }




                     var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

                           dueDateAndInsRoalBack();

                                                             var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');

                                                             var specialDicount = parseFloat($("#DP_Rate_Input").val());

                                                             var i = parseInt(insEndCount) + 1;
                                                             while (i--) {

                                                                 if (i == 0) {
                                                                     break;

                                                                 } else {
                                                                     var amountByLast = parseInt($('td.' + i + 'INS').text());
                                                                     if (specialDicount >= amountByLast) {
                                                                         var specialDicount = specialDicount - amountByLast;
                                                                         $('td.' + i + 'INS').closest("tr").remove();

                                                                         $('td.' + i + 'INS').text(specialDicount.toFixed(2));
                                                                     } else {
                                                                         var specialDicount = amountByLast - specialDicount;
                                                                         $('td.' + i + 'INS').text(specialDicount.toFixed(2));
                                                                         break;
                                                                     }
                                                                 }
                                                             }



                                                             /// special discount calculate end


                                                         }

                                                     });



                                                 }

                                             }



                                         });




                                     });



                                 } //special else end
                             }

                         });

                         //registration fee end
                     });

///////////////////////////////////discount plan select end////////////////////////////////////



//installment start 

  $.ajax({

                    url: "../Controller/editInstallment.php",
                    type: "GET",
                    async: false,
                    data: "RG_Reg_NO=" + response['regInfo'][0].RG_Reg_NO,
                    success: function (response) {
    


         var INSNO = "INSNO";
         var INS = "INS";
         var DUE = 'DUE';
	 var PAID = 'PAID';
         var size = response.filter(function(value) {
             return value !== undefined;
         }).length;


         for (var i = 0; i < size; i++) {
             $("#installmentsView tr:last").after("<tr class='info dueDateTr' data-index=" + (i + 1) + "><td class=" + (i + 1) + INSNO + ">" + response[i].SI_Ins_NO + "</td><td class=" + (i + 1) + INS + ">" + response[i].SI_Ins_Amount + "</td><td class="+ (i + 1) + DUE + ">"+response[i].SI_Due_Date+"</td><td class="+ (i + 1) + PAID + ">"+response[i].SI_Paid_Amount+"</td><td><button type='button'  class='btn btn-small btn-danger deleteIns'>Delete</button></td><td><button type='button'  class='btn btn-small btn-info editIns'>Edit</button></td></tr>");

         }


         var insCount = $("#fsCourseSet option:selected").attr('data-installmentsCount');



installmentEditing();

deleteIns();
         }

});

//installment end


            }//editReg success end

	});

});

     }

        });



});


//User Registration form start...........

$("#editRegFullNow").click(function (event) {

var nullVlue = $("#CouserFinder").val();


var disPlanCheck = $('#discountPlan option:selected').val();
var getFsCourseSelected = $("#fsCourseSet option:selected").val();
if(disPlanCheck == "special"){
	  
	 $("#RG_Dis_Comment").addClass("errorInput");
        var disCommentRestriced = $("#RG_Dis_Comment").val();


	 if(disCommentRestriced == "Please enter a comment!"){
        alert("Please enter a comment!");
         return;
			 
	}
	 
}

		if(getFsCourseSelected == " " ){
                alert("Please select a Fee Structure");
 		return;

		}


	
	var getEmptyId = $("#RG_Stu_ID").val();
	
		if(getEmptyId == 0) {
		
		alert("Please enter an ID Number");
         return;
	}
	
	var getEmptyCourse = $("#CouserFinder option:selected").val();
		if(getEmptyCourse == " ") {
		
		alert("Please select a course");
         return;
	}

          var RegTypenullVlue = $("#RegType").val();

		if(RegTypenullVlue == " " ){

                alert("Please select a registration type");
 		return;

		}

	var getEmptyCourse = $("#CouserFinder").val();

		if(getEmptyCourse == " ") {
		
		alert("Please select a course");
         return;
	}

if(nullVlue != " "){

    var RG_Date = $('#RG_Date').val();
    var RG_Date = $('#PM_Date_After_Full').val();
    var RG_Branch_Code = $('#RG_Branch_Code_Session').val();

    var selectedBatchForPrint = $('#alreadyBatchSorting option:selected').val();
    $('#selectedBatchForPrint').val(selectedBatchForPrint);

    var registerUserForPrint = $("#mainAlertInfo").text();
    $("#registerUserForPrint").val(registerUserForPrint);

    if ($('.fullPayYes').is(':checked')) {

        var RG_Final_Fee = parseFloat($("#RG_Total_Fee_Final").val());
     
     //set max attr for the cash and credit 

     $("#PM_Amount_Cash").attr("max", RG_Final_Fee);


        $("#PM_Amount").val(RG_Final_Fee.toFixed(2)).prop('disabled', true);
    } else {

        $("#PM_Amount").val(parseFloat($(".1INS").text())).prop('disabled', true);
        var RG_Final_Fee = $('#RG_Total_Fee').val();

    //set max attr for the cash and credit 

     $("#PM_Amount_Cash").attr("max", parseFloat($(".1INS").text()));

    }


    var RG_Branch_Code = $('#RG_Branch_Code_Session').val();
    var RG_Reg_NO = $("#RG_Reg_NO").val();
    var RG_Stu_ID = $("#RG_Stu_ID").val();
    var RG_Reg_Type = $('#RegType').val();
    var RG_Fee_Structure = $('#fsCourseSet').val();
    var couponCode = $('#couponCode').val();
    var RG_Discount_Plan = $('#discountPlan option:selected').val();
    var RG_Total_Fee = $('#FS_Price').val();
    var RG_Reg_Fee = $('#RG_Reg_Fee').val();
    var RG_FullPay_Dis_Amount = $('#RG_FullPay_Dis_Amount_hidden').val();
    var RG_Dis_Amount = $('#DP_Rate_Input').val();
    var RG_Dis_Comment = $('#RG_Dis_Comment').val();
    var RG_Operator = $('#RG_Operator_Session').val();
    var RG_Date = $('#RG_Date').val();
    var RG_Total_Paid = $('#RG_Total_Paid').val();
    var SI_Reg_No = $("#RG_Reg_NO").val();
    var updateInsCount = $("#installmentsView tr:last td:first-child").text();
    var SI_Paid_Amount = "NULL";
    var SI_Paid_Date = $('#RG_Date').val();
    var studentRegisterArray=[];
    var getfullRegData='';

studentRegisterArray.push({ name: "RG_Branch_Code", value: RG_Branch_Code });
studentRegisterArray.push({ name: "RG_Reg_NO", value: RG_Reg_NO });
studentRegisterArray.push({ name: "RG_Stu_ID", value: RG_Stu_ID });
studentRegisterArray.push({ name: "RG_Reg_Type", value: RG_Reg_Type });
studentRegisterArray.push({ name: "RG_Fee_Structure", value: RG_Fee_Structure });
studentRegisterArray.push({ name: "RG_Discount_Plan", value: RG_Discount_Plan });
studentRegisterArray.push({ name: "RG_Total_Fee", value: RG_Total_Fee });
studentRegisterArray.push({ name: "RG_Final_Fee", value: RG_Final_Fee });
studentRegisterArray.push({ name: "RG_Reg_Fee", value: RG_Reg_Fee });
studentRegisterArray.push({ name: "RG_Total_Paid", value: RG_Total_Paid });
studentRegisterArray.push({ name: "RG_FullPay_Dis_Amount", value: RG_FullPay_Dis_Amount });
studentRegisterArray.push({ name: "RG_Dis_Amount", value: RG_Dis_Amount });
studentRegisterArray.push({ name: "RG_Dis_Comment", value: RG_Dis_Comment });
studentRegisterArray.push({ name: "RG_Operator", value: RG_Operator });
studentRegisterArray.push({ name: "RG_Date", value: RG_Date });
studentRegisterArray.push({ name: "couponCode", value: couponCode });
studentRegisterArray.push({ name: "Default_Batch", value: $('#alreadyBatchSorting option:selected').val() });


//paid column update 

var studentInstallmentsArray=[];
var paidAmount = $('#RG_Total_Paid').val();

$('#installmentsView .info').each(function (index) {

    var amount = parseFloat($(this).closest("tr").find("td:nth-child(2)").text());
    var SI_Due_Date = $(this).closest("tr").find("td:nth-child(3)").text();

    //if money left
     if (amount < paidAmount) {
        paying = amount;
        paidAmount -= amount;
    //there no money left
    } else {
        paying = paidAmount;
        paidAmount -= paying;
    }


 studentInstallmentsArray.push(index + 1, amount , SI_Due_Date, paying);   
});

//end


	 studentRegisterArray.push({ name : "installments", value: studentInstallmentsArray });
		
            var studentSubjectsArray=[];
            var selectesSubjectsRecodes = $("#selectesSubjectsRecodes").find("tr").length;
            var realSubjectsSet = selectesSubjectsRecodes - 1;
            for (var i = 1; i <= realSubjectsSet; i++) {
                var countSet = i + 1;
                var SS_Subject = $("#selectesSubjectsRecodes tr:nth-child(" + countSet + ") td:nth-child(3)").text();
                var SS_Batch_No = $("#selectesSubjectsRecodes tr:nth-child(" + countSet + ") td:last").text();

 studentSubjectsArray.push(SS_Batch_No,SS_Subject);
    

            }

            studentRegisterArray.push({ name : "subjects", value: studentSubjectsArray });

    

    $.ajax({

        url: "../Controller/fullUserRegistrationEdit.php",
        type: "GET",
        async: false,
        beforeSend: function () {
         
     //saving........

   $("#mainAlertInfoSelected").html(" Your registration data is being saving...Please wait.<br><div class='progress progress-striped active'><div class='bar' style='width: 40%;'></div></div>");

        },
        data:studentRegisterArray,
        dataType:'JSON',
        success: function (response) {

/////error hadling //////

         if(!response.commitCode){
		$('#mainAlert').removeClass('alert alert-success');
		$('#mainAlert').addClass('alert alert-error');
		$('#mainAlertInfoSelected').html("<br/> ERROR: "+response.errorInfo);
		$("#initialsPayments").modal("hide");
		}else{
                $("#initialsPayments").modal();
                $('#mainAlert').removeClass('alert alert-error');
		$('#mainAlert').addClass('alert alert-success');
		 $('#mainAlertInfoSelected').html(" This Registration updated successfully");
                
		}


}





    });

} //if CouserFinder not set end
else{

alert("you have missed smoething!");
}

});
//User registration form end...........


//Edit Registration End 


$(document).ajaxStop(function () {
$("#loader").hide();
});


});
