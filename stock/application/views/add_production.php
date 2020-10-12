<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Generate Delivery Challan | Aahaar</title>

  <?php include_once('include/headerlinks.php'); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
		<?php include_once('include/sidepanel.php'); ?>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

		<?php include_once('include/header.php'); ?>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Generate Delivery Challan</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div> 
		
		<?php
		if(!empty($this->session->flashdata('message')))
		{
		if($this->session->flashdata('message')=="Production Added Successfully." || $this->session->flashdata('message')=="Production Updated Successfully.")
		{
		?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } 
        else
        {
        ?>
          <div align="center" class="alert alert-danger">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } }?>

    <div class="card position-relative">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
        </div>
                
        <div class="card-body">
        <div class="row">
            
		    <form action="<?php echo site_url(); ?>Dispatch/dispatch_add" class="col-sm-12" method="POST" >
                
                <div class="form-group row">
                    <div class="col-lg-3">
                    <select name="project_type" id="project_type" class="form-control" >
                    <option>Normal</option>
                    <option>Sabla</option>
                    </select>
                    </div>
                    
                    
    				<div class="col-lg-3">  
                    <select name="p_city" id="p_city" class="form-control">
                    <option value="">Select City</option>
                    <?php if($DistrictData['flag']){
                foreach ($DistrictData['DistrictData'] as $value) { ?>
                    <option><?php echo $value['district_name'] ; ?></option>
                    <?php } } ?>
                    </select>
                    </div>
                    
    				<div class="col-lg-3">
                    <select name="p_project_name" id="p_project_name" class="form-control" >
                    <option value="">Select Project</option>
                    <option></option>
                    </select>
                    </div>
                    
    				
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="chalan_no" name="chalan_no" placeholder="Challan No">
                    </div>
                    
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="datepicker" name="chalan_date" placeholder="Challan Date" autocomplete ="off" readonly>
    				</div>
    				
    				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="wcd_order_no" name="wcd_order_no" placeholder="Wcd Order No">
                    </div>
                    
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="datepicker1" name="wcd_order_date" placeholder="Wcd Order Date" autocomplete ="off" readonly>
    				</div>
    				
    				
    				<div class="col-lg-3" style="display:none">
                    <input type="text" class="form-control form-control-user" id="agro_order_no" name="agro_order_no" placeholder="Agro Order No">
                    </div>
                    
    				<div class="col-lg-3" style="display:none">
                        <input type="text" class="form-control form-control-user" id="datepicker1" name="agro_order_date" placeholder="Agro Order Date" autocomplete ="off" readonly>
    				</div>
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="mobile_no" name="mobile_no" placeholder="Mobile No.">
                    </div>
                    
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="fax_no" name="fax_no" placeholder="Fax No.">
    				</div>
    				
    				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="lr_no" name="lr_no" placeholder="LR No">
                    </div>
                    
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="datepicker1" name="lr_date" placeholder="LR Date" autocomplete ="off" readonly>
    				</div>
    				
    			
    				
                </div>
                
                <div class="form-group row">
                    	<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="vehicle_no" name="vehicle_no" placeholder="Vehicle No.">
    				</div>
    				
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="driver_mobile_no" name="driver_mobile_no" placeholder="Driver Mobile No.">
    				</div>
    				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="destination" name="destination" placeholder="Destination">
                    </div>
                    
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="transporter" name="transporter" placeholder="Transporter">
    				</div>
    				
    				
    				
                </div>
                
                <br />
               <br />
               <div id="normal">
                <div class="form-group row">
                    
                    <div class="col-lg-3" style="text-align:center">
                        <label><strong>Products</strong></label>
                    <input type="text" class="form-control form-control-user" value="SOYA BARFI" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="text-align:center;display:none">
                        <label><strong>Code</strong></label>
                    <input type="text" class="form-control form-control-user" id="soya_code" name="soya_code">
                    </div>
                    
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>Batch No.</strong></label>
                    <input type="text" class="form-control form-control-user" id="soya_batch" name="soya_batch">
                    </div>
                    
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>No. of Bags</strong></label>
                        <input type="text" class="form-control form-control-user" id="soya_bags" name="soya_bags">
    				</div>
    				
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>Packets</strong></label>
                        <input type="text" class="form-control form-control-user" id="soya_packets" name="soya_packets">
    				</div>
    				
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>Quantity</strong></label>
                        <input type="text" class="form-control form-control-user" id="soya_quantity" name="soya_quantity">
    				</div>
    				
                </div>
                
                <div class="form-group row">
                    
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" value="AATA BESAN LADDU" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="display:none">
                    <input type="text" class="form-control form-control-user" id="abl_code" name="abl_code">
                    </div>
                    
    				<div class="col-lg-2">
                    <input type="text" class="form-control form-control-user" id="abl_batch" name="abl_batch">
                    </div>
                    
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="abl_bags" name="abl_bags" >
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="abl_packets" name="abl_packets">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="abl_quantity" name="abl_quantity">
    				</div>
    				
                </div>
                
                <div class="form-group row">
                    
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" value="KHICHDI 750 GM" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="display:none">
                    <input type="text" class="form-control form-control-user" id="khi750_code" name="khi750_code">
                    </div>
                    
    				<div class="col-lg-2">
                    <input type="text" class="form-control form-control-user" id="khi750_batch" name="khi750_batch">
                    </div>
                    
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi750_bags" name="khi750_bags">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi750_packets" name="khi750_packets">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi750_quantity" name="khi750_quantity">
    				</div>
    				
                </div>
                
                <div class="form-group row">
                    
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" value="HALWA" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="display:none">
                    <input type="text" class="form-control form-control-user" id="halwa_code" name="halwa_code">
                    </div>
                    
    				<div class="col-lg-2">
                    <input type="text" class="form-control form-control-user" id="halwa_batch" name="halwa_batch">
                    </div>
                    
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="halwa_bags" name="halwa_bags">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="halwa_packets" name="halwa_packets">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="halwa_quantity" name="halwa_quantity">
    				</div>
    				
                </div>
                
                <div class="form-group row">
                    
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" value="BALAAHAR" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="display:none">
                    <input type="text" class="form-control form-control-user" id="balahar_code" name="balahar_code">
                    </div>
                    
    				<div class="col-lg-2">
                    <input type="text" class="form-control form-control-user" id="balahar_batch" name="balahar_batch">
                    </div>
                    
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="balahar_bags" name="balahar_bags">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="balahar_packets" name="balahar_packets">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="balahar_quantity" name="balahar_quantity">
    				</div>
    				
                </div>
                
                <div class="form-group row">
                    
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" value="KHICHDI 625 GM" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="display:none">
                    <input type="text" class="form-control form-control-user" id="khi625_code" name="khi625_code">
                    </div>
                    
    				<div class="col-lg-2">
                    <input type="text" class="form-control form-control-user" id="khi625_batch" name="khi625_batch">
                    </div>
                    
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi625_bags" name="khi625_bags">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi625_packets" name="khi625_packets">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi625_quantity" name="khi625_quantity">
    				</div>
    				
                </div>
                
                </div>
                <div id="sabla">
                
                <div class="form-group row">
                    
                    <div class="col-lg-3" style="text-align:center">
                        <label><strong>Products</strong></label>
                    <input type="text" class="form-control form-control-user" value="BARFI 900 GM" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="display:none">
                         <label><strong>Code</strong></label>
                    <input type="text" class="form-control form-control-user" id="barfi900_code" name="barfi900_code">
                    </div>
                    
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>Batch No.</strong></label>
                    <input type="text" class="form-control form-control-user" id="barfi900_batch" name="barfi900_batch">
                    </div>
                    
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>No. of Bags</strong></label>
                        <input type="text" class="form-control form-control-user" id="barfi900_bags" name="barfi900_bags">
    				</div>
    				
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>Packets</strong></label>
                        <input type="text" class="form-control form-control-user" id="barfi900_packets" name="barfi900_packets">
    				</div>
    				
    				<div class="col-lg-2" style="text-align:center">
    				    <label><strong>Quantity</strong></label>
                        <input type="text" class="form-control form-control-user" id="barfi900_quantity" name="barfi900_quantity">
    				</div>
    				
                </div>
                
                <div class="form-group row">
                    
                    <div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" value="KHICHDI 900 GM" readonly style="text-align:center;background-color:#f6c23e;color:#FFF !important;border-color:#f6c23e" />
                    </div>
                    
                    <div class="col-lg-1" style="display:none">
                    <input type="text" class="form-control form-control-user" id="khi900_code" name="khi900_code">
                    </div>
                    
    				<div class="col-lg-2">
                    <input type="text" class="form-control form-control-user" id="khi900_batch" name="khi900_batch">
                    </div>
                    
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi900_bags" name="khi900_bags">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi900_packets" name="khi900_packets">
    				</div>
    				
    				<div class="col-lg-2">
                        <input type="text" class="form-control form-control-user" id="khi900_quantity" name="khi900_quantity">
    				</div>
    				
                </div>
                </div>
                
                <div class="form-group row">
					<div class="col-lg-12">
                    <button type="submit" name="submit" id="IssueCheck" class="btn btn-success btn-user btn-block">Generate Challan</button>
				    </div>
                </div>
            </form>
		</div>
        </div>
    </div>
			  
			<br />
                
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once('include/footer.php'); ?>
  <?php include_once('include/footerlinks.php'); ?>
  
 <script>
 var timeout = 3000; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);
  </script>
  
  <script type="text/javascript">
$(document).ready(function(){
 $('#p_city').change(function(){
   var City_id = $('#p_city').val();
  if(City_id != '')
  {
   $.ajax({
    url:"<?php echo site_url(); ?>Dispatch/get_project_by_city",
    method:"POST",
    data:{City_id:City_id},
    success:function(data)
    {
     $('#p_project_name').html(data);
    }
   });
  }
  else
  {
   $('#p_project_name').html('<option value="">Select Project Name</option>');
  }
 });
});


$(function() {
    $('#sabla').hide(); 
    $('#project_type').change(function(){
        if($('#project_type').val() == 'Sabla') {
            $('#sabla').show();
            $('#normal').hide();
        } else {
            $('#sabla').hide(); 
            $('#normal').show();
        } 
    });
});
</script>

</body>

</html>
