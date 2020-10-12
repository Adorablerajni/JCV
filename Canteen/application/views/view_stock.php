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

  <title>View Stock Details | Aahaar</title>

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



    <div class="card position-relative">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Select Date</h6>
        </div>
        <div class="card-body">
        <div class="row">
			<form action="<?php echo site_url(); ?>Allotment/get_view_stock" class="col-sm-12" method="POST" >
                <div class="form-group row">
                 <?php
                 $cid = $this->uri->segment(3);
                 ?>   
                <input type="hidden" class="form-control form-control-user" id="stock_id" name="stock_id" value="<?php echo $cid ;?>" autocomplete ="off">
                
				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="datepicker" name="date1" placeholder="From Date" autocomplete ="off" readonly>
				</div>
				
				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="datepicker1" name="date2" placeholder="To Date" autocomplete ="off" readonly>
				</div>
				
				<div class="col-lg-3">
					<input type="submit" name="submit" class="btn btn-primary btn-user btn-block"  value="View List"/>
				</div>
                </div>
            </form>
		</div>
        </div>
    </div>

    <br />

          <!-- Content Row -->
		  
	<div class="card position-relative">
         <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">View Stock Details</h6>
         </div>

		<?php
        if(isset($ViewStock['flag'])!='' && $ViewStock['flag']==1 )
        {                     
        ?>
        <div class="row"> 
			<div class="col-sm-12">
				<div class="card shadow mb-4">
                  <br/>
                  
				<?php
				    $cid = $this->uri->segment(3); 
					$availableStockData = $this->Allotment_model->get_available_stock($cid);
					if($availableStockData['flag']==1)  {
								    
						$available = $availableStockData['availableStockData']['sum_stock_debit'] - $availableStockData['availableStockData']['sum_stock_credit'] ;
                    } 
                ?> 
				  <h6 class="m-0 font-weight-bold text-info" align="center"><?php echo $ViewStock['ViewStock'][0]['name_of_stock'];?> <br /> [ Available Stock : <?php echo $available ; ?> ]</h6>

				
				<div class="card-body">
				  <div class="table-responsive">
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                           <tr>
                              <th style="text-align:center;">S.no.</th>
                              <th style="text-align:center;">Stock Date</th>
                              <th style="text-align:center;">Stock Name</th>
                              <th style="text-align:center;">Stock Credit</th>
                              <th style="text-align:center;">Stock Debit</th>
                              <th style="text-align:center;">Supplier Name</th>
							  <th style="text-align:center;">Stock Issued To</th>
							  <th style="text-align:center;">Order No</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php 
						$total_credit=0;
						$total_debit=0;
						$count = 1 ;
                        foreach($ViewStock['ViewStock'] as $val){
                            
                            $total_credit += $val['stock_credit'];
                            $total_debit += $val['stock_debit'];
                        ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo  date('d-m-Y', strtotime($val['stock_date'])); ?></td>
                                <td><?php echo $val['name_of_stock']; echo " ("; echo $val['stock_type']; echo ")";?></td>
                                <td style="text-align:center;font-weight:bold;" class="text-danger"><?php if($val['stock_credit']!=''){ echo $val['stock_credit']; } else { echo "0"; }?></td>
                                <td style="text-align:center;font-weight:bold;" class="text-success"><?php if($val['stock_debit']!=''){ echo $val['stock_debit']; } else { echo "0"; }?></td>
                                <td><?php echo $val['supplier_name']; // $val['s_name'];?></td>
								<td><?php echo $val['issued_to'];?><?php if($val['issue_usertype']!='') { ?> (<?php echo $val['issue_usertype']; ?>) <?php } ?></td>
                                <td><?php if($val['order_no']!='') { echo $val['order_no']; ?> [ <?php if($val['order_date']!=''){ echo date('d-m-Y', strtotime($val['order_date'])); } else { echo ""; }  ?> ] <?php } else { echo $val['issue_stock_no']; } ?></td>
                              </tr>
						<?php }  ?> 
						
						<tr>
						    <td style="text-align:center;font-weight:bold;" colspan="3">TOTAL</td>
						    <td style="text-align:center;font-weight:bold;" class="text-danger"><?php echo $total_credit ; ?></td>
						    <td style="text-align:center;font-weight:bold;" class="text-success"><?php echo $total_debit ;?></td>
						    <td colspan="3"></td>
						</tr>
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
		{ 
	    ?>
        <div class="row"> 
			 <div class="col-sm-12" align="center">
            <label class="control-label" >No Data Found !!</label> 
			 </div>
		</div>
		<?php 
		}	
		?> 

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
</body>

</html>
