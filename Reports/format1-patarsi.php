<?php
require_once('../Connections/dbconnect-m.php');
 
if(!isset($_SESSION['MM_UserGroup'])) 
    { 
        header("location:../logout.php");
    }
?>

<?php 
$police_tracking->select_db("ftcaaazc_epfts");
$a='SP';
$stmt = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE designation = ?");
$stmt->bind_param("s", $a);
$stmt->execute();
$stmt->store_result();
//if($stmt->num_rows === 0) exit('No rows');
$stmt->bind_result($id,$branch_name,$city);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Format-1-PATARSI| File Tracking & Crime Analysis Application </title>
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
      <form action="format1-patarsi.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
         <div class="col-lg-12 navStuff" style="padding:15px 5px;margin:0px auto;width:960px;">    
        <div class="col-lg-12 navStuff">  &nbsp; 
         <label>दिनांक:</label>
          <input name="datef"  id="dp26" type="text" class="form-control  validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datef']) ? $_POST['datef'] : '' ?>" readonly="readonly" />
          &nbsp;से&nbsp;
          <label>दिनांक:</label>
          <input name="datel"  id="dp27" type="text" class="form-control validate[required] text-input"  autocomplete="off" style="width:130px; display:inline-block" value="<?php echo isset($_POST['datel']) ? $_POST['datel'] : '' ?>" readonly="readonly" />
          &nbsp; तक  &nbsp;&nbsp;

    <select name="sp_office" id="sp_office" class="validate[required] text-input form-control" style="display:inline-block;width:220px;" readonly="readonly">
    <?php 
	$stmt_jila = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?");
    $stmt_jila->bind_param("s", $_POST['sp_office']);
    $stmt_jila->execute();
    $stmt_jila->store_result();
    //if($stmt_jila->num_rows === 0) exit('No rows');
    $stmt_jila->bind_result($branch_id_jila, $branch_name_jila, $city_jila);
    $stmt_jila->fetch();
	$stmt_jila->close();
	$jila = $branch_name_jila.",".$city_jila ;
    ?>
	<option value="<?php echo $branch_id_jila ;?>"><?php echo isset($_POST['sp_office']) ? $jila : '' ?></option>    
	<?php
    while($stmt->fetch()) 
    { 	
    ?>
    <option value="<?php echo $id; //echo $get_sql_data['id']?>"><?php echo $branch_name; //echo $get_sql_data['branch_name']?>, <?php echo $city; //echo $get_sql_data['city']?></option>
    <?php
   
    }$stmt->close(); //id,branch_name,city FROM branch_tbl close
    ?>
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
<p align="left" style="float:left;margin-left:-30px;">Format-1-Patarsi</p>
<p align="right"></p>
  <div class="mar10">
  <?php 

    //if($_POST['sp_office'] == 0)	
	//$sp='SP';
$police_tracking->select_db("ftcaaazc_epfts");
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?");
    $stmt1->bind_param("s", $_POST['sp_office']);
    $stmt1->execute();
    $stmt1->store_result();
    //if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name1, $city1);
    $stmt1->fetch();
	$stmt1->close();

  ?>
    <p align="center"><span>संपत्ति संबंधी अपराधों में पतारसी एवं बरामदगी का प्रतिशत<br />दिनांक - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से  <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>तक<br /> जिला - <?php echo $branch_name1; echo ","; echo $city1; ?></span></p>
 <br />
     
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?><br/>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td>शीर्ष</td>
        <td>कुल पंजीबद्ध प्रकरण</td>
        <td>पते में आये प्रकरण </td>
        <td>पतारसी का प्रतिशत</td>
		<td>गया</td>
		<td>मिला</td>
		<td>बरामदगी का प्रतिशत</td>
		<td style ="display:none" >जोन का बरामदगी प्रतिशत</td>
      </tr>
	  
	  <?php 
  for ($i=1;$i<=6;$i++)
  {	 
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    
	<td align="left">
	<?php 
	if ($i===1) {$j = 3 ; echo " डकेती (395) " ;}
    elseif ($i===2){ $j = 5 ; echo "  लूट (392) "; }
	elseif ($i===3){ $j = 7 ; echo "  गृहभेदन ";}  
	elseif ($i===4){ $j = 9 ; echo " चोरी  ";}
	elseif ($i===5){ $j = 69 ; echo " वाहन चोरी (दो पहिया) ";}
	elseif ($i===6){ $j = 70 ; echo " वाहन चोरी (चार पहिया) ";}
	else { }
	?>
	</td>
    <td>
	<?php
 	$police_dsr->select_db("ftcaaazc_dsr");
	$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
	$stmt2->bind_param("iiss", $j, $branch_id, $datef, $date1);
    $stmt2->execute();
    $stmt2->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid1); 
    $stmt2->fetch();
	$ipc[$i]=$cid1;
	?>
	<span><?php echo $cid1;?></span>
	<?php 
	$stmt2->close();
	?>
	</td>
    
	<td>
	<?php 	
	$police_dsr->select_db("ftcaaazc_dsr");
	$arrest_status ='गिरफ़्तार';
	$stmt3 = $police_dsr->prepare("SELECT count(DISTINCT(criminal_list.dsr_id)) FROM  criminal_list JOIN dsr_entries ON criminal_list.dsr_id = dsr_entries.id WHERE criminal_list.sp_id = ? AND  ( criminal_list.criminal_arrest_date between ? AND ?) AND criminal_list.arrest_status = ? AND dsr_entries.dsr_vidhan_ipc = ? ");
	$stmt3->bind_param("isssi", $branch_id,$datef, $date1,$arrest_status,$j);
    $stmt3->execute();
    $stmt3->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid2); 
    $stmt3->fetch();
    $ipc1[$i]=$cid2;	
    ?>
	<span><?php echo $cid2;?></span>
	<?php 
	$stmt3->close();
	?>
	</td>
	
    <td>
	<?php
 	$x6 = $ipc1[$i];
$y6 = $ipc[$i];
if($y6!=0){
$percent6 = $x6/$y6;
}
else {
	$percent6 = 0;
}

$percent_friendly6 = number_format( $percent6 * 100, 2 ) . ' %' ;
$ipc2[$i] = $percent_friendly6;
echo $percent_friendly6 ;
	?>
	</td>
	
    <td>
    <?php
    $police_dsr->select_db("ftcaaazc_dsr");
    //if ( !$stmt4 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND dsr_vidhan_ipc = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    if ( !$stmt4 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND property_details.property_date BETWEEN ? AND ? AND dsr_entries.dsr_vidhan_ipc = ?") )         
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("issi",$branch_id,$datef,$date1,$j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();
    $ipc3[$i]=$cid4;	
    ?>
	<span><?php if ($cid4!=0){echo $cid4;} else {echo 0 ;}?></span>
	<?php 
	$stmt4->close();
	?>
	</td>
    
	<td>
	<?php
        /*
	$police_dsr->select_db("ftcaaazc_dsr");
	//$dsr_seized_amnt="NULL";
	if ( !$stmt5 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND dsr_vidhan_ipc = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("iiss",$branch_id,$j,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid5); 
    $stmt5->fetch();
    //$ipc4[$i]=$cid5;	
	$stmt5->close();
         */
    ?>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$stmt6 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND dsr_entries.dsr_vidhan_ipc = ? AND (property_details.property_date between ? AND ?)") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("iiss",$branch_id,$j,$datef,$date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt6->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid6); 
    $stmt6->fetch();
    $cid56 = $cid6 ; //$cid5 +
	$ipc4[$i]=$cid56;
    ?>	
	<span><?php if ($cid56!=0) {echo $cid56;} else {echo 0 ;}?></span>
	<?php 
	$stmt6->close();
	?>
	</td>
    
		<td>
	<?php
 	$x5 = $ipc4[$i];
$y5 = $ipc3[$i];
if($y5!=0){
$percent5 = $x5/$y5;
}
else {
	$percent5 = 0;
}

$percent_friendly5 = number_format( $percent5 * 100, 2 ) . ' %' ;
$ipc5[$i] = $percent_friendly5 ;
echo $percent_friendly5 ;
	?>
	</td>
	
		<td style ="display:none">0
	<?php
 	/*$police_dsr->select_db("ftcaaazc_dsr");
	$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE dsr_vidhan_ipc = ? AND sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)");
	$stmt8->bind_param("iiss", $j, $branch_id,$datef, $date1);
    $stmt8->execute();
    $stmt8->store_result();
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();
$ipc6[$i]=$cid8;	
    ?>
	<span><?php echo $cid8;?></span>
	<?php 
	$stmt8->close();*/
	?>
	</td>
 
      </tr>
	   <?php } //for loop end here ?>
	  <tr>
        <td>7</td>
        <td class="">योग</td>
    <td>
	<?php $s=$ipc[1]+$ipc[2]+$ipc[3]+$ipc[4]+$ipc[5]+$ipc[6];
	echo $s;?>
	</td>
	
	<td>
	<?php $n=$ipc1[1]+$ipc1[2]+$ipc1[3]+$ipc1[4]+$ipc1[5]+$ipc1[6];
	echo $n;?>
	</td>
	
	 <td>
	<?php// $r=$ipc2[1]+$ipc2[2]+$ipc2[3]+$ipc2[4]+$ipc2[5]+$ipc2[6];
	//echo $r;?>
	<?php 
 	$x7 = $n;
    $y7 = $s;
    if($y7!=0){
    $percent7 = $x7/$y7;
    }
    else {
	$percent7 = 0;
    }
    $percent_friendly7 = number_format( $percent7 * 100, 2 ) . ' %' ;
    echo $percent_friendly7 ;
	?>
	</td>
	
    <td>
	<?php $t=$ipc3[1]+$ipc3[2]+$ipc3[3]+$ipc3[4]+$ipc3[5]+$ipc3[6];
	echo $t;?>
	</td>
	
	<td>
	<?php $u=$ipc4[1]+$ipc4[2]+$ipc4[3]+$ipc4[4]+$ipc4[5]+$ipc4[6];
	echo $u;?>
	</td>
	
    <td>
	<?php //$v=$ipc5[1]+$ipc5[2]+$ipc5[3]+$ipc5[4]+$ipc5[5]+$ipc5[6];
	//echo $v;
 	$x4 = $u;
    $y4 = $t;
    if($y4!=0){
    $percent4 = $x4/$y4;
    }
    else {
	$percent4 = 0;
    }
    $percent_friendly4 = number_format( $percent4 * 100, 2 ) . ' %' ;
    echo $percent_friendly4 ;
	
	?>
	</td>
	
	<td style ="display:none">
	<?php //$w=$ipc6[1]+$ipc6[2]+$ipc6[3]+$ipc6[4]+$ipc6[5]+$ipc6[6];
	//echo $w;?>
	</td>
      </tr>
	  
	
      <?php //} //stmt1 end here?>
    </table>
 <?php //} //stmt1 end here?>
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