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

  <title>Dispatch List | Aahaar</title>

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
            <h2 class="h3 mb-0 text-gray-800">Dispatch List</h2>
            <?php if($_SESSION['user_type']=='Dispatch Manager'){ ?>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
           <a href="<?php echo site_url(); ?>Dispatch/add_production" class="btn btn-warning" style="float:right;font-size:12px"><i class="fas fa-plus"></i> Create Dispatch Challan</a>
         <?php } ?>
          </div>

	      <?php
        if(isset($DispatchData['flag'])!='' && $DispatchData['flag']==1 )
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
                     <table class="table table-striped table-bordered" id="example" border="1" cellpadding="0" cellspacing="0" width="100%" align="center">
                        <thead>
                           <tr>
                              <th>*</th>
                              <th align="center">City</th>
                              <th align="center">Project</th>
                              <th align="center">Challan No.</th>
                              <th align="center">Challan Date</th>
                              <th align="center">Vehicle No.</th>
                              <th align="center">Destination</th>
                              <th align="center">Transporter</th>
                              <th align="center">Status</th>
                              <th align="center">Approved By</th>
                              <th align="center">Approved Time</th>
                              <?php if($_SESSION['user_type']=='Dispatch Manager'){ ?>
                              <th style="text-align:center !important">Operations</th>
                              <?php } ?>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($DispatchData['flag']==1)  {
                                foreach($DispatchData['DispatchData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++; ?></td>
                                <td align="center"><?php echo $val['del_city']; ?></td>
                                <td align="center"><?php echo $val['project_name']; ?></td>
                                <td align="center"><a href="<?php echo base_url(); ?>/Dispatch/delivery_challan/<?php echo $val['id']; ?>" target="_new"><?php echo $val['del_challan_no']; ?></a></td>
                                <td align="center"><?php  if($val['del_challan_date'] ==""){echo " ";} else { date_default_timezone_set('Asia/Kolkata'); echo date('d-m-Y', strtotime($val['del_challan_date'])); } ?></td>
                                <td align="center"><?php echo $val['del_vehicle_no']; ?></td>
                                <td align="center"><?php echo $val['del_destination']; ?></td>
                                <td align="center"><?php echo $val['del_transporter']; ?></td>
                                <td align="center"><?php echo $val['del_status']; ?></td>
                                <td align="center"><?php echo $val['del_approve_name']; ?></td>
                                <td align="center"><?php  if($val['del_approve_datetime'] ==""){echo " ";} else { date_default_timezone_set('Asia/Kolkata'); echo date('d-m-Y H:i:s', strtotime($val['del_approve_datetime'])); } ?></td>
                                <?php if($_SESSION['user_type']=='Dispatch Manager'){ ?>
                                <td align="center">
                                <a href="<?php echo site_url(); ?>Dispatch/edit_daily_production/<?php //echo $val['prod_id']; ?>" class="btn btn-danger">Edit</a>
                                <?php } ?>
                                
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
