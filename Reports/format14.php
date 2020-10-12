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
<title>Format-14 | File Tracking & Crime Analysis Application </title>
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
      <form action="format14.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format -14</p>
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
    //if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city);
  ?>
    <p align="center"><span>अनुसूचित जाति / जन जाति  प्रतिबंधात्मक कार्यवाही का विवरण दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?><br/>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td rowspan="3" style="vertical-align:middle">क्र.</td>
        <td rowspan="3" style="vertical-align:middle">जिला</td>
        <td colspan="2">पंजीबद्ध प्रकरण</td>
        <td colspan="2">बंदी आरोपी</td>
        <td rowspan="3" style="vertical-align:middle">प्रतिबंधात्मक कार्यवाही का विवरण व पूर्व इतिहास</td>
        <td colspan="2">अंतरिम बाउन्ड</td>
      </tr>
      
      <tr>
      <td>अजा</td>
      <td>अजजा</td>
      <td>अजा</td>
      <td>अजजा</td>
      <td rowspan="2" style="vertical-align:middle">अजा</td>
      <td rowspan="2" style="vertical-align:middle">अजजा</td>
      
      </tr>
      <tr>
      <td>107,110 116(3)</td>
      <td>107,110 116(3)</td>
      <td>151,110</td>
      <td>151,110</td>
      
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
        <td>
	    <?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$p_caste= 'SC';
		$preventive_type1='30';
		$preventive_type2='33';
		$p_status = 'पंजीबद्ध प्रकरण';
		if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE preventive_details.sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_caste = ? AND preventive_details.p_status = ? AND (preventive_type =? OR preventive_type=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->bind_param("issssii", $idcheck, $datef, $date1, $p_caste, $p_status, $preventive_type1,$preventive_type2 ) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->execute() ) 
        echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	    if ( !$stmt2->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt2->num_rows === 0) { echo "No Results"; }
        $stmt2->bind_result($cid1); 
        $stmt2->fetch();
	    ?>
	    <span><?php echo $cid1;?></span>
	    <?php 
	    $stmt2->close();
	    ?>
	    </td>
    
	   <td>
	   <?php
 	   $police_dsr->select_db("ftcaaazc_dsr");
	   $p_caste= 'ST';
	   $preventive_type1='30';
	   $preventive_type2='33';
	   $p_status = 'पंजीबद्ध प्रकरण';
	   if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE preventive_details.sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_caste = ? AND preventive_details.p_status = ? AND (preventive_type =? OR preventive_type=?)") ) 
       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
       if ( !$stmt3->bind_param("issssii", $idcheck, $datef, $date1, $p_caste, $p_status, $preventive_type1,$preventive_type2  ) )
       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
       if ( !$stmt3->execute() ) 
       echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	   if ( !$stmt3->store_result() ) //Only for select with bind_result()
       echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
       //if($stmt3->num_rows === 0) { echo "No Results"; }
       $stmt3->bind_result($cid2); 
       $stmt3->fetch();		
       ?>
	   <span><?php echo $cid2;?></span>
	   <?php 
	   $stmt3->close();
	   ?>
	   </td>
	   
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'SC';
	$preventive_type1='30';
	$preventive_type2='32';
	$p_status3='बंदी आरोपी';
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE preventive_details.sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?)  AND preventive_details.p_caste = ? AND preventive_details.p_status = ? AND (preventive_type =? OR preventive_type =?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("issssii", $idcheck, $datef, $date1, $p_caste,$p_status3 ,$preventive_type1,$preventive_type2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
    if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt4->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid3); 
    $stmt4->fetch();		
    ?>
	<span><?php echo $cid3;?></span>
	<?php 
	$stmt4->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'ST';
	$preventive_type1='30';
	$preventive_type2='32';
	$p_status4='बंदी आरोपी';
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE preventive_details.sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?)  AND preventive_details.p_caste = ? AND preventive_details.p_status = ? AND (preventive_type =? OR preventive_type =?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("issssii", $idcheck, $datef, $date1, $p_caste,$p_status4,$preventive_type1,$preventive_type2  ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
    if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt5->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid4); 
    $stmt5->fetch();		
    ?>
	<span><?php echo $cid4;?></span>
	<?php 
	$stmt5->close();
	?>
	</td>
    
	<td>0
	<?php
 	/*$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt6 = $police_dsr->prepare("SELECT description FROM add_preventive WHERE sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("iss", $idcheck, $datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
    if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt6->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid5); 
    $stmt6->fetch();		
    ?>
	<span><?php echo $cid5; echo"<br>";?></span>
	<?php 
	$stmt6->close();*/
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'SC';
	$antrim_bond = 'Yes';
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE preventive_details.sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_caste = ? AND preventive_details.antrim_bond = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("issss", $idcheck, $datef, $date1, $p_caste, $antrim_bond) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
    if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt7->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid6); 
    $stmt7->fetch();		
    ?>
	<span><?php echo $cid6;?></span>
	<?php 
	$stmt7->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'ST';
	$antrim_bond = 'Yes';
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE preventive_details.sp_id = ? AND (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_caste = ? AND preventive_details.antrim_bond = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("issss", $idcheck, $datef, $date1, $p_caste, $antrim_bond ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
    if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid7); 
    $stmt8->fetch();		
    ?>
	<span><?php echo $cid7;?></span>
	<?php 
	$stmt8->close();
	?>
	</td>
        
      </tr>     
      <?php } //stmt1 end here?>
      <tr>
        <td colspan="2">योग</td>
        <td>
	    <?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$p_caste= 'SC';
		$preventive_type1='30';
		$preventive_type2='33';
		$p_status5 = 'पंजीबद्ध प्रकरण';
		if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_status = ? AND preventive_details.p_caste = ?  AND (preventive_type =? OR preventive_type=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt9->bind_param("ssssii",$datef, $date1, $p_status5, $p_caste,$preventive_type1,$preventive_type2 ) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt9->execute() ) 
        echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	    if ( !$stmt9->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt2->num_rows === 0) { echo "No Results"; }
        $stmt9->bind_result($cid9); 
        $stmt9->fetch();
	    ?>
	    <span><?php echo $cid9;?></span>
	    <?php 
	    $stmt9->close();
	    ?>
	    </td>
    
	   <td>
	   <?php
 	   $police_dsr->select_db("ftcaaazc_dsr");
	  $p_caste= 'ST';
	  $preventive_type1='30';
		$preventive_type2='33';
		$p_status6 = 'पंजीबद्ध प्रकरण';
	   if ( !$stmt10= $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_status = ? AND preventive_details.p_caste = ? AND (preventive_type =? OR preventive_type=?)") ) 
       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
       if ( !$stmt10->bind_param("ssssii",$datef, $date1, $p_status6, $p_caste,$preventive_type1,$preventive_type2  ) )
       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
       if ( !$stmt10->execute() ) 
       echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	   if ( !$stmt10->store_result() ) //Only for select with bind_result()
       echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
       //if($stmt3->num_rows === 0) { echo "No Results"; }
       $stmt10->bind_result($cid10); 
       $stmt10->fetch();		
       ?>
	   <span><?php echo $cid10;?></span>
	   <?php 
	   $stmt10->close();
	   ?>
	   </td>
	   
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'SC';
	$preventive_type1='30';
	$preventive_type2='32';
	$p_status='बंदी आरोपी';
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE (istagasa_date >= ? and istagasa_date <= ?)  AND preventive_details.p_caste = ? AND preventive_details.p_status = ? AND (preventive_type =? OR preventive_type =?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("ssssii",$datef, $date1, $p_caste ,$p_status,$preventive_type1,$preventive_type2 ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
    if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt4->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid11); 
    $stmt11->fetch();		
    ?>
	<span><?php echo $cid11;?></span>
	<?php 
	$stmt11->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'ST';
	$preventive_type1='30';
	$preventive_type2='32';
	$p_status='बंदी आरोपी';
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE (istagasa_date >= ? and istagasa_date <= ?)  AND preventive_details.p_caste = ? AND preventive_details.p_status = ? AND (preventive_type =? OR preventive_type =?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("ssssii", $datef, $date1, $p_caste,$p_status,$preventive_type1,$preventive_type2  ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
    if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt5->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid12); 
    $stmt12->fetch();		
    ?>
	<span><?php echo $cid12;?></span>
	<?php 
	$stmt12->close();
	?>
	</td>
    
	<td>0
	<?php
 	/*$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt13 = $police_dsr->prepare("SELECT COUNT(id) FROM add_preventive WHERE (istagasa_date >= ? and istagasa_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("ss", $datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
    if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt6->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid13); 
    $stmt13->fetch();		
    ?>
	<span><?php echo $cid13;?></span>
	<?php 
	$stmt13->close();*/
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'SC';
	$antrim_bond = 'Yes';
	
	if ( !$stmt14 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id WHERE (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_caste = ? AND preventive_details.antrim_bond = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("ssss", $datef, $date1, $p_caste, $antrim_bond) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
    if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt7->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid14); 
    $stmt14->fetch();		
    ?>
	<span><?php echo $cid14;?></span>
	<?php 
	$stmt14->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$p_caste= 'ST';
	$antrim_bond = 'Yes';
	if ( !$stmt15 = $police_dsr->prepare("SELECT COUNT(DISTINCT(peventive_id)) FROM preventive_details LEFT JOIN add_preventive ON preventive_details.peventive_id = add_preventive.id  WHERE (istagasa_date >= ? and istagasa_date <= ?) AND preventive_details.p_caste = ? AND preventive_details.antrim_bond = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->bind_param("ssss",  $datef, $date1, $p_caste, $antrim_bond ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
    if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid15); 
    $stmt15->fetch();		
    ?>
	<span><?php echo $cid15;?></span>
	<?php 
	$stmt15->close();
	?>
	</td>
      </tr>
      
    </table> 
	<br /><br />    
    <br /><br />
    <p style="float:right" align="center"></p>
  </div>
  <?php } //search end here?>
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