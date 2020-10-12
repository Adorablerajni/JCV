<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Transport List | Mercure DPA</title>
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
                    Transport List
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EXPORTABLE TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>Masters/add_transport">
                                    <button type="button" class="btn bg-deep-orange waves-effect" style="margin-top:-10px;">
                                    <i class="material-icons">add</i>
                                    <span>Add Transport</span>
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
                                            <th>Transporter Name</th>
                                            <th>Transporter's City</th>
                                            <th>Head Office City</th>
                                            <th>Contact Person</th>
                                            <th>Address</th>
                                            <th>Contact Number  </th>
                                            <th>Transport Cities  </th>
											<th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$i=1;
if($transport_list['flag']==1)  {
$head_city ='';
$cities ='';
foreach($transport_list['transport_list'] as $transport_val){
$head_city =  $this->State_city_model->head_office_city($transport_val['city_of_head_office']); 
$cities =  $this->State_city_model->get_transporter_cities($transport_val['t_id']); 

$j=0;
$more_cities = '';
$citiesCount = count($cities);
foreach ($cities as  $city=>$value) { 
    $j++;
    // print_r($value['tc_id']);
    if ($j ==1) {
        $more_cities .= "<a href='".site_url()."/Masters/edit_transport_charge/".$value['tc_id']."'>" .$value['city']."</a>";
    }
    else{
        $more_cities  .= ' , ' . "<a href='".site_url()."/Masters/edit_transport_charge/".$value['tc_id']."'>" .$value['city']."</a>";
    }
    

}
                                  

?>										
									<tr>
									  <td><?php echo $i++;?></td>
									  <td><?php echo $transport_val['Name'];?></td>
                                      <td><?php echo $transport_val['city_name'];?></td>                                      
                                      <td><?php echo $head_city->city; ?></td>                                                                     
                                      <td><?php echo $transport_val['contact_person'];?></td>
									  <td><?php echo $transport_val['address'];?></td>
									  <td><?php echo $transport_val['contact_number'];?></td>
                                      <td><?php echo $more_cities;?></td>

									  <td><a href="<?php echo site_url(); ?>Masters/edit_transport/<?php echo $transport_val['t_id'];?>">Edit</a></td>
									  <td><a href="<?php echo site_url(); ?>Masters/delete_transport/<?php echo $transport_val['t_id'];?>" onclick="return confirm('Are you sure want to delete');">Delete</a></td>
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