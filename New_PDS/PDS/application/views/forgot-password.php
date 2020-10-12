<div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Jyotish<b>Vidya</b></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
			<form  method="POST" enctype="multipart/form-data" name="sign_up" id="forgot" action="<?php echo base_url(); ?>forgetpassword" >
			      <?php
            		if(!empty($this->session->flashdata('message')))
            		{ ?>
                  <div align="center" class="alert alert-success">      
                    <?php echo $this->session->flashdata('message')?>
                  </div>
                  <?php } ?>
                  <?php
            		if(!empty($this->session->flashdata('error')))
            		{ ?>
                  <div align="center" class="alert alert-danger">      
                    <?php echo $this->session->flashdata('error')?>
                  </div>
                  <?php } ?>
                    <div class="msg">Forgot Password</div>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">mail</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-xs-8">
                        </div>    
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-orange waves-effect " type="submit">Submit</button>
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
