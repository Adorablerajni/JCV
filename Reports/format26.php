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
<title>Format-26 | File Tracking & Crime Analysis Application </title>
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
      <form action="format26.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
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
<p align="left" style="float:left;margin-left:-30px;">Format-26</p>
<p align="right"></p>
  <div class="mar10">

    <p align="center"><span>महिलाओं से संबंधित मर्गो की समीक्षा से संबंधित जानकारी   दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?> इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?>
 
 
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td>क्र.</td>
        <td>जिला</td>
		<td>थाना</td>
        <td width="150px">मर्ग क्रमांक</td>
		<td width="150px">मर्ग दिनांक</td>
		<td width="270px">नाम मृतिका</td>
        <td width="170px">मृत्यु का कारण</td>
		<td>समीक्षाकर्ता अधिकारी का नाम व पद</td>
		<td>मर्ग जांच पर अपराध पंजीबद्ध करने का कारण</td>
		<td>समीक्षा उपरांत यदि अपराध पंजीबद्ध किया गया तो अप.क्र. धारा एवं कायमी दिनांक</td>
		<td>रिमार्क</td>
      </tr>

	  <?php
      $police_dsr->select_db("ftcaaazc_dsr");	  
	  $j=0;
	  if ( !$stmt1 = $police_dsr->prepare("SELECT `marg_no`, `marg_crime_year`, `marg_date`, `kaymi_date`, `injured_name`, `death_reason`, `investigator_name`, `crime_no`, `crime_year`, `main_dhara`, `other_dhara`, `sp_id`, `office_id`, `apradh_pnjibdh_rsn`, `remark` FROM marg_profarma WHERE (marg_date >= ? and marg_date <= ?) ORDER BY office_id ") ) 
      echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt1->bind_param("ss",$datef, $date1) )
      echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
      if ( !$stmt1->execute() ) 
      echo "Execute Error: ($stmt1->errno)  $stmt1->error";
	  if ( !$stmt1->store_result() ) //Only for select with bind_result()
      echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
      //if($stmt1->num_rows === 0) { echo "No Results"; }
      $stmt1->bind_result($marg_no,$marg_crime_year,$marg_date,$kaymi_date,$injured_name,$death_reason,$investigator_name,$crime_no,$crime_year,$main_dhara,$other_dhara,$sp_id,$office_id,$apradh_pnjibdh_rsn,$remark); 
	  while($stmt1->fetch())
	  {
      $j++;
	  ?>
      <tr> 
	  
        <td><?php echo $j; ?></td>
		
		<td class="">
	<?php
    $police_tracking->select_db("ftcaaazc_epfts");	
	if ( !$stmt2 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?") ) 
    echo "Prepare Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt2->bind_param("i", $sp_id) )
    echo "Binding Parameter Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_tracking->errno) $police_tracking->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($branch_id, $branch_name, $city); 
	$stmt2->fetch();
    ?>
		<span><?php echo $branch_name; echo ","; echo $city;?></span>
		<?php
		$stmt2->close();
		?>
		</td>
		
        <td>
	<?php 
    $police_tracking->select_db("ftcaaazc_epfts");   	
	if ( !$stmt3 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?") ) 
    echo "Prepare Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt3->bind_param("i", $office_id) )
    echo "Binding Parameter Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_tracking->errno) $police_tracking->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($branch_id1, $branch_name1, $city1); 
	$stmt3->fetch();
    ?>
		<span><?php echo $branch_name1; echo ","; echo $city1;?></span>
		<?php
		$stmt3->close();
		?>		
		</td>
		
		<td><?php echo $marg_no; echo "/"; echo $marg_crime_year;?></td>
		<td><?php if ($marg_date == ''){echo '';} else{echo date('d-m-Y', strtotime($marg_date));}?></td>
		<td><?php echo $injured_name;?></td>
		<td><?php echo $death_reason;?></td>
		
		<td>
		<?php
    $police_tracking->select_db("ftcaaazc_epfts");   	
	if ( !$stmt4 = $police_tracking->prepare("SELECT `id`, `desig`, `batch_no`, `staff_name` FROM staff_details where id = ?") ) 
    echo "Prepare Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt4->bind_param("i", $investigator_name) )
    echo "Binding Parameter Error: ($police_tracking->errno) $police_tracking->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_tracking->errno) $police_tracking->error";
    //if($stmt4->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($staff_id, $desig, $batch_no, $staff_name); 
	$stmt4->fetch();
    ?>
		<span><?php echo $staff_name; echo ","; echo $desig;?></span>
		<?php
		$stmt4->close();
		?>		
		</td>
		
		<td><?php echo $apradh_pnjibdh_rsn;?></td>
		
		<td>
		<?php echo $crime_no; echo "/"; echo $crime_year;?>&nbsp;-&nbsp;<?php echo $main_dhara; echo "/"; echo $other_dhara;?>&nbsp;-&nbsp;<br />
		<?php if ($kaymi_date == ''){echo '';} else{echo date('d-m-Y', strtotime($kaymi_date));}?>
		</td>
		
		<td><?php echo $remark;?></td>
        
      </tr>
      <?php 
	  } //stmt1 end here
	  $stmt1->close();
	  ?>
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
