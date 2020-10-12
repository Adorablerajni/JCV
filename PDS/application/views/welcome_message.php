<?php
if (isset($_SESSION['userid'])) {
    redirect('dashboard');
}
?><br /><br />
<div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><h1>Jyotish<b>Vidhya</b></h1></a>
            <small>The Universe of Astrology</small>
        </div>
        <div class="card">
            <div class="body">
			<form  method="POST" enctype="multipart/form-data" name="login" id="sign_in">
                     <input type="hidden" name="url" id="url" value="<?php echo base_url(); ?>/login">
                    <div class="msg">Sign in to your account</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">mail</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email"  autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
						
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
							
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-orange waves-effect sign_in_submit" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20" style="display:none">
                        <div class="col-xs-6">
                            <a href="<?php echo base_url(); ?>signup">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        <p align="center" class="col-white">Developed by <a href="" class="col-yellow">Visuotech</a></p>
    </div>
