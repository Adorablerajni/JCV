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

  <title>Purchase Order | Aahaar</title>

  <?php include_once('include/headerlinks.php'); ?>
<style>
    .chosen-select {
  width: 100%;
}
.chosen-select-deselect {
  width: 100%;
}
.chosen-container {
  display: inline-block;
  position: relative;
  vertical-align: middle;
}
.chosen-container .chosen-drop {
  background: #ffffff;
  border: 1px solid #cccccc;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
  -webkit-box-shadow: 0 8px 8px rgba(0, 0, 0, .25);
  box-shadow: 0 8px 8px rgba(0, 0, 0, .25);
  margin-top: -1px;
  position: absolute;
  top: 100%;
  left: -9000px;
  z-index: 1060;
}
.chosen-container.chosen-with-drop .chosen-drop {
  left: 0;
  right: 0;
}
.chosen-container .chosen-results {
  color: #555555;
  margin: 0 4px 4px 0;
  max-height: 240px;
  padding: 0 0 0 4px;
  position: relative;
  overflow-x: hidden;
  overflow-y: auto;
  -webkit-overflow-scrolling: touch;
}
.chosen-container .chosen-results li {
  display: none;
  line-height: 1.42857143;
  list-style: none;
  margin: 0;
  padding: 5px 6px;
}
.chosen-container .chosen-results li em {
  background: #feffde;
  font-style: normal;
}
.chosen-container .chosen-results li.group-result {
  display: list-item;
  cursor: default;
  color: #999;
  font-weight: bold;
}
.chosen-container .chosen-results li.group-option {
  padding-left: 15px;
}
.chosen-container .chosen-results li.active-result {
  cursor: pointer;
  display: list-item;
}
.chosen-container .chosen-results li.highlighted {
  background-color: #428bca;
  background-image: none;
  color: white;
}
.chosen-container .chosen-results li.highlighted em {
  background: transparent;
}
.chosen-container .chosen-results li.disabled-result {
  display: list-item;
  color: #777777;
}
.chosen-container .chosen-results .no-results {
  background: #eeeeee;
  display: list-item;
}
.chosen-container .chosen-results-scroll {
  background: white;
  margin: 0 4px;
  position: absolute;
  text-align: center;
  width: 321px;
  z-index: 1;
}
.chosen-container .chosen-results-scroll span {
  display: inline-block;
  height: 1.42857143;
  text-indent: -5000px;
  width: 9px;
}
.chosen-container .chosen-results-scroll-down {
  bottom: 0;
}
.chosen-container .chosen-results-scroll-down span {
  background: url("chosen-sprite.png") no-repeat -4px -3px;
}
.chosen-container .chosen-results-scroll-up span {
  background: url("chosen-sprite.png") no-repeat -22px -3px;
}
.chosen-container-single .chosen-single {
  background-color: #ffffff;
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  border: 1px solid #cccccc;
  border-top-right-radius: 4px;
  border-top-left-radius: 4px;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  color: #555555;
  display: block;
  height: 34px;
  overflow: hidden;
  line-height: 34px;
  padding: 0 0 0 8px;
  position: relative;
  text-decoration: none;
  white-space: nowrap;
}
.chosen-container-single .chosen-single span {
  display: block;
  margin-right: 26px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.chosen-container-single .chosen-single abbr {
  background: url("chosen-sprite.png") right top no-repeat;
  display: block;
  font-size: 1px;
  height: 10px;
  position: absolute;
  right: 26px;
  top: 12px;
  width: 12px;
}
.chosen-container-single .chosen-single abbr:hover {
  background-position: right -11px;
}
.chosen-container-single .chosen-single.chosen-disabled .chosen-single abbr:hover {
  background-position: right 2px;
}
.chosen-container-single .chosen-single div {
  display: block;
  height: 100%;
  position: absolute;
  top: 0;
  right: 0;
  width: 18px;
}
.chosen-container-single .chosen-single div b {
  background: url("chosen-sprite.png") no-repeat 0 7px;
  display: block;
  height: 100%;
  width: 100%;
}
.chosen-container-single .chosen-default {
  color: #777777;
}
.chosen-container-single .chosen-search {
  margin: 0;
  padding: 3px 4px;
  position: relative;
  white-space: nowrap;
  z-index: 1000;
}
.chosen-container-single .chosen-search input[type="text"] {
  background: url("chosen-sprite.png") no-repeat 100% -20px, #ffffff;
  border: 1px solid #cccccc;
  border-top-right-radius: 4px;
  border-top-left-radius: 4px;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  margin: 1px 0;
  padding: 4px 20px 4px 4px;
  width: 100%;
}
.chosen-container-single .chosen-drop {
  margin-top: -1px;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
}
.chosen-container-single-nosearch .chosen-search input {
  position: absolute;
  left: -9000px;
}
.chosen-container-multi .chosen-choices {
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border-top-right-radius: 4px;
  border-top-left-radius: 4px;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  cursor: text;
  height: auto !important;
  height: 1%;
  margin: 0;
  overflow: hidden;
  padding: 0;
  position: relative;
}
.chosen-container-multi .chosen-choices li {
  float: left;
  list-style: none;
}
.chosen-container-multi .chosen-choices .search-field {
  margin: 0;
  padding: 0;
  white-space: nowrap;
}
.chosen-container-multi .chosen-choices .search-field input[type="text"] {
  background: transparent !important;
  border: 0 !important;
  -webkit-box-shadow: none;
  box-shadow: none;
  color: #555555;
  height: 32px;
  margin: 0;
  padding: 4px;
  outline: 0;
}
.chosen-container-multi .chosen-choices .search-field .default {
  color: #999;
}
.chosen-container-multi .chosen-choices .search-choice {
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  background-color: #eeeeee;
  border: 1px solid #cccccc;
  border-top-right-radius: 4px;
  border-top-left-radius: 4px;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
  background-image: -webkit-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
  background-image: -o-linear-gradient(top, #ffffff 0%, #eeeeee 100%);
  background-image: linear-gradient(to bottom, #ffffff 0%, #eeeeee 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffeeeeee', GradientType=0);
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  color: #333333;
  cursor: default;
  line-height: 13px;
  margin: 6px 0 3px 5px;
  padding: 3px 20px 3px 5px;
  position: relative;
}
.chosen-container-multi .chosen-choices .search-choice .search-choice-close {
  background: url("chosen-sprite.png") right top no-repeat;
  display: block;
  font-size: 1px;
  height: 10px;
  position: absolute;
  right: 4px;
  top: 5px;
  width: 12px;
  cursor: pointer;
}
.chosen-container-multi .chosen-choices .search-choice .search-choice-close:hover {
  background-position: right -11px;
}
.chosen-container-multi .chosen-choices .search-choice-focus {
  background: #d4d4d4;
}
.chosen-container-multi .chosen-choices .search-choice-focus .search-choice-close {
  background-position: right -11px;
}
.chosen-container-multi .chosen-results {
  margin: 0 0 0 0;
  padding: 0;
}
.chosen-container-multi .chosen-drop .result-selected {
  display: none;
}
.chosen-container-active .chosen-single {
  border: 1px solid #66afe9;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
  box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
  -webkit-transition: border linear .2s, box-shadow linear .2s;
  -o-transition: border linear .2s, box-shadow linear .2s;
  transition: border linear .2s, box-shadow linear .2s;
}
.chosen-container-active.chosen-with-drop .chosen-single {
  background-color: #ffffff;
  border: 1px solid #66afe9;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
  box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
  -webkit-transition: border linear .2s, box-shadow linear .2s;
  -o-transition: border linear .2s, box-shadow linear .2s;
  transition: border linear .2s, box-shadow linear .2s;
}
.chosen-container-active.chosen-with-drop .chosen-single div {
  background: transparent;
  border-left: none;
}
.chosen-container-active.chosen-with-drop .chosen-single div b {
  background-position: -18px 7px;
}
.chosen-container-active .chosen-choices {
  border: 1px solid #66afe9;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
  box-shadow: 0 1px 1px rgba(0, 0, 0, .075) inset, 0 0 8px rgba(82, 168, 236, .6);
  -webkit-transition: border linear .2s, box-shadow linear .2s;
  -o-transition: border linear .2s, box-shadow linear .2s;
  transition: border linear .2s, box-shadow linear .2s;
}
.chosen-container-active .chosen-choices .search-field input[type="text"] {
  color: #111 !important;
}
.chosen-container-active.chosen-with-drop .chosen-choices {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.chosen-disabled {
  cursor: default;
  opacity: 0.5 !important;
}
.chosen-disabled .chosen-single {
  cursor: default;
}
.chosen-disabled .chosen-choices .search-choice .search-choice-close {
  cursor: default;
}
.chosen-rtl {
  text-align: right;
}
.chosen-rtl .chosen-single {
  padding: 0 8px 0 0;
  overflow: visible;
}
.chosen-rtl .chosen-single span {
  margin-left: 26px;
  margin-right: 0;
  direction: rtl;
}
.chosen-rtl .chosen-single div {
  left: 7px;
  right: auto;
}
.chosen-rtl .chosen-single abbr {
  left: 26px;
  right: auto;
}
.chosen-rtl .chosen-choices .search-field input[type="text"] {
  direction: rtl;
}
.chosen-rtl .chosen-choices li {
  float: right;
}
.chosen-rtl .chosen-choices .search-choice {
  margin: 6px 5px 3px 0;
  padding: 3px 5px 3px 19px;
}
.chosen-rtl .chosen-choices .search-choice .search-choice-close {
  background-position: right top;
  left: 4px;
  right: auto;
}
.chosen-rtl.chosen-container-single .chosen-results {
  margin: 0 0 4px 4px;
  padding: 0 4px 0 0;
}
.chosen-rtl .chosen-results .group-option {
  padding-left: 0;
  padding-right: 15px;
}
.chosen-rtl.chosen-container-active.chosen-with-drop .chosen-single div {
  border-right: none;
}
.chosen-rtl .chosen-search input[type="text"] {
  background: url("chosen-sprite.png") no-repeat -28px -20px, #ffffff;
  direction: rtl;
  padding: 4px 5px 4px 20px;
}
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-resolution: 144dpi) {
  .chosen-rtl .chosen-search input[type="text"],
  .chosen-container-single .chosen-single abbr,
  .chosen-container-single .chosen-single div b,
  .chosen-container-single .chosen-search input[type="text"],
  .chosen-container-multi .chosen-choices .search-choice .search-choice-close,
  .chosen-container .chosen-results-scroll-down span,
  .chosen-container .chosen-results-scroll-up span {
    background-image: url("chosen-sprite@2x.png") !important;
    background-size: 52px 37px !important;
    background-repeat: no-repeat !important;
  }
}
</style>
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
            <h1 class="h3 mb-0 text-gray-800">Add Purchase Order</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>
		<?php
		if(!empty($this->session->flashdata('message')))
		{
		if($this->session->flashdata('message')=="Purchase Order Successfully." || $this->session->flashdata('message')=="Purchase Order Updated Successfully." || $this->session->flashdata('message')=="Purchase Order List Updated Successfully.")
		{
		?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php 
		} 
		else
		{
        ?>
          <div align="center" class="alert alert-danger">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php 
        } 
        }
        ?>

<div class="card position-relative">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
                </div>
                <div class="card-body">
                  <div class="row">
		  <form action="<?php echo site_url(); ?>PurchaseOrder/add_purchase_order" class="col-sm-12" method="POST" >
                <div class="form-group row">
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtOrderNumber" name="txtOrderNumber" placeholder="Order Number" autocomplete="off" >
                  </div>
                  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="datepicker" name="txtOrderDate" placeholder="Order Date" autocomplete="off" readonly>
                  </div>
                </div>
                <div class="form-group row">
					<div class="col-lg-12">
                    <textarea type="text" class="form-control form-control-user" id="txtAddress" name="txtAddress" placeholder="Address" autocomplete="off" ></textarea>
                  </div>
                </div>
				<br /><br />
                <div class="form-group row">
				<div class="col-sm-4">  
            <select name="txtStockName" id="txtStockName" class="form-control dropbox chosen-select">
            <option value="">Select Stock Name</option>
            <?php if($stockNameData['flag']){
            foreach ($stockNameData['stockNameData'] as $value) { ?>
            <option  value="<?php echo $value['id'] ; ?>"><?php echo $value['stock_name'] ; ?> - [<?php echo $value['stock_type'] ; ?>]</option>
            <?php } } ?>
            </select>
            </div>
				  <div class="col-lg-4">
                    <input type="number" class="form-control form-control-user" id="txtQuantity"  name="txtQuantity" placeholder="Quantity Required">
                  </div>
				  <div class="col-lg-4">
                    <input type="text" class="form-control form-control-user" id="txtRequiredFor" name="txtRequiredFor" placeholder="Required For">
                  </div>
                  </div>
                <div class="form-group row">
				  <div class="col-lg-6">
                    <input type="text" class="form-control form-control-user" id="txtStoreStock" name="txtStoreStock" placeholder="Store Stock Page No. and Stock">
                  </div>
				  <div class="col-lg-6">
                    <textarea type="text" class="form-control form-control-user" id="txtRemark" name="txtRemark" placeholder="Remark"></textarea>
                  </div>
                </div>
                <div class="form-group row">
					<div class="col-sm-2"> <br />
					<input type="button" value="+ Add more item(s)" id="purchase_details" class="form-control btn btn-secondary" />
					</div>
                </div>
				
				<br />
           <table id="table" name="table" class="table table-striped table-bordered table-hover" ><!--style="display:hide()"-->
                      <thead>
                        <tr>
                          <th>Stock Name</th>
						   <th>Quantity</th>
                           <th>Required For</th>
                           <th>Store Stock Page No. and Stock</th>
                           <th>Remark</th>
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
                        <br  />
                        <label class="text-danger" style="font-size:18px">Click the "Add more item(s)" Button</label>
                      </div>
					  
					<div class="col-lg-12">
                    <button type="submit" name="submit" id="AddPurchase" class="btn btn-success btn-user btn-block">Create Purchase Order</button>
					</div>
                    </div>
					
                
              </form>
		  </div>
                </div>
              </div>
			  
			  
          <!-- Content Row -->
        
  
                
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
		$("#table").hide(); 
		$("#AddPurchase").hide(); 
});

$(document).ready(function(){
	 
 
	$("#purchase_details").click(function(){
		$("#table").show(); 
		$("#table").append('<tr valign="top"><td><input type="hidden" name="txtStockName[]" id="txtStockName_j" value="'+$("#txtStockName").val()+'" />'+$('#txtStockName option:selected').text()+'</td><td><input type="hidden" name="txtQuantity[]" value="'+$("#txtQuantity").val()+'" />'+$("#txtQuantity").val()+'</td><td><input type="hidden" name="txtRequiredFor[]" value="'+$("#txtRequiredFor").val()+'" />'+$("#txtRequiredFor").val()+'</td><td><input type="hidden" name="txtStoreStock[]" value="'+$("#txtStoreStock").val()+'" />'+$("#txtStoreStock").val()+'</td><td ><input type="hidden" name="txtRemark[]" value="'+$("#txtRemark").val()+'" />'+$("#txtRemark").val()+'</td><td  class="text-danger"><a href="javascript:void(0);" class="text-danger remCF">Remove</a></td></tr>');
	
		btnCheck();
		$('#txtStockName').val('');
		$('#txtQuantity').val('');
		$('#txtRequiredFor').val('');
		$('#txtStoreStock').val('');
		$('#txtRemark').val('');
		
	});
        
    $("#table").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});

 function btnCheck(){
if(!$('#txtStockName').val()){
    $('#AddPurchase').hide();
	$('#notice_alert').show();
}
else {
    $('#AddPurchase').show();
	$('#notice_alert').hide();
}
};
</script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <script>
      $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
      });
    </script>
</body>

</html>
