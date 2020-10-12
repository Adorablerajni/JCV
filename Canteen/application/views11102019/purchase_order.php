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

  <title>Purchase Order | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Purchase Order</h1>
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
		  <form action="<?php echo site_url(); ?>PurchaseOrder/add_purchase_order" class="col-sm-12" method="POST" >
                <div class="form-group row">
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtOrderNumber" name="txtOrderNumber" placeholder="Order Number" autocomplete="off" >
                  </div>
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="datepicker" name="txtOrderDate" placeholder="Order Date" autocomplete="off" readonly>
                  </div>
                </div>
                <div class="form-group row">
					<div class="col-lg-12">
                    <textarea type="text" class="form-control form-control-user" id="txtAddress" name="txtAddress" placeholder="Address" autocomplete="off" ></textarea>
                  </div>
                </div>
				<br /><br />
                <div class="form-group row">
				<div class="col-sm-4">  
            <select name="txtStockName" id="txtStockName" class="form-control">
            <option value="">Select Stock Name</option>
            <?php if($stockNameData['flag']){
            foreach ($stockNameData['stockNameData'] as $value) { ?>
            <option  value="<?php echo $value['id'] ; ?>"><?php echo $value['stock_name'] ; ?> - [<?php echo $value['stock_type'] ; ?>]</option>
            <?php } } ?>
            </select>
            </div>
				  <div class="col-lg-4">
                    <input type="number" class="form-control form-control-user" id="txtQuantity"  name="txtQuantity" placeholder="Quantity Required">
                  </div>
				  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtRequiredFor" name="txtRequiredFor" placeholder="Required For">
                  </div>
                  </div>
                <div class="form-group row">
				  <div class="col-lg-6">
                    <input type="text" class="form-control form-control-user" id="txtStoreStock" name="txtStoreStock" placeholder="Store Stock Page No. and Stock">
                  </div>
				  <div class="col-lg-6">
                    <textarea type="text" class="form-control form-control-user" id="txtRemark" name="txtRemark" placeholder="Remark"></textarea>
                  </div>
                </div>
                <div class="form-group row">
					<div class="col-sm-2"> <br />
					<input type="button" value="+ Add row" id="purchase_details" class="form-control btn btn-secondary" />
					</div>
                </div>
				
				<br />
           <table id="table" name="table" class="table table-striped table-bordered table-hover" ><!--style="display:hide()"-->
                      <thead>
                        <tr>
                          <th>Stock Name</th>
						   <th>Quantity</th>
                           <th>Required For</th>
                           <th>Store Stock Page No. and Stock</th>
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
                    <button type="submit" name="submit" id="AddPurchase" class="btn btn-primary btn-user btn-block">Purchase Order</button>
					</div>
                    </div>
					
                
              </form>
		  </div>
                </div>
              </div>
			  
			  
          <!-- Content Row -->
          
<br />

	      <?php
        if(isset($distinctOrderData['flag'])!='' && $distinctOrderData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Purchase Order List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Order Number</th>
                              <th>Order Date</th>
                              <th>Address</th>
                              <th>Operation</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($distinctOrderData['flag']==1)  {
                                foreach($distinctOrderData['distinctOrderData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['order_no'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($val['order_date']));?></td>
                                <td><?php echo $val['order_address'];?></td>
                                <td><a href="<?php echo site_url(); ?>PurchaseOrder/view_purchase_order/<?php echo $val['id'];?>">View</a></td>
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
		$("#AddPurchase").hide(); 
});

$(document).ready(function(){
	 
 
	$("#purchase_details").click(function(){
		$("#table").show(); 
		$("#table").append('<tr valign="top"><td><input type="hidden" name="txtStockName[]" id="txtStockName_j" value="'+$("#txtStockName").val()+'" />'+$('#txtStockName option:selected').text()+'</td><td><input type="hidden" name="txtQuantity[]" value="'+$("#txtQuantity").val()+'" />'+$("#txtQuantity").val()+'</td><td><input type="hidden" name="txtRequiredFor[]" value="'+$("#txtRequiredFor").val()+'" />'+$("#txtRequiredFor").val()+'</td><td><input type="hidden" name="txtStoreStock[]" value="'+$("#txtStoreStock").val()+'" />'+$("#txtStoreStock").val()+'</td><td ><input type="hidden" name="txtRemark[]" value="'+$("#txtRemark").val()+'" />'+$("#txtRemark").val()+'</td><td  class="text-danger"><a href="javascript:void(0);" class="text-danger remCF">Remove</a></td></tr>');
	
		btnCheck();
		$('#txtStockName').val('');
		$('#txtQuantity').val('');
		$('#txtRequiredFor').val('');
		$('#txtStoreStock').val('');
		$('#txtRemark').val('');
		
	});
        
    $("#table").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});

 function btnCheck(){
if(!$('#txtStockName').val()){
    $('#AddPurchase').hide();
	$('#notice_alert').show();
}
else {
    $('#AddPurchase').show();
	$('#notice_alert').hide();
}
};
</script>
</body>

</html>
