<!DOCTYPE html>
<html><head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>View Invoice | Mercure DPA</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <?php include_once('include/headerlinks.php'); ?>
    <style type="text/css">
@media print
  {
.hh2 ,.hprtbtn,.post_title,.gap,.body_theme,.ftbl{
   display:none;
}
}  
</style>
</head><body class="theme-cyan">
    <section class="">
        <div class="container-fluid">
            <div class="block-header">
			
                <h2>
                    
                </h2>
				
            </div>
            <!-- Exportable Table -->
            <?php
            $t_id =  urldecode($this->uri->segment(3));
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive">
                               <table id="dataTable" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
				          <tr>
				              <td width="80%" colspan="5"><span style="font-size:28px" class="text-primary">Mercure Pharmaceuticals Pvt. Ltd.</span><br />46, IInd Floor, Dawa Bazar, 13-14 RNT Marg, Indore - 452001(M.P.) <br />Phone : 0731-2705050, 2704547<br />E-Mail : mercurepharms@gmail.com</td>
				              <td width="20%" align="center" colspan="3"><span style="font-size:30px"><b>INVOICE</b></span></td>
				          </tr>
				          <tr>
				              <td colspan="8" style="height:50px"></td>
				          </tr>
				          <tr>
				              <td colspan="5" class="text-primary"><b>Bill To:</b></td>
				              <td colspan="3" class="text-primary"><b>Invoice Date:</b></td>
				          </tr>
				          <tr><?php 
				          		// echo "<pre>";
				          		// print_r($dis_list_byid);
				          		// echo "</pre>";


				           ?>
				              <td colspan="5"><?php echo $dis_list_byid['dis_list_byid'][0]['ParNam']; ?> <br /><?php echo $dis_list_byid['dis_list_byid'][0]['ParAdd1']; ?></td>
				              <td style="vertical-align:top" colspan="3"><?php echo date('d-m-Y', strtotime($dis_list_byid['dis_list_byid'][0]['Date'])); ?></td>
				          </tr>
				          <tr>
				              <td colspan="8" style="height:50px"></td>
				          </tr>
				          </table>
				          <style>
				              #dataTable2 tr td{padding:8px;}
				          </style>
				          <table id="dataTable2" width="100%" cellspacing="0" cellpadding="0" border="1px" class="table table-bordered table-striped table-hover dataTable">
				          
				          <tr style="panel-primary">
				              <td align="center" width="80px"><b>S. No.</b></td>
				              <td><b>Product Name</b></td>
				              <td><b>Company</b></td>
				              <td align="center"><b>Packing</b></td>
				              <td align="center"><b>Quantity</b></td>
				              <td align="center"><b>Rate</b></td>
				              <td align="center"><b>Tax %</b></td>
				              <td align="center"><b>Tax Amount</b></td>
				              <td align="center"><b>Price</b></td>
				          </tr>
				          <?php
				          $dis_list_byid = $this->Sales_model->dis_list_byid($t_id);
				          //print_r($dis_list_byid);
                        $i=1;
                        if($dis_list_byid['flag']==1)  {
                            $total_amount = 0; 
                            $total_taxable = 0;
                        foreach($dis_list_byid['dis_list_byid'] as $value){
                            $total_amount = $total_amount + $value['Amount'];
                            $total_taxable  = $total_taxable + $value['GSTAmount'];
                            
                           // print_r($dis_list_byid);
                        ?>	
				          <tr>
				              <td align="center"><?php echo $i++ ;?></td>
				              <td><?php echo $value['Name']; ?></td>
				              <td><?php echo $value['CompName']; ?></td>
				              <td align="center"><?php echo $value['Pack']; ?></td>
				              <td align="center"><?php echo $value['Qty'].' '. $value['Unit']; ?></td>
				              <td align="center">Rs.<?php echo $value['Rate']; ?></td>
				              <td align="center"><?php echo $value['GST']; ?>%</td>
				              <td align="center">Rs.<?php echo $value['GSTAmount']; ?></td>
				              <td align="center">Rs.<?php echo $value['Amount']; ?></td>
				          </tr>
				          
				          <?php } } ?>
				       
				         <tr>
				              <td align="right" colspan="8"> Non-Taxable Amount</td>
				              <td align="center">Rs. <?php echo $total_amount;  $total_bill_amount = 0 ;?></td>
				         </tr>
				        <tr>
				              <td align="right" colspan="8"> Tax Amount</td>
				              <td align="center">Rs. <?php echo $total_taxable; ?></td>
				          </tr> 
				          <!--<tr>-->
				          <!--    <td align="right" colspan="8">GST</td>-->
				              <!--<td align="center"><?php /* echo $dis_list_byid['dis_list_byid'][0]['GST']; */?>%</td>-->
				          <!--</tr>-->
				         
				         <!--  <tr>
				              <td align="right" colspan="8"><span class="text-primary" style="float:left"><b>Bank Details:</b></span>Freight Charges</td>
				              <td align="center"><?php/* echo $dis_list_byid['dis_list_byid'][0]['freight_any']; */?></td>
				          </tr> -->
				          <!-- <tr>
				              <td align="right" colspan="8">Additional Charges</td>
				              <td align="center"><?php/* echo $transactions_list_byid['transactions_list_byid'][0]['additional_cost']; */?></td>
				          </tr> -->
				          <tr>
				              <td align="right" colspan="8"><b class="text-primary">Total Amount</b></td>
				              <td align="center">Rs.<?php $total_bill_amount = $total_taxable + $total_amount;  echo $total_bill_amount;  ?></td>
				          </tr>
				          
				      </table>
                     <br /><br /><br />
                     <p align="center"><a href="" onclick="window.print();" style="margin-left:10px" class="btn btn-primary hh2"><i class="icon-print"></i> Print</a> <a href="<?php echo base_url(); ?>Sales/mail_pdf/<?php echo $t_id; ?>" class="btn btn-warning hh2"><i class="icon-print"></i> Email</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>

    <?php include_once("include/footerjs.php"); ?>
	
</body></html>