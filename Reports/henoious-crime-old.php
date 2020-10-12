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
if($stmt->num_rows === 0) exit('No rows');
$stmt->bind_result($id,$branch_name,$city);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Format-Henoious-Crime| File Tracking & Crime Analysis Application </title>
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
      <form action="henoious-crime.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
        <div class="col-lg-10 navStuff" style="border:1px dashed #555;padding:5px">&nbsp;
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
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
   if(isset($_POST['Search'])!='')
   {
  ?>
<p align="left" style="float:left;margin-left:-30px;"></p>
<p align="right"></p>
  <div class="mar10">
  <?php 

    //if($_POST['sp_office'] == 0)	
	//$sp='SP';
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where id = ?");
    $stmt1->bind_param("s", $_POST['sp_office']);
    $stmt1->execute();
    $stmt1->store_result();
    //if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name1, $city1);
    $stmt1->fetch();
	$stmt1->close();
  ?>
    <p align="center"><span>माह - <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('m/Y', strtotime($_POST['datef']));
}?> से  <?php if ($_POST['datel'] == ''){echo '';} else{echo date('m/Y', strtotime($_POST['datel']));}?><br /> जिला - <?php echo $branch_name1; echo ","; echo $city1; ?></span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $chinhit = 'हाँ';
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="font-size:12px;line-height:20px;margin-left:-30px;text-align:center" id="print" width="960px">
      <tr>
        <td>क्र.</td>
        <td>विषय</td>
        <td>2008</td>
        <td>2009</td>
        <td>2010</td>
		<td>2011</td>
		<td>2012</td>
		<td>2013</td>
		<td>2014</td>
		<td>2015</td>
		<td>2016</td>
		<td>2017</td>
        <td>2018</td>
		<td>कुल योग</td>
      </tr>
	  
	 <?php 
  for ($i=1;$i<=13;$i++)
  {	 
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    
	<td align="left">
	<?php 
	if ($i===1) { $j = 'NULL' ; $l='c_status'; echo "कुल चिन्हित प्रकरण" ;}
        elseif ($i===2){$j = 'विवेचना में लंबित' ; $l='c_status'; echo "विवेचना में लंबित प्रकरण"; }
	elseif ($i===3){$j = 'खात्मा' ; $l='c_status'; echo "खात्मा";}  
	elseif ($i===4){ $j = 'न्यायालय में प्रस्तुत' ; $l='c_status'; echo "न्यायालय में प्रस्तुत प्रकरण";}
	elseif ($i===5){$j = 'निराकृत' ; $l='c_status'; echo "निराकृत प्रकरण";}
	elseif ($i===6){$j = 'न्यायालय में लंबित' ; $l='c_status'; echo "न्यायालय में लंबित प्रकरण";}
	elseif ($i===7){$j = 'सजा' ; $l='c_decision'; echo "सजा हुए प्रकरण";}
	elseif ($i===8){$j = 'आजीवन कारावास' ; $l='c_punish'; echo "कुल आजीवन करावास (आरोपियो की संख्या)";} 
	elseif ($i===9){$j = 'मृत्युदण्ड' ; $l='c_punish'; echo "कुल म़त्यू दण्ड (आरोपियो की संख्या)";}
	elseif ($i===10){$j = 'अन्य दोषसिद्धि' ; $l='c_punish'; echo "अन्य दोषसिद्धी के प्रकरण";}
	elseif ($i===11){$j = 'दोषमुक्त' ; $l='c_decision'; echo " दोषमुक्त हुये प्रकरण";}
	elseif ($i===12){$j = 'नस्तीबद्ध' ; $l='c_decision'; echo "न्यायालय द्वारा नस्तीबद्ध";}
	elseif ($i===13){$j = 'समिति द्वारा पृथक' ; $l='c_decision'; echo "समिति द्वारा पृथक किये गये";}
	
	else { }
	?>
	</td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");	
	$year08 ='2008';
	$like = "%" . $year08 . "%";	
	if ( !$stmt2 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date like ? AND dsr_chinhit =? AND c_status!=? AND c_decision!=? AND c_punish!=?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->bind_param("isssss",$branch_id, $like, $chinhit,$j,$j,$j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt2->execute() ) 
    echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	if ( !$stmt2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt2->bind_result($cid2); 
    $stmt2->fetch();?>
	<span><?php echo $cid2;?></span>
    </td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year09 ='2009';
	$like = "%" . $year09 . "%";	
	if ( !$stmt3 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt3->execute() ) 
    echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	if ( !$stmt3->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt3->bind_result($cid3); 
    $stmt3->fetch();?>
	<span><?php echo $cid3;?></span>
	</td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year10 ='2010';
	$like = "%" . $year10 . "%";	
	if ( !$stmt4 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt4->execute() ) 
    echo "Execute Error: ($stmt4->errno)  $stmt4->error";
	if ( !$stmt4->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt4->bind_result($cid4); 
    $stmt4->fetch();?>
	<span><?php echo $cid4;?></span>
	</td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year11 ='2011';
	$like = "%" . $year11 . "%";	
	if ( !$stmt5 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt5->execute() ) 
    echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	if ( !$stmt5->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt5->bind_result($cid5); 
    $stmt5->fetch();?>
	<span><?php echo $cid5;?></span>
	</td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year12 ='2012';
	$like = "%" . $year12 . "%";	
	if ( !$stmt6 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt6->execute() ) 
    echo "Execute Error: ($stmt6->errno)  $stmt6->error";
	if ( !$stmt6->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt6->bind_result($cid6); 
    $stmt6->fetch();?>
	<span><?php echo $cid6;?></span>
	</td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year13 ='2013';
	$like = "%" . $year13 . "%";
	if ( !$stmt7 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt7->execute() ) 
    echo "Execute Error: ($stmt7->errno)  $stmt7->error";
	if ( !$stmt7->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt7->bind_result($cid7); 
    $stmt7->fetch();?>
	<span><?php echo $cid7;?></span>
	</td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year14 ='2014';
	$like = "%" . $year14 . "%";	  
	if ( !$stmt8 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt8->execute() ) 
    echo "Execute Error: ($stmt8->errno)  $stmt8->error";
	if ( !$stmt8->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt8->bind_result($cid8); 
    $stmt8->fetch();?>
	<span><?php echo $cid8;?></span>
	</td>
		
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year15 ='2015';
	$like = "%" . $year15 . "%";	
	if ( !$stmt9 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt9->execute() ) 
    echo "Execute Error: ($stmt9->errno)  $stmt9->error";
	if ( !$stmt9->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt9->bind_result($cid9); 
    $stmt9->fetch();?>
	<span><?php echo $cid9;?></span>
	</td>
		
	<td>
    <?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year16 ='2016';
	$like = "%" . $year16 . "%"; 
	if ( !$stmt10 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt10->execute() ) 
    echo "Execute Error: ($stmt10->errno)  $stmt10->error";
	if ( !$stmt10->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt10->bind_result($cid10); 
    $stmt10->fetch();?>
	<span><?php echo $cid10;?></span>
	</td>
	
	<td>
	<?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year17 ='2017';
	$like = "%" . $year17 . "%";	
	if ( !$stmt11 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_kaymi_date like ? AND $l = ?") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->bind_param("siss", $branch_id, $chinhit, $like, $j) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$stmt11->execute() ) 
    echo "Execute Error: ($stmt11->errno)  $stmt11->error";
	if ( !$stmt11->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    $stmt11->bind_result($cid11); 
    $stmt11->fetch();?>
	<span><?php echo $cid11;?></span>
	</td>
    
        <td>
        <?php
	$police_dsr->select_db("ftcaaazc_dsr");
	$year18 ='2018';
	$like = "%" . $year18 . "%";
        if($i===1)
        {
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_chinhit_date like ?") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt12->bind_param("sis", $branch_id, $chinhit, $like) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        }
        else
        {
	if ( !$stmt12 = $police_dsr->prepare("SELECT COUNT(id) FROM dsr_entries WHERE sp_id = ? AND dsr_chinhit = ? AND dsr_chinhit_date like ? AND $l = ?") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt12->bind_param("siss", $branch_id, $chinhit, $like, $j) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        }
        if ( !$stmt12->execute() ) 
        echo "Execute Error: ($stmt11->errno)  $stmt11->error";
        if ( !$stmt12->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt12->bind_result($cid12); 
        $stmt12->fetch();
	?>
	<span><?php echo $cid12;?></span><br />
	</td>
	
	<td>
	<?php 
	$sum=$cid2+$cid3+$cid4+$cid5+$cid6+$cid7+$cid8+$cid9+$cid10+$cid11+$cid12;
	echo $sum;
	?>
	</td>
    </tr>
	<?php } //for loop end here ?>
	
	<tr style="display:none">
	 <td>14</td>
	 <td align="left"><?php echo "सजा का प्रतिशत";?></td>
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
      <?php //} //stmt1 end here?>
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