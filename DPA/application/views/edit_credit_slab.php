<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> Edit Credit Slab| Mercure DPA</title>
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
                            <h2> Edit Credit Slab</h2>
                             <?php $credit_slab_id =  urldecode($this->uri->segment(3)); ?>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Pricing/edit_creditslab/<?php echo $credit_slab_id; ?>">

                                <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="payment_type" value="<?php echo $brand_slab_margin['get_brandmargin_slab'][0]['credit_payment_title']?>">
											<label class="form-label">Payment Type</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="days"  value="<?php echo $brand_slab_margin['get_brandmargin_slab'][0]['no_of_days']?>" >
											<label class="form-label">Days</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="slab" value="<?php echo $brand_slab_margin['get_brandmargin_slab'][0]['credit_percentage']?>">
											<label class="form-label">Slab</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="visibility:hidden">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="operator" value="0">
											<label class="form-label">Operator</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary waves-effect" type="submit">Update</button>
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
	
</body>

</html>