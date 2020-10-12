<?php require_once('../Connections/dbconnect-m.php');  ?>

<?php 
if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    }
$police_tracking->select_db("ftcaaazc_epfts");
$a='SP';
$stmt = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE designation = ?");
$stmt->bind_param("s", $a);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows === 0) exit('No rows');
$stmt->bind_result($id,$branch_name,$city);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>P-27 | File Tracking & Crime Analysis Application </title>
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

<body>
<div class="notice_all">
  <div align='right' class='navStuff'>
    <form action="exporttoexcel.php" method="post" 
onsubmit='$("#datatodisplay").val( $("<div>").append( $("#download").eq(0).clone() ).html() )'>  
<p align="" class="hprtbtn">
<span style="float:right;margin-right:-25px"> <input type="hidden" id="datatodisplay" name="datatodisplay" style="" /> <input type="submit" value="Export to Excel"/>
  <input type='button' value='Print this page' onClick='window.print()'>   </span></p></form>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form action="format27.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

            <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:inline-block;width:220px;">
 <?php   
  while ($stmt->fetch()) 
  {
 ?>  
  <option value="<?php echo $id; ?>"><?php echo $branch_name;?>, <?php echo $city;?></option>
  <?php
  }
  $stmt->close(); //id,branch_name,city FROM branch_tbl close
?>
            </select>
                      
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-success" id="mybutton" name="Search" style="display:inline-block">Search</button>
        </div>
      </form>
    </div>
  </div>
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
	if(isset($_POST['Search'])!='')
    {
  ?>
<p align="left" style="float:left;margin-left:-30px;">Format-27</p>
<p align="right"></p>
  <div class="mar10">
    <?php
  //$result1=mysql_query("");
  //$data1=mysql_fetch_assoc($result1);
  $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE id = ?");
  $stmt1->bind_param("s", $_POST['sp_office']);
  $stmt1->execute();
  $stmt1->store_result();
  if($stmt1->num_rows === 0) exit('No rows');
  $stmt1->bind_result($branch_id, $branch_name, $city); 
  while ($stmt1->fetch())
  { 
  ?>
    <p align="center"><span>गुम इंसान/मानव दुव्र्यापार संबंधी जानकारी दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>&nbsp;&nbsp;&nbsp; जिला - <?php echo $city; ?></span></p>
      

    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
      <tr>
        <td>क्र.</td>
        <td>शीर्ष</td>
        <td></td>
        <td>कायम गुम इंसान</td>
        <td>दस्तयाब</td>
        <td>अदम दस्तयाब</td>
        <td>दस्तयाब होने पर कितने प्रकरणो में मामला कायम किया गया है</td>
        <td>भादवि 372,373</td>
        <td>बन्धुआ मजदूर, दास प्रथा</td>
        <td>संगठित गिरोह</td>
      </tr>
     <?php
      $ipc =array("महिला","पुरूष");	  
	  $arrlength=count($ipc);
	  $a="बालिग";
	  $b="नाबालिग";
	  for($x=0;$x<$arrlength;$x++)
  {
	  ?>
	 <tr>
      <td rowspan="2"><?php echo $x+1;?></td>
	  <td rowspan="2"><?php echo $ipc[$x];?></td>
      <td><?php echo $a;?></td> 
      <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	  $dsr_vidhan_ipc='102';
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=? AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("issssi",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig,$dsr_vidhan_ipc) )
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
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();?>
	<span><?php //echo $cid4;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid5); 
    $stmt5->fetch();?>
	<span><?php //echo $cid5;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid6); 
    $stmt6->fetch();?>
	<span><?php// echo $cid6;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid7); 
    $stmt7->fetch();?>
	<span><?php //echo $cid7;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();?>
	<span><?php// echo $cid8;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid9); 
    $stmt9->fetch();?>
	<span><?php// echo $cid9;?></span>0</td>
	  
	  
	  <tr>
	  <td><?php echo $b;?></td> 
      <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	  $dsr_vidhan_ipc='102';
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=? AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("issssi",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig,$dsr_vidhan_ipc) )
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
	  $dsr_balig="अव्यसक";
	if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid10); 
    $stmt10->fetch();?>
	<span><?php //echo $cid10;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
	if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid11); 
    $stmt11->fetch();?>
	<span><?php //echo $cid11;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
	if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid12); 
    $stmt12->fetch();?>
	<span><?php //echo $cid12;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt13 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
	if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid13); 
    $stmt13->fetch();?>
	<span><?php// echo $cid13;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt14 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
	if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid14); 
    $stmt14->fetch();?>
	<span><?php// echo $cid14;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt15 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_gender=? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->bind_param("issss",$_POST['sp_office'],$datef, $date1,$ipc[$x],$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
	if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid15); 
    $stmt15->fetch();?>
	<span><?php// echo $cid15;?></span>0</td>
	  <tr>
     </tr>
	  <?php }?>
	  
	  
	  
	   <tr>
      <td rowspan="2"><?php echo $x+1;?></td>
	  <td rowspan="2"><?php echo "योग";?></td>
      <td><?php echo $a;?></td> 
      <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	  $dsr_vidhan_ipc='102';
	if ( !$stmt21 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=? AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->bind_param("isssi",$_POST['sp_office'],$datef, $date1,$dsr_balig,$dsr_vidhan_ipc) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->execute() ) 
    echo "Execute Error: ($stmt21->errno)  $stmt21->error";
	if ( !$stmt21->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt21->bind_result($cid21); 
    $stmt21->fetch();?>
	<span><?php  echo $cid21;?></span>
	  </td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt41 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt41->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt41->execute() ) 
    echo "Execute Error: ($stmt41->errno)  $stmt41->error";
	if ( !$stmt41->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt41->bind_result($cid41); 
    $stmt41->fetch();?>
	<span><?php //echo $cid41;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt51 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt51->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt51->execute() ) 
    echo "Execute Error: ($stmt51->errno)  $stmt51->error";
	if ( !$stmt51->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt51->bind_result($cid51); 
    $stmt51->fetch();?>
	<span><?php //echo $cid51;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt61 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt61->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt61->execute() ) 
    echo "Execute Error: ($stmt61->errno)  $stmt61->error";
	if ( !$stmt61->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt61->bind_result($cid61); 
    $stmt61->fetch();?>
	<span><?php // echo $cid61;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt60 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt60->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt60->execute() ) 
    echo "Execute Error: ($stmt60->errno)  $stmt60->error";
	if ( !$stmt60->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt60->bind_result($cid60); 
    $stmt60->fetch();?>
	<span><?php // echo $cid60;?></span>0</td>
	   <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt59 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt59->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt59->execute() ) 
    echo "Execute Error: ($stmt59->errno)  $stmt59->error";
	if ( !$stmt59->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt59->bind_result($cid59); 
    $stmt59->fetch();?>
	<span><?php //echo $cid59;?></span>0</td>
	  <td><?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="वयस्क";
	if ( !$stmt91 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt91->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt91->execute() ) 
    echo "Execute Error: ($stmt91->errno)  $stmt91->error";
	if ( !$stmt91->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt91->bind_result($cid91); 
    $stmt91->fetch();?>
	<span><?php //echo $cid91;?></span>0</td>
	<tr>
	  <td><?php echo $b;?></td> 
      <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	  $dsr_vidhan_ipc='102';
	if ( !$stmt33 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=? AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt33->bind_param("isssi",$_POST['sp_office'],$datef, $date1,$dsr_balig,$dsr_vidhan_ipc) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt33->execute() ) 
    echo "Execute Error: ($stmt33->errno)  $stmt33->error";
	if ( !$stmt33->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt33->bind_result($cid33); 
    $stmt33->fetch();?>
	<span><?php echo $cid33;?></span>
	  </td>
	  <td>
	   <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt31 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt31->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt31->execute() ) 
    echo "Execute Error: ($stmt31->errno)  $stmt31->error";
	if ( !$stmt31->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt31->bind_result($cid31); 
    $stmt31->fetch();?>
	<span><?php //echo $cid31;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt32 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt32->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt32->execute() ) 
    echo "Execute Error: ($stmt32->errno)  $stmt32->error";
	if ( !$stmt32->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt32->bind_result($cid32); 
    $stmt32->fetch();?>
	<span><?php// echo $cid32;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt34 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt34->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt34->execute() ) 
    echo "Execute Error: ($stmt34->errno)  $stmt34->error";
	if ( !$stmt34->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt34->bind_result($cid34); 
    $stmt34->fetch();?>
	<span><?php// echo $cid34;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt35 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt35->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt35->execute() ) 
    echo "Execute Error: ($stmt35->errno)  $stmt35->error";
	if ( !$stmt35->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt35->bind_result($cid35); 
    $stmt35->fetch();?>
	<span><?php //echo $cid35;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt36 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt36->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt36->execute() ) 
    echo "Execute Error: ($stmt36->errno)  $stmt36->error";
	if ( !$stmt36->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt36->bind_result($cid36); 
    $stmt36->fetch();?>
	<span><?php //echo $cid36;?></span>0</td>
	  <td> <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_balig="अव्यसक";
	if ( !$stmt37 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_balig=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt37->bind_param("isss",$_POST['sp_office'],$datef, $date1,$dsr_balig) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt37->execute() ) 
    echo "Execute Error: ($stmt37->errno)  $stmt37->error";
	if ( !$stmt37->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt37->bind_result($cid37); 
    $stmt37->fetch();?>
	<span><?php //echo $cid37;?></span>0</td>
	  <tr>
	</tr>
    </table>
    
    <br /><br />
  
    <br /><br />
    <p style="float:right" align="center"></p>
	  <?php } ?>
  </div>
  <?php } // search query end?> 
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