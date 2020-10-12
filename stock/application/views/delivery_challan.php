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
<style>
    td, th{padding:3px 15px !important;}
</style>
<style>
    .watermark {
    position: absolute;
    color: lightgray;
    opacity: 0.25;
    font-size: 6em;
    width: 100%;
    top: 45%;    
    text-align: center;
    z-index: 0;
    -ms-transform: rotate(60deg); /* IE 9 */
  -webkit-transform: rotate(60deg); /* Safari 3-8 */
  transform: rotate(-30deg);
}
@media print {
   a {
       color:black;
       text-decoration:none;
   }
}
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
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
                </div>
				<br />
		<div class="col-sm-12" align="right">
		<input type='button' class="" value='Print this page' onClick="window.printDiv('purchase_format')">
		</div>
        <div class="card-body" id="purchase_format">
						<?php 
                              if($DispatchReportData['flag']==1)  {
                                       ?> 
				<br /> 
            <div class="row">
				<div class="col-sm-12">
				  <div class="table-responsive" >
				      <?php if($DispatchReportData['DispatchReportData'][0]['del_status']=="Pending") { ?>
				      <div class="watermark">UNAPPROVED</div>
				      <?php } ?>
				      <table id="dataTable" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
				          <tr>
				              <td width="100px"><img src="http://visuotech.com/Aahaar/assets/img/logo.jpg" width="80px" /></td>
				              <td align="center"><span style="font-size:22px">महिला आजीविका ओधौगिक सहकारी संस्था मर्यादित -  देवास</span> <br /><span style="margin-top:-5px">Mahila Ajivika Audyogik Sahkari Sanstha Maryadit Dewas</span> <br /> (Ready To Eat Energy Food Plant) - Dewas</td>
				              <td width="100px"><img src="http://visuotech.com/Aahaar/assets/img/logo.jpg" width="80px" /></td>
				          </tr>
				          <tr>
				              <td colspan="3" align="center">रामनगर के पास खटाम्बा, पोस्ट खटाम्बा, तहसील व जिला देवास 455001 (म. प्र.), Mail Id- Maaudyogikssmdewas@gmail.com<br />पंजीयन क्रमांक / आर. सी. एस. / नवाचार / 2018 /274 , मो. 7024101421 , जीएसटी नं 23AAIAM3935F1ZQ </td>
				          </tr>
				      </table>
                     <table class="table-bordered" id="dataTable" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:15px">
                        <thead>
                            
                            <tr align="center"><th colspan="6">DELIVERY CHALLAN</th></tr>
                            
                            <tr>
                                
                                <th colspan="3">Challan No.: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_challan_no']; ?></th>
                                <th colspan="3">Date: &nbsp;&nbsp;&nbsp; <?php  if($DispatchReportData['DispatchReportData'][0]['del_challan_date'] ==""){echo " ";} else { date_default_timezone_set('Asia/Kolkata'); echo date('d-m-Y', strtotime($DispatchReportData['DispatchReportData'][0]['del_challan_date'])); } ?></th>
                                
						   </tr>
						    <tr>
                                <th colspan="6">Project: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['project_name']; ?></th>
						    </tr>
						   <tr>
                                <th colspan="6">District: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_city']; ?></th>
						    </tr>
						    
						    <tr>
                                <th colspan="6">Project Officer <br /> Women & Child Development Department<br /> Project ............................</th>
						    </tr>
						    <tr>
                                
                                <th colspan="3">Mobile No.: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_mobile_no']; ?></th>
                                <th colspan="3">Tel./Fax No.: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_fax']; ?></th>
                                
						   </tr>
                            <tr>
                                <th colspan="3">WCD Order No.: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_wcd_no']; ?></th>
                               
                                <th colspan="3">Date: &nbsp;&nbsp;&nbsp; <?php  if($DispatchReportData['DispatchReportData'][0]['del_wcd_date'] ==""){echo " ";} else { date_default_timezone_set('Asia/Kolkata'); echo date('d-m-Y', strtotime($DispatchReportData['DispatchReportData'][0]['del_wcd_date'])); } ?></th>
						    </tr>
						   
                            <tr>
                                <th colspan="3">LR No.: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_lr_no']; ?></th>
                                <th colspan="3">Date: &nbsp;&nbsp;&nbsp; <?php  if($DispatchReportData['DispatchReportData'][0]['del_lr_date'] ==""){echo " ";} else { date_default_timezone_set('Asia/Kolkata'); echo date('d-m-Y', strtotime($DispatchReportData['DispatchReportData'][0]['del_lr_date'])); } ?></th>
						    </tr>
						    
						    <tr>
                                <th colspan="6">Transporter: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_transporter']; ?></th>
						    </tr>
						    
						    <tr>
                                <th colspan="6">Vehicle No.: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_vehicle_no']; ?></th>
						    </tr>
						    
						    <tr>
                                <th colspan="6">&nbsp;</th>
						    </tr>
						    <tr>
                                <th colspan="6" align="center" style="text-align:center">Destination: &nbsp;&nbsp;&nbsp; <?php echo $DispatchReportData['DispatchReportData'][0]['del_destination']; ?></th>
						    </tr>
						    <tr>
                                <th colspan="6" align="center" style="text-align:center">2019-20.....  Order</th>
						    </tr>
						    <tr>
                                <th colspan="6" align="center" style="text-align:center">	
                                <?php 
						    if($DispatchReportData['DispatchReportData'][0]['del_project_type']=="Normal"){
						?>
						Take Home Rashan Yojna 
						<?php
                               }
                               else {
						?> 
						UNDER ADOLESCENT GIRLS YOJNA AND OTHER YOJNA TO BE INCORPORATED
						<?php
                               }
						?>
						</th>
						    </tr>
						    <tr>
                                <th colspan="6" align="center" style="text-align:center">Description of Goods</th>
						    </tr>
						    
                           </thead>
						<thead>
                           <tr align="center" style="border-top:0px">
                              <!--<th>S.no.</th>-->
							  <th>ITEM</th>
							  <th>No. Of Packets & Weight Of Each Bag</th>
						      <th>BATCH NO.</th>
                              <th>NO. OF BAGS</th>
                              <th>PACKETS</th>
                              <th>QTY (M.T.)</th>
                           </tr>
						</thead>
                        <tbody>
						<?php 
						    if($DispatchReportData['DispatchReportData'][0]['del_project_type']=="Normal"){
						      
						?>
						      <tr>
                                <td><strong>GEHU SOYA BARFI PREMIX 750GM</strong></td>
                                <td align="center">750GM x 20 PKTS = 15 KG</td>
                                <td align="center"><?php echo $soya_batch=  $DispatchReportData['DispatchReportData'][0]['del_soya_batch']; ?></td>
                                <td align="center"><?php echo $soya_bags= $DispatchReportData['DispatchReportData'][0]['del_soya_bags']; ?></td>
                                <td align="center"><?php echo $soya_packets= $DispatchReportData['DispatchReportData'][0]['del_soya_packets']; ?></td>
                                <td align="center"><?php echo $soya_quantity= $DispatchReportData['DispatchReportData'][0]['del_soya_quantity']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>AATA BESAN LADDU PREMIX 750GM</strong></td>
                                <td align="center">750GM x 20 PKTS = 15 KG</td>
                                <td align="center"><?php echo $abl_batch=  $DispatchReportData['DispatchReportData'][0]['del_abl_batch']; ?></td>
                                <td align="center"><?php echo $abl_bags= $DispatchReportData['DispatchReportData'][0]['del_abl_bags']; ?></td>
                                <td align="center"><?php echo $abl_packets= $DispatchReportData['DispatchReportData'][0]['del_abl_packets']; ?></td>
                                <td align="center"><?php echo $abl_quantity= $DispatchReportData['DispatchReportData'][0]['del_abl_quantity']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI 750 GM</strong></td>
                                <td align="center">750GM x 20 PKTS = 15 KG</td>
                                <td align="center"><?php echo $khi750_batch=  $DispatchReportData['DispatchReportData'][0]['del_khi750_batch']; ?></td>
                                <td align="center"><?php echo $khi750_bags= $DispatchReportData['DispatchReportData'][0]['del_khi750_bags']; ?></td>
                                <td align="center"><?php echo $khi750_packets= $DispatchReportData['DispatchReportData'][0]['del_khi750_packets']; ?></td>
                                <td align="center"><?php echo $khi750_quantity= $DispatchReportData['DispatchReportData'][0]['del_khi750_quantity']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>HALWA A PREMIX 600GM</strong></td>
                                <td align="center">600GM x 40 PKTS = 24 KG</td>
                                <td align="center"><?php echo $halwa_batch=  $DispatchReportData['DispatchReportData'][0]['del_halwa_batch']; ?></td>
                                <td align="center"><?php echo $halwa_bags= $DispatchReportData['DispatchReportData'][0]['del_halwa_bags']; ?></td>
                                <td align="center"><?php echo $halwa_packets= $DispatchReportData['DispatchReportData'][0]['del_halwa_packets']; ?></td>
                                <td align="center"><?php echo $halwa_quantity= $DispatchReportData['DispatchReportData'][0]['del_halwa_quantity']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>BALAAHAR PREMIX 600GM</strong></td>
                                <td align="center">600GM x 40 PKTS = 24 KG</td>
                                <td align="center"><?php echo $balahar_batch=  $DispatchReportData['DispatchReportData'][0]['del_balahar_batch']; ?></td>
                                <td align="center"><?php echo $balahar_bags= $DispatchReportData['DispatchReportData'][0]['del_balahar_bags']; ?></td>
                                <td align="center"><?php echo $balahar_packets= $DispatchReportData['DispatchReportData'][0]['del_balahar_packets']; ?></td>
                                <td align="center"><?php echo $balahar_quantity= $DispatchReportData['DispatchReportData'][0]['del_balahar_quantity']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI PREMIX 625 GM</strong></td>
                                <td align="center">625GM x 40 PKTS = 25 KG</td>
                                <td align="center"><?php echo $khi625_batch=  $DispatchReportData['DispatchReportData'][0]['del_khi625_batch']; ?></td>
                                <td align="center"><?php echo $khi625_bags= $DispatchReportData['DispatchReportData'][0]['del_khi625_bags']; ?></td>
                                <td align="center"><?php echo $khi625_packets= $DispatchReportData['DispatchReportData'][0]['del_khi625_packets']; ?></td>
                                <td align="center"><?php echo $khi625_quantity= $DispatchReportData['DispatchReportData'][0]['del_khi625_quantity']; ?></td>
                              </tr>
                              
                              <tr style="font-weight:bold;" align="center">
                                <td colspan="2">Total</td>
                                <td align="center"><?php echo $batch_total = $soya_batch + $abl_batch + $khi750_batch + $halwa_batch + $balahar_batch + $khi625_batch; ?></td>
                                <td align="center"><?php echo $bags_total = $soya_bags + $abl_bags + $khi750_bags + $halwa_bags + $balahar_bags + $khi625_bags; ?></td>
                                <td align="center"><?php echo $packets_total = $soya_packets + $abl_packets + $khi750_packets + $halwa_packets + $balahar_packets + $khi625_packets; ?></td>
                                <td align="center"><?php echo $quantity_total = $soya_quantity + $abl_quantity + $khi750_quantity + $halwa_quantity + $balahar_quantity + $khi625_quantity; ?></td>
                              </tr>  
                              <?php
                               }
                               else {
						?>
                              <tr>
                                <td><strong>GEHU SOYA BARFI PREMIX 900 GM</strong></td>
                                <td align="center">900GM x 20PKTS = 18 KG</td>
                                <td align="center"><?php echo $brf900_batch=  $DispatchReportData['DispatchReportData'][0]['del_brf900_batch']; ?></td>
                                <td align="center"><?php echo $brf900_bags= $DispatchReportData['DispatchReportData'][0]['del_brf900_bags']; ?></td>
                                <td align="center"><?php echo $brf900_packets= $DispatchReportData['DispatchReportData'][0]['del_brf900_packets']; ?></td>
                                <td align="center"><?php echo $brf900_quantity= $DispatchReportData['DispatchReportData'][0]['del_brf900_quantity']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI PREMIX 900 GM</strong></td>
                                <td align="center">900GM x 20PKTS = 18 KG</td>
                                <td align="center"><?php echo $khi900_batch=  $DispatchReportData['DispatchReportData'][0]['del_khi900_batch']; ?></td>
                                <td align="center"><?php echo $khi900_bags= $DispatchReportData['DispatchReportData'][0]['del_khi900_bags']; ?></td>
                                <td align="center"><?php echo $khi900_packets= $DispatchReportData['DispatchReportData'][0]['del_khi900_packets']; ?></td>
                                <td align="center"><?php echo $khi900_quantity= $DispatchReportData['DispatchReportData'][0]['del_khi900_quantity']; ?></td>
                              </tr>
                              
                              <tr style="font-weight:bold;" align="center">
                                <td colspan="2">Total</td>
                                <td align="center"><?php echo $batch_total_sabla = $brf900_batch + $khi900_batch; ?></td>
                                <td align="center"><?php echo $bags_total_sabla = $brf900_bags + $khi900_bags; ?></td>
                                <td align="center"><?php echo $packets_total_sabla = $brf900_packets + $khi900_packets; ?></td>
                                <td align="center"><?php echo $quantity_total_sabla = $brf900_quantity + $khi900_quantity; ?></td>
                              </tr>  
                              <?php
                               }
						?>
						
                       </tbody>
                       <tr><td colspan="6"><div style="float:right;text-align:right"><br /><br /><br /> Ready To Eat Energy Food Plant Dewas<br /> AUTHORIZED SIGNATORY</div></td></tr>
                       <tr align="center"><th colspan="6">RECEIVED MATERIAL IN GOOD CONDITION</th></tr>
                       
						<thead>
                           <tr align="center" style="border-top:0px">
                              <!--<th>S.no.</th>-->
							  <th>ITEM</th>
						      <th colspan="2">NO. OF PACKETS & WEIGHT OF EACH BAG</th>
                              <th>NO. OF BAGS</th>
                              <th>QTY (M.T.)</th>
                              <th>REMARK</th>
                           </tr>
						</thead>
                        <tbody>
						<?php 
						    if($DispatchReportData['DispatchReportData'][0]['del_project_type']=="Normal"){
						?>
						      <tr>
                                <td><strong>GEHU SOYA BARFI PREMIX 750GM</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>AATA BESAN LADDU PREMIX 750GM</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI 750 GM</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>HALWA A PREMIX 600GM</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>BALAAHAR PREMIX 600GM</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI PREMIX 625 GM</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            <?php
                               }
                               else {
						?>   
                              <tr>
                                <td><strong>GEHU SOYA BARFI PREMIX 900 GM</strong></td>
                                <td align="center">900GM</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI PREMIX 900 GM</strong></td>
                                <td align="center">900GM</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                           <?php
                               }  
                               
                               ?> 
                              <tr style="font-weight:bold;" align="center">
                                <td colspan="3"> Grand Total</td>
                                <td></td>
                                <td><?php //echo $val['store_stock'];?></td>
                                <td><?php //echo $val['remark'];?></td>
                              </tr>  
                       </tbody>
                       
                       <tbody>
                           <tr align="left"><th colspan="2"></th><th colspan="4" style="text-align:right;"><br/><br/><strong>FOR WOMEN & CHILD DEV. DEPARTMENT</strong></th></tr>
                           <tr align="left"><th colspan="2"></th><th colspan="4" style="text-align:right;padding-right:140px"><br/><br/>Authorized Signatory<br />(Name with Sign.)</th></tr>
                           
                       </tbody>
                     </table>
                  </div>
                </div>
		    </div>
							   <?php }  ?> <br />
							   <?php  if($DispatchReportData['DispatchReportData'][0]['del_status']=="Pending") { ?>
        <?php if($_SESSION['user_type']=='APM' || $_SESSION['user_type']=='Admin'){ ?>
        <form action="<?php echo site_url();?>Dispatch/approve_dispatch_letter" class="col-sm-12" method="POST">
         <p align="center">
             <input type="hidden" class="form-control form-control-user" id="hdnid" name="hdnid" autocomplete="off" value="<?php echo $DispatchReportData['DispatchReportData'][0]['id']; ?>">
             <input type="hidden" class="form-control form-control-user" id="user_id" name="user_id" autocomplete="off" value="<?php echo $_SESSION['user_id']; ?>">
             <input type="hidden" class="form-control form-control-user" id="user_name" name="user_name" autocomplete="off" value="<?php echo $_SESSION['full_name']; ?>">
         <input type="submit" name="submit" class="btn btn-success"  value="Approve Challan"/>
         </p>
         <?php }} ?>
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
