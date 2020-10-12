<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Brand Margin Slab | Mercure DPA</title>
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
                            <h2>Add Brand Margin Slab</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Pricing/add_brand_margin_slab">
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
								            <option value="<?php echo $val['data_product_id'];?>"><?php echo $val['Code'];?> - <?php echo $val['Name'];?></option>
                                            <?php } } ?>
                                    </select>
											<label class="form-label">Product Name</label>
                                        </div>
                                    </div>
                                </div>
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
                                            <input type="text" class="form-control" id="shipper" readonly>
											<label class="form-label">Shipper</label>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="brand_margin" id="brand_margin">
											<label class="form-label">Brand Margin</label>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="quantity">
											<label class="form-label">Quantity</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
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
    	$("#shipper").val(response['product_byid'][0]['shipper']);
    	$("#brand_margin").val(response['product_byid'][0]['brand_margin']);
    }
   })
  }
  else
  {
   $('#purchase_price').html('No Data');
  }
 });
});
</script>
	
</body>

</html>