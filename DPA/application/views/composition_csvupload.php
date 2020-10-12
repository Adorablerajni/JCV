<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Upload Composition | Mercure DPA</title>
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
                    Upload Composition
                </h2>
				
            </div>
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Upload Composition</h2>
                            
                        </div>
                        <div class="body">
                            <form action="<?php echo base_url(); ?>Masters/composition_csv_import" method="post" name="upload_excel" id="validation-form" enctype="multipart/form-data">

			
<div class="form-group row">
			
			<div class="col-lg-3">
                <label class="control-label custom-file-upload"> <i class="fa fa-cloud-upload"></i>Upload csv file here <!--col-lg-3 -->  
                <input type="file" name="file" id="file" class="form-control"></label> 
			</div>
</div>
			 
			
			
<div class="form-group row">
		   <div class="col-lg-12">
		   <label></label><br />
		   <button type="submit" id="submit" name="import" class="btn btn-primary col-lg-12 button-loading"><strong>Import</strong></button>
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