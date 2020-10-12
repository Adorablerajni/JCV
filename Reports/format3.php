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
<title>Format-3 | File Tracking & Crime Analysis Application </title>
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
      <form action="format3.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format-3</p>
<p align="right"></p>
  <div class="mar10">
  <?php   	
	$sp='SP';
	$police_tracking->select_db("ftcaaazc_epfts");
	$stmt1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
    $stmt1->bind_param("s", $sp);
    $stmt1->execute();
    $stmt1->store_result();
    if($stmt1->num_rows === 0) exit('No rows');
    $stmt1->bind_result($branch_id, $branch_name, $city);
  ?>
    <p align="center"><span>विभिन्न अपराधों में चोरी गई एवं बरामद सम्पत्ति विवरण दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
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
        <td>चोरी गई संपत्ति</td>
        <td>बरामद हुई संपत्ति</td>
        <td>बरामदगी का प्रतिशत</td>
      </tr>
      <tr>
      <td><strong>(1)</strong></td>
      <td><strong>(2)</strong></td>
      <td><strong>(3)</strong></td>
      <td><strong>(4)</strong></td>
      <td><strong>(5)</strong></td>   
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
	    $dsr_theft_details='NULL';
		$a1='3';
	    $a2='5';
	    $a3='7';
	    $a4='9';
	    $a5='69';
	    $a6='70';
        $a7='6';
		$a8='8';
		if ( !$stmt2 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->bind_param("issiiiiiiii", $branch_id, $datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
	    //if ( !$stmt2 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_theft_details != ? AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        //echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        //if ( !$stmt2->bind_param("isssiiiiiiii", $branch_id, $datef, $date1, $dsr_theft_details, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        //echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt2->execute() ) 
        echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	    if ( !$stmt2->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt2->bind_result($cid2); 
        $stmt2->fetch();
		$s2[$j]=$cid2;?>
	    <span><?php if ($cid2 > 0){echo $cid2;}else{echo 0;}?></span>
		 <?php
        $stmt2->close();
        ?>
		</td>
		
        <td class="">
		<?php
	    $police_dsr->select_db("ftcaaazc_dsr");
	    $dsr_seized_property='NULL';
		$a1='3';
	    $a2='5';
	    $a3='7';
	    $a4='9';
	    $a5='69';
	    $a6='70';
        $a7='6';
		$a8='8';
		if ( !$stmt3 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt3->bind_param("issiiiiiiii",$branch_id,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
	    //if ( !$stmt3 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_seized_property != ? AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        //echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        //if ( !$stmt3->bind_param("isssiiiiiiii", $branch_id, $datef, $date1, $dsr_seized_property, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        //echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt3->execute() ) 
        echo "Execute Error: ($stmt3->errno)  $stmt3->error";
	    if ( !$stmt3->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt3->bind_result($cid3); 
        $stmt3->fetch();
		$s1[$j]=$cid3;?>
	    <span><?php if ($cid3 > 0){echo $cid3;}else{echo 0;}?></span>
		<?php
        $stmt3->close();
        ?>
		</td>
		
        <td>
		<?php
		$y = $cid2;
        $x = $cid3;
        if($y!=0)
		{
        $percent = $x/$y;
        }
		else
		{
		$percent='0';	
		}
        $percent_friendly = number_format( $percent * 100, 2 ) . '%' ;  
		?>
		<span><?php echo $percent_friendly;?></span>
		</td>
        
      </tr>
      <?php } //stmt1 end here?>
      <tr>
        <td colspan="2">जोन का योग</td>
       
	   <td><?php $sum2 = $s2[1]+$s2[2]+$s2[3]+$s2[4]+$s2[5]+$s2[6]+$s2[7]+$s2[8]+$s2[9]+$s2[10];
        echo $sum2; ?>
        </td>
		
		<td><?php $sum12 = $s1[1]+$s1[2]+$s1[3]+$s1[4]+$s1[5]+$s1[6]+$s1[7]+$s1[8]+$s1[9]+$s1[10];
        echo $sum12; ?>
        </td>
		<?php
	   // $police_dsr->select_db("ftcaaazc_dsr");
	   // $dsr_theft_details='NULL';
		//$a1='3';
	   // $a2='5';
	   // $a3='7';
	   // $a4='9';
	   // $a5='69';
	   // $a6='70';
       // $a7='6';
       // $a8='8'; 		
	//if ( !$stmt4 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_theft_details != ? AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
   // echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    //if ( !$stmt4->bind_param("sssiiiiiiii", $datef, $date1, $dsr_theft_details, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
    //echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    //if ( !$stmt4->execute() ) 
    //echo "Execute Error: ($stmt2->errno)  $stmt2->error";
	//if ( !$stmt4->store_result() ) //Only for select with bind_result()
    //echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    //$stmt4->bind_result($cid4); 
    //$stmt4->fetch();?>
	<?php //echo $cid4;?>
		
		
        
		<?php
	    //$police_dsr->select_db("ftcaaazc_dsr");
	    //$dsr_seized_property='NULL';
		//$a1='3';
	   // $a2='5';
	    //$a3='7';
	    //$a4='9';
	    //$a5='69';
	    //$a6='70';
        //$a7='6';
		//$a8='8';
	//if ( !$stmt5 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND dsr_seized_property != ? AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
    //echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    //if ( !$stmt5->bind_param("sssiiiiiiii", $datef, $date1, $dsr_seized_property, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
    //echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    //if ( !$stmt5->execute() ) 
    //echo "Execute Error: ($stmt5->errno)  $stmt5->error";
	//if ( !$stmt5->store_result() ) //Only for select with bind_result()
    //echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($stmt3->num_rows === 0) { echo "No Results"; }
    //$stmt5->bind_result($cid5); 
    //$stmt5->fetch();?>
	<span><?php //echo $cid5;?></span>
		
       
	   <td>
	   <?php
		
	   $y1 = $sum2;
       $x1 = $sum12;
        if($y1!=0)
		{
        $percent1 = $x1/$y1;
        }
		else
		{
		$percent1='0';	
		}
        $percent_friendly1 = number_format( $percent1 * 100, 2 ) . '%' ;  
		?>
		<span><?php echo $percent_friendly1;?></span>
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
