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

  <title>Check-In List | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Check-In List</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
           <?php if($_SESSION['user_type']=='Stock Manager'){ ?>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
           <a href="<?php echo site_url(); ?>Welcome/add_checkin" class="btn btn-warning" style="float:right;font-size:12px"><i class="fas fa-plus"></i> Add Check-In</a>
         <?php } ?>
          </div>
		<?php if($this->session->flashdata('message')=="CheckIn Successfully"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php }elseif($this->session->flashdata('message')=="CheckIn Unsuccessful"){?>
          <div align="center" class="alert alert-danger">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
			  
	      <?php
        if(isset($checkinData2['flag'])!='' && $checkinData2['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Checkin Date</th>
                              <th>Vehicle Number</th>
                              <th>Driver Name</th>
                              <th>Driver Mobile No</th>
                              <th>Challan No</th>
                              <th>Challan Date</th>
                              <th>Supplier Name</th>
                              <th>Get in Time</th>
                              <th>Remark</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($checkinData2['flag']==1)  {
                                foreach($checkinData2['checkinData2'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo date('d-m-Y', strtotime($val['checkin_date']));?></td>
                                <td><?php echo $val['vehicle_number'];?></td>
                                <td><?php echo $val['driver_name'];?></td>
                                <td><?php echo $val['driver_mobile_no'];?></td>
                                <td><?php echo $val['chalan_no'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($val['chalan_date']));?></td>
                                <td><?php echo $val['supplier_name']; //$val['sup_name'];?></td>
                                <td><?php echo $val['get_in_time'];?></td>
                                <td><?php echo $val['checkin_remark'];?></td>
                                <td><a href="<?php echo site_url(); ?>Welcome/add_checkin/<?php echo $val['order_id'];?>" class="btn btn-danger">View</a></td>
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
