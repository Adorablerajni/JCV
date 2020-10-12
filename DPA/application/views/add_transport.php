<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <title>Add Transport | Mercure DPA</title>
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
                  Add Transport
               </h2>
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <?php echo validation_errors('<span class="error">', '</span>'); ?>
                     <div class="header">
                        <h2>Add Transport</h2>
                        <?php echo $this->session->flashdata('message'); ?>
                     </div>
                     <div class="body">


                        <?php echo form_error('myfield', '<div class="error">', '</div>'); ?>
                        <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Masters/add_transports">
                           <div class="row clearfix">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="Name">
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
                                          <option value="<?php echo $val['id'];?>"><?php echo $val['city'];?> - <?php echo $val['state'];?></option>
                                          <?php } } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="address">
                                       <label class="form-label">Address</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="contact_person">
                                       <label class="form-label">Contact Person</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="contact_number">
                                       <label class="form-label">Contact Number</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="Whats_app">
                                       <label class="form-label">Whats App Number </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row clearfix">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="landline_one">
                                       <label class="form-label">LandLine 1 </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="landline_two">
                                       <label class="form-label">LandLine 2</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" class="form-control" name="landline_three">
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
                                          <option value="<?php echo $val['city_id'];?>"><?php echo $val['city'];?> - <?php echo $val['state'];?></option>
                                          <?php } } ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row clearfix">
                                <div class="col-md-12 column">
                                      <table class="table table-bordered table-hover" id="tab_logic2">
                                         <thead>
                                            <tr >
                                               <th class="text-center">
                                                  State Name
                                               </th>
                                               <th class="text-center">

                                                  City Name
                                                  <span class="error city_check"></span>
                                               </th>
                                               <th class="text-center">
                                                  Term
                                               </th>
                                               <th class="text-center">
                                                  Rs/Case
                                               </th>
                                               <th class="text-center">
                                                  Rs/KG(Upto 15KG)
                                               </th>
                                               <th class="text-center">
                                                  RS/KG(Upto 30KG)
                                               </th>
                                               <th class="text-center">
                                                  LR Chrges
                                               </th>
                                               <th class="text-center">
                                                  Add Charges
                                               </th>
                                               <th class="text-center">
                                               </th>
                                            </tr>
                                         </thead>
                                         <tbody>
                                            <tr id='addr0'>
                                               <td>
                                                    <style>
                                                        .open{overflow:visible !important;height:25px;max-width:500px;}
                                                    </style>
                                                    <select class="form-control selectpicker" data-live-search="true" name="state" id="state" data-width="150px">
                                                        <option value=""></option>
                                                         <?php 
                                                            $statelist=$this->State_city_model->get_state();
                                                            $j=1;
                                                            if($statelist['flag']==1)  {
                                                            foreach($statelist['statelist'] as $val){
                                                            ?>                               
                                                         <option value="<?php echo $val['state_code'];?>"><?php echo $val['state_code'];?> - <?php echo $val['state'];?></option>
                                                         <?php } } ?>
                                                  </select>
                                               </td>
                                               <td id="tdcity">
                                                   
                                                  <select class="form-control selectpicker" data-live-search="true" name="transport_city" id="transport_city" data-width="100px">
                                                     <option value=""></option>
                                                  </select>
                                               </td>
                                               <td>
                                                  <select class="form-control selectpicker" data-live-search="true" name="term" id="term"  data-width="100px">
                                                     <option value=""></option>
                                                     <option value="fixed">Fixed</option>
                                                     <option value="variable">Variable</option>
                                                  </select>
                                               </td>
                                               <td>
                                                  <input type="text" name='rs_per_case' id='rs_per_case' placeholder='RS / Case' class="form-control" readonly />
                                               </td>
                                               <td>
                                                  <input type="text" name='upto_15' id='upto_15' placeholder='RS / KG (Upto 15 KG)' class="form-control"/>
                                               </td>
                                               <td>
                                                  <input type="text" name='upto_30' id='upto_30' placeholder='RS/KG (Upto 30 KG)' class="form-control" readonly />
                                               </td>
                                               <td>
                                                  <input type="text" name='lr_charges' id='lr_charges' placeholder='LR charges' class="form-control txt" readonly />
                                               </td>
                                               <td>
                                                  <input type="text" name='add_charges' id='add_charges' placeholder='Add Charges' class="form-control" readonly />
                                               </td>
                                               <td>
                                                  <a id='butsend' class="pull-right btn btn-danger" >+ Add</a>
                                               </td>
                                            </tr>
                                            <tr id='addr1'></tr>
                                         </tbody>
                                      </table>
                                </div>  
                           </div>
                           <div class="row clearfix ">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <p class="btn btn-warning col-lg-12">&nbsp;Location Service List</p>
                                 </div>
                              </div>
                           </div>
                           <input id="url" type="hidden" name="url" value="<?php echo site_url('Masters/get_city');?>">
                           <div class="row clearfix">
                              <div class="col-md-12 column">
                                 <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                       <tr >
                                          <th class="text-center">
                                             #
                                          </th>
                                          <th class="text-center" style="width:300px">
                                             State Name
                                          </th>
                                          <th class="text-center">
                                             City Name
                                          </th>
                                          <th class="text-center">
                                             Term
                                          </th>
                                          <th class="text-center">
                                             RS/Case
                                          </th>
                                          <th class="text-center">
                                             RS/KG (Upto 15 KG)
                                          </th>
                                          <th class="text-center">
                                             RS/KG (Upto 30 KG)
                                          </th>
                                          <th class="text-center">
                                             LR chargres
                                          </th>
                                          <th class="text-center">
                                             Add Charges
                                          </th>
                                          <th>
                                          </th>
                                       </tr>
                                    </thead>
                                 </table>
                              </div>
                           </div>
                           <div class="row clearfix">
                              <div class="form-group">
                                 <button class="btn btn-success col-md-12 " id="btnaddtranx" type="submit">ADD</button>
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
      <script>
         $(document).ready(function(){
               $("#btnaddtranx").hide();
               var tid=1;
            
               $("#butsend").click(function(){
                     var select_length = $('#transport_city option').length;
                        var transport_city = $('#transport_city option:selected').val();
                        var transport_city_already = $("input[name='transport_city[]']").map(function(){return $(this).val();}).get();
                        var term = $('#term option:selected').val(); 
                        var transport_term_already = $("input[name='term[]']").map(function(){return $(this).val();}).get();
                        //alert( transport_city_already);
                        if (transport_city_already == transport_city && transport_term_already == term ) {
                             $('.city_check').html('You have already Choose this city !');
                             //alert( transport_city_already);
                             return false;
                        }
                        if (select_length == 1 &&  transport_city == '' ) {
                            //alert("Please select a city");
                            $('.city_check').html('Please select a city');
                            return false;

                        }   
                        else if(select_length == 1 &&  transport_city == '-1'){
                            $('.city_check').html('Please select a state which have city');
                            // alert("Please select a state which have city");
                            return false;
                        }
                        else{
                            $("#tab_logic").show(); 
                           $("#tab_logic").append('<tr valign="top"><td width="80px" align="center">'+(tid++)+'</td><td width="100px" align="center"><input type="hidden" name="state[]"  value="'+$("#state").val()+'"><input type="text" name="state_list[]" value="'+$("#state option:selected").text()+'" /></td><td width="100px" align="center"><input type="hidden" name="transport_city[]" value="'+$("#transport_city").val()+'" />'+$("#transport_city option:selected").text()+'</td><td width="100px" align="center"><input type="hidden" name="term[]" value="'+$("#term").val()+'" />'+$("#term option:selected").text()+'</td><td width="100px" align="center"><input type="hidden" name="rs_per_case[]" value="'+$("#rs_per_case").val()+'" />'+$("#rs_per_case").val()+'</td><td width="100px" align="center"><input type="hidden" name="upto_15[]" value="'+$("#upto_15").val()+'" />'+$("#upto_15").val()+'</td><td width="100px" align="center"><input type="hidden" name="upto_30[]" value="'+$("#upto_30").val()+'" />'+$("#upto_30").val()+'</td><td width="100px" align="center"><input type="hidden" name="lr_charges[]" value="'+$("#lr_charges").val()+'" />'+$("#lr_charges").val()+'</td><td width="100px" align="center"><input type="hidden" name="add_charges[]" class="txt" value="'+$("#add_charges").val()+'" />'+$("#add_charges").val()+'</td><td width="100px" class="text-danger" align="center"><a href="javascript:void(0);" class="text-danger remCF">Remove</a></td></tr>');
                           $('.selectpicker').selectpicker('val','');
                           $('#transport_city').val('');
                           $('#term').val('');
                           $('#rs_per_case').val('');
                           $('#upto_15').val('');
                           $('#upto_30').val('');
                           $('#lr_charges').val('');
                           $('#add_charges').val('');
                           $("#btnaddtranx").show();
                           $('.city_check').html('');

                        }
                  
               });
                   
               $("#tab_logic").on('click','.remCF',function(){
                   $(this).parent().parent().remove();
               });
           });
         
         
             
      </script>
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

             
             $(document).on('change','#state',function(){
                 var url = $('#url').val();
                 var data_id = $(this).attr('data-id');
                 
                 var state_code= $('#state').val();
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
                             var option_html ='<select data-live-search="true" id="transport_city" name="transport_city" class="form-control" style="width:100px">'
                             if (data.flag  != 0) {
                                 //alert(data.city_bystatecode);
                                 $.each(data.city_bystatecode, function(index ,value){
                                     //alert(value['city']);
                                     option_html += "<option value='"+value['id']+"'>"+value['city']+"</option>";
                                     
                                 });
                             } 
                             else{
                                  option_html += "<option value='-1'>No Records</option>";
                                  //alert(option_html);
                             }
                             option_html += "</select>";
                             
                             $('#tdcity').html(option_html);
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