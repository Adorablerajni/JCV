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
            <h1 class="h3 mb-0 text-gray-800">Add Check-In Entry</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
		<?php if($this->session->flashdata('message')=="CheckIn Successfully"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
		<hr /> 

<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
		  <form action="<?php echo site_url(); ?>Welcome/checkin_add" class="col-sm-12" method="POST" >
                <div class="form-group row">
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
            <input id="timepicker1" type="text" class="form-control input-small">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
        </div>
                    
                  </div>
                </div>
				<br /><br />
                <div class="form-group row">
				<div class="col-sm-3">  
            <select name="txtStockName" id="txtStockName" class="form-control">
            <option value="">Select Stock Name</option>
            <?php if($stockNameData['flag']){
            foreach ($stockNameData['stockNameData'] as $value) { ?>
            <option  value="<?php echo $value['id'] ; ?>"><?php echo $value['stock_name'] ; ?></option>
            <?php } } ?>
            </select>
            </div>
			
			<div class="col-sm-3">
            <select name="txtSupplierName" id="txtSupplierName" class="form-control">
            <option value="">Select Supplier Name</option>
            <?php if($suppliersData['flag']){
            foreach ($suppliersData['suppliersData'] as $value) { ?>
            <option  value="<?php echo $value['id'] ; ?>"><?php echo $value['supplier_name'] ; ?></option>
            <?php } } ?>
            </select>
            </div>
			
				  <div class="col-lg-3">
                    <input type="number" class="form-control form-control-user" id="txtQuantity"  name="txtQuantity" placeholder="Quantity">
                  </div>
				  <div class="col-lg-3">
                    <input type="number" class="form-control form-control-user" id="txtWeight" name="txtWeight" placeholder="Weight">
                  </div>
                </div>
                <div class="form-group row">
				  <div class="col-lg-10">
                    <textarea type="text" class="form-control form-control-user" id="txtRemark" name="txtRemark" placeholder="Remark"></textarea>
                  </div>
				  <div class="col-sm-2"> <br />
            <input type="button" value="+ Add row" id="checkin_details" class="form-control btn btn-secondary" />
            </div>
                </div>
				
            <div class="form-group row">
			
            </div>
				<br />
           <table id="table" name="table" class="table table-striped table-bordered table-hover" ><!--style="display:hide()"-->
                      <thead>
                        <tr>
                          <th>Stock Name</th>
                           <th>Supplier Name</th>
						   <th>Quantity</th>
                           <th>Weight</th>
                           <th>Remark</th>
						    <th></th>
						 </tr>
                      </thead>
					  
                      <tbody>
                      </tbody>
                    </table>
					 <br />
			
                    <div class="form-group ">
                        <div class="col-lg-12" id="notice_alert" align="center">
                        <label>&nbsp;</label>
                        <br  />
                        <label class="text-danger" style="font-size:18px">Click the "Add More(s)" Button</label>
                      </div>
					  
					<div class="col-lg-12">
                    <button type="submit" name="submit" id="AddCheckIn" class="btn btn-primary btn-user btn-block">Check In</button>
					</div>
                    </div>
					
                
              </form>
		  </div>
                </div>
              </div>
			  
			  
          <!-- Content Row -->
          
<br />

	      <?php
        if(isset($checkinData['flag'])!='' && $checkinData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Stock List</h6>
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
                              <th>Chalan No</th>
                              <th>Chalan Date</th>
                              <th>Stock Name</th>
                              <th>Supplier Name</th>
                              <th>Quantity</th>
                              <th>Weight</th>
                              <th>Get in Time</th>
                              <th>Remark</th>
                           </tr>
                        </thead>
                        <tbody>
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
                                <td><?php echo $val['st_name'];?></td>
                                <td><?php echo $val['sup_name'];?></td>
                                <td><?php echo $val['checkin_quantity'];?></td>
                                <td><?php echo $val['checkin_weight'];?></td>
                                <td><?php echo $val['get_in_time'];?></td>
                                <td><?php echo $val['checkin_remark'];?></td>
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
<script type="text/javascript">
  $(document).ready(function(){
		$("#table").hide(); 
		$("#AddCheckIn").hide(); 
});

$(document).ready(function(){
	 
 
	$("#checkin_details").click(function(){
		$("#table").show(); 
		$("#table").append('<tr valign="top"><td><input type="hidden" name="txtStockName[]" id="txtStockName_j" value="'+$("#txtStockName").val()+'" />'+$('#txtStockName option:selected').text()+'</td><td><input type="hidden" name="txtSupplierName[]"  value="'+$("#txtSupplierName").val()+'" />'+$('#txtSupplierName option:selected').text()+'</td><td><input type="hidden" name="txtQuantity[]" value="'+$("#txtQuantity").val()+'" />'+$("#txtQuantity").val()+'</td><td><input type="hidden" name="txtWeight[]" value="'+$("#txtWeight").val()+'" />'+$("#txtWeight").val()+'</td><td ><input type="hidden" name="txtRemark[]" value="'+$("#txtRemark").val()+'" />'+$("#txtRemark").val()+'</td><td  class="text-danger"><a href="javascript:void(0);" class="text-danger remCF">Remove</a></td></tr>');
	
		btnCheck();
		$('#txtStockName').val('');
		$('#txtSupplierName').val('');
		$('#txtQuantity').val('');
		$('#txtWeight').val('');
		$('#txtRemark').val('');
		
	});
        
    $("#table").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});

 function btnCheck(){
if(!$('#txtStockName').val()){
    $('#AddCheckIn').hide();
	$('#notice_alert').show();
}
else {
    $('#AddCheckIn').show();
	$('#notice_alert').hide();
}
};
</script>
</body>

</html>
