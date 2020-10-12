<div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Jyotish<b>Vidya</b></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
			<form  method="POST" enctype="multipart/form-data" name="sign_up" action="<?php echo base_url(); ?>save_new_password">
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
                            <input type="hidden" name="email" value="<?php echo $this->uri->segment(2) ; ?>">
                            <input type="hidden" name="email_token" value="<?php echo $this->uri->segment(3) ;  ?>" required>
                            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="New Password" required>
                        </div>
                    </div>
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="user_cpassword" name="user_cpassword" placeholder="Confirm New Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
						
                            
							
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-orange waves-effect sign_up_submit" type="submit">Save</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20" >
                        <div class="col-xs-6">
                            <a href="<?php echo base_url(); ?>">Login Here</a>
                        </div>
                        <!-- <div class="col-xs-6 align-right">
                            <a href="#">Forgot Password?</a>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
