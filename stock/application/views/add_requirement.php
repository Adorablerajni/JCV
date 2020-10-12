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

  <title>Add Requirement | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Requirement</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
		<hr /> 
		
		<?php
		if(!empty($this->session->flashdata('message')))
		{
		if($this->session->flashdata('message')=="Requirement Added Successfully." || $this->session->flashdata('message')=="Requirement Updated Successfully.")
		{
		?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } 
        else
        {
        ?>
          <div align="center" class="alert alert-danger">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } }?>

    <div class="card position-relative">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add details</h6>
        </div>
                
        <div class="card-body">
        <div class="row">
            
		    <form action="<?php echo site_url(); ?>Dispatch/requirement_add" class="col-sm-12" method="POST" >
                
                <div class="form-group row">
    				<div class="col-lg-3">  
                    <select name="city" id="city" class="form-control">
                    <option value="">Select City</option>
                    <option value="Indore">Indore</option>
                    <option value="Ujjain">Ujjain</option>
                    <option value="Dewas">Dewas</option>
                    </select>
                    </div>
			
    				<div class="col-lg-3">  
                    <select name="product_name" id="product_name" class="form-control">
                    <option value="">Select Product Name</option>
                    <?php if($ProductNameData['flag']){
                    foreach ($ProductNameData['ProductNameData'] as $value) { ?>
                    <option value="<?php echo $value['id'] ; ?>"><?php echo $value['product_name'] ; ?></option>
                    <?php } } ?>
                    </select>
                    </div>
                    
    				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="project_name"  name="project_name" placeholder="Project Name">
                    </div>
                    
    				<div class="col-lg-3">
                    <input type="number" step="0.01" class="form-control form-control-user" id="packets" name="packets" placeholder="Packets">
                    </div>
                </div>
                
                <div class="form-group row">
    				<div class="col-lg-3">
                        <input type="number" step="0.01" class="form-control form-control-user" id="quantity" name="quantity" placeholder="Quantity">
    				</div>
    				
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="di_order_no" name="di_order_no" placeholder="DI Order No">
    				</div>
                    
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="datepicker" name="di_order_date" placeholder="DI Order Date" autocomplete ="off" readonly>
    				</div>
                </div>
                
                <div class="form-group row">
					<div class="col-lg-12">
                    <button type="submit" name="submit" id="IssueCheck" class="btn btn-primary btn-user btn-block">Add Requirement</button>
				    </div>
                </div>
            </form>
		</div>
        </div>
    </div>
			  
			  
          <!-- Content Row -->
          
<br />

	      <?php
        if(isset($RequirementData['flag'])!='' && $RequirementData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Requirement List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th style="text-align:center;">S.no.</th>
                              <th style="text-align:center;">City</th>
                              <th style="text-align:center;">Product Name</th>
                              <th style="text-align:center;">Project Name</th>
                              <th style="text-align:center;">Packets</th>
                              <th style="text-align:center;">Quantity</th>
                              <th style="text-align:center;">DI Order No</th>
                              <th style="text-align:center;">DI Order Date</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                                foreach($RequirementData['RequirementData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['city']; ?></td>
                                <td><?php echo $val['product_name'];?></td>
                                <td><?php echo $val['project_name'];?></td>
                                <td><?php echo $val['packets'];?></td>
                                <td><?php echo $val['quantity'];?></td>
                                <td><?php echo $val['di_order_no'];?></td>
							    <td><?php echo date('d-m-Y', strtotime($val['di_order_date']));?></td>
                              </tr>
							   <?php }   ?> 
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
