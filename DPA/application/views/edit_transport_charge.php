<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>Edit
       Charges | Mercure DPA</title>
      <!-- Favicon-->
      <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
      <?php include_once('include/headerlinks.php'); ?>
      <style>
         .open{overflow:visible !important;height:25px;max-width:500px;}
      </style>
   </head>
   <body class="theme-cyan">
      <?php include_once('include/header.php'); ?>
      <?php include_once('include/sidebar.php'); ?>
      <section class="content">
         <div class="container-fluid">
            <div class="block-header">
               <h2>
                  Edit Charges
               </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <?php echo validation_errors('<span class="error">', '</span>'); ?>
                     <div class="header">
                        <h2>Edit Transport Charges</h2>
                        <?php echo $this->session->flashdata('message'); ?>
                     </div>
                     <div class="body">
                      <?php $transport_charges_id =  urldecode($this->uri->segment(3)); ?>


                        <?php echo form_error('myfield', '<div class="error">', '</div>'); ?>
                        <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Masters/edit_transport_charge/<?php echo $transport_charges_id ; ?>">
                           <div class="row clearfix">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <style>
                                            .open{overflow:visible !important;height:25px;max-width:500px;}
                                        </style>
                                        <select  id="transport_state" class="form-control selectpicker" data-live-search="true" name="transport_state" id="state" data-width="300px">
                                            <option value=""></option>
                                             <?php 
                                                $statelist=$this->State_city_model->get_state();
                                                $j=1;
                                                if($statelist['flag']==1)  {
                                                foreach($statelist['statelist'] as $val){
                                                ?>                               
                                             <option value="<?php echo $val['state_code'];?>" <?php if ($transport_charges['transport_charge'][0]['transport_state'] == $val['state_code']){ echo "selected";}else{ echo '';} ?> ><?php echo $val['state_code'];?> - <?php echo $val['state'];?></option>
                                             <?php } } ?>
                                      </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line selected_city">
                                       <select class="form-control selectpicker" name="transport_city">
                                          <option value="">-- Select City--</option>
                                          <?php 
                                             $citylist=$this->State_city_model->state_city_list();
                                             $i=1;
                                             if($citylist['flag']==1)  {
                                             foreach($citylist['statecity'] as $val){
                                             ?>                               
                                          <option value="<?php echo $val['city_id'];?>" <?php if ($transport_charges['transport_charge'][0]['transport_city'] == $val['city_id']){ echo "selected";}else{ echo '';} ?> ><?php echo $val['city'];?> - <?php echo $val['state'];?></option>
                                          <?php } } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <select class="form-control selectpicker" data-live-search="true" name="transport_term" id="transport_term">
                                             <option value="">-- Select Term Type--</option>
                                             <option  <?php  $fixed="";$variable=""; if ($transport_charges['transport_charge'][0]['transport_term'] == 'fixed'){ echo "selected"; $fixed="readonly";}?> value="fixed">Fixed</option>
                                             <option  <?php if ($transport_charges['transport_charge'][0]['transport_term'] == 'variable'){ echo "selected"; $variable="readonly";}?>  value="variable">Variable</option>
                                      </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input  id="rs_per_case" type="text" class="form-control" name="rs_per_case" value="<?php echo $transport_charges['transport_charge'][0]['rs_per_case']?>" <?php echo $variable ;?>>
                                       <label class="form-label">RS/Case</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input id="lr_charges" type="text" class="form-control" name="lr_charges" value="<?php echo $transport_charges['transport_charge'][0]['lr_charges']?>">
                                       <label class="form-label">LR Charges</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input id="add_charges" type="text" class="form-control" name="add_charges"   value="<?php echo $transport_charges['transport_charge'][0]['add_charges']?>">
                                       <label class="form-label">Add Charges </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row clearfix">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input id="upto_15" type="text" class="form-control" name="upto_15" value="<?php echo $transport_charges['transport_charge'][0]['rs_upto_15']?>" <?php echo $fixed ;?>>
                                       <label class="form-label"> Rs/KG Upto 15 </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input id="upto_30" type="text" class="form-control" name="upto_30" value="<?php echo $transport_charges['transport_charge'][0]['rs_upto_30']?>" <?php echo $fixed ;?>>
                                       <label class="form-label">Rs/KG  Upto 30</label>
                                    </div>
                                 </div>
                              </div>
                              <input id="url" type="hidden" name="url" value="<?php echo site_url('get_city');?>">
                              
                           </div>
                           

                           <div class="row clearfix ">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <button class="btn btn-primary waves-effect" type="submit"> Edit Transporter  Charges</button>
                                 </div>
                              </div>
                           </div>
                          
                           
                           
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- #END# Basic Validation -->
         </div>
         </div>
      </section>
      <?php include_once("include/footerjs.php"); ?>
   
      <script type="text/javascript">

       
         
         
         $(document).ready(function(){

            $("#form_validation").validate({
                rules: {
                    "transport_state": {
                        required:true,
                       
                       
                    },
                     "transport_city": {
                        required:true,
                       
                       
                    }, 
                    "transport_term": {
                        required:true,
                       
                       
                    },
                    
                   
                       
                     
                },
                messages: {
                    "transport_state": {
                        required: "Please Select a State",
                      },
                      "transport_city": {
                        required: "Please Select a State which have a city",
                      },
                      "transport_term": {
                        required: "Please Select a Term Type",
                      },
                      
                    
                },
                errorPlacement: function(error, element) { 
                    error.insertBefore( element ); 
                }
                
            }); 

             // $("#state").on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {
             //    var selectedD = $(this).find('option').eq(clickedIndex).text();
             //    console.log('selectedD: ' + selectedD + '  newValue: ' + newValue + ' oldValue: ' + oldValue);
             //  });

             
             $(document).on('change','#transport_state',function(){
                 var url = $('#url').val();
                //alert('dfgdfgdfg');
                 
                 var state_code= $('#transport_state').val();
                 if (state_code != '') {
                     $.ajax({
                         url: url, // Url to which the request is send
                         type: "POST",             // Type of request to be send, called as method
                         data: {'get_city':'get_city','state_code':state_code}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                         success: function(response)   // A function to be called if request succeeds
                         {
                             //alert(response);
                             var data = $.parseJSON(response);  
                             $('.selectpicker').selectpicker();
                             var line_html = '';
                             var option_html ='<select data-live-search="true" id="transport_city" name="transport_city" class="form-control" style="width:300px">'
                             if (data.flag  != 0) {
                                 //alert(data.city_bystatecode);
                                 $.each(data.city_bystatecode, function(index ,value){
                                     //alert(value['city']);
                                     option_html += "<option value='"+value['id']+"'>"+value['city']+"</option>";
                                     
                                 });
                             } 
                             else{
                                  option_html += "<option value=''>No Records</option>";
                                  //alert(option_html);
                             }
                             option_html += "</select>";
                             
                             $('.selected_city').html(option_html);
                             //console.log(option_html);
                         }                            
                     });
                 }
         
                 return false;       
             });
             
             
             $(document).on('change','#transport_term',function(){
                 var terms = $('#transport_term').val();
                  var upto_15 = $('#upto_15').val();
                var upto_30 = $('#upto_30').val();
                var rs_per_case = $('#rs_per_case').val();
                // alert(upto_30 + ' ' +upto_30+ rs_per_case);
                 //alert(terms);
                 if (terms =='fixed') {
                    $('#rs_per_case').val(rs_per_case);
                    $('#upto_30').val(0);
                     $('#upto_15').val(0);
                     $('#rs_per_case').prop('readonly', false);
                     $('#lr_charges').prop('readonly', false);
                     $('#add_charges').prop('readonly', false);
                    
                     $('#upto_15').prop('readonly', true);
                     $('#upto_30').prop('readonly', true);
                     
                 }
                 else if (terms =='variable') {
                    $('#rs_per_case').val(0);
                    $('#upto_30').val(upto_30);
                     $('#upto_15').val(upto_15);
                     $('#rs_per_case').prop('readonly', true);
                     $('#lr_charges').prop('readonly', false);
                     $('#add_charges').prop('readonly', false);
                     $('#upto_15').prop('readonly', false);
                     $('#upto_30').prop('readonly', false);
                    
                   }   
                 // }else{
                 //     $('#fixed_term_'+data_id).css('display','none');
                 //     $('#variable_term_'+data_id).css('display','none');
         
                 // }
                 return false;
             });
         });
      </script>
   </body>
</html>