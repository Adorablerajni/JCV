<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Transport List | Mercure DPA</title>
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
                    Search Transporter
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Search Transporter
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form id="search_form" method="POST" >
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                              <select class="form-control" name="city_name" id="city_name">
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
                                               <input type="text" class="form-control" name="no_of_case" id="no_of_case">
                                               <label class="form-label">Enter Cases</label>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <div class="form-line">
                                               <input type="text" class="form-control" name="avg_weight" id="avg_weight">
                                               <label class="form-label">Enter Avg. Weight</label>
                                            </div>
                                         </div>
                                      </div>                                            
                                </div>
                                <div class="row clearfix">
                                      <div class="form-group">
                                         <button class="btn btn-success col-md-12 " type="submit">Search</button>
                                      </div>
                                 </div>
                            </form>

                            <div class="row clearfix show_table" style="display:  none;">
                                <div class="col-md-12 column">
                                      <table class="table table-bordered table-hover" id="tab_logic2">
                                         <thead>
                                            <tr >
                                               <th class="text-center">
                                                  Transporter Name
                                               </th>  
                                                <th class="text-center">
                                                  City
                                               </th>
                                               <th class="text-center">
                                                  Transporter's City
                                               </th>
                                               <th class="text-center">
                                                  Contact Number    
                                               </th>
                                               <th class="text-center">
                                                  Term
                                               </th>
                                               <th class="text-center">
                                                  Total Charges
                                               </th>
                                              
                                            </tr>
                                         </thead>
                                         <tbody id="tbody">

                                         </tbody>
                                      </table>
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
	<script type="text/javascript">
     $(document).ready(function(){
         $("#search_form").validate({
                rules: {
                    "city_name": {
                        required:true,
                       
                       
                    },
                     "no_of_case": {
                        required:true,
                       
                       
                    },
                     "avg_weight": {
                        required:true,
                       
                       
                    }
                    
                       
                    
                },
                messages: {
                    "city_name": {
                        required: "* Please  Select a City ",
                      
                    },
                    "no_of_case": {
                        required: "* Please Enter Number Cases",
                       
                    }
                    ,"avg_weight": {
                        required: "* Please Enter Average weight ",
                       
                    }
                },
                errorPlacement: function(error, element) { 
                    error.insertBefore( element ); 
                },
                // } ,
                submitHandler: function (form) { // for demo
                     var transport_city = $('#city_name option:selected').val();
                     var no_of_cases  = $("#no_of_case").val()
                     var avg_weight = $("#avg_weight").val()
                    // alert(transport_city +' '+ no_of_cases+ ' '+ avg_weight+ ' ');
                     $.ajax({
                            url: "<?php echo site_url(); ?>Dispatch/get_transporter", // Url to which the request is send
                            type: "POST",             // Type of request to be send, called as method
                            data: {'transport_city':transport_city,'no_of_cases':no_of_cases,'avg_weight':avg_weight}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                            success: function(response)   // A function to be called if request succeeds
                            {
                                //console.log(response);
                                console.log(typeof(response));
                                var data = $.parseJSON(response);
                                //console.log(data);   
                                console.log(typeof(data)); 
                                if (data.flag == 0 ) {
                                    var html_rows = '<tr><td colspan="6">No Transporter Found For this city</td><tr>';
                                    //alert("No Transporter Found For this city");
                                    // //$('#search_form').reset();
                                    // location.reload();
                                    $('.show_table').css('display','block');
                                    $('#tbody').html('');
                                    $('#tbody').html(html_rows);
                                }else{
                                    var html_rows = '';
                                    var cityName = $('#city_name option:selected').text();

                                    $.each(data.transporter_list , function(index ,value){
                                        console.log(value['term']);
                                        if (value['transport_term'] == 'fixed') {
                                            console.log(value['lr_charges']);
                                            console.log(value['add_charges']);
                                            console.log(value['rs_per_case']);
                                            var total_charges = (parseInt(value['rs_per_case'])*parseInt(no_of_cases)+ parseInt(value['lr_charges'])+parseInt(value['add_charges']));
                                            //alert(value['transport_term']+ ' ' +value['Name']+ '  '+total_charges);
                                            html_rows += '<tr><td class="text-center"> '+value['Name']+'</td><td class="text-center">'+cityName+'</td><td class="text-center">'+value['transporter_city']+'</td><td class="text-center">'+value['contact_number']+'</td><td class="text-center" >'+value['transport_term']+ ' </td><td class="text-center">'+total_charges+'</td></tr>';
                                            console.log(html_rows);
                                        }
                                        else if (value['transport_term'] == 'variable') {
                                             console.log(value['lr_charges']);
                                            console.log(value['add_charges']);
                                            console.log(value['rs_upto_15']);
                                            console.log(value['rs_upto_30']); 
                                            if (parseInt(avg_weight) >15) {
                                                var total_charges = ((parseInt(value['rs_upto_30'])*parseInt(no_of_cases)*parseInt(avg_weight))+ parseInt(value['lr_charges'])+parseInt(value['add_charges']));
                                                 html_rows += '<tr><td class="text-center"> '+value['Name']+'</td><td class="text-center">'+cityName+'</td><td class="text-center">'+value['transporter_city']+'</td><td class="text-center">'+value['contact_number']+'</td><td class="text-center" >'+value['transport_term']+ ' </td><td class="text-center">'+total_charges+'</td></tr>';
                                                //alert(value['Name']+ '  '+total_charges);

                                            }
                                            else{
                                               var total_charges = ((parseInt(value['rs_upto_15'])*parseInt(no_of_cases)*parseInt(avg_weight))+ parseInt(value['lr_charges'])+parseInt(value['add_charges']));
                                                html_rows += '<tr><td class="text-center"> '+value['Name']+'</td><td class="text-center">'+cityName+'</td><td class="text-center">'+value['transporter_city']+'</td><td class="text-center">'+value['contact_number']+'</td><td class="text-center">'+value['transport_term']+ ' </td><td class="text-center">'+total_charges+'</td></tr>';
                                                //alert(value['transport_term']+ ' ' +value['Name']+ '  '+total_charges);
                                            }
                                        }
                                    });
                                    $('.show_table').css('display','block');
                                    $('#tbody').html('');
                                    $('#tbody').html(html_rows);

                                }  

                               
                            }                            
                        });
                    }
            }); 

     });  
    </script>
</body>

</html>