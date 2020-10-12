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
<title>P-24 | File Tracking & Crime Analysis Application </title>
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
      <form action="format24.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<div class="">
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
   if(isset($_POST['Search'])!='')
   {
  ?>
<!--<p align="left" style="float:left;margin-left:-30px;">Format-24</p>-->
<p align="right"></p>
  <div class="mar10">
  <?php 
  
	$sp='SP';
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
    $stmt1->bind_param("s", $sp);
    $stmt1->execute();
    $stmt1->store_result();
    if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city);
 ?>
    <p align="center"><span>&nbsp;&nbsp;&nbsp;&nbsp; INFORMATION REGARDING MOB CRIMES INSPECTED BY EXPERT, SEARCH SLIPS OF ARRESTED PERSONS AND RECORD SLIPS OF CONVICTED PERSONS RECEIVED FROM DISTRICTS IN THE FINGER PRINT BUREAU BHOPAL<br /> DATE - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d/m/Y', strtotime($_POST['datef']));
}?> TO <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d/m/Y', strtotime($_POST['datel']));}?>&nbsp&nbspINDORE ZONE</span></p>
<br />
  <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  ?>
<br/>
    <table border="1" cellspacing="0" cellpadding="5" style="margin-left:30px;text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td rowspan="3" style="vertical-align:middle">S.NO</td>
        <td rowspan="3" style="vertical-align:middle">NAME OF THE DISTRICTS</td>
        <td rowspan="3">NO. OF CRIME MOB  REGD.</td>
        <td colspan="5">NO. SECENE OF CRIME INPECTED BU F.P. EXPERT </td>
        <td colspan="5">INFORMATION OF SEARCH SLIPS</td>
        <td colspan="4">INFORMATION OF RECORD SLIPS</td>
      </tr>
	  
      <tr>
	    <td rowspan="2">SCENES OF CRIME INSPECTED</td>
		<td rowspan="2">NO OF CASES CHANSE PRINTS FOUND</td>
		<td colspan="3">RESULTS</td>
		<td rowspan="2">NO OF SEARCH SLIPS RECEIVED</td>
		<td rowspan="2">NO OF SEARCH SLIPS OF MOB CRIMES</td>
		<td rowspan="2">NO OF SEARCH SLIPS OF NON MOB CRIMES</td>
		<td rowspan="2">TRACED IN  MOB/NON  MOB CRIMES</td>
		<td rowspan="2">NO OF SEARCH SLIPS SENT IN OBJECTION</td>
		<td rowspan="2">NO OF RECORD SLIPS RECEVED IN F.P.B.</td>
		<td rowspan="2">NO OF RECORD SLIPS RECEIVED OF MOB CRIMES</td>
		<td rowspan="2">NO OF  RECORD SLIPS RECEIVED OF NON MOB CRIMES</td>
		<td rowspan="2">NO OF RECORD SLIPS SENT IN OBJECTION</td>
	  </tr>
	  
	  <tr>
	    <td>IDENTICALS</td>
		<td>UNIDENTICAL</td>
		<td>UNFITFILED</td>
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
 	    $police_dsr->select_db("dsr");
		$murder = '1';
		if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
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
	    ?>
	    <span><?php echo $cid1;?></span>
	    <?php 
	    $stmt2->close();
	    ?>
	    </td>
    
	   <td>
	   <?php
 	   $police_dsr->select_db("dsr");
	   $at_murder = '2';
	   if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
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
       ?>
	   <span><?php echo $cid2;?></span>
	   <?php 
	   $stmt3->close();
	   ?>
	   </td>
	   
    <td>
	<?php
 	$police_dsr->select_db("dsr");
	$dacoity = '3';
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
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
    ?>
	<span><?php echo $cid3;?></span>
	<?php 
	$stmt4->close();
	?>
	</td>
	
    <td>
	<?php
 	$police_dsr->select_db("dsr");
	$pr_dacoity = '4';
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
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
    ?>
	<span><?php echo $cid4;?></span>
	<?php 
	$stmt5->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$robbery = '5';
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
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
    ?>
	<span><?php echo $cid5;?></span>
	<?php 
	$stmt6->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$kidnaping = '13';
	$kidnaping1 = '64';
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE  sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?") ) 
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
    ?>
	<span><?php echo $cid6;?></span>
	<?php 
	$stmt7->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$house_breaking = '7';
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
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
    ?>
	<span><?php echo $cid7;?></span>
	<?php 
	$stmt8->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$theft = '94';
	$theft1 = '9';
	if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("issii", $idcheck, $datef, $date1, $theft, $theft1 ) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
    if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid8); 
    $stmt9->fetch();		
    ?>
	<span><?php echo $cid8;?></span>
	<?php 
	$stmt9->close();
	?>
	</td>
    
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$cattle_theft = '8';
	if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? ") ) 
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
    ?>
	<span><?php echo $cid9;?></span>
	<?php 
	$stmt10->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$rape = '12';
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? ") ) 
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
    ?>
	<span><?php echo $cid10;?></span>
	<?php 
	$stmt11->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$riot = '11';
	if ( !$stmt12= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? ") ) 
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
    ?>
	<span><?php echo $cid11;?></span>
	<?php 
	$stmt12->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$molestation = '15';
	if ( !$stmt13= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? ") ) 
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
    ?>
	<span><?php echo $cid12;?></span>
	<?php 
	$stmt13->close();
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$other_ipc = '19';
	if ( !$stmt14= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? ") ) 
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
	?>
	</td>
	
	<td>
	<?php
 	$police_dsr->select_db("dsr");
	$kidnapping_child = '64';
	$kidnapping_ranson = " फिरौती के लिये ";
	if ( !$stmt15= $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? AND dsr_kdnp_rsn = ?") ) 
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
    ?>
	<span><?php echo $cid14;?></span>
	<?php 
	$stmt15->close();
	?>
	
  </tr>
   <?php } //stmt1 end here?>
     
	 <tr>	  
        <td colspan="2">INDORE ZONE TOTAL</td>
        <td></td>
        <td class=""></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
		<td></td>
        <td></td>
        <td></td>
        <td></td>
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