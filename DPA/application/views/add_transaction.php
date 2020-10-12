<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add Transaction | Mercure DPA</title>
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
            
           <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Transaction</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="<?php echo base_url(); ?>Transactions/add_transaction">
                                
                                 <div class="row clearfix">
                                     
                                <div class="col-md-2">
                                    
                                           <style>
                                                .open{overflow:visible !important;height:25px;max-width:500px;}
                                            </style>
                                            
										<label class="form-label">City</label>
                                  
                                </div>
                                <div class="col-md-4">
                                    
                                        
                                        
                                            <style>
                                                .open{overflow:visible !important;height:25px;}
                                            </style>
                                           
										<select class="form-control" data-live-search="true" name="city" id="city" autocomplete="off">
									                <option value="">-- Select City --</option>
                                                    <?php 
                                                    $statecity=$this->Masters_model->state_city();
                                                        //print_r($productcode);
                                                    $i=1;
                                                    if($statecity['flag']==1)  {
                                                    foreach($statecity['statecity'] as $value){
                                                    ?>                               
								                    <option value="<?php echo $value['id'];?>"><?php echo $value['city'];?></option>
                                                    <?php } } ?>
                                    </select>
                                
                                </div>
                                <div class="col-md-2">
                                    
                                        <label class="form-label">Address</label>
                                            
                                </div>
                                <div class="col-md-4">
                                           <input type="text" class="form-control form-line" name="address" id="address" readonly>
                                           <input type="hidden" class="form-control form-line" name="email" id="email">
                                </div>
                               </div>
                               
                               <div class="row clearfix">
                                     
                                <div class="col-md-2">
                                    
                                           <style>
                                                .open{overflow:visible !important;height:25px;max-width:500px;}
                                            </style>
                                            
									<label class="form-label">Party Name</label>
                                  
                                </div>
                                <div class="col-md-4">
                                            <style>
                                                .open{overflow:visible !important;height:25px;}
                                            </style>
                                           
										 <select class="form-control" data-live-search="true" name="party" id="party">
									        <option value="">-- Select Party --</option>
                                            <?php 
                                                $partylist=$this->Masters_model->get_party_list();
                                                $j=1;
                                                if($partylist['flag']==1)  {
                                                foreach($partylist['partylist'] as $val){
                                            ?>                               
								            <option value="<?php echo $val['data_party_id'];?>"><?php echo $val['company_product_code'];?> - <?php echo $val['ParNam'];?></option>
                                            <?php } } ?>
                                    </select>
                                
                                </div>
                                <div class="col-md-2">
                                    
                                        <label class="form-label">Contact Person</label>
                                            
                                </div>
                                <div class="col-md-4">
                                           <input type="text" class="form-control form-line" name="contact_p" id="contact_p" readonly>
                                </div>
                               </div>
                               
                               
                               <div class="row clearfix">
                                     
                                <div class="col-md-2">
                                    
                                            
									<label class="form-label">Payment Terms</label>
                                  
                                </div>
                                <div class="col-md-4">
                                            <select class="form-control" data-live-search="true" name="payment" id="payment">
									<option value="">-- Select Payment Terms --</option>
                                                    <?php 
                                                    $creditslab_list=$this->Purchase_model->get_credit_slabs();
                                                        //print_r($productcode);
                                                    $i=1;
                                                    if($creditslab_list['flag']==1)  {
                                                    foreach($creditslab_list['creditslab_list'] as $value){
                                                    ?>                               
								                    <option><?php echo $value['credit_payment_title'];?></option>
                                                    <?php } } ?>
									</select>
                                </div>
                                <div class="col-md-2">
                                    
                                        <label class="form-label">Whatsapp No</label>
                                            
                                </div>
                                <div class="col-md-4">
                                     <input type="text" class="form-control form-line" name="wa_no" id="wa_no" readonly>
                                </div>
                               </div>
                               
                               
								
							
								<div class="row clearfix">
                                <div class="col-md-2">
                                    
                                        <label class="form-label">Freight</label>
                                     
                                </div>
                                <div class="col-md-4">
                                            <select class="form-control" data-live-search="true" name="freight_option" id="freight_option">
									<option value="">-- Select Freight --</option>
									<option>To Pay</option>
									<option>Paid</option>
									</select>
									<input type="number" class="form-control form-line" name="freight" id="freight" placeholder="Freight" />
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Landline No</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-line" name="ll_no" id="ll_no" readonly>
                                   
                                </div>
                            </div>
                            <br />
                            <h4>Add Products</h4>
                             <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered table-hover" id="tab_logic2">
                <thead>
                    <tr >
                        <th class="text-center" style="width:300px">
                            Product Name
                        </th>
                        <th class="text-center">
                            Company
                        </th>
                        <th class="text-center">
                            Packing
                        </th>
                        <th class="text-center">
                            MRP
                        </th>
                        <th class="text-center">
                            Quantity
                        </th>
                        <th class="text-center">
                            Rate
                        </th>
                        <th class="text-center">
                            Price
                        </th>
                        <th class="text-center">
                            Tax (in %)
                        </th>
                        <th class="text-center">
                            Amount
                        </th>
                        <th class="text-center">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='addr0'>
                        
                        <td>
                        <select class="form-control" data-live-search="true" name="product" id="product">
									        <option value=""></option>
                                            <?php 
                                                $productcode=$this->Masters_model->get_product_code();
                                                $j=1;
                                                if($productcode['flag']==1)  {
                                                foreach($productcode['productcode'] as $val){
                                            ?>                               
								            <option value="<?php echo $val['data_product_id'];?>"><?php echo $val['Code'];?> - <?php echo $val['Name'];?></option>
                                            <?php } } ?>
                                    </select>
                        </td>
                        <td>
                        <input type="text" name='company' id='company' placeholder='Company Name' class="form-control" readonly />
                        </td>
                        <td>
                        <input type="text" name='packing' id='packing' placeholder='Packing' class="form-control" readonly />
                        </td>
                        <td>
                        <input type="text" name='mrp' id='mrp' placeholder='MRP' class="form-control" readonly />
                        </td>
                        <td>
                        <input type="text" name='quantity' id='quantity' placeholder='Quantity' class="form-control"/>
                        </td>
                        <td>
                        <input type="text" name='rate' id='rate' placeholder='Rate' class="form-control" readonly />
                        </td>
                        <td>
                        <input type="text" name='price' id='price' placeholder='Price' class="form-control txt" readonly />
                        </td>
                        <td>
                        <input type="text" name='tax' id='tax' placeholder='Tax' class="form-control" readonly />
                        </td>
                        <td>
                        <input type="text" name='amount' id='amount' placeholder='Amount' class="form-control tamount" readonly />
                        </td>
                        <td>
                            <a id='butsend' class="pull-right btn btn-danger" onClick="calculateSum()">+ Add</a>
                        </td>
                    </tr>
                    <tr id='addr1'></tr>
                </tbody>
            </table>
            
        </div>
         
    </div>
                            <p class="btn btn-warning col-lg-12">&nbsp;Products List</p>
                            <br />
                           
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                    <tr >
                        <th class="text-center">
                            #
                        </th>
                        <th class="text-center" style="width:300px">
                            Product Name
                        </th>
                        <th class="text-center">
                            Company
                        </th>
                        <th class="text-center">
                            Packing
                        </th>
                        <th class="text-center">
                            MRP
                        </th>
                        <th class="text-center">
                            Quantity
                        </th>
                        <th class="text-center">
                            Rate
                        </th>
                        <th class="text-center">
                            Price
                        </th>
                        <th class="text-center">
                            Tax
                        </th>
                        <th class="text-center">
                            Amount
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
   

<h4></h4>
<div class="row clearfix">
                                     
                                <div class="col-md-2">
                                    
										<label class="form-label"></label>
                                  
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" class="form-control form-line" name="account_holder" id="account_holder" />
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2 form-control-label">
                                    <label class="form-label">Taxable Amount</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-line" name="taxable_amount" id="taxable_amount" readonly>
                                   
                                </div>
                               </div>
                               
                               <div class="row clearfix">
                                     <div class="col-md-2">
                                    
                                        <label class="form-label"></label>
                                            
                                </div>
                                <div class="col-md-4">
                                           <input type="hidden" class="form-control form-line" name="bank_name" id="bank_name2" />
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2 form-control-label">
                                    
                                        <label class="form-label">GST</label>
                                            
                                </div>
                                <div class="col-md-3">
                                     <input type="text" class="form-control form-line" name="total_gst" id="total_gst" readonly>
                                </div>
                               </div>
                               
                               
                               <div class="row clearfix">
                                     
                                <div class="col-md-2">
                                    
                                        <label class="form-label"></label>
                                            
                                </div>
                                <div class="col-md-4">
                                           <input type="hidden" class="form-control form-line" name="account_no" id="account_no" />
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2 form-control-label">
                                    
                                        <label class="form-label">Final Amount</label>
                                            
                                </div>
                                <div class="col-md-3">
                                     <input type="text" class="form-control form-line" name="final_amnt" id="final_amnt" readonly/>
                                </div>
                               </div>
                               
                               
								
							
								<div class="row clearfix">
								    <div class="col-md-2">
                                    	<label class="form-label"></label>
                                  
                                </div>
                                <div class="col-md-4">
                                        <input type="hidden" class="form-control form-line" name="bank_name" id="bank_name" />
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2 form-control-label">
                                    
                                        <label class="form-label">Freight (if any)</label>
                                     
                                </div>
                                <div class="col-md-3">
                                            <input type="text" class="form-control form-line" name="freight_extra" id="freight_extra" readonly />
                                </div>
                                
                            </div>
                            
                            <br />
                            <br />
                            <div class="row clearfix">
								    <div class="col-md-2">
                                    	<label class="form-label">Payment Method</label>
                                  
                                </div>
                                <div class="col-md-4">
                                        <select class="form-control" name="payment_method">
									<option value="">-- Select Payment Method --</option>
									<option>Cash</option>
									<option>Credit</option>
									<option>Net Banking</option>
									<option>Cheque</option>
									</select>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2 form-control-label">
                                    
                                        <label class="form-label">Additional (if any)</label>
                                     
                                </div>
                                <div class="col-md-3">
                                            <input type="text" class="form-control form-line" name="addi_cost" id="addi_cost" value="0" />
                                </div>
                                
                            </div>
                            <div class="row clearfix">
								    <div class="col-md-2">
                                    	<label class="form-label">Remark</label>
                                  
                                </div>
                                <div class="col-md-4">
                                        <input type="text" class="form-control form-line" name="remark" id="remark" />
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2 form-control-label">
                                    
                                        <label class="form-label">Total Due</label>
                                     
                                </div>
                                <div class="col-md-3">
                                            <input type="text" class="form-control form-line" name="total_due" id="total_due" readonly />
                                </div>
                                
                            </div>
                            
                            <br /><br />
                                <button class="btn btn-success col-md-12" type="submit" id="btnaddtranx">ADD TRANSACTION</button>
                                <br /><br /><br />
                            </form>
                          
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            </div>
        </div>
    </section>
  <?php include_once("include/footerjs.php"); ?>
  <script>
      $(document).ready(function(){
	 $("#btnaddtranx").hide();
    var tid=1;
 
	$("#butsend").click(function(){
		$("#tab_logic").show(); 
		$("#tab_logic").append('<tr valign="top"><td width="80px" align="center">'+(tid++)+'</td><td width="100px" align="center"><input type="text" name="product[]" value="'+$("#product").val()+'" />'+$("#product option:selected").text()+'</td><td width="100px" align="center"><input type="hidden" name="company[]" value="'+$("#company").val()+'" />'+$("#company").val()+'</td><td width="100px" align="center"><input type="hidden" name="packing[]" value="'+$("#packing").val()+'" />'+$("#packing").val()+'</td><td width="100px" align="center"><input type="hidden" name="mrp[]" value="'+$("#mrp").val()+'" />'+$("#mrp").val()+'</td><td width="100px" align="center"><input type="hidden" name="quantity[]" value="'+$("#quantity").val()+'" />'+$("#quantity").val()+'</td><td width="100px" align="center"><input type="hidden" name="rate[]" value="'+$("#rate").val()+'" />'+$("#rate").val()+'</td><td width="100px" align="center"><input type="hidden" name="price[]" class="txt" value="'+$("#price").val()+'" />'+$("#price").val()+'</td><td width="100px" align="center"><input type="hidden" name="tax[]" value="'+$("#tax").val()+'%" />'+$("#tax").val()+'</td><td width="100px" align="center"><input type="hidden" class="tamount" name="amount[]" value="'+$("#amount").val()+'" />'+$("#amount").val()+'</td><td width="100px" class="text-danger" align="center"><a href="javascript:void(0);" class="text-danger remCF">Remove</a></td></tr>');
		$('#company').val('');
		$('#packing').val('');
		$('#mrp').val('');
		$('#quantity').val('');
		$('#rate').val('');
		$('#price').val('');
		$('#tax').val('');
		$('#amount').val('');
		$("#btnaddtranx").show();
	});
        
    $("#tab_logic").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});

  </script>
	<script type="text/javascript">
$(document).ready(function(){
 $('#party').change(function(){
   var party_id = $('#party').val();
  if(party_id != '')
  {
   $.ajax({
    url:"<?php echo site_url(); ?>Transactions/get_details_by_party",
     dataType:"json",
    method:"POST",
    data:{party_id:party_id},
    success:function(response)
    {
    	$("#address").val(response['party_list_byid'][0]['ParAdd1']);
    	$("#contact_p").val(response['party_list_byid'][0]['ParNam']);
    	$("#wa_no").val(response['party_list_byid'][0]['Phone1']);
    	$("#ll_no").val(response['party_list_byid'][0]['Phone2']);
    	$("#email").val(response['party_list_byid'][0]['email']);
    }
   })
  }
  else
  {
   $('#address').html('No Data');
  }
 });
});

</script>
<script type="text/javascript">
$(document).ready(function(){
 $('#product').change(function(){
   var product_id = $('#product').val();
  if(product_id != '')
  {
   $.ajax({
    url:"<?php echo site_url(); ?>Transactions/get_products_by_id",
     dataType:"json",
    method:"POST",
    data:{product_id:product_id},
    success:function(response)
    {
        //alert(response);
    	$("#company").val(response['product_byid'][0]['com_name']);
    	$("#packing").val(response['product_byid'][0]['packing']);
    	$("#mrp").val(response['product_byid'][0]['MRP']);
    	$("#tax").val(response['product_byid'][0]['GST']);
    	$("#rate").val(response['product_byid'][0]['purchase_rate']);
    	$("#freight_extra").val(response['product_byid'][0]['freight_charges']);
    }
   })
  }
  else
  {
   $('#address').html('No Data');
  }
 });
});

$(document).ready(function(){
    
 $("#quantity").on("keyup", function(){
    // alert("Hello");
    var city_id = $('#city').val();
   var product_id = $('#product').val();
   var payment = $('#payment').val();
   var freight = $('#freight').val();
   var quantity = $('#quantity').val();
   var party = $('#party').val();
   var rate = $('#rate').val();
   //alert(city_id);
   //alert(product_id);
   //alert(payment);
   //alert(freight);
   //alert(quantity);
   //alert(party);
   
  if(product_id != '')
  {
   $.ajax({
    url:"<?php echo site_url(); ?>Transactions/manage_discounts",
     dataType:"json",
    method:"POST",
    data:{city:city_id,product:product_id,payment:payment,freight:freight,quantity:quantity,party:party,rate:rate},
    success:function(response)
    {
       // alert(response);
    	$("#price").val(response);
    	//$("#packing").val(response['product_byid'][0]['packing']);
    	//$("#mrp").val(response['product_byid'][0]['MRP']);
    	//$("#tax").val(response['product_byid'][0]['gst']);
    //	$("#calculated_price").val(val1 * val2);
  var val3 = response;
  var val4 = $("#tax").val();
  //alert(val1);
  //alert(val2);
  var amount = (val3 * val4/100).toFixed(2);
  var total = (parseFloat(amount) + parseFloat(val3)).toFixed(2);
  $("#amount").val(total);
    }
   })
  }
  else
  {
   $('#address').html('No Data');
  }
 });
});

/*$("#rate").on("keyup", function(){
  var val1 = $("#quantity").val();
  var val2 = $("#rate").val();
  //alert(val1);
  //alert(val2);
  $("#price").val(val1 * val2);
  var val3 = $("#price").val();
  var val4 = $("#tax").val();
  //alert(val1);
  //alert(val2);
  var amount = val3 * val4/100;
  var total = parseFloat(amount) + parseFloat(val3);
  $("#amount").val(total);
 
})*/

//$("#tax").on("keyup", function(){
  // calculateSum();
//})
</script>

<script>
  
function calculateSum() {
    var sum = 0;
    //iterate through each textboxes and add the values
    $(".txt").each(function () {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }

    });
    //alert(sum);
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#taxable_amount").val(sum.toFixed(2));
    calculateSum2();
    
  var final_amnt = $("#final_amnt").val();
  var taxable_amount = $("#taxable_amount").val();
  var total_gst = (parseFloat(final_amnt) - parseFloat(taxable_amount)).toFixed(2);
  $("#total_gst").val(total_gst);
  var freight_extra = $("#freight_extra").val();
  var addi_cost = $("#addi_cost").val();
  var total_due = (parseFloat(freight_extra) + parseFloat(addi_cost) + parseFloat(final_amnt)).toFixed(2);
  $("#total_due").val(total_due);
}

function calculateSum2() {
    var sum2 = 0;
    //iterate through each textboxes and add the values
    $(".tamount").each(function () {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum2 += parseFloat(this.value);
        }

    });
    //alert(sum2);
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#final_amnt").val(sum2.toFixed(2));
    
    
}

//$(".addRow").on("click", addRow);

$("#butsend").on("click", ".txt", function () {
    calculateSum();
});

</script>
<script>
$(function() {
    $('#freight').hide(); 
    $('#freight_option').change(function(){
        if($('#freight_option').val() == 'To Pay') {
            $('#freight').show(); 
        } else {
            $('#freight').hide(); 
        } 
    });
});
</script>
</body>
</html>