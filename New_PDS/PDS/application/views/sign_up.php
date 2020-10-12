<div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Jyotish<b>Vidya</b></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
			<form  method="POST" enctype="multipart/form-data" class="not_otp"  name="sign_up" id="sign_up">
                    <input type="hidden" name="url" id="url" value="<?php echo base_url(); ?>registered">
                    <div class="msg">Create your account</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required autofocus>
                        </div>
                    </div>
                    <!-- <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>  -->
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">mail</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="+91 999*******" required>
                        </div>
                    </div>
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password" required>
                        </div>
                    </div>
                     <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="user_cpassword" name="user_cpassword" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
						
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
							
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-orange waves-effect sign_up_submit" type="submit">SIGN UP</button>
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
            <div class="get_otp">Verify Your OTP</div>
            <form  method="POST" class="get_otp" name="verify" id="verify"><div class="msg"> Enter Recieved OTP</div>
                <input type="hidden" name="url" id="url" value="<?php echo base_url(); ?>registered">
                 <div class="input-group get_otp" >
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="user_Otp" name="user_Otp" placeholder="6 digit OTP " required>
                            <input type="hidden" name="session_id" id="session_id" value="">
                            <input type="hidden" name="user_id" id="user_id" value="">
                        </div>
                    </div>
                    <div class="row get_otp"  >
                        <div class="col-xs-8 p-t-5">
                        
                            
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-orange waves-effect" id="verify_button"  type="button">Verify</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
