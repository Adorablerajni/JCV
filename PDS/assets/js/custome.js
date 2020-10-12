$(document).ready(function(){
    $('.get_otp').hide();
     $("#sign_up").validate({
        rules: {
            "full_name": {
                required:true,
            },
            // "last_name": {
            //     required:true,
            // },
            "user_email": {
                required:true,
            },
            "user_phone": {
                required:true,
                digits:true,
                minlength:10,
                maxlength:10,
            },
            "user_password": {
                required:true,

            },
            "user_cpassword": {
                required:true,
                equalTo:'#user_password',
            }
        },
        messages: {
             "full_name": {
                required:"* Please Enter First Name",
            },
            // "last_name": {
            //     required:"* Please Enter Last Name",
            // },
            "user_email": {
                required:"* Please Enter Email",
            },
            "user_phone": {
                required:"* Please Enter Mobile",
                digits:"* Please Enter Digits",
                minlength:"* Only 10 Digits",
                maxlength:"* Maximum 10 Digits"
            },
            "user_password": {
                required:"* Please Enter Password",

            },
            "user_cpassword": {
                required:"* Please Enter Confirm Password",
                equalTo:"* Please Enter Same as Password"
            }
        },
        errorPlacement: function(error, element) { 
            error.insertAfter( element ); 
        } ,
        submitHandler: function (form) { // for demo
             var full_name = $('#full_name').val();
            // var l_name = $("#last_name").val()
             var email = $("#user_email").val()
             var phone = $("#user_phone").val()
             var password = $("#user_password").val()
             var url = $("#url").val()
             $.ajax({
                    url: url, // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'get_request':'signup_user','full_name':full_name,'email':email,'phone':phone,'password':password}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {
                        //  console.log(response);
                        var data = $.parseJSON(response);
                        if (data.flag == 0 ) {
                            $('.msg').html();
                            $('.msg').html('<div class="alert alert-danger">'+data.message+'</div>');
                            

                        }else{
                        	// $('.not_otp').hide();
                         //    $('.get_otp').show();
                         //    $('#session_id').val(data.session_id);
                            $('.msg').html();
                            $('.msg').html('<div class="alert alert-success">'+data.message+'</div>');
                            // document.getElementById('sign_up').reset();

                        }
                        //alert(data.status);
                    }                            
                });
            }
    }); 
    $("#sign_in").validate({
        rules: {            
            "user_email": {
                required:true,
            },
            
            "user_password": {
                required:true,

            }
          
        },
        messages: {             
            "user_email": {
                required:"* Please Enter Email",
            },
            
            "user_password": {
                required:"* Please Enter Password",

            }
        },
        errorPlacement: function(error, element) { 
            error.insertAfter( element ); 
        } ,
        submitHandler: function (form) { // for demo
             
             var email = $("#user_email").val()          
             var password = $("#user_password").val()
             var url = $("#url").val()
             $.ajax({
                    url: url, // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'get_request':'signin_user','email':email,'password':password}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {
                        //  console.log(response);
                        var data = $.parseJSON(response);
                        if (data.flag) {
                        	window.location.href = data.url;

                        }else{
                        	$('.msg').html();
                        	$('.msg').html('<div class="alert alert-danger">'+data.message+'</div>');

                        }
                        //alert(data.status);
                    }                            
                });
            }
    }); 
    /*Add URL*/
    $("#add_url_form").validate({
        rules: {            
            "url_title": {
                required:true,
            },
            
            "url_link": {
                required:true,

            }
          
        },
        messages: {             
            "url_title": {
                required:"* Please Enter URL Title",
            },
            
            "url_link": {
                required:"* Please Enter URL Link",

            }
        },
        errorPlacement: function(error, element) { 
            error.insertAfter( element ); 
        }
    }); 
    $(document).on('click','#verify_button',function(){
        var url = $("#url").val();
        var user_Otp = $("#user_Otp").val()
        var session_id = $("#session_id").val()
        $.ajax({
            url: url, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: {'get_request':'verify','user_Otp':user_Otp,'session_id':session_id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function(response)   // A function to be called if request succeeds
            {
                //  console.log(response);
                var data = $.parseJSON(response);
                if (data.flag) {
                    window.location.href = data.url;

                }else{
                    $('.msg').html();
                    $('.msg').html('<div class="alert alert-danger">'+data.message+'</div>');

                }
                //alert(data.status);
            }                            
            });
    });

});
