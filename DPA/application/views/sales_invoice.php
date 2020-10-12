<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Purchase List | Mercure DPA</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <?php include_once('include/headerlinks.php'); ?>
</head>

<body class="theme-cyan">
<?php include_once('include/header.php'); ?>
   <?php include_once('include/sidebar.php'); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
			
                <h2>
                    
                </h2>
				
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Purchase  List
                            </h2>
                            
                            <ul class="header-dropdown m-r--5" style="display: none;">
                                <li class="dropdown">
								<a href="<?php echo base_url(); ?>Transactions/add_transaction">
                                    <button type="button" class="btn bg-deep-orange waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">add</i>
                                    <span>New Transaction</span>
                                </button>
								</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?php if($this->session->flashdata('message')){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice Date</th>
                                            <th>Voucher No.</th>
                                            <th>CompanyID</th>
                                            <th>Type</th>
                                            <th>CID</th>
                                            <th>VCN</th>
											<th>Quantity</th>
											<th>Amount</th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$i=1;
if($purchase_list['flag']==1)  {
    // print_r($purchase_list);
foreach($purchase_list['purchase_list'] as $value){
?>	
										<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo date('d-m-Y', strtotime($value['Date'])); ?></td>
										<td><?php echo $value['Voucher'];?></td>
                                        <td><?php echo $value['CompanyID'];?></td>
										<td><?php echo $value['Type']; ?></td>
										<td><?php echo $value['CID']; ?></td>
										<td><?php echo $value['VCN']; ?></td>
										<td><?php echo $value['Qty']; ?></td>
										<td>Rs. <?php echo $value['Amount']; ?></td>
										<td align="center"><div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        ACTION <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="<?php echo base_url(); ?>Sales/invoice/<?php echo $value['Voucher']; ?>" target="_new">Print</a></li>
                                        <!-- <li><a href="javascript:void(0);" class="modal_open" data-id="<?php /* echo $value['Voucher'];  ?>" data-date ="<?php echo $value['Date']; */ ?>" >Update Dispatch Details</a></li>-->
                                        <!--<li><a href="javascript:void(0);"  class="modal_lr" data-id="<?php /* echo $value['Voucher']; ?>" data-date ="<?php echo $value['Date'];*/ ?>" >Update LR</a></li>-->
                                        <!--<li><a href="javascript:void(0);">Send final INVOICE copy</a></li>-->
                                        <li><a href="javascript:void(0);">Email</a></li>
                                        <li><a href="javascript:void(0);">Edit</a></li>
                                        <li><a href="javascript:void(0);">Delete</a></li>
                                    </ul>
                                </div></td>
										</tr>
<?php } } ?>										
                                    </tbody>
                                   
                                </table>
                                      <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                        
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close dispatch_modal" >&times;</button>
                                                <h4 class="modal-title">Update Dispatch Details</h4>
                                              </div>
                                              <form id="form_validation" method="POST">
                                              <div class="modal-body">
                                                <!--  <div class="card">-->
                                                     <div class="body">
                                                        <div class="row clearfix">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Date of Dispatch</label>
                                                                            <input type="date" class="form-control form-line" name="date_of_dispatch" id="date_of_dispatch">
                                                                        </div>   
                                                                    </div>
                                                                 </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form">
                                                                            <label class="form-label">DUE DATE</label>
                                                                            <input type="date" class="form-control form-line" name="due_date" id="due_date">
                                											
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form">
                                                                            <label class="form-label">Transport</label>
                                                                            <input type="text" class="form-control form-line" name="transport" id="transport">
                                											
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" id="Voucher" value="">
                                                                <input type="hidden" id="Date" value="">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="form">
                                                                            <label class="form-label">FREIGHT AMT </label>
                                                                            <input type="text" class="form-control form-line" name="frieght_amt" id="frieght_amt">
                                											
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <!--</div>-->
                                                </div>   
                                              <div class="modal-footer">
                                                    <div class="col-md-12 pull-right">
                                                        <div class="form-group">
                                                            
                                                            <button class="btn btn-primary waves-effect" type="button" id="update_dispatch">Update</button>
                                                        </div>
                                                    </div>
                                              </div>
                                               </form>
                                            </div>
                                        
                                          </div>
                                    </div>
                                         <!-- Modal -->
                                    <div id="myLR" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                        
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close lr_modal" >&times;</button>
                                                <h4 class="modal-title">Update LR Charges</h4>
                                              </div>
                                              <form id="form_validation_lr" method="POST">
                                              <div class="modal-body">
                                                <!--  <div class="card">-->
                                                     <div class="body">
                                                        <div class="row clearfix">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">LR Charges</label>
                                                                            <input type="number" class="form-control form-line" name="lr_charges" id="lr_charges">
                                                                        </div>   
                                                                    </div>
                                                                 </div>
                                                                <div class="col-md-6" style="display:none;">
                                                                    <div class="form-group">
                                                                        <div class="form">
                                                                            <label class="form-label">DUE DATE</label>
                                                                            <input type="date" class="form-control form-line" name="due_date" id="due_date">
                                											
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                
                                                                <input type="hidden" id="Voucher" value="">
                                                                <input type="hidden" id="Date" value="">
                                                                
                                                        </div>
                                                    </div>
                                                    <!--</div>-->
                                                </div>   
                                              <div class="modal-footer">
                                                    <div class="col-md-12 pull-right">
                                                        <div class="form-group">
                                                            
                                                            <button class="btn btn-primary waves-effect" type="button" id="update_lr">Update</button>
                                                        </div>
                                                    </div>
                                              </div>
                                               </form>
                                            </div>
                                        
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
	<!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/pages/tables/jquery-datatable.js"></script>
  <script>
    //  $(document).ready(function(){
    //      $(document).on('click','.dispatch_modal',function(){
    //         $("#form_validation"). trigger("reset");
    //         $('#myModal').modal('hide');
    //     });
    //     $(document).on('click','.lr_modal',function(){
    //         // alert('Hello Coulmn');
    //         $("#form_validation_lr"). trigger("reset");
    //         $('#myLR').modal('hide');
    //     });
    //     $(document).on('click','.modal_lr',function(){
    //       $('#myLR').modal('show'); 
    //       $('#myLR').modal({backdrop: 'static', keyboard: false});
    //       var Voucher = $(this).attr('data-id');
    //       var Date = $(this).attr('data-date');
    //       $.ajax({
    //             url: "<?php echo base_url(); ?>Dispatch/get_dispatch", // Url to which the request is send
    //             type: "POST",             // Type of request to be send, called as method
    //             data: {'get_request':'get_dispatch','Voucher':Voucher ,'Date' : Date}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    //             success: function(response)   // A function to be called if request succeeds
    //             {
    //                 var data = $.parseJSON(response);
    //                 if(data.flag){
    //                     var details = data.dispatch_details;
    //                     //alert(details.date_of_dispatch);
    //                     if(details.lr_charges != null){
    //                         $('#lr_charges').val(details.lr_charges);
    //                     }
                        
    //                     $('#Voucher').val(details.Voucher);
    //                     $('#Date').val(details.Date);
    //                 }
    //             }                            
    //         });
    //     });
    //     $(document).on('click','#update_lr',function(){
    //             var Voucher = $('#Voucher').val();
    //             var lr_charges = $('#lr_charges').val();
    //          /*   var date_of_dispatch = $('#date_of_dispatch').val();
    //             var due_date = $('#due_date').val();
    //             var transport = $('#transport').val();*/
    //             var Date = $('#Date').val();
    //             alert(Date+Voucher);
    //             $.ajax({
    //             url: "<?php echo base_url(); ?>Dispatch/update_lr", // Url to which the request is send
    //             type: "POST",             // Type of request to be send, called as method
    //             data: {'get_request':'update_dispatch','Date':Date,'Voucher':Voucher,'lr_charges':lr_charges}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    //             success: function(response)   // A function to be called if request succeeds
    //             {
    //                 var data = $.parseJSON(response);
    //                 if(data.flag){
    //                     console.log(data.message);
    //                     //alert(data.message);
    //                     $("#form_validation"). trigger("reset");
    //                      $('#myLR').modal('hide'); 
                        
    //               }
               
    //             }                            
    //         });
    //     });
    //     $(document).on('click','.modal_open',function(){
    //       $('#myModal').modal('show'); 
    //       $('#myModal').modal({backdrop: 'static', keyboard: false});
    //       var Voucher = $(this).attr('data-id');
    //       var Date = $(this).attr('data-date');
    //       $.ajax({
    //             url: "<?php echo base_url(); ?>Dispatch/get_dispatch", // Url to which the request is send
    //             type: "POST",             // Type of request to be send, called as method
    //             data: {'get_request':'get_dispatch','Voucher':Voucher ,'Date' : Date}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    //             success: function(response)   // A function to be called if request succeeds
    //             {
    //                 var data = $.parseJSON(response);
    //                 if(data.flag){
    //                     var details = data.dispatch_details;
    //                     //alert(details.date_of_dispatch);
    //                     if(details.date_of_dispatch != null){
    //                         $('#date_of_dispatch').val(details.date_of_dispatch);
    //                     }
    //                     if(details.frieght_amt != null){
    //                         $('#frieght_amt').val(details.frieght_amt);
    //                     }if(details.transport != null){
    //                         $('#transport').val(details.transport);
    //                     }if(details.due_date != null){
    //                         $('#due_date').val(details.due_date );
    //                     }
    //                     $('#Voucher').val(details.Voucher);
    //                     $('#Date').val(details.Date);
    //                 }
    //             }                            
    //         });
    //     });
    //     $(document).on('click','#update_dispatch',function(){
    //             var Voucher = $('#Voucher').val();
    //             var frieght_amt = $('#frieght_amt').val();
    //             var date_of_dispatch = $('#date_of_dispatch').val();
    //             var due_date = $('#due_date').val();
    //             var transport = $('#transport').val();
    //             var Date = $('#Date').val();
    //             $.ajax({
    //             url: "<?php echo base_url(); ?>Dispatch/update_dispatch", // Url to which the request is send
    //             type: "POST",             // Type of request to be send, called as method
    //             data: {'get_request':'update_dispatch','Date':Date,'Voucher':Voucher,'frieght_amt':frieght_amt,'date_of_dispatch':date_of_dispatch,'transport':transport,'due_date':due_date}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
    //             success: function(response)   // A function to be called if request succeeds
    //             {
    //                 var data = $.parseJSON(response);
    //                 if(data.flag){
    //                     console.log(data.message);
    //                     //alert(data.message);
    //                     $("#form_validation"). trigger("reset");
    //                      $('#myModal').modal('hide'); 
                        
    //               }
               
    //             }                            
    //         });
    //     });
         
    //  });
 </script>
</body>

</html>