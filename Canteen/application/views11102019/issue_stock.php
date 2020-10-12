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

  <title>Issue Stock | Aahaar</title>

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
            <h1 class="h3 mb-0 text-gray-800">Issue Stock</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
		<hr /> 
		<?php if($this->session->flashdata('message')=="Issued Successfully"){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php }elseif($this->session->flashdata('message')=="Please Select Date and Name"){?>
          <div align="center" class="alert alert-danger">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>

<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Add details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
		  <form action="<?php echo site_url(); ?>Allotment/add_issue_stock" class="col-sm-12" method="POST" >
                <div class="form-group row">
				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="txtEntryDate" name="txtEntryDate" placeholder="Entry Date" autocomplete ="off" readonly>
				</div>
				<div class="col-lg-3">
                    <input type="text" class="form-control form-control-user" id="txtIssueTo" name="txtIssueTo" placeholder="Issue to Whom">
				</div>
                </div>
                <div class="form-group row">
				<div class="col-sm-3">  
            <select name="txtStockName" id="txtStockName" class="form-control">
            <option value="">Select Stock Name</option>
            <?php if($stockNameData['flag']){
            foreach ($stockNameData['stockNameData'] as $value) { ?>
            <option  value="<?php echo $value['id'] ; ?>"><?php echo $value['stock_name'] ; ?> - [<?php echo $value['stock_type'] ; ?>]</option>
            <?php } } ?>
            </select>
            </div>
			
				  <div class="col-lg-3">
                    <input type="number" class="form-control form-control-user" id="txtCurrentStock"  name="txtCurrentStock" placeholder="Current Stock" readonly>
                  </div>
				  <div class="col-lg-3">
                    <input type="number" class="form-control form-control-user" id="txtIssueQuantity"  name="txtIssueQuantity" placeholder="Issue Quantity">
                  </div>
				  <div class="col-lg-3">
                    <input type="number" class="form-control form-control-user" id="txtAvailableStock" name="txtAvailableStock" placeholder="Available Stock" readonly>
                  </div>
                </div>
                <div class="form-group row">
					<div class="col-sm-2"> <br />
					<input type="button" value="+ Add row" id="checkin_details" class="form-control btn btn-secondary" />
					</div>
                </div>
				
				<br />
           <table id="table" name="table" class="table table-striped table-bordered table-hover" ><!--style="display:hide()"-->
                      <thead>
                        <tr>
                          <th>Stock Name</th>
                           <th>Available</th>
						   <th>Amount</th>
                           <th>Balance</th>
						    <th></th>
						 </tr>
                      </thead>
					  
                      <tbody>
                      </tbody>
                    </table>
					 <br />
			
                    <div class="form-group ">
                        <div class="col-lg-12" id="notice_alert" align="center">
                        <label>&nbsp;</label>
                        <label class="text-danger" style="font-size:18px">Click the "Add More(s)" Button</label>
                      </div>
										  
					<div class="row">  
					<div class="col-lg-12">
                    <button type="submit" name="submit" id="IssueCheck" class="btn btn-primary btn-user btn-block">Issue Stock</button>
					</div>
					</div>
                    </div>
					
                
              </form>
		  </div>
                </div>
              </div>
			  
			  
          <!-- Content Row -->
          
<br />

	      <?php
        if(isset($issueStockList['flag'])!='' && $issueStockList['flag']==1 )
        {
                             
        ?>
          <div class="row"> 
		  <div class="col-sm-12">
				  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Issue Stock List</h6>
            </div>
            <div class="card-body">
              
				  <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>S.no.</th>
                              <th>Stock Name</th>
                              <th>Stock Date</th>
                              <th>Stock Credit</th>
                              <th>Issued To Name</th>
                           </tr>
                        </thead>
                        <tbody>
						<?php $count = 1 ;
                                foreach($issueStockList['issueStockList'] as $val){
                                       ?> 
                              <tr>
                                <td><?php echo $count++ ;?></td>
							    <td><?php echo date('d-m-Y', strtotime($val['stock_date']));?></td>
                                <td><?php echo $val['name_of_stock']; echo " ("; echo $val['stock_type']; echo ")";?></td>
                                <td><?php echo $val['stock_credit'];?></td>
                                <td><?php echo $val['issued_to'];?></td>
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
<script type="text/javascript">
$(document).ready(function(){
 $('#txtStockName').change(function(){
   var Stock_id = $('#txtStockName').val();
  if(Stock_id != '')
  {
   $.ajax({
    url:"<?php echo site_url(); ?>Allotment/get_quantity_by_stock",
    method:"POST",
	dataType: "json",
    data:{Stock_id:Stock_id},
    success:function(data)
    {
		document.getElementById("txtCurrentStock").value = data.quantity_d-data.quantity_c;
    }
   });
  }
  else
  {
		document.getElementById("txtCurrentStock").value = '0';
  }
 });
});

$(document).ready(function(){
 $('#txtIssueQuantity').change(function(){
   var a = document.getElementById("txtCurrentStock").value;
   var b = document.getElementById("txtIssueQuantity").value;
   document.getElementById("txtAvailableStock").value=a-b;
 });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
		$("#table").hide(); 
		$("#IssueCheck").hide(); 
});

$(document).ready(function(){
	 
 
	$("#checkin_details").click(function(){
		$("#table").show(); 
		$("#table").append('<tr valign="top"><td><input type="hidden" name="txtStockName[]" id="txtStockName_j" value="'+$("#txtStockName").val()+'" />'+$('#txtStockName option:selected').text()+'</td><td><input type="hidden" name="txtCurrentStock[]" value="'+$("#txtCurrentStock").val()+'" />'+$("#txtCurrentStock").val()+'</td><td><input type="hidden" name="txtIssueQuantity[]" value="'+$("#txtIssueQuantity").val()+'" />'+$("#txtIssueQuantity").val()+'</td><td ><input type="hidden" name="txtAvailableStock[]" value="'+$("#txtAvailableStock").val()+'" />'+$("#txtAvailableStock").val()+'</td><td  class="text-danger"><a href="javascript:void(0);" class="text-danger remCF">Remove</a></td></tr>');
	
		btnCheck();
		$('#txtStockName').val('');
		$('#txtCurrentStock').val('');
		$('#txtIssueQuantity').val('');
		$('#txtAvailableStock').val('');
		
	});
        
    $("#table").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});

 function btnCheck(){
if(!$('#txtStockName').val()){
    $('#IssueCheck').hide();
	$('#notice_alert').show();
}
else {
    $('#IssueCheck').show();
	$('#notice_alert').hide();
}
};
</script>
</body>

</html>
