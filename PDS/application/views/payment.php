<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Payment Process | Konnectin</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <?php include_once('include/headerlinks.php'); ?>
</head>

<body class="theme-cyan">
<?php include_once('include/header.php'); ?>
    <section class="">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    
                </h2>
            </div>
            <br />
            <?php include_once('include/counters.php'); ?>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    
                    <div class="card">
                        <div class="header">
                            <h2 style="float:left">
                               Categories
                            </h2>
                            
                        </div>
                        <div class="body">
                                
                            <ul>
                                                <li>Arts</li>
                                                <li>History</li>
                                                <li>Languages and literature</li>
                                                <li>Law</li>
                                                <li>Philosophy</li>
                                                <li>Theology</li>
                                                <li>Anthropology</li>
                                                <li>Archaeology</li>
                                                <li>Economics</li>
                                                <li>Human geography</li>
                                                <li>Political science</li>
                                                <li>Psychology</li>
                                                <li>Sociology</li>
                                                <li>Social Work</li>
                                                <li>Biology</li>
                                                <li>Chemistry</li>
                                                <li>Earth science</li>
                                                <li>Space sciences</li>
                                                <li>Physics</li>
                                                <li>Computer Science</li>
                                                <li>Mathematics</li>
                                                <li>Statistics</li>
                                                <li>Business</li>
                                                <li>Engineering and technology</li>
                                                <li>Medicine and health</li>
                              </ul>  
                            
                        </div>
                    </div>
                </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="header bg-default" style="line-height:50px">
                            <h3 class="text-primary">Contribution (Step - 3/3)</h3>
                            
                        </div>
                        <div class="body">
                            <?php //echo $_SESSION['user_id']; ?>
                            <?php //echo $_SESSION['b_id']; ?>
    <form action="<?php echo site_url();?>Paytm/paytmpost" enctype="multipart/form-data" method="POST" name="Branch" id="popup-validation">
    <div class="col-lg-12">
        <div id="response"></div>

<div class="form-group row" id="div_Responses">
    <div class="col-md-4" style="margin-top: 10px;"><label class="form-label">Required Responses :</label></div>
<div class="col-md-8">
     <div class="form-line">    <input type="hidden" id="s_id" name="s_id" value="<?php echo $s_id = $this->uri->segment(3); ?>" />
                                            <input name="end_response" type="number" class="form-control validate[required]" id="end_response" required />
											
                                        </div>
                                    
                                </div>
</div>
<div class="form-group row" id="div_Responses">
    <div class="col-md-4" style="margin-top: 10px;"><label class="form-label">Contribution :</label></div>
<div class="col-md-8">
     <div class="form-line">
         <input type="radio" name="contribution" id="reward" class="cont" checked="checked" value="Monetary Contribution" rel="b0" /><label for="reward">By Monetary Reward System (recommended <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Money is an effective motivator for improving responses">Why?</a>)</label>
										<br />	
         <input type="radio" name="contribution" id="mutual" class="cont" value="Mutual Contribution" rel="b1" /><label for="mutual">By Mutual Contribution</label>
                                            
                                        </div>
                                    
                                </div>
</div>

<div class="form-group row" id="div_Amount">
    <div class="col-md-4" style="margin-top: 10px;"><label class="form-label">Due Amount :</label></div>
<div class="col-md-8">
     <div class="form-line">
         <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "KONN" . rand(10000,99999999)?>">
					<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001">
				<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
				<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
					<input type="hidden" title="CALLBACK_URL" type="text" name="CALLBACK_URL" value="https://konnectin.in/Surveys/Paytm/response">
                                            <input type="text" name="TXN_AMOUNT" type="number" class="form-control validate[required]" id="TXN_AMOUNT" readonly required />
											<input type="hidden" name="sur_id" type="number" class="form-control validate[required]" id="sur_id" value="<?php echo $sur_id= $this->uri->segment(3)?>" />
                                        </div>
                                    
                                </div>
</div>

</div>
    <div class="form-group row">
    <div class="col-lg-4"></div>
    <div class="col-lg-6">
        <input type="submit" name="btnPayment" id="btnPayment" value="Make Payment" class="btn btn-success" /> 
        <input type="button" name="btnApproval" id="btnApproval" value="Submit for Approval" class="btn btn-success" />
        <br />
        
    </div>
    </div>
    </form>
                            
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
            <!-- #END# Exportable Table -->
            </div>
        </div>
    </section>

    <?php include_once("include/footerjs.php"); ?>

 <script>
$(document).ready(function(){
    $("#btnApproval").hide();
    $('.cont').click(function(){
    var id = $(this).attr("rel");
    //alert(id);
    //$('#'+id).slideToggle('slow');
    if(id === "b1"){
   $("#div_Amount").hide();
   $("#btnPayment").hide();
   $("#btnApproval").show();
    }else{
        $("#div_Amount").show();
        $("#btnPayment").show();
        $("#btnApproval").hide();
    }
    
    });
    
$('#survey_filters').toggle();
    $('#tuna').click(function(){
        $('#survey_filters').toggle();
        //$('#tuna').val('i dont know how this works');
        });
});

$(document).ready(function(){
 $('#end_response').keyup(function(){
   var a = document.getElementById("end_response").value;
   //var b = document.getElementById("txtIssueQuantity").value;
   document.getElementById("TXN_AMOUNT").value=a*6;
 });
});
 </script>
 <script>
     $(document).ready(function(){
    
 $("#btnApproval").on("click", function(){
     $('#response').html('');
     //alert("Hello");
    //var city_id = $('#city').val();
   var end_response = $('#end_response').val();
   var s_id = $('#s_id').val();
   
  if(end_response > '0')
  {
   $.ajax({
    url:"<?php echo site_url(); ?>Survey/submit_for_approval",
     //dataType:"json",
    method:"POST",
    data:{end_response:end_response,s_id:s_id},
    
    success:function(response)
    {
        //alert(response);
    	$('#response').html('<br /><div class="alert bg-green alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Successfully Submitted for Admin Approval!</div>');
  
    }
   })
  }
  else
  {
   $('#response').html('<br /><div class="alert bg-pink alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Required Responses are mandatory!</div>');
  }
 });
});
 </script>
 <script src="<?php echo base_url(); ?>assets/js/pages/ui/tooltips-popovers.js"></script>
</body>

</html>