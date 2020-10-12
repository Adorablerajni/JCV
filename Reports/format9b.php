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
<title>P-9B | File Tracking & Crime Analysis Application </title>
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
      <form action="format9b.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format -9B</p>
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
    <p align="center"><span>धारा 173(8) के अन्तर्गत लंबित प्रकरणो की जानकारी दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
      
  <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $dsr_vidhan_ipc='103';
  $c_status='निराकृत';
  $s=date('Y', strtotime($_POST['datef']));
  $s1=date('Y', strtotime($_POST['datel']));
  $date='$s-01-01';
  $date2='$s1-12-31';
  ?>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td rowspan="2">क्र.</td>
        <td rowspan="2">जिला</td>
        <td colspan="2">माह के पूर्व लंबित संख्या</td>
        <td colspan="2">माह में प्रस्तुत संख्या</td>
        <td colspan="2">माह में निराकृत संख्या</td>
        <td colspan="2">माह के अन्त में लंबित संख्या</td>
        <td colspan="2">वर्ष में अभी तक कुल निराकृत संख्या	</td>
        
      </tr>
      <tr>
      <td>प्रकरण</td>
        <td>आरोपी</td>
        <td>प्रकरण</td>
        <td>आरोपी</td>
        <td>प्रकरण</td>
        <td>आरोपी</td>
        <td>प्रकरण</td>
        <td>आरोपी</td>
        <td>प्रकरण</td>
        <td>आरोपी</td>
        
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
        <td class=""><?php echo $branch_name; echo ","; echo $city;?></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $s_status_check="निराकृत";
	  $s_chalan_type_check="173(8)";
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE sp_id = ? AND s_status_date < ? AND s_chalan_type = ? AND s_status != ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("isss",$branch_id, $datef, $s_chalan_type_check, $s_status_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid2); 
    $stmt2->fetch();?>
	<span><?php echo $cid2;?></span></td>
        <td class=""><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE dsr_status.sp_id = ? AND dsr_status.s_status_date<? AND dsr_status.s_chalan_type = ? AND dsr_status.s_status != ?") ) 
		
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("isss",$branch_id,$datef, $s_chalan_type_check, $s_status_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid3); 
    $stmt3->fetch();?>
	<span><?php echo $cid3;?></span></td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $s_status_check="निराकृत";
	  $s_chalan_type_check="173(8)";
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE sp_id = ? AND (s_status_date >= ? and s_status_date <= ?) AND s_chalan_type = ?  ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("isss",$branch_id,$datef, $date1,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();?>
	<span><?php echo $cid4;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE dsr_status.sp_id = ? AND (dsr_status.s_status_date >= ? and dsr_status.s_status_date <= ?) AND dsr_status.s_chalan_type = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("isss",$branch_id,$datef, $date1,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid5); 
    $stmt5->fetch();?>
	<span><?php echo $cid5;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $s_status_check="निराकृत";
	  $s_chalan_type_check="173(8)";
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE sp_id = ? AND s_status=? AND s_chalan_type=? AND (s_status_date >= ? and s_status_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("issss",$branch_id,$s_status_check,$s_chalan_type_check,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid6); 
    $stmt6->fetch();?>
	<span><?php echo $cid6;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE dsr_status.sp_id = ? AND (dsr_status.s_status_date >= ? and dsr_status.s_status_date <= ?) AND dsr_status.s_chalan_type = ? AND dsr_status.s_status = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("issss",$branch_id, $datef, $date1, $s_chalan_type_check, $s_status_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid7); 
    $stmt7->fetch();?>
	<span><?php echo $cid7;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $s_status_check="निराकृत";
	  $s_chalan_type_check="173(8)";
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE sp_id = ? AND (s_status_date >= ? and s_status_date <= ?) AND s_status != ? AND s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("issss",$branch_id,$datef, $date1,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();?>
	<span><?php echo $cid8;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE dsr_status.sp_id = ? AND (dsr_status.s_status_date >= ? and dsr_status.s_status_date <= ?) AND dsr_status.s_status != ? AND dsr_status.s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("issss",$branch_id,$datef, $date1,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid9); 
    $stmt9->fetch();?>
	<span><?php echo $cid9;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $s_status_check="निराकृत";
	  $s_chalan_type_check="173(8)";
	  $year ="%".date ("Y", strtotime ($date1))."%";
  
	if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE sp_id = ? AND s_status_date LIKE ? AND s_status = ? AND s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("isss",$branch_id,$year,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid10); 
    $stmt10->fetch();?>
	<span><?php echo $cid10;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE dsr_status.sp_id = ? AND dsr_status.s_status_date LIKE ? AND dsr_status.s_status = ? AND dsr_status.s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("isss",$branch_id,$year,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
	if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid11); 
    $stmt11->fetch();?>
	<span><?php echo $cid11;?></span></td>
      </tr>
      
      <?php } //stmt1 end here ?>
      <tr>
       
        <td class="" colspan="2">जोन का योग</td>
          <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE s_status_date < ? AND s_chalan_type = ? AND s_status != ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("sss",$datef, $s_chalan_type_check, $s_status_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
	if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid12); 
    $stmt12->fetch();?>
	<span><?php echo $cid12;?></span></td>
        <td class=""><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt13 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE dsr_status.s_status_date < ? AND dsr_status.s_chalan_type = ? AND dsr_status.s_status != ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("sss",$datef, $s_chalan_type_check, $s_status_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
	if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid13); 
    $stmt13->fetch();?>
	<span><?php echo $cid13;?></span></td>
        <td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt14 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE  (s_status_date >= ? and s_status_date <= ?) AND s_chalan_type = ?  ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("sss",$datef, $date1,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
	if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid14); 
    $stmt14->fetch();?>
	<span><?php echo $cid14;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt15 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE (dsr_status.s_status_date >= ? and dsr_status.s_status_date <= ?) AND dsr_status.s_chalan_type = ?  ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->bind_param("sss",$datef, $date1,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
	if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid15); 
    $stmt15->fetch();?>
	<span><?php echo $cid15;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt16 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE s_status=? AND s_chalan_type=? AND (s_status_date >= ? and s_status_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->bind_param("ssss",$s_status_check,$s_chalan_type_check,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->execute() ) 
    echo "Execute Error: ($stmt16->errno)  $stmt16->error";
	if ( !$stmt16->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt16->bind_result($cid16); 
    $stmt16->fetch();?>
	<span><?php echo $cid16;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE (dsr_status.s_status_date >= ? and dsr_status.s_status_date <= ?) AND dsr_status.s_status = ? AND dsr_status.s_chalan_type = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->bind_param("ssss",$datef, $date1,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
	if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid17); 
    $stmt17->fetch();?>
	<span><?php echo $cid17;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE (s_status_date >= ? and s_status_date <= ?) AND s_status != ? AND s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("ssss", $datef, $date1,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid18); 
    $stmt18->fetch();?>
	<span><?php echo $cid18;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt19 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE (dsr_status.s_status_date >= ? and dsr_status.s_status_date <= ?) AND dsr_status.s_status != ? AND dsr_status.s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->bind_param("ssss", $datef, $date1,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->execute() ) 
    echo "Execute Error: ($stmt19->errno)  $stmt19->error";
	if ( !$stmt19->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt19->bind_result($cid19); 
    $stmt19->fetch();?>
	<span><?php echo $cid19;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt20 = $police_dsr->prepare("SELECT COUNT(dsr_id) FROM dsr_status WHERE s_status_date LIKE ?  AND s_status = ? AND s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->bind_param("sss",$date1,$s_status_check,$s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->execute() ) 
    echo "Execute Error: ($stmt20->errno)  $stmt20->error";
	if ( !$stmt20->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt20->bind_result($cid20); 
    $stmt20->fetch();?>
	<span><?php echo $cid20;?></span></td>
        <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt21 = $police_dsr->prepare("SELECT COUNT(criminal_list.id) FROM criminal_list INNER JOIN dsr_status ON criminal_list.dsr_id= dsr_status.dsr_id WHERE dsr_status.s_status_date LIKE ?  AND s_status = ? AND s_chalan_type=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->bind_param("sss",$date1, $s_status_check, $s_chalan_type_check) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->execute() ) 
    echo "Execute Error: ($stmt21->errno)  $stmt21->error";
	if ( !$stmt21->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt21->bind_result($cid21); 
    $stmt21->fetch();?>
	<span><?php echo $cid21;?></span></td>
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