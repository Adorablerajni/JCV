<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add State/City Slab | Mercure DPA</title>
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
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add State/City Slab</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Pricing/add_citystate_slab">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <style>
                                                .open{overflow:visible !important;height:25px;max-width:500px;}
                                            </style>
                                            <select class="form-control"  data-live-search="true" name="product" id="product">
									        <option value=""></option>
                                            <?php 
                                                $productcode=$this->Masters_model->get_product_code();
                                                $j=1;
                                                if($productcode['flag']==1)  {
                                                foreach($productcode['productcode'] as $val){
                                            ?>                               
								            <option value="<?php echo $val['p_id'];?>"><?php echo $val['code'];?> - <?php echo $val['name'];?></option>
                                            <?php } } ?>
                                    </select>
											<label class="form-label">Product Name</label>
                                        </div>
                                    </div>
                                </div>
                                <input id="url" type="hidden" name="url" value="<?php echo site_url('Masters/get_city');?>">

                               <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="purchase_price" readonly>
											<label class="form-label">Purchase Price</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="brand_margin" id="brand_margin" readonly>
											<label class="form-label">Brand Margin</label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                               <div class="row clearfix">
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <style>
                                                .open{overflow:visible !important;height:25px;max-width:500px;}
                                            </style>
                                            <select class="form-control"  data-live-search="true" name="state" id="state">
									<option value="">-- Select State --</option>
                                            <?php 
                                            $statelist=$this->State_city_model->get_state();
                                            $i=1;
                                            if($statelist['flag']==1)  {
                                            foreach($statelist['statelist'] as $val){
                                            ?>                               
								            <option value="<?php echo $val['state_code'];?>"><?php echo $val['state_code'];?> - <?php echo $val['state'];?></option>
                                            <?php } } ?>
                                    </select>
											<label class="form-label">State Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line" id="tdcity">
                                            <style>
                                                .open{overflow:visible !important;height:25px;max-width:500px;}
                                            </style>
                                            <select class="form-control"  data-live-search="true" name="city" id="city">
									<option value="ALL">-- ALL --</option>
                                            <?php 
                                                    $statecity=$this->Masters_model->state_city();
                                                        //print_r($productcode);
                                                    $i=1;
                                                    if($statecity['flag']==1)  {
                                                    foreach($statecity['statecity'] as $value){
                                                    ?>                               
								                    <option value="<?php echo $value['id'];?>"><?php echo $value['city'];?></option>
                                                    <?php } } ?>
                                    </select>
											<label class="form-label">City Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="discount">
											<label class="form-label">Discount(in %)</label>
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">ADD</button>
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
 $('#product').change(function(){
   var product_id = $('#product').val();
  if(product_id != '')
  {
   $.ajax({
    url:"<?php echo site_url(); ?>Transactions/get_products_by_id",
     dataType:"json",
    method:"POST",
    data:{product_id:product_id},
    success:function(response)
    {
        //alert(response);
    	$("#purchase_price").val(response['product_byid'][0]['purchase_rate']);
    	$("#brand_margin").val(response['product_byid'][0]['brand_margin']);
    	
    }
   })
  }
  else
  {
   $('#purchase_price').html('No Data');
  }
 });

  $(document).on('change','#state',function(){
     var url = $('#url').val();
     
     
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
                 var option_html ='<select data-live-search="true" id="city" name="city" class="form-control" style="width:300px">'
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
});
</script>
</body>

</html>