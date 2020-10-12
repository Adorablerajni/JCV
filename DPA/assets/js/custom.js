$(document).ready(function(){
	// set city asper state
	var url = $('#url').val();
	var state_code = $('#location_state_name').val();
	alert(url);
	$.ajax({
        url: url, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {'get_city':row,'state_code':state_code}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        success: function(response)   // A function to be called if request succeeds
        {
            //  console.log(response);
           /* var data = $.parseJSON(response);
            if (data.status) {
                $('#get_row').css('display','none');
                $('#add_data').html(data.table);
            }*/
            //alert(data.status);
        }                            
    });

	$(document).on('change','#location_state_name',function(){
		alert();
	});

});