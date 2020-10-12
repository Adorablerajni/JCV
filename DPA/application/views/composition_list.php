<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Composition List | Mercure DPA</title>
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
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                 Composition List
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                 <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>Masters/composition_csvupload">
                                    <button type="button" class="btn bg-deep-orange waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">add</i>
                                    <span>Upload CSV</span>
                                </button>
								</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>Masters/add_composition">
                                    <button type="button" class="btn bg-deep-orange waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">add</i>
                                    <span>Add Composition</span>
                                </button>
								</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Composition Code</th>
                                            <th>Composition Short</th>
                                            <th>Details</th>
                                            <th>Dosage</th>
                                            <th>Indications</th>
                                            <th>Schedule</th>
											<th>Narcotics</th>
											<th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$i=1;
if($composition_list['flag']==1)  {
foreach($composition_list['composition_list'] as $composition_val){
?>										
									<tr>
									  <td><?php echo $i++;?></td>
									  <td><?php echo $composition_val['compo_code'];?></td>
                                      <td><?php echo $composition_val['compo_short'];?></td>
                                      <td><?php echo $composition_val['compo_detail'];?></td>
									  <td><?php echo $composition_val['compo_dosage'];?></td>
									  <td><?php echo $composition_val['compo_indications'];?></td>
									  <td><?php echo $composition_val['compo_schedule'];?></td>
									  <td><?php echo $composition_val['compo_narcotics'];?></td>
									  <td><a href="<?php echo site_url(); ?>Masters/edit_composition/<?php echo $composition_val['id'];?>">Edit</a></td>
									  <td><a href="<?php echo site_url(); ?>Masters/delete_composition/<?php echo $composition_val['id'];?>" onclick="return confirm('Are you sure want to delete');">Delete</a></td>
									</tr>  
<?php }} ?>									
									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>

    <?php include_once("include/footerjs.php"); ?>
	<!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/pages/tables/jquery-datatable.js"></script>
</body>

</html>