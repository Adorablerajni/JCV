<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Purchase Order List | Aahaar</title>

  <?php include_once('include/headerlinks.php'); ?>
  <style>
  
      .btn{font-size:13px;}
  </style>
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
            <h2 class="h3 mb-0 text-gray-800">Purchase Orders</h2>
            <?php //if($_SESSION['user_type']=='Stock Manager'){ ?>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
           <a href="<?php echo site_url(); ?>PurchaseOrder/purchase_order" class="btn btn-warning" style="float:right;font-size:12px"><i class="fas fa-plus"></i> Create Purchase Order</a>
         <?php //} ?>
          </div>

	      <?php
        if(isset($distinctOrderData['flag'])!='' && $distinctOrderData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-lg-12">
				  <div class="card shadow lg-12">
				      
            <div class="card-header">
                &nbsp;
            
                <a href="<?php echo site_url(); ?>PurchaseOrder/purchase_order" class="btn btn-warning" style="float:right;display:none;"><i class="fas fa-plus"></i> Create Puchase Order</a>
            </div>
            
            <div class="card-body">
              
				  <div style="width:100%">
                     <table class="table table-striped table-bordered" id="example" border="1" cellpadding="0" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Order Number</th>
                              <th>Order Date</th>
                              <th>Address</th>
                              <th>Status</th>
                              <th>Approved By</th>
                              <th>Approved Time</th>
                              <th colpsan="3" style="text-align:center !important">Operations</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($distinctOrderData['flag']==1)  {
                                foreach($distinctOrderData['distinctOrderData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $val['order_no']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($val['order_date'])); ?></td>
                                <td><?php echo $val['order_address']; ?></td>
                                <td><?php echo $val['status']; ?></td>
                                <td><?php echo $val['approvedby_name']; ?></td>
                                <td><?php  if($val['approved_time'] ==""){echo " ";} else { date_default_timezone_set('Asia/Kolkata'); echo date('d-m-Y H:i:s', strtotime($val['approved_time'])); } ?></td>
                                <td colpsan="3" align="center"> 
                                <a href="<?php echo site_url(); ?>PurchaseOrder/view_purchase_order/<?php echo $val['id']; ?>" class="btn btn-primary">View</a>
                                <a href="<?php echo site_url(); ?>PurchaseOrder/edit_purchase_order/<?php echo $val['id']; ?>" class="btn btn-danger">Edit</a> 
                                <?php if($_SESSION['user_type']=='Stock Manager'){ ?>
                                <a href="<?php echo site_url(); ?>PurchaseOrder/add_purchase_items/<?php echo $val['id']; ?>" class="btn btn-warning">Add Item</a>
                                <?php } ?>
                                <a href="<?php echo site_url(); ?>PurchaseOrder/view_purchase_order/<?php echo $val['id']; ?>"  class="btn btn-success" style="display:none">Approve</a></td>
                                
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
