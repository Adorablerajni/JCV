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

  <title>Add Daily Production | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Daily Production</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
		<hr /> 
		
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
            
		    <form action="<?php echo site_url(); ?>Dispatch/daily_production_add" class="col-sm-12" method="POST" >
                <div class="form-group row">    
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="datepicker" name="production_date" placeholder="Entry Date" autocomplete ="off" readonly>
    				</div>
    				
    				<div class="col-lg-3">
                        <select class="form-control" id="production_shift" name="production_shift">
                            <option value="">Select Shift</option>
                            <option>7am - 3pm</option>
                            <option>3pm - 11pm</option>
                            <option>11pm - 7am</option>
                            
                        </select>
    				</div>
    				<div class="col-lg-6">
    				    <input type="text" class="form-control form-control-user" id="production_remark" name="production_remark" placeholder="Remarks" autocomplete ="off" />
    				</div>
    			</div>
                <br />
                <h4>Products</h4>
                <div class="form-group row">
                <?php //if($ProductNameData['flag']){
                //foreach ($ProductNameData['ProductNameData'] as $value) { ?>
                    <div class="col-lg-12">
                        
                    <div class="form-group row">    
    				<div class="col-lg-3">
    				    <label><strong>ABL</strong></label>
                        <input type="number" class="form-control form-control-user" id="abl" name="abl" placeholder="Quantity" step="0.001">
    				</div>
    				
    				<div class="col-lg-3">
    				     <label><strong>Halwa</strong></label>
                        <input type="number" class="form-control form-control-user" id="halwa" name="halwa" placeholder="Quantity" step="0.001">
    				</div>
    				
    				<div class="col-lg-3">
    				    <label><strong>Baal Aahaar</strong></label>
                        <input type="number" class="form-control form-control-user" id="balahaar" name="balahaar" placeholder="Quantity" step="0.001">
    				</div>
    				
    				<div class="col-lg-3">
    				     <label><strong>Barfi-750gm</strong></label>
                        <input type="number" class="form-control form-control-user" id="barfi750" name="barfi750" placeholder="Quantity" step="0.001">
    				</div>

    				</div>
    				
    				<div class="form-group row">    
    				<div class="col-lg-3">
    				    <label><strong>Barfi-900gm</strong></label>
                        <input type="number" class="form-control form-control-user" id="barfi900" name="barfi900" placeholder="Quantity" step="0.001">
    				</div>
    				
    				<div class="col-lg-3">
    				     <label><strong>Khichdi-625gm</strong></label>
                        <input type="number" class="form-control form-control-user" id="khichdi625" name="khichdi625" placeholder="Quantity" step="0.001">
    				</div>
    				
    				<div class="col-lg-3">
    				    <label><strong>Khichdi-750gm</strong></label>
                        <input type="number" class="form-control form-control-user" id="khichdi750" name="khichdi750" placeholder="Quantity" step="0.001">
    				</div>
    				
    				<div class="col-lg-3">
    				     <label><strong>Khichdi-900gm</strong></label>
                        <input type="number" class="form-control form-control-user" id="khichdi900" name="khichdi900" placeholder="Quantity" step="0.001">
    				</div>

    				</div>

                    </div>
                <?php //} } ?>  
                </div>


                <div class="form-group row">
					<div class="col-lg-12">
                    <button type="submit" name="submit" id="IssueCheck" class="btn btn-primary btn-user btn-block">Add Production</button>
				    </div>
                </div>
            </form>
		</div>
        </div>
    </div>
			  
			  
          <!-- Content Row -->
          
<br />

	      <?php
        if(isset($ProductionData['flag'])!='' && $ProductionData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Production List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th style="text-align:center;">S.no.</th>
                              <th style="text-align:center;">City</th>
                              <th style="text-align:center;">Project Name</th>
                              <th style="text-align:center;">Challan No</th>
                              <th style="text-align:center;">Challan Date</th>
                              <th style="text-align:center;">Vehicle</th>
                              <th style="text-align:center;">Bilty</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php 
						$count = 1 ;
                        foreach($ProductionData['ProductionData'] as $val){
                        ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $val['p_city']; ?></td>
                                <td><?php echo $val['p_project_name'];?></td>
                                <td><?php echo $val['chalan_no'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($val['chalan_date']));?></td>
                                <td><?php echo $val['vehicle'];?></td>
                                <td><?php echo $val['bilty'];?></td>
							    
                              </tr>
						<?php }   ?> 
                       </tbody>
                     </table>
                  </div>
				  </div>
				  </div>
				  </div>
          </div>
		<?php 
		}
		else
		{ ?>
        <div class="row"> 
			 <div class="col-sm-12" align="center">
            <label class="control-label" >No Data Found !!</label> 
			 </div>
		</div>
		<?php 
		}	
		?>  
                
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

</body>

</html>
