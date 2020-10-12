<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Party | Mercure DPA</title>
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
                            <h2>Edit Party</h2>
                            
                        </div>
                        <div class="body">
                            <?php $hdnid =  urldecode($this->uri->segment(3)); ?>
                            
                            <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Masters/edit_party/<?php echo $hdnid; ?>">
                                 <div class="row clearfix">
                                     <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" class="form-control" name="hdnid" value="<?php echo $hdnid; ?>" />
                                            <input type="text" class="form-control" name="party_code" value="<?php echo $party_list_byid['party_list_byid'][0]['code']?>">
											<label class="form-label">Party Code</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="party_name" value="<?php echo $party_list_byid['party_list_byid'][0]['name']?>">
											<label class="form-label">Party Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="party_category" value="<?php echo $party_list_byid['party_list_byid'][0]['category']?>">
											<label class="form-label">Party Category</label>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
								<div class="row clearfix">
								    <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="whatsapp_number" value="<?php echo $party_list_byid['party_list_byid'][0]['whatsapp_no']?>">
											<label class="form-label">Whatsapp Number</label>
                                        </div>
                                    </div>
                                </div>
								    <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mobile_number" value="<?php echo $party_list_byid['party_list_byid'][0]['mobile']?>">
											<label class="form-label">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="other_number" value="<?php echo $party_list_byid['party_list_byid'][0]['other_no']?>">
											<label class="form-label">Alternate Number</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="landline_number" value="<?php echo $party_list_byid['party_list_byid'][0]['landline_no']?>">
											<label class="form-label">Landline Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="email_id" value="<?php echo $party_list_byid['party_list_byid'][0]['email']?>">
											<label class="form-label">Email ID</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="address" value="<?php echo $party_list_byid['party_list_byid'][0]['address']?>">
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
									
									<option><?php echo $party_list_byid['party_list_byid'][0]['city']?></option>
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
									
									<option><?php echo $party_list_byid['party_list_byid'][0]['state']?></option>
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
                                            <input type="text" class="form-control" name="Gst_number" value="<?php echo $party_list_byid['party_list_byid'][0]['gstno']?>">
											<label class="form-label">GST Number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                   <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="transport" value="<?php echo $party_list_byid['party_list_byid'][0]['transport']?>">
											<label class="form-label">Transport</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="dl_no" value="<?php echo $party_list_byid['party_list_byid'][0]['dl_no']?>">
											<label class="form-label">DL Number</label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
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