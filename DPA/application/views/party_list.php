<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Party List | Mercure DPA</title>
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
                                Party List
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>Masters/parties_csvupload">
                                    <button type="button" class="btn bg-deep-blue waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">file_upload</i>
                                    <span>Upload Parties</span>
                                </button>
								</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>Party_list/add_party">
                                    <button type="button" class="btn bg-deep-orange waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">add</i>
                                    <span>Add Party</span>
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
                                            <th>Party Code</th>
                                            <th>Party name</th>
                                            <!-- <th>Party Category</th> -->
                                            <th>Whatsapp No.</th>
                                            <th>Mobile Number</th>
											<th>Address</th>
                                            <th>Pin</th>
											<th>Rout</th>
                                            <<!-- th>State</th>
											<th>Other No.</th>
											<th>Landline</th>
											<th>Transport</th> -->
                                            <th>GST Number</th>
                                            <th>DL No.</th>
											<th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$i=1;
if($partylist['flag']==1)  {
foreach($partylist['partylist'] as $party_val){
?>										
									<tr>
									  <td><?php echo $i++;?></td>
									  <td><?php echo $party_val['CID'];?></td>
                                      <td><?php echo $party_val['ParNam'];?></td>
                          <!--             <td><?php /*echo $party_val['category'];*/?></td> -->
									  <td><?php echo $party_val['Phone1'];?></td>
									  <td><?php echo $party_val['Phone2'];?></td>
									  <td><?php echo $party_val['ParAdd1'];?></td>
									  <td><?php echo $party_val['Pin'];?></td>
									  <td><?php echo $party_val['Rout'];?></td>
									  <!-- <td><?php /*echo $party_val['state'];?></td>
									  <td><?php echo $party_val['other_no'];?></td>
									  <td><?php echo $party_val['landline_no'];?></td>
									  <td><?php echo $party_val['transport'];*/?></td> -->
									  <td><?php echo $party_val['GSTNo'];?></td>
									  <td><?php echo $party_val['DlNo'];?></td>
									  <td><a href="<?php echo site_url(); ?>Masters/edit_party/<?php echo $party_val['data_party_id'];?>">Edit</a></td>
									  <td><a href="<?php echo site_url(); ?>Masters/delete_party/<?php echo $party_val['data_party_id'];?>" onclick="return confirm('Are you sure want to delete');">Delete</a></td>
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