<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Canteen - Login</title>

  <?php include_once('include/headerlinks.php'); ?>
<style>
    body{
        font-family:arial;
    }
</style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-12 my-12" align="center">
          <br /><br /><br /><br /><br />
<h1 style="text-align:center;color:#FFF;font-size:60px">CANTEEN</h1>
<hr style="width:150px;color:#FFF44F;background-color:#FFF44F;height:3px;margin-top:5px;border-radius:2px" />
<p align="center" style="color:#FFF;font-size:22px">DRP LINE, INDORE POLICE</p>
<br />
        <div class="card o-hidden border-0 shadow-lg col-xl-4">
		
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
             <!--  <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
              <div class="col-lg-12" style="height:300px">
                <div class="p-3">
			
                  <div class="text-center">
				  <br />
                    <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                  </div>
<?php if($this->session->flashdata('flash_message')=='Password Changed Successfully! Please login to continue.')
{
?> 
<div class="alert alert-success"> 
<?php echo '<p style="text-align:center;color:green">'.$this->session->flashdata('flash_message').'</p>'; ?>
</div>

<?php }
else 
{
echo '<p style="text-align:center;color:red;font-weight:bold">'.$this->session->flashdata('flash_message').'</p>'; }
 ?>
				   <form class="form-horizontal form-material" method="POST" id="loginform" action="<?php echo site_url(); ?>Login/custom_login">
                            
              <div class="form-group">
                 <input type="text" class="form-control form-control-user" id="exampleInputUsername" name="exampleInputUsername" placeholder="Enter Username"/>
              </div>
              <div class="form-group">
                 <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="exampleInputPassword" placeholder="Enter Password"/>
              </div>
              <div class="form-group ">
                  <input type="submit" name="submit" class="btn btn-danger btn-user btn-block" value="Sign In"/>
              </div>
            </form>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      
    </div>

  </div> <br />
  <p style="color:#FFF" align="center">Developed by <a href="http://visuotech.com/" style="color:#FFF44F">Visuotech</a></p>
<?php include_once('include/footerlinks.php'); ?>
</body>

</html>
