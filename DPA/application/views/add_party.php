<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Party | Mercure DPA</title>
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
                    Add Party
                </h2>
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Party</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                 <div class="row clearfix">
                                     <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="party_code">
											<label class="form-label">Party Code</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="party_name">
											<label class="form-label">Party Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="party_category">
											<label class="form-label">Party Category</label>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
								<div class="row clearfix">
								    <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="whatsapp_number">
											<label class="form-label">Whatsapp Number</label>
                                        </div>
                                    </div>
                                </div>
								    <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mobile_number">
											<label class="form-label">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="other_number">
											<label class="form-label">Alternate Number</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="landline_number">
											<label class="form-label">Landline Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="email_id">
											<label class="form-label">Email ID</label>
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
                                </div>
                               <div class="row clearfix">
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <style>
                                                .open{overflow:visible !important;height:25px;}
                                            </style>
                                            <select class="form-control" data-live-search="true" name="city">
									<option value="">-- Select City --</option>
<?php 
$statecity=$this->State_city_model->state_city();
//print_r($productcode);
$i=1;
if($statecity['flag']==1)  {
foreach($statecity['statecity'] as $value){
?>                               
								<option value="<?php echo $value['city'];?>"><?php echo $value['city'];?></option>
<?php } } ?>
                                    </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" data-live-search="true" name="state">
									<option value="">-- Select State --</option>
<?php 
$statelist=$this->State_city_model->get_state();
//print_r($productcode);
$k=1;
if($statelist['flag']==1)  {
foreach($statelist['statelist'] as $val){
?>                               
								<option value="<?php echo $val['state'];?>"><?php echo $val['state_code'];?> - <?php echo $val['state'];?></option>
<?php } } ?>
                                    </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Gst_number">
											<label class="form-label">GST Number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="transport">
											<label class="form-label">Transport</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="dl_no">
											<label class="form-label">DL Number</label>
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
	
</body>

</html>