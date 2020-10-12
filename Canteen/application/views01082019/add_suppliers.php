<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add Suppliers | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Suppliers</h1>
          </div>
		  
		<?php if($this->session->flashdata('message')=="Supplier Added Successfully"){?>
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
				   <form action="<?php echo site_url(); ?>Master/suppliers_add" class="col-sm-12" method="POST" >
                <div class="form-group row">
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtSupplierName" name="txtSupplierName" placeholder="Suppliers Name"/>
                  </div>
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtMobileNo" name="txtMobileNo" placeholder="Mobile No."/>
                  </div>
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtCity" name="txtCity" placeholder="City"/>
                  </div>
                 </div>
                <div class="form-group row">
				  <div class="col-lg-12">
                    <textarea type="text" class="form-control form-control-user" id="txtAddress" name="txtAddress" placeholder="Address"/></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <input type="submit" name="submit"class="btn btn-primary btn-user btn-block"  value="Add Suppliers"/>
                  </div>
                </div>
                
                
              </form>
		  </div>
		  </div>
		  </div>

		  <br />
	      <?php
        if(isset($suppliersData['flag'])!='' && $suppliersData['flag']==1 )
        {
                             
        ?>
                  <div class="row">
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Supplier Name</th>
                              <th>Supplier Mobile No</th>
                              <th>Supplier Address</th>
                              <th>Supplier City</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($suppliersData['flag']==1)  {
                                foreach($suppliersData['suppliersData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['supplier_name'];?></td>
                                <td><?php echo $val['supplier_mobile_no'];?></td>
                                <td><?php echo $val['supplier_address'];?></td>
                                <td><?php echo $val['supplier_city'];?></td>
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

 <script>
 var timeout = 3000; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);
  </script>
</body>

</html>
