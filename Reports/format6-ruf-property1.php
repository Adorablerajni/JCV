<?php
require_once('../Connections/dbconnect-m.php');
 
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
<title>Format-6-ruf-PROPERTY | File Tracking & Crime Analysis Application </title>
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
      <form action="format6-ruf-property.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
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
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
   if(isset($_POST['Search'])!='')
   {
  ?>
<p align="left" style="float:left;margin-left:-30px;">Format6-ruf-Property</p>
<p align="right"></p>
  <div class="mar10">
  <?php   
    //if($_POST['sp_office'] == 0)	
	$sp='SP';
    $police_tracking->select_db("ftcaaazc_epfts");
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
	$stmt1->bind_param("s", $sp);
    $stmt1->execute();
     $stmt1->store_result();
   // if($stmt1->num_rows === 0) exit('No rows');
   $stmt1->bind_result($branch_id, $branch_name, $city);
  ?>
    <p align="center"><span>संपत्ति संबंधी जिलावार जानकारी दिनांक. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>तक  इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
      <tr>
        <td rowspan="2">क्र.</td>
        <td rowspan="2"> शीर्ष</td>
		 <?php 
	  $j=0;	 	  
	  while($stmt1->fetch())
	  {
	  $idcheck = $branch_id;
      $j++;
	  ?>
	  <td class="" colspan="2"><?php echo $branch_name; echo ", "; echo $city;?></td>
	  <?php } //stmt1 end here?>
      </tr>
	  <tr>
      <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	   <td>गया </td>
      <td>मिला</td>
	  
      </tr>
	  <?php
      $ipc =array("डकैती","लूट","गृहभेदन","चोरी","वाहन चोरी (दो पहिया)","वाहन चोरी (चार पहिया)","पशु चोरी");//,"अन्य भादवि"
	  $ipc1 =array('3','5','7','9','69','70','8');//,'19'	  
	  $arrlength=count($ipc);
	  for($x=0;$x<$arrlength;$x++)
  {
	  ?>
      <tr>
        <td><?php echo $x+1; ?></td>
        <td><?php echo $ipc[$x]; ?></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='6';
	  $ipc2=$ipc1[$x];
	if ( !$stmt2 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid2); 
    $stmt2->fetch();
	$i2[$x]=$cid2;?>
	<span><?php if($cid2>0){echo $cid2;} else {echo 0 ;}  //echo $cid2;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='6';
	  $ipc2=$ipc1[$x];
	if ( !$stmt3 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid3); 
    $stmt3->fetch();
	$i3[$x]=$cid3;
	?>
	<span><?php if($cid3>0){echo $cid3;} else {echo 0 ;}  //echo $cid3;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='7';
	  $ipc2=$ipc1[$x];
	if ( !$stmt4 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();
	$i4[$x]=$cid4;
	?>
	<span><?php if($cid4>0){echo $cid4;} else {echo 0 ;}  //echo $cid4;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='7';
	  $ipc2=$ipc1[$x];
	if ( !$stmt5 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid5); 
    $stmt5->fetch();
	$i5[$x]=$cid5;
	?>
	<span><?php if($cid5>0){echo $cid5;} else {echo 0 ;}  //echo $cid5;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='8';
	  $ipc2=$ipc1[$x];
	if ( !$stmt6 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid6); 
    $stmt6->fetch();
	$i6[$x]=$cid6;
	?>
	<span><?php if($cid6>0){echo $cid6;} else {echo 0 ;} //echo $cid6;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='8';
	  $ipc2=$ipc1[$x];
	if ( !$stmt7 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid7); 
    $stmt7->fetch();
	$i7[$x]=$cid7;
	?>
	<span><?php if($cid7>0){echo $cid7;} else {echo 0 ;}  //echo $cid7;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='9';
	  $ipc2=$ipc1[$x];
	if ( !$stmt8 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();
	$i8[$x]=$cid8;
	?>
	<span><?php if($cid8>0){echo $cid8;} else {echo 0 ;} // echo $cid8;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='9';
	  $ipc2=$ipc1[$x];
	if ( !$stmt9 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid9); 
    $stmt9->fetch();
	$i9[$x]=$cid9;
	?>
	<span><?php if($cid9>0){echo $cid9;} else {echo 0 ;}  //echo $cid9;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='10';
	  $ipc2=$ipc1[$x];
	if ( !$stmt10 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid10); 
    $stmt10->fetch();
	$i10[$x]=$cid10;
	?>
	<span><?php if($cid10>0){echo $cid10;} else {echo 0 ;}  //echo $cid10;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='10';
	  $ipc2=$ipc1[$x];
	if ( !$stmt11 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
	if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid11); 
    $stmt11->fetch();
	$i11[$x]=$cid11;
	?>
	<span><?php if($cid11>0){echo $cid11;} else {echo 0 ;} //echo $cid11;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='11';
	  $ipc2=$ipc1[$x];
	if ( !$stmt12 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
	if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid12); 
    $stmt12->fetch();
	$i12[$x]=$cid12;
	?>
	<span><?php if($cid12>0){echo $cid12;} else {echo 0 ;} //echo $cid12;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='11';
	  $ipc2=$ipc1[$x];
	if ( !$stmt13 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
	if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid13); 
    $stmt13->fetch();
	$i13[$x]=$cid13;
	?>
	<span><?php if($cid13>0){echo $cid13;} else {echo 0 ;} //echo $cid13;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='12';
	  $ipc2=$ipc1[$x];
	if ( !$stmt14 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
	if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid14); 
    $stmt14->fetch();
	$i14[$x]=$cid14;
	?>
	<span><?php if($cid14>0){echo $cid14;} else {echo 0 ;} //echo $cid14;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='12';
	  $ipc2=$ipc1[$x];
	if ( !$stmt15 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
	if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid15); 
    $stmt15->fetch();
	$i15[$x]=$cid15;
	?>
	<span><?php if($cid15>0){echo $cid15;} else {echo 0 ;} //echo $cid15;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='13';
	  $ipc2=$ipc1[$x];
	if ( !$stmt16 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->execute() ) 
    echo "Execute Error: ($stmt16->errno)  $stmt16->error";
	if ( !$stmt16->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt16->bind_result($cid16); 
    $stmt16->fetch();
	$i16[$x]=$cid16;
	?>
	<span><?php if($cid16>0){echo $cid16;} else {echo 0 ;} //echo $cid16;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='13';
	  $ipc2=$ipc1[$x];
	if ( !$stmt17 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
	if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid17); 
    $stmt17->fetch();
	$i17[$x]=$cid17;
	?>
	<span><?php if($cid17>0){echo $cid17;} else {echo 0 ;} //echo $cid17;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='14';
	  $ipc2=$ipc1[$x];
	if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid18); 
    $stmt18->fetch();
	$i18[$x]=$cid18;
	?>
	<span><?php if($cid18>0){echo $cid18;} else {echo 0 ;} //echo $cid18;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='14';
	  $ipc2=$ipc1[$x];
	if ( !$stmt19 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt19->execute() ) 
    echo "Execute Error: ($stmt19->errno)  $stmt19->error";
	if ( !$stmt19->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt19->bind_result($cid19); 
    $stmt19->fetch();
	$i19[$x]=$cid19;
	?>
	<span><?php if($cid19>0){echo $cid19;} else {echo 0 ;} //echo $cid19;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='15';
	  $ipc2=$ipc1[$x];
	if ( !$stmt20 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->execute() ) 
    echo "Execute Error: ($stmt20->errno)  $stmt20->error";
	if ( !$stmt20->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt20->bind_result($cid20); 
    $stmt20->fetch();
	$i20[$x]=$cid20;
	?>
	<span><?php if($cid20>0){echo $cid20;} else {echo 0 ;} //echo $cid20;?></span></td>
		<td>
		 <?php
	 $police_dsr->select_db("ftcaaazc_dsr");
	  $branch_id='15';
	  $ipc2=$ipc1[$x];
	if ( !$stmt21 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND  dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->execute() ) 
    echo "Execute Error: ($stmt21->errno)  $stmt21->error";
	if ( !$stmt21->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt21->bind_result($cid21); 
    $stmt21->fetch();
	$i21[$x]=$cid21;
	?>
	<span><?php if($cid21>0){echo $cid21;} else {echo 0 ;}?></span>
	</td>
    </tr>
	<?php }?>
	
	<tr>
	<?php   	
	$sp='SP';
    $police_tracking->select_db("ftcaaazc_epfts");
	$st1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
	$st1->bind_param("s", $sp);
    $st1->execute();
    $st1->store_result();
    //if($st1->num_rows === 0) exit('No rows');
    $st1->bind_result($branch_id1, $branch_name1, $city1);
    ?>
	<td>8</td>
	<td>पूर्व प्रकरण</td>
	  <?php 
	  $k=0;	 	  
	  while($st1->fetch())
	  {
      $k++;
	  ?>
	<td>
	<?php
	/*$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$st2 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date < ? AND creation_date BETWEEN ? AND ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st2->bind_param("isss",$branch_id1,$datef,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st2->execute() ) 
    echo "Execute Error: ($st2->errno)  $st2->error";
	if ( !$st2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($st2->num_rows === 0) { echo "No Results"; }
    $st2->bind_result($cid22); 
    $st2->fetch();
	$st2->close();*/
	?>
	<?php
	/*$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$st3 = $police_dsr->prepare("SELECT SUM(lost_property) FROM property_details WHERE sp_id = ? AND creation_date BETWEEN ? AND ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st3->bind_param("iss",$branch_id1,$datef,$date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st3->execute() ) 
    echo "Execute Error: ($st3->errno)  $st3->error";
	if ( !$st3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($st3->num_rows === 0) { echo "No Results"; }
    $st3->bind_result($cid23); 
    $st3->fetch();
	$st3->close();*/
	?>
	<?php
	$total= 0; //$cid22+$cid23;
	$p[$k]=$total;
	?>
	<span><?php if($total>0){echo $total;} else {echo 0 ;}?></span>
	</td>			

	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$a1='3';
	$a2='5';
	$a3='7';
	$a4='9';
	$a5='69';
	$a6='70';
    $a7='8';
	if ( !$st4 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date < ? AND  (creation_date >= ? and creation_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?) ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st4->bind_param("isssiiiiiii",$branch_id1,$datef,$datef,$date1,$a1, $a2, $a3, $a4, $a5, $a6, $a7) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st4->execute() ) 
    echo "Execute Error: ($st4->errno)  $st4->error";
	if ( !$st4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($st4->num_rows === 0) { echo "No Results"; }
    $st4->bind_result($cid24); 
    $st4->fetch();
	$st4->close();
	?>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$st5 = $police_dsr->prepare("SELECT SUM(got_property) FROM property_details WHERE sp_id = ? AND  (property_date >= ? and property_date <= ?) ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st5->bind_param("iss",$branch_id1,$datef,$date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st5->execute() ) 
    echo "Execute Error: ($st5->errno)  $st5->error";
	if ( !$st5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($st5->num_rows === 0) { echo "No Results"; }
    $st5->bind_result($cid25); 
    $st5->fetch();
	$st5->close();
	?>
	<?php
	$total1=$cid24+$cid25;
	$pk[$k]=$total1;
	?>
	<span><?php if($total1>0){echo $total1;} else {echo 0 ;}?></span>
	</td>	

	<?php
	  }
	  $st1->close();
	?>
	</tr>
	   
	   <tr>
        <td>9</td>
        <td> योग</td>
		<td>
		<?php $s=$i2[0]+$i2[1]+$i2[2]+$i2[3]+$i2[4]+$i2[5]+$i2[6]+$p[1];
	echo $s;?>
		</td>
		<td>
		<?php $s1=$i3[0]+$i3[1]+$i3[2]+$i3[3]+$i3[4]+$i3[5]+$i3[6]+$pk[1];
	echo $s1;?></td>
		<td>
		 <?php $s2=$i4[0]+$i4[1]+$i4[2]+$i4[3]+$i4[4]+$i4[5]+$i4[6]+$p[2];
	echo $s2;?></td>
		<td>
		 <?php $s3=$i5[0]+$i5[1]+$i5[2]+$i5[3]+$i5[4]+$i5[5]+$i5[6]+$pk[2];
	echo $s3;?></td>
		<td>
		 <?php $s4=$i6[0]+$i6[1]+$i6[2]+$i6[3]+$i6[4]+$i6[5]+$i6[6]+$p[3];
	echo $s4;?></td>
		<td>
		 <?php $s5=$i7[0]+$i7[1]+$i7[2]+$i7[3]+$i7[4]+$i7[5]+$i7[6]+$pk[3];
	echo $s5;?></td>
	<td>
		 <?php $s6=$i8[0]+$i8[1]+$i8[2]+$i8[3]+$i8[4]+$i8[5]+$i8[6]+$p[4];
	echo $s6;?></td>
		<td>
		 <?php $s7=$i9[0]+$i9[1]+$i9[2]+$i9[3]+$i9[4]+$i9[5]+$i9[6]+$pk[4];
	echo $s7;?></td>
		 <td>
		 <?php $s8=$i10[0]+$i10[1]+$i10[2]+$i10[3]+$i10[4]+$i10[5]+$i10[6]+$p[5];
	echo $s8;?></td>
		<td>
		 <?php $s9=$i11[0]+$i11[1]+$i11[2]+$i11[3]+$i11[4]+$i11[5]+$i11[6]+$pk[5];
	echo $s9;?></td>
		<td>
		 <?php $s10=$i12[0]+$i12[1]+$i12[2]+$i12[3]+$i12[4]+$i12[5]+$i12[6]+$p[6];
	echo $s10;?></td>
		 <td>
		 <?php $s11=$i13[0]+$i13[1]+$i13[2]+$i13[3]+$i13[4]+$i13[5]+$i13[6]+$pk[6];
	echo $s11;?></td>
		<td>
		 <?php $s12=$i14[0]+$i14[1]+$i14[2]+$i14[3]+$i14[4]+$i14[5]+$i14[6]+$p[7];
	echo $s12;?></td>
		<td>
		 <?php $s13=$i15[0]+$i15[1]+$i15[2]+$i15[3]+$i15[4]+$i15[5]+$i15[6]+$pk[7];
	echo $s13;?></td>
		<td>
		 <?php $s14=$i16[0]+$i16[1]+$i16[2]+$i16[3]+$i16[4]+$i16[5]+$i16[6]+$p[8];
	echo $s14;?></td>
		<td>
		 <?php $s15=$i17[0]+$i17[1]+$i17[2]+$i17[3]+$i17[4]+$i17[5]+$i17[6]+$pk[8];
	echo $s15;?></td>
		<td>
		 <?php $s16=$i18[0]+$i18[1]+$i18[2]+$i18[3]+$i18[4]+$i18[5]+$i18[6]+$p[9];
	echo $s16;?></td>
		<td>
		 <?php $s17=$i19[0]+$i19[1]+$i19[2]+$i19[3]+$i19[4]+$i19[5]+$i19[6]+$pk[9];
	echo $s17;?></td>
		<td>
		 <?php $s18=$i20[0]+$i20[1]+$i20[2]+$i20[3]+$i20[4]+$i20[5]+$i20[6]+$p[10];
	echo $s18;?></td>
		<td>
		 <?php $s19=$i21[0]+$i21[1]+$i21[2]+$i21[3]+$i21[4]+$i21[5]+$i21[6]+$pk[10];
	echo $s19;?></td>
      </tr>
	   <tr>
        <td>10</td>
        <td>प्रतिशत</td>
		<td colspan="2"><?php 
if($s > 0)
{	
$percentage1 =($s1)*100/$s ;
echo ROUND(ABS($percentage1),2); echo "%";
}
else
{	
echo "0%";	
}?></td>
		<td colspan="2">
		<?php 
if($s2 > 0)
{	
$percentage2 =($s3)*100/$s2 ;
echo ROUND(ABS($percentage2),2); echo "%";
}
else
{	
echo "0%";	
}?>
		</td>
		<td colspan="2">
		<?php 
if($s4 > 0)
{	
$percentage3 =($s5)*100/$s4 ;
echo ROUND(ABS($percentage3),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s6 > 0)
{	
$percentage4 =($s7)*100/$s6 ;
echo ROUND(ABS($percentage4),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s8 > 0)
{	
$percentage5 =($s9)*100/$s8 ;
echo ROUND(ABS($percentage5),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s10 > 0)
{	
$percentage6 =($s11)*100/$s10 ;
echo ROUND(ABS($percentage6),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s12 > 0)
{	
$percentage7 =($s13)*100/$s12 ;
echo ROUND(ABS($percentage7),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2"><?php 
if($s14 > 0)
{	
$percentage8 =($s15)*100/$s14 ;
echo ROUND(ABS($percentage8),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s16 > 0)
{	
$percentage9 =($s17)*100/$s16 ;
echo ROUND(ABS($percentage9),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s18 > 0)
{	
$percentage10 =($s19)*100/$s18 ;
echo ROUND(ABS($percentage10),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
      </tr>
	  
	     <tr style="display:none">
        <td colspan="2"> प्रापर्टी से </td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
      </tr>
    </table>
    
    <br /><br />
  
    <br /><br />
	
    <p style="float:right" align="center"></p>
  </div>
  <?php } //search end here ?></div>
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
