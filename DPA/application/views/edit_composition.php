<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Composition | Mercure DPA</title>
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
                            <h2>Edit Composition</h2>
                            
                        </div>
                        <div class="body">
                             <?php $hdnid =  urldecode($this->uri->segment(3)); ?>
                            <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Masters/edit_composition/<?php echo $hdnid; ?>">
                                <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" class="form-control" name="hdnid" value="<?php echo $hdnid; ?>" />
                                            <input type="text" class="form-control" name="short" value="<?php echo $composition_byid['composition_byid'][0]['compo_short']?>">
											<label class="form-label">Composition Short</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="dosage" value="<?php echo $composition_byid['composition_byid'][0]['compo_dosage']?>">
											<label class="form-label">Dosage</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="indication" value="<?php echo $composition_byid['composition_byid'][0]['compo_indications']?>">
											<label class="form-label">Indications</label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="schedule" value="<?php echo $composition_byid['composition_byid'][0]['compo_schedule']?>">
											<label class="form-label">Schedule</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="narcotics" value="<?php echo $composition_byid['composition_byid'][0]['compo_narcotics']?>">
											<label class="form-label">Narcotics</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="details" value="<?php echo $composition_byid['composition_byid'][0]['compo_detail']?>">
											<label class="form-label">Composition Details</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-success col-md-12" type="submit">UPDATE</button>
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