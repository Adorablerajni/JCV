<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>Sale List | Mercure DPA</title>
      <!-- Favicon-->
      <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
      <?php include_once('include/headerlinks.php'); ?>
      <style>
         .rectangle_red {
         height: 30px;
         width: 60px;
         background-color: #ff0000;
         }
         .rectangle_green {
         height: 30px;
         width: 60px;
         background-color: #218637;
         }
      </style>
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
                           Sale  List
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
                        <?php if($this->session->flashdata('error_message')){?>
                        <div align="center" class="alert alert-danger">      
                           <?php echo $this->session->flashdata('error_message')?>
                        </div>
                        <?php } ?>
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                              <thead>
                                 <tr>
                                    <th>No</th>
                                    <th>Invoice No.</th>
                                    <th>Date</th>
                                    
                                    <th>Party Name</th>
                                    <th>VCN</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Voucher</th>
                                    <th>Dispatch Status</th>
                                    <th>LR Status</th>
                                    <th>Final Status</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    if($sale_list['flag']==1)  {
                                        // print_r($purchase_list);
                                    foreach($sale_list['sale_list'] as $value){
                                    ?>  
                                 <tr>
                                    <td><?php echo $i++; ?></td>
                                     <td><?php echo $value['VCN'];?></td>
                                    <td><?php echo date("d-m-Y ", strtotime($value['Date'])); ?></td>
                                   
                                    <td><?php echo $value['ParNam'];?></td>                                    
                                                                
                                    <td><?php echo $value['VCN']; ?></td>
                                    <td><?php echo $value['Qty']; ?></td>
                                    <td>Rs. <?php echo $value['Amount']; ?></td>
                                    <td><?php echo $value['Voucher']; ?></td>
                                    
                                    <?php $Voucher = $value['Voucher'];
                                        $Date = $value['Date'];
                                    // $dispatch = $this->Dispatch_model->check_voucher_date_type($value['Voucher'],$value['Date'], 'final_invoice');
                                        $dispatch = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, 'dispatch');
                                        if($dispatch['flag'] !=0){
                                            $dispatch_time = $dispatch['details'][0]['details_sent_mail_time'];
                                            if ($dispatch_time == null || $dispatch_time =='') { 
                                     
                                               echo '<td class="text-danger">Mail Not Sent</td>';
                                            } 
                                            else{
                                                echo "<td class='text-success'>Mail sent at:  ".date("d-m-Y H:i a", strtotime($dispatch_time)).'<span class="glyphicon glyphicon-ok"></span></td>';
                                            }
                                        }
                                        else{
                                             echo '<td class="text-danger">Mail Not Sent<span class="glyphicon glyphicon-remove"></span></td>';
                                        }
                                     ?>
                                    <?php $lr = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, 'LR');
                                        if($lr['flag'] !=0){
                                            $dispatch_time = $lr['details'][0]['details_sent_mail_time'];
                                            if ($dispatch_time == null || $dispatch_time =='') { 
                                     
                                               echo '<td class="text-danger">Mail Not Sent<span class="glyphicon glyphicon-remove"></span></td>';
                                            } 
                                            else{
                                                echo "<td class='text-success'>Mail sent at: ".date("d-m-Y H:i a", strtotime($dispatch_time)).'<span class="glyphicon glyphicon-ok"></span></td>';
                                            }
                                        }
                                        else{
                                             echo '<td class="text-danger">Mail Not Sent<span class="glyphicon glyphicon-remove"></span></td>';
                                        }    
                                        
                                    ?>
                                    <?php $final_invoice = $this->Dispatch_model->check_voucher_date_type($Voucher,$Date, 'final_invoice');
                                        if($final_invoice['flag'] !=0){
                                            $dispatch_time = $final_invoice['details'][0]['details_sent_mail_time'];
                                            if ($dispatch_time == null || $dispatch_time =='') { 
                                     
                                               echo '<td class="text-danger">Mail Not Sent<span class="glyphicon glyphicon-remove"></span></td>';
                                            } 
                                            else{
                                                echo "<td class='text-success'>Mail sent at: ".date("d-m-Y H:i a", strtotime($dispatch_time)).'<span class="glyphicon glyphicon-ok"></span></td>';
                                            }
                                        }
                                        else{
                                             echo '<td class="text-danger">Mail Not Sent<span class="glyphicon glyphicon-remove"></span></td>';
                                        }  
                                    ?>
                                    <td align="center">
                                       <div class="btn-group">
                                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          ACTION <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu">
                                             <li><a href="javascript:void(0);">Action</a></li>
                                             <li><a href="<?php echo base_url(); ?>Sales/invoice/<?php echo $value['VCN']; ?>/<?php echo $value['Date']; ?>"  target="_new" >Print</a></li>
                                             <li><a href="javascript:void(0);" class="modal_open" data-id="<?php echo $value['VCN']; ?>" data-date ="<?php echo $value['Date']; ?>" >Update Dispatch Details</a></li>
                                             <li><a href="javascript:void(0);"  class="modal_lr" data-id="<?php echo $value['VCN']; ?>" data-date ="<?php echo $value['Date']; ?>" >Update LR</a></li>
                                             <li><a href="javascript:void(0);"  class="modal_final_copy" data-id="<?php echo $value['VCN']; ?>" data-date ="<?php echo $value['Date']; ?>" >Send final INVOICE copy</a></li>
                                             <li><a href="javascript:void(0);">Edit</a></li>
                                             <li><a href="javascript:void(0);">Delete</a></li>
                                          </ul>
                                       </div>
                                    </td>
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
                                                         <input type="date" class="form-control form-line" name="date_of_dispatch" id="date_of_dispatch" > 
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <div class="form">
                                                         <label class="form-label">DUE DATE</label>
                                                         <input type="date" class="form-control form-line" name="due_date" id="due_date" >
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <div class="form">
                                                         <label class="form-label">Choose Transporter</label>
                                                           <select class="form-control form-line"   name="transporter" id="transporter">
                                                            
                                                           
                                                         </select>
                                                        
                                                      </div>
                                                   </div>
                                                </div>
                                                <input type="hidden" id="Voucher_dispatch" value="">
                                                <input type="hidden" id="Date_dispatch" value="">
                                                 <input type="hidden" id="dispatch_type" value="dispatch">
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <div class="form">
                                                         <label class="form-label">FREIGHT AMT </label>
                                                         <select class="form-control form-line"   name="freight_option" id="freight_option">
                                                            <!--<option value="">-- Select Freight --</option>-->
                                                            <option value="To Pay" >To Pay</option>
                                                            <option value="Paid" >Paid</option>
                                                         </select>
                                                         <input type="number" class="form-control" name="freight" id="freight" placeholder="Freight" />
                                                      </div>                                                      
                                                   </div>
                                                </div>
                                                <div class="col-md-12">                                                
                                                    <div class="form-group">
                                                        <button class="btn btn-primary waves-effect" type="button" id="update_dispatch">Update</button>
                                                    </div>
                                                </div> 
                                             </div>  
                                            </div> 
                                        </form>
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                  <th>Due Date</th>
                                                  <th>Date Of Dispatch</th>
                                                  <th>Transporter</th>
                                                  <th>Freight Amt</th>
                                                  <th>Mail Sent</th>
                                                </tr>
                                            </thead>
                                            <tbody id="add_td">
                                                
                                            </tbody>

                                          </table>
                                          <!--</div>-->
                                          <div class="row clearfix">
                                             <div class="failed col-md-5">
                                             </div>
                                             <div class="rectangle_red col-md-7" >
                                             </div>
                                          </div>
                                          <div class="row clearfix">
                                             <div class="success col-md-5">
                                             </div>
                                             <div class="rectangle_green col-md-7">
                                             </div>
                                          </div>
                                       </div>
                                       
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
                                       <h4 class="modal-title">Update LR  Details</h4>
                                    </div>
                                    <form id="form_validation_lr" method="POST" enctype="multipart/form-data">
                                       <div class="modal-body">
                                          <!--  <div class="card">-->
                                          <div class="body">
                                             <div class="row clearfix">
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <div class="col-md-12">
                                                         <label class="form-label">LR Number</label>
                                                         <input type="text" class="form-control form-line" name="lr_number" id="lr_number" required>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <div class="form">
                                                         <label class="form-label">LR Image Copy</label>
                                                         <input type="file" class="form-control form-line" name="lr_copy" id="lr_copy" required="required">
                                                         <img src="" id="preview" style="display: none">
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                <input type="hidden" id="Voucher_lr" value="">
                                                <input type="hidden" id="Date_lr" value="">
                                                <input type="hidden" id="lr_type" value="LR">
                                                <div class="col-md-12">                                                
                                                    <div class="form-group">
                                                        <button class="btn btn-primary waves-effect" type="button" id="update_lr">Update</button>
                                                    </div>
                                                </div> 
                                             </div>  
                                            </div> 
                                        </form>
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                  <th>LR NUMBER</th>
                                                  <th>LR COPY</th>
                                                  
                                                  <th>Mail Sent</th>
                                                </tr>
                                            </thead>
                                            <tbody id="add_lr_td">
                                                
                                            </tbody>

                                          </table>
                                          <!--</div>-->
                                          <div class="row clearfix">
                                             <div class="failed col-md-5">
                                             </div>
                                             <div class="rectangle_red col-md-7" >
                                             </div>
                                          </div>
                                          <div class="row clearfix">
                                             <div class="success col-md-5">
                                             </div>
                                             <div class="rectangle_green col-md-7">
                                             </div>
                                          </div>
                                       </div>
                                       
                                 </div>
                              </div>
                           </div>
                           <!--Modal Ended-->
                           <!-- Modal -->
                           <div id="final_invoice" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                 <!-- Modal content-->
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close final_modal" >&times;</button>
                                       <h4 class="modal-title">Update Final  Details</h4>
                                    </div>
                                    <form id="form_validation_final" method="POST" enctype="multipart/form-data">
                                       <div class="modal-body">
                                          <!--  <div class="card">-->
                                          <div class="body">
                                             <div class="row clearfix">
                                                <div class="col-md-12">
                                                   <div class="form-group">
                                                      <div class="col-md-12">
                                                         <label class="form-label">Transporter Name</label>
                                                         <input type="text" class="form-control form-line" name="tr_name" id="tr_name" readonly>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <div class="col-md-12">
                                                         <label class="form-label">Transporter Number</label>
                                                         <input type="text" class="form-control form-line" name="tr_number" id="tr_number" required>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-6">
                                                   <div class="form-group">
                                                      <div class="form">
                                                         <label class="form-label">Expected Delivery Date</label>
                                                         <input type="date" class="form-control form-line" name="exp_del_date" id="exp_del_date" required>
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                <input type="hidden" id="Voucher_final" value="">
                                                <input type="hidden" id="Date_final" value="">
                                                <input type="hidden" id="final_type" value="final_invoice">
                                    
                                                <div class="col-md-12">                                                
                                                    <div class="form-group">
                                                        <button class="btn btn-primary waves-effect" type="button" id="update_final">Update</button>
                                                    </div>
                                                </div> 
                                             </div>  
                                            </div> 
                                        </form>
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                  <th>Transporter Name</th>
                                                  <th>Transpoter Contact Number</th>
                                                  <th>Expected Delivery Date</th>
                                                  <th>Mail Sent</th>
                                                </tr>
                                            </thead>
                                            <tbody id="add_final_td">
                                                
                                            </tbody>

                                          </table>
                                          <!--</div>-->
                                          <div class="row clearfix">
                                             <div class="failed col-md-5">
                                             </div>
                                             <div class="rectangle_red col-md-7" >
                                             </div>
                                          </div>
                                          <div class="row clearfix">
                                             <div class="success col-md-5">
                                             </div>
                                             <div class="rectangle_green col-md-7">
                                             </div>
                                          </div>
                                       </div>
                                       
                                 </div>
                              </div>
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
         $(document).ready(function(){
            // $(function() {
            //     $('#freight').hide(); 
            //     $('#freight_option').change(function(){
            //         if($('#freight_option').val() == 'To Pay') {
            //             $('#freight').show(); 
            //         } else {
            //             $('#freight').hide(); 
            //         } 
            //     });
            // });
            $(document).on('click','.dispatch_modal',function(){
                $("#form_validation"). trigger("reset");
                $('#myModal').modal('hide');
            });
            $(document).on('click','.lr_modal',function(){
                //alert('Hello Coulmn');
                $("#form_validation_lr"). trigger("reset");
                $('#myLR').modal('hide');
            }); 
            $(document).on('click','.final_modal',function(){
                // alert('Hello Coulmn');
                $("#form_validation_final"). trigger("reset");
                $('#final_invoice').modal('hide');
            });
            var error = 0 ;
             //////////////////////////GET LR ////////////////////
            $(document).on('click','.modal_lr',function(){
                 
               
                var Voucher = $(this).attr('data-id');
                var Date = $(this).attr('data-date');
                var Type =$('#lr_type').val();
                $.ajax({
                    url: "<?php echo base_url(); ?>Dispatch/get_dispatch", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'get_request':'get_dispatch','Type':Type,'Voucher':Voucher ,'Date' : Date}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {
                        var data = $.parseJSON(response);
                        console.log(data);
                        add_td_html = '';
                        var mail_status = 'Mail not sent';
                        var lr_image_copy = "Not Updated" ;
                        var lr_number = "Not Updated" ;
                        var failed_count = 0;
                        var sent_count = 0;
                        var detail_type = data.details;
                       
                        var lr_data = data.dis_data;
                        
                        if(data.flag){
                                     
                            if(detail_type.flag == 1){
                                 var final_details = detail_type.details[0];
                                var check_type_date = final_details.details_sent_mail_time;
                                var sent_count = final_details.details_sent_count;
                                var failed_count = final_details.details_failed_count;
                               
                                if(final_details.details_failed_count != undefined || final_details.details_failed_count != null){
                                    failed_count = final_details.details_failed_count;
                                }  
                                if(final_details.details_sent_count != undefined || final_details.details_sent_count != null){
                                    sent_count = final_details.details_sent_count;
                                } 
                                if(check_type_date != null || check_type_date != ''){
                                     mail_status = check_type_date;
                        
                                }
                            }
                            if (lr_data.flag == 1) {
                                var final_data =lr_data.dispatch_details;
                               
                                if(final_data.frieght_amt == null ){
                                    error = 1;
                                }
                                if(final_data.transporter == null || final_data.transporter == ''){
                                  error = 1;
                                }
                                if(final_data.date_of_dispatch == null || final_data.date_of_dispatch == ''){
                                  error = 1;
                                }
                                if(final_data.due_date == null || final_data.due_date == ''){
                                  error = 1;
                                }
                                if(error == 1){
                                    alert("Please Update Dispatch Details  First!");
                                    $('#myLR').modal('hide'); 
                                    $("#form_validation_lr"). trigger("reset");
                                    error=0;
                                    return false;
                                    
                                }
                                else{
                                     $('#myLR').modal('show'); 
                                     $('#myLR').modal({backdrop: 'static', keyboard: false});
                                    if( final_data.lr_number != null){
                                       $('#lr_number').val(final_data.lr_number);
                                        lr_number =  final_data.lr_number;
                                    }
                                    if(final_data.lr_image_copy != null){
                                        $('#preview').css('display','block');
                                        $('#preview').css('width','100px');
                                        $('#preview').css('height','100px');
                                        $('#preview').attr('src',"<?php echo base_url(); ?>"+final_data.lr_image_copy );
                                        lr_image_copy = '<img src="<?php echo base_url(); ?>'+final_data.lr_image_copy +'" width="100px" height="100px">';
                                        
                                    }
                                    else{
                                        $('#preview').css('display','none');
                                    }
                                    //alert(final_data.Voucher);
                                    $('#Voucher_lr').val(final_data.Voucher);
                                    $('#Date_lr').val(final_data.Date);
                                    
                                }
                                
                            }
                        }
                                                       
                                                      
                        else{
                                $('#preview').css('display','none');
                                $('#preview').attr('src',"" );
                        }
                        add_td_html += '<tr><td>'+lr_number+'</td><td>'+lr_image_copy+'</td><td>'+mail_status+'</td></tr>';
                        $('#add_lr_td').html('');
                        $('#add_lr_td').html(add_td_html);
                        $('.success').html("<span> Number of times mail sent :"+sent_count+"</span>");
                        $('.failed').html("<span> Number of times mail  not sent :"+failed_count+"</span>");
                           
          
                         
                        
                    }                            
                });
            });
            //////////////////////////GET DISPATCH////////////////////
            $(document).on('click','.modal_open',function(){
              $('#myModal').modal('show'); 
              $('#myModal').modal({backdrop: 'static', keyboard: false});
              var Voucher = $(this).attr('data-id');
              var Date = $(this).attr('data-date');
              var Type = $('#dispatch_type').val();
              $.ajax({
                    url: "<?php echo base_url(); ?>Dispatch/get_dispatch", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'get_request':'get_dispatch','Type':Type,'Voucher':Voucher ,'Date' : Date}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {
                        var data = $.parseJSON(response);
                         var add_td_html = '';
                        var mail_status = 'Mail not sent';
                        var due_date ="Not Updated";
                        var date_of_dispatch ="Not Updated";
                        var transporter ="Not Updated";
                        var frieght_amt ="Not Updated";
                        var failed_count = 0;
                        var sent_count = 0;
                        //console.log(data);
                        if(data.flag == 1){
                            var detail_type = data.details;
                            var lr_data = data.dis_data;
                            var trans_data = data.transporter_details;
                            if(detail_type.flag == 1){
                                var final_details = detail_type.details[0];
                                var check_type_date = final_details.details_sent_mail_time;
                                var sent_count = final_details.details_sent_count;
                                var failed_count = final_details.details_failed_count;
                               
                                if(final_details.details_failed_count != undefined || final_details.details_failed_count != null){
                                    failed_count = final_details.details_failed_count;
                                }  
                                if(final_details.details_sent_count != undefined || final_details.details_sent_count != null){
                                    sent_count = final_details.details_sent_count;
                                } 
                                if(check_type_date != undefined || check_type_date != null || check_type_date != ''){
                                     mail_status = check_type_date;
                                }
                            } 
                           
                            if(lr_data.flag == 1){
                                var final_data =lr_data.dispatch_details;
                                if(final_data.date_of_dispatch != null){
                                    $('#date_of_dispatch').val(final_data.date_of_dispatch);
                                    date_of_dispatch = final_data.date_of_dispatch
                                }
                                if(final_data.frieght_amt != null){
                                    $('#freight').show(); 
                                    $('#freight').val(final_data.frieght_amt);
                                    if(final_data.frieght_amt == ''){
                                        frieght_amt = "Paid" ;
                                    }else{
                                        frieght_amt = final_data.frieght_amt ;
                                    }
                                    //frieght_amt = details.frieght_amt;
                                }
                                if(final_data.transporter != null){
                                    //$('#transporter').val(final_data.transport);
                                    transporter = final_data.transporter ;
                                    console.log(transporter);
                                }
                                if(final_data.due_date != null){
                                    $('#due_date').val(final_data.due_date );
                                    due_date = final_data.due_date ;
                                }
                                $('#Voucher_dispatch').val(final_data.Voucher);
                                $('#Date_dispatch').val(final_data.Date);
                            }
                            //alert(transporter );
                            var add_select_option = '<option value="">-- Transporters --</option>';
                            if(trans_data.flag == 1){
                               
                                var all_trans =trans_data.all_trans
                                
                                
                                $.each(all_trans,function(index, value){
                                    if(transporter == value['id']){
                                        add_select_option += '<option value="'+value['id']+'" selected="selected">'+value['Name']+'</option>';
                                        transporter = value['Name'];
                                    
                                    }else{
                                        add_select_option += '<option value="'+value['id']+'">'+value['Name']+'</option>';
                                    }
                                    
                                    
                                });
                                

                            }else{
                                add_select_option += '<option value="">No Transporter Found! </option>'; 
                            }
                        }
                        // $('#transporter').hmtl('');
                        $('#transporter').empty().append(add_select_option);
                        $("#transporter").selectpicker("refresh");
                         add_td_html += '<tr><td>'+due_date+'</td><td>'+date_of_dispatch+'</td><td>'+transporter+'</td><td>'+frieght_amt+'</td><td>'+mail_status+'</td></tr>';
                        //console.log(add_td_html);
                        $('#add_td').html('');
                        $('#add_td').html(add_td_html);
                        $('.success').html("<span> Number of times mail sent :"+sent_count+"</span>");
                        $('.failed').html("<span> Number of times mail  not sent :"+failed_count+"</span>");
                    }                            
                });
            });
            
            /*/////////////////////////UPDATE DISPATCH////////////////////*/
            $(document).on('click','#update_dispatch',function(){
                    var Voucher = $('#Voucher_dispatch').val();
                    var frieght_amt =$('#freight_option').val();
                    var Type =$('#dispatch_type').val();
                    var freight ='';
                    var freight_paid = 0;
                    freight = $('#freight').val();
                    if (frieght_amt == 'Paid') {
                        
                      freight_paid=1;
                    }
                    var date_of_dispatch = $('#date_of_dispatch').val();
                    var due_date = $('#due_date').val();
                    var transporter = $('#transporter option:selected').val();
                    
                    // alert(transporter);return false;
                    var Date = $('#Date_dispatch').val();
                    //alert(Voucher +" "+Date);
                    $.ajax({
                    url: "<?php echo base_url(); ?>Dispatch/update_dispatch", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'get_request':'update_dispatch','Type':Type,'Date':Date,'Voucher':Voucher,'freight_paid':freight_paid,'frieght_amt':freight,'date_of_dispatch':date_of_dispatch,'transporter':transporter,'due_date':due_date}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {    //alert(response);
                        var data = $.parseJSON(response);
                        console.log(data);
                        var add_td_html = "";
                        var mail_staus = 'Mail not sent';
                        var due_date ="Not Updated";
                        var date_of_dispatch ="Not Updated";
                        var transporter ="Not Updated";
                        var frieght_amt ="Not Updated";
                      
                        if(data.flag){
                            var add_td_html = '';
                            var mail_status = 'Mail not sent';
                            var lr_image_copy = "Not Updated" ;
                            var lr_number = "Not Updated" ;
                            var detail_type = data.details;
                            var final_details = detail_type.details[0];
                            var lr_data = data.dis_data;
                            var final_data = lr_data.dis_data[0]
                            var check_type_date = final_details.details_sent_mail_time;
                            var sent_count = final_details.details_sent_count;
                            var failed_count = final_details.details_failed_count
                            
                            if(check_type_date != null || check_type_date != ''){
                                 mail_status = check_type_date;

                            }
                            if(final_data.due_date != null){
                                 //alert('due_date = '+final_data.due_date);
                                 due_date =final_data.due_date ;
                            }
                            if(final_data.date_of_dispatch != null){
                                 //alert('date_of_dispatch = '+details.date_of_dispatch);
                                 date_of_dispatch = final_data.date_of_dispatch ;
                            }
                             //alert('transporter = '+details.transport_dis);
                            if(final_data.transport_dis != null){
                                //alert('transporter = '+final_data.transport_dis);
                                
                                 transporter = final_data.transport_dis ;
                            }
                            if(final_data.frieght_amt != null){
                                // alert('frieght_amt = '+final_data.frieght_amt);
                                if(final_data.frieght_amt == ''){
                                    frieght_amt = "Paid" ;
                                }else{
                                    frieght_amt = final_data.frieght_amt ;
                                }
                                 
                            }
                             
                        }
                            
                       
                        else{
                            alert(data.message)
                        }
                        
                        add_td_html += '<tr><td>'+due_date+'</td><td>'+date_of_dispatch+'</td><td>'+transporter+'</td><td>'+frieght_amt+'</td><td>'+mail_status+'</td></tr>';
                        console.log(add_td_html);
                        $('#add_td').html('');
                        $('#add_td').html(add_td_html);
                        $('.success').html("<span> Number of times mail sent :"+sent_count+"</span>");
                       $('.failed').html("<span> Number of times mail  not sent :"+failed_count+"</span>");
                   
                    }                            
                });
            });
            
              /*/////////////////////////UPDATE LR////////////////////*/
            $(document).on('click','#update_lr',function(){
                var Voucher = $('#Voucher_lr').val();                
                var Date = $('#Date_lr').val();
                var lr_number = $('#lr_number').val();
                var Type =$('#lr_type').val();
                
                var formData = new FormData();
                formData.append('file', $('input[type=file]')[0].files[0]); 
                formData.append('lr_number',lr_number); 
                formData.append('Date', Date); 
                formData.append('Voucher', Voucher); 
                formData.append('Type', Type); 
                $.ajax({
                    url: "<?php echo base_url(); ?>Dispatch/update_lr", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(response)   // A function to be called if request succeeds
                    {
                        var data = $.parseJSON(response);
                         console.log(data);
                        if(data.flag){
                            var add_td_html = '';
                            var mail_status = 'Mail not sent';
                            var lr_image_copy = "Not Updated" ;
                            var lr_number = "Not Updated" ;
                            var detail_type = data.details;
                            var final_details = detail_type.details[0];
                            var lr_data = data.dis_data;
                            var final_data = lr_data.dis_data[0]
                            var check_type_date = final_details.details_sent_mail_time;
                            var sent_count = final_details.details_sent_count;
                            var failed_count = final_details.details_failed_count
                            
                            if(check_type_date != null || check_type_date != ''){
                                 mail_status = check_type_date;

                            }
                            if(final_data.lr_number != null){
                                   $('#lr_number').val(final_data.lr_number);
                                    lr_number = final_data.lr_number;
                            }
                            if( final_data.lr_image_copy != null){
                                $('#preview').css('display','block');
                                $('#preview').css('width','100px');
                                $('#preview').css('height','100px');
                                $('#preview').attr('src',"<?php echo base_url(); ?>"+final_data.lr_image_copy);
                                lr_image_copy = '<img src="<?php echo base_url(); ?>'+final_data.lr_image_copy +'" width="100px" height="100px">';
                                
                            }else{
                                $('#preview').css('display','none');
                            }
                                
                        }
                        else{
                            alert(data.message)
                        }
                        add_td_html += '<tr><td>'+lr_number+'</td><td>'+lr_image_copy+'</td><td>'+mail_status+'</td></tr>';
                        $('#add_lr_td').html('');
                        $('#add_lr_td').html(add_td_html);
                        $('.success').html("<span> Number of times mail sent :"+sent_count+"</span>");
                        $('.failed').html("<span> Number of times mail  not sent :"+failed_count+"</span>");
                        
                   
                    }                            
                });
            });
            var final_error = 0;
              /*/////////////////////////GET FINAL COPY////////////////////*/
            $(document).on('click','.modal_final_copy',function(){
                // $('#final_invoice').modal('show'); 
                // $('#final_invoice').modal({backdrop: 'static', keyboard: false});
                 var Voucher = $(this).attr('data-id');
                 var Date = $(this).attr('data-date');
                 var Type = $('#final_type').val();
                 $.ajax({
                    url: "<?php echo base_url(); ?>Dispatch/get_dispatch", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'get_request':'get_dispatch','Type':Type,'Voucher':Voucher ,'Date' : Date}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {
                        var data = $.parseJSON(response);
                        console.log(data);
                        var add_td_html = "";
                        var mail_status = 'Mail not sent';
                        var expt_del_date ="Not Updated";
                        var transporter_contact ="Not Updated";
                        var transporter ="Not Updated";
                        var failed_count = 0;
                        var sent_count = 0;
                        if(data.flag == 1){
                            var detail_type = data.details;
                            var lr_data = data.dis_data;
                            var trans_data = data.transporter_details;
                            console.log(trans_data);
                            if(detail_type.flag == 1){
                                var final_details = detail_type.details[0];
                                var check_type_date = final_details.details_sent_mail_time;
                                var sent_count = final_details.details_sent_count;
                                var failed_count = final_details.details_failed_count;
                               
                                if(final_details.details_failed_count != undefined || final_details.details_failed_count != null){
                                    failed_count = final_details.details_failed_count;
                                }  
                                if(final_details.details_sent_count != undefined || final_details.details_sent_count != null){
                                    sent_count = final_details.details_sent_count;
                                } 
                                if(check_type_date != undefined || check_type_date != null || check_type_date != ''){
                                     mail_status = check_type_date;
                                }
                            } 
                           
                            if(lr_data.flag == 1){
                                var final_data =lr_data.dispatch_details;
                                
                                if(final_data.frieght_amt == null ){
                                    final_error = 1;
                                }
                                if(final_data.transporter == null || final_data.transporter == ''){
                                  final_error = 1;
                                }
                                if(final_data.date_of_dispatch == null || final_data.date_of_dispatch == ''){
                                  final_error = 1;
                                }
                                if(final_data.due_date == null || final_data.due_date == ''){
                                  final_error = 1;
                                }
                                if(final_data.due_date == null || final_data.lr_number == ''){
                                  final_error = 1;
                                }
                                if(final_data.due_date == null || final_data.lr_image_copy == ''){
                                  final_error = 1;
                                }
                                if(final_error == 1){
                                    alert("Please Update Dispatch and LR Details  First!");
                                    $('#final_invoice').modal('hide'); 
                                    $("#final_invoice"). trigger("reset");
                                    final_error=0;
                                    return false;
                                    
                                }
                                else{
                                     $('#final_invoice').modal('show'); 
                                     $('#final_invoice').modal({backdrop: 'static', keyboard: false});
                                    if(final_data.transporter != null){
                                         
                                         transporter = final_data.transporter ;
                                    }
                                    if(final_data.transporter_contact != null){
                                        $('#tr_number').val(final_data.transporter_contact);
                                        transporter_contact = final_data.transporter_contact ;
                                        
                                    }
                                    if(final_data.expected_del_date != null){
                                        $('#exp_del_date').val(final_data.expected_del_date);
                                        expt_del_date = final_data.expected_del_date ;
                                       
                                    }
                                    $('#Voucher_final').val(final_data.Voucher);
                                    $('#Date_final').val(final_data.Date);
                                }
                            }
                             if(trans_data.flag == 1){
                                var all_trans =trans_data.all_trans
                                $.each(all_trans,function(index, value){
                                    if(transporter == value['id']){
                                        transporter = value['Name'];
                                   }
                                });
                            }
                           // alert(transporter); return false;

                            $('#tr_name').val(transporter);                            
                        }
                        else{
                            alert(data.message)
                        }
                        add_td_html += '<tr><td>'+transporter+'</td><td>'+transporter_contact+'</td><td>'+expt_del_date+'</td><td>'+mail_status+'</td></tr>';
                        //console.log(add_td_html);
                        $('#add_final_td').html('');
                        $('#add_final_td').html(add_td_html);
                        $('.success').html("<span> Number of times mail sent :"+sent_count+"</span>");
                        $('.failed').html("<span> Number of times mail  not sent :"+failed_count+"</span>");
                              
                    
                           
                       

                    }                            
                });
                
            });
            
             /*/////////////////////////UPDATE FINAL////////////////////*/
            $(document).on('click','#update_final',function(){
                var Voucher = $('#Voucher_final').val();                
                var Date = $('#Date_final').val();
                var tr_number = $('#tr_number').val();
                var exp_del_date = $('#exp_del_date').val();
                var Type =$('#final_type').val();
                // alert(Voucher +" "+Date);
                var formData = new FormData();
                formData.append('tr_number',tr_number); 
                formData.append('exp_del_date',exp_del_date); 
                formData.append('Date', Date); 
                formData.append('Voucher', Voucher); 
                formData.append('Type', Type); 
                $.ajax({
                    url: "<?php echo base_url(); ?>Dispatch/update_final", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(response)   // A function to be called if request succeeds
                    {
                       var data = $.parseJSON(response);
                       console.log(data);
                       if(data.flag){
                            var add_td_html = '';
                            var mail_status = 'Mail not sent';
                            var exp_del_date = "Not Updated" ;
                            var tr_number = "Not Updated" ;
                            var tr_name = "Not Updated" ;
                            var detail_type = data.details;
                            var final_details = detail_type.details[0];
                            var lr_data = data.dis_data;
                            var final_data = lr_data.dis_data[0]
                            var check_type_date = final_details.details_sent_mail_time;
                            var sent_count = final_details.details_sent_count;
                            var failed_count = final_details.details_failed_count
                            
                            if(check_type_date != null || check_type_date != ''){
                                 mail_status = check_type_date;

                            }
                            console.log(final_data);
                            if(final_data.transport_dis != null){
                                  
                                    tr_name = final_data.transport_dis;
                            } 
                            if(final_data.transporter_contact != null){
                                   $('#tr_number').val(final_data.transporter_contact);
                                    tr_number = final_data.transporter_contact;
                            }
                            if( final_data.expected_del_date != null){
                                $('#exp_del_date').val(final_data.expected_del_date);
                                exp_del_date = final_data.expected_del_date;
                                
                                
                            } 
                         }
                         else{
                                alert(data.message)
                         }
                         add_td_html += '<tr><td>'+tr_name+'</td><td>'+tr_number+'</td><td>'+exp_del_date+'</td><td>'+mail_status+'</td></tr>';
                        $('#add_final_td').html('');
                        $('#add_final_td').html(add_td_html);
                        $('.success').html("<span> Number of times mail sent :"+sent_count+"</span>");
                        $('.failed').html("<span> Number of times mail  not sent :"+failed_count+"</span>");
                    }                            
                });
            });
            
            function readURL(input) {
              if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                  $('#preview').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
              }
            }
            ////////
            $("#lr_copy").change(function() {
                $('#preview').css('display','block');
                $('#preview').css('width','100px');
                $('#preview').css('height','100px');
                readURL(this);
            });

             
         });
      </script>
   </body>
</html>