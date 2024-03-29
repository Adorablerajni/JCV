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
<title>Format15-janta-nonbail-warrant | File Tracking & Crime Analysis Application </title>
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
<script src="../assets/plugins/jquery-2.0.3.min.js"></script> 
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script src="../assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
      <form action="format15-janta-nonbail-warrant.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format15-janta-nonbail-warrant</p>
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
    <p align="center"><span>जनता गैर जमानती वारंट माहः- दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> तक  इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?>
   <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td>जिला</td>
        <td>पूर्व लंबित</td>
        <td>माह में प्राप्त</td>
		<td>योग</td>
		<td>तामिल</td>
		<td>अदम तामिल</td>
		<td>स्थानान्तरित</td>
		<td>शेष</td>
		<td>योग 6 से 9 तक</td>
		<td>तामिली का प्रतिशत</td>
      </tr>
     <tr>
      <th><strong><center>(1)</center></strong></th>
      <th><strong><center>(2)</center></strong></th>
      <th><strong><center>(3)</center></strong></th>
      <th><strong><center>(4)</center></strong></th>
      <th><strong><center>(5)</center></strong></th>
      <th><strong><center>(6)</center></strong></th>
      <th><strong><center>(7)</center></strong></th>
      <th><strong><center>(8)</center></strong></th>
      <th><strong><center>(9)</center></strong></th>
      <th><strong><center>(10)</center></strong></th>
      <th><strong><center>(11)</center></strong></th>
      </tr>
	  <?php 
	  $j=0;	
     $aj = 1;	  
	  while($stmt1->fetch())
	  {
	  ?>
	  <script>

$(document).ready(function () {
$("#hideShow<?php echo $aj; ?>").click(function() { $("#message<?php echo $aj; ?>").toggle(); });
$("#hideShow2<?php echo $aj; ?>").click(function() { $("#message2<?php echo $aj; ?>").toggle(); });
$("#hideShow3<?php echo $aj; ?>").click(function() { $("#message3<?php echo $aj; ?>").toggle(); });
$("#hideShow4<?php echo $aj; ?>").click(function() { $("#message4<?php echo $aj; ?>").toggle(); });
$("#hideShow5<?php echo $aj; ?>").click(function() { $("#message5<?php echo $aj; ?>").toggle(); });
});

    $("#hideShow<?php echo $aj; ?>").click(function(){
   $("#message<?php echo $aj; ?>").toggle();
});
$("#hideShow2<?php echo $aj; ?>").click(function(){
   $("#message2<?php echo $aj; ?>").toggle();
});
$("#hideShow3<?php echo $aj; ?>").click(function(){
   $("#message3<?php echo $aj; ?>").toggle();
});

$("#hideShow4<?php echo $aj; ?>").click(function(){
   $("#message4<?php echo $aj; ?>").toggle();
});

$("#hideShow5<?php echo $aj; ?>").click(function(){
   $("#message5<?php echo $aj; ?>").toggle();
});


</script>  
       <?php  $j++; 	
	   $aj++;
	  ?>
	 
	<script>

$(document).ready(function () {
$("#hideShow<?php echo $aj; ?>").click(function() { $("#message<?php echo $aj; ?>").toggle(); });
$("#hideShow2<?php echo $aj; ?>").click(function() { $("#message2<?php echo $aj; ?>").toggle(); });
$("#hideShow3<?php echo $aj; ?>").click(function() { $("#message3<?php echo $aj; ?>").toggle(); });
$("#hideShow4<?php echo $aj; ?>").click(function() { $("#message4<?php echo $aj; ?>").toggle(); });
$("#hideShow5<?php echo $aj; ?>").click(function() { $("#message5<?php echo $aj; ?>").toggle(); });
});

    $("#hideShow<?php echo $aj; ?>").click(function(){
   $("#message<?php echo $aj; ?>").toggle();
});
$("#hideShow2<?php echo $aj; ?>").click(function(){
   $("#message2<?php echo $aj; ?>").toggle();
});
$("#hideShow3<?php echo $aj; ?>").click(function(){
   $("#message3<?php echo $aj; ?>").toggle();
});

$("#hideShow4<?php echo $aj; ?>").click(function(){
   $("#message4<?php echo $aj; ?>").toggle();
});

$("#hideShow5<?php echo $aj; ?>").click(function(){
   $("#message5<?php echo $aj; ?>").toggle();
});


</script>  
      <tr>
            <td><?php echo $j; ?></td>
            <td class=""><?php echo $branch_name; echo ","; echo $city;?></td>
            
            <td>
		<?php 
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type='गिरफ़्तारी वारंट';
	$aaropi_type='जनता';
	$tamil_date_null='';
	$sub_id='No';
	$z=0;
	if ( !$stmt2 = $police_summons->prepare("SELECT id, sakshi_name FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND samans_date < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR `tamil_date` ='') and `sakshi_peshi_date` > ?))AND (`transfer_date` is null OR `transfer_date` >= ?)  and `sub_id` = ?  AND aaropi_type = ?") )
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt2->bind_param("issssssss",$branch_id, $warrant_type, $datef, $datef, $datef, $datef, $datef, $sub_id, $aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
     $stmt2->bind_result($janta_smns_id, $sakshi_name);
    
	$cid1 = $stmt2->num_rows;
	$ipc[$j]=$cid1;
	?>
	<a href="#" id="hideShow<?php echo $aj; ?>"><?php echo $cid1; ?></a><br /><br />
	<div id="message<?php echo $aj; ?>" style="display:none;text-align:left">
       <?php while($stmt2->fetch()){
$z++;	   ?>             
	<a href="../Summon/get-search.php?sp=<?php echo $branch_id;?>&s_id=<?php echo $janta_smns_id;?>"><?php echo $z;?>- <?php echo $sakshi_name;?></a><br />
	   <?php } ?>
	   </div>
		</td>
            
            <td>
		<?php 
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type='गिरफ़्तारी वारंट';
	$aaropi_type='जनता';
	$tamil_date='';
	$sub_id='No';
	$a=0;
	if ( !$stmt3 = $police_summons->prepare("SELECT id, sakshi_name FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND (samans_date between ? AND ?)  AND sub_id=? AND aaropi_type=?") ) //AND (tamil_date is null OR tamil_date = ?)
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt3->bind_param("isssss",$branch_id, $warrant_type, $datef, $date1,$sub_id,$aaropi_type) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
   $stmt3->bind_result($janta_smns_id1, $sakshi_name1); 
   $cid2 = $stmt3->num_rows;
	$ipc1[$j]=$cid2;
	?>
	
	<a href="#" id="hideShow2<?php echo $aj; ?>"><?php echo $cid2; ?></a><br /><br />
	<div id="message2<?php echo $aj; ?>" style="display:none;text-align:left">
       <?php while($stmt3->fetch()){
$a++;	   ?>             
	<a href="../Summon/get-search.php?sp_office=<?php echo $branch_id;?>&s_id=<?php echo $janta_smns_id1;?>"><?php echo $a;?>- <?php echo $sakshi_name1;?></a><br />
	   <?php } ?>
	   </div>
		</td>

            <td>
            <?php
            $sum=$cid1+$cid2;
            $ipc2[$j]=$sum;
            ?>
            <span><?php echo $sum;?></span>
            </td>
            
            <td>
		<?php
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type='गिरफ़्तारी वारंट';
	$sub_id='No';
	$aaropi_type='जनता';
	$b=0;
	if ( !$stmt4 = $police_summons->prepare("SELECT id, sakshi_name FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type=? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (tamil_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt4->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
   $stmt4->bind_result($janta_smns_id2, $sakshi_name2); 
      $cid3 = $stmt4->num_rows;
	$ipc3[$j]=$cid3;
	?>
	<a href="#" id="hideShow3<?php echo $aj; ?>"><?php echo $cid3; ?></a><br /><br />
	<div id="message3<?php echo $aj; ?>" style="display:none;text-align:left">
       <?php while($stmt4->fetch()){
$b++;	   ?>             
	<a href="../Summon/get-search.php?sp=<?php echo $branch_id;?>&s_id=<?php echo $janta_smns_id2;?>"><?php echo $b;?>- <?php echo $sakshi_name2;?></a><br />
	   <?php } ?>
	   </div>
		</td>
            
           <td>
		<?php
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type92='गिरफ़्तारी वारंट';
	$sub_id='No';
	$tamil_date92='';
	$c=0;
	if ( !$stmt5 = $police_summons->prepare("SELECT id, sakshi_name FROM summon_list WHERE sp_id = ? AND sub_id = ? AND warrant_type = ? AND aaropi_type = ? and  `samans_date` < ? AND `sakshi_peshi_date` > ? AND (((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` < ?) OR (tamil_date > ? and `sakshi_peshi_date` < ? AND (`transfer_date` is null OR `transfer_date` > ?)))") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt5->bind_param("isssssssss",$branch_id, $sub_id, $warrant_type92, $aaropi_type, $date1, $datef, $date1, $date1, $date1, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($janta_smns_id3, $sakshi_name3); 
   $cid4 = $stmt5->num_rows;
	$ipc4[$j]=$cid4;
	?>
	
	<a href="#" id="hideShow4<?php echo $aj; ?>"><?php echo $cid4; ?></a><br /><br />
	<div id="message4<?php echo $aj; ?>" style="display:none;text-align:left">
       <?php while($stmt5->fetch()){
$c++;	   ?>             
	<a href="../Summon/get-search.php?sp=<?php echo $branch_id;?>&s_id=<?php echo $janta_smns_id3;?>"><?php echo $c;?>- <?php echo $sakshi_name3;?></a><br />
	   <?php } ?>
	   </div>
	</td>
            <td>
		<?php 
	$police_summons->select_db("ftcaaazc_summons");
	$warrant_type='गिरफ़्तारी वारंट';
	$aaropi_type='जनता';
	$sub_id='No';
	$d=0;
	if ( !$stmt7 = $police_summons->prepare("SELECT id, sakshi_name FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND aaropi_type = ? AND ((`samans_date` < ? AND (((`tamil_date` <= `sakshi_peshi_date`) AND (sakshi_peshi_date > ?) and (tamil_date > ?)) OR ((`tamil_date` is null OR tamil_date ='') and `sakshi_peshi_date` > ?))) OR (`samans_date` between ? AND ?)) AND sub_id = ? AND (`transfer_date` between ? AND ?)") ) 
    echo "Prepare Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt7->bind_param("isssssssssss",$branch_id, $warrant_type, $aaropi_type, $datef, $datef, $datef, $datef, $datef, $date1, $sub_id, $datef, $date1) )
    echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
    //if($stmt7->num_rows === 0) { echo "No Results"; }
   $stmt7->bind_result($janta_smns_id4, $sakshi_name4); 
            $cid7 = $stmt7->num_rows;
            $ipc7[$j]=$cid7;
            ?><a href="#" id="hideShow5<?php echo $aj; ?>"><?php echo $cid7; ?></a><br /><br />
	<div id="message5<?php echo $aj; ?>" style="display:none;">
       <?php while($stmt7->fetch()){
$d++;	   ?>             
	<a href="../Summon/get-search.php?sp=<?php echo $branch_id;?>&s_id=<?php echo $janta_smns_id4;?>">(<?php echo $janta_smns_id4;?>)<?php echo $d;?>- <?php echo $sakshi_name4;?></a><br />
	   <?php } ?>
	   </div>
	    <?php
            $stmt7->close();
            ?>
	   </td>
            <td>
            <?php
            $police_summons->select_db("ftcaaazc_summons");
            $warrant_type='गिरफ़्तारी वारंट';
            $aaropi_type='जनता';
            $tamil_date='';
            $sub_id='No';
            if ( !$stmt6 = $police_summons->prepare("SELECT COUNT(id) FROM summon_list WHERE sp_id = ? AND warrant_type = ? AND sub_id=? AND (tamil_date is null OR tamil_date = ?) AND aaropi_type=?") ) 
            echo "Prepare Error: ($police_summons->errno) $police_summons->error";
            if ( !$stmt6->bind_param("issss",$branch_id, $warrant_type,$sub_id,$tamil_date,$aaropi_type) )
            echo "Binding Parameter Error: ($police_summons->errno) $police_summons->error";
            if ( !$stmt6->execute() ) 
            echo "Execute Error: ($stmt6->errno)  $stmt6->error";
            if ( !$stmt6->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_summons->errno) $police_summons->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt6->bind_result($cid5); 
            $stmt6->fetch();
            $shesh = $sum - ($cid3 + $cid4 + $cid7);
            $ipc5[$j]=$shesh;
            ?>
            <span><?php echo $shesh ; ?></span>
            </td>
            
            <td>
            <?php
            $sum1=$cid3+$cid4+$cid7+$shesh;
            $ipc6[$j]=$sum1;
            ?>
            <span><?php echo $sum1;?></span>
            </td>
            
            <td><?php	
            $x7 = $ipc3[$j];
            $y7 = $ipc2[$j];
            if($y7!=0){
            $percent7 = $x7/$y7;
            }
            else {
            $percent7 = 0;
            $percent7;}

            $percent_friendly7 = number_format( $percent7 * 100, 2 ) . ' %' ;
            echo $percent_friendly7 ;
            ?></td>
      </tr>
	  
      <?php } //stmt1 end here?>
      <tr>
            <td></td>
            <td>इंदौर जोन</td>
            
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
            
            <td><?php $x=$ipc7[1]+$ipc7[2]+$ipc7[3]+$ipc7[4]+$ipc7[5]+$ipc7[6]+$ipc7[7]+$ipc7[8]+$ipc7[9]+$ipc7[10];
            echo $x;?></td>
            
            <td>
            <?php $v= $r - ($t + $u + $x);
            echo $v;?>
            </td>

            <td>
            <?php $w=$ipc6[1]+$ipc6[2]+$ipc6[3]+$ipc6[4]+$ipc6[5]+$ipc6[6]+$ipc6[7]+$ipc6[8]+$ipc6[9]+$ipc6[10];
            echo $w;?>
            </td>
            
            <td><?php	
            $x8 = $t;
            $y8 = $r;
            if($y8!=0){
            $percent8 = $x8/$y8;
            }
            else {
            $percent8 = 0;
            $percent8;}

            $percent_friendly8 = number_format( $percent8 * 100, 2 ) . ' %' ;
            echo $percent_friendly8 ;
            ?></td>
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
