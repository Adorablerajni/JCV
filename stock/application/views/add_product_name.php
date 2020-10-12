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

  <title>Add Product Name| Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Product Name</h1>
          </div>
		<?php
		if(!empty($this->session->flashdata('message')))
		{
		if($this->session->flashdata('message')=="Product Added Successfully." || $this->session->flashdata('message')=="Product Updated Successfully.")
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


          <!-- Content Row -->
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add details</h6>
                </div>
                <div class="card-body">
          <div class="row">
				   <form action="<?php echo site_url(); ?>Master/product_name_add" class="col-sm-12" method="POST" >
                <div class="form-group row">
					<div class="col-lg-4">
						<input type="text" class="form-control form-control-user" id="txtProductName" name="txtProductName" placeholder="Product Name" autocomplete="off"/>
					</div>
					<div class="col-lg-4">
						<input type="submit" name="submit"class="btn btn-primary btn-user btn-block"  value="Add Product"/>
					</div>
				  
                </div>
                
                
              </form>
		  </div>
              </div>
              </div>

		  <br />
	      <?php
        if(isset($ProductNameData['flag'])!='' && $ProductNameData['flag']==1 )
        {
                             
        ?>
                  <div class="row">
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Product Name List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                           <tr>
                              <th style="text-align:center;">S.no.</th>
                              <th style="text-align:center;">Product Name</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($ProductNameData['flag']==1)  {
                                foreach($ProductNameData['ProductNameData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['product_name'];?></td>
                                <td><a href="<?php echo site_url(); ?>Master/edit_product_name/<?php echo $val['id'];?>">Edit</a></td>
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
