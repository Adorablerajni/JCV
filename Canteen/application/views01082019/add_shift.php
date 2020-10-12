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

  <title>Add Shift | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Shift</h1>
          </div>
		<?php if($this->session->flashdata('message')=="Shift Added Successfully"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>


          <!-- Content Row -->
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
				   <form action="<?php echo site_url(); ?>Master/shift_add" class="col-sm-12" method="POST" >
                <div class="form-group row">
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtShiftName" name="txtShiftName" placeholder="Shift Name"/>
                  </div>
                  <div class="col-lg-4">
                    <select name="txtStartTime" id="txtStartTime" class="form-control" autocomplete="off">
            <option value="">Select Shift Start Time</option>
	<option value="00:00">12.00 AM</option>
    <option value="00:30">12.30 AM</option>
    <option value="01:00">01.00 AM</option>
    <option value="01:30">01.30 AM</option>
    <option value="02:00">02.00 AM</option>
    <option value="02:30">02.30 AM</option>
    <option value="03:00">03.00 AM</option>
    <option value="03:30">03.30 AM</option>
    <option value="04:00">04.00 AM</option>
    <option value="04:30">04.30 AM</option>
    <option value="05:00">05.00 AM</option>
    <option value="05:30">05.30 AM</option>
    <option value="06:00">06.00 AM</option>
    <option value="06:30">06.30 AM</option>
    <option value="07:00">07.00 AM</option>
    <option value="07:30">07.30 AM</option>
    <option value="08:00">08.00 AM</option>
    <option value="08:30">08.30 AM</option>
    <option value="09:00">09.00 AM</option>
    <option value="09:30">09.30 AM</option>
    <option value="10:00">10.00 AM</option>
    <option value="10:30">10.30 AM</option>
    <option value="11:00">11.00 AM</option>
    <option value="11:30">11.30 AM</option>
    <option value="12:00">12.00 PM</option>
    <option value="12:30">12.30 PM</option>
    <option value="13:00">01.00 PM</option>
    <option value="13:30">01.30 PM</option>
    <option value="14:00">02.00 PM</option>
    <option value="14:30">02.30 PM</option>
    <option value="15:00">03.00 PM</option>
    <option value="15:30">03.30 PM</option>
    <option value="16:00">04.00 PM</option>
    <option value="16:30">04.30 PM</option>
    <option value="17:00">05.00 PM</option>
    <option value="17:30">05.30 PM</option>
    <option value="18:00">06.00 PM</option>
    <option value="18:30">06.30 PM</option>
    <option value="19:00">07.00 PM</option>
    <option value="19:30">07.30 PM</option>
    <option value="20:00">08.00 PM</option>
    <option value="20:30">08.30 PM</option>
    <option value="21:00">09.00 PM</option>
    <option value="21:30">09.30 PM</option>
    <option value="22:00">10.00 PM</option>
    <option value="22:30">10.30 PM</option>
    <option value="23:00">11.00 PM</option>
    <option value="23:30">11.30 PM</option>
            </select>
                  </div>
                  <div class="col-lg-4">
					<select name="txtEndTime" id="txtEndTime" class="form-control" autocomplete="off">
            <option value="">Select Shift End Time</option>
	<option value="00:00">12.00 AM</option>
    <option value="00:30">12.30 AM</option>
    <option value="01:00">01.00 AM</option>
    <option value="01:30">01.30 AM</option>
    <option value="02:00">02.00 AM</option>
    <option value="02:30">02.30 AM</option>
    <option value="03:00">03.00 AM</option>
    <option value="03:30">03.30 AM</option>
    <option value="04:00">04.00 AM</option>
    <option value="04:30">04.30 AM</option>
    <option value="05:00">05.00 AM</option>
    <option value="05:30">05.30 AM</option>
    <option value="06:00">06.00 AM</option>
    <option value="06:30">06.30 AM</option>
    <option value="07:00">07.00 AM</option>
    <option value="07:30">07.30 AM</option>
    <option value="08:00">08.00 AM</option>
    <option value="08:30">08.30 AM</option>
    <option value="09:00">09.00 AM</option>
    <option value="09:30">09.30 AM</option>
    <option value="10:00">10.00 AM</option>
    <option value="10:30">10.30 AM</option>
    <option value="11:00">11.00 AM</option>
    <option value="11:30">11.30 AM</option>
    <option value="12:00">12.00 PM</option>
    <option value="12:30">12.30 PM</option>
    <option value="13:00">01.00 PM</option>
    <option value="13:30">01.30 PM</option>
    <option value="14:00">02.00 PM</option>
    <option value="14:30">02.30 PM</option>
    <option value="15:00">03.00 PM</option>
    <option value="15:30">03.30 PM</option>
    <option value="16:00">04.00 PM</option>
    <option value="16:30">04.30 PM</option>
    <option value="17:00">05.00 PM</option>
    <option value="17:30">05.30 PM</option>
    <option value="18:00">06.00 PM</option>
    <option value="18:30">06.30 PM</option>
    <option value="19:00">07.00 PM</option>
    <option value="19:30">07.30 PM</option>
    <option value="20:00">08.00 PM</option>
    <option value="20:30">08.30 PM</option>
    <option value="21:00">09.00 PM</option>
    <option value="21:30">09.30 PM</option>
    <option value="22:00">10.00 PM</option>
    <option value="22:30">10.30 PM</option>
    <option value="23:00">11.00 PM</option>
    <option value="23:30">11.30 PM</option>
            </select>
                  </div>
                  </div>
				  
                <div class="form-group row">
                  <div class="col-lg-3">
                    <input type="submit" name="submit"class="btn btn-primary btn-user btn-block"  value="Add Shift"/>
                  </div>
                </div>
                
                
              </form>
		  </div>
		  </div>
		  </div>

		  <br />
	      <?php
        if(isset($shiftData['flag'])!='' && $shiftData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Shift List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Shift Type</th>
                              <th>Shift Start Time</th>
                              <th>Shift End Time</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($shiftData['flag']==1)  {
                                foreach($shiftData['shiftData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['shift_type'];?></td>
                                <td><?php echo $val['shift_start_time'];?></td>
                                <td><?php echo $val['shift_end_time'];?></td>
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
