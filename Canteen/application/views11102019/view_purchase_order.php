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

  <title>View Order | Aahaar</title>

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
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">View details</h6>
                </div>
				<br />
		<div class="col-sm-12" align="right">
		<input type='button' value='Print this page' onClick="window.printDiv('purchase_format')">
		</div>
        <div class="card-body" id="purchase_format">
						<?php 
                              if($purchaseOrderData['flag']==1)  {
                                       ?> 
				<br />
            <div class="row">
				<div class="col-sm-12">
				  <div class="table-responsive" >
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr align="center"><th colspan="6" >
महिला आजिविका ओधौगिक सरकारी संस्था मर्यादित - देवास <br />
राम नगर के पास खटाम्बा, पोस्ट खटाम्बा, तहसील देवास, जिला देवास ; म. प्र.- 455001  <br />
Mail Id - maaudyogikssmdevas@fmail.com <br />
पंजीयन क्रमांक / आर सी एस /नवाचार / 2018 / 274  <br />
जीएसटी  नं . - 23AAIAM3935F1ZQ <br />
Mobile No. 702401421  <br /></th>
							</tr>
                           <tr><th colspan="6" align="center">Address :<?php echo " "; echo $purchaseOrderData['purchaseOrderData']['0']['order_address'];?></th></tr>
                           <tr align="center"><th colspan="6" >INDENT</th></tr>
                           <tr>
						   <th colspan="3" align="center">No :<?php echo " "; echo $purchaseOrderData['purchaseOrderData']['0']['order_no'];?></th>
						   <th colspan="3" align="center">Date : </label><?php echo " "; echo date('d-m-Y', strtotime($purchaseOrderData['purchaseOrderData']['0']['order_date']));?></th>
						   </tr>
                           <tr align="center"><th colspan="6" >I/We require items/ spares/ consumables/ tools etc as follows</th></tr>
                        </thead>
						<thead>
                           <tr>
                              <th>S.no.</th>
							  <th>Item with all details</th>
						      <th>Quantity required</th>
                              <th>Required For</th>
                              <th width="180px;">Store Stock Page No. and Stock</th>
                              <th>Remark</th>
                           </tr>
						</thead>
                        <tbody>
						<?php $count = 1 ;
                                foreach($purchaseOrderData['purchaseOrderData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['name_of_stock']; echo " ("; echo $val['stock_type']; echo ")";?></td>
                                <td><?php echo $val['quantity_required'];?></td>
                                <td><?php echo $val['required_for'];?></td>
                                <td><?php echo $val['store_stock'];?></td>
                                <td><?php echo $val['remark'];?></td>
                              </tr>
							   <?php } ?> 
                       </tbody>
                       <tbody>
                           <tr>
						   <th colspan="3" align="left"><br />Indentor</th>
						   <th colspan="3" align="right"><br />Authorised Signatory</th>
						   </tr>
						   <tr align="center"><th colspan="6">The above required items are available/ not available in Stock and thus can be issued/ recommended either for purchase or for making other arrangements.</th></tr>
                           <tr align="right"><th colspan="6"><br />Store Incharge</th></tr>
                           <tr align="left"><th colspan="6">Remark of Plant incharge</th></tr>
                           <tr align="right"><th colspan="6"><br />Plant Incharge</th></tr>
                       </tbody>
                     </table>
                  </div>
                </div>
		    </div>
							   <?php }  ?> 
        </div>
</div>
			  
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once('include/footer.php'); ?>
  <?php include_once('include/footerlinks.php'); ?>

</body>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</html>
