<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login | Mercure DPA</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
<br /><br />
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Mercure<b>DPA</b></a>
            <small>The product of Mercure</small>
        </div>
        <div class="card">
            <div class="body">
                    <div class="row clearfix ">  
                        <div class="text-center text_div">
                            <a data-url="<?php echo base_url(); ?>Masters/company_list" data-type="masters" class="check_input">COMMON</a>                            
                        </div>
                        <br>
                                         
                    </div>
                    <div class="row clearfix ">  
                        <div class="text-center text_div">
                            <a data-url="<?php echo base_url(); ?>Purchase/purchase_list" data-type="purchase" class="check_input"> ACCOUNTS</a>                            
                        </div>
                        <br>
                                         
                    </div>
                    <div class="row clearfix "> 
                        <div class="text-center text_div">                   
                            <a data-url="<?php echo base_url(); ?>Dashboard/dashboard" data-type="pricing" class="check_input"> DPA</a>
                        </div>  
                        <br>
                    </div>
                    <div class="row clearfix ">
                         <div class="text-center text_div"> 
                            <a data-url="<?php echo base_url(); ?>Dashboard/dashboard" data-type="dispatch" class="check_input" >  DISPATCH</a>
                         </div>
                         <br>
                    
                    </div>
                    <div class="row clearfix">
                         <div class="text-center text_div"> 
                            <a data-url="<?php echo base_url(); ?>Dashboard/dashboard" data-type="outstanding" class="check_input"> OUTSTANDING</a>
                        </div> 
                         <br>                       
                    </div>

                    <div class="row clearfix ">
                         <div class=" text-center text_div"> 
                            <a data-url="<?php echo base_url(); ?>Dashboard/dashboard" data-type="dashboard"  class="check_input"> DASHBOARD</a>
                        </div>
                         <br>                        
                    </div>
                    <div class="modal" id="input_box" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Please Enter your PIN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <!--<form method="POST">-->
                                    <div class="error"></div>
                                    <input type="hidden" name="url" value="" id="url">
                                    <input type="hidden" name="type" value="" id="type">
                                    <div class="input-group">
                                       <span class="input-group-addon"><i class="material-icons">lock</i></span>
                                       <div class="form-line"><input type="password" class="form-control" id="txtPin" name="txtPin" placeholder="Enter PIN" required></div>
                                    </div>
                                    <div class="row">
                                       <div class="col-xs-4"><button class="btn btn-block bg-blue waves-effect " id="redirect" >Logout </button>  </div>
                                       <div class="col-xs-4"></div>
                                       <div class="col-xs-4"><button class="btn btn-block bg-pink waves-effect test_pin" >Start the Session </button> </div>
                                    </div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                        
                              </div>
                            </div>
                          </div>
                        </div>
                </div>
            </div>
                
                    
                  
            </div>
        </div>
    </div>

    <?php include_once("include/footerjs.php"); ?>
    <script src="<?php echo base_url(); ?>assets/js/pages/examples/sign-in.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            document.getElementById("redirect").onclick = function () {
                location.href = "<?php base_url();?>logout";
            };
           
            
            $(document).on('click','.check_input',function(){
                var data_url = $(this).attr('data-url');
                 var data_type= $(this).attr('data-type');
                $('#url').val(data_url);
                $('#type').val(data_type);
                $('#input_box').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#input_box').modal('show');
                

            } );
            function login(url,pin,type){
                $.ajax({
                    url: "<?php echo base_url(); ?>Dashboard/check_login", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'get_request':'signin','pin':pin,'url':url,'type':type}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {
                         console.log(response);
                        var data = $.parseJSON(response);
                        //return false;
                        if (data.flag) {
                            window.location.href = data.url;

                        }
                        else{
                           $('#input_box').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                            $('#input_box').modal('show');
                            $('.error').html(data.message);

                        }
                        //alert(data.status);
                    }                            
                });

            }
            $(document).keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                var url = $('#url').val();
                var pin = $('#txtPin').val();
                var type = $('#type').val();
                if(keycode == '13'){
                    login(url,pin,type);
                }
            });
            $(document).on('click','.test_pin',function(){
                var url = $('#url').val();
                var pin = $('#txtPin').val();
                var type = $('#type').val();
               
                login(url,pin,type);
            });

        });
        
    </script>
</body>

</html>