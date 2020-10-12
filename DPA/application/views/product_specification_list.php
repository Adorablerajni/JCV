<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Products Specification List | Mercure DPA</title>
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
                               Product Specifications List
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>Masters/products_csvupload">
                                    <button type="button" class="btn bg-deep-blue waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">file_upload</i>
                                    <span>Upload Products</span>
                                </button>
								</a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>Masters/add_product_specification">
                                    <button type="button" class="btn bg-deep-orange waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">add</i>
                                    <span>Add Product</span>
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
                                            <th>#</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                        <!--     <th>Composition</th> -->
                                            <th>Division</th>
                                            <th>Packing</th>
                                            <th>GCode</th>
                                            <th>GST</th>
                                            <th>Shipper</th>
											<th>GCode6</th>
										<!-- 	<th>Image</th> -->
											<th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $i=1;
                                        if($product_specification['flag']==1)  {
                                        foreach($product_specification['product_specification'] as $product_value){
                                        ?>										
                                        <tr>
										<td><?php echo $i++;?></td>
										<td><?php echo $product_value['Code'];?></td>
										<td><?php  echo $product_value['Name'];?></td>
										<!-- <td><?php /* echo $product_value['composition']; */?></td> -->
										<td><?php echo $product_value['Unit'];?></td>
										<td><?php echo $product_value['Pack'];?></td>
										<td><?php echo $product_value['GCode'];?></td>
										<td><?php echo $product_value['GST'];?></td>
										<td><?php echo $product_value['MargCode'];?></td>
										<td><?php echo $product_value['GCode6'];?></td>
									<!-- 	<td><img src="<?php /* echo base_url(); ?>/<?php echo $product_value['product_image']; */ ?>" width="50px" height="50px" /></td> -->
										<td><a href="<?php echo base_url(); ?>Masters/edit_product_specification/<?php echo $product_value['data_product_id'];?>" target="_new">Edit</a></td>
										<td><a href="<?php echo site_url(); ?>Masters/delete_product/<?php echo $product_value['data_product_id'];?>" onclick="return confirm('Are you sure want to delete');">Delete</a></td>
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