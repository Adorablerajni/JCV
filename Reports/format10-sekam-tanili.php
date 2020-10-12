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
<title>Format-10-sekam-tanili | File Tracking & Crime Analysis Application </title>
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
      <form action="format10-sekam-tanili.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">    
        <div class="col-lg-12 navStuff">  &nbsp; 
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
<div class="notice_all">
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
   if(isset($_POST['Search'])!='')
   {
  ?>

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
    <p align="center"><span>समंस वारंट माह वारंट  दिनांक. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> तक  तामीली प्रतिशत चार्ट इंदौर जोन इंदौर</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
		<td>शीर्ष</td>
        <td>जनता समंस</td>
        <td>जनता जमानती वारण्ट</td>
        <td>जनता गिरफ्तारी वारण्ट</td>
		<td>समंस कर्म-</td>
		<td>जमानती वारण्ट कर्म-</td>
		<td>गिरफ्तारी वारण्ट कर्म-</td>
		<td>स्थाई वारण्ट</td>
      </tr>
	  
	  <tr>
        <td>(1)</td>
		<td>(2)</td>
		<td>(3)</td>
		<td>(4)</td>
		<td>(5)</td>
		<td>(6)</td>
		<td>(7)</td>
		<td>(8)</td>
		<td>(9)</td>
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
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type='समंस';
	$aaropi_type='जनता';
	$sub_id='No';
	$tamil_date='';
	if ( !$stmt2 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?  AND aaropi_type = ?") )  //SELECT COUNT(id) FROM summon_list WHERE office_id = ? AND warrant_type = ? AND ((creation_date < ? OR tamil_date > ? ) OR (creation_date < ? AND (tamil_date is null OR tamil_date = ?))) AND sub_id=? AND aaropi_type=?
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt2->bind_param("issssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id, $aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid1);
    $stmt2->fetch();
	$ipc[$j]=$cid1;
	?>
	<?php 
	if ( !$stmt3 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=? AND aaropi_type=?") )//AND (tamil_date is null OR tamil_date = ?) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt3->bind_param("isssss",$branch_id, $warrant_type, $datef, $date1,$sub_id,$aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid2); 
    $stmt3->fetch();
	$ipc1[$j]=$cid2;
	?>
	<?php
		$sum=$cid1+$cid2;
		$ipc2[$j]=$sum;
		?>
		
		<?php
	if ( !$stmt4 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type=? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt4->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid3); 
    $stmt4->fetch();
	$ipc3[$j]=$cid3;
	?>
	<?php 
$x = $cid3;
$y = $sum; 
if($y!=0){
$percent = $x/$y;
}
else
{
	$percent = 0 ;
}
$percent_friendly = number_format( $percent * 100, 2 ) . ' %' ; 
echo $percent_friendly ;
?>
		</td>
       
         <td>
		<?php
    $police_summons->select_db("ftcaaazc_summons");
	$warrant_type='जमानती वारंट';
	$aaropi_type='जनता';
	$sub_id='No';
    $tamil_date='';	
	if ( !$stmt5 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?  AND aaropi_type = ?") )  //SELECT COUNT(id) FROM summon_list WHERE office_id = ? AND warrant_type = ? AND ((creation_date < ? OR tamil_date > ? ) OR (creation_date < ? AND (tamil_date is null OR tamil_date = ?))) AND sub_id=? AND aaropi_type=?
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt5->bind_param("issssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id, $aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid4);
    $stmt5->fetch();
	$ipc[$j]=$cid4;
	?>
	<?php 
	if ( !$stmt6 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=? AND aaropi_type=?") )//AND (tamil_date is null OR tamil_date = ?) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt6->bind_param("isssss",$branch_id, $warrant_type, $datef, $date1,$sub_id,$aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid5); 
    $stmt6->fetch();
	$ipc1[$j]=$cid5;
	?>
	<?php
		$sum1=$cid4+$cid5;
		$ipc2[$j]=$sum1;
		?>
		
		<?php
	if ( !$stmt7 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type=? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt7->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid6); 
    $stmt7->fetch();
	$ipc3[$j]=$cid6;
	?>
	<?php 
$x1 = $cid6;
$y1 = $sum1; 
if($y1!=0){
$percent = $x1/$y1;
}
else
{
	$percent = 0 ;
}
$percent_friendly = number_format( $percent * 100, 2 ) . ' %' ; 
echo $percent_friendly ;
?>
		</td>
	    
		 <td>	
		<?php
    $police_summons->select_db("ftcaaazc_summons");
	$warrant_type='गिरफ़्तारी वारंट';
	$aaropi_type='जनता';
	$sub_id='No';
    $tamil_date='';	
	if ( !$stmt8 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?  AND aaropi_type = ?") )  //SELECT COUNT(id) FROM summon_list WHERE office_id = ? AND warrant_type = ? AND ((creation_date < ? OR tamil_date > ? ) OR (creation_date < ? AND (tamil_date is null OR tamil_date = ?))) AND sub_id=? AND aaropi_type=?
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt8->bind_param("issssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id, $aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid7);
    $stmt8->fetch();
	$ipc[$j]=$cid7;
	?>
	<?php 
	if ( !$stmt9 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=? AND aaropi_type=?") )//AND (tamil_date is null OR tamil_date = ?) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt9->bind_param("isssss",$branch_id, $warrant_type, $datef, $date1,$sub_id,$aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid8); 
    $stmt9->fetch();
	$ipc1[$j]=$cid8;
	?>
	<?php
		$sum2=$cid7+$cid8;
		$ipc2[$j]=$sum2;
		?>
		
		<?php
	if ( !$stmt10 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type=? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt10->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid9); 
    $stmt10->fetch();
	$ipc3[$j]=$cid9;
	?>
	<?php 
$x2 = $cid9;
$y2 = $sum2;
if($y2!=0){
$percent2 = $x2/$y2;
}
else
{
	$percent2 = 0 ;
}
$percent_friendly2 = number_format( $percent2 * 100, 2 ) . ' %' ; 
echo $percent_friendly2 ;
?>
	</td>
	
		<td>
			<?php 
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type='समंस';
	$aaropi_type='पुलिस कर्मचारी';
	$sub_id='No';
	$tamil_date='';
	if ( !$stmt11 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?  AND aaropi_type = ?") )  //SELECT COUNT(id) FROM summon_list WHERE office_id = ? AND warrant_type = ? AND ((creation_date < ? OR tamil_date > ? ) OR (creation_date < ? AND (tamil_date is null OR tamil_date = ?))) AND sub_id=? AND aaropi_type=?
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt11->bind_param("issssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id, $aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
	if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid10);
    $stmt11->fetch();
	$ipc[$j]=$cid10;
	?>
	<?php 
	if ( !$stmt12 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=? AND aaropi_type=?") )//AND (tamil_date is null OR tamil_date = ?) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt12->bind_param("isssss",$branch_id, $warrant_type, $datef, $date1,$sub_id,$aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt12->execute() ) 
    echo "Execute Error: ($stmt12->errno)  $stmt12->error";
	if ( !$stmt12->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt12->bind_result($cid11); 
    $stmt12->fetch();
	$ipc1[$j]=$cid11;
	?>
	<?php
		$sum3=$cid10+$cid11;
		$ipc2[$j]=$sum3;
		?>
		
		<?php
	if ( !$stmt13 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type=? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt13->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
	if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid12); 
    $stmt13->fetch();
	$ipc3[$j]=$cid12;
	?>
	<?php 
$x3 = $cid12;
$y3 = $sum3;
if($y3!=0){
$percent3 = $x3/$y3;
}
else
{
	$percent3 = 0 ;
}
$percent_friendly3 = number_format( $percent3 * 100, 2 ) . ' %' ; 
echo $percent_friendly3 ;
?>
	</td>
	
		<td>
	<?php 
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type='जमानती वारंट';
	$aaropi_type='पुलिस कर्मचारी';
	$sub_id='No';
	$tamil_date='';
	if ( !$stmt14 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?  AND aaropi_type = ?") )  //SELECT COUNT(id) FROM summon_list WHERE office_id = ? AND warrant_type = ? AND ((creation_date < ? OR tamil_date > ? ) OR (creation_date < ? AND (tamil_date is null OR tamil_date = ?))) AND sub_id=? AND aaropi_type=?
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt14->bind_param("issssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id, $aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
	if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid13);
    $stmt14->fetch();
	$ipc[$j]=$cid13;
	?>
	<?php 
	if ( !$stmt15 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=? AND aaropi_type=?") )//AND (tamil_date is null OR tamil_date = ?) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt15->bind_param("isssss",$branch_id, $warrant_type, $datef, $date1,$sub_id,$aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt15->execute() ) 
    echo "Execute Error: ($stmt15->errno)  $stmt15->error";
	if ( !$stmt15->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt15->bind_result($cid14); 
    $stmt15->fetch();
	$ipc1[$j]=$cid14;
	?>
	<?php
		$sum4=$cid13+$cid14;
		$ipc2[$j]=$sum4;
		?>
		<?php
	if ( !$stmt16 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type=? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt16->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt16->execute() ) 
    echo "Execute Error: ($stmt16->errno)  $stmt16->error";
	if ( !$stmt16->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt16->bind_result($cid15); 
    $stmt16->fetch();
	$ipc3[$j]=$cid15;
	?>
	<?php 
$x4 = $cid15;
$y4 = $sum4;
if($y4!=0){
$percent4 = $x4/$y4;
}
else
{
	$percent4 = 0 ;
}
$percent_friendly4 = number_format( $percent4 * 100, 2 ) . ' %' ; 
echo $percent_friendly4 ;
?>
	</td>
	 
	   <td>
	<?php
    $police_summons->select_db("ftcaaazc_summons");
	$warrant_type='गिरफ़्तारी वारंट';
	$aaropi_type='पुलिस कर्मचारी';
	$sub_id='No';
    $tamil_date='';	
	if ( !$stmt17 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?  AND aaropi_type = ?") )
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt17->bind_param("issssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id, $aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
	if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid16);
    $stmt17->fetch();
	$ipc[$j]=$cid16;
	
	?>
	<?php 
	if ( !$stmt18 = $police_summons->prepare("SELECT  COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=? AND aaropi_type=?") ) //AND (tamil_date is null OR tamil_date = ?)
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt18->bind_param("isssss",$branch_id, $warrant_type, $datef, $date1,$sub_id,$aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid17); 
    $stmt18->fetch();
	$ipc1[$j]=$cid17;
	
	?>
	<?php
		$sum5=$cid16+$cid17;
		$ipc2[$j]=$sum5;
		?>
		
		<?php
if ( !$stmt19 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type=? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt19->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt19->execute() ) 
    echo "Execute Error: ($stmt19->errno)  $stmt19->error";
	if ( !$stmt19->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt19->bind_result($cid18); 
    $stmt19->fetch();
	$ipc3[$j]=$cid18;
	?>
	<?php 
 $x5 = $cid18;
  $y5 = $sum5;
if($y5!=0){
$percent5 = $x5/$y5;
}
else
{
	$percent5 = 0 ;
}
$percent_friendly5 = number_format( $percent5 * 100, 2 ) . ' %' ; 
echo $percent_friendly5 ;
?>
	</td>
	
        
       <td>
	<?php 
	$warrant_type='स्थाई वारंट';
	$sub_id='No';
	$tamil_date='';
	if ( !$stmt20 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?") )
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt20->bind_param("isssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt20->execute() ) 
    echo "Execute Error: ($stmt20->errno)  $stmt20->error";
	if ( !$stmt20->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt20->bind_result($cid19);
    $stmt20->fetch();
	$ipc[$j]=$cid19;
	?>
	<?php 
	if ( !$stmt21 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=?") ) //AND (tamil_date is null OR tamil_date = ?)
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt21->bind_param("issss",$branch_id, $warrant_type, $datef, $date1,$sub_id) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt21->execute() ) 
    echo "Execute Error: ($stmt21->errno)  $stmt21->error";
	if ( !$stmt21->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt21->bind_result($cid20); 
    $stmt21->fetch();
	$ipc1[$j]=$cid20;
	?>
	<?php
		$sum6=$cid19+$cid20;
		$ipc2[$j]=$sum6;
		?>
	
		<?php
	if ( !$stmt22 = $police_summons->prepare("SELECT COUNT(id)  FROM summon_list WHERE sp_id = ? AND warrant_type = ?  AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt22->bind_param("issssssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt22->execute() ) 
    echo "Execute Error: ($stmt22->errno)  $stmt22->error";
	if ( !$stmt22->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt22->bind_result($cid21); 
    $stmt22->fetch();
	$ipc3[$j]=$cid21;
	$stmt22->close();
	?>

	<?php 
        $x51 = $cid21;
        $y51 = $sum6;
        if($y51!=0)
        {
        $percent51 = $x51/$y51;
        }
        else
        {
            $percent51 = 0 ;
        }
        $percent_friendly51 = number_format( $percent51 * 100, 2 ) . ' %' ; 
        echo $percent_friendly51 ;
        ?>
	</td>
        
      </tr>
	  
      <?php } //stmt1 end here?>
	
    </table>
    
    <br /><br />
  
    <br /><br />
   <?php $stmt1->close();?>
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
