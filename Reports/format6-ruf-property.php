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
<title>Format-6-ruf-PROPERTY | File Tracking & Crime Analysis Application </title>
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
      <form action="format6-ruf-property.php" method="post" name="Search" enctype="multipart/form-data" id="popup-validation" role="form">
              
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
<div class="" style="margin-left:25px;margin-right:25px;"> <!--notice_all-->
  <div class="clearfix"></div>
  <br />
  <div id="download">
  <?php
   if(isset($_POST['Search'])!='')
   {
  ?>
      <br /><br />
<!--<p align="left" style="float:left;margin-left:-30px;">Format6-ruf-Property</p>-->
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
   // if($stmt1->num_rows === 0) exit('No rows');
   $stmt1->bind_result($id, $branch_name, $city);
  ?>
    <p align="center"><span>संपत्ति संबंधी जिलावार जानकारी दिनांक. <?php if ($_POST['datef'] == ''){	echo '';} else{echo date('d-m-Y', strtotime($_POST['datef']));
}?> से दि. <?php if ($_POST['datel'] == ''){echo '';} else{echo date('d-m-Y', strtotime($_POST['datel']));}?>तक  इन्दौर जोन</span></p>
 <br />
 <?php	  
  $datef = $_POST['datef'];
  $date1 = $_POST['datel'];
 ?>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align:center" id="print" width="960px" class="table table-striped table-bordered table-hover">
      <tr>
        <th rowspan="2" style="text-align:center;">क्र.</th>
        <th rowspan="2" style="text-align:center;"> शीर्ष</th>
		 <?php 
	  $j=0;	 	  
	  while($stmt1->fetch())
	  {
      $j++;
	  ?>
	  <th class="" colspan="2" style="text-align:center;"><?php echo $branch_name; echo ", "; echo $city;?></th>
	  <?php } //stmt1 end here?>
      </tr>
	  <tr>
      <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th style="text-align:center;">गया </th>
      <th style="text-align:center;">मिला</th>
	   <th>गया </th>
      <th style="text-align:center;">मिला</th>
	  
      </tr>
	  <?php
      $ipc =array("डकैती","लूट","गृहभेदन","चोरी","वाहन चोरी (दो पहिया)","वाहन चोरी (चार पहिया)","पशु चोरी");//,"अन्य भादवि"
	  $ipc1 =array('3','5','7','9','69','70','8');//,'19'	  
	  $arrlength=count($ipc);
	  for($x=0;$x<$arrlength;$x++)
      {
	  ?>
      <tr>
        <td><?php echo $x+1; ?></td>
        <td><?php echo $ipc[$x]; ?></td>
		<?php 
	$sp='SP';
	$police_tracking->select_db("ftcaaazc_epfts");
	$stmt5 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
    $stmt5->bind_param("s", $sp);
    $stmt5->execute();
    $stmt5->store_result();
    //if($stmt5->num_rows === 0) exit('No rows');
    $stmt5->bind_result($branch_id, $branch_name, $city);
	$i='0';
	while($stmt5->fetch())
	{
		$i++;
        ?>
            <td>
            <?php
            $police_dsr->select_db("ftcaaazc_dsr");
            $ipc2=$ipc1[$x];
            if ( !$stmt2 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND dsr_entries.dsr_vidhan_ipc = ? AND (property_details.property_date between ? and ?)") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt2->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt2->execute() ) 
            echo "Execute Error: ($stmt2->errno)  $stmt2->error";
            if ( !$stmt2->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt2->bind_result($cid2); 
            $stmt2->fetch();
            $i2[$i][$x]= $cid2;
            ?>
            <span><?php if($cid2>0){echo $cid2;} else {echo 0 ;}  //echo $cid2;?></span>
            </td>
	
            <td>
            <?php
            /*
            $police_dsr->select_db("ftcaaazc_dsr");
            $ipc2=$ipc1[$x];
            if ( !$stmt3 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND dsr_vidhan_ipc=? AND (dsr_kaymi_date >= ? and dsr_kaymi_date <= ?)") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt3->bind_param("iiss",$branch_id,$ipc2,$datef, $date1) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt3->execute() ) 
            echo "Execute Error: ($stmt3->errno)  $stmt3->error";
            if ( !$stmt3->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt3->num_rows === 0) { echo "No Results"; }
            $stmt3->bind_result($cid3); 
            $stmt3->fetch();
            $stmt3->close();
            //$i3[$x]=$cid3;
            */
            $police_dsr->select_db("ftcaaazc_dsr");
            if ( !$stmt6 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND dsr_entries.dsr_vidhan_ipc = ? AND (property_details.property_date BETWEEN ? AND ?)") ) 
            echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt6->bind_param("iiss",$branch_id,$ipc2,$datef,$date1) )
            echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
            if ( !$stmt6->execute() ) 
            echo "Execute Error: ($stmt6->errno)  $stmt6->error";
            if ( !$stmt6->store_result() ) //Only for select with bind_result()
            echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
            //if($stmt6->num_rows === 0) { echo "No Results"; }
            $stmt6->bind_result($cid6); 
            $stmt6->fetch();
            $stmt6->close();
            $cid36 = $cid6 ;
            //$cid36 = $cid3 + $cid6 ;
            $i3[$i][$x]= $cid36;
            ?>
            <span><?php if($cid36>0){echo $cid36;} else {echo 0 ;}  //echo $cid3;?></span>
            </td>
	<?php
	}
	$stmt5->close();
	?>	
    </tr>
	  <?php } ?>
	
	<tr>
	<?php   	
	$sp='SP';
    $police_tracking->select_db("ftcaaazc_epfts");
	$st1 = $police_tracking->prepare("SELECT id,branch_name,city FROM branch_tbl where designation = ?");
	$st1->bind_param("s", $sp);
    $st1->execute();
    $st1->store_result();
    //if($st1->num_rows === 0) exit('No rows');
    $st1->bind_result($branch_id1, $branch_name1, $city1);
    ?>
	<td>8</td>
	<td>पूर्व प्रकरण</td>
	  <?php 
	  $k=0;	 	  
	  while($st1->fetch())
	  {
              
        $a1='3';
        $a2='5';
        $a3='7';
        $a4='9';
        $a5='69';
        $a6='70';
        $a7='8'; 
              
      $k++;
	  ?>
	<td>
	<?php
	/*$police_dsr->select_db("ftcaaazc_dsr");
	if ( !$st2 = $police_dsr->prepare("SELECT SUM(dsr_theft_amount) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date < ? AND creation_date BETWEEN ? AND ? ") ) 
    echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st2->bind_param("isss",$branch_id1,$datef,$datef, $date1) )
    echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
    if ( !$st2->execute() ) 
    echo "Execute Error: ($st2->errno)  $st2->error";
	if ( !$st2->store_result() ) //Only for select with bind_result()
    echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
    //if($st2->num_rows === 0) { echo "No Results"; }
    $st2->bind_result($cid22); 
    $st2->fetch();
	$st2->close();*/

        $police_dsr->select_db("ftcaaazc_dsr");
        //if ( !$st3 = $police_dsr->prepare("SELECT SUM(lost_property) FROM property_details WHERE sp_id = ? AND creation_date BETWEEN ? AND ? ") ) 
        if ( !$st3 = $police_dsr->prepare("SELECT SUM(property_details.lost_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND dsr_entries.dsr_kaymi_date < ? AND property_details.property_date BETWEEN ? AND ?") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st3->bind_param("iiiiiiiisss", $branch_id1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $datef, $datef, $date1) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st3->execute() ) 
        echo "Execute Error: ($st3->errno)  $st3->error";
        if ( !$st3->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st3->num_rows === 0) { echo "No Results"; }
        $st3->bind_result($cid23); 
        $st3->fetch();
	?>
	<?php
	$total= $cid23; //$cid22+$cid23;
	$p[$k]=$total;
	?>
	<span><?php if($total>0){echo $total;} else {echo 0 ;}?></span>
        <?php
        $st3->close();
        ?>
	</td>			

        <td>
        <?php
        /*
        if ( !$st4 = $police_dsr->prepare("SELECT SUM(dsr_seized_amnt) FROM dsr_entries WHERE sp_id = ? AND dsr_kaymi_date < ? AND  (creation_date >= ? and creation_date <= ?) AND (dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=? OR dsr_vidhan_ipc=?) ") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st4->bind_param("isssiiiiiii",$branch_id1,$datef,$datef,$date1,$a1, $a2, $a3, $a4, $a5, $a6, $a7) )
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
        //if ( !$st5 = $police_dsr->prepare("SELECT SUM(got_property) FROM property_details WHERE sp_id = ? AND property_date between ? and ? AND (property_ipc = ? OR property_ipc= ? OR property_ipc = ? OR property_ipc = ? OR property_ipc = ? OR property_ipc = ? OR property_ipc = ?) AND dsr_id is null") ) 
        if ( !$st5 = $police_dsr->prepare("SELECT SUM(property_details.got_property) FROM property_details INNER JOIN dsr_entries ON property_details.dsr_id = dsr_entries.id WHERE property_details.sp_id = ? AND (dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ? OR dsr_entries.dsr_vidhan_ipc = ?) AND dsr_entries.dsr_kaymi_date < ? AND property_details.property_date BETWEEN ? AND ?") ) 
        echo "Prepare Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st5->bind_param("iiiiiiiisss", $branch_id1, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $datef, $datef, $date1) )
        echo "Binding Parameter Error: ($police_dsr->errno) $police_dsr->error";
        if ( !$st5->execute() ) 
        echo "Execute Error: ($st5->errno)  $st5->error";
        if ( !$st5->store_result() ) //Only for select with bind_result()
        echo "Storing Result Error: ($police_dsr->errno) $police_dsr->error";
        //if($st5->num_rows === 0) { echo "No Results"; }
        $st5->bind_result($cid25); 
        $st5->fetch();
        //$total1=$cid24+$cid25;
        $total1=$cid25;
        $pk[$k]=$total1;
        ?>
        <span><?php if($total1>0){echo $total1;} else {echo 0 ;}?></span>
        <?php
        $st5->close();
        ?>
        </td>	

	<?php
	  }
	  $st1->close();
	?>
	</tr>
	   
	   <tr>
        <td>9</td>
        <td> योग</td>
		<td>
		<?php $s=$i2[1][0]+$i2[1][1]+$i2[1][2]+$i2[1][3]+$i2[1][4]+$i2[1][5]+$i2[1][6]+$p[1];
	echo $s;?>
		</td>
		<td>
		<?php $s1=$i3[1][0]+$i3[1][1]+$i3[1][2]+$i3[1][3]+$i3[1][4]+$i3[1][5]+$i3[1][6]+$pk[1];
	echo $s1;?></td>
		<td>
		 <?php $s2=$i2[2][0]+$i2[2][1]+$i2[2][2]+$i2[2][3]+$i2[2][4]+$i2[2][5]+$i2[2][6]+$p[2];
	echo $s2;?></td>
		<td>
		 <?php $s3=$i3[2][0]+$i3[2][1]+$i3[2][2]+$i3[2][3]+$i3[2][4]+$i3[2][5]+$i3[2][6]+$pk[2];
	echo $s3;?></td>
		<td>
		 <?php $s4=$i2[3][0]+$i2[3][1]+$i2[3][2]+$i2[3][3]+$i2[3][4]+$i2[3][5]+$i2[3][6]+$p[3];
	echo $s4;?></td>
		<td>
		 <?php $s5=$i3[3][0]+$i3[3][1]+$i3[3][2]+$i3[3][3]+$i3[3][4]+$i3[3][5]+$i3[3][6]+$pk[3];
	echo $s5;?></td>
	<td>
		 <?php $s6=$i2[4][0]+$i2[4][1]+$i2[4][2]+$i2[4][3]+$i2[4][4]+$i2[4][5]+$i2[4][6]+$p[4];
	echo $s6;?></td>
		<td>
		 <?php $s7=$i3[4][0]+$i3[4][1]+$i3[4][2]+$i3[4][3]+$i3[4][4]+$i3[4][5]+$i3[4][6]+$pk[4];
	echo $s7;?></td>
		 <td>
		 <?php $s8=$i2[5][0]+$i2[5][1]+$i2[5][2]+$i2[5][3]+$i2[5][4]+$i2[5][5]+$i2[5][6]+$p[5];
	echo $s8;?></td>
		<td>
		 <?php $s9=$i3[5][0]+$i3[5][1]+$i3[5][2]+$i3[5][3]+$i3[5][4]+$i3[5][5]+$i3[5][6]+$pk[5];
	echo $s9;?></td>
		<td>
		 <?php $s10=$i2[6][0]+$i2[6][1]+$i2[6][2]+$i2[6][3]+$i2[6][4]+$i2[6][5]+$i2[6][6]+$p[6];
	echo $s10;?></td>
		 <td>
		 <?php $s11=$i3[6][0]+$i3[6][1]+$i3[6][2]+$i3[6][3]+$i3[6][4]+$i3[6][5]+$i3[6][6]+$pk[6];
	echo $s11;?></td>
		<td>
		 <?php $s12=$i2[7][0]+$i2[7][1]+$i2[7][2]+$i2[7][3]+$i2[7][4]+$i2[7][5]+$i2[7][6]+$p[7];
	echo $s12;?></td>
		<td>
		 <?php $s13=$i3[7][0]+$i3[7][1]+$i3[7][2]+$i3[7][3]+$i3[7][4]+$i3[7][5]+$i3[7][6]+$pk[7];
	echo $s13;?></td>
		<td>
		 <?php $s14=$i2[8][0]+$i2[8][1]+$i2[8][2]+$i2[8][3]+$i2[8][4]+$i2[8][5]+$i2[8][6]+$p[8];
	echo $s14;?></td>
		<td>
		 <?php $s15=$i3[8][0]+$i3[8][1]+$i3[8][2]+$i3[8][3]+$i3[8][4]+$i3[8][5]+$i3[8][6]+$pk[8];
	echo $s15;?></td>
		<td>
		 <?php $s16=$i2[9][0]+$i2[9][1]+$i2[9][2]+$i2[9][3]+$i2[9][4]+$i2[9][5]+$i2[9][6]+$p[9];
	echo $s16;?></td>
		<td>
		 <?php $s17=$i3[9][0]+$i3[9][1]+$i3[9][2]+$i3[9][3]+$i3[9][4]+$i3[9][5]+$i3[9][6]+$pk[9];
	echo $s17;?></td>
		<td>
		 <?php $s18=$i2[10][0]+$i2[10][1]+$i2[10][2]+$i2[10][3]+$i2[10][4]+$i2[10][5]+$i2[10][6]+$p[10];
	echo $s18;?></td>
		<td>
		 <?php $s19=$i3[10][0]+$i3[10][1]+$i3[10][2]+$i3[10][3]+$i3[10][4]+$i3[10][5]+$i3[10][6]+$pk[10];
	echo $s19;?></td>
      </tr>
	   <tr>
        <td>10</td>
        <td>प्रतिशत</td>
		<td colspan="2"><?php 
if($s > 0)
{	
$percentage1 =($s1)*100/$s ;
echo ROUND(ABS($percentage1),2); echo "%";
}
else
{	
echo "0%";	
}?></td>
		<td colspan="2">
		<?php 
if($s2 > 0)
{	
$percentage2 =($s3)*100/$s2 ;
echo ROUND(ABS($percentage2),2); echo "%";
}
else
{	
echo "0%";	
}?>
		</td>
		<td colspan="2">
		<?php 
if($s4 > 0)
{	
$percentage3 =($s5)*100/$s4 ;
echo ROUND(ABS($percentage3),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s6 > 0)
{	
$percentage4 =($s7)*100/$s6 ;
echo ROUND(ABS($percentage4),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s8 > 0)
{	
$percentage5 =($s9)*100/$s8 ;
echo ROUND(ABS($percentage5),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s10 > 0)
{	
$percentage6 =($s11)*100/$s10 ;
echo ROUND(ABS($percentage6),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s12 > 0)
{	
$percentage7 =($s13)*100/$s12 ;
echo ROUND(ABS($percentage7),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2"><?php 
if($s14 > 0)
{	
$percentage8 =($s15)*100/$s14 ;
echo ROUND(ABS($percentage8),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s16 > 0)
{	
$percentage9 =($s17)*100/$s16 ;
echo ROUND(ABS($percentage9),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
		<td colspan="2">
		<?php 
if($s18 > 0)
{	
$percentage10 =($s19)*100/$s18 ;
echo ROUND(ABS($percentage10),2); echo "%";
}
else
{	
echo "0%";	
}?>
</td>
      </tr>
	  
	     <tr style="display:none">
        <td colspan="2"> प्रापर्टी से </td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
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
