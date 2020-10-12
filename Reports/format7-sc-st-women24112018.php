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
<title>Format-7-sc-st-women | File Tracking & Crime Analysis Application </title>
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
      <form action="format7-sc-st-women.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format7-sc-st-women</p>
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
    <p align="center"><span>अनूसूचित जाति/जनजाति पर घटित अपराध-अत्या. निवारण अधि. के प्रकरण एवं महिलाओं पर घटित अपराध का नक्शा इंदौर जोन इंदौर <br /> दिनांक <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>&nbsp;तक  इन्दौर जोन</span></p>
 <br />
 <?php	  
 $atyachar ='हाँ';
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $newDate1 =date ("Y-m-d", strtotime ($datef ."-16 days"));
  $newyear1=date ("Y", strtotime ($datef ."-16 days"));
  $newDate2 =date ("Y-m-d", strtotime ($datef ."-1 day")); 
  $newDate3 =date ("Y-m-d", strtotime ($datef ."-1year"));
  $newyear2=date ("Y", strtotime ($datef ."-1year"));
  $newDate4 =date ("Y-m-d", strtotime ($date1 ."-1year"));
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
      <tr>
        <td rowspan="3">क्र.</td>
        <td rowspan="3">जिला</td>
        <td colspan="6">अत्याचार निवारण अधिनियम के अंतग्र्रत पंजीबद्ध अपराध</td>
        <td colspan="3"> महिलाओं पर घटित अपराध</td>
      </tr>
      
	  <tr>
      <td colspan="3">अ.जा. </td>
      <td colspan="3">अ.ज.जा.</td>
	  <td colspan="3"></td>
      </tr>
	  <tr>
	  <td> आलौच्य पक्ष</td>
	  <td>गत  पक्ष</td>
	  <td>गत वर्ष का आलौच्य पक्ष</td>
	  <td> आलौच्य पक्ष</td>
	  <td>गत  पक्ष</td>
	  <td>गत वर्ष का आलौच्य पक्ष</td>
	  <td> आलौच्य पक्ष</td>
	  <td>गत  पक्ष</td>
	  <td>गत वर्ष का आलौच्य पक्ष</td>
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
	 $dsr_caste='SC';
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam =?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid2); 
    $stmt2->fetch();
	$ipc[$j]=$cid2;
	?>
	<span><?php echo $cid2;?></span>
		</td> 
		
		<td>
		<?php 
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste='SC';
	if ( !$stmt17 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam =?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->bind_param("issss",$branch_id,$newDate1,$newDate2,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt17->execute() ) 
    echo "Execute Error: ($stmt17->errno)  $stmt17->error";
	if ( !$stmt17->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt17->bind_result($cid17); 
    $stmt17->fetch();
	$ip1[$j]=$cid17;
	?>
	<span><?php echo $cid17;?></span>
		</td>
		
        <?php if($newyear2=='2018')
		{?>		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_caste='SC';
	if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam =?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("issss",$branch_id,$newDate3, $newDate4,$dsr_caste, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt18->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid18); 
    $stmt18->fetch();
	$ip2[$j]=$cid18;
	?>
	<span><?php echo $cid18;?></span>
	</td>	
		<?php 
		}    //if($newyear2=='2018') end here
	else{?>
		
		<td>0
		<?php
$ip2[$j] = 0 ;		
		/*$police_dsr->select_db("dsr");
		$dsr_caste="SC";
	 $atyachar_adhiniyam='NULL';
	if ( !$stmt18 = $police_dsr->prepare("SELECT COUNT(id) FROM old_records WHERE district = ? AND ( start_date >= ? and start_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam!=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->bind_param("issss",$branch_id,$newDate3, $newDate4,$dsr_caste,$atyachar_adhiniyam) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt18->execute() ) 
    echo "Execute Error: ($stmt18->errno)  $stmt18->error";
	if ( !$stmt18->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt18->num_rows === 0) { echo "No Results"; }
    $stmt18->bind_result($cid18); 
    $stmt18->fetch();
	$ip2[$j]=$cid18;*/
	?>
	<span><?php// echo $cid18;?></span>
	</td><?php }//else close ?>
	
	
		<td>
			<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste1='ST';
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam =?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("issss",$branch_id,$datef, $date1,$dsr_caste1, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid3); 
    $stmt3->fetch();
	$ipc1[$j]=$cid3;
	?>
	<span><?php echo $cid3;?></span>
		</td>
		
		<td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_caste1='ST';
	if ( !$stmt13 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam =?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->bind_param("issss",$branch_id,$newDate1, $newDate2,$dsr_caste1, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt13->execute() ) 
    echo "Execute Error: ($stmt13->errno)  $stmt13->error";
	if ( !$stmt13->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt13->num_rows === 0) { echo "No Results"; }
    $stmt13->bind_result($cid13); 
    $stmt13->fetch();
	$ip3[$j]=$cid13;
	?>
	<span><?php echo $cid13;?></span>
		</td>
		
		 <?php if($newyear2=='2018')
		{?>		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		$dsr_caste1='ST';
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_caste=? AND atyachar_adhiniyam =?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("issss",$branch_id,$newDate3, $newDate4,$dsr_caste1, $atyachar) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt8->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();
	$ip4[$j]=$cid8;
	?>
	<span><?php echo $cid8;?></span>
	</td>	
		<?php 
		}    //if($newyear2=='2018') end here
	else{
		?>
		<td>0<?php $ip4[$j]=0; ?></td>
		<?php }//else close ?>
		
		<td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_gender='महिला';
	  $dsr_caste='SC';
	  $dsr_caste1='ST';
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_gender=? AND (dsr_caste != ? OR dsr_caste != ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("isssss",$branch_id,$datef, $date1,$dsr_gender,$dsr_caste,$dsr_caste1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();
	$ipc2[$j]=$cid4;
	?>
	<span><?php echo $cid4;?></span>
		</td>
		
		<td>
		<?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dsr_gender='महिला';
	  $dsr_caste='SC';
	  $dsr_caste1='ST';
	if ( !$stmt14 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_gender=? AND (dsr_caste != ? OR dsr_caste != ?) ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->bind_param("isssss",$branch_id,$newDate1, $newDate2,$dsr_gender,$dsr_caste,$dsr_caste1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt14->execute() ) 
    echo "Execute Error: ($stmt14->errno)  $stmt14->error";
	if ( !$stmt14->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt14->num_rows === 0) { echo "No Results"; }
    $stmt14->bind_result($cid14); 
    $stmt14->fetch();
	$ip5[$j]=$cid14;
	?>
	<span><?php echo $cid14;?></span>
		</td>
		
		<?php 
		if($newyear2=='2018')
		{
		?>		
		<td>
		<?php 
		$police_dsr->select_db("ftcaaazc_dsr");
		 $dsr_gender='महिला';
		 $dsr_caste='SC';
	     $dsr_caste1='ST';
	if ( !$stmt28 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_gender=? AND (dsr_caste != ? OR dsr_caste != ?) ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt28->bind_param("isssss",$branch_id,$newDate3,$newDate4,$dsr_gender,$dsr_caste,$dsr_caste1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt28->execute() ) 
    echo "Execute Error: ($stmt28->errno)  $stmt28->error";
	if ( !$stmt28->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt28->num_rows === 0) { echo "No Results"; }
    $stmt28->bind_result($cid28); 
    $stmt28->fetch();
	$ip6[$j]=$cid28;
	?>
	<span><?php echo $cid28;?></span>
	</td>	
		<?php 
		}    //if($newyear2=='2018') end here
		else
		{
		?>
		<td>0<?php $ip6[$j] = 0 ;?></td>
		<?php }//else close ?>
		
      </tr>
      <?php } //stmt1 end here?>
      <tr>
        <td class="" colspan="2">जोन का योग</td>
        <td>
	<?php $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6]+$ipc[7]+$ipc[8]+$ipc[9]+$ipc[10];
	echo $s;?></td>
        <td><?php $s1=$ip1[1]+$ip1[2]+$ip1[3]+$ip1[4]+$ip1[5]+$ip1[6]+$ip1[7]+$ip1[8]+$ip1[9]+$ip1[10];
	echo $s1; ?></td>
        <td><?php $s2=$ip2[1]+$ip2[2]+$ip2[3]+$ip2[4]+$ip2[5]+$ip2[6]+$ip2[7]+$ip2[8]+$ip2[9]+$ip2[10];
	echo $s2; ?></td> 
        
		<td>
	<?php $n=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6]+$ipc1[7]+$ipc1[8]+$ipc1[9]+$ipc1[10];
	echo $n;?></td>
		<td><?php $s3=$ip3[1]+$ip3[2]+$ip3[3]+$ip3[4]+$ip3[5]+$ip3[6]+$ip3[7]+$ip3[8]+$ip3[9]+$ip3[10];
	echo $s3; ?></td>
        <td><?php $s4=$ip4[1]+$ip4[2]+$ip4[3]+$ip4[4]+$ip4[5]+$ip4[6]+$ip4[7]+$ip4[8]+$ip4[9]+$ip4[10];
	echo $s4; ?></td>	
        
		<td>
	<?php $r=$ipc2[1]+$ipc2[2]+$ipc2[3]+$ipc2[4]+$ipc2[5]+$ipc2[6]+$ipc2[7]+$ipc2[8]+$ipc2[9]+$ipc2[10];
	echo $r;?></td>
		<td><?php $s5=$ip5[1]+$ip5[2]+$ip5[3]+$ip5[4]+$ip5[5]+$ip5[6]+$ip5[7]+$ip5[8]+$ip5[9]+$ip5[10];
	echo $s5; ?></td>
        <td><?php $s6=$ip6[1]+$ip6[2]+$ip6[3]+$ip6[4]+$ip6[5]+$ip6[6]+$ip6[7]+$ip6[8]+$ip6[9]+$ip6[10];
	echo $s6; ?></td>		
      </tr>
	  <tr>
        <td class="" colspan="2">कमी / वृद्धि का प्रतिशत</td>
        <td colspan="3"><?php
if($s2 > 0)
{	
$percentage1 =($s-$s2)*100/$s2 ;
echo ROUND(ABS($percentage1),2); echo "%";
}
else
{	
echo "0%";	
}	
?></td>	
		<td colspan="3"><?php
if($s4 > 0)
{	
$percentage2 =($n-$s4)*100/$s4 ;
echo ROUND(ABS($percentage2),2); echo "%";
}
else
{	
echo "0%";	
}	
?></td>	
		<td colspan="3"><?php
if($s6 > 0)
{	
$percentage3 =($r-$s6)*100/$s6 ;
echo ROUND(ABS($percentage3),2); echo "%";
}
else
{	
echo "0%";	
}	
?></td>	
      </tr>
    </table>
    
    <br /><br />
  
    <br /><br />
	 <?php   
    //if($_POST['sp_office'] == 0)	
	$sp2='SP';
    $police_tracking->select_db("ftcaaazc_epfts");
	$stmt2 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
    $stmt2->bind_param("s", $sp2);
    $stmt2->execute();
    $stmt2->store_result();
    //if($stmt2->num_rows === 0) exit('No rows');
    $stmt2->bind_result($branch_id2, $branch_name2, $city2);
  ?>
	<table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
	<p style="float:right" align="center"></p>
	<tr>
	<td>क्र.</td>
	<td>जिला</td>
	<td>अ0जा0 कमी/ वृद्धि प्रतिशत</td>
	<td>अ.ज.जा. कमी/वृद्धि प्रतिशत</td>
	<td>महिलाओं पर घटित अपराध कमी/वृद्धि प्रतिशत</td>
	</tr>
	 <?php 
	  $j=0;	 
	  while($stmt2->fetch())
	  {
	  $idcheck2 = $branch_id2;
      $j++;
	  ?>
      <tr>
        <td><?php echo $j; ?></td>
        <td class=""><?php echo $branch_name2; echo ","; echo $city2;?></td>
        
		<td>
		<?php
		if($ip2[$j] > 0)
{	
$percentage10 =($ipc[$j]-$ip2[$j])*100/$ip2[$j] ;
echo ROUND(ABS($percentage10),2); echo "%";
}
else
{	
echo "0%";	
}
		?>
		</td>
		
        <td>
		<?php
		if($ip4[$j] > 0)
{	
$percentage11 =($ipc1[$j]-$ip4[$j])*100/$ip4[$j] ;
echo ROUND(ABS($percentage11),2); echo "%";
}
else
{	
echo "0%";	
}
 	    ?>
		</td>
		
        <td>
		<?php
		if($ip6[$j] > 0)
{	
$percentage12 =($ipc2[$j]-$ip6[$j])*100/$ip6[$j] ;
echo ROUND(ABS($percentage12),2); echo "%";
}
else
{	
echo "0%";	
}
		?>
		</td>
      </tr>
      <?php } //stmt2 end here?>
    
	  <tr>
        <td colspan="2">कमी / वृद्धि का प्रतिशत</td>
        <td><?php
if($s2 > 0)
{	
$percentage1 =($s-$s2)*100/$s2 ;
echo ROUND(ABS($percentage1),2); echo "%";
}
else
{	
echo "0%";	
}	
?></td>	
		<td><?php
if($s4 > 0)
{	
$percentage2 =($n-$s4)*100/$s4 ;
echo ROUND(ABS($percentage2),2); echo "%";
}
else
{	
echo "0%";	
}	
?></td>	
		<td><?php
if($s6 > 0)
{	
$percentage3 =($r-$s6)*100/$s6 ;
echo ROUND(ABS($percentage3),2); echo "%";
}
else
{	
echo "0%";	
}	
?></td>		
      </tr>
	</table>
    
    <br /><br />
  
    <br /><br />
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
