<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Company | Mercure DPA</title>
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
                    Add Company
                </h2>
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Company</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                        <label class="form-label">Composition</label>
                                            <style>
                                                .open{overflow:visible !important;height:25px;}
                                            </style>
                                            <select class="form-control" data-live-search="true" name="company">
									<option value="">-- Select Company --</option>
                                    <?php 
                                    $companycode=$this->Masters_model->get_company_code();
                                    $j=1;
                                    if($companycode['flag']==1)  {
                                    foreach($companycode['companycode'] as $val){
                                    ?>                               
								<option value="<?php echo $val['id'];?>"><?php echo $val['com_code'];?> - <?php echo $val['com_name'];?></option>
                                    <?php } } ?>
                                    </select>
										
                                </div>   
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" class="form-control form-line" name="name">
											
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">&nbsp;</label><br />
                                        <button class="btn btn-primary waves-effect" type="submit">ADD</button>
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