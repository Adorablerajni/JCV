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

  <title>Dispatch Report | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Production Report</h1>
          </div>
		<?php if($this->session->flashdata('message')=="Please Select Stock Type"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>


          <!-- Content Row -->
		  
<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Select Date</h6>
                </div>
                <div class="card-body">
          <div class="row">
				   <form action="<?php echo site_url(); ?>Dispatch/production_report" class="col-sm-12" method="POST" >
                <div class="form-group row">
					
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="datepicker" name="date1" placeholder="Date From" autocomplete ="off" readonly>
    				</div>
    				
    				<div class="col-lg-3">
                        <input type="text" class="form-control form-control-user" id="datepicker1" name="date2" placeholder="Date To" autocomplete ="off" readonly>
    				</div>
    				
					<div class="col-lg-3">
						<input type="submit" name="submit" class="btn btn-primary btn-user btn-block"  value="View Report"/>
					</div>
                </div>
              </form>
		  </div>
              </div>
              </div>

		  <br />
	      <?php
	    if(isset($_POST['submit'])!='')
	    {
        if(isset($ProductionReportData['flag'])!='' && $ProductionReportData['flag']==1 && isset($ProductNameData['flag'])!='')
        {    
             //$total_column = 7 + ($ProductNameData['total_product_count'] * 2);
             //$current_year = date('Y',strtotime($_POST['date2']));
            // $next_year =date ("y", strtotime ($current_year ."+366 days"));
             
             //$month = date('M',strtotime($_POST['date2']));
             
             //$date1 = $_POST['date1'];
             //$date2 = $_POST['date2'];
        ?>
                  <div class="row">
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Dispatch Report</h6>
            </div>
            <div class="card-body">
				
				  <div class="table-responsive">
                     <table class="table table-striped table-bordered" id="example">
                        <thead>
                            
                           <tr>
                               <th colspan="<?php echo $total_column ; ?>" style="text-align:center;">MAHILA AAJEEVIKA AOUDOYOGIK SAHKARI SANSTHA MARYADIT DEWAS</th>
                           </tr>
                            
                           <tr>
                               <th colspan="<?php echo $total_column ; ?>" style="text-align:center;">Dispatch Details : (ORDER 6th <?php echo $current_year ; ?>-<?php echo $next_year ;?> WCD Letter No. 4070 Dewas) Month <?php echo $month;?>.</th>
                           </tr>
                            
                           <tr>
                              <th rowspan="2" style="text-align:center;">S.no.</th>
                              <th rowspan="2" style="text-align:center;">District</th>
                              <th rowspan="2" style="text-align:center;">Project</th>
                              <th rowspan="2" style="text-align:center;">Challan No</th>
                              <th rowspan="2" style="text-align:center;">Date</th>
                              <th colspan="<?php echo $ProductNameData['total_product_count'];?>" style="text-align:center;">Packets</th>
                              <th colspan="<?php echo $ProductNameData['total_product_count'];?>" style="text-align:center;">Batch No</th>
                              <th rowspan="2" style="text-align:center;">Vehicle</th>
                              <th rowspan="2" style="text-align:center;">Bilty</th>
                           </tr>
                           
                           <tr>
                              <?php if($ProductNameData['flag']){
                              foreach ($ProductNameData['ProductNameData'] as $value1) { ?>
                               <th style="text-align:center;"><?php echo $value1['product_name'] ; ?></th>
                              <?php 
                              }
                              foreach ($ProductNameData['ProductNameData'] as $value2) { ?>
                               <th style="text-align:center;"><?php echo $value2['product_name'] ; ?></th>
                              <?php } } ?>  
                           </tr>
                        </thead>
                        <tbody>
						<?php 
						$count = 1 ;
						$h=1;
						foreach($ProductionReportData['ProductionReportData'] as $value){ 

						$production_id = $value['id'];
						?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $value['p_city'] ; ?></td>
                                <td><?php echo $value['p_project_name'] ;?></td>
                                <td><?php echo $value['chalan_no'] ;?></td>
                                <td><?php echo date("d-m-Y", strtotime($value['chalan_date'] )) ;?></td>
                                <?php 
                                $m=0;
                                if($ProductNameData['flag']){
                                foreach ($ProductNameData['ProductNameData'] as $val) { 


                                $product_id = $val['id'] ;
                                $type = "PACKETS";
                                    
                                $ProductPcketsData = $this->Dispatch_model->get_dispatch_report_packets($product_id, $production_id, $type);   
                                
                                if($ProductPcketsData['flag']==1)  {
                                    
                                    $total[$h][$m] = $ProductPcketsData['DispatchReportDetailsData']['counts'] ;
                                ?>
                                <td><?php echo $ProductPcketsData['DispatchReportDetailsData']['counts'] ; ?></td>
                                <?php 
                                }
                                else
                                {
                                    $total[$h][$m] = 0 ;
                                ?>
                                <td>0</td>
                                <?php
                                }
                                $m++;
                                }
                                }
                                ?>
                                <?php 
                                if($ProductNameData['flag']){
                                foreach ($ProductNameData['ProductNameData'] as $val1) { 
                                
                                $product_id = $val1['id'] ;
                                $type = "BATCH NO";
                                    
                                $ProductBatchData = $this->Dispatch_model->get_dispatch_report_packets($product_id, $production_id, $type);   
                                
                                if($ProductBatchData['flag']==1)  {
                                ?>
                                <td><?php echo $ProductBatchData['DispatchReportDetailsData']['counts'] ; ?></td>
                                <?php 
                                }
                                else
                                {
                                ?>
                                <td>0</td>
                                <?php
                                }
                                }
                                }
                                ?>
                                <td><?php echo $value['vehicle'] ;?></td>
                                <td><?php echo $value['bilty'] ;?></td>
                                <!--<td><a href="<?php echo site_url();?>Allotment/view_stock/<?php //echo $value['id']; ?>" target="_new"><?php //echo $value['stock_name'];?></a></td>-->
                              </tr>
						<?php $h++; }   ?> 
						
						<tr>
						<td colspan="5">Packets</td>
                                <?php 
                                $o=0;
                                if($ProductNameData['flag']){
                                foreach ($ProductNameData['ProductNameData'] as $val11) { 
                                $final_packect = 0;
                                for($n=1;$n<=$count-1;$n++)
                                {
                                    $final_packect +=  $total[$n][$o] ;

                                }
                                ?>
                                <td><?php echo $final_packect; ?></td>
                                <?php
                                $o++;
                                }
                                }
                                ?>
                        <td colspan="<?php echo $col = $o + 3 ; ?>"></td>        
						</tr>
						
						<tr>
						<td colspan="5">Qtt. MT</td>
                                <?php 
                                $p=0;
                                if($ProductNameData['flag']){
                                foreach ($ProductNameData['ProductNameData'] as $val12) { 
                                
                                $product_gram = $val12['product_gram'] ;  
                                
                                $final_packect1 = 0;
                                for($q=1;$q<=$count-1;$q++)
                                {
                                    $final_packect1 +=  $total[$q][$p] ;

                                }
                                ?>
                                <td><?php echo $qtt_mt = ($final_packect1 * $product_gram) / 1000000 ;  $qtt_mt_sum[1][$p] = $qtt_mt; ?></td>
                                <?php
                                $p++;
                                }
                                }
                                ?>
                        <td colspan="<?php echo $col1 = $p + 3 ; ?>"></td>        
						</tr>
						
						<tr>
						<td colspan="5">Dispatch up to last report</td>
                                <?php 
                                $r=0;
                                if($ProductNameData['flag']){
                                foreach ($ProductNameData['ProductNameData'] as $val13) { 
                                
                                $productid = $val13['id'] ; 
                                
                                $LastReportData = $this->Dispatch_model->get_dispatch_upto_last_report($productid, $date1, $date2); 
                                //print_r($LastReportData);

                                if(isset($LastReportData['flag'])!='' && $LastReportData['flag']===1)
                                {
                                    
                                    if($LastReportData['LastReportData']['p_counts']!='')
                                    {
                                        $last_report_count = $LastReportData['LastReportData']['p_counts'];
                                    }
                                    else
                                    {
                                        $last_report_count = 0;
                                    }
                                    
                                    $last_report_sum[1][$r] = $last_report_count;
                                }
                                ?>
                                <td><?php echo $last_report_count ; ?></td>
                                <?php
                                $r++;
                                }
                                }
                                ?>
                        <td colspan="<?php echo $col2 = $r + 3 ; ?>"><b>GTD</b></td>   
						</tr>
						
						<tr>
						<td colspan="5">Total Dispatch</td>
                                <?php 
                                $t=0;
                                $gtd = 0;
                                if($ProductNameData['flag']){
                                foreach ($ProductNameData['ProductNameData'] as $val14) { 
                                    
                                $total_dispatch = $qtt_mt_sum[1][$t] + $last_report_sum[1][$t] ;
                                
                                $gtd += $total_dispatch ;
                                ?>
                                <td><?php echo $total_dispatch ; ?></td>
                                <?php
                                $t++;
                                }
                                }
                                ?>
                        <td colspan="<?php echo $col3 = $t + 3 ; ?>"><b><?php echo $gtd ;?></b></td> 
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
		{ ?>
         <div class="row"> 
			 <div class="col-sm-12" align="center">
            <label class="control-label" >No Data Found !!</label> 
			 </div>
		</div>
		<?php 
		}
	        
	    }	
		?>   
                
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php include_once('include/footer.php'); ?>
  <?php include_once('include/footerlinks.php'); ?>

</body>

</html>
