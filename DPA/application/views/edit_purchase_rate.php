<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Manage Purchase Rate | Mercure DPA</title>
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
                            <h2>Manage Purchase Rate</h2>
                            
                        </div>
                        <?php
                        $i=1;
                        if($edit_purchase_rate['flag']==1)  {
                        foreach($edit_purchase_rate['edit_purchase_rate'] as $value){
                        ?>
                        <div class="body">
                            <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Purchase/update_purchase_order">
                                 <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_name" value="<?php echo $value['Name'];?>" readonly />
											<label class="form-label">Product Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="purchase_rate" value="<?php echo $value['purchase_rate'];?>">
											<label class="form-label">Purchase Rate</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="additional_charges" value="<?php echo $value['additional_charges'];?>">
											<label class="form-label">Additional Charges(per)</label>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
								<div class="row clearfix">
								    <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="additional_cost" value="<?php echo $value['additional_cost'];?>">
											<label class="form-label">Additional Cost(amount)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="freight_charges" value="<?php echo $value['freight_charges'];?>">
                                            <input type="hidden" class="form-control" name="hdnid" value="<?php echo $value['data_product_id'];?>" />
											<label class="form-label">Freight Charges</label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
								
                               
                                <button class="btn btn-primary waves-effect" type="submit">Update</button>
                            </form>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            </div>
        </div>
    </section>

    <?php include_once("include/footerjs.php"); ?>
	
</body>

</html>