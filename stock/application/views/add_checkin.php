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

  <title>Check In | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Check-In Entry</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
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

<?php if($_SESSION['user_type']=='Stock Manager'){ ?>
	<div class="card position-relative">
	    
        <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
        </div>
		
        <div class="card-body">
		
			<form action="" class="col-sm-12" method="POST" >
                <div class="form-group row">
                    <div class="col-lg-3"></div>
				  <div class="col-lg-3">
					<select name="txtOrderNo" id="txtOrderNo" class="form-control">
					<option value="">Select Order No</option>
					<?php if($distinctOrderData['flag']){
					foreach ($distinctOrderData['distinctOrderData'] as $value) { ?>
					<option  value="<?php echo $value['id'] ; ?>"><?php echo $value['order_no'] ; echo " [ "; echo date("d-m-Y", strtotime($value['order_date'])); echo " ]"; ?></option>
					<?php } } ?>
					</select>
                  </div>
				  <div class="col-lg-3">
					<input type="submit" name="submit" class="btn btn-primary btn-user btn-block"  value="View Previous order"/>
				  </div>
                  </div>
			</form>	  
			<?php if(isset($_POST['submit'])){ 
			header("Location: http://visuotech.com/Aahaar/Welcome/add_checkin/".$_POST['txtOrderNo']."");
			} 
			?>
			
	    <?php
        if(isset($purchaseOrderData['flag'])!='' && $purchaseOrderData['flag']==1 )
        {          
        ?>
        <br/>
			<br/>
            <div class="col-sm-12">
		    <form action="<?php echo site_url(); ?>Welcome/checkin_add" class="col-sm-12" method="POST" >
                <div class="form-group row">
                    <input type="hidden" class="form-control form-control-user"  id="txtOrderId" name="txtOrderId" value="<?php echo $purchaseOrderData['purchaseOrderData']['0']['order_id']; ?>">
                   <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="datepicker" name="txtEntryDate" placeholder="Entry Date" autocomplete="off" readonly>
                   </div>
				   
                   <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="txtVehicleNumber" name="txtVehicleNumber" placeholder="Vehicle Number">
                   </div>
				   
                   <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="txtDriverName" name="txtDriverName" placeholder="Driver Name">
                   </div>
				   
				   <div class="col-lg-3">
                    <input type="number" class="form-control form-control-user" id="txtDriverMobile" name="txtDriverMobile" placeholder="Driver Mobile Number">
                   </div>
                </div>
                
                <div class="form-group row">
				  <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="txtChallanNumber" name="txtChallanNumber" placeholder="Challan Number">
                  </div>
				  
				  <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="txtChallanDate" name="txtChallanDate" placeholder="Challan Date"  autocomplete="off" readonly>
                  </div>
				  
				  <div class="col-lg-3">
				  <div class="input-group bootstrap-timepicker timepicker">
					<input id="timepicker1" name="txtGetInTime" type="text" class="form-control input-small">
					<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
				  </div> 
                  </div>
                </div>
				
				<br /><br />
                <div class="form-group row">
				  <div class="table-responsive" >
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>S.no.</th>
							  <th>Item with all details</th>
						      <th>Quantity required</th>
                              <!--<th width="150px;">Stock Name</th>-->
                              <th width="160px;">Supplier Name</th>
                              <th>Quantity</th>
                              <th>Weight</th>
                              <th>Remark</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php 
						$count = 1 ;
                        foreach($purchaseOrderData['purchaseOrderData'] as $val){
                        ?> 
                        <tr>
                            <td><?php echo $count++ ;?></td>
                            <td><?php echo $val['name_of_stock']; echo " ("; echo $val['stock_type']; echo ")";?></td>
                            <td><?php echo $val['quantity_required'];?></td>
                            <input type="hidden" class="form-control form-control-user" id="txtStockName"  name="txtStockName[]" value="<?php echo $val['stock_name']; ?>">
                            <!--<td>  
							<select name="txtStockName[]" id="txtStockName" class="form-control">
							<option value="">Select</option>
							<?php //if($stockNameData['flag']){
							//foreach ($stockNameData['stockNameData'] as $value) { ?>
							<option  value="<?php //echo $value['id'] ; ?>"><?php //echo //$value['stock_name'] ; ?></option>
							<?php //} } ?>
							</select>
							</td>
                            <td>
							<select name="txtSupplierName[]" id="txtSupplierName" class="form-control">
							<option value="">Select</option>
							<?php //if($suppliersData['flag']){
							//foreach ($suppliersData['suppliersData'] as $value) { ?>
							<option  value="<?php echo $value['id'] ; ?>"><?php //echo $value['supplier_name'] ; ?></option>
							<?php// } } ?>
							</select>
							</td>-->
							<td><input type="text" class="form-control form-control-user" id="txtSupplierName"  name="txtSupplierName[]" placeholder="Supplier Name"></td>
                            <td><input type="number" class="form-control form-control-user" id="txtQuantity"  name="txtQuantity[]" placeholder="Quantity"></td>
                            <td><input type="number" class="form-control form-control-user" id="txtWeight" name="txtWeight[]" placeholder="Weight"></td>
                            <td><textarea type="text" class="form-control form-control-user" id="txtRemark" name="txtRemark[]" placeholder="Remark"></textarea></td>
                       </tr>
					   <?php } ?> 
                       </tbody>
                     </table>
                  </div>
                </div>
				
					<div class="row">
                    <button type="submit" name="submit" id="AddCheckIn" class="btn btn-primary btn-user btn-block">Check In</button>
					</div>
					
                
            </form>
            </div>
		<?php 
		}
		/*
		else
		{ ?>
        <div class="row col-sm-12"> 
			 <div class="col-sm-12" align="center">
            <label class="control-label" >No Data Found !!</label> 
			 </div>
		</div>
		<?php 
		}	
		*/
		?>  
                </div>
                
              
              </div>
              <?php } ?>
              
			  
		</div>	  
        

<div class="card-body">
	      
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
                              <th>Stock Name</th>
                              <th>Supplier Name</th>
                              <th>Quantity</th>
                              <th>Weight</th>
                              <th>Get in Time</th>
                              <th>Remark</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php
		
        if(isset($checkinData['flag'])!='' && $checkinData['flag']==1 )
        {
                             
        ?>
						<?php $count = 1 ;
                              if($checkinData['flag']==1)  {
                                foreach($checkinData['checkinData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo date('d-m-Y', strtotime($val['checkin_date']));?></td>
                                <td><?php echo $val['vehicle_number'];?></td>
                                <td><?php echo $val['driver_name'];?></td>
                                <td><?php echo $val['driver_mobile_no'];?></td>
                                <td><?php echo $val['chalan_no'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($val['chalan_date']));?></td>
                                <td><a href="<?php echo site_url();?>Allotment/view_stock/<?php echo $val['stock_name']; ?>" target="_new"><?php echo $val['st_name'];?></a></td>
                                <td><?php echo $val['supplier_name']; //$val['sup_name'];?></td>
                                <td><?php echo $val['checkin_quantity'];?></td>
                                <td><?php echo $val['checkin_weight'];?></td>
                                <td><?php echo $val['get_in_time'];?></td>
                                <td><?php echo $val['checkin_remark'];?></td>
                              </tr>
							   <?php } }  ?> 
							   <?php 
		}
		else
		{ ?>
        <tr>
            <td colspan="13">No Recods Found !!!</td>
        </tr>
		<?php 
		}	
		?> 
                       </tbody>
                     </table>
                  </div>
				  </div>
				  </div>
				  </div>
          </div>
		 
           </div>
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
</div>
</div>
<?php include_once('include/footer.php'); ?>
  <?php include_once('include/footerlinks.php'); ?>

 <script>
 var timeout = 3000; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);
  </script>
</body>

</html>
