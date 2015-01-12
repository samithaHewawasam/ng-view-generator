/* ===========================================================
 * ===========================================================
 * ===========================================================
 * Pre Defined Functions Start....
 * ===========================================================
 * ===========================================================
 * ===========================================================*/
function AjaxFun(Url, Data) {
    return $.ajax({
        url: Url,
        type: "POST",
        data: Data
    });
}
function ClearPage(){
$('#LookupResults').html('');
$('#OtherRegistrations').html('');
$('#ProfilePic').hide();	
$('.marquee').show();
$('#RegID').focus();



}
function SendData(Data,sound){
var myVar;
AjaxFun('Controller/lookup.php', Data).done(function (json) {
					$('#RegID').val('').focus();
											
					var obj = JSON.parse(json);
					$('#LookupResults').html(obj.Tableone);
					$('#OtherRegistrations').html(obj.TableTwo);
					$('#ProfilePic').show();
					$('.marquee').hide();
		if(obj.Status!='Blocked'){
sound.pause();
clearTimeout(myVar);
	myVar=setTimeout(function(){
					ClearPage();	

						},15000);
		}else
		{
		clearTimeout(myVar);
        sound.play();
	
		
		}

                });	
}

/* ===========================================================
 * ===========================================================
 * ===========================================================
 * Document . Ready Start....
 * ===========================================================
 * ===========================================================
 * ===========================================================*/
$(document).ready(function () {


function doSync() {
			    //sync part
        $.ajax({

            url: "Controller/post.php",
            dataType:'JSON',

			complete: function(res) {
                   
			setTimeout(doSync,3000); 
   			}
        });
}


 
//doSync();




var sound = new Audio('library/SoundClips/alarm.ogg');   
 $('#FindReg').click( function(event){
$('#FindRegFormDiv').modal();
										});
 $(document).bind('keyup keypress', function(event){
var key=event.which;							   
if(key == 113 ) {
	//F2
	event.preventDefault();
$('#FindRegFormDiv').modal().css( {'top':80});
$('#CheckStudentResDiv').html('');
 $('#CheckStudentForm').submit( function(event){
event.preventDefault();
	 AjaxFun('Controller/StudentSearch.php', $('#CheckStudentForm').serializeArray()).done(function (result) {
$('#CheckStudentResDiv').html(result);
//Load Registration from Button
 $('.btn-mini').click( function(event){
	event.preventDefault();	
	 SendData({RegNo:$(this).attr('reg')},sound);
	 $('#FindRegFormDiv').modal('hide');
	})							



});
	 });

}
else if(key == 43 )
{
	//+
event.preventDefault();
	 AjaxFun('Controller/lookup.php', {'ReAttendance':$('#AllowReg').attr('ThisReg')}).done(function (result) {ClearPage();
});

}
else if(key == 42 )
{
//*
event.preventDefault();
ClearPage();	
}
										
										});


$('#RegID').focus();
//Load Registration from Barcode
 $('#LookUpFromSubmit').click( function(event){
	event.preventDefault();	
	var data_save = $('#LookUpForm').serializeArray();
	
	 SendData(data_save,sound);
										
										})							

	
	
 $(document).on('click','#DisAllowReg',function(event){
	event.preventDefault();	
	ClearPage();	
										});
										
 $(document).on('click','#AllowReg', function(event){
	event.preventDefault();	
	 AjaxFun('Controller/lookup.php', {'ReAttendance':$(this).attr('ThisReg')}).done(function (result) {ClearPage();
});
										
										});
 // $(document).ready end		
}); 
