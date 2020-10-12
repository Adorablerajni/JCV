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
				          <tr>
				              <td colspan="5"><?php echo $transactions_list_byid['transactions_list_byid'][0]['party_name']; ?> <br /><?php echo $transactions_list_byid['transactions_list_byid'][0]['party_address']; ?></td>
				              <td style="vertical-align:top" colspan="3"><?php echo date('d-m-Y', strtotime($transactions_list_byid['transactions_list_byid'][0]['invoice_date'])); ?></td>
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
				              <td align="center"><b>Tax</b></td>
				              <td align="center"><b>Price</b></td>
				          </tr>
				          <?php
				          $transactions_products_byid = $this->Transaction_model->transactions_products_byid($t_id);
				          //print_r($transactions_products_byid);
                        $i=1;
                        if($transactions_products_byid['flag']==1)  {
                        foreach($transactions_products_byid['transactions_products_byid'] as $value){
                            
                           // print_r($transactions_products_byid);
                        ?>	
				          <tr>
				              <td align="center"><?php echo $i++ ;?></td>
				              <td><?php echo $value['product_name']; ?></td>
				              <td><?php echo $value['company']; ?></td>
				              <td align="center"><?php echo $value['packing']; ?></td>
				              <td align="center"><?php echo $value['quantity']; ?></td>
				              <td align="center"><?php echo $value['rate']; ?></td>
				              <td align="center"><?php echo $value['tax']; ?></td>
				              <td align="center"><?php echo $value['amount']; ?></td>
				          </tr>
				          
				          <?php } } ?>
				          <tr>
				              <td align="right" colspan="7">Taxable Amount</td>
				              <td align="center"><?php echo $transactions_list_byid['transactions_list_byid'][0]['taxable_amount']; ?></td>
				          </tr>
				          <tr>
				              <td align="right" colspan="7">GST</td>
				              <td align="center"><?php echo $transactions_list_byid['transactions_list_byid'][0]['total_gst']; ?></td>
				          </tr>
				          <tr>
				              <td align="right" colspan="7">Amount</td>
				              <td align="center"><?php echo $transactions_list_byid['transactions_list_byid'][0]['final_amount']; ?></td>
				          </tr>
				          <tr>
				              <td align="right" colspan="7"><span class="text-primary" style="float:left"><b>Bank Details:</b></span>Freight Charges</td>
				              <td align="center"><?php echo $transactions_list_byid['transactions_list_byid'][0]['freight_any']; ?></td>
				          </tr>
				          <tr>
				              <td align="right" colspan="7">Additional Charges</td>
				              <td align="center"><?php echo $transactions_list_byid['transactions_list_byid'][0]['additional_cost']; ?></td>
				          </tr>
				          <tr>
				              <td align="right" colspan="7"><b class="text-primary">Total Amount</b></td>
				              <td align="center"><?php echo $transactions_list_byid['transactions_list_byid'][0]['total_amount']; ?></td>
				          </tr>
				          
				      </table>
                     <br /><br /><br />
                     <p align="center"><a href="" onclick="window.print();" style="margin-left:10px" class="btn btn-primary hh2"><i class="icon-print"></i> Print</a> <a href="<?php echo base_url(); ?>Transactions/mail_pdf/<?php echo $t_id; ?>" class="btn btn-warning hh2"><i class="icon-print"></i> Email</a></p>
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