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

  <title>Delivery Challan | Aahaar</title>

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
		<input type='button' class="" value='Print this page' onClick="window.printDiv('purchase_format')">
		</div>
        <div class="card-body" id="purchase_format">
						<?php 
                              //if($purchaseOrderData['flag']==1)  {
                                       ?> 
				<br /> 
            <div class="row">
				<div class="col-sm-12">
				  <div class="table-responsive" >
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center"><th colspan="6">DELIVERY CHALLAN</th></tr>
                        </thead>
                        <thead>
                            <tr align="left">
                                <th  colspan="2" rowspan="2" align="top">
                                    AGRO NUTRI FOODS LTD.  <br />
                                    P6. Sec.E Sanwer Road Indore (M.P.)  <br />
									gmail.com<br />
									0731-4078300, GST: 23AAGCM0143F1Z2<br />
                                </th>
									<th  colspan="4">Challan No			Date</th>
									<tr >
										<th colspan="4">Order No & Date</th>
									</tr>
						   </tr>
						   
                            <tr align="left">
                                <th  colspan="2" rowspan="2" align="top">COMMISSIONER,
                                    WOMEN AND CHILD DEVELOPMENT DEPT,  <br />
									BHOPAL (M.P)<br />
								</th>
								<th  colspan="3">Dispatch Doc. No</th>
								<th  colspan="1">Date</th>
								<tr>
									<th  colspan="4">Vehicle No 			Designation</th>
								</tr>
						    </tr>
							
                            <tr align="left">
                                <th colspan="2" rowspan="3" align="top">DESIGNEE,
                                    PROJECT OFFICER (ICDS),  <br />
                                    WOMEN AND CHILD DEVELOPMENT DEPT,  <br />
                                    OR  <br />
									AGAR (M.P)<br />
								</th>
								<th  colspan="4">Dispatch through</th>
								<tr>
									<th colspan="4"></th>
								</tr>
								<tr>
									<th  colspan="4" >CDPO phone No.</th>
								</tr>
						    </tr>
                        </thead>
						    
                          <!-- <tr><th colspan="5" align="center"><?php //echo " "; echo $purchaseOrderData['purchaseOrderData']['0']['order_address'];?></th></tr>-->
                           
                           <!--<tr align="center"><th colspan="6" >INDENT</th></tr>
                           <tr>
						   <th colspan="3" align="center">No :<?php// echo " "; echo $purchaseOrderData['purchaseOrderData']['0']['order_no'];?></th>
						   <th colspan="3" align="center">Date : </label><?php// echo " "; echo date('d-m-Y', strtotime($purchaseOrderData['purchaseOrderData']['0']['order_date']));?></th>
						   </tr>
                           <tr align="center"><th colspan="6" >I/We require items/ spares/ consumables/ tools etc as follows</th></tr>-->
						<thead>
                           <tr align="left">
                              <!--<th>S.no.</th>-->
							  <th>Condition of Goods</th>
						      <th>HSN</th>
                              <th>Batch</th>
                              <th>No. of Bags</th>
                              <th>Packet</th>
                              <th>Quantity</th>
                           </tr>
                           <tr align="left">
                              <!--<th>S.no.</th>-->
							  <th></th>
						      <th>Code</th>
                              <th>No.</th>
                              <th></th>
                              <th></th>
                              <th>in (MT.)</th>
                           </tr>
						</thead>
                        <tbody>
						<?php // $count = 1 ;
                              //  foreach($purchaseOrderData['purchaseOrderData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php //echo $count++ ;?></td>
                                <!--<td><a href="<?php //echo site_url(); ?>PurchaseOrder/edit_purchase_order_list/<?php// echo $val['id']; ?>"><?php //echo $val['name_of_stock']; echo " ("; echo $val['stock_type']; echo ")";?></a></td>-->
                                <td><?php //echo $val['quantity_required'];?></td>
                                <td><?php //echo $val['required_for'];?></td>
                                <td><?php //echo $val['store_stock'];?></td>
                                <td><?php //echo $val['remark'];?></td>
                                <td><?php //echo $val['remark'];?></td>
                              </tr>
							   <?php //} ?> 
							   
                              <tr style="font-weight:bold;" align="left">
                                <td>Total</td>
                                <td></td>
                                <td><?php //echo $val['required_for'];?></td>
                                <td><?php //echo $val['store_stock'];?></td>
                                <td><?php //echo $val['remark'];?></td>
                                <td><?php //echo $val['remark'];?></td>
                              </tr>  
                       </tbody>
                       
                       <tr><th colspan="6" align="left">COMMENT GOODS NOT FOR SALE</th></tr>
                       <tr align="right"><th colspan="6" >For M P Agro Nutri Foods Ltd<br/><br/>Authorised Signatory</th></tr>
                       <tr align="left"><th colspan="6"></th></tr>
                       <tr><th colspan="6">Following Material in Good Condition</th></tr>
                       <thead >
                           <tr align="left">
                              <!--<th>S.no.</th>-->
							  <th>Condition of Goods</th>
                              <th>No. of Bags</th>
                              <th>Packet</th>
                              <th>Quantity in (MT)</th>
                              <th colspan="2">प्रमाण पत्र</th>
                           </tr>
						</thead>
                        <tbody >
						<?php // $count = 1 ;
                              //  foreach($purchaseOrderData['purchaseOrderData'] as $val){
                                       ?> 
                              <tr >
                                <td><?php //echo $count++ ;?></td>
                                <td><?php //echo $val['quantity_required'];?></td>
                                <td><?php //echo $val['required_for'];?></td>
                                <td><?php //echo $val['store_stock'];?></td>
                                <td colspan="2" rowspan="2">प्रमाणित किया जाता हे की एम.पी.एग्रो <br>न्यूट्री फूड्स लिमिटेड, इंदौर  की और से <br> महा ...................... में कुल .................. <br>वेग ( .................... मी.) पोषण आहार <br>अच्छी स्थिति में प्राप्त हुआ हे जैसे <br>परियोजना के भण्डार पंजी के पृष्ठ <br>क्र.  .................... दिनांक  .......................... <br>पर दर्ज की गई हे </td>
                              </tr>
							   <?php //} ?> 
							   
                              <tr style="font-weight:bold;" align="left">
                                <td>Total</td>
                                <td></td>
                                <td><?php //echo $val['required_for'];?></td>
                                <td><?php //echo $val['store_stock'];?></td>
                              </tr>  
                       </tbody>
                       <tr><th colspan="6">matched by 			date 		Name & Seal<br>Received Date</th></tr>
                     </table>
                  </div>
                </div>
		    </div>
							   <?php //}  ?> 
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
