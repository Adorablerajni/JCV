<?php
require_once('../Connections/dbconnect-m.php');
if(!isset($_SESSION['MM_UserGroup'])) 
{ 
    header("location:../logout.php");
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Format-TOTAL-IPC | File Tracking & Crime Analysis Application </title>
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
      <form action="format-total-ipc.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format-Total-IPC</p>
<p align="right"></p>
  <div class="mar10">
  <?php   
    //if($_POST['sp_office'] == 0)	
	$sp='SP';
    $police_tracking->select_db("ftcaaazc_epfts");
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ? and zone = ?");
    $stmt1->bind_param("ss", $sp, $_SESSION['MM_Zone']);
    $stmt1->execute();
    $stmt1->store_result();
    //if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city);
  ?>
    <p align="center"><span>हत्या<br />दिनांक - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से  <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>&nbsp;&nbsp;तक &nbsp;&nbsp; इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $newDate1 =date ("Y-m-d", strtotime ($datef ."-16 days"));
  $newyear1=date ("Y", strtotime ($datef ."-16 days"));
  $newDate2 =date ("Y-m-d", strtotime ($datef ."-1 day")); 
  $newDate3 =date ("Y-m-d", strtotime ($datef ."-1 year"));
  $newyear2=date ("Y", strtotime ($datef ."-1 year"));
  $newDate4 =date ("Y-m-d", strtotime ($date1 ."-1 year"));
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td>जिला</td>
        <td>आलौच्य पक्ष</td>
        <td>गत पक्ष</td>
        <td>गत वर्ष का आलौच्य पक्ष</td>
		<td>कमी/वृद्धि का प्रतिषत</td>
      </tr>
	  
	  <?php 
	  $l=0;	 
	  while($stmt1->fetch())
	  {
	  $idcheck = $branch_id;
      $l++;
	  ?>
      <tr>
        <td><?php echo $l; ?></td>
		
        <td class=""><?php echo $branch_name; echo ","; echo $city;?></td>
        
		<td>
		<?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc='1';
		if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_vidhan_ipc = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->bind_param("iiss", $idcheck, $dsr_vidhan_ipc, $datef, $date1) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->execute() ) 
        echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	    if ( !$stmt2->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt2->num_rows === 0) { echo "No Results"; }
        $stmt2->bind_result($cid1); 
        $stmt2->fetch();
		$ip[$l]=$cid1;
	    ?>
	    <span><?php echo $cid1;?></span>
	    <?php 
	    $stmt2->close();
	    ?>
		</td>
		
		<td>
		<?php 
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_vidhan_ipc='1';
	if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->bind_param("issi",$branch_id,$newDate1,$newDate2,$dsr_vidhan_ipc) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
	if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid17); 
    $stmt17->fetch();
	$ip1[$l]=$cid17;
	?>
	<span><?php echo $cid17;?></span>
	<?php
	$stmt17->close();
	?>	
		</td>
		
        <?php if($newyear2 >='2018')
		{?>		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc='1';
	if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("issi",$branch_id,$newDate3, $newDate4,$dsr_vidhan_ipc) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt18->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid18); 
    $stmt18->fetch();
	$ip2[$l]=$cid18;
	?>
	<span><?php echo $cid18;?></span>
	<?php
	$stmt18->close();
	?>		
	</td>	
		<?php 
		}    //if($newyear2=='2018') end here
	else{
		?>
		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc='1';
	if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND (start_date >= ? and start_date <= ?) AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("issi",$branch_id,$newDate3, $newDate4,$dsr_vidhan_ipc) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt18->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid18); 
    $stmt18->fetch();
	$ip2[$l]=$cid18;
	?>
	<span><?php echo $cid18;?></span>
	<?php
	$stmt18->close();
	?>	
	</td>
	<?php }//else close ?>
		
		<td>
		<?php
if($ip2[$l] > 0)
{	
$percentage9 =($ip[$l]-$ip2[$l])*100/$ip2[$l] ;
echo ROUND(ABS($percentage9),2); echo "%";
}
else
{	
echo "0%";	
}	
?>
		</td>
        
      </tr>
      <?php } //stmt1 end here?>
      <tr>
	    <td colspan="2">जोन का योग</td>
		
        <td><?php 
    $v=$ip[1]+$ip[2]+$ip[3]+$ip[4]+$ip[5]+$ip[6]+$ip[7]+$ip[8]+$ip[9]+$ip[10];
	echo $v;
	?></td>
		
        <td class=""><?php 
    $t=$ip1[1]+$ip1[2]+$ip1[3]+$ip1[4]+$ip1[5]+$ip1[6]+$ip1[7]+$ip1[8]+$ip1[9]+$ip1[10];
	echo $t;
	?></td>
		
        <td><?php 
    $u=$ip2[1]+$ip2[2]+$ip2[3]+$ip2[4]+$ip2[5]+$ip2[6]+$ip2[7]+$ip2[8]+$ip2[9]+$ip2[10];
	echo $u;
	?></td>
		
		<td>
		<?php
 	    if($u > 0)
{	
$percentage59 =($v-$u)*100/$u ;
echo ROUND(ABS($percentage59),2); echo "%";
}
else
{	
echo "0%";	
}
	    ?>
		</td>
		
      </tr>
    </table>
    
    <br /><br />
  
    <br /><br />
	
	<!-- Second Table --> 
	
	<?php   	
	$sp='SP';
	$police_tracking->select_db("ftcaaazc_epfts");
	$stmt11 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ? AND zone=?");
    $stmt11->bind_param("ss", $sp , $_SESSION['MM_Zone']);
    $stmt11->execute();
    $stmt11->store_result();
    //if($stmt11->num_rows === 0) exit('No rows');
    $stmt11->bind_result($branch_id1, $branch_name1, $city1);
  ?>
    <p align="center"><span>हत्या का प्रयास<br />दिनांक - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से  <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> &nbsp;&nbsp;तक &nbsp;&nbsp; इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $zero ='0';
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td>जिला</td>
        <td>आलौच्य पक्ष</td>
        <td>गत पक्ष</td>
        <td>गत वर्ष का आलौच्य पक्ष</td>
		<td>कमी/वृद्धि का प्रतिषत</td>
      </tr>
	  
	  <?php 
	  $j=0;	 
	  while($stmt11->fetch())
	  {
	  $idcheck1 = $branch_id1;
      $j++;
	  ?>
      <tr>
        <td><?php echo $j; ?></td>
		
        <td class=""><?php echo $branch_name1; echo ","; echo $city1;?></td>
        
		<td>
		<?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2='2';
		if ( !$stm2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_vidhan_ipc = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stm2->bind_param("iiss", $idcheck1, $dsr_vidhan_ipc2, $datef, $date1) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stm2->execute() ) 
        echo "Execute Error: ($stm2->errno)  $stm2->error";
	    if ( !$stm2->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stm2->num_rows === 0) { echo "No Results"; }
        $stm2->bind_result($ci2); 
        $stm2->fetch();
		$ipc[$j]=$ci2;
	    ?>
	    <span><?php echo $ci2;?></span>
	    <?php 
	    $stm2->close();
	    ?>
		</td>
		
		<td>
		<?php 
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_vidhan_ipc2='2';
	if ( !$stm17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stm17->bind_param("issi",$branch_id1,$newDate1,$newDate2,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stm17->execute() ) 
    echo "Execute Error: ($stm17->errno)  $stm17->error";
	if ( !$stm17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stm17->bind_result($ci3); 
    $stm17->fetch();
	$ipc1[$j]=$ci3;
	?>
	<span><?php echo $ci3;?></span>
	<?php
	$stm17->close();
	?>	
		</td>
		
        <?php if($newyear2 >='2018')
		{?>		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2='2';
	if ( !$stm18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stm18->bind_param("issi",$branch_id1,$newDate3, $newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stm18->execute() ) 
    echo "Execute Error: ($stm18->errno)  $stm18->error";
	if ( !$stm18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stm18->num_rows === 0) { echo "No Results"; }
    $stm18->bind_result($ci4); 
    $stm18->fetch();
	$ipc2[$j]=$ci4;
	?>
	<span><?php echo $ci4;?></span>
	<?php
	$stm18->close();
	?>	
	</td>	
		<?php 
		}    //if($newyear2=='2018') end here
	else{
		?>
		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2='2';
	if ( !$stm18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE district = ? AND (start_date >= ? and start_date <= ?) AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stm18->bind_param("issi",$branch_id1,$newDate3, $newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stm18->execute() ) 
    echo "Execute Error: ($stm18->errno)  $stm18->error";
	if ( !$stm18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stm18->num_rows === 0) { echo "No Results"; }
    $stm18->bind_result($ci4); 
    $stm18->fetch();
	$ipc2[$j]=$ci4;
	?>
	<span><?php echo $ci4;?></span>
	<?php
	$stm18->close();
	?>		
	</td>
	<?php }//else close ?>
		
		<td>
		<?php
if($ipc2[$j] > 0)
{	
$percentage19 =($ipc[$j]-$ipc2[$j])*100/$ipc2[$j] ;
echo ROUND(ABS($percentage19),2); echo "%";
}
else
{	
echo "0%";	
}	
?>
		</td>
        
      </tr>
      <?php } //stmt1 end here?>
      <tr>
	    <td colspan="2">जोन का योग</td>     
        
        <td><?php 
    $v1=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10];
	echo $v1;
	?></td>
		
        <td class=""><?php 
    $t1=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10];
	echo $t1;
	?></td>
		
        <td><?php 
    $u1=$ipc2[1]+$ipc2[2]+$ipc2[3]+$ipc2[4]+$ipc2[5]+$ipc2[6]+$ipc2[7]+$ipc2[8]+$ipc2[9]+$ipc2[10];
	echo $u1;
	?></td>
		
		<td><?php 
		if($u1 > 0)
{	
$percentage69 =($v1-$u1)*100/$u1 ;
echo ROUND(ABS($percentage69),2); echo "%";
}
else
{	
echo "0%";	
}
		?>
		</td>	
		
      </tr>
    </table>

	<br /><br />
	
	<!-- Third Table --> 
	
	<?php   	
	$dig='DIG';
	$police_tracking->select_db("ftcaaazc_epfts");
	$stmt21 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
    $stmt21->bind_param("s", $dig);
    $stmt21->execute();
    $stmt21->store_result();
    //if($stmt21->num_rows === 0) exit('No rows');
    $stmt21->bind_result($branch_id2, $branch_name2, $city2);
  ?>
    <p align="center"><span>हत्या का प्रयास<br />दिनांक - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से  <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>&nbsp;&nbsp;तक &nbsp;&nbsp; इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $zero ='0';
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td>जिला</td>
        <td>आलौच्य पक्ष</td>
        <td>गत पक्ष</td>
        <td>गत वर्ष का आलौच्य पक्ष</td>
		<td>कमी/वृद्धि का प्रतिषत</td>
      </tr>
	  
	  <tr>
	<td>1</td>
	<td>इन्दौर शहर</td>
        
		<td>
		<?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		 $id1='6';
	     $id2='7';
	     $id3='8';
		if ( !$st12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_vidhan_ipc = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st12->bind_param("iiiiss",$id1,$id2,$id3, $dsr_vidhan_ipc2, $datef, $date1) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st12->execute() ) 
        echo "Execute Error: ($st12->errno)  $st12->error";
	    if ( !$st12->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt2->num_rows === 0) { echo "No Results"; }
        $st12->bind_result($c2); 
        $st12->fetch();
	    ?>
	    <span><?php echo $c2;?></span>
	    <?php 
	    $st12->close();
	    ?>
		</td>
		
		<td>
		<?php 
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_vidhan_ipc2='2';
	   $id1='6';
	  $id2='7';
	  $id3='8';
	if ( !$st17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st17->bind_param("iiissi",$id1,$id2,$id3,$newDate1,$newDate2,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st17->execute() ) 
    echo "Execute Error: ($st17->errno)  $st17->error";
	if ( !$st17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $st17->bind_result($c3); 
    $st17->fetch();
	?>
	<span><?php echo $c3;?></span>
	<?php
	$st17->close();
	?>	
		</td>
		
        <?php if($newyear2 >='2018')
		{?>		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		 $id1='6';
	  $id2='7';
	  $id3='8';
	if ( !$st18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st18->bind_param("iiissi",$id1,$id2,$id3,$newDate3, $newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st18->execute() ) 
    echo "Execute Error: ($st18->errno)  $st18->error";
	if ( !$st18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($st18->num_rows === 0) { echo "No Results"; }
    $st18->bind_result($c4); 
    $st18->fetch();
	?>
	<span><?php echo $c4;?></span>
	<?php
	$st18->close();
	?>	
	</td>	
		<?php 
		}    //if($newyear2=='2018') end here
	else{
		?>
		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		 $id1='6';
	  $id2='7';
	  $id3='8';
	if ( !$st18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE (district = ? OR district = ? OR district = ?) AND (start_date >= ? and start_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st18->bind_param("iiissi",$id1,$id2,$id3,$newDate3,$newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st18->execute() ) 
    echo "Execute Error: ($st18->errno)  $st18->error";
	if ( !$st18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($st18->num_rows === 0) { echo "No Results"; }
    $st18->bind_result($c4); 
    $st18->fetch();
	?>
	<span><?php echo $c4;?></span>
	<?php
	$st18->close();
	?>	
	</td>
	<?php }//else close ?>
		
		<td>
		<?php
if($c4 > 0)
{	
$percentage29 =($c2-$c4)*100/$c4 ;
echo ROUND(ABS($percentage29),2); echo "%";
}
else
{	
echo "0%";	
}	
?>
		</td>        
   
      </tr>
	    
		<tr>	
	<td>2</td>
	
	<td>इन्दौर रेंज ग्रामीण</td>
        
		<td>
		<?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		 $id4='9';
	     $id5='10';
	     $id6='11';
		if ( !$stt12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_vidhan_ipc = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stt12->bind_param("iiiiss",$id4,$id5,$id6, $dsr_vidhan_ipc2, $datef, $date1) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stt12->execute() ) 
        echo "Execute Error: ($stt12->errno)  $stt12->error";
	    if ( !$stt12->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt2->num_rows === 0) { echo "No Results"; }
        $stt12->bind_result($c5); 
        $stt12->fetch();
	    ?>
	    <span><?php echo $c5;?></span>
	    <?php 
	    $stt12->close();
	    ?>
		</td>
		
		<td>
		<?php 
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_vidhan_ipc2 = '2';
	  $id4='9';
	  $id5='10';
	  $id6='11';
	if ( !$stt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stt17->bind_param("iiissi",$id4,$id5,$id6,$newDate1,$newDate2,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stt17->execute() ) 
    echo "Execute Error: ($stt17->errno)  $stt17->error";
	if ( !$stt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stt17->bind_result($c6); 
    $stt17->fetch();
	?>
	<span><?php echo $c6;?></span>
		<?php
		$stt17->close();
		?>
		</td>
		
        <?php if($newyear2 >='2018')
		{?>		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		$id4='9';
	  $id5='10';
	  $id6='11';
	if ( !$stt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stt18->bind_param("iiissi",$id4,$id5,$id6,$newDate3,$newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stt18->execute() ) 
    echo "Execute Error: ($stt18->errno)  $stt18->error";
	if ( !$stt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stt18->num_rows === 0) { echo "No Results"; }
    $stt18->bind_result($c7); 
    $stt18->fetch();
	?>
	<span><?php echo $c7;?></span>
		<?php
		$stt18->close();
		?>	
	</td>	
		<?php 
		}    //if($newyear2=='2018') end here
	else{
		?>
		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		$id4='9';
	  $id5='10';
	  $id6='11';
	if ( !$stt18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE (district = ? OR district = ? OR district = ?) AND (start_date >= ? and start_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stt18->bind_param("iiissi",$id4,$id5,$id6,$newDate3, $newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stt18->execute() ) 
    echo "Execute Error: ($stt18->errno)  $stt18->error";
	if ( !$stt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stt18->num_rows === 0) { echo "No Results"; }
    $stt18->bind_result($c7); 
    $stt18->fetch();
	?>
	<span><?php echo $c7;?></span>
		<?php
		$stt18->close();
		?>	
	</td>
	<?php }//else close ?>
		
		<td>
		<?php
if($c7 > 0)
{	
$percentage39 =($c5-$c7)*100/$c7 ;
echo ROUND(ABS($percentage39),2); echo "%";
}
else
{	
echo "0%";	
}	
?>
		</td>        
        
      </tr>
	  
	    <tr>
	<td>3</td>
	
	<td>निमाड़ रेंज</td>
        
		<td>
		<?php
 	    $police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		  $id7='12';
	  $id8='13';
	  $id9='14';
	  $id10='15';
		if ( !$s12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ? OR sp_id=?) AND dsr_vidhan_ipc = ? AND 	 (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) ") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$s12->bind_param("iiiiiss",$id7,$id8,$id9,$id10, $dsr_vidhan_ipc2, $datef, $date1) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$s12->execute() ) 
        echo "Execute Error: ($s12->errno)  $s12->error";
	    if ( !$s12->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt2->num_rows === 0) { echo "No Results"; }
        $s12->bind_result($c8); 
        $s12->fetch();
	    ?>
	    <span><?php echo $c8;?></span>
	    <?php 
	    $s12->close();
	    ?>
		</td>

		<td>
		<?php 
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_vidhan_ipc2 = '2';
	   $id7='12';
	  $id8='13';
	  $id9='14';
	  $id10='15';
	if ( !$s17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ? OR sp_id=?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$s17->bind_param("iiiissi",$id7,$id8,$id9,$id10,$newDate1,$newDate2,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$s17->execute() ) 
    echo "Execute Error: ($s17->errno)  $s17->error";
	if ( !$s17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $s17->bind_result($c9); 
    $s17->fetch();
	?>
	<span><?php echo $c9;?></span>
	    <?php 
	    $s17->close();
	    ?>		
		</td>		
		
        <?php if($newyear2 >='2018')
		{?>		
		
		<td>
		<?php 
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_vidhan_ipc2 = '2';
	   $id7='12';
	  $id8='13';
	  $id9='14';
	  $id10='15';
	if ( !$s18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ? OR sp_id=?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$s18->bind_param("iiiissi",$id7,$id8,$id9,$id10,$newDate3,$newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$s18->execute() ) 
    echo "Execute Error: ($s18->errno)  $s18->error";
	if ( !$s18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $s18->bind_result($c10); 
    $s18->fetch();
	?>
	<span><?php echo $c10;?></span>
	    <?php 
	    $s18->close();
	    ?>		
		</td>
		<?php 
		}    //if($newyear2=='2018') end here
	else{
		?>
		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_vidhan_ipc2 = '2';
		 $id7='12';
	  $id8='13';
	  $id9='14';
	  $id10='15';
	if ( !$s18 = $police_dsr->prepare("SELECT SUM(crime) FROM old_records WHERE (district = ? OR district = ? OR district = ? OR district = ?) AND (start_date >= ? and start_date <= ?) AND dsr_vidhan_ipc=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$s18->bind_param("iiiissi",$id7,$id8,$id9,$id10,$newDate3, $newDate4,$dsr_vidhan_ipc2) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$s18->execute() ) 
    echo "Execute Error: ($s18->errno)  $s18->error";
	if ( !$s18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($s18->num_rows === 0) { echo "No Results"; }
    $s18->bind_result($c10); 
    $s18->fetch();
	?>
	<span><?php echo $c10;?></span>
	<?php
	$s18->close();
	?>	
	</td>
	<?php }//else close ?>
		
		<td>
		<?php
if($c10 > 0)
{	
$percentage49 =($c8-$c10)*100/$c10 ;
echo ROUND(ABS($percentage49),2); echo "%";
}
else
{	
echo "0%";	
}	
?>
		</td>        
        
      </tr>
      <tr>
	    <td colspan="2">जोन का योग</td>  
		
        <td><?php $s1=$c2+$c5+$c8;
		echo $s1;?>
		</td>
		
        <td><?php $s2=$c3+$c6+$c9;
		echo $s2;?>
		</td>
		
        <td><?php $s3=$c4+$c7+$c10;
		echo $s3;?>
		</td>  
		
        <td>
		<?php
if($s3 > 0)
{	
$percentage79 =($s1-$s3)*100/$s3 ;
echo ROUND(ABS($percentage79),2); echo "%";
}
else
{	
echo "0%";	
}	
?>
		</td>
		
      </tr>
    </table>
	
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
