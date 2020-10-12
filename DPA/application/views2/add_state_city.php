<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add State & City | Mercure DPA</title>
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
                    Add State or City
                </h2>
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add State/City</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                    <div class="form-group form-float">
									<select class="form-control" name="state">
									<option value="">-- Select State --</option>
<?php 
$statelist=$this->State_city_model->get_state();
$i=1;
if($statelist['flag']==1)  {
foreach($statelist['statelist'] as $val){
?>                               
								<option value="<?php echo $val['state'];?>"><?php echo $i++;?>.<?php echo $val['state'];?></option>
<?php } } ?>
                                    </select>
									</div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="city" required>
                                        <label class="form-label">City Name</label>
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