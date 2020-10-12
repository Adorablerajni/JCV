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
                              //if($purchaseOrderData['flag']==1)  {
                                       ?> 
				<br /> 
            <div class="row">
				<div class="col-sm-12">
				  <div class="table-responsive" >
				      <table class="table-bordered" id="dataTable" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
				          <tr>
				              <td width="100px"></td>
				              <td align="center"><span style="font-size:22px">महिला आजीविका ओधौगिक सहकारी संस्था मर्यादित -  देवास</span> <br /><span style="margin-top:-5px">Mahila Ajivika Audyogik Sahkari Sanstha Maryadit Dewas</span> <br /> (Ready To Eat Energy Food Plant) - Dewas</td>
				              <td width="100px"></td>
				          </tr>
				          <tr>
				              <td colspan="3" align="center">रामनगर के पास खटाम्बा, पोस्ट खटाम्बा, तहसील व जिला देवास 455001 (म. प्र.), Mail Id- Maaudyogikssmdewas@gmail.com<br />पंजीयन क्रमांक / आर. सी. एस. / नवाचार / 2018 /274 , मो. 702410121 , जीएसटी नं 23AAIAM3935F1ZQ </td>
				          </tr>
				      </table>
                     <table class="table-bordered" id="dataTable" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                        <thead>
                            
                            <tr align="center"><th colspan="6">DELIVERY CHALLAN</th></tr>
                            
                            <tr>
                                <th rowspan="8" align="top" colspan="2">
                                    M.P. Agrotonics Ltd.  <br />
                                    Joint Sector Of M.P. State Agro Industries  <br />
                                    D 13 Phase II Satlapur Growth Center Industrial Area,  <br />
                                    Mandideep Disst. Raisen M.P. - 462046  <br />
                                    (GSTIN 23AADCM7417PIZ5) <br />
                                    <br />
                                    <br />
                                    <br />
                                    
                                    PROJECT OFFICER <br />
                                    
                                    
                                    <!--Development Corp. Ltd.,Bhopal
                                    महिला आजिविका ओधौगिक सरकारी संस्था मर्यादित - देवास <br />
                                    राम नगर के पास खटाम्बा, पोस्ट खटाम्बा, तहसील देवास, जिला देवास ; म. प्र.- 455001  <br />
                                    Mail Id - maaudyogikssmdevas@fmail.com <br />
                                    पंजीयन क्रमांक / आर सी एस /नवाचार / 2018 / 274  <br />
                                    जीएसटी  नं . - 23AAIAM3935F1ZQ <br />
                                    Mobile No. 702401421  <br />-->
                                </th>
                                <th>Challan No</th>
                                <th></th>
                                <th>Date</th>
                                <th></th>
                                
						   </tr>
						   
                            <tr>
                                <th>WCD Order No</th>
                                <th></th>
                                <th>Date</th>
                                <th></th>
						    </tr>
						   
                            <tr>
                                <th>AGRO Order No</th>
                                <th></th>
                                <th>Date</th>
                                <th></th>
						    </tr>
						   
                            <tr>
                                <th>LR No</th>
                                <th></th>
                                <th>Date</th>
                                <th></th>
						    </tr>
						    
						    <tr>
                                <th>Truck No</th>
                                <th colspan="3"></th>
						    </tr>
						    
						    <tr>
                                <th>Driver Mob No</th>
                                <th colspan="3"></th>
						    </tr>
						    
						    <tr>
                                <th>Destination</th>
                                <th colspan="3"></th>
						    </tr>
						    
						    <tr>
                                <th>Transporter</th>
                                <th colspan="4"></th>
						    </tr>
						    
                           
                           
                           </thead>
						<thead>
                           <tr align="center" style="border-top:0px">
                              <!--<th>S.no.</th>-->
							  <th>ITEM</th>
						      <th colspan="2">BATCH NO.</th>
                              <th>NO. OF BAGS</th>
                              <th width="180px;">PACKETS</th>
                              <th>QTY (M.T.)</th>
                           </tr>
						</thead>
                        <tbody>
						
						      <tr>
                                <td><strong>SOYA BARFI</strong><br /> GM*20 PKTS = 15 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>AATA BESAN LADDU</strong><br /> GM*20 PKTS = 15 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI 750 GM</strong><br /> GM*20 PKTS = 15 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>HALWA</strong><br /> GM*40 PKTS = 24 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>BALAAHAR</strong><br /> GM*40 PKTS = 24 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI 625 GM</strong><br /> GM*40 PKTS = 25 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              
                              
                              <tr style="font-weight:bold;" align="center">
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td><?php //echo $val['required_for'];?></td>
                                <td><?php //echo $val['store_stock'];?></td>
                                <td><?php //echo $val['remark'];?></td>
                              </tr>  
                       </tbody>
                       <tr><td colspan="6"><div style="vertical-align:bottom;float:right;padding-right:60px"><br /><br /><br /> Authorized Signatory</div></td></tr>
                       <tr align="center"><th colspan="6">Received Material In Good Condition</th></tr>
                       
						<thead>
                           <tr align="center" style="border-top:0px">
                              <!--<th>S.no.</th>-->
							  <th>ITEM</th>
						      <th colspan="2">BATCH NO.</th>
                              <th>NO. OF BAGS</th>
                              <th width="180px;">PACKETS</th>
                              <th>QTY (M.T.)</th>
                           </tr>
						</thead>
                        <tbody>
						
						      <tr>
                                <td><strong>SOYA BARFI</strong><br /> GM*20 PKTS = 15 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>AATA BESAN LADDU</strong><br /> GM*20 PKTS = 15 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI 750 GM</strong><br /> GM*20 PKTS = 15 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>HALWA</strong><br /> GM*40 PKTS = 24 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>BALAAHAR</strong><br /> GM*40 PKTS = 24 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><strong>KHICHDI 625 GM</strong><br /> GM*40 PKTS = 25 KG</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              
                              
                              <tr style="font-weight:bold;" align="center">
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php //echo $val['store_stock'];?></td>
                                <td><?php //echo $val['remark'];?></td>
                              </tr>  
                       </tbody>
                       
                       <tbody>
                           <tr align="left"><th colspan="4">प्रमाणित किया जाता है की एकीकृत बाल विकास परियोजना <?php echo ""; ?> जिला <?php echo ""; ?> को एम पी एग्रो इन्डस्ट्रीज की और से माह <?php echo ""; ?> मे कुल <?php echo ""; ?> बैग (<?php echo ""; ?> मी. टन) पोषण आहार अच्छी स्थिती मे प्राप्त हुआ परियोजना के भण्डार पंजी के प्रष्ट क्र ............ दिनांक .................... पर दर्ज की गई है | </th><th colspan="2" style="text-align:center;"><br/><br/>FOR CDPO <br /><br /><br /><br /><br /></th></th></tr>
                           
                           
                       </tbody>
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
