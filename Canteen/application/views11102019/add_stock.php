<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add Stock | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Stock</h1>
          </div>
		<?php 	if($this->session->flashdata('message')=="Stock Added Successfully"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message');?>
          </div>
        <?php 	}
				elseif($this->session->flashdata('message')=="Stock Not Added"){ ?>
				<div align="center" class="alert alert-danger">      
            <?php echo $this->session->flashdata('message');?>
          </div>
        <?php 	} ?>


          <!-- Content Row -->
		  
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
			<form action="<?php echo site_url(); ?>Allotment/show_stock_list" class="col-sm-12" method="POST" >
				<div class="row"> 
				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="txtEntryDate" name="txtEntryDate" placeholder="Entry Date" autocomplete="off">
				</div>
				<div class="col-lg-3">
					<input type="submit" name="submit"class="btn btn-primary btn-user btn-block"  value="View Stock's"/>
				</div>
				</div>
            </form>
		  </div>
		  <br />
	      <?php
        if(isset($stockListByDate['flag'])!='' && $stockListByDate['flag']==1 )
        {          
        ?>
          <div class="row"> 
				   <form action="<?php echo site_url(); ?>Allotment/stock_add" class="col-sm-12" method="POST" >
                
					<div class="col-sm-12">
                  
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Checkin Date</th>
                              <th>Stock Name</th>
                              <th>Quantity</th>
                              <th>Rate</th>
                              <th>Amount</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                              if($stockListByDate['flag']==1)  {
                                foreach($stockListByDate['stockListByDate'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $val['checkin_date'];?><input type="hidden" class="form-control form-control-user" id="txtCheckinDate"  name="txtCheckinDate" value="<?php echo $val['checkin_date'];?>" /></td>
                                <td><?php echo $val['st_name'];?><input type="hidden" class="form-control form-control-user" id="txtStockName"  name="txtStockName[]" value="<?php echo $val['stock_name'];?>" /></td>
                                <td><?php echo $val['checkin_quantity'];?><input type="hidden" class="form-control form-control-user" id="txtQuantity<?php echo $count;?>"  name="txtQuantity[]" value="<?php echo $val['checkin_quantity'];?>" /></td>
                                <td><input type="number" step="0.01" class="form-control form-control-user" id="txtRate<?php echo $count;?>"  name="txtRate[]" onkeyup="calc_amt<?php echo $count;?>()" placeholder="0"/></td>
                                <td><input type="number" class="form-control form-control-user" id="txtAmount<?php echo $count;?>"  name="txtAmount[]" placeholder="0" readonly /></td>
                              
<script type="text/javascript">
function calc_amt<?php echo $count;?>() {
		var quantity = document.getElementById('txtQuantity<?php echo $count;?>').value;
		var rate = document.getElementById('txtRate<?php echo $count;?>').value;
		var result = quantity*rate;
		document.getElementById("txtAmount<?php echo $count;?>").value = result;
}
</script>
							  </tr>
							   <?php $count++; } }  ?> 
                       </tbody>
                     </table>
                  </div>
				  
                <div class="form-group row">
					<div class="col-lg-3">
						<input type="submit" name="submit"class="btn btn-primary btn-user btn-block"  value="Add Stock"/>
					</div>
                </div>
                
                
              </form>
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
              </div>
			  
<br />

		
    <?php
        if(isset($allIssueStockData['flag'])!='' && $allIssueStockData['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Stock List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Stock Date</th>
                              <th>Stock Id</th>
                              <th>Stock Debit</th>
                              <th>Stock Rate</th>
                              <th>Stock Amount</th>
                              <th>Time</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                                foreach($allIssueStockData['allIssueStockData'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo  date('d-m-Y', strtotime($val['stock_date'])); ?></td>
                                <td><?php echo $val['name_of_stock']; echo " ("; echo $val['stock_type']; echo ")";?></td>
                                <td><?php echo $val['stock_debit'];?></td>
                                <td><?php echo $val['stock_rate'];?></td>
                                <td><?php echo $val['stock_amount'];?></td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($val['creation_date']));?></td>
                              </tr>
							   <?php }  ?> 
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
