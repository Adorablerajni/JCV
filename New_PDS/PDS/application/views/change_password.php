<?php 
    if (!isset($_SESSION['userid'])) {
        redirect('home');
    }
    
    
?>
<div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Jyotish<b>Vidya</b></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
			<form  method="POST" enctype="multipart/form-data" name="sign_up" action="<?php echo site_url()?>User/save_new_password">
                    <input type="hidden" name="url" id="" value="">
                    <?php
            		if(!empty($this->session->flashdata('error')))
            		{ ?>
                  <div align="center" class="alert alert-danger">      
                    <?php echo $this->session->flashdata('error')?>
                  </div>
                  <?php } ?>     
                  
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            
                            <input type="password" value="" class="form-control" name="current_password" placeholder="Current Password" required>
                        </div>
                    </div>
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" value="" class="form-control" name="new_password" placeholder="New Password" required>
                        </div>
                    </div>
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" value="" class="form-control" name="cf_new_password" placeholder="Confirm Password" required> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
						
                            <a href="<?php echo $_SERVER['HTTP_REFERER'];  ?>">Back </a>
							
                        </div>
                        <div class="col-xs-4">
                           <input type="hidden"  name="user_id" value="<?php echo $_SESSION['userid'] ?>">
                            <button class="form-control warning" name="save_password"> Save</button>
                        </div>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

<script>
    $(document).ready(function(){
        $('.pass_show').append('<span class="ptxt">Show</span>');  
        });
          
        
        $(document).on('click','.pass_show .ptxt', function(){ 
        
        $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
        
        $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
        
        });
</script>