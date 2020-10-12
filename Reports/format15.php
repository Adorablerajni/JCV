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
<title>P-15 | File Tracking & Crime Analysis Application </title>
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
      <form action="format15.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format -15</p>
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
    <p align="center"><span>अजा/अजजा (अत्याचार-निवारण) अधिनियम-1989 के अंतर्गत पंजीबद्ध प्रकरणों के अंतर्गत राहत राशि स्वीकृत करने हेतु की गई कार्यवाही जोन इन्दौर <br /> दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
 
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $atyachar ='Yes';
 ?><br/>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td rowspan="2" style="vertical-align:middle">क्र.</td>
        <td rowspan="2" style="vertical-align:middle">जिला</td>
        <td colspan="2">अधिनियम के अंतर्गत पंजीबद्ध कुल प्रकरणो की संख्या</td>
        <td colspan="2">पुलिस द्वारा कितने प्रकरण राहत राशि के तैयार कर समिति को भेजे गये।</td>
        <td colspan="2">पुलिस के पास लंबित प्रकरणो की संख्या</td>
         <td colspan="2">पुलिस के पास राहत प्रकरण लंबित रहने का कारण</td>
         <td colspan="2">समिति द्वारा स्वीकृत प्रकरणो की संख्या</td>
         <td colspan="2">निरस्त प्रकरणो की संख्या</td>
         <td colspan="2">समिति के पास लंबित प्रकरणो की संख्या</td>
         <td colspan="2">कितने प्रकरणो में राशि वितरित की गई</td>
         <td colspan="2">कितनी राहत राशि वितरित की गई</td>
         <td colspan="2">समिति पास प्रकरण लंबित रहने का कारण</td>
      </tr>
      
      <tr>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
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
      <td><strong>(9)</strong></td>
      <td><strong>(10)</strong></td>
      <td><strong>(11)</strong></td>
      <td><strong>(12)</strong></td>
      <td><strong>(13)</strong></td>
      <td><strong>(14)</strong></td>
      <td><strong>(15)</strong></td>
      <td><strong>(16)</strong></td>
      <td><strong>(17)</strong></td>
      <td><strong>(18)</strong></td>
      <td><strong>(19)</strong></td>
      <td><strong>(20)</strong></td>
      <td><strong>(21)</strong></td>
      <td><strong>(22)</strong></td>
      
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
        <td width="150px"><?php echo $branch_name; echo ","; echo $city;?></td>
        <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	  $dsr_caste= "ST";
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	  $dsr_caste= "SC";
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid6); 
    $stmt6->fetch();?>
	<span><?php echo $cid6;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid7); 
    $stmt7->fetch();?>
	<span><?php echo $cid7;?></span>
		</td>
        <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	  $dsr_caste= "ST";
	if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	  $dsr_caste= "SC";
	if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
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
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
	if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid12); 
    $stmt12->fetch();?>
	<span><?php echo $cid12;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt13 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
	if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid13); 
    $stmt13->fetch();?>
	<span><?php echo $cid13;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt14 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
	if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid14); 
    $stmt14->fetch();?>
	<span><?php echo $cid14;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt15 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
	if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid15); 
    $stmt15->fetch();?>
	<span><?php echo $cid15;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt16 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->execute() ) 
    echo "Execute Error: ($stmt16->errno)  $stmt16->error";
	if ( !$stmt16->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt16->bind_result($cid16); 
    $stmt16->fetch();?>
	<span><?php echo $cid16;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
	if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid17); 
    $stmt17->fetch();?>
	<span><?php echo $cid17;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid18); 
    $stmt18->fetch();?>
	<span><?php echo $cid18;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt19 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->execute() ) 
    echo "Execute Error: ($stmt19->errno)  $stmt19->error";
	if ( !$stmt19->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt19->bind_result($cid19); 
    $stmt19->fetch();?>
	<span><?php echo $cid19;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt20 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->execute() ) 
    echo "Execute Error: ($stmt20->errno)  $stmt20->error";
	if ( !$stmt20->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt20->bind_result($cid20); 
    $stmt20->fetch();?>
	<span><?php echo $cid20;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt21 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->execute() ) 
    echo "Execute Error: ($stmt21->errno)  $stmt21->error";
	if ( !$stmt21->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt21->bind_result($cid21); 
    $stmt21->fetch();?>
	<span><?php echo $cid21;?></span>
		</td>
      </tr>
      
      <?php } //stmt1 end here?>
      <tr>
        <td colspan="2">योग</td>
          <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt22 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt22->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt22->execute() ) 
    echo "Execute Error: ($stmt22->errno)  $stmt22->error";
	if ( !$stmt22->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt22->num_rows === 0) { echo "No Results"; }
    $stmt22->bind_result($cid22); 
    $stmt22->fetch();?>
	<span><?php echo $cid22;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt23 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt23->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt23->execute() ) 
    echo "Execute Error: ($stmt23->errno)  $stmt23->error";
	if ( !$stmt23->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt23->num_rows === 0) { echo "No Results"; }
    $stmt23->bind_result($cid23); 
    $stmt23->fetch();?>
	<span><?php echo $cid23;?></span>
		</td>
        <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt24 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt24->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt24->execute() ) 
    echo "Execute Error: ($stmt24->errno)  $stmt24->error";
	if ( !$stmt24->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt24->num_rows === 0) { echo "No Results"; }
    $stmt24->bind_result($cid24); 
    $stmt24->fetch();?>
	<span><?php echo $cid24;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt25 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt25->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt25->execute() ) 
    echo "Execute Error: ($stmt25->errno)  $stmt25->error";
	if ( !$stmt25->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt25->num_rows === 0) { echo "No Results"; }
    $stmt25->bind_result($cid25); 
    $stmt25->fetch();?>
	<span><?php echo $cid25;?></span>
		</td>
      <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt26 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt26->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt26->execute() ) 
    echo "Execute Error: ($stmt26->errno)  $stmt26->error";
	if ( !$stmt26->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt26->num_rows === 0) { echo "No Results"; }
    $stmt26->bind_result($cid26); 
    $stmt26->fetch();?>
	<span><?php echo $cid26;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt27 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt27->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt27->execute() ) 
    echo "Execute Error: ($stmt27->errno)  $stmt27->error";
	if ( !$stmt27->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt27->num_rows === 0) { echo "No Results"; }
    $stmt27->bind_result($cid27); 
    $stmt27->fetch();?>
	<span><?php echo $cid27;?></span>
		</td>
        <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt28 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt28->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt28->execute() ) 
    echo "Execute Error: ($stmt28->errno)  $stmt28->error";
	if ( !$stmt28->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt28->num_rows === 0) { echo "No Results"; }
    $stmt28->bind_result($cid28); 
    $stmt28->fetch();?>
	<span><?php echo $cid28;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt29 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt29->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt29->execute() ) 
    echo "Execute Error: ($stmt29->errno)  $stmt29->error";
	if ( !$stmt29->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt29->num_rows === 0) { echo "No Results"; }
    $stmt29->bind_result($cid29); 
    $stmt29->fetch();?>
	<span><?php echo $cid29;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt30 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt30->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt30->execute() ) 
    echo "Execute Error: ($stmt30->errno)  $stmt30->error";
	if ( !$stmt30->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt30->num_rows === 0) { echo "No Results"; }
    $stmt30->bind_result($cid30); 
    $stmt30->fetch();?>
	<span><?php echo $cid30;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt31 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt31->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt31->execute() ) 
    echo "Execute Error: ($stmt31->errno)  $stmt31->error";
	if ( !$stmt31->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt31->num_rows === 0) { echo "No Results"; }
    $stmt31->bind_result($cid31); 
    $stmt31->fetch();?>
	<span><?php echo $cid31;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt32 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt32->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt32->execute() ) 
    echo "Execute Error: ($stmt32->errno)  $stmt32->error";
	if ( !$stmt32->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt32->num_rows === 0) { echo "No Results"; }
    $stmt32->bind_result($cid32); 
    $stmt32->fetch();?>
	<span><?php echo $cid32;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt33 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt33->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt33->execute() ) 
    echo "Execute Error: ($stmt33->errno)  $stmt33->error";
	if ( !$stmt33->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt33->num_rows === 0) { echo "No Results"; }
    $stmt33->bind_result($cid33); 
    $stmt33->fetch();?>
	<span><?php echo $cid33;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt34 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt34->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt34->execute() ) 
    echo "Execute Error: ($stmt34->errno)  $stmt34->error";
	if ( !$stmt34->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt34->num_rows === 0) { echo "No Results"; }
    $stmt34->bind_result($cid34); 
    $stmt34->fetch();?>
	<span><?php echo $cid34;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt35 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt35->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt35->execute() ) 
    echo "Execute Error: ($stmt35->errno)  $stmt35->error";
	if ( !$stmt35->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt35->num_rows === 0) { echo "No Results"; }
    $stmt35->bind_result($cid35); 
    $stmt35->fetch();?>
	<span><?php echo $cid35;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt36 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt36->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt36->execute() ) 
    echo "Execute Error: ($stmt36->errno)  $stmt36->error";
	if ( !$stmt36->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt36->num_rows === 0) { echo "No Results"; }
    $stmt36->bind_result($cid36); 
    $stmt36->fetch();?>
	<span><?php echo $cid36;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt37 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt37->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt37->execute() ) 
    echo "Execute Error: ($stmt37->errno)  $stmt37->error";
	if ( !$stmt37->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt37->num_rows === 0) { echo "No Results"; }
    $stmt37->bind_result($cid37); 
    $stmt37->fetch();?>
	<span><?php echo $cid37;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt38 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt38->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt38->execute() ) 
    echo "Execute Error: ($stmt38->errno)  $stmt38->error";
	if ( !$stmt38->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt38->num_rows === 0) { echo "No Results"; }
    $stmt38->bind_result($cid38); 
    $stmt38->fetch();?>
	<span><?php echo $cid38;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt39 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt39->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt39->execute() ) 
    echo "Execute Error: ($stmt39->errno)  $stmt39->error";
	if ( !$stmt39->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt39->num_rows === 0) { echo "No Results"; }
    $stmt39->bind_result($cid39); 
    $stmt39->fetch();?>
	<span><?php echo $cid39;?></span>
		</td>
       <td>
<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "SC";
	if ( !$stmt40 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt40->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt40->execute() ) 
    echo "Execute Error: ($stmt40->errno)  $stmt40->error";
	if ( !$stmt40->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt40->num_rows === 0) { echo "No Results"; }
    $stmt40->bind_result($cid40); 
    $stmt40->fetch();?>
	<span><?php echo $cid40;?></span>
		</td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste= "ST";
	if ( !$stmt41 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste = ? AND atyachar_adhiniyam = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt41->bind_param("ssss",$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt41->execute() ) 
    echo "Execute Error: ($stmt41->errno)  $stmt41->error";
	if ( !$stmt41->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt41->num_rows === 0) { echo "No Results"; }
    $stmt41->bind_result($cid41); 
    $stmt41->fetch();?>
	<span><?php echo $cid41;?></span>
		</td>
      </tr>
      
    </table> <br /><br />
     
  
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