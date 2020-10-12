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
<title>Format-5-PROPERTY | File Tracking & Crime Analysis Application </title>
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
      <form action="formate_five_property.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<p align="left" style="float:left;margin-left:-30px;">Format5-Property</p>
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
    <p align="center"><span>संपत्ति संबंधी अपराध में बरामदगीः- दि. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>तक  इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
  $newDate1 =date ("Y-m-d", strtotime ($datef ."-16 days"));
  $newDate2 =date ("Y-m-d", strtotime ($datef ."-1 day"));
 ?>
 <br/>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <td rowspan="2">क्र.</td>
        <td rowspan="2">जिला</td>
        <td colspan="2">आलौच्य पक्ष</td>
        <td rowspan="2">बरामदगी का प्रतिशत</td>
		<td colspan="2">गत  पक्ष</td>
		<td rowspan="2">बरामदगी का प्रतिशत</td>
		<td colspan="2">गत वर्ष का आलौच्य पक्ष</td>
		<td rowspan="2">बरामदगी का प्रतिशत</td>
      </tr>
      
	  <tr>
      <td>अपहृत </td>
      <td>बरामद</td>
	  <td>अपहृत </td>
      <td>बरामद</td>
	  <td>अपहृत </td>
      <td>बरामद</td>
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
        if ( !$stmt2->execute() ) 
        echo "Execute Error: ($stmt2->errno)  $stmt2->error";
        if ( !$stmt2->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt2->bind_result($cid2); 
        $stmt2->fetch();
        $s2[$j]=$cid2;?>
        <span><?php if ($cid2>0){echo $cid2;}else{echo 0;}?></span>
        <?php
        $stmt2->close();
        ?>
        </td>
		
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        /*
        if ( !$stmt3 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? )") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt3->bind_param("issiiiiiiii", $branch_id, $datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt3->execute() ) 
        echo "Execute Error: ($stmt3->errno)  $stmt3->error";
        if ( !$stmt3->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt3->num_rows === 0) { echo "No Results"; }
        $stmt3->bind_result($cid3); 
        $stmt3->fetch();
        $stmt3->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st4 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st4->bind_param("isssiiiiiiii",$branch_id,$datef,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st4->execute() ) 
        echo "Execute Error: ($st4->errno)  $st4->error";
        if ( !$st4->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st4->num_rows === 0) { echo "No Results"; }
        $st4->bind_result($cid24); 
        $st4->fetch();
        $st4->close();
        */
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st5 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st5->bind_param("issiiiiiiii",$branch_id,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st5->execute() ) 
        echo "Execute Error: ($st5->errno)  $st5->error";
        if ( !$st5->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st5->num_rows === 0) { echo "No Results"; }
        $st5->bind_result($cid25); 
        $st5->fetch();
        $st5->close();

        //$total1=$cid24+$cid25+$cid3;
        $total1=$cid25;
        $s1[$j]=$total1;
        ?>
        <span><?php if ($total1>0){echo $total1;}else{echo 0;} //echo $cid3;?></span>

        </td>
		
        <td>
        <?php
        if($cid2 > 0)
        {	
        $percentage1 =($total1)*100/$cid2 ;
        echo ROUND(ABS($percentage1),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>
		
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        if ( !$stmt4 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt4->bind_param("issiiiiiiii", $branch_id, $newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt4->execute() ) 
        echo "Execute Error: ($stmt4->errno)  $stmt4->error";
        if ( !$stmt4->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt4->num_rows === 0) { echo "No Results"; }
        $stmt4->bind_result($cid4); 
        $stmt4->fetch();
        $s3[$j]=$cid4;?>
        <span><?php if ($cid4>0){echo $cid4;}else{echo 0;} //echo $cid4;?></span>
        <?php
        $stmt4->close();
        ?>
        </td>
		
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        /*
        if ( !$stmt5 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND  (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt5->bind_param("issiiiiiiii",$branch_id,$newDate1,$newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt5->execute() ) 
        echo "Execute Error: ($stmt5->errno)  $stmt5->error";
        if ( !$stmt5->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt5->num_rows === 0) { echo "No Results"; }
        $stmt5->bind_result($cid5); 
        $stmt5->fetch();
        $stmt5->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st6 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st6->bind_param("isssiiiiiiii",$branch_id,$newDate1,$newDate1,$newDate2, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st6->execute() ) 
        echo "Execute Error: ($st6->errno)  $st6->error";
        if ( !$st6->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st6->num_rows === 0) { echo "No Results"; }
        $st6->bind_result($ci24); 
        $st6->fetch();
        $st6->close();
        */
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st7 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND  (property_details.property_date >= ? AND property_details.property_date<= ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st7->bind_param("issiiiiiiii",$branch_id,$newDate1,$newDate2, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st7->execute() ) 
        echo "Execute Error: ($st7->errno)  $st7->error";
        if ( !$st7->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st7->num_rows === 0) { echo "No Results"; }
        $st7->bind_result($ci25); 
        $st7->fetch();
        $st7->close();

        //$total2=$ci24+$ci25+$cid5;
        $total2=$ci25;
        $s4[$j] = $total2;
        ?>
        <span><?php if ($total2>0){echo $total2;}else{echo 0;} //echo $cid5;?></span>

        </td>
		
        <td><?php
        if($cid4 > 0)
        {	
        $percentage2 =($total2)*100/$cid4 ;
        echo ROUND(ABS($percentage2),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?></td>
		
        <td>0</td>
        <td>0</td>
        <td>0</td>
      </tr>
      <?php } //stmt1 end here?>
      
      <tr>
        <td class="" colspan="2">जोन का योग</td>

        <td><?php $sum2 = $s2[1]+$s2[2]+$s2[3]+$s2[4]+$s2[5]+$s2[6]+$s2[7]+$s2[8]+$s2[9]+$s2[10];
        echo $sum2; ?>
        </td>

        <td><?php $sum12 = $s1[1]+$s1[2]+$s1[3]+$s1[4]+$s1[5]+$s1[6]+$s1[7]+$s1[8]+$s1[9]+$s1[10];
        echo $sum12; ?>
        </td>

        <td>
        <?php
        if($sum2 > 0)
        {	
        $percentage3 =($sum12)*100/$sum2 ;
        echo ROUND(ABS($percentage3),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td> 

        <td><?php $sum3 = $s3[1]+$s3[2]+$s3[3]+$s3[4]+$s3[5]+$s3[6]+$s3[7]+$s3[8]+$s3[9]+$s3[10];
        echo $sum3; ?>
        </td>

        <td><?php $sum4 = $s4[1]+$s4[2]+$s4[3]+$s4[4]+$s4[5]+$s4[6]+$s4[7]+$s4[8]+$s4[9]+$s4[10];
        echo $sum4; ?>
        </td>	

        <td>
        <?php
        if($sum3 > 0)
        {	
        $percentage4 =($sum4)*100/$sum3 ;
        echo ROUND(ABS($percentage4),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>

        <td>0</td>
        <td>0</td>
        <td>0</td>		
      </tr>
        
      <tr>
        <td class="" colspan="2">कमी / वृद्धि का प्रतिशत</td>

        <td colspan="3">
        <?php
        if($sum2 > 0)
        {	
        $percentage3 =($sum12)*100/$sum2 ;
        echo ROUND(ABS($percentage3),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>	

        <td colspan="3">
        <?php
        if($sum3 > 0)
        {	
        $percentage4 =($sum4)*100/$sum3 ;
        echo ROUND(ABS($percentage4),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>	

        <td colspan="3">0%</td>	
      </tr>
    </table>
    
    <br /><br />
    <br /><br />
	<table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
	<tr>
	<td>क्र.</td>
	<td colspan="4">जिला / रेंज वार संपत्ति</td>
	<td colspan="3">गत  पक्ष</td>
	<td colspan="3">गत वर्ष का आलौच्य पक्ष</td>
	</tr>
            
	<tr>
	<td></td>
	<td>आलौच्य पक्ष</td>
	<td>गया</td>
	<td>मिला</td>
	<td>प्रति.</td>
	<td>गया</td>
	<td>मिला</td>
	<td>प्रति.</td>
	<td>गया</td>
	<td>मिला</td>
	<td>प्रति.</td>
	</tr>
            
	<tr>
        <td>1</td>
        <td>इन्दौर शहर</td>
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id1='6';
        $id2='7';
        $id3='8';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        if ( !$stmt16 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt16->bind_param("iiissiiiiiiii", $id1, $id2, $id3, $datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt16->execute() ) 
        echo "Execute Error: ($stmt16->errno)  $stmt16->error";
        if ( !$stmt16->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt16->num_rows === 0) { echo "No Results"; }
        $stmt16->bind_result($cid16); 
        $stmt16->fetch();
        ?>
        <span><?php if ($cid16>0){echo $cid16;}else{echo 0;} //echo $cid16;?></span>
        <?php
        $stmt16->close();
        ?>
        </td>
	
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id1='6';
        $id2='7';
        $id3='8';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        
        /*
        if ( !$stmt18 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt18->bind_param("iiissiiiiiiii",$id1,$id2,$id3,$datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt18->execute() ) 
        echo "Execute Error: ($stmt18->errno)  $stmt18->error";
        if ( !$stmt18->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt18->num_rows === 0) { echo "No Results"; }
        $stmt18->bind_result($cid18); 
        $stmt18->fetch();
        $stmt18->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st14 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st14->bind_param("iiisssiiiiiiii",$id1,$id2,$id3,$datef,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st14->execute() ) 
        echo "Execute Error: ($st14->errno)  $st14->error";
        if ( !$st14->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st14->num_rows === 0) { echo "No Results"; }
        $st14->bind_result($c14); 
        $st14->fetch();
        $st14->close();
        */
        
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st15 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st15->bind_param("iiissiiiiiiii",$id1,$id2,$id3,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st15->execute() ) 
        echo "Execute Error: ($st15->errno)  $st15->error";
        if ( !$st15->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st15->num_rows === 0) { echo "No Results"; }
        $st15->bind_result($c15); 
        $st15->fetch();
        $st15->close();
        
        //$total5=$cid18+$c15+$c14;
        $total5=$c15;
        ?>
        <span><?php if ($total5>0){echo $total5;}else{echo 0;} //echo $cid18;?></span>
        </td>
	
        <td>
        <?php
        if($cid16 > 0)
        {	
        $percentage16 =($total5)*100/$cid16 ;
        echo ROUND(ABS($percentage16),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>
		
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id1='6';
        $id2='7';
        $id3='8';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        if ( !$st16 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st16->bind_param("iiissiiiiiiii", $id1, $id2, $id3, $newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st16->execute() ) 
        echo "Execute Error: ($st16->errno)  $st16->error";
        if ( !$st16->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st16->num_rows === 0) { echo "No Results"; }
        $st16->bind_result($ci16); 
        $st16->fetch();
        ?>
        <span><?php if ($ci16>0){echo $ci16;}else{echo 0;} //echo $ci16;?></span>
        <?php
        $st16->close();
        ?>
        </td>
	
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id1='6';
        $id2='7';
        $id3='8';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        /*
        if ( !$st18 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st18->bind_param("iiissiiiiiiii",$id1,$id2,$id3,$newDate1,$newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st18->execute() ) 
        echo "Execute Error: ($st18->errno)  $st18->error";
        if ( !$st18->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st18->num_rows === 0) { echo "No Results"; }
        $st18->bind_result($ci18); 
        $st18->fetch();
        $st18->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st54 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st54->bind_param("iiisssiiiiiiii",$id1,$id2,$id3,$newDate1,$newDate1,$newDate2, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st54->execute() ) 
        echo "Execute Error: ($st54->errno)  $st54->error";
        if ( !$st54->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st54->num_rows === 0) { echo "No Results"; }
        $st54->bind_result($c54); 
        $st54->fetch();
        $st54->close();
        */
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st55 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st55->bind_param("iiissiiiiiiii",$id1,$id2,$id3,$newDate1,$newDate2, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st55->execute() ) 
        echo "Execute Error: ($st55->errno)  $st55->error";
        if ( !$st55->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st55->num_rows === 0) { echo "No Results"; }
        $st55->bind_result($c55); 
        $st55->fetch();
        $st55->close();
        //$total8=$ci18+$c55+$c54;
        $total8=$c55;
        ?>
        <span><?php if ($total8>0){echo $total8;}else{echo 0;}  //echo $ci18;?></span>
        </td>
	
        <td>
        <?php
        if($ci16 > 0)
        {	
        $percentage17 =($total8)*100/$ci16 ;
        echo ROUND(ABS($percentage17),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>
	
	<td>0</td>
	<td>0</td>
	<td>0%</td>
	</tr>
	
	<tr>
	<td>2</td>
	<td>इन्दौर रेंज ग्रामीण</td>
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id4='9';
        $id5='10';
        $id6='11';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        if ( !$stmt19 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt19->bind_param("iiissiiiiiiii", $id4, $id5, $id6, $datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt19->execute() ) 
        echo "Execute Error: ($stmt19->errno)  $stmt19->error";
        if ( !$stmt19->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt19->num_rows === 0) { echo "No Results"; }
        $stmt19->bind_result($cid19); 
        $stmt19->fetch();?>
        <span><?php if ($cid19>0){echo $cid19;}else{echo 0;}  //echo $cid19;?></span>
        </td>

        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id4='9';
        $id5='10';
        $id6='11';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        /*
        if ( !$stmt20 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt20->bind_param("iiissiiiiiiii",$id4,$id5,$id6,$datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt20->execute() ) 
        echo "Execute Error: ($stmt20->errno)  $stmt20->error";
        if ( !$stmt20->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt20->num_rows === 0) { echo "No Results"; }
        $stmt20->bind_result($cid20); 
        $stmt20->fetch();
        $stmt20->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st34 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st34->bind_param("iiisssiiiiiiii", $id4, $id5, $id6, $datef, $datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st34->execute() ) 
        echo "Execute Error: ($st34->errno)  $st34->error";
        if ( !$st34->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st24->num_rows === 0) { echo "No Results"; }
        $st34->bind_result($c34); 
        $st34->fetch();
        $st34->close();
        */
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st35 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st35->bind_param("iiissiiiiiiii",$id4,$id5,$id6,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st35->execute() ) 
        echo "Execute Error: ($st35->errno)  $st35->error";
        if ( !$st35->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st35->num_rows === 0) { echo "No Results"; }
        $st35->bind_result($c35); 
        $st35->fetch();
        $st35->close();
        //$total6=$cid20+$c35+$c34;
        $total6=$c35;
        ?>
        <span><?php if ($total6>0){echo $total6;}else{echo 0;}  //echo $cid20;?></span>
        </td>

        <td>
        <?php
        if($cid19 > 0)
        {	
        $percentage19 =($total6)*100/$cid19 ;
        echo ROUND(ABS($percentage19),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>
	
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id4='9';
        $id5='10';
        $id6='11';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        if ( !$st19 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st19->bind_param("iiissiiiiiiii",$id4,$id5,$id6,$newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st19->execute() ) 
        echo "Execute Error: ($st19->errno)  $st19->error";
        if ( !$st19->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st19->num_rows === 0) { echo "No Results"; }
        $st19->bind_result($ci19); 
        $st19->fetch();
        ?>
        <span><?php if ($ci19>0){echo $ci19;}else{echo 0;}  //echo $ci19;?></span>
        <?php
        $st19->close();
        ?>
        </td>
	
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id4='9';
        $id5='10';
        $id6='11';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        /*
        if ( !$st20 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st20->bind_param("iiissiiiiiiii",$id4,$id5,$id6,$newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st20->execute() ) 
        echo "Execute Error: ($st20->errno)  $st20->error";
        if ( !$st20->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st20->num_rows === 0) { echo "No Results"; }
        $st20->bind_result($ci20); 
        $st20->fetch();
        $st20->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st64 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st64->bind_param("iiisssiiiiiiii",$id4,$id5,$id6,$newDate1,$newDate1,$newDate2, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st64->execute() ) 
        echo "Execute Error: ($st64->errno)  $st64->error";
        if ( !$st64->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st64->num_rows === 0) { echo "No Results"; }
        $st64->bind_result($c64); 
        $st64->fetch();
        $st64->close();
        */
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st65 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st65->bind_param("iiissiiiiiiii",$id4,$id5,$id6,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st65->execute() ) 
        echo "Execute Error: ($st65->errno)  $st65->error";
        if ( !$st65->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st65->num_rows === 0) { echo "No Results"; }
        $st65->bind_result($c65); 
        $st65->fetch();
        $st65->close();
        //$total9=$ci20+$c65+$c64;
        $total9=$c65;
        ?>
        <span><?php if ($total9>0){echo $total9;}else{echo 0;}  //echo $ci20;?></span>
        </td>

        <td>
        <?php
        if($ci19 > 0)
        {	
        $percentage20 =($total9)*100/$ci19 ;
        echo ROUND(ABS($percentage20),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>
	
	<td>0</td>
	<td>0</td>
	<td>0%</td>
	</tr>
	
	<tr>
	<td>3</td>
	<td>निमाड़ रेंज</td>
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id7='12';
        $id8='13';
        $id9='14';
        $id10='15';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        if ( !$stmt21 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt21->bind_param("iiiissiiiiiiii",$id7,$id8,$id9,$id10,$datef, $date1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt21->execute() ) 
        echo "Execute Error: ($stmt21->errno)  $stmt21->error";
        if ( !$stmt21->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt21->num_rows === 0) { echo "No Results"; }
        $stmt21->bind_result($cid21); 
        $stmt21->fetch();
        ?>
        <span><?php if ($cid21>0){echo $cid21;}else{echo 0;} //echo $cid21;?></span>
        <?php
        $stmt21->close();
        ?>
        </td>
	
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id7='12';
        $id8='13';
        $id9='14';
        $id10='15';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        /*
        if ( !$stmt22 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ? OR dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt22->bind_param("iiiissiiiiiiii",$id7,$id8,$id9,$id10,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$stmt22->execute() ) 
        echo "Execute Error: ($stmt22->errno)  $stmt22->error";
        if ( !$stmt22->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt22->num_rows === 0) { echo "No Results"; }
        $stmt22->bind_result($cid22); 
        $stmt22->fetch();
        $stmt22->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st44 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st44->bind_param("iiiisssiiiiiiii",$id7,$id8,$id9,$id10,$datef,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st44->execute() ) 
        echo "Execute Error: ($st44->errno)  $st44->error";
        if ( !$st44->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st44->num_rows === 0) { echo "No Results"; }
        $st44->bind_result($c44); 
        $st44->fetch();
        $st44->close();
        */
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st45 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st45->bind_param("iiiissiiiiiiii",$id7,$id8,$id9,$id10,$datef,$date1, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st45->execute() ) 
        echo "Execute Error: ($st45->errno)  $st45->error";
        if ( !$st45->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st45->num_rows === 0) { echo "No Results"; }
        $st45->bind_result($c45); 
        $st45->fetch();
        $st45->close();
        //$total7=$cid22+$c45+$c44;
        $total7=$c45;
        ?>
        <span><?php if ($total7>0){echo $total7;}else{echo 0;} //echo $cid22;?></span>
        </td>
	
        <td>
        <?php
        if($cid21 > 0)
        {	
        $percentage21 =($cid22)*100/$cid21 ;
        echo ROUND(ABS($percentage21),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>
	
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id7='12';
        $id8='13';
        $id9='14';
        $id10='15';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        if ( !$st21 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st21->bind_param("iiiissiiiiiiii",$id7,$id8,$id9,$id10,$newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st21->execute() ) 
        echo "Execute Error: ($st21->errno)  $st21->error";
        if ( !$st21->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($stmt21->num_rows === 0) { echo "No Results"; }
        $st21->bind_result($ci21); 
        $st21->fetch();
        ?>
        <span><?php if ($ci21>0){echo $ci21;}else{echo 0;}  //echo $ci21;?></span>
        <?php
        $st21->close();
        ?>
        </td>
	
        <td>
        <?php
        $police_dsr->select_db("ftcaaazc_dsr");
        $id7='12';
        $id8='13';
        $id9='14';
        $id10='15';
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='6';
        $a8='8';
        /*
        if ( !$st22 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ? OR sp_id = ?) AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st22->bind_param("iiiissiiiiiiii",$id7,$id8,$id9,$id10,$newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st22->execute() ) 
        echo "Execute Error: ($st22->errno)  $st22->error";
        if ( !$st22->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st22->num_rows === 0) { echo "No Results"; }
        $st22->bind_result($ci22); 
        $st22->fetch();
        $st22->close();

        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st74 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE (sp_id = ? OR sp_id = ? OR sp_id = ? OR sp_id = ?) AND dsr_kaymi_date < ? AND (creation_date >= ? AND creation_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st74->bind_param("iiiisssiiiiiiii",$id7,$id8,$id9,$id10,$newDate1,$newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st74->execute() ) 
        echo "Execute Error: ($st74->errno)  $st74->error";
        if ( !$st74->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st74->num_rows === 0) { echo "No Results"; }
        $st74->bind_result($c74); 
        $st74->fetch();
        $st74->close();
        */
        $police_dsr->select_db("ftcaaazc_dsr");
        if ( !$st75 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE (property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ? OR property_details.sp_id = ?) AND (property_details.property_date BETWEEN ? AND ?) AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?)") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st75->bind_param("iiiissiiiiiiii",$id7,$id8,$id9,$id10,$newDate1, $newDate2, $a1, $a2, $a3, $a4, $a5, $a6 , $a7, $a8) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st75->execute() ) 
        echo "Execute Error: ($st75->errno)  $st75->error";
        if ( !$st75->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st75->num_rows === 0) { echo "No Results"; }
        $st75->bind_result($c75); 
        $st75->fetch();
        $st75->close();
        //$total10=$ci22+$c75+$c74;
        $total10=$c75;
        ?>
        <span><?php if ($total10>0){echo $total10;}else{echo 0;}  //echo $ci22;?></span>
        </td>
	
        <td>
        <?php
        if($ci21 > 0)
        {	
        $percentage22 =($total10)*100/$ci21 ;
        echo ROUND(ABS($percentage22),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>
	
	<td>0</td>
	<td>0</td>
	<td>0%</td>
	</tr>
	
	<tr>
        <td colspan="2">योग</td>
        <td><?php $summ1 = $cid21+$cid19+$cid16; echo $summ1;?></td>
        <td><?php $summ2 =$total5+$total6+$total7; echo $summ2; ?></td>
        <td>
        <?php
        if($summ1 > 0)
        {	
        $percentage23 =($summ2)*100/$summ1 ;
        echo ROUND(ABS($percentage23),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>

        <td><?php $summ3 = $ci21+$ci19+$ci16; echo $summ3; ?></td>
        <td><?php $summ4 = $total8+$total9+$total10; echo $summ4; ?></td>
        <td>
        <?php
        if($summ3 > 0)
        {	
        $percentage24 =($summ4)*100/$summ3 ;
        echo ROUND(ABS($percentage24),2); echo "%";
        }
        else
        {	
        echo "0%";	
        }
        ?>
        </td>

        <td>0</td>
        <td>0</td>
        <td>0%</td>
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
