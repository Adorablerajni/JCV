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


          <!-- Content Row -->
		  
    <?php
        if(isset($allStockData['flag'])!='' && $allStockData['flag']==1 )
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
						<?php $count = 1 ;
                              if($stockNameData['flag']==1)  {
                                foreach($stockNameData['stockNameData'] as $value){
                                       ?> 
                        <thead><th colspan="6" align="center" bgcolor="#e3e6f0"><?php echo $value['stock_name'];?></th></thead>
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Stock Date</th>
                              <th>Stock Credit</th>
                              <th>Stock Debit</th>
                              <th>Stock Rate</th>
                              <th>Stock Amount</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php
						
						$availableStockData = $this->Allotment_model->get_available_stock($value['id']);
						$count = 1 ;
                              if($availableStockData['flag']==1)  {
                                foreach($availableStockData['availableStockData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['stock_date'];?></td>
                                <td><?php echo $val['stock_credit'];?></td>
                                <td><?php echo $val['stock_debit'];?></td>
                                <td><?php echo $val['stock_rate'];?></td>
                                <td><?php echo $val['stock_amount'];?></td>
                              </tr>
							   <?php } }else{ ?>
                              <tr>
                                <td colspan="6"><?php echo "No data";?></td>
                              </tr>
								<?php }	?> 
                       </tbody>
							   <?php } }  ?> 
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
