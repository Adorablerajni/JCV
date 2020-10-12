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

  <title>Available Stock | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Available Stock</h1>
          </div>
		<?php if($this->session->flashdata('message')=="Please Select Stock Type"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>


          <!-- Content Row -->
		  
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Select Available Stock Type</h6>
                </div>
                <div class="card-body">
          <div class="row">
				   <form action="<?php echo site_url(); ?>Allotment/show_available_stock" class="col-sm-12" method="POST" >
                <div class="form-group row">
					<div class="col-lg-4">
						<select name="txtStockType" id="txtStockType" class="form-control">
						<option value="">Select Stock Type</option>
						<option>Miscellaneous Material</option>
						<option>Stationary</option>
						<option>Mechanical Device/Instrument</option>
						<option>Electrical and Electronic Device/Instrument</option>
						<option>Packing</option>
						<option>House Keeping</option>
						<option>Raw Material</option>
						</select>
					</div>
					<div class="col-lg-3">
						<input type="submit" name="submit"class="btn btn-primary btn-user btn-block"  value="View List"/>
					</div>
                </div>
              </form>
		  </div>
              </div>
              </div>

		  <br />
	      <?php
	      if(isset($_POST['submit'])!='')
	      {
        if(isset($stockAccordingType['flag'])!='' && $stockAccordingType['flag']==1 )
        {    
        ?>
                  <div class="row">
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Available Stock List</h6>
            </div>
            <div class="card-body">
				
				  <div class="table-responsive">
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                           <tr>
                              <th style="text-align:center;">S.no.</th>
                              <th style="text-align:center;">Stock Name</th>
                              <th style="text-align:center;">Stock Quantity</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php 
						$count = 1 ;
						foreach($stockAccordingType['stockAccordingType'] as $value){ ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><a href="<?php echo site_url();?>Allotment/view_stock/<?php echo $value['id']; ?>" target="_new"><?php echo $value['stock_name'];?></a></td>
								<?php
								$availableStockData = $this->Allotment_model->get_available_stock($value['id']);
								if($availableStockData['flag']==1)  {
								    
								$available = $availableStockData['availableStockData']['sum_stock_debit'] - $availableStockData['availableStockData']['sum_stock_credit'] ;
                                ?> 
                                <td style="text-align:center;" class="<?php if ($available > 0) { echo "text-success"; } else { echo "" ; } ?>"><b><?php echo $available ; ?></b></td>
							   <?php } ?> 
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
