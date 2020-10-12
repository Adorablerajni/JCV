<?php require_once('../Connections/dbconnect-m.php');

	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>P1 | File Tracking & Crime Analysis Application </title>
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
      <form action="format1-A.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-8 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
          <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

   <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:none;width:220px;">
   <option value="0"></option>
   </select>
             
             
          					<br/>
<div class="container">
  <div class="row">
       <div class="col-lg-12">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
<ul class="dropdown-menu">
  <li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 1</a></li>
  <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 2</a></li>
  <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 3</a></li>
  <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 4</a></li>
  <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 5</a></li>
  <li><a href="#" class="small" data-value="option6" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 6</a></li>
</ul>
  </div>
</div>
  </div>
</div>

             
             
                      
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
<p align="left" style="float:left;margin-left:-30px;">Format-1-A</p>
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
    <p align="center"><span>STATEMENT OF TOTAL IPC CRIME FOR THE <br /> DATE - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d/m/Y', strtotime($_POST['datef']));
}?> TO <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d/m/Y', strtotime($_POST['datel']));}?>&nbsp&nbspINDORE ZONE</span></p>
<br />
  <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  ?>

    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-220px;text-align:center" id="print" width="960px">
      <tr>
        <td rowspan="2" style="vertical-align:middle">S.NO</td>
        <td rowspan="2" style="vertical-align:middle">DISTRICTS</td>
        <td rowspan="2">MURDER</td>
        <td rowspan="2">AT.TO MURDER</td>
        <td rowspan="2">DACOITY</td>
        <td rowspan="2">PR.FOR DACOITY</td>
        <td rowspan="2">ROBBERY</td>
        <td rowspan="2">TOTAL KIDNAPING</td>
        <td rowspan="2">HOUSE BREAKING</td>
		<td rowspan="2">THEFT</td>
        <td rowspan="2">CATTLE THEFT</td>
		<td rowspan="2">RAPE</td>
        <td rowspan="2">RIOT</td>
		<td rowspan="2">MOLESTATION</td>
        <td rowspan="2">OTHER IPC</td>
		<td rowspan="2">TOTAL IPC</td>
		<td colspan="4">KINDNAPING</td>
		<td colspan="2">PROPERTY</td>
      </tr>
      <tr>
	    <td>RANSON</td>
		<td>BEGGING</td>
		<td>W/G</td>
		<td>OTHER</td>
		<td>STOLEN</td>
		<td>RECOVERD</td>
	  </tr>
    <?php 
	$a ='-1';
	$j=0;	 
	while($stmt1->fetch())
	{
	  $idcheck = $branch_id;
	  $branch[] = $branch_name;
	  $branch[0] = 'INDORE MUKHYALAYA';
	  $branch[1] = 'INDORE(EAST)';
	  $branch[2] = 'INDORE(WEST)';
	  $branch[3] = 'ALIRAJPUR';
	  $branch[4] = 'DHAR';
	  $branch[5] = 'JHABUA';
	  $branch[6] = 'KHANDWA';
	  $branch[7] = 'KHARGONE';
	  $branch[8] = 'BADWANI';
	  $branch[9] = 'BURHANPUR';
      $j++;
	  $a++;
	?>
    <tr>
        <td><?php echo $j; ?></td>
        
		<td width="120px"><?php echo $branch[$a]; ?></td>
        
		<td>
	    <?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$murder = '1';
		if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ?") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->bind_param("issi", $idcheck, $datef, $date1, $murder ) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->execute() ) 
        echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	    if ( !$stmt2->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt2->num_rows === 0) { echo "No Results"; }
        $stmt2->bind_result($cid1); 
        $stmt2->fetch();
		$ipc[$j]=$cid1;
	    ?>
	    <span><?php echo $cid1;?></span>
	    <?php 
	    $stmt2->close();
	    ?>
	    </td>
    
	   <td>
	   <?php
 	   $police_dsr->select_db("ftcaaazc_dsr");
	   $at_murder = '2';
	   if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ?") ) 
       echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
       if ( !$stmt3->bind_param("issi", $idcheck, $datef, $date1, $at_murder ) )
       echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
       if ( !$stmt3->execute() ) 
       echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	   if ( !$stmt3->store_result() ) //Only for select with bind_result()
       echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
       //if($stmt3->num_rows === 0) { echo "No Results"; }
       $stmt3->bind_result($cid2); 
       $stmt3->fetch();	
	   $ipc1[$j]=$cid2;	
       ?>
	   <span><?php echo $cid2;?></span>
	   <?php 
	   $stmt3->close();
	   ?>
	   </td>
	   
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$dacoity = '3';
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("issi", $idcheck, $datef, $date1, $dacoity ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
    if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt4->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid3); 
    $stmt4->fetch();
$ipc2[$j]=$cid3;	
    ?>
	<span><?php echo $cid3;?></span>
	<?php 
	$stmt4->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$pr_dacoity = '4';
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("issi", $idcheck, $datef, $date1, $pr_dacoity ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
    if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt5->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid4); 
    $stmt5->fetch();
$ipc3[$j]=$cid4;	
    ?>
	<span><?php echo $cid4;?></span>
	<?php 
	$stmt5->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$robbery = '5';
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("issi", $idcheck, $datef, $date1, $robbery ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
    if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt6->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid5); 
    $stmt6->fetch();
$ipc4[$j]=$cid5;	
    ?>
	<span><?php echo $cid5;?></span>
	<?php 
	$stmt6->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$kidnaping = '13';
	$kidnaping1 = '64';
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("issii", $idcheck, $datef, $date1, $kidnaping, $kidnaping1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
    if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt7->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid6); 
    $stmt7->fetch();
 $ipc5[$j]=$cid6;	
    ?>
	<span><?php echo $cid6;?></span>
	<?php 
	$stmt7->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$house_breaking = '7';
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("issi", $idcheck, $datef, $date1, $house_breaking ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
    if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid7); 
    $stmt8->fetch();
$ipc6[$j]=$cid7;	
    ?>
	<span><?php echo $cid7;?></span>
	<?php 
	$stmt8->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$theft = '9';
	//$theft1 = '9';
	if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("issi", $idcheck, $datef, $date1, $theft ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
    if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid8); 
    $stmt9->fetch();
$ipc7[$j]=$cid8;	
    ?>
	<span><?php echo $cid8;?></span>
	<?php 
	$stmt9->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$cattle_theft = '8';
	if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("issi", $idcheck, $datef, $date1, $cattle_theft) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
    if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt10->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid9); 
    $stmt10->fetch();	
$ipc8[$j]=$cid9;	
    ?>
	<span><?php echo $cid9;?></span>
	<?php 
	$stmt10->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$rape = '12';
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("issi", $idcheck, $datef, $date1, $rape) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
    if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt11->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid10); 
    $stmt11->fetch();
$ipc9[$j]=$cid10;	
    ?>
	<span><?php echo $cid10;?></span>
	<?php 
	$stmt11->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$riot = '11';
	if ( !$stmt12= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->bind_param("issi", $idcheck, $datef, $date1, $riot) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
    if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt12->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid11); 
    $stmt12->fetch();	
$ipc10[$j]=$cid11;	
    ?>
	<span><?php echo $cid11;?></span>
	<?php 
	$stmt12->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$molestation = '15';
	if ( !$stmt13= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("issi", $idcheck, $datef, $date1, $molestation) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
    if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt13->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid12); 
    $stmt13->fetch();
$ipc11[$j]=$cid12;	
    ?>
	<span><?php echo $cid12;?></span>
	<?php 
	$stmt13->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$other_ipc = '19';
	if ( !$stmt14= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("issi", $idcheck, $datef, $date1, $other_ipc) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
    if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt14->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid13); 
    $stmt14->fetch();
$ipc12[$j]=$cid13;	
    ?>
	<span><?php echo $cid13;?></span>
	<?php 
	$stmt14->close();
	?>
	</td>

	
    <td>
	<?php
     $total = $cid1+$cid2+$cid3+$cid4+$cid5+$cid6+$cid7+$cid8+$cid9+$cid10+$cid11+$cid12+$cid13;
	 echo $total;
	 $ipc13[$j]=$total;
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$kidnapping_child = '64';
	$kidnapping_ranson = 'फिरौती के लिये';
	if ( !$stmt15= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? AND dsr_kdnp_rsn = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->bind_param("issis", $idcheck, $datef, $date1, $kidnapping_child, $kidnapping_ranson) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
    if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt15->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid14); 
    $stmt15->fetch();
	$ipc14[$j]=$cid14;
    ?>
	<span><?php echo $cid14;?></span>
	<?php 
	$stmt15->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$kidnapping_child = '64';
	$kidnapping_begging = 'भीख मांगने के लिये';
	if ( !$stmt16= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? AND dsr_kdnp_rsn = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->bind_param("issis", $idcheck, $datef, $date1, $kidnapping_child, $kidnapping_begging) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt16->execute() ) 
    echo "Execute Error: ($stmt16->errno)  $stmt16->error";
    if ( !$stmt16->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt16->num_rows === 0) { echo "No Results"; }
    $stmt16->bind_result($cid15); 
    $stmt16->fetch();
$ipc15[$j]=$cid15;	
    ?>
	<span><?php echo $cid15;?></span>
	<?php 
	$stmt16->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$kidnapping_child = '64';
	$kidnapping_girl = 'महिला';
	if ( !$stmt17= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? AND dsr_vidhan_ipc = ? AND dsr_gender = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->bind_param("issis", $idcheck, $datef, $date1, $kidnapping_child, $kidnapping_girl) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
    if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt17->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid16); 
    $stmt17->fetch();
$ipc16[$j]=$cid16;	
    ?>
	<span><?php echo $cid16;?></span>
	<?php 
	$stmt17->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$kidnapping_child = '64';
	$kidnapping_girl = 'महिला';
	$kidnapping_begging = 'भीख मांगने के लिये';
	$kidnapping_ranson = 'फिरौती के लिये';
	if ( !$stmt18= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date BETWEEN ? AND ?) AND dsr_vidhan_ipc = ? AND (dsr_kdnp_rsn != ? OR dsr_kdnp_rsn != ?) and dsr_gender !=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("ississs", $idcheck, $datef, $date1, $kidnapping_child, $kidnapping_begging, $kidnapping_ranson, $kidnapping_girl) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
    if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt18->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid17); 
    $stmt18->fetch();
$ipc17[$j]=$cid17;	
    ?>
	<span><?php echo $cid17;?></span>
	<?php 
	$stmt18->close();
	?>
	</td>	
	
	<td>
	<?php
	//echo $dsr_id1;
 	$police_dsr->select_db("ftcaaazc_dsr");
	//$zero = '0';
	if ( !$stmt20= $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? ") ) //AND property_date BETWEEN ? AND ? AND dsr_theft_amount != ? 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->bind_param("iss", $idcheck, $datef, $date1) ) //, $datef, $date1
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt20->execute() ) 
    echo "Execute Error: ($stmt20->errno)  $stmt20->error";
    if ( !$stmt20->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt20->num_rows === 0) { echo "No Results"; }
    $stmt20->bind_result($cid18); 
    $stmt20->fetch();
	$ipc18[$j]=$cid18;
    ?>
	<span><?php echo $cid18;?></span>
	<?php 
	$stmt20->close();
	?>
	</td>
	
	<td> 
	<?php
	//echo $dsr_id1;
 	$police_dsr->select_db("ftcaaazc_dsr");
	//$zero = '0';
	if ( !$stmt21= $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date BETWEEN ? AND ? ") ) //AND property_date BETWEEN ? AND ? AND dsr_seized_amnt != ? 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->bind_param("iss", $idcheck, $datef, $date1) ) //, $datef, $date1
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt21->execute() ) 
    echo "Execute Error: ($stmt21->errno)  $stmt21->error";
    if ( !$stmt21->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt21->num_rows === 0) { echo "No Results"; }
    $stmt21->bind_result($cid19); 
    $stmt21->fetch();	
$ipc19[$j]=$cid19;	
    ?>
	<span><?php echo $cid19;?></span>
	<?php 
	$stmt21->close();
	?>
	</td>
	
  </tr>
   <?php } //stmt1 end here?>
     
	 <tr>	  
        <td colspan="2">INDORE ZONE TOTAL</td>
        <td>
	<?php $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10];
	echo $s;?></td>
	
    <td>
	<?php $n=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10];
	echo $n;?></td>
	
    <td>
	<?php $r=$ipc2[1]+$ipc2[2]+$ipc2[3]+$ipc2[4]+$ipc2[5]+$ipc2[6]+$ipc2[7]+$ipc2[8]+$ipc2[9]+$ipc2[10];
	echo $r;?></td>
	
    <td>
	<?php $t=$ipc3[1]+$ipc3[2]+$ipc3[3]+$ipc3[4]+$ipc3[5]+$ipc3[6]+$ipc3[7]+$ipc3[8]+$ipc3[9]+$ipc3[10];
	echo $t;?>
	</td>
    
	<td>
	<?php $u=$ipc4[1]+$ipc4[2]+$ipc4[3]+$ipc4[4]+$ipc4[5]+$ipc4[6]+$ipc4[7]+$ipc4[8]+$ipc4[9]+$ipc4[10];
	echo $u;?>
	</td>
	
    <td>
	<?php $v=$ipc5[1]+$ipc5[2]+$ipc5[3]+$ipc5[4]+$ipc5[5]+$ipc5[6]+$ipc5[7]+$ipc5[8]+$ipc5[9]+$ipc5[10];
	echo $v;?>
	</td>
	
    <td>
	<?php $w=$ipc6[1]+$ipc6[2]+$ipc6[3]+$ipc6[4]+$ipc6[5]+$ipc6[6]+$ipc6[7]+$ipc6[8]+$ipc6[9]+$ipc6[10];
	echo $w;?>
	</td>
	
    <td>
	<?php $x=$ipc7[1]+$ipc7[2]+$ipc7[3]+$ipc7[4]+$ipc7[5]+$ipc7[6]+$ipc7[7]+$ipc7[8]+$ipc7[9]+$ipc7[10];
	echo $x;?>
	</td>
	
    <td>
	<?php $y=$ipc8[1]+$ipc8[2]+$ipc8[3]+$ipc8[4]+$ipc8[5]+$ipc8[6]+$ipc8[7]+$ipc8[8]+$ipc8[9]+$ipc8[10];
	echo $y;?>
	</td>
    <td>
	<?php $z=$ipc9[1]+$ipc9[2]+$ipc9[3]+$ipc9[4]+$ipc9[5]+$ipc9[6]+$ipc9[7]+$ipc9[8]+$ipc9[9]+$ipc9[10];
	echo $z;?>
	</td>
        <td>
	<?php $z1=$ipc10[1]+$ipc10[2]+$ipc10[3]+$ipc10[4]+$ipc10[5]+$ipc10[6]+$ipc10[7]+$ipc10[8]+$ipc10[9]+$ipc10[10];
	echo $z1;?>
	</td>
		<td>
	<?php $z2=$ipc11[1]+$ipc11[2]+$ipc11[3]+$ipc11[4]+$ipc11[5]+$ipc11[6]+$ipc11[7]+$ipc11[8]+$ipc11[9]+$ipc11[10];
	echo $z2;?>
	</td>
        <td>
	<?php $z3=$ipc12[1]+$ipc12[2]+$ipc12[3]+$ipc12[4]+$ipc12[5]+$ipc12[6]+$ipc12[7]+$ipc12[8]+$ipc12[9]+$ipc12[10];
	echo $z3;?>
	</td>
       <td>
	<?php $z4=$ipc13[1]+$ipc13[2]+$ipc13[3]+$ipc13[4]+$ipc13[5]+$ipc13[6]+$ipc13[7]+$ipc13[8]+$ipc13[9]+$ipc13[10];
	echo $z4;?>
	</td>
        <td>
	<?php $z5=$ipc14[1]+$ipc14[2]+$ipc14[3]+$ipc14[4]+$ipc14[5]+$ipc14[6]+$ipc14[7]+$ipc14[8]+$ipc14[9]+$ipc14[10];
	echo $z5;?>
	</td>
       <td>
	<?php $z6=$ipc15[1]+$ipc15[2]+$ipc15[3]+$ipc15[4]+$ipc15[5]+$ipc15[6]+$ipc15[7]+$ipc15[8]+$ipc15[9]+$ipc15[10];
	echo $z6;?>
	</td>
		<td>
	<?php $z7=$ipc16[1]+$ipc16[2]+$ipc16[3]+$ipc16[4]+$ipc16[5]+$ipc16[6]+$ipc16[7]+$ipc16[8]+$ipc16[9]+$ipc16[10];
	echo $z7;?>
	</td>
        <td>
	<?php $z8=$ipc17[1]+$ipc17[2]+$ipc17[3]+$ipc17[4]+$ipc17[5]+$ipc17[6]+$ipc17[7]+$ipc17[8]+$ipc17[9]+$ipc17[10];
	echo $z8;?>
	</td>
        <td>
	<?php $z9=$ipc18[1]+$ipc18[2]+$ipc18[3]+$ipc18[4]+$ipc18[5]+$ipc18[6]+$ipc18[7]+$ipc18[8]+$ipc18[9]+$ipc18[10];
	echo $z9;?>
	</td>
        <td>
	<?php $z10=$ipc19[1]+$ipc19[2]+$ipc19[3]+$ipc19[4]+$ipc19[5]+$ipc19[6]+$ipc19[7]+$ipc19[8]+$ipc19[9]+$ipc19[10];
	echo $z10;?>
	</td>
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
 <script type="text/javascript">
var options = [];

$( '.dropdown-menu a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   console.log( options );
   return false;
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