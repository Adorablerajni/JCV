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
      <form action="format27.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<div class="notice_all">
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
  $stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl WHERE id = ?");
  $stmt1->bind_param("s", $_POST['sp_office']);
  $stmt1->execute();
  $stmt1->store_result();
  //if($stmt1->num_rows === 0) exit('No rows');
  $stmt1->bind_result($branch_id, $branch_name, $city); 
  while ($stmt1->fetch())
  { 
  ?>
    <p align="center"><span>गुम इंसान/मानव दुव्र्यापार संबंधी जानकारी दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>&nbsp;&nbsp;&nbsp; जिला - <?php echo $city; ?></span></p>
      
<br />
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
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
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  ?>
	<?php
	for($i=1;$i<=4;$i++)
    {
	?>
	<tr>
    
	<td><?php echo $i ;?></td>
	
	<td align="left">
	<?php  
	if ($i===1) {$j = 'महिला' ; echo " महिला " ;}
    elseif ($i===2){ $j = 'बालिका' ; echo " महिला "; }
	elseif ($i===3){ $j = 'पुरुष' ; echo " पुरुष ";}  
	elseif ($i===4){ $j = 'बालक' ; echo " पुरुष ";}
	else { }
	?>
	</td>

	<td align="left">
	<?php  
	if ($i===1 OR $i===3) { echo " बालिग " ;}
	else { echo " नाबालिग " ; }
	?>
	</td> 
      
	  <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(gum_insan_details.id) FROM gum_insan_details INNER JOIN gum_insan ON gum_insan_details.gum_insan_id = gum_insan.id WHERE gum_insan_details.sp_id = ? AND(gum_insan.crime_date >= ? and gum_insan.crime_date <= ?) AND gum_insan_details.gum_insan_identification = ? ") )
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt2->bind_param("isss", $branch_id, $datef, $date1, $j) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt2->execute() ) 
      echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	  if ( !$stmt2->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt3->num_rows === 0) { echo "No Results"; }
      $stmt2->bind_result($cid2); 
      $stmt2->fetch();
	  $gum1[$i]=$cid2;
	  ?>
	  <span><?php echo $cid2;?></span>
	  <?php
	  $stmt2->close();
	  ?>
	  </td>
	  
	  <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dastayab='दस्‍तयाब';
	  if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(gum_insan_details.id) FROM gum_insan_details INNER JOIN gum_insan ON gum_insan_details.gum_insan_id = gum_insan.id WHERE gum_insan_details.sp_id = ? AND(gum_insan.crime_date >= ? and gum_insan.crime_date <= ?) AND gum_insan_details.gum_insan_identification = ? AND gum_insan.dastyab = ? ") ) 
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt3->bind_param("issss", $branch_id, $datef, $date1, $j, $dastayab) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt3->execute() ) 
      echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	  if ( !$stmt3->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt3->num_rows === 0) { echo "No Results"; }
      $stmt3->bind_result($cid3); 
      $stmt3->fetch();
	  $gum2[$i]=$cid3;	  
	  ?>
	  <span><?php echo $cid3;?></span>
	  <?php 
	  $stmt3->close();
	  ?>
	  </td>
	
	  <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $adam_dastayab='अदम दस्‍तयाब';
	  if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(gum_insan_details.id) FROM gum_insan_details INNER JOIN gum_insan ON gum_insan_details.gum_insan_id = gum_insan.id WHERE gum_insan_details.sp_id = ? AND(gum_insan.crime_date >= ? and gum_insan.crime_date <= ?) AND gum_insan_details.gum_insan_identification = ? AND gum_insan.dastyab = ? ") ) 
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt4->bind_param("issss", $branch_id, $datef, $date1, $j, $adam_dastayab) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt4->execute() ) 
      echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	  if ( !$stmt4->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt4->num_rows === 0) { echo "No Results"; }
      $stmt4->bind_result($cid4); 
      $stmt4->fetch();
	  $gum3[$i]=$cid4;
	  ?>
	  <span><?php echo $cid4;?></span>
	  <?php
	  $stmt4->close();
	  ?>
	  </td>
	
	  <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $dastayab='दस्‍तयाब';
	  $apradh='अपराध पंजीबद्ध';
	  if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(gum_insan_details.id) FROM gum_insan_details INNER JOIN gum_insan ON gum_insan_details.gum_insan_id = gum_insan.id WHERE gum_insan_details.sp_id = ? AND(gum_insan.crime_date >= ? and gum_insan.crime_date <= ?) AND gum_insan_details.gum_insan_identification = ? AND gum_insan.dastyab = ? AND gum_insan.nirakaran = ? ") ) 
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt5->bind_param("isssss", $branch_id, $datef, $date1, $j, $dastayab, $apradh) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt5->execute() ) 
      echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	  if ( !$stmt5->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt5->num_rows === 0) { echo "No Results"; }
      $stmt5->bind_result($cid5); 
      $stmt5->fetch();
	  $gum4[$i]=$cid5;	  
	  ?>
	  <span><?php echo $cid5;?></span>
	  <?php 
	  $stmt5->close();
	  ?>
	  </td>
	
	  <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $bhadvi='भादवि 372,373';
	  if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(gum_insan_details.id) FROM gum_insan_details INNER JOIN gum_insan ON gum_insan_details.gum_insan_id = gum_insan.id WHERE gum_insan_details.sp_id = ? AND(gum_insan.crime_date >= ? and gum_insan.crime_date <= ?) AND gum_insan_details.gum_insan_identification = ? AND gum_insan.dhara = ? ") ) 
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt6->bind_param("issss",$branch_id, $datef, $date1, $j, $bhadvi) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt6->execute() ) 
      echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	  if ( !$stmt6->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt6->num_rows === 0) { echo "No Results"; }
      $stmt6->bind_result($cid6); 
      $stmt6->fetch();
	  $gum5[$i]=$cid6;
	  ?>
	  <span><?php echo $cid6;?></span>
	  <?php
	  $stmt6->close();
	  ?>
	  </td>
	
	  <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $majdur='बन्धुआ मजदूर, दास प्रथा';
	  if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(gum_insan_details.id) FROM gum_insan_details INNER JOIN gum_insan ON gum_insan_details.gum_insan_id = gum_insan.id WHERE gum_insan_details.sp_id = ? AND(gum_insan.crime_date >= ? and gum_insan.crime_date <= ?) AND gum_insan_details.gum_insan_identification = ? AND gum_insan.dhara = ? ") ) 
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt7->bind_param("issss", $branch_id, $datef, $date1, $j, $majdur) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt7->execute() ) 
      echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	  if ( !$stmt7->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt7->num_rows === 0) { echo "No Results"; }
      $stmt7->bind_result($cid7); 
      $stmt7->fetch();
	  $gum6[$i]=$cid7;
	  ?>
	  <span><?php echo $cid7;?></span>
	  <?php
	  $stmt7->close();
	  ?>
	  </td>
	
	  <td>
	  <?php
	  $police_dsr->select_db("ftcaaazc_dsr");
	  $giroh='संगठित गिरोह';
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(gum_insan_details.id) FROM gum_insan_details INNER JOIN gum_insan ON gum_insan_details.gum_insan_id = gum_insan.id WHERE gum_insan_details.sp_id = ? AND(gum_insan.crime_date >= ? and gum_insan.crime_date <= ?) AND gum_insan_details.gum_insan_identification = ? AND gum_insan.dhara = ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("issss",$giroh, $datef, $date1, $j, $giroh) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt8->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();
	$gum7[$i]=$cid8;
	?>
	<span><?php echo $cid8;?></span>
	<?php
	$stmt8->close();
	?>
	</td>

	</tr>
    <?php } //for loop end here ?>

	<tr>
    <td colspan="2" rowspan="2">योग</td>
	<td>बालिग</td>
    
	<td>
	<?php 
	$balig1=$gum1[1]+$gum1[3];
	echo $balig1;
	?>
	</td>
	
	<td>
	<?php 
	$balig2=$gum2[1]+$gum2[3];
	echo $balig2;
	?>
	</td>
	
	<td>
	<?php 
	$balig3=$gum3[1]+$gum3[3];
	echo $balig3;
	?>
	</td>
	
	<td>
	<?php 
	$balig4=$gum4[1]+$gum4[3];
	echo $balig4;
	?>
	</td>
	
	<td>
	<?php 
	$balig5=$gum5[1]+$gum5[3];
	echo $balig5;
	?>
	</td>
	
	<td>
	<?php 
	$balig6=$gum6[1]+$gum6[3];
	echo $balig6;
	?>
	</td>
	
	<td>
	<?php 
	$balig7=$gum7[1]+$gum7[3];
	echo $balig7;
	?>
	</td>
	
	</tr>
	
	<tr>
	<td>नाबालिग</td>
	
	<td>
	<?php 
	$nabalig1=$gum1[2]+$gum1[4];
	echo $nabalig1;
	?>
	</td>
	
	<td>
	<?php 
	$nabalig2=$gum2[2]+$gum2[4];
	echo $nabalig2;
	?>
	</td>
	
	<td>
	<?php 
	$nabalig3=$gum3[2]+$gum3[4];
	echo $nabalig3;
	?>
	</td>
	
	<td>
	<?php 
	$nabalig4=$gum4[2]+$gum4[4];
	echo $nabalig4;
	?>
	</td>
	
	<td>
	<?php 
	$nabalig5=$gum5[2]+$gum5[4];
	echo $nabalig5;
	?>
	</td>
	
	<td>
	<?php 
	$nabalig6=$gum6[2]+$gum6[4];
	echo $nabalig6;
	?>
	</td>
	
	<td>
	<?php 
	$nabalig7=$gum7[2]+$gum7[4];
	echo $nabalig7;
	?>
	</td>
	</tr>

    </table>
    
    <br /><br />
  
    <br /><br />
    <p style="float:right" align="center"></p>
	  <?php 
	  } 
	  $stmt1->close();
	  ?>
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