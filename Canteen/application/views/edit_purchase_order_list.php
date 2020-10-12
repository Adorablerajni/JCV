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

  <title>Edit Purchase Order List | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Edit Purchase Order List</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

		<hr /> 
	<?php
    if(isset($EditPurchaseOrderListData['flag'])!='' && $EditPurchaseOrderListData['flag']==1 )
    {
    ?>
    
    <div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Update details</h6>
                </div>
                <div class="card-body">
                <div class="row">
		        <form action="<?php echo site_url(); ?>PurchaseOrder/update_purchase_order_list" class="col-sm-12" method="POST" >
		            
		            <input type="hidden" class="form-control form-control-user" id="hdnid" name="hdnid" autocomplete="off" value="<?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['id']; ?>">
                    
                    <div class="form-group row">
    				<div class="col-lg-4">  
                    <select name="txtStockName" id="txtStockName" class="form-control">
                    <option value="<?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['stock_name']; ?>"><?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['name_of_stock']; ?> - [<?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['stock_type']; ?>]</option>
                    <option value="">Select Stock Name</option>
                    <?php if($stockNameData['flag']){
                    foreach ($stockNameData['stockNameData'] as $value) { ?>
                    <option  value="<?php echo $value['id'] ; ?>"><?php echo $value['stock_name'] ; ?> - [<?php echo $value['stock_type'] ; ?>]</option>
                    <?php } } ?>
                    </select>
                    </div>

    				<div class="col-lg-4">
                    <input type="number" class="form-control form-control-user" id="txtQuantity"  name="txtQuantity" placeholder="Quantity Required" value="<?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['quantity_required']; ?>">
                    </div>
                  
				    <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtRequiredFor" name="txtRequiredFor" placeholder="Required For" value="<?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['required_for']; ?>">
                    </div>
                    </div>
                  
                    <div class="form-group row">
    				  <div class="col-lg-6">
                        <input type="text" class="form-control form-control-user" id="txtStoreStock" name="txtStoreStock" placeholder="Store Stock Page No. and Stock" value="<?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['store_stock']; ?>">
                      </div>
                      
    				  <div class="col-lg-6">
                        <textarea type="text" class="form-control form-control-user" id="txtRemark" name="txtRemark" placeholder="Remark"><?php echo $EditPurchaseOrderListData['EditPurchaseOrderListData']['remark']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group ">
					<div class="col-lg-12">
                    <button type="submit" name="submit" id="AddPurchase" class="btn btn-primary btn-user btn-block">Update Purchase Order List</button>
					</div>
                    </div>
                
                </form>
		        </div>
                </div>
    </div>
			  
			  
          <!-- Content Row -->
          
    <br />

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
