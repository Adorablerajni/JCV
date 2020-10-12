<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit State & City | Mercure DPA</title>
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
                    Edit State or City
                </h2>
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit State/City</h2>
                            
                        </div>
                        <div class="body">
                            <?php $state_city_id =  urldecode($this->uri->segment(3));  ?>
                            <form id="form_validation" method="POST"  action="<?php echo base_url(); ?>State_list/edit_state_city/<?php echo $state_city_id; ?>">
                                <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="city" value="<?php  echo $city_state_by_id['city_state_by_id'][0]['city']?>">
											<label class="form-label">City Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tier_cat" value="<?php  echo $city_state_by_id['city_state_by_id'][0]['tier_cat']?>">
											<label class="form-label">Tier Category</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <style>
                                                .open{overflow:visible !important;height:25px;max-width:500px;}
                                            </style>
                                            <select class="form-control"  data-live-search="true" name="state">
									<option value="">-- Select State --</option>
<?php 
$statelist=$this->State_city_model->get_state();
$i=1;
if($statelist['flag']==1)  {
foreach($statelist['statelist'] as $val){
?>                               
								<option <?php if ($city_state_by_id['city_state_by_id'][0]['state_code'] == $val['state_code']) {
                                    echo "selected";
                                } ?> value="<?php echo $val['id'];?>"><?php echo $val['state_code'];?> - <?php echo $val['state'];?></option>
<?php } } ?>
                                    </select>
											<label class="form-label">State Name</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                               
                                <button class="btn btn-primary waves-effect" type="submit">Update</button>
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