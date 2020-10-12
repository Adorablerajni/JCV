

	<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
	<script>
	var config = {
    	apiKey: "AIzaSyATtdZ7GvLolKxeqPAd1VxFD9SET721RTU",
        authDomain: "jyotishvidhya-62b70.firebaseapp.com",
        databaseURL: "https://jyotishvidhya-62b70.firebaseio.com",
        projectId: "jyotishvidhya-62b70",
        storageBucket: "jyotishvidhya-62b70.appspot.com",
        messagingSenderId: "461063458749",
        appId: "1:461063458749:web:39b8ed350145273f774cd4",
        measurementId: "G-DBQ9YVGZBF"
	};
// 	  var config = {
// 	    apiKey: "AIzaSyCBFJDl3NGklB_FNeoBfb3ZchELIrTnsts",
// 	    authDomain: "jyotish-vidhya-1234.firebaseapp.com",
// 	    databaseURL: "https://jyotish-vidhya-1234.firebaseio.com",
// 	    projectId: "jyotish-vidhya-1234",
// 	    storageBucket: "jyotish-vidhya-1234.appspot.com",
// 	    messagingSenderId: "855923561559",
// 	    appId: "1:855923561559:web:07554a0823701cf9b53f12",
//         measurementId: "G-3VN6ZSPNZY"
// 	  };
	 // firebase.initializeApp(config);
	 // Initialize Firebase
      firebase.initializeApp(config);
     // firebase.analytics();
	</script>
    <script src="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.js"></script>
   <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/2.3.0/firebaseui.css" />
   <link href="<?php echo base_url(); ?>assets/css1/style.css" rel="stylesheet" type="text/css" media="screen" />


    <div id="container">
      <h3>Authentication via Gmail/Phone number</h3>
      <div id="loading">Loading...</div>
      <div class="login-box">
                    <div class="logo">
                        <a href="javascript:void(0);">Jyotish<b>Vidya</b>App</a>
                        <small>The Universe of Astrology</small>
                    </div>
                    <div class="card">
                        <div class="body">
            			<form  method="POST" enctype="multipart/form-data" name="sign_up" id="sign_up">
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
                                 <div id="firebaseui-container"></div>
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
                        </div>
                    </div>
                </div>

      <div id="loaded" class="hidden">
        <div id="main">
          <div id="user-signed-in" class="hidden">
            <div id="user-info">
              <div id="phone"></div>
              <div class="clearfix"></div>
            </div>
            <p>
              <button id="sign-out">Sign Out</button>
            </p>
          </div>
          <div id="user-signed-out" class="hidden">
            <div id="firebaseui-spa">
              <h3>App:</h3>
              
              <div id="firebaseui-container"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/app.js"></script>









