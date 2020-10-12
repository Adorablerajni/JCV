<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>Edit
       Transport | Mercure DPA</title>
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
                  Edit Transport
               </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <?php echo validation_errors('<span class="error">', '</span>'); ?>
                     <div class="header">
                        <h2>Edit Transport</h2>
                        <?php echo $this->session->flashdata('message'); ?>
                     </div>
                     <div class="body">
                      <?php $transport_id =  urldecode($this->uri->segment(3)); ?>


                        <?php echo form_error('myfield', '<div class="error">', '</div>'); ?>
                        <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Masters/edit_transport/<?php echo $transport_id; ?>">
                           <div class="row clearfix">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="Name" value="<?php echo $transport_list['transport_list'][0]['Name']?>">
                                       <label class="form-label">Name</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <select class="form-control" name="city_name">
                                          <option value="">-- Select City--</option>
                                          <?php 
                                             $citylist=$this->State_city_model->state_city_list();
                                             $i=1;
                                             if($citylist['flag']==1)  {
                                             foreach($citylist['statecity'] as $val){
                                             ?>                               
                                          <option value="<?php echo $val['id'];?>" <?php if ($transport_list['transport_list'][0]['city'] == $val['id']){ echo "selected";}else{ echo '';} ?> ><?php echo $val['city'];?> - <?php echo $val['state'];?></option>
                                          <?php } } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="address" value="<?php echo $transport_list['transport_list'][0]['address']?>">
                                       <label class="form-label">Address</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="contact_person" value="<?php echo $transport_list['transport_list'][0]['contact_person']?>">
                                       <label class="form-label">Contact Person</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="contact_number" value="<?php echo $transport_list['transport_list'][0]['contact_number']?>">
                                       <label class="form-label">Contact Number</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="Whats_app"   value="<?php echo $transport_list['transport_list'][0]['whatsapp_number']?>">
                                       <label class="form-label">Whats App Number </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row clearfix">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="landline_one" value="<?php echo $transport_list['transport_list'][0]['landline_one']?>">
                                       <label class="form-label">LandLine 1 </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="landline_two" value="<?php echo $transport_list['transport_list'][0]['landline_two']?>">
                                       <label class="form-label">LandLine 2</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="landline_three" value="<?php echo $transport_list['transport_list'][0]['landline_three']?>">
                                       <label class="form-label">LandLine 3</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row clearfix">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <select class="form-control" name="head_city_name">
                                          <option value="">-- Select City Of Head Office--</option>
                                          <?php 
                                             $citylist=$this->State_city_model->state_city_list();
                                             $i=1;
                                             if($citylist['flag']==1)  {
                                             foreach($citylist['statecity'] as $val){
                                             ?>                               
                                          <option value="<?php echo $val['city_id'];?>" <?php if ($transport_list['transport_list'][0]['city_of_head_office'] == $val['id']){ echo "selected";}else{ echo '';} ?> ><?php echo $val['city'];?> - <?php echo $val['state'];?></option>
                                          <?php } } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="row clearfix ">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <button class="btn btn-primary waves-effect" type="submit"> Edit Transporter</button>
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
                    "Name": {
                        required:true,
                       
                       
                    },
                    
                   
                       
                     
                },
                messages: {
                    "Name": {
                        required: "Please  Enter Name",
                      }
                      
                    
                },
                errorPlacement: function(error, element) { 
                    error.insertBefore( element ); 
                }
                
            }); 

             $("#state").on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {
                var selectedD = $(this).find('option').eq(clickedIndex).text();
                console.log('selectedD: ' + selectedD + '  newValue: ' + newValue + ' oldValue: ' + oldValue);
              });

             
             $(document).on('change','.state',function(){
                 var url = $('#url').val();
                 var data_id = $(this).attr('data-id');
                 
                 var state_code= $('#state_'+data_id).val();
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
                             var option_html ='<select data-live-search="true" id="transport_city_"'+data_id+' class="form-control" style="width:100px">'
                             if (data.flag  != 0) {
                                 //alert(data.city_bystatecode);
                                 $.each(data.city_bystatecode, function(index ,value){
                                     //alert(value['city']);
                                     option_html += "<option value='"+value['id']+"'>"+value['city']+"</option>";
                                     
                                 });
                             } 
                             else{
                                  option_html += "<option>No Records</option>";
                                  //alert(option_html);
                             }
                             option_html += "</select>";
                             
                             $('#tdcity_'+data_id).html(option_html);
                             //console.log(option_html);
                         }                            
                     });
                 }
         
                 return false;       
             });
             
             
             $(document).on('change','#term',function(){
                 var terms = $('#term').val();
                 // alert(terms);
                 if (terms =='fixed') {
                    
                     $('#rs_per_case').prop('readonly', false);
                     $('#lr_charges').prop('readonly', false);
                     $('#add_charges').prop('readonly', false);
                     $('#upto_15').prop('readonly', true);
                     $('#upto_30').prop('readonly', true);
                     
                 }
                 else if (terms =='variable') {
                     $('#rs_per_case').prop('readonly', true);
                     $('#lr_charges').prop('readonly', false);
                     $('#add_charges').prop('readonly', false);
                     $('#upto_15').prop('readonly', false);
                     $('#upto_30').prop('readonly', false);
                    
                     
                 }else{
                     $('#fixed_term_'+data_id).css('display','none');
                     $('#variable_term_'+data_id).css('display','none');
         
                 }
                 return false;
             });
         });
      </script>
   </body>
</html>