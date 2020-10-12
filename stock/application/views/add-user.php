<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Aahaar - Dashboard</title>

  <?php include_once('include/headerlinks.php'); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
		<?php include_once('include/sidepanel.php'); ?>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

		<?php include_once('include/header.php'); ?>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add User</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
		<?php if($this->session->flashdata('message')=="User Added Successfully"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
		<hr /> 


          <!-- Content Row -->
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
		  <form action="<?php echo site_url();?>Welcome/user_add" class="col-sm-12" method="POST">
                <div class="form-group row">
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtFullName" name="txtFullName" placeholder="Full Name">
                  </div>
                  <div class="col-lg-4">
                    <input type="number" class="form-control form-control-user" id="txtMobileNumber" name="txtMobileNumber" placeholder="Mobile Number">
                  </div>
                  <div class="col-lg-4">
                    <input type="email" class="form-control form-control-user" id="txtEmailId" name="txtEmailId" placeholder="Email Id">
                  </div>
				  
                </div>
                
                <div class="form-group row" >
				<div class="col-lg-4">
                    
					<select class="form-control" id="txtUserType" name="txtUserType" >
					<option value="">Select User Tpye</option>
					<option>Guard</option>
					<option>Employee</option>
					<option>Supervisor</option>
					<option>APM</option>
					<option>Stock Manager</option>
					<option>Dispatch Manager</option>
					<option>Quality Manager</option>
					<option>Admin</option>
					</select>
                  </div>
                  
				  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtUserName" name="txtUserName" placeholder="User Name" autocomplete="off">
                  </div>
				  <div class="col-lg-4">
                    <input type="password" class="form-control form-control-user" id="txtPassword" name="txtPassword" placeholder="Password" autocomplete="off">
                  </div>
                </div>
                <div class="form-group row">
                    
				<div class="col-lg-3">
					<input type="submit" name="submit" class="btn btn-primary btn-user btn-block"  value="Add User"/>
				</div>
				</div>
                
                
              </form>
		  </div>
		  </div>
		  </div>

 <br />               
	      <?php
        if(isset($userData['flag'])!='' && $userData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Stock List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>User Role</th>
                              <th>Name</th>
                              <th>User Id</th>
                              <th>Email Id</th>
                              <th>Contact</th>
                              <th>Is Login?</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($userData['flag']==1)  {
                                foreach($userData['userData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['user_type'];?></td>
                                <td><?php echo $val['full_name'];?></td>
                                <td><?php echo $val['user_name'];?></td>
                                <td><?php echo $val['user_email_id'];?></td>
                                <td><?php echo $val['contact_no'];?></td>
                                <td><?php echo $val['is_login'];?></td>
                              </tr>
							   <?php } }  ?> 
                       </tbody>
                     </table>
                  </div>
				  </div>
				  </div>
				  </div>
          </div>
		<?php 
		}
		else
		{ ?>
        <div class="row"> 
			 <div class="col-sm-12" align="center">
            <label class="control-label" >No Data Found !!</label> 
			 </div>
		</div>
		<?php 
		}	
		?>  
              
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once('include/footer.php'); ?>
  <?php include_once('include/footerlinks.php'); ?>

</body>

</html>
