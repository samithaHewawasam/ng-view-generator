//sync start 

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


 if($('#getLocalhost').val() == '127.0.0.1'){

   doSync();

}


//sync end


