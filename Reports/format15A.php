<?php require_once('../Connections/dbconnect-m.php'); 
if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>P-15A | File Tracking & Crime Analysis Application </title>
<!-- GLOBAL STYLES -->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/css/main.css" />
<link rel="stylesheet" href="../assets/css/theme.css" />
<link rel="stylesheet" href="../assets/css/MoneAdmin.css" />
<link rel="stylesheet" href="../assets/plugins/Font-Awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="../assets/css/autocom.css" />
<!--END GLOBAL STYLES -->

<!-- PAGE LEVEL STYLES -->
<link href="../assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/plugins/datepicker/css/datepicker.css" />
<link rel="stylesheet" href="../assets/plugins/validationengine/css/validationEngine.jquery.css" />
<!-- END PAGE LEVEL  STYLES -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<style media='all'>
body {
	font-size:12px;
}
.notice_all {
	min-height:600px;
	width:900px;
	margin:0 auto;
	/*border:dotted 1px #666;*/
	position:relative;
}
#print tr td {
	vertical-align:top
}
</style>
<style media='print'>
.navStuff {
	display: none
}
.mar10 {
	margin-top:-10px
}
</style>
</head>

<body style="background:#FFF">
<div align='right' class='navStuff container'>
    <form action="exporttoexcel.php" method="post" 
onsubmit='$("#datatodisplay").val( $("<div>").append( $("#download").eq(0).clone() ).html() )'>  
<p align="" class="hprtbtn">
<span style="float:right;margin-right:-25px"> <input type="hidden" id="datatodisplay" name="datatodisplay" style="" /> <input type="submit" value="Export to Excel" class="btn btn-warning"/>
  <input type='button' value='Print this page' onClick='window.print()' class="btn btn-warning">   </span></p></form>
 </div>
 <div class="row">
    <div class="col-lg-12 label-primary" style="color:#FFF">
      <form action="format15A.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">    
        <div class="col-lg-12 navStuff">  &nbsp; 
         <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datef']) ? $_POST['datef'] : '' ?>" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datel']) ? $_POST['datel'] : '' ?>" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

          <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:none;width:220px;">
          <option value="0"></option>
          </select>
                      
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-success" id="mybutton" name="Search" style="display:inline-block">Search</button>
        </div>
      </form>
    </div>
  </div>
<div class="notice_all">
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
  if(isset($_POST['Search'])!='')
  {
  ?>
<p align="left" style="float:left;margin-left:-30px;">Format -15A</p>
<p align="right"></p>
  <div class="mar10">
  <?php   
    //if($_POST['sp_office'] == 0)	
	$sp='SP';
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
    $stmt1->bind_param("s", $sp);
    $stmt1->execute();
    $stmt1->store_result();
    if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city);
  ?>
    <p align="center"><span>पुलिस द्वारा अत्याचार से पीडित व्यक्तियों उनके आश्रितों तथा साक्षियों को आकस्मिकता राहत योजना नियम 8, 9, एंव 10 <br />के अंतर्गत देय यात्रा भत्ता, भरण पोषण एंव अन्य सुविधाओं के अंतर्गत दी जाने वाली राशि का मासिक विवरण <br /> दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $criminal_type ='पुलिस कर्मचारी';
 ?><br/>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td rowspan="2" style="vertical-align:middle">क्र.</td>
        <td rowspan="2" style="vertical-align:middle">जिला</td>
        <td colspan="2">अनुसूचित जाति</td>
        <td colspan="2">अनुसूचित जनजाति</td>
        <td colspan="2">योग</td>
      </tr>
      
      <tr>
      <td>प्रकरण संख्या</td>
      <td>राशि</td>
      <td>प्रकरण संख्या</td>
      <td>राशि</td>
      <td>प्रकरण संख्या</td>
      <td>राशि</td>
      </tr>
      
      <tr>
      <td><strong>(1)</strong></td>
      <td><strong>(2)</strong></td>
      <td><strong>(3)</strong></td>
      <td><strong>(4)</strong></td>
      <td><strong>(5)</strong></td>
      <td><strong>(6)</strong></td>
      <td><strong>(7)</strong></td>
      <td><strong>(8)</strong></td>     
      </tr>
      <?php 
	  $j=0;	 
	  while($stmt1->fetch())
	  {
	  $idcheck = $branch_id;
      $j++;
	  ?>
      <tr>
        <td><?php echo $j; ?></td>
        <td width="170px"><?php echo $branch_name; echo ","; echo $city;?></td>
        <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid2); 
    $stmt2->fetch();?>
	<span><?php echo $cid2;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid3); 
    $stmt3->fetch();?>
	<span><?php echo $cid3;?></span>
		</td>
        <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();?>
	<span><?php echo $cid4;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE dsr_entries.sp_id = ? AND (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid5); 
    $stmt5->fetch();?>
	<span><?php echo $cid5;?></span>
		</td>
         <td>
<?php
$sum=$cid2+$cid4;
echo $sum;
?>
		</td>
        <td>
		<?php
$sum1=$cid3+$cid5;
echo $sum1;
?>
		</td>
      </tr>      
      <?php } //stmt1 end here?>
      <tr>
        <td colspan="2">योग</td>
        <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("ssss",$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();?>
	<span><?php echo $cid8;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("ssss",$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid9); 
    $stmt9->fetch();?>
	<span><?php echo $cid9;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("ssss",$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid10); 
    $stmt10->fetch();?>
	<span><?php echo $cid10;?></span>
		</td>
                <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(dsr_entries.id) FROM criminal_list INNER JOIN dsr_entries ON criminal_list.dsr_id= dsr_entries.id WHERE (dsr_entries.dsr_kaymi_date >= ? and dsr_entries.dsr_kaymi_date <= ?) AND dsr_entries.dsr_caste=? AND criminal_list.criminal_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("ssss",$datef, $date1,$dsr_caste,$criminal_type) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
	if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid11); 
    $stmt11->fetch();?>
	<span><?php echo $cid11;?></span>
		</td>
        <td>
		<?php
$sum3=$cid8+$cid10;
echo $sum3;
?>
		</td>
        <td>
		<?php
$sum4=$cid9+$cid11;
echo $sum4;
?>
		</td>
      </tr>   
    </table> 
	<br /><br />  
    <br /><br />
    <p style="float:right" align="center"></p>
  </div>
  <?php } //search end here ?>
  </div>
</div>
<style>
.break { page-break-before: always; }
</style>
<p class="break"></p>
<!-- GLOBAL SCRIPTS --> 
<script src="../assets/plugins/jquery-2.0.3.min.js"></script> 
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script src="../assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script> 
<!-- END GLOBAL SCRIPTS --> 
<!-- PAGE LEVEL SCRIPTS --> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="../assets/js/progressbar.js"></script> 
<script src="../assets/plugins/dataTables/jquery.dataTables.js"></script> 
<script src="../assets/plugins/dataTables/dataTables.bootstrap.js"></script> 
 
<script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script> 
 
<!-- END PAGE LEVEL SCRIPTS --> 
<script type="text/javascript" src="../assets/js/multirow.js"></script> 
<script src="../assets/plugins/validationengine/js/jquery.validationEngine.js"></script> 
<script src="../assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script> 
<script src="../assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script> 
<script src="../assets/js/validationInit.js"></script> 
<script>
        $(function () { formValidation(); });
        </script> 
<script src="../assets/js/formsInit.js"></script> 
<script>
            $(function () { formInit(); });
        </script> 

<script src="../assets/js/jquery-ui.min.js"></script> 
<script src="../assets/plugins/uniform/jquery.uniform.min.js"></script> 
<script src="../assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script> 
<script src="../assets/plugins/chosen/chosen.jquery.min.js"></script> 
<script src="../assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script> 
<script src="../assets/plugins/tagsinput/jquery.tagsinput.min.js"></script> 
<script src="../assets/plugins/validVal/js/jquery.validVal.min.js"></script> 
<script src="../assets/plugins/datepicker/js/bootstrap-datepicker.js"></script> 
<script src="../assets/plugins/autosize/jquery.autosize.min.js"></script>
</body>
</html>